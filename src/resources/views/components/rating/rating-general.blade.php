<div>
    <div class="flex items-center mb-2">
        <div class="flex items-center mt-4">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $average)
                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                @else
                    <svg class="w-4 h-4 text-gray-300 mr-1 dark:text-gray-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                @endif
            @endfor
            <p class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ number_format($average, 1) }} / 5.0</p>
        </div>
    </div>
    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$total}} reviews in total</p>
    @for ($value = 0; $value < 6; $value++)
        <div class="flex items-center mt-4">
            <a href="#"
                class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $value }}</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: {{isset($stars[$value]) ? ($stars[$value] / $total) * 100 . '%' : 0}}"></div>
                </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{isset($stars[$value]) ? $stars[$value] : 0}}</span>
            <!-- You can omit the percentage section entirely -->
        </div>
    @endfor
    

</div>
