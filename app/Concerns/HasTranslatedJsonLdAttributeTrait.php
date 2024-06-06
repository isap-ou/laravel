<?php

namespace App\Concerns;

use Statikbe\FilamentFlexibleContentBlocks\Models\Concerns\HasTranslatedAttributesTrait;

trait HasTranslatedJsonLdAttributeTrait
{
    use HasJsonLdAttributeTrait;
    use HasTranslatedAttributesTrait;

    public function initializeHasTranslatedJsonLdAttributeTrait(): void
    {
        $this->mergeTranslatable(['json_ld']);
    }
}
