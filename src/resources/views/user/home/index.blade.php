@extends('layouts.app')
@section('title',$viewData['title'])
@section('content')

<div class="carousel">
    @foreach ($products as $product)
        <div class="carousel-slide">
            <img src="{{ asset('/img/drone_logo.png') }}" alt="{{ $product->name }}">
            <div class="carousel-caption">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->price }}</p>
            </div>
        </div>
    @endforeach
</div>


@endsection