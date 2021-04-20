<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
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
            'surname' => $this->surname,
            'middle_name' => $this->middle_name,
            'email_address' => $this->email_address,
            'home_address' => $this->home_address,
            'birth_date' => $this->birth_date,
            'phone_number' => $this->phone_number,
            'image' => $this->image,
            'type' => $this->type->name
        ];
    }
}
