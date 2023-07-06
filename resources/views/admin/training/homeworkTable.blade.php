@extends('layout')
@section('content')<body>
<h1 class="text-xl font-bold mb-4 ml-10">
    <a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад</a>
</h1>
<div class="mb-4 relative left-60 w-3/4 overflow-hidden rounded-lg border">
<h1 class="text-2xl font-bold mb-4">TRAINING TITLE: {{ $training->title }}</h1>
<input type="hidden" name="training_id" id="training_id" value="{{ $training->id }}">
<label class="font-bold" for="module_id">MODULE TITLE:</label>
<select name="module_id" id="module_id" class="form-select w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    @foreach ($training->modules as $module)
        <option value="{{ $module->id }}">{{ $module->title }}</option>
    @endforeach
</select><br><br>

<input type="hidden" name="module_id_hidden" id="module_id_hidden" value="{{ $module->id }}">

<label class="font-bold" for="lecture_id">LECTURE TITLE:</label>
<select name="lecture_id" id="lecture_id" onchange="updateLectureId()" class="form-select w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    <option value="">Изберете лекция</option>
</select><br><br>
</div>

<div class="mb-4">
    <input type="hidden" type="text" id="lecture-id" name="lecture-id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>
<div class="mb-4 relative left-60 w-3/4 overflow-hidden rounded-lg border">
<table id="homework-table" class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tasks</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Homework Description</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($homeworks as $homework)
            <tr data-lecture-id="{{ $homework->lecture_id }}">
                <td class="px-6 py-4 whitespace-no-wrap">{{ $homework->title }}</td>
                <td class="px-6 py-4 whitespace-no-wrap">{{ $homework->description }}</td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="flex gap-4">
                        <a href="{{ route('homework.edit', ['homework' => $homework->id]) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('homework.destroy', $homework->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500" onclick="return confirm('Are you sure you want to delete this record?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash transform hover:scale-110" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</body>
<script>
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


    function updateLectureId() {
        var selectedOption = document.getElementById("lecture_id").value;

        document.getElementById("lecture-id").value = selectedOption;

        var homeworkRows = document.querySelectorAll("#homework-table tbody tr");
        for (var i = 0; i < homeworkRows.length; i++) {
            var lectureId = homeworkRows[i].dataset.lectureId;
            if (selectedOption === "" || lectureId === selectedOption) {
                homeworkRows[i].style.display = "table-row";
            } else {
                homeworkRows[i].style.display = "none";
            }
        }
    }
</script>
<script src="{{ asset('js/homework.js') }}"></script>
@endsection
