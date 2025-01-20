<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Church extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the customers for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function envelopes(): HasMany
    {
        return $this->hasMany(Envelope::class);
    }

    /**
     * Get all of the customers for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function churchMembers(): HasMany
    {
        return $this->hasMany(ChurchMember::class);
    }

    /**
     * Get all of the customers for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offeringTypes(): HasMany
    {
        return $this->hasMany(OfferingType::class);
    }

    /**
     * Get all of the customers for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offerings(): HasMany
    {
        return $this->hasMany(Offering::class);
    }
}
