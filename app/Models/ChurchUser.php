<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchUser extends Model
{
    protected $table = 'church_user';
    
    protected $fillable = [
        'user_id',
        'church_id',
    ];
}
