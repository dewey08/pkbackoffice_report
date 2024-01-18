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
        if (!Schema::hasTable('users'))
        {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('pname')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('cid')->nullable();
            $table->string('fingle')->nullable();
            $table->string('tel')->nullable();
            $table->string('username');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('type', ['ADMIN', 'STAFF', 'CUSTOMER', 'MANAGE','USER','NOTUSER'])->default('USER');
            $table->string('passapp')->nullable();
            $table->string('line_token')->nullable();
            $table->string('group_p4p')->nullable();            
            $table->string('dep_id')->nullable();
            $table->string('dep_name')->nullable();
            $table->string('dep_subid')->nullable();
            $table->string('dep_subname')->nullable();
            $table->string('dep_subsubid')->nullable();
            $table->string('dep_subsubname')->nullable();
            $table->string('dep_subsubtrueid')->nullable();
            $table->string('dep_subsubtruename')->nullable();
            $table->string('users_type_id')->nullable(); //ประเภทข้าราชการ
            $table->string('users_type_name')->nullable(); //ประเภทข้าราชการ
            $table->string('users_group_id')->nullable(); //กลุ่มบุคลากร
            $table->string('users_group_name')->nullable(); //กลุ่มบุคลากร
            $table->string('position_id')->nullable();
            $table->string('position_name')->nullable();
            $table->string('status')->nullable();
            $table->string('permiss_person')->nullable();
            $table->string('permiss_book')->nullable();
            $table->string('permiss_car')->nullable();
            $table->string('permiss_meetting')->nullable();
            $table->string('permiss_repair')->nullable();
            $table->string('permiss_com')->nullable();
            $table->string('permiss_medical')->nullable();
            $table->string('permiss_hosing')->nullable();
            $table->string('permiss_plan')->nullable();
            $table->string('permiss_asset')->nullable();
            $table->string('permiss_supplies')->nullable();
            $table->string('permiss_store')->nullable();
            $table->string('permiss_store_dug')->nullable();
            $table->string('permiss_pay')->nullable();
            $table->string('permiss_money')->nullable();
            $table->string('permiss_claim')->nullable();
            $table->string('permiss_ot')->nullable();
            $table->string('permiss_medicine')->nullable();
            $table->string('permiss_gleave')->nullable();
            $table->string('permiss_p4p')->nullable();

            $table->string('permiss_timeer')->nullable();
            $table->string('permiss_env')->nullable();
            $table->string('permiss_account')->nullable();
            $table->string('permiss_dental')->nullable();

            $table->string('permiss_setting_account')->nullable();  //การบัญชี
            $table->string('permiss_setting_upstm')->nullable();  //UP STM
            $table->string('permiss_setting_env')->nullable();
            $table->string('permiss_ucs')->nullable();
            $table->string('permiss_sss')->nullable();
            $table->string('permiss_ofc')->nullable();
            $table->string('permiss_lgo')->nullable();
            $table->string('permiss_prb')->nullable();
            $table->string('permiss_ti')->nullable();
            $table->string('permiss_setting_warehouse')->nullable(); 
            $table->string('permiss_rep_money')->nullable(); //ใบเสร็จรับเงิน

            $table->string('store_id')->nullable();
            $table->string('member_id')->nullable();
            $table->string('img')->nullable();
            $table->string('img_name')->nullable(); 
            $table->double('money', 10, 2)->nullable(); 
            $table->string('color_ot')->nullable();
            $table->string('staff')->nullable();  
            $table->string('loginname')->nullable(); 
            $table->string('passweb')->nullable(); 
            $table->rememberToken();
            $table->timestamps('created_at')->useCurrent();
            $table->timestamps('updated_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
