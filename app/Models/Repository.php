<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = [
        'repository',
        'student_id'
    ];

    // Relationship with Student model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
