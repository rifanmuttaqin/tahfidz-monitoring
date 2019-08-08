<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'username'      => 'required|min:2|unique:tbl_user,id,'. $request->get('iduser'),
            'email'         => 'required|email|unique:tbl_user,id,'. $request->get('iduser'),
            'full_name'     => 'string',
            'account_type'  => 'integer',
            'address'       => 'string',
        ];
    }
}
