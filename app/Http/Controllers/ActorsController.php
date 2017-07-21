<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Movie;
use App\Transformers\ActorTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return fractal(Actor::all(), new ActorTransformer())
            ->respond(200);

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::toUser(JWTAuth::getToken());
        $movie_id = $request->movie_id;
        $movie = DB::table('movies')->where('id', $movie_id)->first();
        $actor = new Actor();
        $actor->name = $request->name;
        $actor->age = $request->age;
        $actor->save();
        $actor->movies()->attach($movie);
        return fractal($actor, new ActorTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            $actor = Actor::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Actor not found']);

        }

        $user = JWTAuth::toUSer(JWTAuth::getToken());
        if (!$user->id) {
            return response()->json(['error' => 'Uauthenticated'],401);
        }
        $actor->name = $request->name;
        $actor->age = $request->age;
        $actor->save();

        return fractal($actor, new ActorTransformer());
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
            $actor = Actor::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Actor not found']);

        }

        $user = JWTAuth::toUSer(JWTAuth::getToken());
        if (!$user->id) {
            return response()->json(['error' => 'Uauthenticated'],401);
        }


        $actor->delete();
        return response()->json(['status'=>true],200);

    }
}
