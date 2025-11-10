<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Rating extends Component
{
    public bool $editable = false;

    public int $maxRating = 9;

    #[Reactive]
    public ?int $rating = null;

    public function setRating(int $rating): void
    {
        $this->dispatch('rating-changed', rating: $rating);
    }

    public function render()
    {
        return view('livewire.rating');
    }
}
