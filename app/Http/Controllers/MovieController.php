<?php

namespace App\Http\Controllers;

use App\Entities\Actor;
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

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function editActors(int $id)
    {
        $movie = $this->em->find(Movie::class, $id);
        $allActors = $this->em->getRepository(Actor::class)->findAll();

        return view('movies.edit-actors', [
            'movie' => $movie,
            'allActors' => $allActors,
        ]);
    }

    public function updateActors(Request $request, int $id)
    {
        dd($request->all());
        $movie = $this->em->find(Movie::class, $id);
        $actorIds = $request->input('actors', []);

        $existingActors = $movie->getActors()->toArray();
        foreach ($existingActors as $existing) {
            $movie->removeActor($existing);
        }


        foreach ($actorIds as $actorId) {
            $actor = $this->em->find(Actor::class, $actorId);
            if ($actor) {
                $movie->addActor($actor);
            }
        }

        $this->em->flush();

        return redirect()
            ->route('movies.editActors', $movie->getId())
            ->with('success', 'Actors updated.');
    }

    public function index(Request $request)
    {
        var_dump($request->all());
        $search = $request->get('search');
        $genreFilter = $request->get('genre');
        $holidayFilter = $request->get('holiday'); // ✅ Added
        $page = max((int)$request->get('page', 1), 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $genreQuery = $this->em->createQuery('SELECT DISTINCT m.genre FROM App\Entities\Movie m WHERE m.genre IS NOT NULL');
        $genres = array_column($genreQuery->getArrayResult(), 'genre');

        $qb = $this->em->createQueryBuilder()
            ->select('DISTINCT m')
            ->from(Movie::class, 'm')
            ->leftJoin('m.actors', 'a')
            ->groupBy('m.id')
            ->orderBy('m.rating', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        if ($search) {
            $qb->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('m.title', ':search'),
                    $qb->expr()->like('m.genre', ':search')
                )
            )->setParameter('search', '%' . $search . '%');
        }


        if ($genreFilter) {
            $qb->andWhere('m.genre = :genre')
                ->setParameter('genre', $genreFilter);
        }

        if ($holidayFilter) { // ✅ Added
            $qb->andWhere('m.holiday = :holiday')
                ->setParameter('holiday', $holidayFilter);
        }

        $query = $qb->getQuery();
        $query->setHint(\Doctrine\ORM\Query::HINT_FORCE_PARTIAL_LOAD, true);
        $movies = $query->getResult();

        $countQb = $this->em->createQueryBuilder()
            ->select('COUNT(m.id)')
            ->from(Movie::class, 'm');

        if ($search) {
            $countQb->andWhere(
                $countQb->expr()->orX(
                    $qb->expr()->orX(
                        $qb->expr()->like('m.title', ':search'),
                        $qb->expr()->like('m.genre', ':search'),
                        $qb->expr()->like('m.description', ':search'),
                        $qb->expr()->like('m.holiday', ':search')
                    )
                )
            )->setParameter('search', '%' . $search . '%');
        }


        if ($genreFilter) {
            $countQb->andWhere('m.genre = :genre')
                ->setParameter('genre', $genreFilter);
        }

        if ($holidayFilter) { // ✅ Added
            $countQb->andWhere('m.holiday = :holiday')
                ->setParameter('holiday', $holidayFilter);
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
            'holiday' => $holidayFilter, // ✅ Added
            'paginator' => $paginator,
        ]);
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'decade' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:100',
            'description' => 'nullable|string',
        ]);
        $actorNames = $request->input('actor_names', []);

        $movie = new Movie();
        $movie->setTitle($request->input('title'));
        $movie->setGenre($request->input('genre'));
        $movie->setDecade($request->input('decade'));
        $movie->setRating((int)$request->input('rating'));
        $movie->setDescription($request->input('description'));
        $movie->setCreatedAt(new \DateTimeImmutable());
        $movie->setUpdatedAt(new \DateTimeImmutable());

        foreach ($actorNames as $name) {
            $trimmed = trim($name);
            if ($trimmed === '') {
                continue;
            }

            $actor = new Actor();
            $actor->setName($trimmed);
            $movie->addActor($actor);
            $this->em->persist($actor);
        }

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

    public function edit(int $id)
    {
        $movie = $this->em->getRepository(Movie::class)->find($id);

        if (!$movie) {
            abort(404);
        }

        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, int $id)
    {
        $movie = $this->em->find(Movie::class, $id);
        if (!$movie) {
            abort(404);
        }
        $request->merge([
            'actor_names' => array_filter(
                $request->input('actor_names', []),
                fn($name) => is_string($name) && trim($name) !== ''
            )
        ]);
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'decade' => 'nullable|string|max:100',
            'rating' => 'nullable|integer|min:1|max:100',
            'description' => 'nullable|string|max:1000',
            'holiday' => 'nullable|string|max:100',
            'actor_ids' => 'nullable|array',
            'actor_ids.*' => 'integer|exists:actors,id',
            'actor_names' => 'nullable|array',
            'actor_names.*' => 'string|max:255',
        ]);

        $movie->setTitle($data['title'] ?? null);
        $movie->setGenre($data['genre'] ?? null);
        $movie->setDecade($data['decade'] ?? null);
        $movie->setRating($data['rating'] ?? null);
        $movie->setDescription($data['description'] ?? null);
        $movie->setHoliday($data['holiday'] ?? null);
        $movie->setUpdatedAt(new \DateTimeImmutable());

        foreach ($movie->getActors() as $existing) {
            $movie->removeActor($existing);
        }

        if (!empty($data['actor_ids'])) {
            foreach ($data['actor_ids'] as $actorId) {
                $actor = $this->em->find(Actor::class, $actorId);
                if ($actor) {
                    $movie->addActor($actor);
                }
            }
        }

        if (!empty($data['actor_names'])) {
            foreach ($data['actor_names'] as $name) {
                $trimmed = trim($name);
                if ($trimmed === '') {
                    continue;
                }

                $actor = new Actor();
                $actor->setName($trimmed);
                $movie->addActor($actor);
                $this->em->persist($actor);
            }
        }

        $this->em->flush();

        return redirect()
            ->route('movies.index')
            ->with('success', 'Movie and actors updated successfully.');
    }

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





