<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models\Traits;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;

trait HasTrustupMedia
{
    public function getModelId(): int
    {
        return $this->id;
    }

    public function getModelType(): string
    {
        return $this->getTable();
    }

    public function addTrustupMedia(StoreMediaRequestContract $request): StoreMediaResponseContract
    {
        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->store($request);
    }

    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract
    {
        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->get($request);
    }
}