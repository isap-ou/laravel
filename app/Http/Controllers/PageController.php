<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\Cacheable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use function __;

class PageController extends Controller
{
    use Cacheable;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug = '/')
    {
        /** @var Post $post */
        $post = Cache::remember(
            $this->getCacheKey('post', $slug, LaravelLocalization::getCurrentLocale()),
            $this->getCacheTtl(),
            fn() => Post::findBySlug($slug)
        );

        $this->sharedData();

        if (empty($post)) {
            return $this->notFound($request);
        }

        SEOTools::setTitle($post->getSEOTitle());
        SEOTools::setDescription($post->getSEODescription());
        SEOTools::jsonLd()->addImage($post->getSEOImageUrl());
        SEOTools::opengraph()->addImage($post->getSEOImageUrl());


        return view('pages.' . $post->page_type, [
            'post' => $post,
        ]);
    }

    // TODO: make cache for performance
    protected function sharedData(): void
    {
        // Implement View::share if needed
    }

    protected function notFound(
        Request $request
    ): \Illuminate\Http\Response {
        SEOTools::setTitle(__('Page not found'));
        return response()->view('pages.errors.404')->setStatusCode(404);
    }
}
