<?php

namespace App\Http\Requests\Games;

use Illuminate\Foundation\Http\FormRequest;

class GameCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'game.name' => 'required|string|max:32|min:6|unique:games,name',
            'game.players.*.id' => 'required|string|distinct',
            'game.players.*.role' => 'required|string',
            'game.players.*.place' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'game.name.required' => 'Поле название игры должно быть заполнено',
            'game.name.unique' => 'Есть игра с таким названием',
            'game.name.max' => 'Максимальное количество символов должно быть не больше 32',
            'game.name.min' => 'Максимальное количество символов должно быть не менее 6',
            'game.players.*.id.required' => 'Поле ник игрока должно быть заполнено',
            'game.players.*.id.distinct' => 'Этот игрок уже "сидит" за столом',
            'game.players.*.role.required' => 'Поле роль игрока должно быть заполнено',
            'game.players.*.place.required' => 'Поле место игрока должно быть заполнено',
        ];
    }
}
