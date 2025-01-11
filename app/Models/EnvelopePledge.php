<?php

namespace App\Models;

use App\Casts\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnvelopePledge extends Model
{
    protected $fillable = [
        "amount",
        "envelope_id",
        "offering_type_id",
        "type_id"
    ];

    protected function casts(): array
    {
        return [
            'amount' => Number::class,
        ];
    }
    

    /**
     * Get the envelope that owns the EnvelopePledge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function envelope(): BelongsTo
    {
        return $this->belongsTo(Envelope::class);
    }

    /**
     * Get the offeringType that owns the EnvelopePledge
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offeringType(): BelongsTo
    {
        return $this->belongsTo(OfferingType::class);
    }
}
