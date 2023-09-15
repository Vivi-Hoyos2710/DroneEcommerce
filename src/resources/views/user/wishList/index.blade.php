@extends('layouts.app')
@section('title', $viewData["title"])

@section('content')
    <div class="container mx-auto mt-auto">
        @foreach ($viewData['wishList'] as $wishList)
            <th scope="col" class="py-2">{{ $wishList }}</th>
        @endforeach
    </div>
@endsection