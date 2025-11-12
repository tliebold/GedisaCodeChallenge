<?php

namespace App\Livewire;

use App\Dto\MovieDetail;
use App\Models\MovieRating;
use App\Services\MovieDetailService;
use App\Services\MovieRatingService;
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
    private MovieRatingService $movieRatingService;

    public function setRating(int $rating): void
    {
        try {
            $this->movieRating = $this->movieRatingService->setRating($this->movieDetail, $rating, auth()->user());
        } catch (\Throwable $e) {
            $this->addError($e::class, $e->getMessage());
        }
        $this->averageRating = $this->movieRating?->getAverageRating();
    }

    public function boot(MovieDetailService $movieDetailService, MovieRatingService $movieRatingService)
    {
        $this->movieRatingService = $movieRatingService;

        $this->movieDetail = $movieDetailService->getDetail($this->imdbID);
        $this->movieRating = MovieRating::query()->where([
            'imdb_id' => $this->imdbID,
            'user_id' => auth()->id(),
        ])->first();
        $this->averageRating = $this->movieRatingService->getAverageRating($this->imdbID);
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
