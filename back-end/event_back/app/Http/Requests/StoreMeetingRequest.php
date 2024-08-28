<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'params.name' => 'required|string|max:255',
            'params.description' => 'required',
            'params.number' => 'required'
        ];
    }
    public function messages(): array{
        return[
            'params.name.required' => 'il nome è un campo obbligatorio',
            'params.name.string' => 'Il nome può essere composto solo da caratteri',

            'params.description.required' => 'la descrizione è un campo obbligatiorio',

            'params.number.required' => 'il numero dei poste è obbligatorio',
            'params.number.integer' => 'il numero dei posti non può essere maggiore di 5000',
            'params.number.lt' => 'Il numero dei posti non può essere maggiore di 5000',
        ];
    }
}
