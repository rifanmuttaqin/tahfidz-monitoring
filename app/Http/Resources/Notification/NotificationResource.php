<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'notification_type' => $this->notification_type,
            'notification_title' => $this->notification_title,
            'notification_message' => $this->notification_message,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}