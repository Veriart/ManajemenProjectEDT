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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->string('project_location', 255)->nullable();
            $table->foreignId('third_party_id')->constrained('third_parties')->onDelete('cascade');
            $table->date('planned_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Pending', 'Preparation', 'Process', 'BAST', 'Success', 'Cancel'])->default('Pending');
            $table->integer('cost')->default(0);
            $table->integer('remaining_invoice')->default(0);
            $table->integer('expenses')->default(0);
            $table->integer('net_cost')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
