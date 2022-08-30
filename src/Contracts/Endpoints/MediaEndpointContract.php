<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints;

use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;

interface MediaEndpointContract
{
    public function store(StoreMediaRequestContract $request): StoreMediaResponseContract;

    public function get(GetMediaRequestContract $request): GetMediaResponseContract;
}