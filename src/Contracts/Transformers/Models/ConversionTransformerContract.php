<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;

interface ConversionTransformerContract
{
    public function fromArray(array $attributes): ConversionContract;
}