<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:64',
            'email' => 'required|email', Rule::unique('t_users')->ignore($this->id),
            'password' => 'required', 
            'password_confirmation' => 'required|same:password',
        ];
    }
    //*Condiciones password - regex:
    //*English uppercase characters (A – Z)
    //*English lowercase characters (a – z)
    //*Base 10 digits (0 – 9)
    //*Non-alphanumeric (For example: !, $, #, or %)
    //*Unicode characters
    //*regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|'

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
            'password.required' => 'La constraseña es obligatoria',
            'password_confirmation.same' =>'Las contraseñas no coinciden',
            'password.regex' => 'El formato de la contraseña no es válido: debe tener al menos
            10 dígitos incluyendo minúsculas, mayúsculas y carácteres especiales. ',
        ];
    }
}