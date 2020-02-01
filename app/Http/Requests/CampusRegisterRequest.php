<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:campuses',
            'name' => 'required|unique:campuses',
            'address' => 'required|min:6|max:50',
            'password' => 'required|min:8|max:20|confirmed',
        ];
    }
}
