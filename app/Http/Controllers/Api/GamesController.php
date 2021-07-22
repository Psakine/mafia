<?php

namespace App\Http\Controllers\Api;

use App\Contracts\GameContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Games\GameCreateRequest;
use App\Http\Requests\Games\GameDeleteRequest;
use App\Http\Requests\Games\GameEditRequest;
use App\Http\Resources\Games\GameDetailResource;
use App\Http\Resources\Games\GamePlayersDetailResource;
use App\Http\Resources\Games\GameResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GamesController extends Controller
{
    /**
     * @var GameContract
     */
    private $gameService;

    /**
     * GamesController constructor.
     *
     * @param GameContract $gameService
     * @return void
     */
    public function __construct(GameContract $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Returns list of games
     *
     * @return AnonymousResourceCollection
     */
    public function games(): AnonymousResourceCollection
    {
        return GameResource::collection($this->gameService->games());
    }

    /**
     * Create game
     *
     * @param GameCreateRequest $request
     * @return GameResource
     */
    public function create(GameCreateRequest $request): GameResource
    {
        return new GameResource($this->gameService->create($request->toArray()));
    }

    /**
     * Delete game
     *
     * @param GameDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(GameDeleteRequest $request): JsonResponse
    {
        return response()->json(['success' => $this->gameService->delete($request->toArray()['id'])]);
    }

    /**
     * Edit game
     *
     * @param GameEditRequest $request
     * @return GameResource
     */
    public function edit(GameEditRequest $request): GameResource
    {
        return new GameResource($this->gameService->edit($request->toArray()));
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getCurrentPlayers(): AnonymousResourceCollection
    {
        return GamePlayersDetailResource::collection($this->gameService->getCurrentPlayers());
    }

    /**
     * @return GameDetailResource
     */
    public function getCurrentGame(): GameDetailResource
    {
        return new GameDetailResource($this->gameService->getCurrentGame());
    }
}
