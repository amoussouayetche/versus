<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable implements AuthenticatableContract
{
    use HasFactory;

    protected $guard = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'image',
        'email',
        // 'role',
        'specialite',
        'password',
    ];

   
}
