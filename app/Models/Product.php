<?php

namespace App\Models;

use DateTimeInterface;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    public const DRAFTED_STATUS = 'drafted';
    public const PUBLISHED_STATUS = 'published';

    public const STATUSES = [
        self::DRAFTED_STATUS,
        self::PUBLISHED_STATUS,
    ];

    public const COVER_MEDIA_COLLECTION = 'product_cover';
    public const IMAGES_MEDIA_COLLECTION = 'product_images';

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'status',
    ];

    protected $appends = [
        'cover',
        'images',
    ];

    public function getCoverAttribute()
    {
        return $this->getFirstMediaUrl(self::COVER_MEDIA_COLLECTION);
    }

    public function getImagesAttribute()
    {
        return $this->getMedia(self::IMAGES_MEDIA_COLLECTION)->pluck('original_url')->toArray();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('panel.datetime_format'));
    }
}
