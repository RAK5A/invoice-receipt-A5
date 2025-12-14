<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('phone', 100);
            $table->string('name_ship');
            $table->string('address_1_ship');
            $table->string('address_2_ship')->nullable();
            $table->string('town_ship');
            $table->string('county_ship');
            $table->string('postcode_ship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_customers');
    }
};
