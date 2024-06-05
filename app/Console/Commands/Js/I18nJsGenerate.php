<?php

namespace App\Console\Commands\Js;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Attribute\AsCommand;

use function resource_path;
use function view;

#[AsCommand('i18n:generate', 'Generate i18n.js for frontend multilingual vue-i18n')]
class I18nJsGenerate extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $js = view('js.i18n')->render();

        File::put(resource_path('js/i18n.js'), $js);

        return static::SUCCESS;
    }
}
