@extends('layouts.app')
@section('title', __('order.title'))
@section('content')

    <div class="container mx-auto mt-auto">
        <h2 class="mb-4 text-sm leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{__('order.title')}}</h2>

        <!--Date Filters-->
        @include('components.filters.date-filter')
        <!--end date filters-->
        @forelse ($viewData["orders"] as $order)
            <div class="bg-white shadow-md rounded-lg mb-4 p-4 dark:bg-gray-800 ">
                <div class="bg-gray-200 text-gray-800 py-2 px-4 font-semibold  dark:bg-gray-600 dark:text-gray-200">
                    Order #{{ $order->getId() }}
                </div>
                <div class="flex flex-wrap justify-init ">
                    <div class="mx-10">
                        <b class="dark:text-gray-300">{{__('order.date')}}: </b> <p class=" dark:text-gray-400">{{ $order->getCreatedAt() }}</p>
                    </div>
                    <div class="mx-10">
                        <b class="dark:text-gray-300">{{__('order.total')}}: </b> <p class=" dark:text-gray-400">${{ $order->getTotalAmount() }}</p>
                        
                    </div>
                    <div class="mx-10">
                        <b class="dark:text-gray-300">{{__('order.address')}}: </b> <p class=" dark:text-gray-400">{{ $order->getAddress() }}</p>
                        
                    </div>
                    
                    
                </div>
               
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                        <tr>
                            @foreach ($viewData['table_header'] as $title)
                                <th scope="col" class="py-2">{{ $title }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->getItems() as $item)
                            <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-500">
                                <td class="py-4 px-2">
                                    {{ $item->getProduct()->getId() }}
                                </td>
                                <td class="py-4 px-2">
                                    <a class=""
                                        href="{{ route('product.show', ['id' => $item->getProduct()->getId()]) }}">
                                        {{ $item->getProduct()->getName() }}
                                    </a>
                                </td>
                                <td class="py-4 px-2">
                                    ${{ $item->getPrice() }}
                                </td>
                                <td class="py-4 px-2">
                                    {{ $item->getQuantity() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>      


        @empty
            <div class="bg-red-500 text-white px-4 py-2 rounded" role="alert">
                {{__('order.empty')}}
            </div>

        @endforelse
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
@endsection
