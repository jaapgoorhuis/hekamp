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
            $table->string('title_nl')->nullable();
            $table->string('title_de')->nullable();
            $table->string('title_en')->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('is_active_home')->nullable();
            $table->longText('product_text_nl')->nullable();
            $table->longText('product_text_de')->nullable();
            $table->longText('product_text_en')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('subCategory_id')->nullable();
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
