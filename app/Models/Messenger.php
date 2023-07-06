<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    protected $table = 'messenger';

    protected $fillable = [
        'student_id',
        'messenger',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

