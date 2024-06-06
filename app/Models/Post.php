<?php

namespace App\Models;

use App\Concerns\HasPageTypeTrait;
use App\Concerns\HasTranslatedJsonLdAttributeTrait;
use App\Contracts\HasJsonLdAttribute;
use App\Contracts\HasPageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasAuthorAttributeTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasDefaultContentBlocksTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedContentBlocksTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedHeroImageAttributesTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedIntroAttributeTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedOverviewAttributesTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedPageAttributesTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedSEOAttributesTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedSlugAttributeTrait;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasContentBlocks;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasHeroImageAttributes;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasIntroAttribute;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasMediaAttributes;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasOverviewAttributes;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasPageAttributes;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasSEOAttributes;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasTranslatableMedia;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\Linkable;

class Post extends Model implements HasContentBlocks, HasHeroImageAttributes, HasIntroAttribute, HasJsonLdAttribute, HasMedia, HasMediaAttributes, HasOverviewAttributes, HasPageAttributes, HasPageType, HasSEOAttributes, HasTranslatableMedia, Linkable
{
    use HasAuthorAttributeTrait;
    use HasDefaultContentBlocksTrait;
    use HasFactory;
    use HasPageTypeTrait;
    use HasTranslatedContentBlocksTrait;
    use HasTranslatedHeroImageAttributesTrait;
    use HasTranslatedIntroAttributeTrait;
    use HasTranslatedJsonLdAttributeTrait;
    use HasTranslatedOverviewAttributesTrait;
    use HasTranslatedPageAttributesTrait;
    use HasTranslatedSEOAttributesTrait;
    use HasTranslatedSlugAttributeTrait;

    public function getViewUrl(?string $locale = null): string
    {
        //toggle the locale to make sure the slug gets translated:
        $currentLocale = app()->getLocale();
        $locale = $locale ?? $currentLocale;

        return $this->translate('slug', $locale);
    }

    public function getPreviewUrl(?string $locale = null): string
    {
        return $this->getViewUrl($locale);
    }
}
