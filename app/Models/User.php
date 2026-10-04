<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password','phone','avatar','status'];
    protected $hidden = ['password','remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at'=>'datetime','last_login_at'=>'datetime','password'=>'hashed'];
    }

    public function roles(){ return $this->belongsToMany(Role::class,'user_roles'); }

    public function hasRole(string ...$roles): bool
    {
        return $this->roles()->whereIn('slug', $roles)->exists();
    }
}
