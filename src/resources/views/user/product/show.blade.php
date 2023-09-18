@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

<div class="container">
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


                <label class="text-gray-700 text-sm" for="count"> {{ $viewData['count_title'] }}</label>
                <div class="flex items-center mt-1">
                    <button id="less" class="text-gray-500 focus:outline-none focus:text-gray-600" onclick="decrementCount()">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <span id="count" class="text-gray-700 text-lg mx-2">1</span>
                    <button id="more" class="text-gray-500 focus:outline-none focus:text-gray-600" onclick="incrementCount()">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                </div>
                
            <div class="flex items-center mt-6">
                <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}">
                    @csrf
                    <input type="hidden" name="quantity" id="quantity" value="1">
                    <button type="submit" class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Add to cart</button>
                </form>
            </div> 

            <div class="flex items-center mt-6">
                <form method="POST" action="{{ route('wishlist.save' , ['id' => $viewData['product']->getId() ] ) }}">
                    @csrf
                    <input type="hidden" name="quantity" id="quantity" value="1">
                    <button type="submit" class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Add to wish list</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="my-10"> 
        <h3 class="text-xl font-semibold mb-4">{{$viewData['review_title_comment']}}</h3>
        <div class="flex justify-left">
            <div class="w-1/2 p-6 bg-white shadow-md rounded-lg">                                   
                <form class="form-group" method="POST" action="{{ route('product.saveReview', [$viewData['product'] -> getId() ]) }}">
                    @csrf
                    <div class="container mx-auto p-4">
                        <label for="reviewRate" class="block text-gray-700 text-sm font-bold mb-2">Rating:</label>
                        <div class="flex items-center">
                            <input name="rating" value="{{ old('rate') }}" type="range" class="form-range w-3/4"
                                min="0" max="5" step="1" id="reviewRate"
                                oninput="this.form.valueRange.value=this.value">
                            <input readonly class="form-input ml-2 w-1/4" name="valueRange"
                                value="{{ old('valueRange') }}">
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="reviewDescription" class="block text-sm font-medium text-gray-700">Comment:</label>
                        <textarea name="description" value="{{ old('description') }}"
                                class="form-input mt-1 block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                id="reviewDescription" rows="3">
                        </textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium leading-5 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                            Send Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="text-xl font-semibold mb-4"> Opinions from our users! </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($viewData["reviews"] as $review)
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 mb-4">
                <div class="flex items-center mb-2">
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">{{ $review->user->name }}</div>
                        <div class="text-sm text-gray-500">Rating: {{ $review["rating"] }}/5</div>
                    </div>
                </div>
                <p class="text-gray-700">{{ $review["description"] }}</p>
            </div>
        @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('/js/count.js') }}"></script>
@endsection