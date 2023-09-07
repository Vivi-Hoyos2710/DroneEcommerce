@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')


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