<?php

namespace App\Http\Controllers\Web;

use App\Contracts\GameContract;
use App\Contracts\PlayerContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Games\GameCreateRequest;
use App\Http\Requests\Games\GameEditRequest;
use App\Models\GamePlayer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GamesController extends Controller
{
    /**
     * @var GameContract
     */
    private $gameService;

    /**
     * @var PlayerContract
     */
    private $playerService;

    /**
     * GamesController constructor.
     *
     * @param GameContract $gameService
     * @param PlayerContract $playerService
     */
    public function __construct(GameContract $gameService, PlayerContract $playerService)
    {
        $this->gameService = $gameService;
        $this->playerService = $playerService;
    }

    /**
     * Returns list of games
     *
     * @return View
     */
    public function games(): View
    {
        return view('games.index', ['games' => $this->gameService->games()]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function game(int $id): View
    {
        return view('games.game', $this->gameService->game($id));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->gameService->delete($id);

        return redirect(route('games'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view(
            'games.create',
            ['roles' => GamePlayer::ROLES, 'statuses' => GamePlayer::STATUS, 'players' => $this->playerService->players()]
        );
    }

    /**
     * @param GameCreateRequest $request
     * @return RedirectResponse
     */
    public function store(GameCreateRequest $request): RedirectResponse
    {
        return redirect(route('games.game', ['id' => $this->gameService->createGameWithPlayers($request->toArray())]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('games.edit', $this->gameService->game($id));
    }

    /**
     * @param int $id
     * @param GameEditRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, GameEditRequest $request): RedirectResponse
    {
        $this->gameService->edit($id, $request->toArray());

        return redirect(route('games.game', ['id' => $id]));
    }
}
