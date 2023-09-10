@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

            <tbody>
                <!-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    @foreach ($products as $product)
                        <td class="px-6 py-4">
                            {{ $product->getName() }}
                        </td>
                        @foreach ($product->reviews as $review)
                            <td class="px-6 py-4">
                                {{ $review->rating }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $review->description }}
                            </td>
                        @endforeach
                    @endforeach

                </tr> -->


                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-semibold mb-4">Reviews for All Products</h1>

                    @if(session('success'))
                        <div class="bg-green-200 text-green-800 border border-green-400 rounded p-2 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('rejected'))
                        <div class="bg-red-200 text-red-800 border border-red-400 rounded p-2 mb-4">
                            {{ session('rejected') }}
                        </div>
                    @endif

                    @foreach ($products as $product)
                        <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($product->reviews as $review)
                                    @if ($review["verified"] === 0 || $review["verified"] === null)
                                        <div class="bg-white rounded-lg shadow-md p-4">
                                            <p class="font-semibold text-lg">{{ $review->rating }}</p>
                                            <p class="text-gray-600">{{ $review->description }}</p>
                                            <form method="POST" action="{{ route('admin.reviews.accept', $review->id) }}" class="mt-4">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                                                    Accept
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.reviews.reject', $review->id) }}" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        <hr class="my-4">
                    @endforeach
                </div>
                
            </tbody>
        </table>
    </div>

@endsection
