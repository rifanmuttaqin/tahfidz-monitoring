<?php

namespace App\Http\Resources\StudentClass;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Model\StudentClass\StudentClass;

class StudentClassCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (StudentClass $studentClass) {
            return new StudentClassResource($studentClass);
        });

        return parent::toArray($request);
    }
}
