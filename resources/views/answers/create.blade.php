@extends('layouts.app')

@section('content')
    <div x-data="{}">
        {{-- Header --}}
        <x-locality-header :locality="$locality" :show_actions="false" />

        <main class="px-4 py-6">
            <h2 class="text-lg font-medium text-gray-900">Question</h2>
            <p class="text-gray-500 mt-2">{{ $question->value }}</p>

            {{-- Answer Form --}}
            <form action="{{ route('questions.answers.store', $question) }}" method="POST" class="mt-4">
                @csrf
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700">Answer</label>
                    <textarea id="value" name="value" rows="5"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>
                @if ($errors->any())
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Oops! There were some problems with your input.</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit"
                    class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
            </form>
        </main>
    </div>
@endsection
