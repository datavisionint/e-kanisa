<?php

namespace App\Models;

use App\Models\Concerns\HasTenancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferingType extends Model
{
    use SoftDeletes, HasTenancy;

    protected $fillable = [
        'name',
        'church_id'
    ];
}
