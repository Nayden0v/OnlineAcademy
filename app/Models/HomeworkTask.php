<?php

namespace App\Models;

use App\Models\Homework;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeworkTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'training_id',
        'module_id',
        'lecture_id',
        'homework_id',
        'status',
        'grade'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }
}
