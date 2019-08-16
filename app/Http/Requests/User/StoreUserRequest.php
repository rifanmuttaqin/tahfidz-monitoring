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
            'full_name'     => 'string|min:2|nullable',
            'address'       => 'string|nullable',
            'profile_picture' => 'string|nullable',
            'password'      => 'required|confirmed|min:6',
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

            'address.string' => 'Gunakan huruf untuk nama lengkap anda',

            'password.required' => 'Anda belum melengkapi pengisisan Password',
            'password.confirmed' => 'Password tidak sesuai',
            'password.min' => 'Password minimal terdiri dari 6 Karakter',
        ];
    }
}
