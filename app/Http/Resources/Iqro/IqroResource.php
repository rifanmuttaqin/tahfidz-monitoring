<?php

namespace App\Http\Resources\Iqro;

use Illuminate\Http\Resources\Json\JsonResource;

class IqroResource extends JsonResource
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
            'jilid_number' => $this->jilid_number,
            'total_page' => $this->total_page,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}