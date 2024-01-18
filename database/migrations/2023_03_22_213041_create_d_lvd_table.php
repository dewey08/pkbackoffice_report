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
        if (!Schema::hasTable('d_lvd'))
        {
            Schema::connection('mysql')->create('d_lvd', function (Blueprint $table) {
                $table->bigIncrements('d_lvd_id');
                $table->string('SEQLVD')->nullable();//  
                $table->string('AN')->nullable();//  
                $table->date('DATEOUT')->nullable();// 
                $table->string('TIMEOUT')->nullable();// 
                $table->date('DATEIN')->nullable();//  
                $table->string('TIMEIN')->nullable();//  
                $table->string('QTYDAY')->nullable();//  
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
        Schema::dropIfExists('d_lvd');
    }
};
