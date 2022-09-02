<?php

namespace Henrotaym\LaravelTrustupMediaIo\Resources\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\MediaTransformerContract;
use Illuminate\Http\Resources\Json\JsonResource;
use Henrotaym\LaravelTrustupMediaIo\Models\Media as MediaModel;

class Media extends JsonResource
{
    /** @var MediaModel */
    public $resource;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var MediaTransformerContract */
        $transformer = app()->make(MediaTransformerContract::class);

        return $transformer->toArray($this->resource);
    }
}
