@extends('layouts.app')


@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="md:flex md:items-center">
    <div class="w-full h-64 md:w-1/2 lg:h-96">
        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="https://images.unsplash.com/photo-1578262825743-a4e402caab76?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" alt="Nike Air">
    </div>
    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
        <h3 class="text-gray-700 uppercase text-lg"> {{ $viewData['product'] -> getName()}} </h3>
        <span class="text-gray-500 mt-3"> {{ $viewData['product'] -> getPrice()}} </span>
        <hr class="my-3">
        <div class="mt-2">
            <label class="text-gray-700 text-sm" for="count"> {{ $viewData['count_title'] }}</label>
            <div class="flex items-center mt-1">
                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
                <span class="text-gray-700 text-lg mx-2">20</span>
                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </div>
        </div>
        <div class="mt-3">
            <label class="text-gray-700 text-sm" for="count">Color:</label>
            <div class="flex items-center mt-1">
                <button class="h-5 w-5 rounded-full bg-blue-600 border-2 border-blue-200 mr-2 focus:outline-none"></button>
                <button class="h-5 w-5 rounded-full bg-teal-600 mr-2 focus:outline-none"></button>
                <button class="h-5 w-5 rounded-full bg-pink-600 mr-2 focus:outline-none"></button>
            </div>
        </div>
        <div class="flex items-center mt-6">
            <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order Now</button>
            <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </button>
        </div>
    </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header font-bold text-xl">Write a review</div>
          <div class="card-body">
            @if($errors->any())
            <ul id="errors" class="alert alert-danger list-unstyled">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif
            <form method="POST" action="{{ route('review.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Description</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" placeholder="Enter description" name="description">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rating">Rating</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rating" placeholder="Enter rating from 0 to 5" name="rating">
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">Send</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>  

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
              <form method="POST" action="{{ route('review.delete', $review->getId()) }}">
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
