<?php

namespace App\Models;

use App\Models\Module;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Training;
use App\Models\HomeworkTask;
use Illuminate\Database\Eloquent\Model;


class Homework extends Model
{
    protected $table = 'homeworks';
    protected $fillable = ['title', 'lecture_id', 'module_id', 'student_id', 'training_id', 'description'];


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

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function homeworkTask()
    {
        return $this->hasMany(HomeworkTask::class);
    }
}
