<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\DestroyMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\DestroyMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;
use Illuminate\Support\Collection;

interface HasTrustupMediaContract
{
    public function getTrustupMediaModelId(): int;

    public function getTrustupMediaModelType(): string;

    public function addTrustupMedia(StoreMediaRequestContract $media): StoreMediaResponseContract;

    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract;

    public function deleteTrustupMedia(DestroyMediaRequestContract $request): DestroyMediaResponseContract;
    
    public function deleteTrustupMediaByUuids(Collection $mediaUuidCollection): DestroyMediaResponseContract;
    
    public function deleteTrustupMediaCollection(string $mediaCollectionName): DestroyMediaResponseContract;
}