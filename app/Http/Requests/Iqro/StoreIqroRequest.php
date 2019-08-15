<?php

namespace App\Http\Requests\Iqro;

use Illuminate\Foundation\Http\FormRequest;

class StoreIqroRequest extends FormRequest
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
            'jilid_number'      => 'unique:tbl_iqro|required|integer',
            'total_page'        => 'required|integer',
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
            'jilid_number.required' => 'Jilid tidak boleh dikosongkan',
            'jilid_number.unique' => 'Jilid sudah ada sebelumnya',
            'jilid_number.integer' => 'Nomor Jilid harus berupa angka',
            'total_page.required' => 'Total Halaman tidak boleh dikosongkan',
            'total_page.integer' => 'Total Halaman Jilid harus berupa angka',
        ];
    }
}
