<?php

namespace App\Models;

use App\Models\User;
use App\Models\Hobby;
use App\Models\Skill;
use App\Models\Module;
use App\Models\Absence;
use App\Models\Lecture;
use App\Models\Project;
use App\Models\Webpage;
use App\Models\Homework;
use App\Models\Language;
use App\Models\Training;
use App\Models\Messenger;
use App\Models\Repository;
use App\Models\HomeworkTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',
        'user_id',
        'information',
        'selectedTrainings'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'student_training', 'student_id', 'training_id')->withTimestamps();
    }

    public function messengers()
    {
        return $this->hasMany(Messenger::class);
    }
    public function hobby()
    {
        return $this->hasMany(Hobby::class);
    }
    public function language()
    {
        return $this->hasMany(Language::class);
    }
    public function repository()
    {
        return $this->hasMany(Repository::class);
    }
    public function skill()
    {
        return $this->hasMany(Skill::class);
    }
    public function webpage()
    {
        return $this->hasMany(Webpage::class);
    }

    public function module()
    {
        return $this->hasMany(Module::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function lecture()
    {
        return $this->hasMany(Lecture::class);
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

    public function cv()
    {
        return $this->hasOne(File::class);
    }
}
