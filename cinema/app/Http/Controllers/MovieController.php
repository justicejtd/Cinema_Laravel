<?php

namespace App\Http\Controllers;

use App\Movie;
use http\Env\Response;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $movies = Movie::all();
        return response()->json($movies);

//        return response()->json([
//            'id' => $movie->id,
//            'name' => $movie->name,
//            'description' => $movie->description,
//            'date' => $movie->date,
//            'imgRef' => $movie->imgRef,
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $movie = new Movie();
        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->date = $request->date;

        if($movie->save()){
            return response()->json(array(
                'movies' => $movie->toArray()),
                200
            );
        }
        return response()->json(array(
            'status' => "data has not been inserted"
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        return response()->json(Movie::findOrFail($id));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        //
        $movie = Movie::findOrFail($id);
        $movie->name = request()->name;
        $movie->description = request()->description;
        $movie->date = request()->date;

        if($movie->save()){
            return response()->json(array(
                'movies' => $movie->toArray()),
                200
            );
        }
        return response()->json(array(
            'status' => "data has not been updated"
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $movie = Movie::findOrFail($id);
        if($movie->delete()){
            return response()->json(array(
                'status' => "movie has been deleted",
                200
            ));
        }
        return response()->json(array(
            'status' => "movie has been not deleted"
        ));
    }
}
