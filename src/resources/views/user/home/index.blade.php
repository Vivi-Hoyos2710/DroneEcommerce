@extends('layouts.app', ['body_class' => "backdrop-blur-sm bg-cover bg-center bg-no-repeat bg-[url('https://static.vecteezy.com/system/resources/previews/009/877/659/original/pixel-art-city-background-blue-with-buildings-constructions-bridge-and-cloudy-sky-for-8bit-game-vector.jpg')] bg-gray-300"])
@section('title', $viewData['title'])
@section('content')

    <div class="container mx-auto py-12 flex flex-wrap items-center justify-between">
        <!-- Left Side (Text Content) -->
        <div class="w-full md:w-1/2 rounded-lg bg-white dark:bg-gray-700 p-6 shadow-lg relative">
            <div class="backdrop-blur-sm bg-black-100git rounded-lg"></div>
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Elevate Your Drone Experience
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">with Customized Creations</span>        
            </h1>
            <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                Welcome to our drone customization eCommerce platform, where we blend technology, innovation, and creativity to unlock the full potential of your drones. Discover unique, tailor-made solutions that enhance your drone capabilities and bring your aerial visions to life.
            </p>
        </div>
        <!-- Right Side (Image) -->
        <div class="w-full md:w-1/2">
            <img src="https://nebula.wsimg.com/d7a7441c4f98c566fe762e6ee0ea08c6?AccessKeyId=77DC80C9B62DE94ACB31&disposition=0&alloworigin=1"
                alt="Flying Drone GIF" class="w-full h-auto">
        </div>
    </div>

    <div class="justify-center">
        <div class="w-full md:w-1/2 rounded-lg bg-white dark:bg-gray-700 p-6 shadow-lg relative">
            <div class="h-16 md:w-1/2 lg:h-24">
                <h1 class="mb-2 text-2xl font-semibold leading-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
                    Opinions from our users!
                </h1>
                <p class="mb-2 text-xl font-medium text-gray-600 dark:text-gray-300">
                    Most Reviewed Products
                </p>
            </div>
        </div>

        <div class="h-64 md:w-1/2 lg:h-96">
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach ($viewData['products'] as $product)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ asset('storage/' . $product -> getImage()) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type  ="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </div>



@endsection