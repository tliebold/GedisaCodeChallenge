<?php

namespace App\Services;

use App\Dto\MovieDetail;
use App\Models\MovieRating;
use App\Models\User;

class MovieRatingService
{
    private int $minRating = 0;
    private int $maxRating = 9;

    public function setRating(MovieDetail $movieDetail, int $rating, User $user): void
    {
        $this->validateRating($rating);

        $movieRating = MovieRating::query()->where([
            'imdb_id' => $movieDetail->getImdbID(),
            'user_id' => $user->id,
        ])->first();
        if ($movieRating === null) {
            $movieRating = new MovieRating();
            $movieRating->imdb_id = $movieDetail->getImdbID();
        }
        $movieRating->fill([
            'title' => $movieDetail->getTitle(),
            'year' => $movieDetail->getYear(),
            'poster' => $movieDetail->getPoster(),
            'rating' => $rating,
            'user_id' => $user->id,
        ]);
        $movieRating->save();
    }

    public function getAverageRating(string $imdbID): ?float
    {
        return MovieRating::query()->where('imdb_id', '=', $imdbID)->avg('movie_ratings.rating');
    }

    private function validateRating(int $rating): void
    {
        if ($rating > $this->maxRating) {
            throw new \InvalidArgumentException('Maximum rating is 9.');
        }

        if ($rating < $this->minRating) {
            throw new \InvalidArgumentException('Minimum rating is 0.');
        }
    }
}
