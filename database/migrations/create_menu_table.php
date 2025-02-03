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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('title_nl')->nullable();
            $table->string('title_de')->nullable();
            $table->string('title_en')->nullable();
            $table->integer('page_id');
            $table->integer('order_id');
            $table->integer('parent_id');
            $table->integer('is_dropdown_parent');
            $table->integer('show_footer');
            $table->integer('show_menu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
