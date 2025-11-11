<?php

namespace App\Livewire;

use App\Dto\MovieSearchResult;
use App\Models\MovieRating;
use App\Services\MovieSearchService;
use Livewire\Component;

class MovieSearch extends Component
{
    private readonly MovieSearchService $movieSearchModel;
    public function boot(
        MovieSearchService $movieSearchModel
    ) {
        $this->movieSearchModel = $movieSearchModel;
    }

    public int $page = 1;

    public int $maxPage = 1;

    public ?string $movieTitle = null;

    private ?MovieSearchResult $movieSearchResult = null;

    public function setMovieTitle(string $title): void
    {
        $this->movieTitle = $title;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
        $this->searchMovie();
    }

    public function searchMovie(): void
    {
        $rowsPerPage = 10;
        $searchResult = $this->movieSearchModel->search($this->movieTitle, $this->page);
        foreach ($searchResult->getMovies() as $movie) {
            $rating = MovieRating::query()->firstWhere('imdb_id', '=', $movie->getImdbID());
            $movie->setRating($rating?->getAverageRating());
        }
        $this->movieSearchResult = $searchResult;
        if ($this->movieSearchResult->getTotalResults() % $rowsPerPage === 0) {
            $this->maxPage = (int) ($this->movieSearchResult->getTotalResults() / $rowsPerPage);
        } else {
            $this->maxPage = (int) ($this->movieSearchResult->getTotalResults() / $rowsPerPage) + 1;
        }
    }

    public function movieDetail(string $imdbID): void
    {
        $this->redirectRoute('movie-detail', ['imdbID' => $imdbID]);
    }

    public function render()
    {
        return view('livewire.movie-search', ['movieSearchResult' => $this->movieSearchResult]);
    }
}
