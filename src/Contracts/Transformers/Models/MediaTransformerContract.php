<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;

interface MediaTransformerContract
{
    public function fromArray(array $attributes): MediaContract;
}