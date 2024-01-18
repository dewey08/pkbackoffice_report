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
        if (!Schema::hasTable('d_aer'))
        {
            Schema::connection('mysql')->create('d_aer', function (Blueprint $table) {
                $table->bigIncrements('d_aer_id');
                $table->string('HN')->nullable();//  
                $table->string('AN')->nullable();//  
                $table->string('DATEOPD')->nullable();// 
                $table->string('AUTHAE')->nullable();//  
                $table->string('AEDATE')->nullable();// 
                $table->string('AETIME')->nullable();//  
                $table->string('AETYPE')->nullable(); //  
                $table->string('REFER_NO')->nullable(); // 
                $table->string('REFMAINI')->nullable(); // 
                $table->string('IREFTYPE')->nullable(); // 
                $table->string('REFMAINO')->nullable(); // 
                $table->string('OREFTYPE')->nullable(); // 
                $table->string('UCAE')->nullable(); // 
                $table->string('EMTYPE')->nullable(); // 
                $table->string('SEQ')->nullable(); // 
                $table->string('AESTATUS')->nullable(); // 
                $table->string('DALERT')->nullable(); // 
                $table->string('TALERT')->nullable(); //  
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
        Schema::dropIfExists('d_aer');
    }
};
