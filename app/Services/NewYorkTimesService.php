<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use App\DataTransferObjects\BestSellerRequestDto;

class NewYorkTimesService
{
    protected PendingRequest $http;

    public function __construct() {
        $this->http = Http::baseUrl('https://api.nytimes.com/svc/books/v3/')
            ->acceptJson()
            ->asJson();
    }


    public function getBestSellingBooks(BestSellerRequestDto $dto)
    {
        return $this->http->get('lists/best-sellers/history.json', $this->buildPayload([
            'author' => $dto->author,
            'isbn' => implode(';', $dto->isbn) ?: null,
            'title' => $dto->title,
            'offset' => $dto->offset,
        ]))->json();
    }

    private function buildPayload(array $payload): array
    {
        return array_merge($payload, [
            'api-key' => config('services.newyorktimes.key'),
        ]);
    }
}
