<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function renderTrainings($id){
        $training = Training::findOrFail($id);

        return view('availableTrainings',['training'=>$training, 'trainings'=>Training::all()]);
    }


}

