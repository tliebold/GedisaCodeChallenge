<x-layouts.app :title="__('Dashboard')">
    <div x-data="{ movieTitle: '' }" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <form @submit="formSubmitted">
            <input type="text" x-model="movieTitle"/>
        </form>
    </div>
</x-layouts.app>

<script>
    function formSubmitted() {

    }
</script>
