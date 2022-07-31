<?php

namespace App\Http\Requests\Resident;

use App\Rules\NumWords;
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
            'name' => ['required', 'string', new NumWords(2, 'The name field must have a first and a last name.')],
            'birthed_at' => ['required', 'date', 'date_format:Y-m-d'],
            'stayed_at' => ['required', 'date', 'date_format:Y-m-d'],
            'email' => ['required', 'email', 'unique:users'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'address' => ['required', 'string', new NumWords(3, 'Invalid address.')],
            'born_at' => ['required', 'string'],
            'civil_status' => ['required', 'string', 'in:Single,Married,Widowed,Separated,Divorced'],
            'phone_number' => ['required', 'string', 'unique:user_details'],
        ];
    }
}
