<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable implements AuthenticatableContract
{
    use HasFactory;

    protected $guard = 'client';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pseudo',
        'tel',
        'genre',
        'naissance',
        'password',
        'condition',
    ];
}
