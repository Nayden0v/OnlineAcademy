<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Lecture;
use App\Models\Homework;
use App\Models\Training;
use App\Models\FileTraining;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\StoreHomeworkRequest;
use App\Http\Requests\StoreTrainingRequest;

class AdminTrainingController extends Controller
{
    public function showTrainingTable() {
        return view('admin.training.trainingTable');
    }
    public function showTrainingForm() {
        return view('admin.training.trainingForm');
    }

    public function storeTraining(StoreTrainingRequest $request) {


        Training::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'estimate' => $request->input('estimate'),
        ]);
    return redirect()->back()->with('success', 'The operation was succesful!');
    }

    public function showTrainingEditForm($training) {

        $trainingData = Training::find($training);
        return view('admin.training.trainingForm', ['training' => $trainingData]);
    }

    public function updateTraining(Request $request, Training $training) {

        $updatedData = $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'estimate'=> 'required',
        ]);

        $training->update($updatedData);

        return redirect()->route('training.table')->with('success', 'Student updated successfully.');
    }

    public function deleteTraining(Training $training) {

        $training->delete();
        return redirect()->back()->with('success', 'You delete the training');
    }

    public function showModule($id) {

        $training = Training::find($id);
        return view('admin.training.module', compact('training'));
    }
    public function showModuleTable($id) {

        $training = Training::find($id);
        $modules = Module::all();

        return view('admin.training.moduleTable', compact('training' , 'modules'));
    }

    public function storeModule(Request $request, int $id) {

        $training = Training::find($id);

            $request->validate([
            'module_title.*' => 'required|string',
            'description.*' => 'required|string',
        ]);

        $moduleTitles = $request->input('module_title');
        $description = $request->input('description');
        foreach ($moduleTitles as $index => $title) {
            $module = new Module();
            $module->title = $title;
            $module->description = $description[$index];
            $module->training_id = $training->id;
            $module->save();
        }
        return redirect()->back()->with('success', 'The module is added successfully');
    }

    public function editModule($training, $module) {
        $training = Training::find($training);
        $moduleData = Module::find($module);
        return view('admin.training.module', ['module' => $moduleData, 'training' => $training]);
    }
    public function updateModule(Request $request, $id, $moduleId) {
        $training = Training::findOrFail($id);
        $module = Module::findOrFail($moduleId);
        $validatedData = $request->validate([
            'module_title' => 'required',
            'description' => 'required',
        ]);
        $module->title = $validatedData['module_title'];
        $module->description = $validatedData['description'];
        $module->save();
        return redirect()->back()->with('success', 'The module is updated successfully!');
    }
    public function deleteModule(Module $module) {

        $module->delete();
        return redirect()->back()->with('success', 'You delete the module');
    }

    public function showLecture($id) {

        $training = Training::find($id);
        $modules = Module::all();

        return view('admin.training.lecture', compact('training' , 'modules'));
    }

    public function showLectureTable($id) {

        $training = Training::find($id);
        $modules = Module::all();
        $lectures = Lecture::all();
        return view('admin.training.lectureTable', compact('lectures','modules','training'));
    }

    public function storeLecture(StoreLectureRequest $request)
    {
        $lectureTitles = $request->input('lecture_title');
        $lectureDescriptions = $request->input('lecture_description');
        $lectureDates = $request->input('lecture_date');
        $moduleId = $request->input('module_id');
        $trainingId = $request->input('training_id');
        $lectures = [];
        foreach ($lectureTitles as $index => $lectureTitle) {
            $lecture = new Lecture();
            $lecture->title = $lectureTitle;
            $lecture->description = $lectureDescriptions[$index];
            $lecture->date = $lectureDates[$index];
            $lecture->module_id = $moduleId;
            $lecture->training_id = $trainingId;
            $lecture->save();
            $lectures[] = $lecture;
        }
        return redirect()->back()->with('success', 'The lectures were added succesfully!');
    }

    public function editLecture($lecture) {

        Lecture::find($lecture);
        return view('admin.training.lecture', ['lecture' => $lecture]);
    }

    public function updateLecture(Request $request, Lecture $lecture) {

        $validatedData = $request->validate([
            'lecture_title'=> 'required',
            'lecture_description'=> 'required',
            'lecture_date'=> 'required',
        ]);
        $lecture->title = $validatedData['lecture_title'];
        $lecture->description = $validatedData['lecture_description'];
        $lecture->date = $validatedData['lecture_date'];

        $lecture->save($validatedData);

        return redirect()->back()->with('success', 'lecture updated successfully.');
    }
    public function deleteLecture(Lecture $lecture) {

        $lecture->delete();
        return redirect()->back()->with('success', 'You delete the lecture');


    }

    public function showHomework($id) {

        $training = Training::find($id);
        $modules = Module::all();
        $lectures = Lecture::all();

        return view('admin.training.homework', compact('training' , 'modules' , 'lectures'));
    }

    public function storeHomework(StoreHomeworkRequest $request) {

        $lectureId = $request->input('lecture_id');
        $trainingId = $request->input('training_id');
        $moduleId = $request->input('module_id');
        $titles = $request->input('titles');
        $descriptions = $request->input('description');
        foreach ($titles as $index => $titles) {
            $homework = new Homework();
            $homework->lecture_id = $lectureId;
            $homework->training_id = $trainingId;
            $homework->module_id = $moduleId;
            $homework->title = $titles;
            $homework->description = $descriptions[$index];
            $homework->save();
        }

        return redirect()->back()->with('success', 'Homework added successfully.');
    }

    public function showHomeworkTable($id) {
        $training = Training::find($id);
        $module = Module::all();
        $lectures = Lecture::all();
        $homeworks = Homework::all();
        return view('admin.training.homeworkTable', compact('homeworks','lectures','module','training'));
    }
    public function editHomework($homework) {
        $lectures = Lecture::all();
        $homework = Homework::find($homework);
        $training = Training::find($homework->training_id);
        return view('admin.training.homework', ['homework' => $homework, 'lectures' => $lectures, 'training' => $training]);
    }

    public function updateHomework(Request $request, Homework $homework) {

        $validatedData = $request->validate([
            'titles'=> 'required',
            'description'=> 'required',
        ]);

        $homework->title = $validatedData['titles'];
        $homework->description = $validatedData['description'];

        $homework->update($validatedData);

        return redirect()->back()->with('success', 'Homework task updated successfully.');
    }



    public function deleteHomework(Homework $homework) {

        $homework->delete();

        return redirect()->back()->with('success', 'You delete the training');
    }

    public function upload(Request $request)
    {
        $trainingId = $request->input('training_id');

        if (empty($trainingId)) {
            return redirect()->back()->with('error', 'Please add a training first.');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileTraining = new FileTraining();
            $fileTraining->trainingId;
            $fileTraining->name = $file->getClientOriginalName();
            $fileTraining->path = $file->store('file_training');
            $fileTraining->save();
            return redirect()->back()->with('success');
        }

    }

}
