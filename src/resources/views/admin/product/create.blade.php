@extends('layouts.admin')

@section('title', $viewData['title'])
@section('content')






<div class="bg-[#F9FAFB] min-h-screen flex items-center">
    <div class="max-w-screen-md mx-auto flex flex-col items-center w-full">
        <h1 cass="text-2xl font-bold text-gray-800">{{$viewData["title"]}} form</h1>
        <div class="bg-white shadow-xl p-10 flex flex-col gap-4 text-sm">
            <!-- Creation form for the product -->
            <div class="flex flex-col gap-4">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500">{{ $error }}</p>
                    @endforeach
                    <div class="flex flex-col gap-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="border border-gray-300 p-2 rounded-lg" placeholder="Name" value="{{ old('name') }}">
                    </div>
                        <div class="flex flex-col gap-4">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="border border-gray-300 p-2 rounded-lg" placeholder="Price" value="{{ old('price') }}">
                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="border border-gray-300 p-2 rounded-lg" placeholder="Description" value="{{ old('description') }}">
                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="category">Category</label>
                            <!-- <input type="text" name="category" id="category" class="border border-gray-300 p-2 rounded-lg" placeholder="Category" value="{{ old('category') }}"> -->
                            <!-- use select instead of input -->
                            <select name="size" id="size" class="border border-gray-300 p-2 rounded-lg">
                                <!-- choose from base and accessory -->
                                <option value="base">Base</option>
                                <option value="accessory">Accessory</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap- 4">
                            <label for="size">Size</label>
                            <!-- <input type="text" name="size" id="size" class="border border-gray-300 p-2 rounded-lg" placeholder="Size" value="{{ old('size') }}"> -->
                            <!-- use select instead of input -->
                            <select name="size" id="size" class="border border-gray-300 p-2 rounded-lg">
                                <!-- choose from s, m and l -->
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                            </select>

                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="brand">Brand</label>
                            <input type="text" name="brand" id="brand" class="border border-gray-300 p-2 rounded-lg" placeholder="Brand" value="{{ old('brand') }}">
                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="border border-gray-300 p-2 rounded-lg" placeholder="Image" value="{{ old('image') }}">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
