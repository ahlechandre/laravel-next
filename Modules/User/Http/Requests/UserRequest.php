<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\User\Entities\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
                return [
                    'name' => 'required|string|min:2',
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users')
                            ->ignore($this->user)
                    ],
                    'role_id' => 'required|integer',
                ];
            default:
                return [
                    'name' => 'required|string|min:2',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:6|max:24',
                    'role_id' => 'required|integer',
                ];
        }
    }

    /**
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unique' => 'O :attribute já está em uso',
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute requer, no mínimo, :min caracteres',
            'max' => 'O campo :attribute requer, no máximo, :max caracteres',
        ];
    }

    /**
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
            'role_id' => 'papel',
        ];
    }

    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
