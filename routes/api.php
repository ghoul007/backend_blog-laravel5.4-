<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//middleware('auth:api')->
Route::get('/user', function (Request $request) {

    $token = \Tymon\JWTAuth\Facades\JWTAuth::getToken();

    $user= \Tymon\JWTAuth\Facades\JWTAuth::toUser($token);

    return $user;
//    return $request->user();
})->middleware('jwt.auth');




Route::post('/authenticate',[
    'uses'=>'ApiAuthController@authentificate'
]);

Route::post('/register',[
    'uses'=>'ApiAuthController@register'
]);


Route::get('/movies',function (){
// return \App\Movie::all();
 return fractal(\App\Movie::all(), new \App\Transformers\MovieTransformer());
})->middleware('jwt.auth');


Route::post('/like',[
    'uses'=>'LikesController@like'
]);

Route::post('/unlike',[
    'uses'=>'LikesController@unlike'
]);

Route::resource('/actors','ActorsController');
Route::resource('/movies','MoviesController');


















