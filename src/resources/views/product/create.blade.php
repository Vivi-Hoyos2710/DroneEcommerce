@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

<div>
    <!-- Product form -->
    <div>
        <h3 class="text-gray-600 text-2xl font-medium">{{$viewData["title"]}}</h3>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <!-- Name -->

                    </div>
                </div>

                @endsection
