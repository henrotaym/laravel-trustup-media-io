<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

interface ConversionContract
{
    public function getUrl(): string;

    /** @return static */
    public function setUrl(string $url): ConversionContract;
}