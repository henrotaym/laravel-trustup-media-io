<?php

namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\DestroyMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\DestroyMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\StoreMediaRequestContract;

interface MediaEndpointContract
{
    public function store(StoreMediaRequestContract $request): StoreMediaResponseContract;

    public function get(GetMediaRequestContract $request): GetMediaResponseContract;

    /**
     * Same lookup as get() but sends filters as a POST payload, allowing
     * uuid batches too large for a GET query string.
     */
    public function search(GetMediaRequestContract $request): GetMediaResponseContract;

    public function destroy(DestroyMediaRequestContract $request): DestroyMediaResponseContract;
}
