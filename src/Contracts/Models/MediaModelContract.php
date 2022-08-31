<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;

interface MediaModelContract
{
    public function getModelId(): int;

    public function getModelType(): string;

    public function addTrustupMedia(StoreMediaRequestContract $media): StoreMediaResponseContract;

    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract;
}