<?php

namespace App\Http\Resources\Games;

use App\Models\GamePlayer;
use Illuminate\Http\Resources\Json\JsonResource;

class GameDetailResource extends JsonResource
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
            'name'   => $this->name
        ];
    }
}
