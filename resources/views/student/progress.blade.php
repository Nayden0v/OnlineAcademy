@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/background.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@if (Auth::user()->hasRole('employer'))
<div class="info flex justify-center items-center">
    <h1 class="text-center text-5xl">{{ $currentTraining->title }}</h1>
</div>
@else
@include('student.layout')
@endif
<br><br>
<body>
<div class="mt-4 ml-44 w-3/4 rounded-lg border">
    <table id="student1" class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Name</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Activity</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Overall Performance</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Final Score</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Languages</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            @foreach ($studentsData as $studentData)
                <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 relative" >
                <label for="resume-toggle-{{ $studentData['id'] }}" @click="toggleResumePopup($event)">
                    {{ $studentData['firstName'] }}
                </label>
                <input type="checkbox" id="resume-toggle-{{ $studentData['id'] }}" class="hidden" />
               <div id="app" style="border-radius: 10px; width: 500px;" class="resume-popup bg-gray-200 w-full h-32 absolute top-full left-0" v-show="showResumePopup">
                    <p class="w-3/4">{{ $studentData['info'] }}</p>
                    <a href="{{ route('downloadCv', $studentData['cv']) }}" class="absolute top-0 right-0 mt-2 mr-2 text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor" aria-label="download cv">
                            <path fill-rule="evenodd" d="M7 2a1 1 0 00-1 1v3H4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 001-1V7a1 1 0 00-1-1h-2V3a1 1 0 00-1-1H7zm5 2H8v1a1 1 0 001 1h3v9H4V7h3a1 1 0 001-1V4h4v1a1 1 0 001 1h1v1zm-2 5H8v5h2v-5zm4 0h-1v5h1v-5z" clip-rule="evenodd" />
                        </svg>
                    </a>
               </div>
                </td>
                    <td class="px-6 py-4">
                        {{ $studentData['summarizedCoefficient'] }}%
                    </td>
                    <td class="px-6 py-4">
                        @for ($i = 0; $i < $studentData['checkboxes']; $i++)
                            <span class="fa fa-star checked"></span>
                        @endfor
                        @for ($i = $studentData['checkboxes']; $i < 5; $i++)
                            <span class="fa fa-star"></span>
                        @endfor
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($studentData['averageGrade'], 2) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $studentData['language'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="{{ asset('js/bubble.js') }}"></script>
<div id="app">

</div>
</body>
@endsection
