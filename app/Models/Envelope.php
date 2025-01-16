<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Envelope extends Model
{
    protected $fillable = [
        "name",
        "phone_number",
        "amount",
        "offering_type_id"
    ];

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
        return $this->belongsTo(Member::class);
    }
}
