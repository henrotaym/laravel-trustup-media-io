<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;

interface HasTrustupMediaContract
{
    public function getTrustupMediaModelId(): int;

    public function getTrustupMediaModelType(): string;

    public function addTrustupMedia(StoreMediaRequestContract $media): StoreMediaResponseContract;

    public function getTrustupMedia(GetMediaRequestContract $request): GetMediaResponseContract;
}