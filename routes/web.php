<?php

use App\Http\Controllers\Web\GamesController;
use App\Http\Controllers\Web\PlayersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return redirect('games');
});
Route::get('/game', function (){
    return view('front.game');
});
Route::prefix('/games')->name('games')->group(function (){
    Route::get('/', [GamesController::class, 'games']);
    Route::get('create', [GamesController::class, 'create'])->name('.create');
    Route::post('store', [GamesController::class, 'store'])->name('.store');
    Route::get('{id}', [GamesController::class, 'game'])->name('.game');
    Route::get('delete/{id}', [GamesController::class, 'delete'])->name('.delete');
    Route::get('edit/{id}', [GamesController::class, 'edit'])->name('.edit');
    Route::post('update/{id}', [GamesController::class, 'update'])->name('.update');
});

Route::prefix('/players')->name('players')->group(function (){
    Route::get('/', [PlayersController::class, 'players']);
    Route::get('create', [PlayersController::class, 'create'])->name('.create');
    Route::post('store', [PlayersController::class, 'store'])->name('.store');
    Route::get('{id}', [PlayersController::class, 'player'])->name('.player');
    Route::get('delete/{id}', [PlayersController::class, 'delete'])->name('.delete');
    Route::get('edit/{id}', [PlayersController::class, 'edit'])->name('.edit');
    Route::post('update/{id}', [PlayersController::class, 'update'])->name('.update');
});
