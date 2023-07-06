<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Employer;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activation_token',
        'role_id',
        'password_reset_token',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasRole($role)
    {
    return $this->role()->where('name', $role)->exists();
    }

    public function role() {
    return $this->belongsTo(Role::class);
    }

    public function student() {

    return $this->hasMany(Student::class);
    }

    public function employer()
    {
        return $this->hasMany(Employer::class);
    }

    public function teacher() {

        return $this->hasMany(Teacher::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
