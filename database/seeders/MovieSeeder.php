<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Hocus Pocus',
                'genre' => 'Fantasy/Comedy',
                'decade' => '1990s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Hocus Pocus 2',
                'genre' => 'Fantasy/Comedy',
                'decade' => '2020s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Hubie Halloween',
                'genre' => 'Comedy',
                'decade' => '2020s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Locke & Key',
                'genre' => 'Fantasy/Horror',
                'decade' => '2020s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'The Office Halloween Episode',
                'genre' => 'Comedy/TV',
                'decade' => '2000s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Brooklyn Nine-Nine Heists',
                'genre' => 'Comedy/TV',
                'decade' => '2010s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Zombieland',
                'genre' => 'Comedy/Horror',
                'decade' => '2000s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'The Craft',
                'genre' => 'Supernatural/Thriller',
                'decade' => '1990s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'The Craft: Legacy',
                'genre' => 'Supernatural/Thriller',
                'decade' => '2020s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Beetlejuice',
                'genre' => 'Fantasy/Comedy',
                'decade' => '1980s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Beetlejuice Beetlejuice',
                'genre' => 'Fantasy/Comedy',
                'decade' => '2020s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Queen of the Damned',
                'genre' => 'Horror/Vampire',
                'decade' => '2000s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Interview with the Vampire',
                'genre' => 'Gothic Horror',
                'decade' => '1990s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Goosebumps',
                'genre' => 'Family/Horror',
                'decade' => '2010s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Goosebumps 2: Haunted Halloween',
                'genre' => 'Family/Horror',
                'decade' => '2010s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Casper',
                'genre' => 'Fantasy/Family',
                'decade' => '1990s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Bewitched',
                'genre' => 'Fantasy/Rom-Com',
                'decade' => '2000s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Fright Night',
                'genre' => 'Horror/Vampire',
                'decade' => '1980s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Hotel Transylvania',
                'genre' => 'Family/Comedy',
                'decade' => '2010s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Hotel Transylvania 2',
                'genre' => 'Family/Comedy',
                'decade' => '2010s',
                'holiday' => 'Halloween',
            ],
            [
                'title' => 'Hotel Transylvania 3',
                'genre' => 'Family/Comedy',
                'decade' => '2010s',
                'holiday' => 'Halloween',
            ],

            [
                'title' => 'The Grinch',
                'genre' => 'Family/Comedy',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 1,
            ],
            [
                'title' => 'Elf',
                'genre' => 'Comedy/Family',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 2,
            ],
            [
                'title' => 'Four Christmases',
                'genre' => 'Rom-Com',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 3,
            ],
            [
                'title' => 'The Night Before',
                'genre' => 'Comedy',
                'decade' => '2010s',
                'holiday' => 'Christmas',
                'rank' => 4,
            ],
            [
                'title' => 'Jack Frost',
                'genre' => 'Family/Fantasy',
                'decade' => '1990s',
                'holiday' => 'Christmas',
                'rank' => 5,
            ],
            [
                'title' => "I'll Be Home for Christmas",
                'genre' => 'Family/Comedy',
                'decade' => '1990s',
                'holiday' => 'Christmas',
                'rank' => 6,
            ],
            [
                'title' => 'Home Alone 1',
                'genre' => 'Family/Comedy',
                'decade' => '1990s',
                'holiday' => 'Christmas',
                'rank' => 7,
            ],
            [
                'title' => 'Home Alone 2',
                'genre' => 'Family/Comedy',
                'decade' => '1990s',
                'holiday' => 'Christmas',
                'rank' => 8,
            ],
            [
                'title' => 'Fred Claus',
                'genre' => 'Comedy',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 9,
            ],
            [
                'title' => 'The Santa Clause 1',
                'genre' => 'Family/Fantasy',
                'decade' => '1990s',
                'holiday' => 'Christmas',
                'rank' => 10,
            ],
            [
                'title' => 'The Santa Clause 2',
                'genre' => 'Family/Fantasy',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 11,
            ],
            [
                'title' => 'Exmas',
                'genre' => 'Rom-Com',
                'decade' => '2020s',
                'holiday' => 'Christmas',
                'rank' => 12,
            ],
            [
                'title' => 'Jack in Time',
                'genre' => 'Fantasy/Comedy',
                'decade' => '2020s',
                'holiday' => 'Christmas',
                'rank' => 13,
            ],
            [
                'title' => 'Bad Moms 2',
                'genre' => 'Comedy',
                'decade' => '2010s',
                'holiday' => 'Christmas',
                'rank' => 14,
            ],
            [
                'title' => 'Why Him',
                'genre' => 'Comedy',
                'decade' => '2010s',
                'holiday' => 'Christmas',
                'rank' => 15,
            ],
            [
                'title' => 'The Holiday',
                'genre' => 'Rom-Com',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 16,
            ],
            [
                'title' => 'Love Actually',
                'genre' => 'Rom-Com',
                'decade' => '2000s',
                'holiday' => 'Christmas',
                'rank' => 17,
            ],
            [
                'title' => 'Office Christmas Party',
                'genre' => 'Comedy',
                'decade' => '2010s',
                'holiday' => 'Christmas',
                'rank' => 18,
            ],
            [
                'title' => 'Hot Frosty',
                'genre' => 'Comedy/Fantasy',
                'decade' => '2020s',
                'holiday' => 'Christmas',
                'rank' => 19,
            ],
            [
                'title' => 'Holidate',
                'genre' => 'Rom-Com',
                'decade' => '2020s',
                'holiday' => 'Christmas',
                'rank' => 20,
            ],
            [
                'title' => 'Family Switch',
                'genre' => 'Family/Comedy',
                'decade' => '2020s',
                'holiday' => 'Christmas',
                'rank' => 21,
            ],
        ];

        DB::table('movies')->insert($movies);
    }

}
