@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/background.css') }}">
<div class="max-w-2xl mx-auto p-6 bg-gray-200">
      @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <h1 class="text-lg font-bold mb-4">Add/Edit Skill</h1>
      <form  action="{{ route('detailStore')}}" method="post">
        @csrf

         <input type="hidden" name="student_id" value="{{ isset($student) ? $student->id : '' }}">

         <input type="text" id="language" value="" name="language[]" value="{{ isset($student) ? $student->language : '' }}" class="w-2/5 py-2 px-4 mb-4 rounded border border-gray-300" placeholder="Language" required>
          <input type="text" name="score[]" value="{{ isset($student) ? $student->score : '' }}" id="languageScore" class="w-2/5 py-2 px-4 mb-4 rounded border border-gray-300" placeholder="level" required>
          <button type="button" onclick="addLanguageScore()" class="w-1/8 py-2 px-4 mb-4 rounded border border-gray-300 bg-green-500 text-white">+</button>
          <ul id="languageScoreList"></ul>


   <input type="text" id="repository" name="repository[]" value="" class="w-4/5 py-2 px-4 mb-4 rounded border border-gray-300" placeholder="Repository" required>
        <button type="button" onclick="addRepository()" class="w-1/8 py-2 px-4 mb-4 rounded border border-gray-300 bg-green-500 text-white">+</button>
        <ul id="repositoryList"></ul>


      <div id="app">
      <h1 class="text-lg font-bold cursor-pointer" @click="toggleForm">users details</h1>

        <div :class="{ hidden: !showForm }" >

        <input type="text" name="url[]" id="url" placeholder="URL" class="w-2/5 py-2 px-4 mb-4 rounded border border-gray-300">
        <input type="text" name="name[]" id="Name" class="w-2/5 py-2 px-4 mb-4 rounded border border-gray-300" placeholder="Web page name">
        <button type="button" onclick="addWebPage()" class="w-1/8 py-2 px-4 mb-4 rounded border border-gray-300 bg-green-500 text-white ml-auto">+</button>
        <ul id="webPageList"></ul>

      <input type="text" id="messenger" name="messenger" placeholder="messenger name" class="w-full py-2 px-4 mb-4 rounded border border-gray-300">

        <input type="text" name="hobby[]" id="hobby" class="w-4/5 py-2 px-4 mb-4 rounded border border-gray-300" placeholder="Hobby">
        <button type="button" onclick="addHobby()" class="w-1/8 py-2 px-4 mb-4 rounded border border-gray-300 bg-green-500 text-white">+</button>
        <ul id="hobbyList"></ul>

        <input type="text" name="skill[]" id="skill" class="w-4/5 py-2 px-4 mb-4 rounded border border-gray-300" placeholder="Skills">
        <button type="button" onclick="addSkill()" class="w-1/8 py-2 px-4 mb-4 rounded border border-gray-300 bg-green-500 text-white">+</button>
        <ul id="skillsList"></ul>


      </div>
      <div class="flex justify-end">
          <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">SAVE</button>
        </div>
      </form>
    </div>
    <script src="https://unpkg.com/vue@2.6.14/dist/vue.js"></script>
    <script>

//       new Vue({
//   el: "#app",
//   data: {
//     showForm: false
//   },
//   methods: {
//     toggleForm() {
//       this.showForm = !this.showForm;
//     }
//   }
// });
    </script>
<script src="{{ asset('js/app.js') }}"></script>
  </div>
  @endsection
