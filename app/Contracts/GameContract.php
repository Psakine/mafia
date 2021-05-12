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
     * @param array $game
     * @return Game
     */
    public function edit(array $game): Game;

    /**
     * @param int $gameId
     * @return bool
     */
    public function delete(int $gameId): bool;
}