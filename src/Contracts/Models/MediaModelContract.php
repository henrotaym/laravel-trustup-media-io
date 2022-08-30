<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;

interface MediaModelContract
{
    public function getModelId(): int;

    public function getModelType(): string;

    public function addTrustupMedia(StoreMediaRequestContract $media): StoreMediaResponseContract;

    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract;
}