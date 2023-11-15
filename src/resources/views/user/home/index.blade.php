@extends('layouts.app', ['body_class' => 'bg-home-background'])
@section('title', $viewData['title'])
@section('content')

    <div class="container mx-auto py-12 flex flex-wrap items-center justify-between">
        <div class="w-full md:w-1/2 rounded-lg bg-white dark:bg-gray-700 p-6 shadow-lg relative">
            <div>

                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{ __('indexHome.elevate_drone_experience') }}
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ __('indexHome.customized_creations') }}</span>

                </h1>
                <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                    {{ __('indexHome.welcome_message') }}
                </p>
            </div>
        </div>


        <div class="w-full md:w-1/2">
            <img src="https://nebula.wsimg.com/d7a7441c4f98c566fe762e6ee0ea08c6?AccessKeyId=77DC80C9B62DE94ACB31&disposition=0&alloworigin=1"
                alt="Flying Drone GIF" class="w-full h-auto">
        </div>
    </div>
    <div class="flex flex-col items-center justify-center md:flex-row">


    <div class="flex flex-col items-center justify-center md:flex-row">

        <div class="w-full md:w-1/2 rounded-lg bg-white dark:bg-gray-700 p-6 shadow-lg relative md:order-2">
            <div class="md:w-1/2">
                <h1 class="mb-2 text-2xl font-semibold leading-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
                    {{ __('indexHome.opinions_from_users') }}
                </h1>
                <p class="mb-2 text-xl font-medium text-gray-600 dark:text-gray-300">
                    {{ __('indexHome.most_reviewed_products') }}
                </p>
            </div>
        </div>

        <div class="h-full w-full md:w-1/2 lg:h-96 my-2 md:order-1">
            <div id="default-carousel" class="relative w-full h-full" data-carousel="slide">

                <div class="relative h-56-lg overflow-hidden rounded-lg md:h-96">
                    @foreach ($viewData['products'] as $product)
                        <div class="hidden duration-700 ease-in-out flex items-center justify-center" data-carousel-item>
                            <div
                                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <img class="p-8 rounded-t-lg" src="{{ url($product->getImage()) }}" alt="product image" />

                                <div class="px-5 pb-5">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ $product->getName() }}
                                    </h5>

                                    <div class="flex items-center mt-2.5 mb-5">
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $product->averageRating)
                                                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 22 20">
                                                        <path
                                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-300 mr-1 dark:text-gray-500"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 22 20">
                                                        <path
                                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">{{ $product->averageRating }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-3xl font-bold text-gray-900 dark:text-white">${{ $product->getPrice() }}</span>
                                        <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">More</a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">{{ __('indexHome.previous_slide') }}</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">{{ __('indexHome.next_slide') }}</span>
                    </span>
                </button>
            </div>
        </div>


    </div>

@endsection
