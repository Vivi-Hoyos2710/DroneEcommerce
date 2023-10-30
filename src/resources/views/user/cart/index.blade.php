@extends('layouts.app')
@section('title', __('cart.title'))
@section('content')

    <div class="-sm bg-neutral-500 bg-opacity-50 py-8 dark:bg-gray-600 dark:bg-opacity-70">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">{{ __('cart.subtitle') }}</h1>
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4 ">
                        <table class="min-w-full">
                            <thead class="w-full text-xl text-left text-gray-900 dark:text-gray-400">
                                <tr>
                                    @foreach ($viewData['table_header'] as $title)
                                        <th class="text-left font-semibold ">{{ __($title) }}</th>
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
                                        <td class="py-4">${{ $product->getPrice() }}</td>
                                        <td class="py-4">

                                            <div class="flex items-center">
                                                <form method="POST"
                                                    action="{{ route('cart.add', ['id' => $product->getId()]) }}">
                                                    @csrf
                                                    <input type="hidden" name="quantity" id="quantity"
                                                        value={{ session('products')[$product->getId()]['quantity'] - 1 }}>
                                                    <button type="submit"
                                                        class="px-2 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-500 focus:outline-none focus:bg-red-500">-</button>
                                                </form>
                                                <span
                                                    class="text-center w-8">{{ session('products')[$product->getId()]['quantity'] }}</span>
                                                <form method="POST"
                                                    action="{{ route('cart.add', ['id' => $product->getId()]) }}">
                                                    @csrf
                                                    <input type="hidden" name="quantity" id="quantity"
                                                        value={{ session('products')[$product->getId()]['quantity'] + 1 }}>
                                                    <button type="submit"
                                                        class="px-2 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-500 focus:outline-none focus:bg-green-500">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            ${{ $product->getPrice() * session('products')[$product->getId()]['quantity'] }}
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td>
                                            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                                role="alert">
                                                <span class="font-medium"> {{__('cart.empty_cart')}} </span> {{__('cart.empty_cart2')}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                @if (count($viewData['products']) > 0)
                                    <tr>
                                        <td  >
                                            <a href="{{ route('cart.delete') }}">
                                                <button
                                                    class="px-4 py-2 bg-red-300 text-white rounded-md mb-2 hover:bg-red-600 focus:outline-none">
                                                    {{ __('cart.remove') }}
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                @if (count($viewData['products']) > 0)
                    <div class="md:w-1/4">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-lg font-semibold mb-4">{{ __('cart.summary') }}</h2>
                            <div class="flex justify-between mb-2">
                                <span>{{ __('cart.subtotal') }}</span>
                                <span>${{ $viewData['total'] }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>{{ __('cart.taxes') }}</span>
                                <span>$0</span>
                            </div>

                            <hr class="my-2">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">{{ __('cart.total') }}</span>
                                <span class="font-semibold">${{ $viewData['total'] }}</span>
                            </div>

                            <!-- Create a next step button which looks like others in this project-->
                            <a href="{{ route('user.orders.locate') }}">
                                <button
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md mb-2 hover:bg-blue-600 focus:outline-none">
                                   {{__('cart.next_step')}}
                                </button>
                            </a>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
