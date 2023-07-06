<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'path', 'student_id'];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
