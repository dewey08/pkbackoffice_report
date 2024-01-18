<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        if (!Schema::hasTable('d_12004'))
        {
            Schema::connection('mysql')->create('d_12004', function (Blueprint $table) { 
                $table->bigIncrements('d_12004_id');//  
                $table->string('vn')->nullable();//   
                $table->string('an')->nullable();//  
                $table->string('hn')->nullable();//  
                $table->string('cid')->nullable();// 
                $table->string('vstdate')->nullable();// 
                $table->string('pttype')->nullable();// 
                $table->string('ptname')->nullable();// 
                $table->string('icode')->nullable();// 
                $table->string('sum_price')->nullable();//  
                $table->timestamps();
            }); 
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_12004');
    }
};
