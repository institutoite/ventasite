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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            
            $table->unsignedBigInteger('category_id');
            $table->foreign("category_id")->references("id")->on("categories");
            
            $table->unsignedBigInteger('marca_id');
            $table->foreign("marca_id")->references("id")->on("marcas");

            
            $table->unsignedBigInteger('supplier_id');
            $table->foreign("supplier_id")->references("id")->on("suppliers");
            
            $table->string('product_code')->nullable();
            $table->string('product_garage')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('product_store')->nullable();
            $table->date('buying_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->decimal('buying_price')->nullable();
            $table->decimal('selling_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
