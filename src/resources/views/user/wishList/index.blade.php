@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')

    {{ Breadcrumbs::render('wishlist') }}

    <div>
        <div class="px-32 py-20 bg-gray-100 grid  gap-10">
            @foreach ($viewData['wishList'] -> getProducts() as $product)
                <div class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                    <div>
                        <img src="{{ asset('storage/' . $product -> getImage()) }}" alt="" />
                    </div>

                    <div class="py-4 px-4 bg-white">
                        <h3 class="text-lg font-semibold text-gray-600"> {{ $product -> getName() }} &quot; {{ $product -> getBrand() }} </h3>
                        <p class="mt-4 text-lg font-thin"> ${{ $product -> getPrice() }} </p>
                    </div>

                    <div class="mt-6">
                        <form method="POST" action="{{ route('cart.add', ['id' => $product -> getId()]) }}">
                            @csrf
                            <input type="hidden" name="quantity" id="quantity" value="1">
                            <button type="submit" class="flex-shrink-0 px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500" style="width: 150px;" > {{ ($viewData['productToCart'] ) }} </button>
                        </form>

                        <form method="POST" action="{{ route('wishlist.delete', ['id' => $product -> getId() , 'WishListId' => $viewData['wishList'] -> getId()  ]) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" flex-shrink-0 px-8 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-500 focus:outline-none focus:bg-red-500 " style="width: 150px;" > {{ ($viewData['deleteFromList'] ) }}</button>
                        </form>
                    </div> 
                </div>
            @endforeach
        </div>
    </div>
@endsection