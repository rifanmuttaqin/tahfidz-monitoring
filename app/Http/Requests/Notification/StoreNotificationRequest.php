<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'notification_title'        => 'required|string',
            'notification_message'      => 'required|string',
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
            'notification_title.required'   => 'Judul diperlukan',
            'notification_title.string'     => 'Tipe tidak sesuai',
            'notification_message.string'   => 'Tipe tidak sesuai',
            'notification_message.required' => 'Pesan tidak boleh kosong',
        ];
    }
}
