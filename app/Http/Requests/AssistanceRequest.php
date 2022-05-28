<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssistanceRequest extends FormRequest
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
            'type' => ['required', 'string', 'in:Financial Request,Barangay Clearance,Barangay ID'],
            'reason' => ['nullable', 'string'],
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
