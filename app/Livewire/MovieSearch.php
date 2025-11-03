<?php

namespace App\Livewire;

use App\Dto\Movie;
use App\Dto\MovieSearchResult;
use App\Models\MovieSearchModel;
use Livewire\Component;

class MovieSearch extends Component
{
    private readonly MovieSearchModel $movieSearchModel;
    public function boot(
        MovieSearchModel $movieSearchModel
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
        $this->movieSearchResult = $this->movieSearchModel->search($this->movieTitle, $this->page);
        $this->maxPage = (int) $this->movieSearchResult->getTotalResults() / 10 + 1;
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
