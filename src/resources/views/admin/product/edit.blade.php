@extends('layouts.admin')

@section('title', $viewData['title'])
@section('content')

<div class="bg-[#F9FAFB] min-h-screen flex items-center">
    <div class="max-w-screen-md mx-auto flex flex-col items-center w-full">
        <h1 cass="text-2xl font-bold text-gray-800">{{__('product.title')}} </h1>
        
        <div class="bg-white shadow-xl p-10 flex flex-col gap-4 text-sm">
            <!-- Creation form for the product -->
            <div class="flex flex-col gap-4">
                <form action="{{ route('admin.product.update', $viewData['product']->getId()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500">{{ $error }}</p>
                    @endforeach

                    <div class="flex flex-col gap-4">
                        <label for="name">{{ __('product.name') }}</label>
                        <input type="text" name="name" id="name" value="{{ $viewData['product']->getName() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="price">{{ __('product.price') }}</label>
                        <input type="number" name="price" id="price" value="{{ $viewData['product']->getPrice() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="description">{{ __('product.description') }}</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="border border-gray-300 p-2 rounded-lg">{{ $viewData['product']->getDescription() }}</textarea>
                    </div>
                    <div class="flex flex-col gap-4">
                            <label for="category">{{ __('product.category') }}</label>
                            <select name="size" id="size" class="border border-gray-300 p-2 rounded-lg">
                                <!-- choose from base and accessory -->
                                <option value="base">{{ __('product.base') }}</option>
                                <option value="accessory">{{ __('product.accessory') }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap- 4">
                            <label for="size">{{__('product.size')}}</label>
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
                        <label for="brand">{{ __('product.brand') }}</label>
                        <input type="text" name="brand" id="brand" value="{{ $viewData['product']->getBrand() }}" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="image">{{ __('product.image') }}</label>
                        <input type="file" name="image" id="image" class="border border-gray-300 p-2 rounded-lg">
                    </div>
                    <div class="flex flex-col gap-4">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg"> {{ __('product.save') }} </button>
                    </div>

                </form>
            </div>
        </div>
                                    
    </div>
</div>

@endsection