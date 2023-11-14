@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    <div class="bg-[#F9FAFB] min-h-screen flex items-center">
        <div class="max-w-screen-md mx-auto flex flex-col items-center w-full">
            <h1 cass="text-2xl font-bold text-gray-800">{{ __('product.title') }}</h1>
            <div class="bg-white shadow-xl p-10 flex flex-col gap-4 text-sm">
                <!-- Creation form for the product -->
                <div class="flex flex-col gap-4">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <p class="text-red-500">{{ $error }}</p>
                        @endforeach
                        <div class="flex flex-col gap-4">
                            <label for="name"> {{ __('product.name') }} </label>
                            <input type="text" name="name" id="name"
                                class="border border-gray-300 p-2 rounded-lg" placeholder="Name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="price"> {{ __('product.price') }} </label>
                            <input type="number" name="price" id="price"
                                class="border border-gray-300 p-2 rounded-lg" placeholder="Price"
                                value="{{ old('price') }}">
                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="description"> {{ __('product.description') }} </label>
                            <input type="text" name="description" id="description"
                                class="border border-gray-300 p-2 rounded-lg" placeholder="Description"
                                value="{{ old('description') }}">
                        </div>
                        <div class="flex flex-col gap-4">
                            <label for="category">{{ __('product.category') }}</label>
                            <select name="category" id="size" class="border border-gray-300 p-2 rounded-lg">
                                <option value="base">{{ __('product.base') }}</option>
                                <option value="accessory">{{ __('product.accessory') }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap- 4">
                            <label for="size">{{ __('product.size') }}</label>
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
                            <label for="brand"> {{ __('product.brand') }} </label>
                            <input type="text" name="brand" id="brand"
                                class="border border-gray-300 p-2 rounded-lg" placeholder="Brand"
                                value="{{ old('brand') }}">
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col gap-4">
                                <label for="image_upload">{{ __('product.image') }}</label>
                                <input type="file" name="image" id="image"
                                    class="border border-gray-300 p-2 rounded-lg" placeholder="Image"
                                    value="{{ old('image') }}">
                            </div>
                            <div class="flex flex-col gap-2">

                                <label for="countries"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                                    option</label>

                                <select id="storageOpt" name="storage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="local">Local</option>
                                    <option value="gcp">GCP</option>
                                </select>
                            </div>
                        </div>
                        <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">
                            Choose an image and a way to save it, local or in the cloud.
                        </p>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            {{ __('product.submit') }} </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
