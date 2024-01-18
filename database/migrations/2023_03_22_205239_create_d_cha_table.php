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
        if (!Schema::hasTable('d_cha'))
        {
            Schema::connection('mysql')->create('d_cha', function (Blueprint $table) {
                $table->bigIncrements('d_cha_id');

                $table->string('HN')->nullable();// 
                $table->string('AN')->nullable();// 
                $table->string('DATE')->nullable();//                  
                $table->string('CHRGITEM')->nullable();//  
                $table->string('AMOUNT')->nullable(); //   
                $table->string('PERSON_ID')->nullable(); // 
                $table->string('SEQ')->nullable(); // 
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
        Schema::dropIfExists('d_cha');
    }
};
