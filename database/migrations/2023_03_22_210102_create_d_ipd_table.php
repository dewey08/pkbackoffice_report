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
        if (!Schema::hasTable('d_ipd'))
        {
            Schema::connection('mysql')->create('d_ipd', function (Blueprint $table) {
                $table->bigIncrements('d_ipd_id');

                $table->string('HN')->nullable();// 
                $table->string('AN')->nullable();// 
                $table->string('DATEADM')->nullable();// 
                $table->string('TIMEADM')->nullable();//  
                $table->string('DATEDSC')->nullable();// 
                $table->string('TIMEDSC')->nullable();//  
                $table->string('DISCHS')->nullable();//  
                $table->string('DISCHT')->nullable(); //   
                $table->string('WARDDSC')->nullable(); //  
                $table->string('DEPT')->nullable(); // 
                $table->string('ADM_W')->nullable(); // 
                $table->string('UUC')->nullable(); // 
                $table->string('SVCTYPE')->nullable(); // 
                $table->string('d_anaconda_id')->nullable(); // 
                $table->string('user_id')->nullable(); //  
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
        Schema::dropIfExists('d_ipd');
    }
};
