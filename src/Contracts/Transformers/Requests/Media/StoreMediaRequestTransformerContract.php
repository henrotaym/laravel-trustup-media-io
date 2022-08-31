<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Requests\Media;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\StoreMediaRequestContract;

interface StoreMediaRequestTransformerContract
{
    public function fromArray(array $attributes): StoreMediaRequestContract;

    public function toArray(StoreMediaRequestContract $request): array;
}