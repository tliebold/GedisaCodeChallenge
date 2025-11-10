<div>
    <p class="text-xl font-bold">{{$this->movieDetail->getTitle()}}</p>
    <div class="mt-5">
        <div class="flex flex flex-row gap-5">
            <img class="max-h-100 max-w-70" src="{{$this->movieDetail->getPoster()}}" alt="no poster"/>
            <div>
                <table>
                    <tr>
                        <td colspan="2">
                            <flux:icon.loading wire:loading/>
                            <div wire:loading.remove>
                                <livewire:rating
                                    :rating="$this->movieRating?->rating"
                                    editable
                                    @rating-changed="setRating($event.detail.rating)"
                                />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pr-2">Release date:</td>
                        <td>{{$this->movieDetail->getReleaseDate()?->format('d.m.Y') ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Genre:</td>
                        <td>{{$this->movieDetail->getGenre()}}</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Director:</td>
                        <td>{{$this->movieDetail->getDirector()}}</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Writer:</td>
                        <td>{{$this->movieDetail->getWriter()}}</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Actors:</td>
                        <td>{{$this->movieDetail->getActors()}}</td>
                    </tr>
                </table>
                <p class="mt-5">{{$this->movieDetail->getPlot()}}</p>
            </div>
        </div>
    </div>
</div>
