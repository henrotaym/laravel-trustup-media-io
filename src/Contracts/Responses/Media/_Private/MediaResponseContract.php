<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\_Private;

use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Illuminate\Support\Collection;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;

interface MediaResponseContract
{
    public function ok(): bool;

    public function hasMedia(): bool;

    public function getResponse(): TryResponseContract;

    /** @return Collection<int, MediaContract> */
    public function getMedia(): Collection;

    public function getFirstMedia(): ?MediaContract;

    /** @return static */
    public function setResponse(TryResponseContract $response): MediaResponseContract;
}