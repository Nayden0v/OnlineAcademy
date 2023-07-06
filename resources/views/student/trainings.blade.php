@extends('layout')
@section('content')
@include('student.layout')
<link rel="stylesheet" href="{{ asset('css/background.css') }}">
<body>
    <div class="lecture ml-10">
        <label for="module_id" class="block font-medium text-gray-700">Module:</label>
        <select name="module_id" id="module_id" class="form-select w-1/7 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @foreach ($currentTraining->modules as $module)
                <option value="{{ $module->id }}" class="text-gray-900">{{ $module->title }}</option>
            @endforeach
        </select>
        <br><br>
        <div class="trainings">

    <br><br>

    <br>
        <input type="hidden" name="module_id_hidden" id="module_id_hidden" value="">
            <h1 class="text-4xl">Lectures</h1>
            <ul class="task-list">
            @foreach ($lectures as $lecture)
        <li class="task-list-item text-gray-500">
            <input name="lecture" type="checkbox" class="task-checkbox hidden" id="{{ $lecture['id'] }}" />
                {{ $lecture['title'] }}
        </li>
@endforeach
            </ul>
        </div>
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">Download Files</h1>
            <ul>
                @foreach ($files as $file)
                    <li class="mb-2">
                        <a href="{{ route('file.download', $file->id) }}" class="text-blue-500 hover:text-blue-700">{{ $file->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
<script>
document.getElementById('module_id').addEventListener('change', function() {
    var module_id = this.value;
    document.getElementById('module_id_hidden').value = module_id;
    var lectureList = document.getElementsByClassName('task-list')[0];
    lectureList.innerHTML = '';
    var lectures = {!! json_encode($lectures) !!};
    var filteredLectures = lectures.filter(function(lecture) {
        return lecture.module_id == module_id;
    });
    filteredLectures.forEach(function(lecture) {
        var listItem = document.createElement('li');
        listItem.classList.add('task-list-item', 'text-gray-500');
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.classList.add('task-checkbox', 'hidden');
        checkbox.id = lecture.id;
        var label = document.createElement('label');
        label.classList.add('task-title', 'flex', 'items-center', 'cursor-pointer', 'text-xl', 'font-semibold', 'uppercase');
        label.setAttribute('for', 'lecture');
        label.addEventListener('click', function() {
            listItem.classList.remove('task-list-item', 'text-gray-500');
            listItem.classList.add('task-list-item', 'text-black-700');
        });
        var labelText = document.createTextNode(lecture.title);
        label.appendChild(labelText);
        listItem.appendChild(checkbox);
        listItem.appendChild(label);
        lectureList.appendChild(listItem);
    });
});
</script>
</body>
@endsection
