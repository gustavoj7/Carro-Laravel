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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_model_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('main_photo_url');
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('mileage');
            $table->decimal('price', 12, 2);
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            $table->text('description');
            $table->json('features')->nullable();
            $table->string('status')->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
