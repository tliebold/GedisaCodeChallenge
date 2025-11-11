<?php

namespace App\Services;

use App\Dto\MovieDetail;

class MovieDetailService
{

    public function __construct(
        private readonly OmdbApiService $omdbApiService,
    ) {
    }

    public function getDetail(string $imdbID): MovieDetail
    {
        $searchResult = $this->omdbApiService->get(['i' => $imdbID, 'plot' => 'full']);

        return MovieDetail::fromArray($searchResult);
    }
}
