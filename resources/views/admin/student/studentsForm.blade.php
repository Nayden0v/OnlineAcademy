@extends('layout')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-gray-200">
      @if(session('success'))
          <div class="text-green-500 alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
    <span class="text-red-500">{{ session('error') }}</span>
        @endif
      <h1 class="text-lg font-bold mb-4">Add/Edit student</h1>
      <form action="{{ isset($student) ?  route('student.update', ['student' => $student])  : route('student.store') }}" method="post">
        @csrf
        @if(isset($student))
            @method('put')
        @endif

        <input type="text" id="student_name" name="first_name" placeholder="First name" value="{{ isset($student) ? $student->first_name : '' }}" required class="w-1/2,1 py-2 px-4 mb-4 rounded border border-gray-300">
        <input type="text" id="student_lastname" name="last_name" placeholder="Last name" value="{{ isset($student) ? $student->last_name : '' }}" required class="w-1/2 py-2 px-4 mb-4 rounded border border-gray-300">
        <input type="email" id="email" name="email" placeholder="Email" value="{{ isset($student) ? $student->email : '' }}" required class="w-full py-2 px-4 mb-4 rounded border border-gray-300">
        <input type="tel" id="phone" value="{{ isset($student) ? $student->phone : '' }}" name="phone" placeholder="Phone" required class="w-full py-2 px-4 mb-4 rounded border border-gray-300">
        <input type="text" id="country" name="country" value="{{ isset($student) ? $student->country : '' }}" placeholder="Country" required class="w-1/2,1 py-2 px-4 mb-4 rounded border border-gray-300">
        <input type="text" id="city" name="city" value="{{ isset($student) ? $student->city : '' }}" placeholder="City" required class="w-1/2 py-2 px-4 mb-4 rounded border border-gray-300">

        <select id="trainings" name="selectedTrainings[]" class="w-4/5 py-2 px-4 mb-4 rounded border border-gray-300" required>
            <option value="Select Training" selected>Select Training</option>
            @foreach ($trainings as $training)
              <option value="{{ $training->id }}">
                {{ $training->title }}
              </option>
            @endforeach
          </select>

          <button type="button" onclick="addTraining()" class="w-1/8 py-2 px-4 mb-4 rounded border border-gray-300 bg-green-500 text-white">+</button>
          <ul id="trainingList">
            @if(isset($student))
            @foreach ($student->trainings as $training)
            <li class="bg-gray-100 p-2 mb-2 rounded flex items-center" data-training-id="{{ $training->id }}">
              {{ $training->title }}
              <button type="button" class="delete-button ml-auto w-1/8 py-2 px-4 rounded border border-gray-300 bg-red-500 text-white">X</button>
            </li>
            @endforeach
            @endif
          </ul>

        <input type="hidden" id="selectedTrainings" name="selectedTrainings" value="{{ isset($student) ? implode(',', $student->trainings->pluck('id')->toArray()) : '' }}">

        <textarea id="information" name="information"  rows="4" cols="50" required class="w-full py-2 px-4 mb-4 rounded border border-gray-300" placeholder="Кратка информация">{{ isset($student) ? $student->information : '' }}</textarea>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">SAVE</button>
        </div>
    </form>

<script src="{{ asset('js/app.js') }}"></script>
  </div>
  @endsection
