@extends('layout')
@section('content')
@include('student.layout')
<br><br>
​
<div class="relative left-60 w-3/4 overflow-hidden rounded-lg border ">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Lecture</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Homework</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Absence</th>
                <th scope="col" class="px-6 py-4 font-large text-gray-900">Score</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            @foreach ($lectureData as $lecture)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">{{ $lecture['title'] }}</td>
                <td class="px-6 py-4">
                    <span class="{{ $lecture['color'] }}">{{ $lecture['overallStatus'] }}</span>
                </td>
                <td class="px-6 py-4">
                    {!! $lecture['overallAttendance'] !!}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($lecture['averageGrade'], 2) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

​
@endsection
