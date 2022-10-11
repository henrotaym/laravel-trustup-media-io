<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\DestroyMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\DestroyMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Enums\Media\MediaCollections;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Psr\Http\Message\StreamInterface;

interface HasTrustupMediaContract
{
    /**
     * Getting model identifier for media.trustup.io
     */
    public function getTrustupMediaModelId(): int;

    /**
     * Getting model type for media.trustup.io
     */
    public function getTrustupMediaModelType(): string;

    /**
     * Adding trustup media using a customized request.
     */
    public function addTrustupMedia(StoreMediaRequestContract $media): StoreMediaResponseContract;

    /**
     * Adding trustup media from a single resource. 
     */
    public function addTrustupMediaFromResource(
        string|UploadedFile|StreamInterface $resource,
        string|MediaCollections|null $collection,
        bool $isUsingQueue = false
    ): StoreMediaResponseContract;
    
    /** 
     * Adding trustup media from a resources collection.
     * 
     * @param Collection<int, string|UploadedFile|StreamInterface> $resourceCollection */
    public function addTrustupMediaFromResourceCollection(
        Collection $resourceCollection,
        string|MediaCollections|null $collection,
        bool $isUsingQueue = false
    ): StoreMediaResponseContract;

    /**
     * Retrieving trustup media using a customized request.
     */
    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract;

    /**
     * Retrieving trustup media linked to given collection.
     */
    public function getTrustupMediaCollection(string|MediaCollections $mediaCollection, bool $firstOnly = false): GetMediaResponseContract;

    /**
     * Deleting trustup media using a customized request.
     */
    public function deleteTrustupMedia(DestroyMediaRequestContract $request): DestroyMediaResponseContract;
    
    /**
     * Deleting trustup media matching given uuids collection.
     */
    public function deleteTrustupMediaByUuidCollection(Collection $mediaUuidCollection): DestroyMediaResponseContract;
    
    /**
     * Deleting trustup media linked to given collection.
     */
    public function deleteTrustupMediaCollection(string|MediaCollections $mediaCollection): DestroyMediaResponseContract;
}