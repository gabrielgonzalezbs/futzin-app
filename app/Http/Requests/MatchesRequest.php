<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchesRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|max:255',
            'game_day' => 'required|date',
            'game_hour' => 'required',
            'location' => 'required',
            'players_per_team' => 'required',
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
            'date' => 'Informe uma data válida'
        ];
    }

}
