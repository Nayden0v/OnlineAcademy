<?php

namespace App\Models;


use App\Models\Student;
use App\Models\Homework;
use App\Models\Training;
use App\Models\HomeworkTask;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    protected $fillable = ['title', 'description'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecture()
    {
        return $this->hasMany(Lecture::class);
    }

    public function homewroks()
    {
        return $this->hasMany(Homework::class);
    }

    public function homewrokTasks()
    {
        return $this->hasMany(HomeworkTask::class);
    }
}
