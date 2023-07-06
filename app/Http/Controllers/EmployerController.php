<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Training;


class EmployerController extends Controller
{
    public function showPerformance($id) {
        $currentTraining = Training::find($id);
        $students = Student::all();
        $studentsData = [];

        foreach ($students as $student) {
            $studentActivities = 0;
            $totalCoefficient = 0;
            $attendanceStatuses = $student->absence()->where('training_id', $currentTraining->id)->pluck('attendance_status');

            foreach ($attendanceStatuses as $attendanceStatus) {
                if ($attendanceStatus === '') {
                    $totalCoefficient += 1;
                    $studentActivities++;
                } elseif ($attendanceStatus === 'was_late') {
                    $totalCoefficient += 0.75;
                    $studentActivities++;
                } elseif ($attendanceStatus === 'escaped') {
                    $totalCoefficient += 0.25;
                    $studentActivities++;
                }

                if ($attendanceStatus === 'did_not_come') {
                    $studentActivities++;
                }
            }

            $summarizedCoefficient = $studentActivities > 0 ? round(($totalCoefficient / $studentActivities) * 100) : 0;

            $checkboxes = 0;

            if ($summarizedCoefficient <= 10) {
                $checkboxes = 1;
            } elseif ($summarizedCoefficient < 30 && $summarizedCoefficient > 10) {
                $checkboxes = 2;
            } elseif ($summarizedCoefficient < 50 && $summarizedCoefficient > 30) {
                $checkboxes = 3;
            } elseif ($summarizedCoefficient >= 50 && $summarizedCoefficient < 80) {
                $checkboxes = 4;
            } else {
                $checkboxes = 5;
            }

            $grades = $student->homeworkTask()->where('training_id', $currentTraining->id)->pluck('grade');
            $averageGrade = $grades->average();

            $studentsData[] = [
                'firstName' => $student->first_name,
                'summarizedCoefficient' => $summarizedCoefficient,
                'checkboxes' => $checkboxes,
                'averageGrade' => $averageGrade,
                'id' => $student->id,
                'info' => $student->information,
                'cv' => $student->cv ? $student->cv->id : '',
                'language' => $student->language?->first()?->language ?? '',
            ];
        }

        return view('student.progress', compact('students', 'currentTraining', 'studentsData'));
    }
}
