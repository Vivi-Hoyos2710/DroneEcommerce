@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-warning" role="alert">
            {{ session('delete') }}
        </div>
    @endif
    @php($count = 0)
    <div class="row">
        @foreach ($viewData['reviews'] as $review)
            <div class="col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <div class="card-body text-center">
                        Descripción: {{ $review->getDescription() }}
                    </div>
                    <a href="{{ route('review.show', ['id' => $review->getId()]) }}" class="btn bg-primary text-white">id:
                        {{ $review->getId() }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
