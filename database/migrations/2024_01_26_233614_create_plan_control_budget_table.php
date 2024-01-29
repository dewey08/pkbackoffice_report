<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { 
        if (!Schema::hasTable('plan_control_budget'))
        {
            Schema::connection('mysql')->create('plan_control_budget', function (Blueprint $table) { 
                $table->bigIncrements('plan_control_budget_id');//  
                $table->string('plan_control_id')->nullable();//   
                $table->string('plan_control_activity_id')->nullable();//  
                $table->string('billno')->nullable();//  
                $table->string('plan_list_budget_id')->nullable();//รายละเอียดงบประมาณ
                $table->string('plan_list_budget_name')->nullable();//รายละเอียดงบประมาณ 
                $table->string('plan_control_budget_price')->nullable();//    จำนวนเงิน  
                $table->string('budget_source')->nullable();//     แหล่งงบประมาณ
                $table->string('budget_source_name')->nullable();//     แหล่งงบประมาณ 
                $table->string('user_id')->nullable();//         
                $table->timestamps();
            });    
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_control_budget');
    }
};
