<?php

namespace App\Rules;

use App\Http\Requests\Games\GameCreateRequest;
use Illuminate\Contracts\Validation\Rule;

class Role implements Rule
{

    /**
     * @var array
     */
    protected $roles = [];

    /**
     * @var int
     */
    protected $sheriffCount = 0;

    /**
     * @var int
     */
    protected $donCount = 0;

    /**
     * @var int
     */
    protected $mafiaCount = 0;

    /**
     * @var int
     */
    protected $citizenCount = 0;
    /**
     * @var string
     */
    private $message;

    /**
     * Create a new rule instance.
     *
     * @param GameCreateRequest $request
     */
    public function __construct(GameCreateRequest $request)
    {
        foreach ($request->toArray()['game']['players'] as $player){
            if($player['role'] === 'sheriff'){
                $this->sheriffCount++;
            }elseif ($player['role'] === 'don'){
                $this->donCount++;
            }elseif ($player['role'] === 'mafia'){
                $this->mafiaCount++;
            }elseif ($player['role'] === 'citizen'){
                $this->citizenCount++;
            }
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->sheriffCount > 1){
            $this->message = 'Шерифов не может быть больше 1';

            return false;
        }elseif ($this->donCount > 1){
            $this->message = 'Дон только в 1 количестве';

            return false;
        }elseif ($this->mafiaCount > 2){
            $this->message = 'Мафии не может быть больше 2';

            return false;
        }elseif ($this->citizenCount > 6){
            $this->message = 'Мирных не может быть больше 6';

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
