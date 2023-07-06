{{-- @extends('layout')
@section('content') --}}

<div class="flex items-center mx-10 text-lg">
    <a href="{{ route('progress',['id'=>$currentTraining->id]) }}" class="nav-link mr-2 hover:text-red-500">Overall Progress</a>
    <span class="mx-2 text-gray-500">|</span>
    <a href="{{ route('grades',['id'=>$currentTraining->id]) }}" class="nav-link mr-2 hover:text-red-500">Grades</a>
    <span class="mx-2 text-gray-500">|</span>
    <a href="{{ route('training',['id'=>$currentTraining->id]) }}" class="nav-link hover:text-red-500">Trainings</a>
</div>
