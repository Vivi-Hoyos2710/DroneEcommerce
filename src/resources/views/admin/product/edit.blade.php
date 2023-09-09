@extends('layouts.admin')

@section('title', $viewData['title'])
@section('content')

<div class="bg-[#F9FAFB] min-h-screen flex items-center">
    <div class="max-w-screen-md mx-auto flex flex-col items-center w-full">
        <h1 cass="text-2xl font-bold text-gray-800">{{$viewData["title"]}} form</h1>
        
        <div class="bg-white shadow-xl p-10 flex flex-col gap-4 text-sm">
            <!-- Creation form for the product -->
            <div class="flex flex-col gap-4">
                <form action="{{ route('admin.product.update', $viewData['product']->getId()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500">{{ $error }}</p>
                    @endforeach

                    <div class="flex flex-col gap-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $viewData['product']->getName() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" value="{{ $viewData['product']->getPrice() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="border border-gray-300 p-2 rounded-lg">{{ $viewData['product']->getDescription() }}</textarea>
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="category">Category</label>
                        <input type="text" name="category" id="category" value="{{ $viewData['product']->getCategory() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="size">Size</label>
                        <input type="text" name="size" id="size" value="{{ $viewData['product']->getSize() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" value="{{ $viewData['product']->getBrand() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Save</button>
                    </div>

                </form>
            </div>
        </div>
                                    
    </div>
</div>

@endsection