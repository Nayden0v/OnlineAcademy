<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_status', 'disregarded', 'training_id', 'module_id', 'student_id', 'lecture_id', 'note'];

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
}
