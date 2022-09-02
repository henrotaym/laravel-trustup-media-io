<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\_Private;

use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Illuminate\Support\Collection;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Illuminate\Contracts\Support\Arrayable;

interface MediaResponseContract extends Arrayable
{
    public function ok(): bool;

    public function getStatusCode(): int;

    public function hasMedia(): bool;

    public function getResponse(): TryResponseContract;

    /** @return Collection<int, MediaContract> */
    public function getMedia(): Collection;

    public function getFirstMedia(): ?MediaContract;

    /** @return static */
    public function setResponse(TryResponseContract $response): MediaResponseContract;
}