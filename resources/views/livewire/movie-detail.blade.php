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
                            <div wire:loading.remove x-data="{ hoveredStar: $wire.rating, starCount: 10 }" class="flex" @mouseleave="hoveredStar = $wire.rating" x-init="$watch('$wire.rating', () => hoveredStar = $wire.rating)">
                                <template x-for="i in hoveredStar" :key="i">
                                    <p
                                        wire:loading.remove
                                        class="text-yellow-500"
                                        @mouseenter="hoveredStar = i"
                                        wire:click="setRating(i); hoveredStar = i"
                                        x-html="i"
                                    />
                                </template>
                                <template x-for="i in starCount - hoveredStar">
                                    <p
                                        wire:loading.remove
                                        @mouseenter="hoveredStar = Math.min(hoveredStar + i, 10)"
                                        x-html="i"
                                    />
                                </template>
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
