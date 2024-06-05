<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\App;

use function implode;
use function sprintf;

trait Cacheable
{
    protected int $cacheTtl = 43200;

    protected function isLive(): bool
    {
        return ! App::hasDebugModeEnabled() && App::isProduction();
    }

    protected function getCacheKey(...$keys): string
    {
        return sprintf('%s_%s', App::environment(), implode('_', $keys));
    }

    protected function getCacheTtl(?int $cacheTtl = null): int
    {
        return ! $this->isLive() ? 1 : ($cacheTtl ?? $this->cacheTtl);
    }
}
