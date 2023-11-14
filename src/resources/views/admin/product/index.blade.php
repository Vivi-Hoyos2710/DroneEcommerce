@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    <div class="relative overflow-x-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold dark:text-white">{{ __('adminpanel.products') }}</h1>

            <a href="{{ route('admin.product.create') }}">
                <button type="button"
                    class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm0-2a6 6 0 1 0 0-12 6 6 0 0 0 0 12zm-1-5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2h-2z" />
                    </svg>
                    {{ __('adminpanel.create') }}
                </button>
            </a>
        </div>


        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 border-b uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($viewData['table_header'] as $title)
                        <th scope="col" class="px-6 py-3">{{ $title }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['products'] as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $product->getId() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getName() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getPrice() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getDescription() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getImage() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getCategory() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getSize() }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->getBrand() }}
                        </td>

                        <td class="px-6 py-4">
                            <form action="{{ route('admin.product.delete', $product->getId()) }}" method="POST">
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
                            <a href="{{ route('admin.product.edit', $product->getId()) }}">
                                <button type="button"
                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                        <path
                                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                    </svg>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
