<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webpage extends Model
{
    protected $fillable = [
        'url',
        'name',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
