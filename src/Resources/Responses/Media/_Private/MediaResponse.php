<?php

namespace Henrotaym\LaravelTrustupMediaIo\Resources\Responses\Media\_Private;

use Illuminate\Http\Resources\Json\JsonResource;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\_Private\MediaResponseContract;

abstract class MediaResponse extends JsonResource
{
    /** @var MediaResponseContract */
    public $resource;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->resource->toArray();   
    }
}
