<?php

namespace App\Dto;

class MovieDetail extends Movie
{
    public ?\DateTime $releaseDate;

    public string $genre;

    public string $writer;

    public string $actors;

    public string $director;

    public string $plot;

    public static function fromArray(array $arr): static
    {
        $movieDetail = new self();
        $movieDetail->setYear($arr['Year']);
        $movieDetail->setTitle($arr['Title']);
        $movieDetail->setPoster($arr['Poster']);
        $movieDetail->setImdbID($arr['imdbID']);
        if (isset($arr['ReleaseDate'])) {
            $movieDetail->setReleaseDate(new \DateTime($arr['Released']));
        } else {
            $movieDetail->setReleaseDate(null);
        }
        $movieDetail->setGenre($arr['Genre']);
        $movieDetail->setWriter($arr['Writer']);
        $movieDetail->setActors($arr['Actors']);
        $movieDetail->setDirector($arr['Director']);
        $movieDetail->setPlot($arr['Plot']);

        return $movieDetail;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTime $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function getWriter(): string
    {
        return $this->writer;
    }

    public function setWriter(string $writer): void
    {
        $this->writer = $writer;
    }

    public function getActors(): string
    {
        return $this->actors;
    }

    public function setActors(string $actors): void
    {
        $this->actors = $actors;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    public function getPlot(): string
    {
        return $this->plot;
    }

    public function setPlot(string $plot): void
    {
        $this->plot = $plot;
    }
}
