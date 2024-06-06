<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\Cacheable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use function collect;

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
            fn () => Post::findBySlug($slug)
        );

        if (! $request->inertia()) {
            $this->sharedData();
        }

        if (empty($post)) {
            return $this->notFound($request);
        }

        $blockClasses = $post::registerContentBlocks();
        $blockClassIndex = collect($blockClasses)->mapWithKeys(fn ($item, $key) => [$item::getName() => $item]);
        $blocks = [];

        foreach ($post->content_blocks as $blockData) {
            if (isset($blockData['type']) && $blockClassIndex->has($blockData['type'])) {
                $blockClass = $blockClassIndex->get($blockData['type']);
                $blocks[] = new $blockClass($post, $blockData['data']);
            }
        }

        $data = [];

        $response = Inertia::render('Home', $data)
            ->title($post->getSEOTitle())
            ->description($post->getSEODescription());

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $response->tag(
                sprintf(
                    '<link rel="alternate" hreflang="%s" href="%s" />',
                    $locale,
                    LaravelLocalization::getLocalizedUrl($locale, $post->getTranslation('slug', $locale))
                )
            );
        }

        $response->tag(
            sprintf(
                '<link rel="alternate" hreflang="x-default" href="%s" />',
                LaravelLocalization::getLocalizedUrl(
                    LaravelLocalization::getDefaultLocale(),
                    $post->getTranslation('slug', LaravelLocalization::getDefaultLocale())
                )
            )
        );

        return $response;
    }

    // TODO: make cache for performance
    protected function sharedData(): void
    {
        Inertia::share('global', []);
    }

    protected function notFound(
        Request $request
    ): JsonResponse|\Symfony\Component\HttpFoundation\Response {
        $localizedUrls = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $localizedUrls[$locale] = LaravelLocalization::getLocalizedUrl($locale);
        }

        return Inertia::render('Errors/NotFound', compact('localizedUrls'))
            ->title(__('Not found'))
            ->toResponse($request)
            ->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
    }
}
