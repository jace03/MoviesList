<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $movies = [
            // Halloween titles
            ['title' => 'Hocus Pocus',                 'genre' => 'Fantasy/Comedy',        'decade' => '1990s', 'holiday' => 'Halloween', 'rating' => rand(1,5)],
            ['title' => 'Hocus Pocus 2',               'genre' => 'Fantasy/Comedy',        'decade' => '2020s', 'holiday' => 'Halloween', 'rating' => rand(1,5)],
            ['title' => 'Hubie Halloween',             'genre' => 'Comedy',                'decade' => '2020s', 'holiday' => 'Halloween', 'rating' => rand(1,5)],
            ['title' => 'Locke & Key',                 'genre' => 'Fantasy/Horror',        'decade' => '2020s', 'holiday' => 'Halloween', 'rating' => rand(1,5)],
            ['title' => 'The Office Halloween Episode','genre' => 'Comedy/TV',             'decade' => '2000s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Brooklyn Nine-Nine Heists',   'genre' => 'Comedy/TV',             'decade' => '2010s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Zombieland',                  'genre' => 'Comedy/Horror',         'decade' => '2000s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'The Craft',                   'genre' => 'Supernatural/Thriller', 'decade' => '1990s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'The Craft: Legacy',           'genre' => 'Supernatural/Thriller', 'decade' => '2020s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Beetlejuice',                 'genre' => 'Fantasy/Comedy',        'decade' => '1980s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Beetlejuice Beetlejuice',     'genre' => 'Fantasy/Comedy',        'decade' => '2020s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Queen of the Damned',         'genre' => 'Horror/Vampire',        'decade' => '2000s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Interview with the Vampire',  'genre' => 'Gothic Horror',         'decade' => '1990s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Goosebumps',                  'genre' => 'Family/Horror',         'decade' => '2010s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Goosebumps 2: Haunted Halloween','genre'=>'Family/Horror',         'decade' => '2010s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Casper',                      'genre' => 'Fantasy/Family',        'decade' => '1990s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Bewitched',                   'genre' => 'Fantasy/Rom-Com',       'decade' => '2000s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Fright Night',                'genre' => 'Horror/Vampire',        'decade' => '1980s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Hotel Transylvania',          'genre' => 'Family/Comedy',         'decade' => '2010s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Hotel Transylvania 2',        'genre' => 'Family/Comedy',         'decade' => '2010s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],
            ['title' => 'Hotel Transylvania 3',        'genre' => 'Family/Comedy',         'decade' => '2010s', 'holiday' => 'Halloween', 'rating' => rand(1,10)],

            // Christmas titles
            ['title' => 'The Grinch',                  'genre' => 'Family/Comedy',        'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 1],
            ['title' => 'Elf',                         'genre' => 'Comedy/Family',        'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 2],
            ['title' => 'Four Christmases',            'genre' => 'Rom-Com',              'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 3],
            ['title' => 'The Night Before',            'genre' => 'Comedy',               'decade' => '2010s', 'holiday' => 'Christmas', 'rating' => 4],
            ['title' => 'Jack Frost',                  'genre' => 'Family/Fantasy',       'decade' => '1990s', 'holiday' => 'Christmas', 'rating' => 5],
            ['title' => "I'll Be Home for Christmas",  'genre' => 'Family/Comedy',        'decade' => '1990s', 'holiday' => 'Christmas', 'rating' => 6],
            ['title' => 'Home Alone 1',                'genre' => 'Family/Comedy',        'decade' => '1990s', 'holiday' => 'Christmas', 'rating' => 7],
            ['title' => 'Home Alone 2',                'genre' => 'Family/Comedy',        'decade' => '1990s', 'holiday' => 'Christmas', 'rating' => 8],
            ['title' => 'Fred Claus',                  'genre' => 'Comedy',               'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 9],
            ['title' => 'The Santa Clause 1',          'genre' => 'Family/Fantasy',       'decade' => '1990s', 'holiday' => 'Christmas', 'rating' => 10],
            ['title' => 'The Santa Clause 2',          'genre' => 'Family/Fantasy',       'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 11],
            ['title' => 'Exmas',                       'genre' => 'Rom-Com',              'decade' => '2020s', 'holiday' => 'Christmas', 'rating' => 12],
            ['title' => 'Jack in Time',                'genre' => 'Fantasy/Comedy',       'decade' => '2020s', 'holiday' => 'Christmas', 'rating' => 13],
            ['title' => 'Bad Moms 2',                  'genre' => 'Comedy',               'decade' => '2010s', 'holiday' => 'Christmas', 'rating' => 14],
            ['title' => 'Why Him',                     'genre' => 'Comedy',               'decade' => '2010s', 'holiday' => 'Christmas', 'rating' => 15],
            ['title' => 'The Holiday',                 'genre' => 'Rom-Com',              'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 16],
            ['title' => 'Love Actually',               'genre' => 'Rom-Com',              'decade' => '2000s', 'holiday' => 'Christmas', 'rating' => 17],
            ['title' => 'Office Christmas Party',      'genre' => 'Comedy',               'decade' => '2010s', 'holiday' => 'Christmas', 'rating' => 18],
            ['title' => 'Hot Frosty',                  'genre' => 'Comedy/Fantasy',       'decade' => '2020s', 'holiday' => 'Christmas', 'rating' => 19],
            ['title' => 'Holidate',                   'genre' => 'Rom-Com',              'decade' => '2020s', 'holiday' => 'Christmas', 'rating' => 20],
            ['title' => 'Family Switch',               'genre' => 'Family/Comedy',        'decade' => '2020s', 'holiday' => 'Christmas', 'rating' => 21],
        ];

        // Attach created_at & updated_at to every record
        foreach ($movies as &$item) {
            $created = $now->copy()->subDays(rand(30, 365));
            $item['created_at'] = $created->toDateTimeString();
            $item['updated_at'] = $created->copy()->addDays(rand(0, 29))->toDateTimeString();
        }
        unset($item);

        DB::table('movies')->insert($movies);
    }
}
