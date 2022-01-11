<?php

namespace App\Http\Requests\Resident;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->hasRole('Administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->input('residentId');

        return [
            'name' => ['required', 'string'],
            'birthed_at' => ['required', 'date', 'date_format:Y-m-d'],
            'email' => ['required', 'email', "unique:users,email,$id"],
            'gender' => ['nullable', 'string', 'in:Male,Female'],
            'address' => ['required', 'string'],
            'civil_status' => ['required', 'string', 'in:Single,Married,Widowed,Separated,Divorced'],
            'phone_number' => ['required', 'string', "unique:user_details,phone_number,$id,user_id"],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg']
        ];
    }
}
