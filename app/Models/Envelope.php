<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Envelope extends Model
{
    protected $fillable = [
        "name",
        "phone_number",
    ];

    /**
     * Get all of the pledges for the Envelope
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pledges(): HasMany
    {
        return $this->hasMany(EnvelopePledge::class);
    }
}
