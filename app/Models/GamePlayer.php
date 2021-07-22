<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamePlayer extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    public const ROLES = ['Шериф' => 'sheriff', 'Мирный' => 'citizen', 'Мафия' => 'mafia', 'Дон' => 'don'];

    /**
     * @var array
     */
    public const STATUS = ['Убит' => 'killed', 'Заголосован' => 'voted', 'За столом' => 'table'];

    /**
     * @var string
     */
    protected $table = 'game_player';

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'game_id',
        'player_id',
        'status',
        'role',
        'place'
    ];

    protected $primaryKey = 'game_id';

    /**
     * @return BelongsTo
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
