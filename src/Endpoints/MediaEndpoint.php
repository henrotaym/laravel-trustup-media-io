<?php
namespace Henrotaym\LaravelTrustupMediaIo\Endpoints;

use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\StorableMediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media\GetMediaRequestTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media\StoreMediaRequestTransformerContract;

class MediaEndpoint implements MediaEndpointContract
{
    protected ClientContract $client;
    protected GetMediaRequestTransformerContract $getRequestTransformer;
    protected StoreMediaRequestTransformerContract $storeRequestTransformer;
    
    public function __construct(
        ClientContract $client,
        GetMediaRequestTransformerContract $getRequestTransformer,
        StoreMediaRequestTransformerContract $storeRequestTransformer,
    ) {
        $this->client = $client;
        $this->getRequestTransformer = $getRequestTransformer;
        $this->storeRequestTransformer = $storeRequestTransformer;
    }

    public function store(StoreMediaRequestContract $request): StoreMediaResponseContract
    {
        /** @var RequestContract */
        $clientRequest = app()->make(RequestContract::class);

        $clientRequest->setVerb('POST')
            ->setIsMultipart(true)
            ->addData($this->storeRequestTransformer->toArray($request));

        /** @var StoreMediaResponseContract */
        $response = app()->make(StoreMediaResponseContract::class);

        return $response->setResponse($this->client->try($clientRequest, "Could not store media"));
    }

    public function get(GetMediaRequestContract $request): GetMediaResponseContract
    {
        /** @var RequestContract */
        $clientRequest = app()->make(RequestContract::class);

        $clientRequest->setVerb('GET')
            ->addData($this->getRequestTransformer->toArray($request));

        /** @var GetMediaResponseContract */
        $response = app()->make(GetMediaResponseContract::class);

        return $response->setResponse($this->client->try($clientRequest, "Could not get media"));
    }
}