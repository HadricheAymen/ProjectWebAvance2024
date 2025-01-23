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
        Schema::create('prescriptionsmedication', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescriptionID')
            ->foreign('prescriptionID')
            ->on('id')
            ->on('prescriptions')
            ->onDelete('restraint');
            $table->unsignedBigInteger('medicationID')
            ->foreign('medicationID')
            ->on('id')
            ->on('medications')
            ->onDelete('restraint');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptionsmedication');
    }
};
