<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PlayerContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayersAddRequest;

class PlayersController extends Controller
{
    /**
     * @var PlayerContract
     */
    private PlayerContract $playerService;

    /**
     * PlayersController constructor.
     *
     * @param PlayerContract $playerService
     */
    public function __construct(PlayerContract $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * @param PlayersAddRequest $request
     */
    public function add(PlayersAddRequest $request)
    {
        return $this->playerService->add($request->toArray());
    }
}
