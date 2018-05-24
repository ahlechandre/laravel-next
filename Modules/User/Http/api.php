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

Route::middleware('auth:api')
    ->group(function () {
        Route::get('/users', function () {
            $rand1 = rand(1, 10);
            $rand2 = rand(11, 20);
            $rand3 = rand(21, 30);
            $rand4 = rand(31, 40);
            $users = [
                [
                    'id' => $rand1,
                    'name' => 'User Nome' . $rand1,
                ],
                [
                    'id' => $rand2,
                    'name' => 'User Nome' . $rand2,
                ],
                [
                    'id' => $rand3,
                    'name' => 'User Nome' . $rand3,
                ],
                [
                    'id' => $rand4,
                    'name' => 'User Nome' . $rand4,
                ],
                [
                    'id' => $rand1,
                    'name' => 'User Nome' . $rand1,
                ],
                [
                    'id' => $rand2,
                    'name' => 'User Nome' . $rand2,
                ],
                [
                    'id' => $rand3,
                    'name' => 'User Nome' . $rand3,
                ],
                [
                    'id' => $rand4,
                    'name' => 'User Nome' . $rand4,
                ],                                
            ];
        
            return response()->json($users);
        });        
    });