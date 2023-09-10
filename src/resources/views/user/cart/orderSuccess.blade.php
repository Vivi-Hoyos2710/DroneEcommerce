@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
<h2>{{$viewData['subtitle']}}</h2>
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Purchase Completed</span>Congratulations, purchase completed. Order number is <b>#{{ $viewData["order"]}}
  </div>
@endsection