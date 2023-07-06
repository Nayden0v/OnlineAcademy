@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/background.css') }}">
<body>
<div id="container" class="max-w-2xl mx-auto p-8 bg-gray-100">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h1 class="text-2xl font-bold mb-4">Add/Edit HOMEWORK</h1>
    <h1 class="text-xl font-bold mb-4"><a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад </a></h1> <br>
    <form method="POST" action="{{ isset($homework) ? route('homework.update', ['homework' => $homework]) : route('homework.store') }}">
    @csrf
    @if(isset($homework))
        @method('PUT')
    @endif
        @if (!isset($homework))
        <h1 class="text-2xl font-bold mb-4">TRAINING TITLE: {{ $training->title }}</h1>
<label class="font-bold" for="module_id">MODULE TITLE:</label>
<select name="module_id" id="module_id" class="form-select w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    @foreach ($training->modules as $module)
        <option value="{{ $module->id }}">{{ $module->title }}</option>
    @endforeach
</select><br><br>
<label class="font-bold" for="lecture_id">LECTURE TITLE:</label>
<select name="lecture_id" id="lecture_id" class="form-select w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    @foreach ($training->lectures as $lecture)
        <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
    @endforeach
</select><br><br>
        <h1 class="font-bold mb-2 block bg-green-500 p-2 rounded inline-block" id="add_homework">+Add Homework</h1>
        @endif
        @if (isset($homework))
        <input type="text" id="title" name="titles"  placeholder="Homework title" class="w-full px-3 py-2 rounded border border-gray-300 mb-4" value="{{ isset($homework) ? $homework->title : '' }}">
        @else
        <input type="text" id="title" name="titles[]" placeholder="Homework title" class="w-full px-3 py-2 rounded border border-gray-300 mb-4">
        @endif<br>
        @if (isset($homework))
        <input type="text" id="homework" name="description" placeholder="Homework Description" class="w-full px-3 py-2 rounded border border-gray-300 mb-4" value="{{ isset($homework) ? $homework->description : '' }}">
        @else
        <input type="text" id="homework" name="description[]" placeholder="Homework Description" class="w-full px-3 py-2 rounded border border-gray-300 mb-4">
        @endif
        <ul id="homework_list"></ul>
        <input type="hidden" name="lecture_id_hidden" id="lecture_id_hidden" value="{{ isset($homework) ? $homework->lecture_id : '' }}">
        <input type="hidden" name="module_id_hidden" id="module_id_hidden" value="{{ isset($homework) ? $homework->module_id : '' }}">
        <input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded float-right">SAVE</button>
    </form>
</div>
</body>
<script>
var addHomeworkButton = document.getElementById('add_homework');
addHomeworkButton.addEventListener('click', function() {
    var taskInput = document.getElementById('title');
    var homeworkInput = document.getElementById('homework');
    var task = taskInput.value;
    var description = homeworkInput.value;
    if (task !== '' && description !== '') {
        var listItem = document.createElement('li');
        listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');
        var homeworkContent = document.createElement('div');
        homeworkContent.classList.add('flex', 'flex-col');
        var taskElement = document.createElement('p');
        taskElement.textContent = task;
        taskElement.classList.add('mb-4', 'text-gray-600');
        homeworkContent.appendChild(taskElement);
        var descriptionElement = document.createElement('p');
        descriptionElement.textContent = description;
        descriptionElement.classList.add('mb-4', 'text-gray-600');
        homeworkContent.appendChild(descriptionElement);
        listItem.appendChild(homeworkContent);
        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
        deleteButton.addEventListener('click', function() {
            listItem.remove();
        });
        listItem.appendChild(deleteButton);
        var homeworkList = document.getElementById('homework_list');
        homeworkList.appendChild(listItem);
        taskInput.value = '';
        homeworkInput.value = '';
        var hiddenTaskInput = document.createElement('input');
        hiddenTaskInput.type = 'hidden';
        hiddenTaskInput.name = 'titles[]';
        hiddenTaskInput.value = task;
        listItem.appendChild(hiddenTaskInput);
        var hiddenDescriptionInput = document.createElement('input');
        hiddenDescriptionInput.type = 'hidden';
        hiddenDescriptionInput.name = 'description[]';
        hiddenDescriptionInput.value = description;
        listItem.appendChild(hiddenDescriptionInput);
    }
});
document.getElementById('module_id').addEventListener('change', function() {
        var module_id = this.value;
        document.getElementById('module_id_hidden').value = module_id;
        var lectureSelect = document.getElementById('lecture_id');
        lectureSelect.innerHTML = '';
        var lectures = {!! json_encode($lectures) !!};
        var filteredLectures = lectures.filter(function(lecture) {
            return lecture.module_id == module_id;
        });
        filteredLectures.forEach(function(lecture) {
            var option = document.createElement('option');
            option.value = lecture.id;
            option.text = lecture.title;
            lectureSelect.appendChild(option);
        });
    });
    document.getElementById('module_id').addEventListener('change', function () {
        var selectedModuleId = this.value;
        document.getElementById('module_id_hidden').value = selectedModuleId;
    });
    document.getElementById('lecture_id').addEventListener('change', function () {
        var selectedLectureId = this.value;
        document.getElementById('lecture_id_hidden').value = selectedLectureId;
    });
</script>
<script src="{{ asset('js/homework.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
@endsection
