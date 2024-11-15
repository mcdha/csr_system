<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'regex:/^[\pL\s]+$/u'],
            'last_name' => ['required', 'string', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'string', 'email', 'unique:users,email,' .  $this->user->id],
            'role' => ['required', 'string', 'in:Agent,Admin'],
            'agent_code' => ['required_if:role,Agent'], // Only required if role is Agent
            'image_file' => ['nullable', 'sometimes', 'mimes:jpeg,png,webp,jpg', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.regex' => 'The :attribute field should only contain letters and spaces.',
            'last_name.regex' => 'The :attribute field should only contain letters and spaces.',
        ];
    }
}
