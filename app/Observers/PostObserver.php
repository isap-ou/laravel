<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\Cacheable;
use Illuminate\Support\Facades\Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PostObserver
{
    use Cacheable;

    public function creating(Post $post)
    {
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->removeCache($post);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->removeCache($post);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->removeCache($post);
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function removeCache(Post $post): void
    {
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $language) {
            Cache::delete(
                $this->getCacheKey(
                    'post',
                    $post->getTranslation('slug', $language),
                    $language,
                )
            );
            Cache::delete($this->getCacheKey('post', $post->id, $language, 'content'));
        }
    }
}
