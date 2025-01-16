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
        Schema::table('envelopes', function (Blueprint $table) {
            $table->unsignedBigInteger("offering_type_id")->after("id")->nullable();
            $table->decimal("amount", 15, 2)->after("offering_type_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropColumn("offering_type_id");
            $table->dropColumn("amount");
        });
    }
};
