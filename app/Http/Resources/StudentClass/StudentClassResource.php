<?php

namespace App\Http\Resources\StudentClass;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentClassResource extends JsonResource
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
            'class_name' => $this->class_name,
            'note' => $this->note,
            'teacher' => $this->getTeacher,
            'angkatan' => $this->angkatan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}