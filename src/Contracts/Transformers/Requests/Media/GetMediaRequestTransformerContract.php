<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;

interface GetMediaRequestTransformerContract
{
    public function fromArray(array $attributes): GetMediaRequestContract;

    public function toArray(GetMediaRequestContract $request): array;
}