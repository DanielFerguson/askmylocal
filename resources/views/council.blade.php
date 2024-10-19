@extends('layouts.app')

@section('content')
    <div x-data="{}">
        {{-- Header --}}
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
                </div>
            </div>
            <div class="mt-6 hidden min-w-0 flex-1 sm:block md:hidden">
                <h1 class="truncate text-2xl font-bold text-gray-900">{{ $locality->name }}, {{ $locality->state }}</h1>
            </div>
        </div>

        <main class="px-4 pb-4 mt-6 space-y-6">
            {{-- Questions --}}
            <section id="questions" class="space-y-4">
                @foreach ($questions as $question)
                    <div class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="px-4 py-5 sm:px-6">
                            {{-- Question --}}
                            <p class="text-lg font-medium text-gray-900">
                                {{ $question->value }}
                            </p>
                            <div class="flex justify-between items-end mt-3">
                                {{-- Asked by --}}
                                <p class="text-sm text-gray-500">
                                    Asked by {{ $question->askedBy->name }}
                                </p>
                                <div class="grow"></div>
                                {{-- Votes --}}
                                <div class="bg-gray-50 rounded-sm flex gap-2 px-2 py-1 text-xs text-gray-800">
                                    {{-- Upvotes --}}
                                    <form action="{{ route('votes.store') }}" method="POST" class="flex gap-2">
                                        @csrf
                                        <input type="hidden" name="voteable_id" value="{{ $question->id }}">
                                        <input type="hidden" name="voteable_type" value="App\Models\Question">
                                        <button type="submit" name="direction" value="up"
                                            class="flex gap-1 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                            </svg>
                                            {{ $question->votes->where('direction', 'up')->count() }}
                                        </button>
                                        <button type="submit" name="direction" value="down"
                                            class="flex gap-1 items-center">
                                            {{ $question->votes->where('direction', 'down')->count() }}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="size-2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                {{-- Delete (if asked by user) --}}
                                @if ($question->asked_by_id === auth()->id())
                                    <form action="{{ route('questions.destroy', $question) }}" method="POST"
                                        class="bg-gray-50 rounded-sm flex gap-2 px-1 ml-2 py-1 text-xs text-gray-800">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-gray-500 h-4 bg-gray-50 p-1 rounded-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                class="size-2.5">
                                                <path fill-rule="evenodd"
                                                    d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @if ($question->answers->count() > 0)
                            <div class="bg-gray-50 px-4 py-5 sm:p-6 space-y-4">
                                @foreach ($question->answers as $answer)
                                    <div class="flex flex-col justify-between items-end">
                                        <p class="text-sm text-gray-900">
                                            {{ $answer->value }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-2">
                                            Answered by {{ $answer->answeredBy->name }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 px-4 py-5 sm:p-6">
                                <p class="text-xs text-gray-400">
                                    No answers yet. Upvote if you want to see more answers.
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </section>

            {{-- Councillors --}}
            <section id="councillors">
                <h2 class="text-lg font-medium text-gray-900">Councillors</h2>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    @foreach ($councillors as $councillor)
                        <div class="bg-white rounded-lg shadow">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=3560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="{{ $councillor->name }}" class="w-full h-32 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $councillor->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>

        {{-- Question Modal --}}
        <x-question-modal />
    </div>
@endsection
