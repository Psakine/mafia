<?php

namespace App\Services;

use App\Contracts\GameContract;
use App\Exceptions\Api\Games\GameCreateException;
use App\Exceptions\Api\Games\GameDeleteException;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\Player;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class GameService implements GameContract
{

    /**
     * @var Game
     */
    protected $game;

    /**
     * GameService constructor.
     *
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * @param array $game
     * @return Game
     * @throws GameCreateException
     */
    public function create(array $game): Game
    {
        try {
            return $this->game->create($game);
        } catch (Exception $exception) {
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
     * @param int $id
     * @param array $data
     * @return int
     */
    public function edit(int $id, array $data): int
    {
        Game::where('id', $id)->update(['name' => $data['game']['name']]);
        $players = $data['game']['players'];

        $gamePlayers = GamePlayer::where('game_id', $id)->get();

        $gamePlayers->each(
            function ($item) {
                $item->delete();
            }
        );

        foreach ($players as $player) {
            GamePlayer::create(
                [
                    'game_id'   => $id,
                    'player_id' => $player['id'],
                    'role'      => $player['role'],
                    'status'    => $player['status'],
                    'place'     => $player['place']
                ]
            );
        }

        return $id;
    }

    /**
     * @param int $gameId
     * @return bool
     * @throws GameDeleteException
     */
    public function delete(int $gameId): bool
    {
        try {
            Game::whereId($gameId)->delete();

            return true;
        } catch (Exception $exception) {
            throw new GameDeleteException("Filed to delete game", 422, $exception);
        }
    }

    /**
     * @return Collection
     */
    public function getCurrentPlayers(): Collection
    {
        $gameId = Game::orderBy('id', 'desc')->limit(1)->first()->id;

        return GamePlayer::where('game_id', $gameId)->with('player')->get()->sortBy('place');
    }

    /**
     * @return Game
     */
    public function getCurrentGame(): Game
    {
        return Game::orderBy('id', 'desc')->limit(1)->first();
    }

    /**
     * @param int $id
     * @return array
     */
    public function game(int $id): array
    {
        return [
            'game'       => Game::where(['id' => $id])->first(),
            'players'    => GamePlayer::where('game_id', $id)->with('player')->get()->sortBy('place'),
            'allPlayers' => Player::all(),
            'roles'      => array_flip(GamePlayer::ROLES),
            'statuses'   => array_flip(GamePlayer::STATUS)
        ];
    }

    /**
     * @param array $data
     * @return int
     */
    public function createGameWithPlayers(array $data): int
    {
        $game = Game::create(['name' => $data['game']['name']]);

        foreach ($data['game']['players'] as $player) {
            GamePlayer::create(
                [
                    'game_id'   => $game->id,
                    'player_id' => $player['id'],
                    'role'      => $player['role'],
                    'status'    => $player['status'],
                    'place'     => $player['place']
                ]
            );
        }

        return $game->id;
    }
}