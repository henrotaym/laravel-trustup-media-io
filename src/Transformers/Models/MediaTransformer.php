<?php
namespace Henrotaym\LaravelTrustupMediaIo\Transformers\Models;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\ConversionContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\MediaTransformerContract;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Transformers\Models\ConversionTransformerContract;

class MediaTransformer implements MediaTransformerContract
{
    protected ConversionTransformerContract $conversionTransformer;

    public function __construct(ConversionTransformerContract $conversionTransformer)
    {
        $this->conversionTransformer = $conversionTransformer;
    }

    public function fromArray(array $attributes): MediaContract
    {
        /** @var MediaContract */
        $media = app()->make(MediaContract::class);

        return $media->setAppKey($attributes['app_key'] ?? null)
            ->setCollection($attributes['collection'] ?? null)
            ->setConversions(
                collect($attributes['conversions'] ?? [])
                    ->map(fn (array $rawConversion)
                        => $this->conversionTransformer->fromArray($rawConversion)
                    )
            )
            ->setCustomProperties($attributes['custom_properties'] ?? [])
            ->setId($attributes['id'])
            ->setModelId($attributes['model_id'])
            ->setModelType($attributes['model_type'])
            ->setUuid($attributes['uuid'])
            ->setUrl($attributes['url'])
            ->setWitdh($attributes['width'] ?? null)
            ->setHeight($attributes['height'] ?? null)
            ->setName($attributes['name'] ?? null)
            ->setOptimizedUrl($attributes['optimized_url'] ?? $attributes['url']);
    }

    public function toArray(MediaContract $media): array
    {
        return [
            'app_key' => $media->getAppKey(), 
            'collection' => $media->getCollection(), 
            'conversions' => $media->getConversions()->map(
                fn (ConversionContract $conversion) =>
                    $this->conversionTransformer->toArray($conversion)
            ),
            'custom_properties' => $media->getCustomProperties(), 
            'id' => $media->getId(), 
            'model_id' => $media->getModelId(), 
            'model_type' => $media->getModelType(), 
            'uuid' => $media->getUuid(), 
            'url' => $media->getUrl(),
            'optimized_url' => $media->getOptimizedUrl(),
            'width' => $media->getWitdh(),
            "height" => $media->getHeight(),
            "name" => $media->getName()
        ];
    }
}