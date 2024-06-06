<?php

namespace App\Forms\Components;

use Statikbe\FilamentFlexibleContentBlocks\Filament\Form\Fields\Concerns\HasTranslatableHint;
use ValentinMorice\FilamentJsonColumn\FilamentJsonColumn;

class JsonLdField extends FilamentJsonColumn
{
    use HasTranslatableHint;

    public static function create(): static
    {
        return static::make('json_ld')->label('JSON-LD')
            ->addsTranslatableHint();
    }
}
