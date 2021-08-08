<?php

namespace App\Services;

use App\Contracts\PlayerContract;
use App\Http\Requests\Players\PlayerCreateRequest;
use App\Models\Player;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PlayerService implements PlayerContract
{

    use FileTrait;

    /**
     * @param PlayerCreateRequest $request
     * @return int
     */
    public function create(PlayerCreateRequest $request): int
    {
        $photo = $this->saveFile($request->file('photo'));

        $player = Player::create(['nickname' => $request->get('nickname'), 'photo_src' => $photo]);

        return $player->id;
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
     * @return Player
     */
    public function player(int $id): Player
    {
        return Player::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @param Request $request
     * @return int
     */
    public function edit(int $id, Request $request): int
    {
        $data = ['nickname' => $request->get('nickname')];
        $player = Player::where('id', $id)->first();
        $photo_src = $request->get('photo_src');

        if (!is_null($player->photo_src)) {
            if ($photo_src !== $player->photo_src) {
                $data = array_merge($data, ['photo_src' => $photo_src]);
            }
        } else {
            if ($photo_src !== $player->photo_src) {
                $data = array_merge($data, ['photo_src' => $photo_src]);
            }
        }

        return $player->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Player::whereId($id)->delete();
    }
}