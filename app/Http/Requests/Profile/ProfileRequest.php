<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class ProfileRequest extends FormRequest
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
            'email'           => 'required|email|unique:tbl_user,email,'. $request->get('iduser'),
            'full_name'       => 'string|min:2|nullable',
            'address'         => 'string|nullable',
            'file'            => 'nullable|max:2000',
            'profile_picture' => 'string|nullable',
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
            'email.required' => 'Username tidak boleh dikosongkan',
            'email.email' => 'Format email tidak disetujui',
            'email.unique' => 'Email telah digunakan sebelumnya',

            'file.max' => 'Maksimum file 100 KB',

            'full_name.string' => 'Gunakan huruf untuk nama lengkap anda',
            'full_name.min' => 'Gunakan setidaknya 2 karakter',

            'address.string' => 'Gunakan huruf untuk nama lengkap anda',
        ];
    }
}
