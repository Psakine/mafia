<?php
namespace App\Contracts;

use Illuminate\Support\Collection;

interface PlayerContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): int;

    /**
     * @return Collection
     */
    public function players(): Collection;

    /**
     * @param int $id
     * @return Collection
     */
    public function player(int $id): Collection;
}