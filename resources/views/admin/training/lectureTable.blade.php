@extends('layout')
@section('content')
<h1 class="text-xl font-bold mb-4 ml-10">
    <a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад</a>
</h1>
<div class="mb-4 relative left-60 w-3/4 overflow-hidden rounded-lg border">
    <label for="module" class="block text-sm font-medium text-gray-700">Select Module:</label>
    <select id="module" name="module" onchange="updateModuleId()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">All Modules</option>
        @foreach ($training->modules as $module)
            <option value="{{ $module->id }}">{{ $module->title }}</option>
        @endforeach
    </select>
</div>
<div  class="mb-4">
    <input type="hidden" type="text" id="module-id" name="module-id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>

<div class="relative left-60 w-3/4 overflow-hidden rounded-lg border">
<table id="lecture-table" class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Lecture Title</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Lecture Description</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">

        @foreach ($lectures as $lecture)
        <tr data-module-id="{{ $lecture->module_id }}">
            <td class="px-6 py-4 whitespace-no-wrap">{{ $lecture->title }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $lecture->description }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">
                <div class="flex gap-4">
                    <a href="{{ route('lecture.edit', ['lecture' => $lecture->id]) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form action="{{ route('lecture.destroy', $lecture->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash transform hover:scale-110" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6a.5.5 0 0 0 .5-.5zm-9-9a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1H1V2z"/>
                                <path fill-rule="evenodd" d="M4.5 4 4 4.5V14a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.5L11.5 4H4.5zM11 5H5v9h6V5z"/>
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
<script>
    function updateModuleId() {
        var selectedOption = document.getElementById("module").value;
        document.getElementById("module-id").value = selectedOption;
    }

    function updateModuleId() {
        var selectedOption = document.getElementById("module").value;
        document.getElementById("module-id").value = selectedOption;


        var lectureRows = document.querySelectorAll("#lecture-table tbody tr");
        for (var i = 0; i < lectureRows.length; i++) {
            var moduleId = lectureRows[i].dataset.moduleId;
            if (selectedOption === "" || moduleId === selectedOption) {
                var mar = document.getElementById('data-module-id');
                lectureRows[i].style.display = "table-row";
            } else {
                lectureRows[i].style.display = "none";
            }
        }
    }
</script>

@endsection
