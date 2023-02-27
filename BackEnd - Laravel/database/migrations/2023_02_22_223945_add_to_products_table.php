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
        Schema::table('products', function (Blueprint $table) {
            
            $table->after('descripcion',function($table){

                $table->unsignedBigInteger('gender_id');        
                $table->foreign('gender_id')
                        ->references('id')
                        ->on('genders')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
                        
                $table->unsignedBigInteger('categorie_id');        
                $table->foreign('categorie_id')
                        ->references('id')
                        ->on('categories')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
                        
                $table->unsignedBigInteger('discount_id');        
                $table->foreign('discount_id')
                        ->references('id')
                        ->on('discounts')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');    
                        
                $table->unsignedBigInteger('proveedor_id');        
                $table->foreign('proveedor_id')
                        ->references('id')
                        ->on('proveedores')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');          
                                
                        

            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
