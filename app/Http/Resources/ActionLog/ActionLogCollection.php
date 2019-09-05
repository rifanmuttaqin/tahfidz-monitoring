<?php

namespace App\Http\Resources\ActionLog;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Model\ActionLog\ActionLog;

class ActionLogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (ActionLog $action_log) {
            return new ActionLogResource($action_log);
        });

        return parent::toArray($request);
    }
}
