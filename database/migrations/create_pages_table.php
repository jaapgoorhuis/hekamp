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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('route')->nullable();
            $table->string('page_type')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_robots')->nullable();
            $table->integer('is_removable')->nullable();
            $table->integer('is_vissible')->nullable();
            $table->integer('is_active')->nullable();
            $table->string('header_image')->nullable();
            $table->integer('show_header')->nullable();
            $table->integer('show_footer')->nullable();
            $table->string('header_text')->nullable();
            $table->integer('order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
