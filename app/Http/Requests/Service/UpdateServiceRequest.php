<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:255'],
            'type'        => ['required', 'in:web,remoto'],
            'icon'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'path'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            // Validación para múltiples usuarios
            'user_ids'   => ['nullable', 'array'],
            'user_ids.*' => ['exists:users,id'],
        ];
    }
}
