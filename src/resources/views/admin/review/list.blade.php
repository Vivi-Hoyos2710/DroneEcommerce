@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
    <div class="relative overflow-x-auto">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-semibold mb-4">{{ __('product.reviewTitle') }} Accepted</h1>


            @if (session('rejected'))
                <div class="bg-red-200 text-red-800 border border-red-400 rounded p-2 mb-4">
                    {{ session('rejected') }}
                </div>
            @endif
            @foreach ($viewData['reviews'] as $review)
                <h2 class="text-xl font-semibold mb-2">{{ $review->getProduct()->getName() }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="font-semibold text-lg"> {{ __('review.user') }} {{ $review->getUser()->getName() }}</p>
                        <p class="font-semibold text-lg"> {{ __('review.rating') }} {{ $review->getRating() }}</p>
                        <p class="text-gray-600">{{ $review->getDescription() }}</p>
                        <p class="text-gray-600">{{ $review->getCreatedAt() }}</p>
                        <form method="POST" action="{{ route('admin.reviews.reject', $review->id) }}" class="mt-2">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                {{ __('review.reject') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reviews.delete', $review->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                {{ __('review.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
        </div>
        @endforeach
    </div>

    </div>
@endsection
