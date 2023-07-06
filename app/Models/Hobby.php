<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = [
        'name',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

