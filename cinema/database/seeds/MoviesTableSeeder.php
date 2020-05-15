<?php

use App\Actor;
use App\Movie;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class MoviesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     $arrImgRef = array("shazam.jpg", "toyStory.jpg", "alita.jpg", "dragon.jpg");
     $arrActors = array("Daniel Radcliffe","Michael Gambon","Ralph Fiennes");
     $arrName = array("Shazam", "Toy Story 4","Alita: Battle Angel", "How To Train Your Dragon: The Hidden World");
     $arrDescription = array("Shazam! is an upcoming American superhero film based on the DC Comics character Captain Marvel (DC Comics).",
             "Toy Story 4 is an upcoming American 3D computer-animated comedy film produced by Pixar Animation Studios for Walt Disney Pictures.",
             "Alita: Battle Angel is a 2019 American cyberpunk action film based on the 1990s Japanese manga series Gunnm (also known as Battle Angel Alita in the English translation) by Yukito Kishiro. ",
             "When Hiccup discovers Toothless isn't the only Night Fury, he must seek 'The Hidden World', a secret Dragon Utopia before a hired tyrant named Grimmel finds it first.");



        //DB::table('movies')->Delete();
        Movie::truncate();
        for($i=0;$i<count($arrName);$i++)
        {
            $movie = new Movie;
            $movie->name = $arrName[$i];
            $movie->description = $arrDescription[$i];
            $movie->date = self::generateRandomDate()->addWeeks(rand(1, 52))->format('Y-m-d');
            $movie->imgRef = $arrImgRef[$i];
            $movie->save();
            // 'actors'=>Str::random(10)
        }
        //DB::table('actors')->Delete();
        Actor::truncate();
        for($i=0;$i<count($arrActors);$i++)
        {
        $actor = new Actor;
        $actor->name = $arrActors[$i];
        $actor->movies = ("{$arrName[$i]}, {$arrName[$i+1]}");
        $actor->save();
        }
    }

    public function generateRandomDate():Carbon
    {
        $year = rand(2019, 2020);
        $month = rand(1, 12);
        $day = rand(1, 28);
        return $date = Carbon::create($year,$month ,$day , 0, 0, 0); // PHP API extension for DateTime
        //Carbon::now() - will diplay current date
    }

}
