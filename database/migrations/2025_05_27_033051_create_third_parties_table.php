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
        Schema::create('third_parties', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name', 100);
            $table->string('alias', 50);
            $table->enum('type', ['Customer','Vendor'])->default('Customer');
            $table->enum('status', ['Active', 'Non Active'])->default('Active');
            $table->string('vat', 50);
            $table->string('contact', 50);
            $table->string('telepon', 50);
            $table->string('address', 255);
            $table->string('website', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('third_parties');
    }
};
