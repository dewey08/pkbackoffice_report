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
        if (!Schema::hasTable('d_dru'))
        {
            Schema::connection('mysql')->create('d_dru', function (Blueprint $table) {
                $table->bigIncrements('d_dru_id');
                $table->string('HCODE')->nullable();// 
                $table->string('HN')->nullable();// 
                $table->string('AN')->nullable();// 
                $table->string('CLINIC')->nullable();// 
                $table->string('PERSON_ID')->nullable();// 
                $table->string('DATE_SERV')->nullable();//                  
                $table->string('DID')->nullable();//  
                $table->string('DIDNAME')->nullable(); //   
                $table->string('AMOUNT')->nullable(); // 
                $table->string('DRUGPRIC')->nullable(); // 
                $table->string('DRUGCOST')->nullable(); //
                $table->string('DIDSTD')->nullable(); //
                $table->string('UNIT')->nullable(); //
                $table->string('UNIT_PACK')->nullable(); //
                $table->string('SEQ')->nullable(); //
                $table->string('DRUGREMARK')->nullable(); //
                $table->string('PA_NO')->nullable(); //
                $table->string('TOTCOPAY')->nullable(); //
                $table->string('USE_STATUS')->nullable(); //
                // $table->string('STATUS1')->nullable(); //
                $table->string('TOTAL')->nullable(); //
                $table->string('SIGCODE')->nullable(); //
                $table->string('SIGTEXT')->nullable(); // 
                $table->string('PROVIDER')->nullable(); // 
                $table->string('d_anaconda_id')->nullable(); // 
                $table->string('SP_ITEM')->nullable(); // 
                $table->date('vstdate')->nullable(); // 
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
        Schema::dropIfExists('d_dru');
    }
};
