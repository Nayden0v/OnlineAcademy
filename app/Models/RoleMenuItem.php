<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenuItem extends Model
{
    use HasFactory;
    protected $table = 'role_menu_item';
    protected $fillable = [
        'role_id',
        'menu_item_id'
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
