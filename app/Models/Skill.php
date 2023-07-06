<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'skill',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

