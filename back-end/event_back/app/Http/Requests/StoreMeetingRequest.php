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
            'name' => 'required|string|max:255',
            'description' => 'required',
            'place' => 'required'
        ];
    }
    public function messages(): array{
        return[
            'name.required' => 'il nome è un campo obbligatorio',
            'name.string' => 'Il nome può essere composto solo da caratteri',

            'description.required' => 'la descrizione è un campo obbligatiorio',

            'place.required' => 'il numero dei poste è obbligatorio',
            'place.integer' => 'il numero dei posti non può essere maggiore di 5000',
            'place.lt' => 'Il numero dei posti non può essere maggiore di 5000',
        ];
    }
}
