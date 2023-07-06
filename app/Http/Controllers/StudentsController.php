<?php

// StudentController.php
namespace App\Http\Controllers;


use App\Models\File;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Training;
use App\Models\FileTraining;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{

    public function showOverallProgress($id) {
        $currentTraining = Training::find($id);

            $student = Auth::user()->student->first();
            $students = collect([$student]);


        $studentsData = [];

        foreach ($currentTraining->students as $studentData) {
            if ($studentData->id === $student->id) {
                $studentActivities = 0;
                $totalCoefficient = 0;
                $attendanceStatuses = $studentData->absence()->where('training_id', $currentTraining->id)->pluck('attendance_status');

                foreach ($attendanceStatuses as $attendanceStatus) {
                    if ($attendanceStatus === null) {
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

                if ($studentActivities != 0) {
                    $summarizedCoefficient = round(($totalCoefficient / $studentActivities) * 100);
                } else {
                    $summarizedCoefficient = 0;
                }

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

                $grades = $studentData->homeworkTask()->where('training_id', $currentTraining->id)->pluck('grade');
                $averageGrade = $grades->average();

                $studentsData[] = [
                    'firstName' => $studentData->first_name,
                    'summarizedCoefficient' => $summarizedCoefficient,
                    'checkboxes' => $checkboxes,
                    'averageGrade' => $averageGrade,
                    'id' => $studentData->id,
                    'info' => $studentData->information,
                    'cv' => $studentData->cv ? $studentData->cv->id : '',
                    'language' => $studentData->language?->first()?->language ?? '',

                ];
            }
        }

        return view('student.progress',compact('students','currentTraining','student','studentsData'));
    }

    public function showGrades($id) {
        $currentTraining = Training::find($id);
        $students = Student::all();

        $lectureData = [];
        $student = Auth::user()->student->first();

        $attendanceStatuses = $student->absence()->where('training_id', $currentTraining->id)->pluck('attendance_status');


        foreach ($currentTraining->lectures as $lecture) {
            $homeworkTasks = $lecture->homeworkTask()
                                    ->where('training_id', $currentTraining->id)
                                    ->where('student_id', $student->id)->get();


            $color = 'text-black-500';
            $overallStatus = '--';
            $hasComplete = false;
            $hasIncomplete = false;
            $hasNone = false;

            foreach ($homeworkTasks as $task) {
                if ($task->status == 'Complete') {
                    $hasComplete = true;
                } elseif ($task->status == 'Incomplete') {
                    $hasIncomplete = true;
                } elseif ($task->status == 'None') {
                    $hasNone = true;
                }
            }

            if ($hasIncomplete || $hasNone) {
                $overallStatus = 'Incomplete';
                $color = 'text-yellow-500';
            } elseif ($hasComplete) {
                $overallStatus = 'Complete';
                $color = 'text-green-500';
            }

            if (!$hasComplete && !$hasIncomplete && $hasNone) {
                $overallStatus = 'None';
                $color = 'text-red-500';
            }

            $attendanceStatus = $student->absence()->where('training_id', $currentTraining->id)->where('lecture_id', $lecture->id)->value('attendance_status');

            if (!is_null($attendanceStatus)) {
                $overallAttendance = '&#x2713;';
            } else {
                $overallAttendance = '';
            }

            $totalGrades = 0;
            $gradeCount = 0;
            foreach ($homeworkTasks as $task) {
                $totalGrades += $task->grade;
                $gradeCount++;
            }

            $averageGrade = $gradeCount > 0 ? $totalGrades / $gradeCount : 0;

            $lectureData[] = [
                'title' => $lecture->title,
                'overallStatus' => $overallStatus,
                'color' => $color,
                'overallAttendance' => $overallAttendance,
                'averageGrade' => $averageGrade,
            ];
        }

        return view('student.grades', compact('students', 'currentTraining', 'lectureData'));

    }

    public function showTrainings($id) {
        $lectures = Lecture::all();
        $currentTraining = Training::find($id);
        $students = Student::all();
        $files = FileTraining::where('training_id', $currentTraining->id)->get();
        return view('student.trainings',compact('files','lectures','students','currentTraining'));
    }

    public function download(FileTraining $file)
    {
        return response()->download(storage_path("app/{$file->path}"), $file->name);
    }

    public function downloadCv($id)
    {
        $file = File::findOrFail($id);
        if ($file->student->user->id !== auth()->id() && auth()->user()->role->name !== 'employer') {
            abort(403);
        }
        return Storage::download($file->path, $file->name);
    }

}

