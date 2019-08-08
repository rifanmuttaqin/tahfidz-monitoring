<?php

namespace App\Http\Resources\Siswa;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Model\Siswa\Siswa;

class SiswaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Siswa $siswa) {
            return new SiswaResource($siswa);
        });

        return parent::toArray($request);
    }
}