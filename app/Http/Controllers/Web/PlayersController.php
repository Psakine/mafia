<?php

namespace App\Http\Controllers\Web;

use App\Contracts\PlayerContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Players\PlayerCreateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    /**
     * @var PlayerContract
     */
    private $playerService;

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
     * @return View
     */
    public function players(): View
    {
        return view('players.index', ['players' => $this->playerService->players()]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function player(int $id): View
    {
        return view('players.player', ['player' => $this->playerService->player($id)]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('players.create');
    }

    /**
     * @param PlayerCreateRequest $request
     * @return RedirectResponse
     */
    public function store(PlayerCreateRequest $request): RedirectResponse
    {
        return redirect(route('players.player', ['id' => $this->playerService->create($request)]));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('players.edit', ['player' => $this->playerService->player($id)]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $this->playerService->edit($id, $request);

        return redirect(route('players', ['id' => $this->playerService->edit($id, $request)]));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->playerService->delete($id);

        return redirect(route('players'));
    }
}
