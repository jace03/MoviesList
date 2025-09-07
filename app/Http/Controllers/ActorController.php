<?php

namespace App\Http\Controllers;

use App\Entities\Actor;
use App\Entities\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ActorController extends Controller
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


//    public function store(Request $request, EntityManagerInterface $em)
//    {
//        $movie = $em->getRepository(Movie::class)->find($request->input('movie_id'));
//
//        if (!$movie) {
//            return response()->json(['error' => 'Movie not found'], 404);
//        }
//
//        $actor = new Actor();
//        $actor->setName($request->input('name'));
//        $actor->setMovie($movie);
//
//        $em->persist($actor);
//        $em->flush();
//
//        return response()->json(['success' => true, 'actor_id' => $actor->getId()]);
//    }
    public function bulkStore(Request $request)
    {
        $movieId = $request->input('movie_id');
        $names = $request->input('actors', []);

        $movie = $this->em->getRepository(Movie::class)->find($movieId);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        foreach ($names as $name) {
            $actor = new Actor();
            $actor->setName($name);
            $actor->addMovie($movie);

            $this->em->persist($actor);
        }

        $this->entityManager->flush();

        return response()->json(['success' => true]);
    }

}
