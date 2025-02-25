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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('model_type')->nullable();
            $table->integer('model_id')->nullable();
            $table->longText('uuid')->nullable();
            $table->string('collection_name')->nullable();
            $table->longText('name')->nullable();
            $table->longText('file_name')->nullable();
            $table->longText('friendly_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('disk')->nullable();
            $table->string('conversions_disk')->nullable();
            $table->string('size')->nullable();
            $table->string('manipulations')->nullable();
            $table->string('custom_properties')->nullable();
            $table->string('generated_conversions')->nullable();
            $table->string('responsive_images')->nullable();
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
