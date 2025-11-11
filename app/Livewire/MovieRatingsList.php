<?php

namespace App\Livewire;

use App\Models\MovieRating;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;

class MovieRatingsList extends Component
{
    public int $page = 1;

    public int $maxPage = 1;

    private Collection $movieRatings;

    public function setPage(int $page): void
    {
        $rowsPerPage = 10;
        $this->page = $page;
        $count = MovieRating::query()->count();
        if ($count % $rowsPerPage === 0) {
            $this->maxPage = (int) (MovieRating::query()->count() / $rowsPerPage);
        } else {
            $this->maxPage = (int) (MovieRating::query()->count() / $rowsPerPage) + 1;
        }
        $this->movieRatings = MovieRating::query()
            ->groupBy(['movie_ratings.imdb_id'])
            ->offset(($this->page - 1) * $rowsPerPage)
            ->limit($rowsPerPage)
            ->get();
    }

    public function mount(): void
    {
        $this->setPage($this->page);
    }

    public function render()
    {
        return view('livewire.movie-ratings-list', [
            'movieRatings' => $this->movieRatings,
        ]);
    }
}
