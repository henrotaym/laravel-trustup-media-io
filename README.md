# Laravel trustup media io
## Installation

### Require package
``` shell
composer require henrotaym/laravel-trustup-media-io
```

### Set environment variables
``` dotenv
TRUSTUP_MEDIA_IO_URL=
TRUSTUP_APP_KEY=

TRUSTUP_SERVER_AUTHORIZATION=
```

### Prepare your models

Your model should look like this

``` php
<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Henrotaym\LaravelTrustupMediaIo\Models\Traits\HasTrustupMedia;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\MediaContract;
use Henrotaym\LaravelTrustupMediaIoCommon\Enums\Media\MediaCollections;
use Henrotaym\LaravelTrustupMediaIo\Contracts\Models\HasTrustupMediaContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationContract;

class Post implements HasTrustupMediaContract
{
    use HasTrustupMedia;

    public function getExternalRelationNames(): array
    {
        return [
            'cover',
            'images'
        ];
    }

    /**
     * Cover relation.
     * 
     * @return ExternalModelRelationContract
     */
    public function cover(): ExternalModelRelationContract
    {
        return $this->hasOneTrustupMedia('cover_id');
    }

    /**
     * Images relation
     * 
     * @return ExternalModelRelationContract
     */
    public function images(): ExternalModelRelationContract
    {
        return $this->hasManyTrustupMedia('image_ids');
    }

    /**
     * Getting related images.
     * 
     * @return Collection<int, MediaContract>
     */
    public function getImages(): Collection
    {
        return $this->getExternalModels('images');
    }

    /**
     * Getting related cover.
     * 
     * @return ?MediaContract
     */
    public function getCover(): ?MediaContract
    {
        return $this->getExternalModels('cover');
    }

    /**
     * Setting cover.
     * 
     * @param string|UploadedFile $resource
     * @return static
     */
    public function setCover(string|UploadedFile $resource): self
    {
        // Removing old cover if any.
        $this->removeCover();

        $response = $this->addTrustupMediaFromResource($resource, MediaCollections::IMAGES);

        if (!$response->ok()) return $this;

        $this->cover()->setRelatedModels($response->getFirstMedia());
    }

    /**
     * Removing current cover.
     * 
     * @return static
     */
    public function removeCover(): self
    {
        if (!$this->cover_id) return $this;

        $response = $this->deleteTrustupMediaByUuidCollection(collect($this->cover_id));

        if (!$response->ok()) return $this;

        $this->cover()->setRelatedModels(null);
    }

    /**
     * Adding given image
     * 
     * @param string|UploadedFile $resource
     * @return static
     */
    public function addImage(string|UploadedFile $resource): self
    {
        $response = $this->addTrustupMediaFromResource($resource, MediaCollections::IMAGES);

        if (!$response->ok()) return $this;

        $this->images()->addToRelatedModels($response->getFirstMedia());
    }

    /**
     * Adding given images.
     * 
     * @param Collection<int, string|UploadedFile>
     * @return static
     */
    public function addImages(Collection $resources)
    {
        $response = $this->addTrustupMediaFromResourceCollection($resources, MediaCollections::IMAGES);

        if (!$response->ok()) return $this;

        $this->images()->addToRelatedModels($response->getMedia());
    }

    /**
     * Removing current images.
     * 
     * @return static
     */
    public function removeImages(): self
    {
        if ($this->image_ids) return $this;

        $response = $this->deleteTrustupMediaByUuidCollection($this->image_ids);

        if (!$response->ok()) return $this;

        $this->images()->setRelatedModels(null);
    }
}
```
