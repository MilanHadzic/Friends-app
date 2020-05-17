<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('/users', 'Api\UsersController@index');

    //Invites
    Route::post('/users/{receiver_id}/invites', 'Api\UserInvitesController@create'); //Create invite
    Route::get('/users/{user_id}/invites', 'Api\UserInvitesController@index'); //Get all user sent invites
    Route::get('/users/{id}/invite', 'Api\InvitesController@show'); //Get one invite

    //Get all received invites for auth user
    Route::get('/received-invites', 'Api\InvitesController@index');

    //Invites
    Route::delete('/user/{invite_id}/delete-invite', 'Api\InvitesController@destroy'); //Delete invite

    //Friends
    Route::get('/users/{user_id}/friends', 'Api\FriendsController@index'); //get all friends from certain user
    Route::post('/users/{user_id}/friends/{receiver_id}', 'Api\FriendsController@create'); //accept friend request
    Route::get('/users/{id}/friends/{user_id}', 'Api\FriendsController@show'); //get one friend
    Route::delete('/users/{id}/friends', 'Api\FriendsController@destroy'); //delete friendship
});

