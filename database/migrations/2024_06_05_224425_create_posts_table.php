<?php

use App\Enums\PageTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            //Page type:
            $table->enum('page_type', collect(PageTypeEnum::cases())->pluck('value')->toArray());

            $table->json('title')->nullable(); //Default only works on JSON on MySQL 8 or newer

            //Intro:
            $table->json('intro')->nullable();

            //Hero image:
            $table->json('hero_image_copyright')->nullable();
            $table->json('hero_image_title')->nullable();

            //Publishing:
            $table->timestamp('publishing_begins_at')->nullable();
            $table->timestamp('publishing_ends_at')->nullable();
            $table->index('publishing_begins_at');
            $table->index('publishing_ends_at');

            //SEO:
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->json('seo_keywords')->nullable();

            //Overview:
            $table->json('overview_title')->nullable();
            $table->json('overview_description')->nullable();

            //Content blocks:
            $table->json('content_blocks')->nullable(); //Default only works on JSON on MySQL 8 or newer

            //Slug:
            $table->json('slug')->nullable();

            //JSON-LD:
            $table->json('json_ld')->nullable();

            //Author:
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')
                ->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
