<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('envelope_pledges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("envelope_id");
            $table->unsignedBigInteger("offering_type_id");
            $table->decimal("amount", 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envelope_pledges');
    }
};
