<?php

namespace App\Models;

use App\Models\Module;
use App\Models\Lecture;
use App\Models\Project;
use App\Models\Student;
use App\Models\Homework;
use App\Models\HomeworkTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'estimate',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function employers()
    {
        return $this->belongsToMany(Training::class)->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

    public function homeworkTasks()
    {
        return $this->hasMany(HomeworkTask::class);
    }

}
