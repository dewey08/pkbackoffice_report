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
        if (!Schema::hasTable('d_iop'))
        {
            Schema::connection('mysql')->create('d_iop', function (Blueprint $table) {
                $table->bigIncrements('d_iop_id'); 
                $table->string('AN')->nullable();// 
                $table->string('OPER')->nullable();// 
                $table->string('OPTYPE')->nullable(); // 
                $table->string('DROPID')->nullable(); //  
                $table->string('DATEIN')->nullable();// 
                $table->string('TIMEIN')->nullable();//  
                $table->string('DATEOUT')->nullable();// 
                $table->string('TIMEOUT')->nullable();// 
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
        Schema::dropIfExists('d_iop');
    }
};
