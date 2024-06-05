<?php

namespace App\Models;

use App\Enums\MediaCollectionEnum;
use App\Enums\PageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;

use function array_keys;
use function collect;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasFlexible;
    use HasTranslatableSlug;
    use HasTranslations;
    use InteractsWithMedia;

    protected $connection = '';

    public $translatable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
    ];

    public function casts(): array
    {
        return [
            'title' => 'array',
            'meta_description' => 'array',
            'meta_title' => 'array',
            'slug' => 'array',
            'content' => 'array',
            'post_type' => PageTypeEnum::class,
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::createWithLocales(array_keys(LaravelLocalization::getSupportedLocales()))
            ->generateSlugsFrom(function ($model, $locale) {
                if ($model->post_type === PageTypeEnum::HOME) {
                    return '/';
                }

                return $model->title;
            })
            ->doNotGenerateSlugsOnUpdate()
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
