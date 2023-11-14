@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
    <div class="relative overflow-x-auto">
        <div class="container mx-auto p-4">

            @if ($viewData['type'] === 'rejected')
        
                <h1 class="dark:text-white text-2xl font-semibold mb-4">
                    {{ __('review.rr') }}
                </h1>
            @else
                <h1 class="dark:text-white text-2xl font-semibold mb-4">
                    {{ __('review.ar') }}
                </h1>
            @endif



            @if (session('rejected'))
                <div class="bg-red-200 text-red-800 border border-red-400 rounded p-2 mb-4">
                    {{ session('rejected') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-200 text-green-800 border border-green-400 rounded p-2 mb-4">
                    {{ session('success') }}
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
                        @if ($viewData['type'] == 'rejected')
                            <form method="POST" action="{{ route('admin.reviews.accept', $review->getId()) }}"
                                class="mt-2">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                                    {{ __('review.accept') }}
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.reviews.reject', $review->getId()) }}"
                                class="mt-2">
                                @csrf
                                <button type="submit" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">
                                    {{ __('review.reject') }}
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.reviews.delete', $review->getId()) }}" class="mt-2">
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
