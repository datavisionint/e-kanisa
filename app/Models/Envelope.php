<?php

namespace App\Models;

use App\Casts\Number;
use App\Models\Concerns\HasTenancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Envelope extends Model
{
    use HasTenancy;

    protected $fillable = [
        "name",
        "phone_number",
        "amount",
        "offering_type_id",
        "church_id"
    ];

    public function casts(){
        return [
            "amount" => Number::class
        ];
    }

    /**
     * Get all of the offeringType for the Envelope
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offeringType(): BelongsTo
    {
        return $this->belongsTo(OfferingType::class);
    }

    /**
     * Get the member that owns the Envelope
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(ChurchMember::class);
    }
}
