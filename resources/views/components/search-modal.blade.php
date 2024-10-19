@props(['searchModalOpen' => false])

<div x-data="{
    searchModalOpen: false,
    search: '',
    localities: [],
    async fetchLocalities() {
        const response = await fetch(`/api/localities${this.search.length > 2 ? `?search=${this.search}` : ''}`);
        this.localities = await response.json();
    }
}" x-init="fetchLocalities();
$watch('search', () => fetchLocalities());
$watch('searchModalOpen', (value) => {
    if (value) {
        $nextTick(() => $refs.searchInput.focus());
    }
});" @open-search-modal.window="searchModalOpen = true"
    @keydown.escape.window="searchModalOpen = false">
    <div x-show="searchModalOpen" class="relative z-10" role="dialog" aria-modal="true"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity" @click="searchModalOpen = false"
            aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
            <div x-show="searchModalOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all"
                @click.away="searchModalOpen = false">
                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" x-model="search"
                        class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                        placeholder="Search localities..." role="combobox" aria-expanded="false"
                        aria-controls="options">
                </div>

                <!-- Results, show/hide based on command palette state -->
                <ul x-show="localities.length > 0"
                    class="max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800" id="options"
                    role="listbox">
                    <template x-for="(locality, index) in localities.slice(0, 5)" :key="index">
                        <li class="cursor-pointer select-none px-4 py-2 hover:bg-indigo-600 hover:text-white"
                            :id="'option-' + (index + 1)" role="option" tabindex="-1"
                            x-text="`${locality.name}, ${locality.state}`"
                            @click="window.location.href = `/${locality.state.toLowerCase().replace(/\s+/g, '-')}/${locality.name.toLowerCase().replace(/\s+/g, '-')}`">
                        </li>
                    </template>
                </ul>

                <!-- Empty state, show/hide based on command palette state -->
                <p x-show="search.length > 2 && localities.length === 0" class="p-4 text-sm text-gray-500">No
                    localities found.</p>
            </div>
        </div>
    </div>
</div>
