@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

@if (session('delete'))
    <div class="bg-yellow-200 text-yellow-800 border-l-4 border-yellow-600 p-4" role="alert">
        {{ session('delete') }}
    </div>
@endif


<div class="md:flex md:items-center">
    <div class="w-full h-64 md:w-1/2 lg:h-96">
        <!-- This is the product image -->
        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ asset('storage/' . $viewData['product']->getImage()) }}" alt="{{ $viewData['product']->getName() }}">   
    </div>
    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
        <h3 class="text-gray-700 uppercase text-lg"> {{ $viewData['product'] -> getName()}} </h3>
        <span class="text-gray-500 mt-3"> {{ $viewData['product'] -> getPrice()}} </span>
        <hr class="my-3">
        <div class="mt-2">
            <!-- Here we write the product data -->

            <div class="grid grid-cols-2 gap-4">
                <!-- Description -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['description_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getDescription() }}</p>
                </div>

                <!-- Size -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['size_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getSize() }}</p>
                </div>

                <!-- Brand -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['brand_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getBrand() }}</p>
                </div>

                <!-- Category -->
                <div>
                    <label class="text-gray-700 text-sm" for="count">{{ $viewData['category_title'] }}</label>
                    <p class="mt-1 text-gray-600 text-sm">{{ $viewData['product']->getCategory() }}</p>
                </div>
            </div>


            <!-- This is the add to cart button -->
            <div class="flex items-center mt-1">
                <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"> {{ $viewData['cart_title'] }} </button>
            </div>
        </div>
    </div>
</div>


<div class="container">


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

              <!-- Delete Review Section -->
              <form method="POST" action="{{ route('product.delete', $review->getId()) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M12 6v12m0-12v12"></path>
                      </svg>
                      Delete
                  </button>
              </form>
          </div>
        @endif
      @endforeach
    </div>
</div>


@endsection