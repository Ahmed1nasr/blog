<?php

namespace App\Http\Resources\Api\V1\Wink;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['token' => $this['token'], 'type' => $this['type']];
    }
}
