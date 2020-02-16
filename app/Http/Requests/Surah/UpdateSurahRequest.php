<?php

namespace App\Http\Requests\Surah;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class UpdateSurahRequest extends FormRequest
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
            'surah_name'      => 'required|string|unique:tbl_surah,surah_name,'.$request->get('idsurah'),
            'total_ayat'      => 'required|integer',
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
            'surah_name.required' => 'Surat tidak boleh dikosongkan',
            'surah_name.unique'   => 'Nama Surat sudah ada sebelumnya',
            'total_ayat.integer' => 'Total Ayat Jilid harus berupa angka',
            'total_ayat.required' => 'Total Ayat tidak boleh dikosongkan',
        ];
    }
}
