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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->boolean('visibility')->default(true);
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order_column')->nullable();

            $table->foreignId('parent_id')->nullable()->constrained('labels')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
