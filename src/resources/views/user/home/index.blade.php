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

@endsection
