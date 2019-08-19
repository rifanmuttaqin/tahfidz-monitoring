<?php

namespace App\Http\Resources\Siswa;

use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
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
            'siswa_name' => $this->siswa_name,
            'class' => $this->getClass,
            'memorization_type' => $this->memorization_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}