<?php

namespace App\Http\Requests\Query;

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
            'name' => ['required'],
            // 'is_member' => ['required'],
            // 'branch' => ['required'],
            'contact_no' => ['required'],
            'email' => ['required'],
            'department' => ['required'],
            'channel' => ['required'],
            'concern' => ['required'],
            'status' => ['required'],
            'urgency' => ['required'],
            'resolved_by' => ['nullable'],
            'ticket_number' => ['nullable'],
            'resolved_at' => ['nullable'],
            'issue' => ['nullable'],
            'action_taken' => ['nullable'],
            'remarks' => ['nullable'],
        ];
    }
}
