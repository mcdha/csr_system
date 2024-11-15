<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'start_date' => ['nullable', 'before_or_equal:end_date', 'required_with:end_date'],
            'end_date' => ['nullable', 'required_with:end_date'],
            'branches' => ['nullable'],
            'departments' => ['nullable'],
            'channels' => ['nullable'],
            'concerns' => ['nullable'],
        ];
    }
}
