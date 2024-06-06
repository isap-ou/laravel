<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * A code is a unique field to identify a page
 *
 * @property string $code
 */
interface HasPageType
{
    public function scopeCode(Builder $query, string $pageType): Builder;
}
