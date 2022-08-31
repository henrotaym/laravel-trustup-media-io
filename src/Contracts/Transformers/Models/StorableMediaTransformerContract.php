<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\StorableMediaContract;

interface StorableMediaTransformerContract
{
    public function fromArray(array $attributes): ?StorableMediaContract;

    public function fromResource($resource): ?StorableMediaContract;

    public function toArray(StorableMediaContract $media): array;
}