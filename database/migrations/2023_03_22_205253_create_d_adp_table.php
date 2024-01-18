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
        if (!Schema::hasTable('d_adp'))
        {
            Schema::connection('mysql')->create('d_adp', function (Blueprint $table) {
                $table->bigIncrements('d_adp_id'); 
                $table->string('HN')->nullable();// 
                $table->string('AN')->nullable();//  
                $table->string('DATEOPD')->nullable();//  
                $table->string('TYPE')->nullable();//  
                $table->string('CODE')->nullable(); //   
                $table->string('QTY')->nullable(); // 
                $table->string('RATE')->nullable(); // 
                $table->string('SEQ')->nullable(); // 
                $table->string('CAGCODE')->nullable(); //
                $table->string('DOSE')->nullable(); //
                $table->string('CA_TYPE')->nullable(); //
                $table->string('SERIALNO')->nullable(); //
                $table->string('TOTCOPAY')->nullable(); //
                $table->string('USE_STATUS')->nullable(); //
                $table->string('TOTAL')->nullable(); //
                $table->string('QTYDAY')->nullable(); //
                $table->string('TMLTCODE')->nullable(); //
                $table->string('STATUS1')->nullable(); //
                $table->string('BI')->nullable(); //
                $table->string('CLINIC')->nullable(); //
                $table->string('ITEMSRC')->nullable(); //
                $table->string('PROVIDER')->nullable(); //
                $table->string('GLAVIDA')->nullable(); //
                $table->string('GA_WEEK')->nullable(); //
                $table->string('DCIP')->nullable(); //
                $table->string('LMP')->nullable(); // 
                $table->string('SP_ITEM')->nullable(); // 
                $table->string('icode')->nullable(); // 
                $table->date('vstdate')->nullable(); // 
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
        Schema::dropIfExists('d_adp');
    }
};
