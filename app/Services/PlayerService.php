<?php
namespace App\Services;

use App\Contracts\PlayerContract;
use App\Models\Player;
use Illuminate\Support\Collection;

class PlayerService implements PlayerContract
{

    public function create(array $data): int
    {
        $player = Player::create();
    }

    /**
     * @return Collection
     */
    public function players(): Collection
    {
        return Player::all();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function player(int $id): Collection
    {
        return Player::where('id', $id)->get();
    }
}