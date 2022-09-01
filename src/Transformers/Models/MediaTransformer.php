<?php
namespace Henrotaym\LaravelTrustupMediaIo\Transformers\Models;

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
            ->setUrl($attributes['url']);
    }
}