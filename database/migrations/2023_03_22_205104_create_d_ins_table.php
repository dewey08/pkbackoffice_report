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
        if (!Schema::hasTable('d_ins'))
        {
            Schema::connection('mysql')->create('d_ins', function (Blueprint $table) {
                $table->bigIncrements('d_ins_id');

                $table->string('HN')->nullable();//
                $table->string('INSCL')->nullable();//
                $table->string('SUBTYPE')->nullable();//
                $table->string('CID')->nullable();//
                $table->string('DATEIN')->nullable();// 
                $table->string('DATEEXP')->nullable();// 
                $table->string('HOSPMAIN')->nullable();//  
                $table->string('HOSPSUB')->nullable(); //             
                $table->string('GOVCODE')->nullable(); //  
                $table->string('GOVNAME')->nullable(); // 
                $table->string('PERMITNO')->nullable(); // 
                $table->string('DOCNO')->nullable(); // 
                $table->string('OWNRPID')->nullable(); // 
                $table->string('OWNRNAME')->nullable(); // 
                $table->string('AN')->nullable(); // 
                $table->string('SEQ')->nullable(); // 
                $table->string('SUBINSCL')->nullable(); // 
                $table->string('RELINSCL')->nullable(); // 
                $table->string('HTYPE')->nullable(); // 
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
        Schema::dropIfExists('d_ins');
    }
};
