<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models;

use Illuminate\Support\Collection;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;
use Henrotaym\LaravelTrustupMediaIo\Models\Traits\HasDimensions;

class Media implements MediaContract
{
    use HasDimensions;

    protected ?string $name = null;
    protected int $id;
    protected ?string $collection = null;
    protected ?string $appKey = null;
    protected string $uuid;
    protected string $modelType;
    protected int $modelId;
    protected string $url;
    /** @var Collection<int, ConversionContract> */
    protected Collection $conversions;
    protected array $customProperties = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): MediaContract
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /** @return static */
    public function setId(int $id): MediaContract
    {
        $this->id = $id;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /** @return static */
    public function setUrl(string $url): MediaContract
    {
        $this->url = $url;

        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): MediaContract
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function hasConversions(): bool
    {
        return count($this->conversions) > 0;
    }

    /** @return Collection<int, ConversionContract> */
    public function getConversions(): Collection
    {
        return $this->conversions ??
            $this->conversions = collect();
    }

    /**
     * @param Collection<int, ConversionContract> $conversions
     * @return static
     */
    public function setConversions(Collection $conversions): MediaContract
    {
        $this->conversions = $conversions;

        return $this;
    }

    public function getThumbnail(): ?ConversionContract
    {
        return $this->getConversion('thumbnail');
    }

    public function getConversion(string $name): ?ConversionContract
    {
        return $this->getConversions()->first(fn(ConversionContract $conversion) =>
            $conversion->getName() === $name
        );
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    /** @return static */
    public function setCollection(?string $collection): MediaContract
    {
        $this->collection = $collection;

        return $this;
    }

    public function hasCustomProperties(): bool
    {
        return count($this->customProperties) > 0;
    }
    
    public function getCustomProperties(): array
    {
        return $this->customProperties;
    }

    /** @return static */
    public function setCustomProperties(array $customProperties): MediaContract
    {
        $this->customProperties = $customProperties;

        return $this;
    }

    public function getAppKey(): ?string
    {
        return $this->appKey;
    }

    /** @return static */
    public function setAppKey(?string $appKey): MediaContract
    {
        $this->appKey = $appKey;

        return $this;
    }

    public function getModelType(): string
    {
        return $this->modelType;
    }

    /** @return static */
    public function setModelType(string $modelType): MediaContract
    {
        $this->modelType = $modelType;

        return $this;
    }

    public function getModelId(): int
    {
        return $this->modelId;
    }

    /** @return static */
    public function setModelId(int $modelId): MediaContract
    {
        $this->modelId = $modelId;

        return $this;
    }
}