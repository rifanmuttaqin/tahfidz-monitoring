<?php

namespace App\Http\Resources\Iqro;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Model\Iqro\Iqro;

class IqroCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Iqro $iqro) {
            return new IqroResource($iqro);
        });

        return parent::toArray($request);
    }
}
