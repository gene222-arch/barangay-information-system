<?php

namespace App\Http\Requests\Resident;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'image' => ['required', 'image'],
            'name' => ['required', 'string'],
            'birthed_at' => ['required', 'date', 'date_format:Y-m-d'],
            'stayed_at' => ['required', 'date', 'date_format:Y-m-d'],
            'email' => ['required', 'email', 'unique:users'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'address' => ['required', 'string'],
            'born_at' => ['required', 'string'],
            'civil_status' => ['required', 'string', 'in:Single,Married,Widowed,Separated,Divorced'],
            'phone_number' => ['required', 'string', 'unique:user_details'],
        ];
    }
}
