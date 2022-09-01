<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

interface ConversionContract
{
    public function getUrl(): string;

    public function getName(): string;

    /** @return static */
    public function setName(string $name): ConversionContract;

    /** @return static */
    public function setUrl(string $url): ConversionContract;
}