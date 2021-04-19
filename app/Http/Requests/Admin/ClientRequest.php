<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:10',
            'surname' => 'required|min:2|max:10',
            'address' => 'required|min:5|max:40',
            'location' => 'required|min:5|max:40',
            'zip' => 'required|min:5|max:5',
            'email' => 'required|email', Rule::unique('t_clients')->ignore($this->client),
            'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|', 

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
            'surname.required' => 'El apellido es obligatorio',
            'address.required' => 'La dirección es obligatoria',
            'address.min' => 'La dirección es demasiado corta',
            'location.required' => 'La población es obligatoria',
            'zip.required' => 'El Código Postal es obligatorio',
            'password.required' => 'La constraseña es obligatoria',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe contener @',
            'password.regex' => 'El formato de la contraseña no es válido: debe tener al menos
            10 dígitos incluyendo minúsculas, mayúsculas y carácteres especiales. ',
        ];
    }
}