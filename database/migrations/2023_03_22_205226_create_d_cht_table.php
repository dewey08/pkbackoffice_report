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
        if (!Schema::hasTable('d_cht'))
        {
            Schema::connection('mysql')->create('d_cht', function (Blueprint $table) {
                $table->bigIncrements('d_cht_id');

                $table->string('HN')->nullable();// 
                $table->string('AN')->nullable();// 
                $table->string('DATE')->nullable();//                  
                $table->string('TOTAL')->nullable();//  
                $table->string('PAID')->nullable(); //             
                $table->string('PTTYPE')->nullable(); //   
                $table->string('PERSON_ID')->nullable(); // 
                $table->string('SEQ')->nullable(); // 
                $table->text('OPD_MEMO',500)->nullable(); // 
                $table->text('INVOICE_NO',50)->nullable(); // 
                $table->text('INVOICE_LT',50)->nullable(); // 
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
        Schema::dropIfExists('d_cht');
    }
};
