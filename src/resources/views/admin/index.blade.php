@extends('layouts.admin')
@section('title',$viewData['title'])
@section('content')

<h1 class="text-5xl font-extrabold dark:text-white">{{$viewData['message']}}<small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">This is secondary text</small></h1>

@endsection