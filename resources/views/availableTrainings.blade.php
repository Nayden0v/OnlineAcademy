@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/background.css') }}">
<body>
<div class="flex justify-center">
<div class="border border-grey w-3/4 p-4 mx-auto rounded-lg shadow">
        <div class="flex justify-center mt-20">
            <h1 class="text-4xl font-bold mb-4">{{ $training->title }}</h1>
        </div>
        <div class="flex justify-center mt-10">
            <h2 class="text-2xl font-bold">What you will learn in this course?</h2>
        </div>
        <div class="flex justify-center mt-5">
            <div class="border border-grey w-3/4 p-4 mx-auto rounded-lg shadow ">
                <p class="text-gray-600 mb-2">{{ $training->description }}</p>
            </div>
        </div>
        <div class="flex justify-center mt-5">
            <div class="container">
                <div>
                    <p class="text-gray-600 mb-2">Start date: {{ $training->start_date }}</p>
                    <p class="text-gray-600 mb-2">End date: {{ $training->end_date }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Estimate: {{ $training->estimate }} hours</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
