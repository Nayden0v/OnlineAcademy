<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Hobby;
use App\Models\Skill;
use App\Models\Student;
use App\Models\Webpage;
use App\Models\Language;
use App\Models\Messenger;
use App\Models\Repository;
use App\Models\HomeworkTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDetailsRequest;
use App\Http\Requests\StoreStudentRequest;

class AdminStudentsController extends Controller
{
    public function showStudentForm() {

        return view('admin.student.studentsForm',['students'=>Student::all()]);
    }

    public function store(StoreStudentRequest $request) {

        $studentData = $request->validated();

        $user = User::where('email', $studentData['email'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User with the provided email does not exist.');
        }

        $studentData['user_id'] = $user->id;

        if (!$request->input('selectedTrainings') == null) {
            $selectedTrainings = explode(',', $request->input('selectedTrainings'));

            $student = Student::create($studentData);

            $student->trainings()->attach($selectedTrainings);

            return redirect()->back()->with('success', 'Student created successfully.');
        } else {
            $student = Student::create($studentData);
        }

        return redirect()->back()->with('success', 'Student created successfully.');

    }

    public function showEditForm($student) {
        $studentData = Student::find($student);
        return view('admin.student.studentsForm', ['student' => $studentData]);
    }

    public function update(Request $request, $id) {

     $studentData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:students,email,'.$id,
        'phone' => 'required',
        'country' => 'required',
        'city' => 'required',
        'information' => 'required',
    ]);

    $user = User::where('email', $studentData['email'])->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User with the provided email does not exist.');
    }

    $studentData['user_id'] = $user->id;

     $selectedTrainings = explode(',', $request->input('selectedTrainings'));

        $student = Student::findOrFail($id);

        $student->update($studentData);

        $student->trainings()->sync($selectedTrainings);

        return redirect()->route('student.table')->with('success', 'Student updated successfully.');
    }

    public function delete(Student $student) {

        $student->delete();
        return redirect()->route('student.table')->with('success', 'Student deleted successfully.');
    }

    public function deleteConfirmation(Student $student) {

        return view('utils.delete_confirmation', compact('student'));
    }


    public function showStudentSkill($id) {

        $student = Student::find($id);

        return view('admin.student.studentSkill',compact('student'));
     }

    public function showStudentTable() {

        return view('admin.student.studentsTable',['students'=>Student::all()]);
        }

        public function storeDetails(StoreDetailsRequest $request)
        {
            $request->validated();

            $repositories = $request->input('repository');
            $studentId = $request->input('student_id');
            foreach ($repositories as $repository) {
                Repository::create([
                    'repository' => $repository,
                    'student_id' => $studentId,
                ]);
            }
            $skills = $request->input('skill');
            $studentId = $request->input('student_id');
            foreach ($skills as $skill) {
                Skill::create([
                    'skill' => $skill,
                    'student_id' => $studentId,
                ]);
            }
            $hobbies = $request->input('hobby');
            $studentId = $request->input('student_id');
            foreach ($hobbies as $hobby) {
                Hobby::create([
                    'name' => $hobby,
                    'student_id' => $studentId,
                ]);
            }
                Messenger::create([
                    'messenger' => $request->input('messenger'),
                    'student_id' => $request->input('student_id'),
                ]);
            $urls = $request->input('url');
            $names = $request->input('name');
            $studentId = $request->input('student_id');
            foreach ($urls as $index => $url) {
                Webpage::create([
                    'url' => $url,
                    'name' => $names[$index],
                    'student_id' => $studentId,
                ]);
            }
            $languages = $request->input('language');
            $scores = $request->input('score');
            $studentId = $request->input('student_id');
            foreach ($languages as $index => $language) {
                Language::create([
                    'language' => $language,
                    'score' => $scores[$index],
                    'student_id' => $studentId,
                ]);
            }
            return redirect()->back()->with('success', 'Student created successfully.');
        }

        public function storeCv(Request $request)
        {
            $request->validate([
                'cv' => 'required|mimes:pdf|max:2048',
            ]);
            $user = auth()->user();
            $student = $user->student->first();
            if ($user && $student) {

                if ($student->cv) {
                    Storage::delete($student->cv->path);
                    $student->cv()->delete();
                }

                $path = $request->file('cv')->store('cv');
                File::create([
                    'name' => $request->file('cv')->getClientOriginalName(),
                    'path' => $path,
                    'student_id' => $student->id,
                ]);
                return back()->with('success', 'CV uploaded successfully');
            }
            return back()->with('error', 'No related student record found');
        }

        public function downloadCv($id)
        {
            $file = File::findOrFail($id);
            if ($file->student->user->id !== auth()->id() && auth()->user()->role->name !== 'employer') {
                abort(403);
            }
            return Storage::download($file->path, $file->name);
        }

        public function showCvUploadForm()
        {
            $file = auth()->user()->student->first()->cv ?? null;
            return view('student.cv_upload', compact('file'));
        }
}


