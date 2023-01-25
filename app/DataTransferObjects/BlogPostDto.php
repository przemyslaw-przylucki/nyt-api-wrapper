<?php

namespace App\DataTransferObjects;

use App\Enums\BlogPostSource;
use App\Http\Requests\App\BlogPostRequest as AppBlogPostRequest;
use App\Http\Requests\Api\BlogPostRequest as ApiBlogPostRequest;

class BlogPostDto
{

    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly BlogPostSource $source,
    )
    {

    }

    public static function fromAppRequest(AppBlogPostRequest $request): BlogPostDto
    {
        return new self(
            title: $request->validated('title'),
            content: $request->validated('content'),
            source: BlogPostSource::App,
        );
    }

    public static function fromApiRequest(ApiBlogPostRequest $request): BlogPostDto
    {
        return new self(
            title: $request->validated('payload.post.title'),
            content: $request->validated('payload.post.body'),
            source: BlogPostSource::Api,
        );
    }
}
