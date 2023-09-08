@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="bg-gray-100 h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    @foreach ($viewData['table_header'] as $title)
                                        <th class="text-left font-semibold">{{ $title }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($viewData['products'] as $product)
                                    <tr>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img class="h-16 w-16 mr-4"
                                                    src="{{ asset('storage/' . $product->getImage()) }}"
                                                    alt="Product image">
                                                <span class="font-semibold">{{ $product->getName() }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4">{{ $product->getPrice() }}</td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <span
                                                    class="text-center w-8">{{ session('products')[$product->getId()] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            {{ $product->getPrice() * session('products')[$product->getId()] }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                                role="alert">
                                                <span class="font-medium">Info alert!</span> No products in cart
                                            </div>
                                        </td>

                                    </tr>
                                @endforelse
                                <tr>
                                    <td>
                                        <a href="{{ route('cart.delete') }}">
                                            <button
                                                class="px-4 py-2 bg-red-500 text-white rounded-md mb-2 hover:bg-red-600 focus:outline-none">
                                                Remove all products from Cart
                                            </button>
                                        </a>
                                    </td>        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>$19.99</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Taxes</span>
                            <span>$1.99</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Shipping</span>
                            <span>$0.00</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold">{{ $viewData['total'] }}</span>
                        </div>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
