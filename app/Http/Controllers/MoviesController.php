<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Transformers\MovieTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return fractal(Movie::all(), new MovieTransformer())
            ->respond(200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::toUSer(JWTAuth::getToken());

        $movie = $user->movies()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return fractal($movie, new MovieTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $movie = Movie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found']);

        }
        return fractal($movie, new MovieTransformer());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $movie = Movie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found']);

        }

        $user = JWTAuth::toUSer(JWTAuth::getToken());
        if ($user->id !== $movie->user_id) {
            return response()->json(['error' => 'Uauthenticated'],401);
        }
        $movie->title = $request->title;
        $movie->description = $request->description;
        $movie->save();

        return fractal($movie, new MovieTransformer());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $movie = Movie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found']);

        }

        $user = JWTAuth::toUSer(JWTAuth::getToken());
        if ($user->id !== $movie->user_id) {
            return response()->json(['error' => 'Uauthenticated'],401);
        }


        $movie->delete();
        return response()->json(['status'=>true],200);


    }
}











