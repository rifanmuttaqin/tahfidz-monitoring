<?php

namespace App\Http\Resources\Surah;

use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
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
            'surah_name' => $this->surah_name,
            'total_ayat' => $this->total_ayat,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}