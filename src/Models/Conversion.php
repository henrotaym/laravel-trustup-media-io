<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;

class Conversion implements ConversionContract
{
    protected string $url;

    public function getUrl(): string
    {
        return $this->url;
    }

    /** @return static */
    public function setUrl(string $url): ConversionContract
    {
        $this->url = $url;

        return $this;
    }
}