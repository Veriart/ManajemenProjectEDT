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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->string('order_code', 50)->unique();
            $table->enum('type', ['In', 'Out']);
            $table->enum('status', ['Preparation', 'Process', 'BAST', 'Success', 'Cancel'])->default('Preparation');
            $table->integer('price');
            $table->integer('sales_tax');
            $table->integer('inc_tax');
            $table->integer('discount');
            $table->enum('payment_terms', ['DP 30%, Progress 30%, After BAST 40%', 'DP 50%, Progress 20%, After BAST 25%, Retensi 1 Bulan 5%', '30% Down Payment, 60% Before Delivery, 10% After TesComm', 'Cash On Delivery', '50% DP, 50% After BAST', '50% DP, 50% Before Delivery', 'Invoice/Maintenance Visit', 'No DP, 100% After Completion', '40% Before Delivery, 55% After BAST, 5% Retention', '100% Before Delivery', 'DP 30%, Progress 30%, After Completion 35%, 5% Retention', 'Due Upon Receipt']);
            $table->enum('payment_type', ['Bank Transfer', 'Cash', 'Check', 'Credit Card', 'Debit Payment Order']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
