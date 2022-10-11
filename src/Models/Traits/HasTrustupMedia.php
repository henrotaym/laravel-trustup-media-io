<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models\Traits;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\DestroyMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\_Private\MediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\DestroyMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;
use Illuminate\Support\Collection;

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
        
        $request->setExpectedWidth($request->getExpectedWidth() ?: request()->input('expected_width'))
            ->setExpectedHeight($request->getExpectedHeight() ?: request()->input('expected_height'));

        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->get($request);
    }

    public function deleteTrustupMedia(DestroyMediaRequestContract $request): DestroyMediaResponseContract
    {
        $this->prepareTrustupMediaRequest($request);

        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->destroy($request);
    }

    public function deleteTrustupMediaByUuids(Collection $mediaUuidCollection): DestroyMediaResponseContract
    {
        /** @var DestroyMediaRequestContract */
        $request = app()->make(DestroyMediaRequestContract::class);

        $request->addUuidCollection($mediaUuidCollection);

        return $this->deleteTrustupMedia($request);
    }
    
    public function deleteTrustupMediaCollection(string $mediaCollectionName): DestroyMediaResponseContract
    {
        /** @var DestroyMediaRequestContract */
        $request = app()->make(DestroyMediaRequestContract::class);

        $request->setCollection($mediaCollectionName);

        return $this->deleteTrustupMedia($request);
    }

    protected function prepareTrustupMediaRequest(MediaRequestContract &$request)
    {
        $request->setModelId($this->getTrustupMediaModelId())
                ->setModelType($this->getTrustupMediaModelType());
    }
}