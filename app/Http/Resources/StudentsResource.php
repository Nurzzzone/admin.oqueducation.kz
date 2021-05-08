<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
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
            'id'              => $this->id,
            'name'            => $this->name,
            'surname'         => $this->surname,
            'middle_name'     => $this->middle_name,
            'email_address'   => $this->email_address,
            'home_address'    => $this->home_address,
            'birth_date'      => $this->birth_date,
            'phone_number'    => Auth::user()->phone_number,
            'image'           => $this->image,
            'city'            => $this->city,
            'type'            => $this->type->name,
            'p1_full_name'    => $this->parent->p1_full_name,
            'p1_phone_number' => $this->parent->p1_phone_number,
            'p2_full_name'    => $this->parent->p2_full_name,
            'p2_phone_number' => $this->parent->p2_phone_number
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
