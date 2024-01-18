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
        if (!Schema::hasTable('d_lgo_801'))
        {
            Schema::connection('mysql')->create('d_lgo_801', function (Blueprint $table) { 
                $table->bigIncrements('d_lgo_801_id');//  
                $table->string('vn')->nullable();//   
                $table->string('an')->nullable();//  
                $table->string('hn')->nullable();//  
                $table->string('pttype')->nullable();// 
                $table->date('vstdate')->nullable();//  
                $table->string('price_lgo')->nullable();// 
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
        Schema::dropIfExists('d_lgo_801');
    }
};
