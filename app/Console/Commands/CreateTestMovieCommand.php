<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Entities\Movie;
use Doctrine\ORM\EntityManagerInterface;

class CreateTestMovieCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-movie-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle(EntityManagerInterface $em)
    {
        $movie = new Movie();
        $movie->setName('Test Movie');
        $movie->setCategory('Comedy');
        $movie->setHoliday('Christmas');
        $movie->setRank(1);

        $em->persist($movie);
        $em->flush();

        $this->info('Test movie created with ID: ' . $movie->getId());
    }

}

