<?php
namespace Henrotaym\LaravelTrustupMediaIo\Responses\Media\_Private;

use Illuminate\Support\Collection;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\MediaTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Responses\Media\_Private\MediaResponseContract;

abstract class MediaResponse implements MediaResponseContract
{
    protected TryResponseContract $response;
    protected MediaTransformerContract $transformer;

    public function __construct(MediaTransformerContract $transformer)
    {
        $this->transformer = $transformer;
    }

    /** @var Collection<int, MediaContract> */
    protected Collection $media;

    public function ok(): bool
    {
        return $this->response->ok();
    }

    public function getStatusCode(): int
    {
        return $this->response->response()->response()->status();
    }

    public function hasMedia(): bool
    {
        return $this->getMedia()->isNotEmpty();
    }

    public function getResponse(): TryResponseContract
    {
        return $this->response;
    }

    /** @return Collection<int, MediaContract> */
    public function getMedia(): Collection
    {
        return $this->media ??
            $this->media = collect();
    }

    public function getFirstMedia(): ?MediaContract
    {
        return $this->getMedia()->first();
    }

    /** @return static */
    public function setResponse(TryResponseContract $response): MediaResponseContract
    {
        $this->response = $response;
        $this->parseResponse();

        return $this;
    }

    protected function parseResponse()
    {
        if ($this->response->failed()):
            return;
        endif;

        $media = $this->response->response()->get(true)['data'] ?? null;
        
        if (!$media):
            return;
        endif;

        $this->media = collect($media)->map(fn (array $rawMedia) => 
            $this->transformer->fromArray($rawMedia)
        );
    }

    public function toArray()
    {
        return $this->ok() ?
            $this->getResponse()->response()->toArray()
            : $this->getResponse()->error()->context();
    }
}