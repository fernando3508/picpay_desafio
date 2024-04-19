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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->unsignedBigInteger('id_payer');
            $table->unsignedBigInteger('id_payee');
            $table->decimal('value', 10, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_payer')->references('id_user')->on('user');
            $table->foreign('id_payee')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
