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
        if (!Schema::hasTable('claim_sixteen_cht'))
        {
            Schema::create('claim_sixteen_cht', function (Blueprint $table) {
                $table->bigIncrements('claim_sixteen_cht_id');

                $table->string('HN')->nullable();// 
                $table->string('AN')->nullable();// 
                $table->date('DATE')->nullable();// 
                 
                $table->string('TOTAL')->nullable();//  
                $table->string('PAID')->nullable(); //             
                $table->string('PTTYPE')->nullable(); //   
                $table->string('PERSON_ID')->nullable(); // 
                $table->string('SEQ')->nullable(); // 
                 
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
        Schema::dropIfExists('claim_sixteen_cht');
    }
};
