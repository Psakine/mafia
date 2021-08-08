<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
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
Route::group(
    ['middleware' => ['jsonify']],
    function ($router) {
        Route::post('/file/upload', [FileController::class, 'upload']);
        Route::post('/file/delete', [FileController::class, 'delete']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::prefix('games')->group(
            function () {
                Route::get('/last-players', [GamesController::class, 'getCurrentPlayers']);
                Route::get('/last-game', [GamesController::class, 'getCurrentGame']);
                Route::post('/create', [GamesController::class, 'create']);
                Route::post('/edit', [GamesController::class, 'edit']);
                Route::post('/delete', [GamesController::class, 'delete']);
                Route::post('/add-player', [GamesController::class, 'addPlayer']);
                Route::post('/edit-player', [GamesController::class, 'editPlayer']);
                Route::post('/delete-player', [GamesController::class, 'deletePlayer']);
            }
        );
        Route::prefix('players')->group(
            function () {
                Route::get('/', [PlayersController::class, 'players']);
                Route::post('/create', [PlayersController::class, 'create']);
                Route::post('/edit', [PlayersController::class, 'edit']);
                Route::post('/delete', [PlayersController::class, 'delete']);
            }
        );
    }
);
