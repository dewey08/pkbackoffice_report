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
        if (!Schema::hasTable('check_authen'))
        {
        Schema::create('check_authen', function (Blueprint $table) {
            $table->bigIncrements('check_authen_id');  
                $table->string('hcode')->nullable();// รหัสหน่วย
                $table->string('hosname')->nullable();// ชื่อหน่วย
                $table->string('cid')->nullable();// เลขบัตร
                $table->string('fullname')->nullable();// ชื่อ-สกุล
                $table->string('birthday')->nullable();// วันเกิด ปีเดือนวัน
                $table->string('homtel')->nullable();// เบอร์โทร
                $table->string('mainpttype')->nullable();// สิทธิหลัก
                $table->string('subpttype')->nullable();// สิทธิย่อย
                $table->string('repcode')->nullable();// รหัสการเข้ารับบริการ
                $table->string('claimcode')->nullable();// CLAIM CODE
                $table->string('claimtype')->nullable();// ประเภทการเข้ารับบริการ
                $table->string('servicerep')->nullable();// รหัสบริการ
                $table->string('servicename')->nullable();// ชื่อบริการ
                $table->string('hncode')->nullable();// HN CODE
                $table->string('ancode')->nullable();// AN CODE
                $table->date('vstdate')->nullable();// วันที่เข้ารับบริการ
                $table->dateTime('regdate')->nullable();// วันที่บันทึก Authen Code
                $table->string('status')->nullable();//สถานะใช้งาน
                $table->string('requestauthen')->nullable();//ช่องทางการขอ Authen Code
                $table->string('authentication')->nullable();//วิธีการพิสูจน์ตัวตน
                $table->string('staff_service')->nullable();//ผู้จับของการเข้ารับบริการ
                $table->date('date_editauthen')->nullable();//วันที่แก้ไข Authen Cod
                $table->string('name_editauthen')->nullable();//ชื่อผู้ที่แก้ใข Authen Code
                $table->string('comment')->nullable();  //หมายเหตุการยกเลิก
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
        Schema::dropIfExists('check_authen');
    }
};
