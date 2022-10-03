<?php
namespace Henrotaym\LaravelTrustupMediaIo\Models\Traits;

use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\_Private\HasDimensionsContract;

trait HasDimensions
{
    protected ?int $width;
    protected ?int $height;

    public function getWitdh(): ?int
    {
        return $this->width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    /** @return static */
    public function setWitdh(?int $width): HasDimensionsContract
    {
        $this->width = $width;

        return $this;
    }

    /** @return static */
    public function setHeight(?int $width): HasDimensionsContract
    {
        $this->height = $width;

        return $this;
    }
}