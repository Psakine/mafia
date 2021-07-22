<?php

namespace App\Http\Resources\Games;

use App\Models\GamePlayer;
use Illuminate\Http\Resources\Json\JsonResource;

class GamePlayersDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**@var GamePlayer $this */
        return [
            'role'   => $this->role,
            'out'    => $this->status,
            'place'  => $this->place,
            'player' => $this->player
        ];
    }
}
