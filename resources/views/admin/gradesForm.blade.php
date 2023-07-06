@extends('layout')
@section('content')
<div class="w-3/4 relative overflow-x-auto shadow-md sm:rounded-lg mx-auto text-center">
    <h1 class="text-2xl font-bold text-left pr-4">Grades/Absence</h1>
    <br><br>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <form action="{{ route('absence') }}" method="POST">
        @csrf
    <div id="container" class="flex ... w-2/3">
        <select id="trainings" class="bg-gray-50 border h-10 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Select training</option>
        </select>
        <br>
        <select id="modules" class="bg-gray-50 border h-10 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="display: none;">

        </select>
        <br>
        <select id="lectures" class="bg-gray-50 border h-10 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="display: none;">
        </select>
        <br>
        <h2 id="lecture_date" class="relative left-44"></h2>

    </div>

    <br>
        <select id="student" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="display: none;">
        </select>
        <input type="hidden" id="lecture_id" name="lecture_id" value="">
        <input type="hidden" id="module_id" name="module_id" value="">
        <input type="hidden" id="training_id" name="training_id" value="">
        <input type="hidden" id="student_id" name="student_id" value="">
    <br>
    <div id="grades_container" class="w-2/3 flex justify-end relative ml-96">
        <div class="border border-gray-300 rounded-lg p-5">
            <h2>Overall Grade / <span id="average-training-grade"></span></h2>
            <p></p>
            <h2>Module Grade / <span id="average-module-grade"></span></h2>
            <p></p>
            <h2>Lecture Grade / <span id="average-lecture-grade"></span></span></h2>
            <p></p>
            <h2>Current Lecture Grade / <span id="lectureGrade" name="lectureGrade"></span></h2>
        </div>
    </div>
    <label for="message" class="block mb-2 font-bold text-left text-2xl font-medium text-gray-900 dark:text-white">Absence</label>
<div id="absence_container" class="hidden">
    <div class="flex items-center w-full">
    <ul class="items-center w-2/4 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
            <div class="flex items-center pl-3">
                <input id="was_late" type="radio" value="was_late" name="attendance_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="was_late" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Was late </label>
            </div>
        </li>
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
            <div class="flex items-center pl-3">
                <input id="escaped" type="radio" value="escaped" name="attendance_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="escaped" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Escaped</label>
            </div>
        </li>
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
            <div class="flex items-center pl-3">
                <input id="did_not_come" type="radio" value="did_not_come" name="attendance_status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="did_not_come" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Did not come</label>
            </div>
        </li>
    </ul>
    <br>
    <div class="flex items-center justify-end ml-auto">
        <input id="default-checkbox" name="disregarded" type="checkbox" value="false" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Disregarded</label>
    </div>
    </div>
    <textarea id="note" name="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
</div>
    <br>
    <h1 class="text-2xl font-bold text-left pr-4">Homework</h1>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Grade
                    </th>
                </tr>
            </thead>
        <tbody class="hidden" id="homework-table-body">
        </tbody>
        <input type="hidden" id="homework_id" name="homework_id" value="">

        </table>
    </div>
    <br>

    <div class="flex justify-end w-full relative right-60">
    <button type="submit" class="flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-1/6 px-5 py-2.5 ml-200 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
    </div>
</form>
<script src="{{ asset('js/grades.js') }}"></script>
@endsection
