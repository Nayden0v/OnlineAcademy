@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/background.css') }}">
<body>
<div id="container" class="max-w-2xl mx-auto p-8 bg-gray-100">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h1 class="text-2xl font-bold mb-4">Add/Edit LECTURE</h1>
    <h1 class="text-xl font-bold mb-4"><a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад </a></h1> <br>
    <form method="POST" action="{{ isset($lecture) ?route('lecture.update',['lecture' => $lecture]) : route('lecture.store') }}">
        @csrf
        @if(isset($lecture))
            @method('PUT')
        @endif

        @if (!isset($lecture))
        <h1 class="text-2xl font-bold mb-4">TRAINING TITLE: {{ $training->title }}</h1>

        <label class="font-bold" for="module_id">MODULE TITLE: </label>
        <select name="module_id" id="module_id" class="form-select w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @foreach ($training->modules as $module)
                <option value="{{ $module->id }}">{{ $module->title }}</option>
            @endforeach
        </select><br><br>
        @endif

        @if (!isset($lecture))
        <label for="lecture_title" class="font-bold mb-2 block bg-green-500 p-2 rounded inline-block" id="add_lecture_label">+ ADD Lecture</label><br>
         @endif
        <input type="text" id="lecture_title" name="{{ isset($lecture) ? 'lecture_title' : 'lecture_title[]' }}"  placeholder="Title"  class="w-full px-3 py-2 rounded border border-gray-300 mb-4"><br>
        <textarea id="lecture_description" name="{{ isset($lecture) ? 'lecture_description' : 'lecture_description[]' }}" placeholder="Description"  class="w-full px-3 py-2 rounded border border-gray-300 mb-4"></textarea><br><br>
        <input type="date" id="lecture_date" name="{{ isset($lecture) ? 'lecture_date' : 'lecture_date[]' }}"  class="w-full px-3 py-2 rounded border border-gray-300 mb-4">

        <ul id="lecture_list"></ul>

        <input type="hidden" name="module_id_hidden" id="module_id_hidden" value="">
        @if(request()->routeIs('lecture'))
            <input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">
        @elseif(request()->routeIs('lecture.edit'))
            <input type="hidden" type="text">
        @endif
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded float-right">SAVE</button>
    </form>
</div>

</body>
<!-- <script src="{{ asset('js/lecture.js') }}"></script> -->



<script>
    var addLectureButton = document.getElementById('add_lecture_label');
    addLectureButton.addEventListener('click', function() {
  var lectureTitleInput = document.getElementById('lecture_title');
  var lectureDescriptionInput = document.getElementById('lecture_description');
  var lectureTitle = lectureTitleInput.value;
  var lectureDescription = lectureDescriptionInput.value;
  var lectureDateInput = document.getElementById('lecture_date');
  var lectureDate = lectureDateInput.value;
  if (lectureTitle !== '' && lectureDescription !== '') {
    var listItem = document.createElement('li');
    listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');

    var lectureContent = document.createElement('div');
    lectureContent.classList.add('flex', 'flex-col');

    var titleElement = document.createElement('h2');
    titleElement.textContent = lectureTitle;
    titleElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
    lectureContent.appendChild(titleElement);

    var descriptionElement = document.createElement('p');
    descriptionElement.textContent = lectureDescription;
    descriptionElement.classList.add('mb-4', 'text-gray-600');
    lectureContent.appendChild(descriptionElement);

    var dateElement = document.createElement('p');
    dateElement.textContent = "Date: " + lectureDate;
    dateElement.classList.add('mb-2', 'text-gray-600');
    lectureContent.appendChild(dateElement);

    listItem.appendChild(lectureContent);

    var deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
    deleteButton.addEventListener('click', function() {
      listItem.remove();
    });

    listItem.appendChild(deleteButton);

    var lectureList = document.getElementById('lecture_list');
    lectureList.appendChild(listItem);

    lectureTitleInput.value = '';
    lectureDescriptionInput.value = '';

    // Добавяне на скрити полета със стойностите на заглавията и описанията на лекциите
    var hiddenTitleInput = document.createElement('input');
    hiddenTitleInput.type = 'hidden';
    hiddenTitleInput.name = 'lecture_title[]';
    hiddenTitleInput.value = lectureTitle;
    listItem.appendChild(hiddenTitleInput);

    var hiddenDescriptionInput = document.createElement('input');
    hiddenDescriptionInput.type = 'hidden';
    hiddenDescriptionInput.name = 'lecture_description[]';
    hiddenDescriptionInput.value = lectureDescription;
    listItem.appendChild(hiddenDescriptionInput);

    var hiddenDateInput = document.createElement('input');
    hiddenDateInput.type = 'hidden';
    hiddenDateInput.name = 'lecture_date[]';
    hiddenDateInput.value = lectureDate;
    listItem.appendChild(hiddenDateInput);
      }
    });





        document.getElementById('module_id').addEventListener('change', function () {
        var selectedModuleId = this.value;
        document.getElementById('module_id_hidden').value = selectedModuleId;
        });
</script>

  <script src="{{ asset('js/app.js') }}"></script>
@endsection
