<?php

namespace App\Http\Requests\ActionLog;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionLogRequest extends FormRequest
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
            'action_type'           => 'required|integer',
            'user_id'               => 'required|integer',
            'is_error'              => 'required|integer',
            'action_message'        => 'required|string',
            'date'                  => 'required|date',
        ];
    }
}
