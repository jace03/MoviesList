<?php

namespace App\Http\Controllers;

use App\Entities\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MovieController extends Controller
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function index(Request $request)
    {
        $search = $request->get('search');
        $genreFilter = $request->get('genre');
        $page = max((int) $request->get('page', 1), 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;

        // Get all unique genres
        $genreQuery = $this->em->createQuery('SELECT DISTINCT m.genre FROM App\Entities\Movie m WHERE m.genre IS NOT NULL');
        $genres = array_column($genreQuery->getArrayResult(), 'genre');

        // Build movie query
        $qb = $this->em->createQueryBuilder()
            ->select('m')
            ->from(\App\Entities\Movie::class, 'm')
            ->orderBy('m.rank', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        if ($search) {
            $qb->andWhere('m.title LIKE :search OR m.genre LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        if ($genreFilter) {
            $qb->andWhere('m.genre = :genre')
                ->setParameter('genre', $genreFilter);
        }

        $movies = $qb->getQuery()->getResult();

        // Count total for pagination
        $countQb = $this->em->createQueryBuilder()
            ->select('COUNT(m.id)')
            ->from(\App\Entities\Movie::class, 'm');

        if ($search) {
            $countQb->andWhere('m.title LIKE :search OR m.genre LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        if ($genreFilter) {
            $countQb->andWhere('m.genre = :genre')
                ->setParameter('genre', $genreFilter);
        }

        $total = $countQb->getQuery()->getSingleScalarResult();

        $paginator = new LengthAwarePaginator(
            $movies,
            $total,
            $limit,
            $page,
            ['path' => route('movies.index'), 'query' => $request->query()]
        );

        return view('movies.index', [
            'movies' => $movies,
            'genres' => $genres,
            'activeGenre' => $genreFilter,
            'search' => $search,
            'paginator' => $paginator,
        ]);
    }


    public function create()
    {
        return view('movies.create');
    }

    /**
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'decade' => 'nullable|string|max:255',
            'rank' => 'nullable|integer|min:1|max:10',
            'description' => 'nullable|string',
        ]);

        $movie = new Movie();
        $movie->setTitle($request->input('title'));
        $movie->setGenre($request->input('genre'));
        $movie->setDecade($request->input('decade'));
        $movie->setRank((int) $request->input('rank'));
        $movie->setDescription($request->input('description'));
        $movie->setCreatedAt(new \DateTimeImmutable());
        $movie->setUpdatedAt(new \DateTimeImmutable());

        $this->em->persist($movie);
        $this->em->flush();

        return redirect()->route('movies.show', $movie->getId())
            ->with('success', 'Movie created successfully.');
    }

    public function show(int $id)
    {
        $movie = $this->em->find(Movie::class, $id);
        if (!$movie) {
            abort(404);
        }

        return view('movies.show', compact('movie'));
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function edit(int $id)
    {
        $movie = $this->em->find(Movie::class, $id);
        if (!$movie) {
            abort(404);
        }

        return view('movies.edit', compact('movie'));
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Request $request, int $id)
    {
        $movie = $this->em->find(Movie::class, $id);
        if (!$movie) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'decade' => 'nullable|string|max:100',
            'rank' => 'integer|min:1|max:10',
            'description' => 'nullable|string|max:1000',
            'holiday' => 'nullable|string|max:100',
        ]);

        $movie->setTitle($validated['title'] ?? '');
        $movie->setGenre($validated['genre'] ?? '');
        $movie->setDecade($validated['decade'] ?? '');
        $movie->setRank($validated['rank'] ?? 10);
        $movie->setDescription($validated['description'] ?? '');
        $movie->setHoliday($validated['holiday'] ?? '');
        $movie->setUpdatedAt(new \DateTimeImmutable());

        $this->em->flush();

        return redirect()->route('movies.show', $movie->getId())
            ->with('success', 'Movie updated successfully!');
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException|\Doctrine\ORM\Exception\ORMException
     */
    public function destroy(int $id)
    {
        $movie = $this->em->find(Movie::class, $id);
        if (!$movie) {
            abort(404);
        }

        $this->em->remove($movie);
        $this->em->flush();

        return redirect()->route('movies.index')
            ->with('success', 'Movie deleted successfully!');
    }
}
