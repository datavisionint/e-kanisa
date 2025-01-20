<?php

namespace App\Models;

use App\Models\Concerns\HasTenancy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ChurchMember extends Model
{
    protected $table = "members";
    use HasTenancy;

    protected $fillable = [
        "first_name",
        "middle_name",
        "last_name",
        "gender",
        "birth_date",
        "phone_number",
        "status"
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . " " . $this->last_name
        );
    }
}
