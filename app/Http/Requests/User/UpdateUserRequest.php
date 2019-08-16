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
            'username'      => 'required|min:2|unique:tbl_user,username,'.$request->get('iduser'),
            'email'         => 'required|email|unique:tbl_user,email,'. $request->get('iduser'),
            'profile_picture' => 'string|nullable',
            'full_name'     => 'string|nullable',
            'address'       => 'string|nullable',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Username tidak boleh dikosongkan',
            'username.min' => 'Username setidaknya 2 karakter',
            'username.unique' => 'Username telah ada sebelumnya',

            'email.required' => 'Username tidak boleh dikosongkan',
            'email.email' => 'Format email tidak disetujui',
            'email.unique' => 'Email telah digunakan sebelumnya',

            'full_name.string' => 'Gunakan huruf untuk nama lengkap anda',
            'full_name.min' => 'Gunakan setidaknya 2 karakter',
        ];
    }
}
