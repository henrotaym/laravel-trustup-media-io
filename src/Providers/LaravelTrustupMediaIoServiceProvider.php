<?php
namespace Henrotaym\LaravelTrustupMediaIo\Providers;

use Henrotaym\LaravelApiClient\Client;
use Henrotaym\LaravelTrustupMediaIo\Package;
use Henrotaym\LaravelTrustupMediaIo\Models\Media;
use Henrotaym\LaravelTrustupMediaIo\Models\Conversion;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelTrustupMediaIo\Models\StorableMedia;
use Henrotaym\LaravelTrustupMediaIo\Endpoints\MediaEndpoint;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Henrotaym\LaravelTrustupMediaIo\Requests\Media\GetMediaRequest;
use Henrotaym\LaravelTrustupMediaIo\Requests\Media\StoreMediaRequest;
use Henrotaym\LaravelTrustupMediaIo\Responses\Media\GetMediaResponse;
use Henrotaym\LaravelTrustupMediaIo\Credentials\Media\MediaCredential;
use Henrotaym\LaravelTrustupMediaIo\Responses\Media\StoreMediaResponse;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;
use Henrotaym\LaravelTrustupMediaIo\Transformers\Models\MediaTransformer;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\StorableMediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Transformers\Models\ConversionTransformer;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Transformers\Models\StorableMediaTransformer;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\MediaTransformerContract;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\ConversionTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\StorableMediaTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media\GetMediaRequestTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media\StoreMediaRequestTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Transformers\Requests\Media\GetMediaRequestTransformer;
use Henrotaym\LaravelTrustupMediaIo\Transformers\Requests\Media\StoreMediaRequestTransformer;

class LaravelTrustupMediaIoServiceProvider extends VersionablePackageServiceProvider
{
    public static function getPackageClass(): string
    {
        return Package::class;
    }

    protected function addToRegister(): void
    {
        $this->registerMediaEndpoint();

        $this->app->bind(MediaEndpointContract::class, MediaEndpoint::class);
        $this->app->bind(ConversionContract::class, Conversion::class);
        $this->app->bind(MediaContract::class, Media::class);
        $this->app->bind(StorableMediaContract::class, StorableMedia::class);
        $this->app->bind(GetMediaRequestContract::class, GetMediaRequest::class);
        $this->app->bind(StoreMediaRequestContract::class, StoreMediaRequest::class);
        $this->app->bind(GetMediaResponseContract::class, GetMediaResponse::class);
        $this->app->bind(StoreMediaResponseContract::class, StoreMediaResponse::class);
        $this->app->bind(ConversionTransformerContract::class, ConversionTransformer::class);
        $this->app->bind(MediaTransformerContract::class, MediaTransformer::class);
        $this->app->bind(StorableMediaTransformerContract::class, StorableMediaTransformer::class);
        $this->app->bind(GetMediaRequestTransformerContract::class, GetMediaRequestTransformer::class);
        $this->app->bind(StoreMediaRequestTransformerContract::class, StoreMediaRequestTransformer::class);
    }

    protected function registerMediaEndpoint(): self
    {
        $this->app->when(MediaEndpoint::class)
            ->needs(ClientContract::class)
            ->give(fn ($app) => $app->make(Client::class, ['credential' => new MediaCredential]));

        return $this;
    }

    protected function addToBoot(): void
    {
        //
    }
}