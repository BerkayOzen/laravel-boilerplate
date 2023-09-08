<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\map;

class MeResource extends JsonResource
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
            'id' => $this->uuid,
            'username' => $this->username,
            'email' => $this->email,
            'info' => UserInfoResource::make($this->whenLoaded('info')),
            'permissions' => MePermissionResource::collection($this->whenLoaded('currentPermissions'))->map( function($perm) {
                return $perm->resource->name;
            }),
            'meta' => [
                'time' => date(env('DATE_TIME_FORMAT')),
            ],
        ];
    }
}
