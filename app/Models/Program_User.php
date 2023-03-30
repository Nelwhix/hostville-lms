<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_User extends Model
{
    use HasFactory;

    protected $table = 'program_user';

    protected $fillable = [
        'program_id',
        'user_id'
    ];
}
