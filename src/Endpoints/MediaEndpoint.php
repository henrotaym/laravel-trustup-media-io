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

class MediaEndpoint implements MediaEndpointContract
{
    /** @var ClientContract */
    protected $client;
    
    public function __construct(ClientContract $client)
    {
        $this->client = $client;
    }

    public function store(StoreMediaRequestContract $request): StoreMediaResponseContract
    {
        /** @var RequestContract */
        $clientRequest = app()->make(RequestContract::class);

        $clientRequest
            ->setVerb('POST')
            ->setIsMultipart(true)
            ->addData([
                'model_id' => $request->getModelId(),
                'model_type' => $request->getModelType(),
                'app_key' => $request->getAppKey(),
                'collection' => $request->getCollection(),
                'files' => $request->getMedia()->map(fn (StorableMediaContract $media) => $this->storableMediaToData($media))->all()
            ]);

        /** @var StoreMediaResponseContract */
        $response = app()->make(StoreMediaResponseContract::class);

        return $response->setResponse($this->client->try($clientRequest, "Could not store media"));
    }

    protected function storableMediaToData(StorableMediaContract $media): array
    {
        return [
            'resource' => $media->isFile() ?
                $media->getResource()->get()
                : $media->getResource(),
            'name' => $media->getName(),
            'collection' => $media->getCollection(),
            'custom_properties' => $media->getCustomProperties()
        ];
    }

    public function get(GetMediaRequestContract $request): GetMediaResponseContract
    {
        /** @var RequestContract */
        $clientRequest = app()->make(RequestContract::class);

        /** @var GetMediaResponseContract */
        $response = app()->make(GetMediaResponseContract::class);

        return $response->setResponse($this->client->try($clientRequest, "Could not get media"));
    }
}