<div>
    <p class="text-xl font-bold">Movie ratings</p>
    <div class="mt-5">
        <div wire:loading.class="flex flex flex-row justify-center mt-10">
            <flux:icon.loading wire:loading class="size-12"/>
        </div>

        <div wire:loading.remove>
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
                @foreach ($this->movieRatings as $movieRating)
                    <tr class="transition-all duration-300 ease-in-out hover:bg-gray-900 mt-2 mb-2">
                        <td class="pl-2 pr-0 w-30">
                            <a href="{{route('movie-detail', ['imdbID' => $movieRating->imdbID])}}">
                                <img class="h-30 w-20" src="{{$movieRating->poster}}" alt="no poster"/>
                            </a>
                        </td>
                        <td class="pl-2 pr-2">
                            <a href="{{route('movie-detail', ['imdbID' => $movieRating->imdbID])}}">
                                <p class="text-lg font-bold">{{ $movieRating->title }}</p>
                                <p>{{ $movieRating->year }}</p>
                                <livewire:rating :rating="$movieRating->rating"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
