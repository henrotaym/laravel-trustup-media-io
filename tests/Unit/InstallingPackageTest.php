<?php
namespace Henrotaym\LaravelTrustupMediaIo\Tests\Unit;

use Henrotaym\LaravelTrustupMediaIo\Tests\TestCase;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\StorableMediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\StoreMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\StoreMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\MediaTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\ConversionTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\StorableMediaTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media\GetMediaRequestTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media\StoreMediaRequestTransformerContract;

class InstallingPackageTest extends TestCase
{
    use InstallPackageTest;

    /** @test */
    public function gettingMediaClient()
    {
        dd(
            $this->app->make(MediaEndpointContract::class),
            $this->app->make(ConversionContract::class),
            $this->app->make(MediaContract::class),
            $this->app->make(StorableMediaContract::class),
            $this->app->make(GetMediaRequestContract::class),
            $this->app->make(StoreMediaRequestContract::class),
            $this->app->make(GetMediaResponseContract::class),
            $this->app->make(StoreMediaResponseContract::class),
            $this->app->make(ConversionTransformerContract::class),
            $this->app->make(MediaTransformerContract::class),
            $this->app->make(StorableMediaTransformerContract::class),
            $this->app->make(GetMediaRequestTransformerContract::class),
            $this->app->make(StoreMediaRequestTransformerContract::class),
        );
    }
}