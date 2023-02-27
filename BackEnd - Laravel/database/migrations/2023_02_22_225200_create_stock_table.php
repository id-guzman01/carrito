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
        Schema::create('stock', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')
                    ->references('id')
                    ->on('sizes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('stock');
            $table->integer('entradas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
