<?php

namespace App\Concerns;

/**
 * @mixin \App\Contracts\HasJsonLdAttribute
 */
trait HasJsonLdAttributeTrait
{
    public function initializeHasJsonLdAttributeTrait(): void
    {
        $this->mergeFillable(['json_ld']);
    }
}
