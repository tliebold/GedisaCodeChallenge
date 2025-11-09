<?php

namespace App\Dto;

class Movie
{
    private string $title;

    private string $year;

    private string $poster;
    private mixed $imdbID;
    private ?int $rating = null;

    public static function fromArray(array $arr): self
    {
        $movie = new self();
        $movie->poster = $arr['Poster'];
        $movie->title = $arr['Title'];
        $movie->year = $arr['Year'];
        $movie->imdbID = $arr['imdbID'];

        return $movie;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getPoster(): string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): void
    {
        $this->poster = $poster;
    }

    public function getImdbID(): mixed
    {
        return $this->imdbID;
    }

    public function setImdbID(mixed $imdbID): void
    {
        $this->imdbID = $imdbID;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }
}
