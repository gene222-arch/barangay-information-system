<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'date' => ['required', 'date', 'after_or_equal:now'],
            'start' => ['required', 'after_or_equal:now'],
            'end' => ['required', 'after:start'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:Processing,Granted,Denied']
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'Please select a resident'
        ];
    }
}
