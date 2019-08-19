<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
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
            'siswa_name'        => 'required|min:2',
            'memorization_type' => 'required|integer',
            'class_id'          => 'required|integer',
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
            'siswa_name.required' => 'Siswa tidak boleh dikosongkan',
            'memorization_type.required' => 'Jenis Hafalan tidak boleh dikosongkan',
            'class_id.required' => 'Kelas tidak boleh dikosongkan',

            'siswa_name.min' => 'Inputan siswa minimal 2 karakter',
            'memorization_type.integer' => 'Tipe hafalan tidak sesuai',
            'class_id.integer' => 'Kelas tidak sesuai',
        ];
    }
}
