<?php

namespace App\Http\Controllers\App;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Enums\BlogPostSource;
use Illuminate\Http\JsonResponse;
use App\Services\Blog\BlogPostService;
use App\DataTransferObjects\BlogPostDto;
use App\Http\Requests\App\BlogPostRequest;
use App\Http\Resources\App\BlogPostResource;

class BlogPostController
{
    public function __construct(
        protected BlogPostService $service,
    ) {

    }

    public function store(BlogPostRequest $request): BlogPostResource
    {
        $post = $this->service->store(
            BlogPostDto::fromAppRequest($request),
        );

        return BlogPostResource::make(
            $post,
        );
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost): BlogPostResource
    {
        $post = $this->service->update(
            $blogPost,
            BlogPostDto::fromAppRequest($request),
        );

        return BlogPostResource::make(
            $post,
        );
    }
}
