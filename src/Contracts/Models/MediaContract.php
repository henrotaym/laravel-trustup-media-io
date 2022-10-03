<?php
namespace Henrotaym\LaravelTrustupMediaIo\Contracts\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\_Private\HasDimensionsContract;
use Illuminate\Support\Collection;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;

interface MediaContract extends HasDimensionsContract
{
    public function getId(): int;

    /** @return static */
    public function setId(int $id): MediaContract;

    public function getUrl(): string;
    
    /** @return static */
    public function setUrl(string $url): MediaContract;
    
    public function getUuid(): string;

    public function setUuid(string $uuid): MediaContract;

    public function hasConversions(): bool;

    /** @return Collection<int, ConversionContract> */
    public function getConversions(): Collection;

    /**
     * @param Collection<int, ConversionContract> $conversions
     * @return static
     */
    public function setConversions(Collection $conversions): MediaContract;

    public function getThumbnail(): ?ConversionContract;

    public function getConversion(string $name): ?ConversionContract;

    public function getCollection(): ?string;

    /** @return static */
    public function setCollection(?string $collection): MediaContract;

    public function hasCustomProperties(): bool;
    
    public function getCustomProperties(): array;

    /** @return static */
    public function setCustomProperties(array $customProperties): MediaContract;

    public function getAppKey(): ?string;

    /** @return static */
    public function setAppKey(?string $appKey): MediaContract;

    public function getModelType(): string;

    /** @return static */
    public function setModelType(string $modelType): MediaContract;

    public function getModelId(): int;

    /** @return static */
    public function setModelId(int $modelId): MediaContract;
}