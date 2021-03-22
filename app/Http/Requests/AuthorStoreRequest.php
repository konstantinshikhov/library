<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'id'      => 'integer|nullable',
            'name'    => 'required|string',
            'surname' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'У каждого человека обязательно должно быть имя',
            'surname.required' => "Фамилия минимально необходимый атрибут каждого гражданина",
            'surname.min'      => "Длинна фамилии должна быть больше трех символов. Если это не так обратитесь в паспортный стол для исправления этого нюанса.",
        ];

    }
}
