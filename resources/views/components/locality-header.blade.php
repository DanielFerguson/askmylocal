@props(['locality', 'show_actions' => true])

<div>
    <img class="h-32 w-full object-cover lg:h-48" src="{{ $locality->background_photo_url }}" alt="">
</div>
<div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
    <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
        <div class="flex">
            <img class="h-24 w-24 rounded-full ring-4 object-cover ring-white sm:h-32 sm:w-32"
                src="{{ $locality->profile_photo_url }}" alt="">
        </div>
        <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
            <div class="mt-6 min-w-0 flex-1 sm:hidden md:block">
                <h1 class="truncate text-2xl font-bold text-gray-900">
                    {{ $locality->name }}, {{ $locality->state }}
                </h1>
            </div>
            @if ($show_actions)
                <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                    {{-- Ask a Question --}}
                    @if (auth()->check())
                        <button type="button" @click="$dispatch('open-question-modal')"
                            class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="-ml-0.5 mr-1.5 size-4 text-gray-400">
                                <path fill-rule="evenodd"
                                    d="M3.43 2.524A41.29 41.29 0 0 1 10 2c2.236 0 4.43.18 6.57.524 1.437.231 2.43 1.49 2.43 2.902v5.148c0 1.413-.993 2.67-2.43 2.902a41.202 41.202 0 0 1-5.183.501.78.78 0 0 0-.528.224l-3.579 3.58A.75.75 0 0 1 6 17.25v-3.443a41.033 41.033 0 0 1-2.57-.33C1.993 13.244 1 11.986 1 10.573V5.426c0-1.413.993-2.67 2.43-2.902Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Ask a Question</span>
                        </button>
                    @else
                        <p class="text-center text-sm text-gray-500">Login to ask a question and vote</p>
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-500 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <span>Login</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div class="mt-6 hidden min-w-0 flex-1 sm:block md:hidden">
        <h1 class="truncate text-2xl font-bold text-gray-900">{{ $locality->name }}, {{ $locality->state }}</h1>
    </div>
</div>
