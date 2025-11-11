<?php

namespace App\Livewire;

use App\Dto\MovieDetail;
use App\Models\MovieRating;
use App\Services\MovieDetailService;
use App\Services\MovieSearchService;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class MovieDetailComponent extends Component
{
    public string $imdbID;

    private ?MovieDetail $movieDetail = null;

    public ?float $averageRating = null;

    #[Reactive]
    private ?MovieRating $movieRating = null;

    public function setRating(int $rating): void
    {
        $this->movieRating = MovieRating::query()->where([
            'imdb_id' => $this->imdbID,
            'user_id' => auth()->id(),
        ])->first();
        if ($this->movieRating === null) {
            $this->movieRating = new MovieRating();
            $this->movieRating->imdb_id = $this->imdbID;
        }
        $this->movieRating->fill([
            'title' => $this->movieDetail->getTitle(),
            'year' => $this->movieDetail->getYear(),
            'poster' => $this->movieDetail->getPoster(),
            'rating' => $rating,
            'user_id' => auth()->id(),
        ]);
        $this->movieRating->save();
        $this->averageRating = $this->movieRating?->getAverageRating();
    }

    public function boot(MovieDetailService $movieDetailService)
    {
        $this->movieDetail = $movieDetailService->getDetail($this->imdbID);
        $this->movieRating = MovieRating::query()->where([
            'imdb_id' => $this->imdbID,
            'user_id' => auth()->id(),
        ])->first();
        $this->averageRating = MovieRating::query()->where('imdb_id', '=', $this->imdbID)->avg('movie_ratings.rating');
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
