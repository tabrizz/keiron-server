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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Api\AuthController@login');

Route::resource('users', 'UserController', [
    'only' => ['index', 'show']
]);
Route::resource('tickets', 'TicketController', [
    'except' => ['create', 'edit']
]);
Route::get('tickets/user/{id}', 'TicketController@byUser');
Route::resource('user-types', 'UserTypeController');

Route::middleware(['auth:api'])->group(function () {
    
    Route::post('/logout', 'Api\AuthController@logout');
});