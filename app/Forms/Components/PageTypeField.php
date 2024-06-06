<?php

namespace App\Forms\Components;

use App\Enums\PageTypeEnum;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;

use function __;

class PageTypeField extends Select
{
    const FIELD = 'page_type';

    public static function create(): static
    {
        return static::make(static::FIELD)
            ->label(__('Page type'))
            ->helperText('')
            ->options(
                collect(PageTypeEnum::cases())->mapWithKeys(
                    fn (PageTypeEnum $enum) => [$enum->value => __($enum->value)]
                )
            )
            ->disabled(fn (?Model $record) => $record->page_type === PageTypeEnum::HOME)
            ->searchable()
            //Disable home page
            ->required();
    }
}
