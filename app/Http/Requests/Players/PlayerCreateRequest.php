<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;

class PlayerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'nickname' => 'required|string',
            'club'     => 'required|string',
            'photo'    => 'required|file'
        ];
    }

    /**
     * @return array|void
     */
    public function messages(): array
    {
        return [
          'nickname.required' => 'Поле ник обязательно для заполнения',
          'club.required' => 'Поле клуб обязательно для заполнения',
          'photo.required' => 'Поле фото обязательно для заполнения',
        ];
    }
}
