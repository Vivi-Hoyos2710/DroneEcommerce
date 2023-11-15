@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    {{ Breadcrumbs::render('homeAdmin.orders.show', $viewData['order']) }} 

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">{{ $viewData['title'] }}</h2>
        <section class="bg-white dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <small class="ml-2 font-semibold text-gray-500 dark:text-gray-400"> 
                    {{__('order.dateOrder')}}
                    {{ $viewData['order']->getCreatedAt() }}
                </small>
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.id')}}</label>
                        <input type="number" name="id" id="id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $viewData['order']->getId() }}" placeholder="Order id" required="" disabled>
                    </div>
                    <div class="w-full">
                        <label for="total_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{__('order.total_amount')}}
                        </label>
                        <input type="number" name="total_amount" id="total_amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $viewData['order']->getTotalAmount() }}" placeholder="Order total amount"
                            required="" disabled>
                    </div>
                    <div class="w-full">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('order.address')}}</label>
                        <input type="text" name="address" id="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $viewData['order']->getAddress() }}" placeholder="Address" required="" disabled>
                    </div>

                    <div>
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{__('order.id_user')}}
                        </label>
                        <input type="number" name="user_id" id="user_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $viewData['order']->getUserId() }}" placeholder="userId" required="" disabled>
                    </div>
                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{__('order.customer_name')}}
                        </label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $viewData['order']->getUser()->getName() }}" placeholder="name" required=""
                            disabled>
                    </div>
                    <ul
                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($viewData['order']->getItems() as $item)
                            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">{{$item->getProduct()->getName()}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        {{__('order.update_order')}}
                    </button>
                    <a href="{{route('admin.orders')}}">
                        <button type="button"
                        class="text-blue-600 inline-flex items-center hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900">
                        <svg class="w-5 h-5 mr-1 -ml-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                    </button>
                    </a>
                    
                </div>
            </div>
        </section>
    @endsection
