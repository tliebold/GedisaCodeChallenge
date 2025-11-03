<?php

namespace App\Dto;

class MovieSearchResult
{
    private int $totalResults;

    /**
     * @var array<int, Movie>
     */
    private array $movies = [];

    public static function fromArray(array $arr): MovieSearchResult
    {
        $movieSearchResult = new MovieSearchResult();
        $movieSearchResult->totalResults = $arr['totalResults'];
        $movies = [];
        foreach ($arr['Search'] as $movieArr) {
            $movies[] = Movie::fromArray($movieArr);
        }
        $movieSearchResult->setMovies($movies);

        return $movieSearchResult;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function setTotalResults(int $totalResults): void
    {
        $this->totalResults = $totalResults;
    }

    public function getMovies(): array
    {
        return $this->movies;
    }

    public function setMovies(array $movies): void
    {
        $this->movies = $movies;
    }
}
