<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_teacher', 'teacher_id', 'training_id')->withTimestamps();
    }
}
