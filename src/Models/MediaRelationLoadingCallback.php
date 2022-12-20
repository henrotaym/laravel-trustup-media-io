<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models;

use Illuminate\Support\Collection;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationLoadingCallbackContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;

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

        return $this->endpoint->get($request)->getMedia();
    }
}