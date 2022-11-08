<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           'email' => 'email|required',
           'password' => 'string|required',
        ];
    }

    /**
     * Menssagem para campos obrigátorios em caso de inexistencia
     *
     * @return mixed
     */
    public function messages(): array
    {
        return [
            'email.required' => "Email é obrigatório",
            'email.email' => "Email com formato invalido",
            'password.required' => "Password é obrigatório",

        ];
    }
}
