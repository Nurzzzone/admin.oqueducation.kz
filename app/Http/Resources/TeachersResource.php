<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class TeachersResource extends JsonResource
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
            'position'        => $this->position,
            'home_address'    => $this->home_address,
            'birth_date'      => $this->birth_date,
            'phone_number'    => Auth::user()->phone_number,
            'image'           => $this->image,
            'is_active'       => $this->is_active,
            'facebook_url'    => $this->socials->facebook_url ?? null,
            'instagram_url'   => $this->socials->instagram_url ?? null,
            'description'     => $this->description,
            'job_history'     => $this->jobHistory,
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
