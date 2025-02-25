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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('route')->nullable();
            $table->string('title_nl')->nullable();
            $table->string('title_de')->nullable();
            $table->string('title_en')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_de')->nullable();
            $table->string('meta_title_nl')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_description_de')->nullable();
            $table->string('meta_description_nl')->nullable();
            $table->string('meta_keywords_en')->nullable();
            $table->string('meta_keywords_de')->nullable();
            $table->string('meta_keywords_nl')->nullable();
            $table->string('meta_robots')->nullable();
            $table->integer('is_removable')->nullable();
            $table->integer('is_vissible')->nullable();
            $table->integer('show_home')->nullable();
            $table->integer('is_active')->nullable();
            $table->string('header_image')->nullable();
            $table->string('subCategory_text_nl')->nullable();
            $table->string('subCategory_text_de')->nullable();
            $table->string('subCategory_text_en')->nullable();
            $table->integer('order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
