@extends('layout')
@section('content')
<div id="container" class="max-w-2xl mx-auto p-8 bg-gray-100">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <h1 class="text-xl font-bold mb-4">Add/Edit Training Synopsis</h1> <br>
  <h1 class="text-xl font-bold mb-4"><a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад </a></h1> <br>

  <form method="POST" action="{{ isset($training) ? route('training.update', $training) : route('training.store') }}">
    @csrf
    @if(isset($training))
              @method('put')
          @endif
    <input type="text" id="title" name="title" placeholder="Training Title" required class="w-full px-3 py-2 rounded border border-gray-300 mb-4" value="{{ isset($training) ? $training->title : '' }}"><br>
    <textarea id="training_description" name="description" placeholder="Description" required class="w-full px-3 py-2 rounded border border-gray-300 mb-4">{{ isset($training) ? $training->description : '' }}</textarea><br><br>

    <h1 class="text-xl font-bold mb-4">Schedule</h1><br>
    <label for="start_date" class="font-bold">Start Date:</label>
    <input type="date" name="start_date" id="start_date" required class="px-3 py-2 rounded border border-gray-300 mb-4" value="{{ isset($training) ? $training->start_date : '' }}">

    <label for="end_date" class="font-bold">End Date:</label>
    <input type="date" name="end_date" id="end_date" required class="px-3 py-2 rounded border border-gray-300 mb-4" value="{{ isset($training) ? $training->end_date : '' }}"><br><br>

    <label for="estimate" class="font-bold">Estimate</label>
    <input type="number" name="estimate" id="estimate" class="w-16 px-3 py-2 rounded border border-gray-300 mb-4" value="{{ isset($training) ? $training->estimate : '' }}">
    <p class="inline-block">hours</p> <br>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded float-right">SAVE</button>
  </form>
</div>

    <div class="max-w-2xl mx-auto p-8 bg-gray-100" id="app">
      <h1 class="text-lg font-bold cursor-pointer hover:text-green-500" @click="toggleForm">Upload files</h1><br>
      <div :class="{ hidden: !showForm }">
      @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Качване</button>
        <input type="hidden" name="training_id" value="{{ isset($training) ? $training->id : '' }}">
    </form>
    </div>
    </div>
    <script src="https://unpkg.com/vue@2.6.14/dist/vue.js"></script>
    <script>
      new Vue({
        el: "#app",
        data: {
          showForm: false
        },
        methods: {
          toggleForm() {
            this.showForm = !this.showForm;
          }
        }
      });
    </script>



  <script src="{{ asset('js/app.js') }}"></script>
@endsection
