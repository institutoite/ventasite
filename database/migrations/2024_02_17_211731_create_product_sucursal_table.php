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
        Schema::create('product_sucursal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sucural_id');

            $table->unsignedInteger('stock')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->date('last_restock_date')->nullable();
            $table->string('barcode')->nullable();
            $table->text('notes')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sucursal');
    }
};
