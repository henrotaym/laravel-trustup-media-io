<?php

namespace Henrotaym\LaravelTrustupMediaIo\Tests\Unit;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Endpoints\MediaEndpointContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\GetMediaResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Models\MediaRelationLoadingCallback;
use Henrotaym\LaravelTrustupMediaIo\Tests\TestCase;
use Henrotaym\LaravelTrustupMediaIoCommon\Contracts\Requests\Media\GetMediaRequestContract;
use Illuminate\Support\Collection;

class MediaRelationLoadingCallbackTest extends TestCase
{
    /** @test */
    public function loading_identifiers_uses_the_search_endpoint_in_a_single_request()
    {
        $identifiers = $this->identifiers(250);
        $callback = new MediaRelationLoadingCallback($this->endpointEchoingUuids($requestedUuidCounts));

        $media = $callback->load($identifiers);

        $this->assertEquals([250], $requestedUuidCounts);
        $this->assertEquals($identifiers->values()->all(), $media->values()->all());
    }

    protected function identifiers(int $count): Collection
    {
        return collect(range(1, $count))->map(fn (int $index) => "uuid-$index");
    }

    protected function endpointEchoingUuids(?array &$requestedUuidCounts): MediaEndpointContract
    {
        $requestedUuidCounts = [];

        $endpoint = $this->createMock(MediaEndpointContract::class);
        $endpoint->expects($this->never())->method('get');
        $endpoint->method('search')->willReturnCallback(function (GetMediaRequestContract $request) use (&$requestedUuidCounts) {
            $requestedUuidCounts[] = $request->getUuids()->count();

            $response = $this->createMock(GetMediaResponseContract::class);
            $response->method('getMedia')->willReturn($request->getUuids()->values());

            return $response;
        });

        return $endpoint;
    }
}
