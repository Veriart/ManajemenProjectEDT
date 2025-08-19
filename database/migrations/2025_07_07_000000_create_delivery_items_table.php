<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_order_id');
            $table->text('description');
            $table->integer('qty');
            $table->string('uom', 50);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_items');
    }
};