<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username'      => 'required|min:2|unique:tbl_user',
            'email'         => 'required|email|unique:tbl_user',
            'full_name'     => 'string',
            'account_type'  => 'integer',
            'address'       => 'string',
            'password'      => 'required|confirmed|min:6',
        ];
    }
}
