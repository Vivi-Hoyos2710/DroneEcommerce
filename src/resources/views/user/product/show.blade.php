@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

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


<div class="my-10"> <!-- Add margin to create space from the top -->
    <h2 class="text-xl font-semibold mb-4">Dejanos tu opinion!</h2> <!-- Add your title here -->
    <div class="flex justify-left">
        <div class="w-1/2 p-6 bg-white shadow-md rounded-lg">                                   
            <form class="form-group" method="POST" action="{{ route('product.saveReview', [$viewData['product'] -> getId() ]) }}">
                @csrf
                
                <div class="container mx-auto p-4">
                    <label for="reviewRate" class="block text-gray-700 text-sm font-bold mb-2">Puntuación:</label>
                    <div class="flex items-center">
                        <input name="rate" value="{{ old('rate') }}" type="range" class="form-range w-3/4"
                            min="0" max="5" step="1" id="reviewRate"
                            oninput="this.form.valueRange.value=this.value">
                        <input readonly class="form-input ml-2 w-1/4" name="valueRange"
                            value="{{ old('valueRange') }}">
                    </div>
                </div>

                <!-- <div class="mb-4">
                    <label for="rate" class="block text-sm font-medium text-gray-700">rate (from 1 to 5):</label>
                    <input name="rate" value="{{ old('rate') }}"
                        class="form-input mt-1 block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                        id="rate" type="number" min="1" max="5" step="1">
                </div> -->

                <div class="mb-4">
                    <label for="reviewDescription" class="block text-sm font-medium text-gray-700">Comentario:</label>
                    <textarea name="description" value="{{ old('description') }}"
                            class="form-input mt-1 block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            id="reviewDescription" rows="3">
                    </textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                        Crear Review
                    </button>
                </div>
            </form>
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

          </div>
        @endif
      @endforeach
    </div>
</div>


@endsection