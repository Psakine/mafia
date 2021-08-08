<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\Player;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            [
                'nickname' => 'Гендальф'
            ],
            [
                'nickname' => 'Патрикеевна'
            ],
            [
                'nickname' => 'Кольт'
            ],
            [
                'nickname' => 'Негодяй'
            ],
            [
                'nickname' => 'Некомата'
            ],
            [
                'nickname' => 'РедСан'
            ],
            [
                'nickname' => 'Яррус'
            ],
            [
                'nickname' => 'Рамзес'
            ],
            [
                'nickname' => 'Таньчур'
            ],
            [
                'nickname' => 'Иггдрасиль'
            ]
        ];

        for ($i = 1; $i <= 10; $i++) {
            $games[] = ['name' => 'Игра '.$i];
        }

        Player::insert($players);
        Game::insert($games);

        $players = Player::all()->shuffle()->toArray();
        $games = Game::all()->last();
        $game_player = [];
        $i = 1;

        $roles = ['sheriff', 'citizen', 'citizen', 'citizen', 'citizen', 'citizen', 'citizen', 'mafia', 'mafia', 'don'];
        $status = ['killed', 'voted','voted', 'table', 'table', 'table', 'table', 'table', 'table', 'table'];

        shuffle($roles);
        shuffle($status);

        foreach ($players as $player) {
            $game_player[] = [
                'game_id'   => $games->id,
                'player_id' => $player['id'],
                'status'       => $status[$i-1],
                'role'      => $roles[$i-1],
                'place'     => $i
            ];

            $i++;
        }

        GamePlayer::insert($game_player);
    }
}
