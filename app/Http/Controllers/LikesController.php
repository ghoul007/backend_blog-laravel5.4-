<?php

namespace App\Http\Controllers;

use App\Like;
use App\Movie;
use App\Transformers\MovieTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class LikesController extends Controller
{
    public function like()
    {
        $user = JWTAuth::toUser(JWTAuth::getToken());
        $movie_id = request('movie_id');

        try {
            $movie = Movie::findOrFail($movie_id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Movie not found']);
        }

        Like::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id
        ]);

        return fractal($movie, new MovieTransformer());

//        if ($user->id !== $movie->user_id) {
//            return response()->json(['error' => 'Uauthenticated'],401);
//        }

    }

    public function unlike()
    {


    }


}
