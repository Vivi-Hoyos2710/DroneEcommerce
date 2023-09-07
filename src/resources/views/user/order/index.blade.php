@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    @forelse ($viewData["orders"] as $order)
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="bg-gray-200 text-gray-800 py-2 px-4 font-semibold">
                Order #{{ $order->getId() }}
            </div>
            <b>Date:</b> {{ $order->getCreatedAt() }}<br />
            <b>Total:</b> ${{ $order->getTotal() }}<br />
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @foreach ($viewData['table_header'] as $title)
                            <th scope="col" class="px-6 py-3">{{ $title }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->getItems() as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $item->getId() }}
                            </td>
                            <td class="px-6 py-4">
                                {{-- <a class="" href="{{ route('product.show', ['id' => $item->getProduct()->getId()]) }}">
                                    {{ $item->getProduct()->getName() }}
                                </a> --}}
                            </td>
                            <td class="px-6 py-4">
                                ${{ $item->getPrice() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->getQuantity() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @empty
            <div class="bg-red-500 text-white px-4 py-2 rounded" role="alert">
                Seems to be that you have not purchased anything in our store.
            </div>

        </div>
    @endforelse
@endsection
