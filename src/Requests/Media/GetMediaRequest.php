<?php
namespace Henrotaym\LaravelTrustupMediaIo\Requests\Media;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Requests\Media\GetMediaRequestContract;
use Henrotaym\LaravelTrustupMediaIo\Requests\Media\_Private\MediaRequest;

class GetMediaRequest extends MediaRequest implements GetMediaRequestContract
{
    protected bool $isFirstOnly = false;

    public function isUsingFirstOnly(): bool
    {
        return $this->isFirstOnly;
    }

    /** @return static */
    public function firstOnly(bool $firstOnly = true): GetMediaRequestContract
    {
        $this->isFirstOnly = $firstOnly;

        return $this;
    }
}