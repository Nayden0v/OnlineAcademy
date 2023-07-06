<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTraining extends Model
{
    protected $fillable = ['filename', 'path','training_id'];
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
