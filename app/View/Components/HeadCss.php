<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

use function public_path;

class HeadCss extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $headCss = [])
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.head-css');
    }

    public function inlineCss(): string
    {
        $manifestPath = public_path('build/manifest.json');

        if (! File::exists($manifestPath)) {
            return '';
        }

        $manifest = File::json($manifestPath);

        return File::get(public_path('build/' . $manifest['resources/css/app.css']['file']));
    }

    public function css(): array
    {
        $manifestPath = public_path('build/manifest.json');

        if (! File::exists($manifestPath)) {
            return [];
        }

        $manifest = File::json($manifestPath);

        $files = [
            $manifest['webfonts.css']['file'],
            //            $manifest['resources/css/app.css']['file'],
        ];

        foreach ($this->headCss as $file) {
            if (isset($manifest[$file])) {
                $files[] = $manifest[$file]['file'];
            }
        }

        return $files;
    }
}
