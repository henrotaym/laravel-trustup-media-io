<?php

namespace Henrotaym\LaravelTrustupMediaIo\Models;

use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationLoadingCallbackContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Illuminate\Support\Collection;

class MediaRelationLoadingCallback implements ExternalModelRelationLoadingCallbackContract
{
    protected MediaEndpointContract $endpoint;

    public function __construct(MediaEndpointContract $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function load(Collection $identifiers): Collection
    {
        /** @var GetMediaRequestContract */
        $request = app()->make(GetMediaRequestContract::class);
        $request->setUuids($identifiers);

        return $this->endpoint->search($request)->getMedia();
    }
}
