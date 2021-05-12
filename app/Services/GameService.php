<?php


namespace App\Services;


use App\Contracts\GameContract;
use App\Exceptions\Api\GameCreateException;
use App\Exceptions\Games\GameDeleteException;
use App\Models\Game;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class GameService implements GameContract
{

    /**
     * @param array $game
     * @return Game
     * @throws GameCreateException
     */
    public function create(array $game): Game
    {
        try{
            return Game::create($game);
        }catch (Exception $exception){
            throw new GameCreateException("Filed to create game", 422, $exception);
        }
    }

    /**
     * @return Collection
     */
    public function games(): Collection
    {
        return Game::all();
    }

    /**
     * @param array $game
     * @return Game
     */
    public function edit(array $game): Game
    {
        // TODO: Implement edit() method.
    }

    /**
     * @param int $gameId
     * @return bool
     * @throws GameDeleteException
     */
    public function delete(int $gameId): bool
    {
        try{
            Game::whereId($gameId)->delete();

            return true;
        }catch (Exception $exception){
            throw new GameDeleteException("Filed to delete game", 422, $exception);
        }
    }
}