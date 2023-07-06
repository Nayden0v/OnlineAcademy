<?php

namespace App\Http\Controllers\Api;


use App\Models\Training;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TrainingController extends Controller
{

    public function create(Request $request)
{

    $validatedData = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'estimate' => 'required|numeric',
    ]);

    $training = new Training();
    $training->title = $validatedData['title'];
    $training->description = $validatedData['description'];
    $training->start_date = $validatedData['start_date'];
    $training->end_date = $validatedData['end_date'];
    $training->estimate = $validatedData['estimate'];
    $training->save();


    return response()->json(['message' => 'Training created successfully', 'training' => $training], 201);
}

    public function get(string $title)
    {
        $training = Training::select('title', 'description', 'start_date')->where('title', $title)->get();

        return response()->json(['message' => 'Training:', 'data' => $training], 200);
    }

   public function getTrainingbyDate($date)
   {
       $training =  Training::select('title', 'description')->where('start_date', $date)->get();

       return response()->json(['message' => 'Training:', 'data' => $training], 200);
   }

   public function delete(string $title)
   {

    Training::where('title', $title)->delete();

        return response()->json(['message' => 'Training is succesfully deleted.', 204]);
   }

   public function update(string $title, Request $request)
   {

       $training = Training::where('title', $title)->first();

       if (!$training) {

           return response()->json(['message' => 'Training not found'], 404);
       }

       $validatedData = $request->validate([
           'title' => 'required|string',
           'description' => 'required|string',
           'start_date' => 'required|date',
           'end_date' => 'required|date',
           'estimate' => 'required|numeric',
       ]);

       $training->title = $validatedData['title'];
       $training->description = $validatedData['description'];
       $training->start_date = $validatedData['start_date'];
       $training->end_date = $validatedData['end_date'];
       $training->estimate = $validatedData['estimate'];
       $training->save();


       return response()->json(['message' => 'Training successfully updated'], 200);
   }
}
