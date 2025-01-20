<?php

namespace App\Models;

use App\Casts\Number;
use App\Models\Concerns\HasTenancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offering extends Model
{
    use HasTenancy;

    protected $fillable = [
        'envelope_id',
        'offering_type_id',
        'amount',
        'date',
        'church_id'
    ];

    protected function casts(): array
    {
        return [
            'amount' => Number::class,
        ];
    }

    /**
     * Get the envelope that owns the Offering
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function envelope(): BelongsTo
    {
        return $this->belongsTo(Envelope::class);
    }
    /**
     * Get the envelope that owns the Offering
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(OfferingType::class, "offering_type_id");
    }
}
