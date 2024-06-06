<?php

namespace App\Concerns;

use App\Enums\PageTypeEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasPageTypeTrait
{
    public function initializeHasCodeTrait(): void
    {
        $this->mergeFillable(['page_type']);
        $this->mergeCasts([
            'page_type' => PageTypeEnum::class,
        ]);
    }

    public function scopeCode(Builder $query, string $pageType): Builder
    {
        return $query->where('page_type', $pageType);
    }
}
