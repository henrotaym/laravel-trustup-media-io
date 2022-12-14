<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models\Traits;

use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Traits\Models\IsExternalModelRelatedModel;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Psr\Http\Message\StreamInterface;
use Illuminate\Database\Eloquent\Model;
use Henrotaym\LaravelTrustupMediaIoCommon\Enums\Media\MediaCollections;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\DestroyMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Models\MediaRelationLoadingCallback;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\DestroyMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\_Private\MediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Transformers\Models\StorableMediaTransformerContract;
/**
 * @var Model $this
 * @implements 
 */
trait HasTrustupMedia
{
    use IsExternalModelRelatedModel;

    /**
     * Getting model identifier for media.trustup.io
     */
    public function getTrustupMediaModelId(): string
    {
        /** @var Model $this */
        return $this->uuid ??
            $this->id;
    }

    /**
     * Getting model type for media.trustup.io
     */
    public function getTrustupMediaModelType(): string
    {
        /** @var Model $this */
        return Str::slug(str_replace('\\', '-', $this->getMorphClass()));
    }

    /**
     * Adding trustup media using a customized request.
     */
    public function addTrustupMedia(StoreMediaRequestContract $request): StoreMediaResponseContract
    {
        $this->prepareTrustupMediaRequest($request);

        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->store($request);
    }

    /**
     * Adding trustup media from a single resource. 
     */
    public function addTrustupMediaFromResource(
        string|UploadedFile|StreamInterface $resource,
        string|MediaCollections|null $collection,
        bool $isUsingQueue = false
    ): StoreMediaResponseContract
    {
        return $this->addTrustupMediaFromResourceCollection(collect([$resource]), $collection, $isUsingQueue);
    }
    
    /** 
     * Adding trustup media from a resources collection.
     * 
     * @param Collection<int, string|UploadedFile|StreamInterface> $resourceCollection */
    public function addTrustupMediaFromResourceCollection(
        Collection $resourceCollection,
        string|MediaCollections|null $collection,
        bool $isUsingQueue = false
    ): StoreMediaResponseContract
    {
        /** @var StorableMediaTransformerContract */
        $transformer = app()->make(StorableMediaTransformerContract::class);
        /** @var StoreMediaRequestContract */
        $request = app()->make(StoreMediaRequestContract::class);

        $resourceCollection->each(
            fn (string|UploadedFile|StreamInterface $resource) =>
                $request->addMedia($transformer->fromResource($resource))
        );

        $request->useQueue($isUsingQueue);

        $collection instanceof MediaCollections ?
            $request->setMediaCollection($collection)
            : $request->setCollection($collection);
        
        return $this->addTrustupMedia($request);
    }

    /**
     * Retrieving trustup media using a customized request.
     */
    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract
    {
        $this->prepareTrustupMediaRequest($request);
        
        $request->setExpectedWidth($request->getExpectedWidth() ?: request()->input('expected_width'))
            ->setExpectedHeight($request->getExpectedHeight() ?: request()->input('expected_height'));

        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->get($request);
    }

    /**
     * Retrieving trustup media linked to given collection.
     */
    public function getTrustupMediaCollection(string|MediaCollections $mediaCollection, bool $firstOnly = false): GetMediaResponseContract
    {
        /** @var GetMediaRequestContract */
        $request = app()->make(GetMediaRequestContract::class);

        $mediaCollection instanceof MediaCollections ?
            $request->setMediaCollection($mediaCollection)
            : $request->setCollection($mediaCollection);

        $request->firstOnly($firstOnly);

        return $this->getTrustupMedia($request);
    }

    /**
     * Deleting trustup media using a customized request.
     */
    public function deleteTrustupMedia(DestroyMediaRequestContract $request): DestroyMediaResponseContract
    {
        $this->prepareTrustupMediaRequest($request);

        /** @var MediaEndpointContract */
        $endpoint = app()->make(MediaEndpointContract::class);

        return $endpoint->destroy($request);
    }

    /**
     * Deleting trustup media matching given uuids collection.
     */
    public function deleteTrustupMediaByUuidCollection(Collection $mediaUuidCollection): DestroyMediaResponseContract
    {
        /** @var DestroyMediaRequestContract */
        $request = app()->make(DestroyMediaRequestContract::class);

        $request->addUuidCollection($mediaUuidCollection);

        return $this->deleteTrustupMedia($request);
    }
    
    /**
     * Deleting trustup media linked to given collection.
     */
    public function deleteTrustupMediaCollection(string|MediaCollections $mediaCollection): DestroyMediaResponseContract
    {
        /** @var DestroyMediaRequestContract */
        $request = app()->make(DestroyMediaRequestContract::class);

        is_string($mediaCollection) ?
            $request->setCollection($mediaCollection)
            : $request->setMediaCollection($mediaCollection);

        return $this->deleteTrustupMedia($request);
    }

    protected function prepareTrustupMediaRequest(MediaRequestContract &$request)
    {
        $request->setModelId($this->getTrustupMediaModelId())
                ->setModelType($this->getTrustupMediaModelType());
    }

    /**
     * Media relation based on stored media identifier.
     * 
     * @param string $idProperty
     * @param string $name
     * @return ExternalModelRelationContract
     */
    public function hasOneTrustupMedia(string $idProperty, string $name = null): ExternalModelRelationContract
    {
        return $this->belongsToExternalModel(
            app()->make(MediaRelationLoadingCallback::class),
            $idProperty,
            $name
        );
    }

    /**
     * Media relation based on stored media identifiers.
     * 
     * @param string $idsProperty
     * @param string $name
     * @return ExternalModelRelationContract
     */
    public function hasManyTrustupMedia(string $idsProperty, string $name = null): ExternalModelRelationContract
    {
        return $this->hasManyExternalModels(
            app()->make(MediaRelationLoadingCallback::class),
            $idsProperty,
            $name
        );
    }
}