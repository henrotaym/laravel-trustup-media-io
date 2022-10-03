<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models\Traits;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\_Private\MediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;

trait HasTrustupMedia
{
    public function getTrustupMediaModelId(): int
    {
        return $this->id;
    }

    public function getTrustupMediaModelType(): string
    {
        return $this->getTable();
    }

    public function addTrustupMedia(StoreMediaRequestContract $request): StoreMediaResponseContract
    {
        $this->prepareTrustupMediaRequest($request);

        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->store($request);
    }

    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract
    {
        $this->prepareTrustupMediaRequest($request);
        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->get($request);
    }

    public function prepareTrustupMediaRequest(MediaRequestContract &$request)
    {
        $request->setModelId($this->getTrustupMediaModelId())
                ->setModelType($this->getTrustupMediaModelType());
    }
}