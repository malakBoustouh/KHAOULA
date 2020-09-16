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
Route::prefix('v1')->group(function(){
    Route::post('login', 'Api\AuthentifController@login');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('getUser', 'Api\AuthController@getUser');
    });
});

Route::group([ 'prefix' => 'auth'], function (){
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'APII\AuthController@login');
        Route::post('signup', 'APII\AuthController@signup');
    });});


//login
Route::post('login','Api\AuthController@login');
//out
Route::get('logout','Api\AuthController@logout');


//NotificationTraite
//parentt
Route::post('users/update','Api\UsersController@update')->middleware('auth:api');
//Route::post('users/update','Api\UsersController@update')->middleware('jwtAuth');
Route::post('users/parents','Api\UsersController@parents')->middleware('auth:api');
//Route::post('users/parents','Api\UsersController@parents')->middleware('jwtAuth');
//seancetraitement
Route::post('users/seance','Api\SeancetraitementsController@seancetraitements')->middleware('auth:api');
//Route::post('users/seance','Api\SeancetraitementsController@seancetraitements')->middleware('jwtAuth');
//pratiques
Route::post('pratiques/create','Api\PratiquesController@create')->middleware('auth:api');
//Route::post('pratiquess/create','Api\PratiquesController@create')->middleware('jwtAuth');
//remarques
Route::post('remarques/create','Api\RemarquesController@create')->middleware('auth:api');
//Route::post('remarques/create','Api\RemarquesController@create')->middleware('jwtAuth');
//notification
Route::post('notifications/show','Api\NotificationsController@show')->middleware('auth:api');
//Route::post('remarques/create','Api\RemarquesController@create')->middleware('jwtAuth');












//Route::post('login', 'Api\Auth\LoginController@login');
//Route::post('refresh', 'Api\Auth\LoginController@refresh');



Route::post('register','Api\AuthController@register');

Route::post('register', 'Api\Auth\RegisteController@register');

Route::post('login', 'Api\Auth\RegisteController@login');

//Route::post('register', 'Api\Auth\RegisterController@register');
/*Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');*/
Route::post('social_auth', 'Api\Auth\SocialAuthController@socialAuth');
Route::post('save_user_info','Api\AuthController@saveUserInfo')->middleware('jwtAuth');
//like
Route::post('posts/like','Api\LikesController@like')->middleware('jwtAuth');
