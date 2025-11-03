<div>
    <p class="text-xl font-bold">Moviesearch</p>
    <form class="mt-5" wire:submit="searchMovie">
        <flux:input wire:model="movieTitle"/>
    </form>

    <div wire:loading.class="flex flex flex-row justify-center mt-10">
        <flux:icon.loading wire:loading class="size-12"/>
    </div>

    <div wire:loading.remove>
        @if($movieSearchResult !== null)
            <div class="flex flex-row items-center gap-4 mt-10">
                @if($this->page > 1)
                    <flux:button wire:click="setPage(1)">1</flux:button>
                @endif
                @if($this->page - 1 > 1)
                    <flux:button wire:click="setPage({{$this->page - 1}})">{{$this->page - 1}}</flux:button>
                @endif
                <flux:button variant="primary" disabled>{{$this->page}}</flux:button>
                @if($this->page + 1 < $this->maxPage)
                    <flux:button wire:click="setPage({{$this->page + 1}})">{{$this->page + 1}}</flux:button>
                @endif
                @if($this->page < $this->maxPage)
                    <flux:button wire:click="setPage({{$this->maxPage}})">{{$this->maxPage}}</flux:button>
                @endif
            </div>
            <table class="table-auto mt-5 mb-5 w-full">
                <tbody>
                    @foreach ($this->movieSearchResult->getMovies() as $movie)
                        <tr class="transition-all duration-300 ease-in-out hover:bg-gray-900 mt-2 mb-2">
                            <td class="pl-2 pr-0">
                                <a href="{{route('movie-detail', ['imdbID' => $movie->getImdbID()])}}">
                                    <img class="h-25 w-15" src="{{$movie->getPoster()}}" alt="no poster"/>
                                </a>
                            </td>
                            <td class="pl-2 pr-2">
                                <a href="{{route('movie-detail', ['imdbID' => $movie->getImdbID()])}}">
                                    <p class="text-lg font-bold">{{ $movie->getTitle() }}</p>
                                    <p>{{ $movie->getYear() }}</p>
                                    <p>toll</p>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
