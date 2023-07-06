<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_employer', 'employer_id', 'training_id')->withTimestamps();
    }
}
