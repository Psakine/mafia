<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GamesController;
use App\Http\Controllers\Api\PlayersController;
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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
Route::group(['middleware' => ['jsonify']], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/players', [PlayersController::class, 'players']);
    Route::group(['middleware' => ['auth']], function(){
        Route::get('/games', [GamesController::class, 'games']);
        Route::post('/create-game', [GamesController::class, 'create']);
        Route::post('/edit-game', [GamesController::class, 'edit']);
        Route::post('/delete-game', [GamesController::class, 'delete']);
        Route::post('/add-player', [PlayersController::class, 'addPlayer']);
        Route::post('/edit-player', [PlayersController::class, 'editPlayer']);
        Route::post('/delete-player', [PlayersController::class, 'deletePlayer']);
        Route::post('/add-player-to-game', [GamesController::class, 'addPlayerToGame']);
        Route::post('/edit-player-at-game', [GamesController::class, 'editPlayerAtGame']);
        Route::post('/delete-player-from-game', [GamesController::class, 'deletePlayerFromGame']);
    });
});
