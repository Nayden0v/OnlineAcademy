<?php

namespace App\Models;

use App\Models\Student;
use App\Models\LanguageScore;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

        protected $table = 'languages';

        protected $fillable = ['language', 'score', 'student_id'];

        public function student()
        {
            return $this->belongsTo(Student::class);
        }


    }


