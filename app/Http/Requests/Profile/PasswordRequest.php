<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

class PasswordRequest extends FormRequest
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
        $user_pass = Auth::user()->password; 
        
        return [ 
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6|different:old_password',      
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
            'password.required' => 'Anda belum melengkapi pengisisan Password',
            'password.confirmed' => 'Password tidak sesuai',
            'password.min' => 'Password minimal terdiri dari 6 Karakter',
            'password.different' => 'Password baru harus berbeda dengan password lama',
            'old_password.required' => 'Anda belum melengkapi pengisisan Password Lama',
        ];
    }
}
