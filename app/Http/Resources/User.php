<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'user_types_id' => $this->user_types_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tickets' => $this->tickets,
        ];
    }
}
