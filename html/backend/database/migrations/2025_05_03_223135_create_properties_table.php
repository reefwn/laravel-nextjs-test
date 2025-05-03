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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->boolean('for_sale')->default(false)->index();
            $table->boolean('for_rent')->default(false)->index();
            $table->boolean('sold')->default(false)->index();
            $table->decimal('price', 15, 2)->nullable()->index();
            $table->string('currency', 3)->default('THB')->index();
            $table->string('currency_symbol', 5)->nullable();
            $table->string('property_type')->nullable()->index();
            $table->integer('bedrooms')->nullable()->index();
            $table->integer('bathrooms')->nullable()->index();
            $table->float('area')->nullable();
            $table->string('area_type')->nullable();

            // Foreign keys
            $table->foreignId('geo_location_id')->constrained()->cascadeOnDelete()->index();
            $table->foreignId('photo_set_id')->constrained('photo_sets')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
