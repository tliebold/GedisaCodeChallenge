<?php

namespace App\Services;

use App\Dto\MovieDetail;
use App\Dto\MovieSearchResult;

class MovieSearchService
{
    public function __construct(
        private readonly OmdbApiService $omdbApiService,
    ) {
    }

    public function search(string $title, int $page): MovieSearchResult
    {
        $searchResult = $this->omdbApiService->get(['s' => $title, 'page' => $page]);

        return MovieSearchResult::fromArray($searchResult);
    }
}
