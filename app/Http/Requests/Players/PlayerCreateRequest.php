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
            'photo'    => 'required|image'
        ];
    }

    /**
     * @return array|void
     */
    public function messages(): array
    {
        return [
          'nickname.required' => 'Поле ник обязательно для заполнения',
          'photo.required' => 'Поле фото обязательно для заполнения',
          'photo.image' => 'Файл должен быть изображением',
        ];
    }
}
