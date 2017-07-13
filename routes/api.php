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
    return ['name'=>'ahmed'];
//    return $request->user();
})->middleware('jwt.auth');

Route::post('/authenticate',[
    'uses'=>'ApiAuthController@authentificate'
]);

Route::post('/register',[
    'uses'=>'ApiAuthController@register'
]);











