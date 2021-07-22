<?php

namespace App\Http\Controllers\Web;

use App\Contracts\PlayerContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Players\PlayerCreateRequest;
use App\Http\Requests\PlayersAddRequest;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        return redirect(route('players.player', ['id' => $this->playerService->create($request->toArray())]));
    }
}
