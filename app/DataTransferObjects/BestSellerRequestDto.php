<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Api\NewYorkTimesBestSellerRequest;

class BestSellerRequestDto
{

    public function __construct(
        public readonly ?string $author,
        public readonly array $isbn,
        public readonly ?string $title,
        public readonly int $offset,
    ) {}


    public static function fromRequest(NewYorkTimesBestSellerRequest $request): BestSellerRequestDto
    {
        return new self(
            $request->validated('author'),
            $request->validated('isbn') ?? [],
            $request->validated('author'),
            (int) $request->validated('offset'),
        );
    }
}
