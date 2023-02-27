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
        Schema::table('sales', function (Blueprint $table) {
            
            $table->after('id',function($table){

                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');

            });

            $table->after('fecha',function($table){

                $table->unsignedBigInteger('taxe_id')->nullable();
                $table->foreign('taxe_id')
                        ->references('id')
                        ->on('taxes')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');

                $table->unsignedBigInteger('state_id');        
                $table->foreign('state_id')
                        ->references('id')
                        ->on('states')
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
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
};
