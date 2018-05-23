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
Route::get('/users', function () {
    $rand1 = rand(1, 10);
    $rand2 = rand(11, 20);
    $users = [
        [
            'id' => $rand1,
            'text' => 'User Nome' . $rand1,
        ],
        [
            'id' => $rand2,
            'text' => 'User Nome' . $rand2,
        ],
    ];

    return response()->json([]);
});        

Route::middleware('auth:api')
    ->group(function () {
    });