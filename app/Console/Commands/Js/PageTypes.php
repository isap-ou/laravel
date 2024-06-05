<?php

namespace App\Console\Commands\Js;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Attribute\AsCommand;

use function resource_path;
use function view;

#[AsCommand('js:page-types')]
class PageTypes extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $js = view('js.pageTypes')->render();

        File::put(resource_path('js/Enums/pageTypes.js'), $js);

        return static::SUCCESS;
    }
}
