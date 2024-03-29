<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneBookUser extends Model
{
    use HasFactory;

    protected $hidden = [
        'password',
        'api_token',
    ];
}
