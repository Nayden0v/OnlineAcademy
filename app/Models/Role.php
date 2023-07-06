<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'role_menu_item');
    }
}
