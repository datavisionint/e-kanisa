<?php

namespace App\Filament\Clusters;

use App\Models\Envelope;
use Filament\Clusters\Cluster;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offering extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-s-archive-box-arrow-down';

}
