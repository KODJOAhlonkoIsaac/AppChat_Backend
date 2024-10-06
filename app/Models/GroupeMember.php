<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'groupe_id',
        'email',
        'if_already_register',
    ];
}
