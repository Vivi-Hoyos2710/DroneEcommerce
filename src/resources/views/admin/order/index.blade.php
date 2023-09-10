@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    <div class="relative overflow-x-auto">
    {{-- <a href="{{ route('admin.orders.create') }}">
            <button type="button" class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm0-2a6 6 0 1 0 0-12 6 6 0 0 0 0 12zm-1-5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2h-2z"/>
                </svg>
                Create
            </button>
        </a> --}}
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($viewData['table_header'] as $title)
                        <th scope="col" class="px-6 py-3">{{ $title }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['orders'] as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $order->getId() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->getTotalAmount() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->getAddress() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->getUserId() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->getUser()->getName() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->getCreatedAt() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->getUpdatedAt() }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.orders.delete', $order->getId()) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs px-3 py-1.5 text-center mr-2 mb-2">
                                    <svg class="w-6 h-6 text-white text-center dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path
                                            d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show',$order->getId()) }}">
                                <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">+</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
