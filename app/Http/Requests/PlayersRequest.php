<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayersRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'skills_levels' => 'required',
            'goalkeeper' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'Campo com preenchimento obrigatorio',
            'max' => 'Número máximo de :max caracteres atingido',
            'email' => 'O e-mail informado não esta em um formato válido'
        ];
    }
}
