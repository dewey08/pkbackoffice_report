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
        if (!Schema::hasTable('d_fdh_opd'))
        {
            Schema::connection('mysql')->create('d_fdh_opd', function (Blueprint $table) { 
                $table->bigIncrements('d_fdh_opd_id');//  
                $table->string('vn')->nullable();//    
                $table->string('hn')->nullable();//  
                $table->string('cid')->nullable();//  
                $table->string('ptname')->nullable();//  
                $table->string('pttype')->nullable();// 
                $table->date('vstdate')->nullable();//  
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
        Schema::dropIfExists('d_fdh_opd');
    }
};
