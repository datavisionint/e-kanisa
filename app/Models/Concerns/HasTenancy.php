<?php

namespace App\Models\Concerns;

use App\Models\Church;
use App\Models\Company;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait HasTenancy
{
    public static function bootHasTenancy()
    {
        if (app()->runningInConsole() || blank(Filament::getTenant())) return;
        if (!Schema::hasColumn((new static)->getTable(), 'church_id')) {
            Schema::table((new static)->getTable(), function (Blueprint $table) {
                $table->unsignedBigInteger('church_id')->nullable();
            });
        }
        static::creating(function (Model $model) {
            $model->church_id = Filament::getTenant()->id;
        });
        static::addGlobalScope(
            function (Builder $query) {
                $query->whereBelongsTo(Filament::getTenant());
            }
        );
    }


    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
