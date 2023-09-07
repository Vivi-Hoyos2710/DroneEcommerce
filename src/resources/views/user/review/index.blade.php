@extends('layouts.app')
@section('title',$viewData['title'])
@section('content')

<h1 class="text-5xl font-extrabold dark:text-white">{{"DRONE"}}<small class="ml-2 font-semibold text-gray-500 dark:text-gray-400"> THIS IS REVIEWS. Miau Miau Miau </small></h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($viewData["reviews"] as $review)
        @if ($review["verified"] === 1)
        <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 mb-4">
            <div class="flex items-center mb-2">
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">{{ $review->user->name }}</div>
                    <div class="text-sm text-gray-500">Rating: {{ $review["rating"] }}/5</div>
                </div>
            </div>

            <p class="text-gray-700">{{ $review["description"] }}</p>
        </div>
        @endif
    @endforeach
</div>

@endsection