<?php

namespace App\Http\Resources\ActionLog;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionLogResource extends JsonResource
{
	/**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user'              => $this->getUser,
            'action_type'       => $this->action_type,
            'is_error'          => $this->is_error,
            'action_message'    => $this->action_message,
            'date'              => $this->date,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}