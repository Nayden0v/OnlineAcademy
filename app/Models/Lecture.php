<?php

namespace App\Models;

use App\Models\Absence;
use App\Models\Student;
use App\Models\Homework;
use App\Models\Training;
use App\Models\HomeworkTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecture extends Model
{
    protected $table = 'lectures';

    protected $fillable = ['title', 'description', 'date','module_id','training_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function homework()
    {
        return $this->hasMany(Homework::class);
    }

    public function homeworkTask()
    {
        return $this->hasMany(HomeworkTask::class);
    }

    public function absence()
    {
        return $this->hasMany(Absence::class);
    }
}
