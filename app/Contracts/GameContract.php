<?php

namespace App\Contracts;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

interface GameContract
{
    /**
     * @param array $game
     * @return Game
     */
    public function create(array $game): Game;

    /**
     * @return Collection
     */
    public function games(): Collection;

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function edit(int $id, array $data): int;

    /**
     * @param int $gameId
     * @return bool
     */
    public function delete(int $gameId): bool;

    /**
     * @return Game
     */
    public function getCurrentGame(): Game;

    /**
     * @param int $id
     * @return array
     */
    public function game(int $id): array ;

    /**
     * @param array $data
     * @return int
     */
    public function createGameWithPlayers(array $data): int;

    /**
     * @return Collection
     */
    public function getCurrentPlayers(): Collection;
}