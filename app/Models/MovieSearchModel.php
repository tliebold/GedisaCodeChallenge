<?php

namespace App\Models;

use App\Dto\Movie;
use App\Dto\MovieDetail;
use App\Dto\MovieSearchResult;

class MovieSearchModel
{
    public function __construct(
        private readonly OmdbApiService $omdbApiService,
    )
    {
    }

    public function search(string $title, int $page): MovieSearchResult
    {
        $searchResult = $this->omdbApiService->get(['s' => $title, 'page' => $page]);

        return MovieSearchResult::fromArray($searchResult);
    }

    public function getDetail(string $imdbID): MovieDetail
    {
        $searchResult = $this->omdbApiService->get(['i' => $imdbID, 'plot' => 'full']);

        return MovieDetail::fromArray($searchResult);
    }
}
