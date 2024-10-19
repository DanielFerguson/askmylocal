@extends('layouts.app')

@section('content')
    <div x-data="{}">
        {{-- Header --}}
        <x-locality-header :locality="$locality" :show_actions="false" />

        <pre>{{ $question->value }}</pre>
    </div>
@endsection
