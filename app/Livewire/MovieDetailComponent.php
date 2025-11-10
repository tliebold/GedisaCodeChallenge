<?php

namespace App\Livewire;

use App\Dto\MovieDetail;
use App\Models\MovieRating;
use App\Services\MovieSearchService;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class MovieDetailComponent extends Component
{
    private MovieSearchService $searchModel;

    public string $imdbID;

    private ?MovieDetail $movieDetail = null;

    #[Reactive]
    private ?MovieRating $movieRating = null;

    public function setRating(int $rating): void
    {
        $this->movieRating = MovieRating::query()->where(['imdb_id' => $this->imdbID])->first();
        if ($this->movieRating === null) {
            $this->movieRating = new MovieRating();
            $this->movieRating->imdb_id = $this->imdbID;
        }
        $this->movieRating->fill([
            'title' => $this->movieDetail->getTitle(),
            'year' => $this->movieDetail->getYear(),
            'poster' => $this->movieDetail->getPoster(),
            'rating' => $rating,
        ]);
        $this->movieRating->save();
    }

    public function boot(MovieSearchService $movieSearchModel)
    {
        $this->searchModel = $movieSearchModel;
        $this->movieDetail = $this->searchModel->getDetail($this->imdbID);
        $this->movieRating = MovieRating::query()->where(['movie_ratings.imdb_id' => $this->imdbID])->first();
    }

    public function mount(string $imdbID): void
    {
        $this->imdbID = $imdbID;
    }

    public function render()
    {
        return view('livewire.movie-detail', [
            'movieDetail' => $this->movieDetail,
            'movieRating' => $this->movieRating,
        ]);
    }
}
