<?php

namespace App\Http\Resources\Test;

use Illuminate\Http\Resources\Json\JsonResource;

class TestIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'chief_id' => $this->clientName($this->chief_id),
            'name_of_post_id' => $this->name_of_post($this->name_of_post_id),
            'department_to' => $this->departmentName($this->department_to),
            'application_status' => $this->dictiName($this->application_status),
            'updated_at' => $this->updated_at,
        ];
    }
}
