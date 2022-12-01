<?php

namespace App\Http\Controllers\Api\V1\NewYorkTimes;

use App\Services\NewYorkTimesService;
use App\DataTransferObjects\BestSellerRequestDto;
use App\Http\Requests\Api\NewYorkTimesBestSellerRequest;

class NewYorkTimeBestSellerController
{

    public function __construct(
        protected NewYorkTimesService $newYorkTimesService = new NewYorkTimesService(),
    )
    {}

    public function __invoke(NewYorkTimesBestSellerRequest $request)
    {
        return $this->newYorkTimesService->getBestSellingBooks(
            BestSellerRequestDto::fromRequest($request),
        );
    }
}
