<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Movie;
use App\Repositories\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    private MovieRepository $movieRepository;
    private EntityManagerInterface $em;

    public function __construct(MovieRepository $movieRepository, EntityManagerInterface $em)
    {
        $this->movieRepository = $movieRepository;
        $this->em = $em;
    }


    public function index()
    {
        $movies = $this->em->getRepository(\App\Entities\Movie::class)->findAll();

        return view('movies.index', compact('movies'));
    }



    public function show(int $id): JsonResponse
    {
        $movie = $this->movieRepository->find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }

    public function orderByRating(string $rating): JsonResponse
    {
        $order = strtolower($rating) === 'desc' ? 'DESC' : 'ASC';

        $movies = $this->movieRepository->findAllOrderedByRating($order);

        if (!$movies) {
            return response()->json(['error' => 'No movies found'], 404);
        }

        return response()->json($movies);
    }

    public function ratingList(string $dire) : JsonResponse
    {
        $movies = $this->movieRepository->findBy([], ['rating' => 'DESC']);
        return response()->json([
            'sorted' => true,
            'count' => count($movies),
            'movies' => $movies
        ]);
    }

//    public function store(Request $request): JsonResponse
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'category' => 'required|string|max:255',
//            'holiday' => 'nullable|string|max:255',
//            'rating' => 'required|integer',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()], 422);
//        }
//
//        // Only get validated data if validation passes
//        $validated = $validator->validated();
//
//        $movie = new Movie();
//        $movie->setName($validated['name']);
//        $movie->setCategory($validated['category']);
//        $movie->setHoliday($validated['holiday'] ?? null);
//        $movie->setrating($validated['rating']);
//
//        $this->em->persist($movie);
//        $this->em->flush();
//
//        return response()->json([
//            'message' => 'Movie created!',
//            'id' => $movie->getId(),
//        ], 201);
//    }
//
//    public function update(Request $request, int $id): JsonResponse
//    {
//        $movie = $this->movieRepository->find($id);
//
//        if (!$movie) {
//            return response()->json(['error' => 'Movie not found'], 404);
//        }
//
//        // Update only the fields that are provided
//        if ($request->has('name')) {
//            $movie->setName($request->input('name'));
//        }
//        if ($request->has('category')) {
//            $movie->setCategory($request->input('category'));
//        }
//        if ($request->has('holiday')) {
//            $movie->setHoliday($request->input('holiday'));
//        }
//        if ($request->has('rating')) {
//            $movie->setrating((int) $request->input('rating'));
//        }
//
//        $this->em->flush();
//
//        return response()->json($movie);
//    }

    public function destroy(int $id): JsonResponse
    {
        $movie = $this->movieRepository->find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        $this->em->remove($movie);
        $this->em->flush();

        return response()->json(null, 204);
    }
}
