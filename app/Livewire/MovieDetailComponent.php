<?php

namespace App\Livewire;

use App\Dto\MovieDetail;
use App\Models\MovieSearchModel;
use Livewire\Component;

class MovieDetailComponent extends Component
{
    private MovieSearchModel $searchModel;

    public string $imdbID;

    private ?MovieDetail $movieDetail = null;

    public function mount(string $imdbID, MovieSearchModel $movieSearchModel): void
    {
        $this->imdbID = $imdbID;
        $this->searchModel = $movieSearchModel;
        $this->movieDetail = $this->searchModel->getDetail($imdbID);
    }

    public function render()
    {
        return view('livewire.movie-detail', ['movieDetail' => $this->movieDetail]);
    }
}
