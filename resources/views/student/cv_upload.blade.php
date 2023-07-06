@extends('layout')
@section('content')
<div class="flex justify-center items-center">
  <div class="w-96 bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl mb-4">Upload CV</h2>
    @if ($errors->any())
      <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(session('success'))
      <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ route('storeCv') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label for="cv" class="block mb-2">CV (PDF only, Max size 2MB)</label>
        <input type="file" class="border border-gray-300 py-2 px-4 rounded w-full" id="cv" name="cv">
      </div>
      @if ($file)
        <p class="mb-4">Current CV: {{ $file->name }}</p>
      @endif
      <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Upload</button>
    </form>
  </div>
</div>
@endsection
