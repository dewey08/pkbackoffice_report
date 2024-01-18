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
        if (!Schema::hasTable('d_idx'))
        {
            Schema::connection('mysql')->create('d_idx', function (Blueprint $table) {
                $table->bigIncrements('d_idx_id'); 
                $table->string('AN')->nullable();// 
                $table->string('DIAG')->nullable();// 
                $table->string('DXTYPE')->nullable();//                   
                $table->string('DRDX')->nullable();//   
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
        Schema::dropIfExists('d_idx');
    }
};
