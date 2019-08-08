<?php

namespace App\Http\Resources\Surah;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Model\Surah\Surah;

class SurahCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Surah $surah) {
            return new SurahResource($surah);
        });

        return parent::toArray($request);
    }
}
