<?php
namespace App\Contracts;

use App\Http\Requests\Players\PlayerCreateRequest;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface PlayerContract
{
    /**
     * @param PlayerCreateRequest $request
     * @return mixed
     */
    public function create(PlayerCreateRequest $request): int;

    /**
     * @return Collection
     */
    public function players(): Collection;

    /**
     * @param int $id
     * @return Player
     */
    public function player(int $id): Player;

    /**
     * @param int $id
     * @param Request $request
     * @return int
     */
    public function edit(int $id, Request $request): int;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}