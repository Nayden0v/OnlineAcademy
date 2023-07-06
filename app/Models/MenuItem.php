<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
        protected $fillable = [
            'parent_id', 'name', 'route', 'order'
        ];
        // public $timestamps = false;
        public function parent()
        {
            return $this->belongsTo(MenuItem::class, 'parent_id');
        }
        public function children()
        {
            return $this->hasMany(MenuItem::class, 'parent_id');
        }
        public function roles()
        {
            return $this->belongsToMany(Role::class, 'role_menu_item');
        }
}
