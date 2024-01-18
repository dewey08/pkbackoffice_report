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
        if (!Schema::hasTable('warehouse_deb_req_sub'))
        {
        Schema::create('warehouse_deb_req_sub', function (Blueprint $table) {
            $table->bigIncrements('warehouse_deb_req_sub_id');
            $table->string('warehouse_deb_req_id')->nullable();//
            $table->string('warehouse_deb_req_code')->nullable();//เลขที่บิล

            $table->string('product_id')->nullable();// 
            $table->string('product_code')->nullable();// 
            $table->string('product_name')->nullable();  //ชื่อ

            $table->string('product_type_id')->nullable(); //
            $table->string('product_type_name')->nullable(); //
            
            $table->string('product_unit_bigid')->nullable(); //หน่วยบรรจุ
            $table->string('product_unit_bigname')->nullable(); //ชื่อหน่วยบรรจุ
            
            $table->string('product_unit_subid')->nullable(); //หน่วยย่อย
            $table->string('product_unit_subname')->nullable(); //ชื่อหน่วยย่อย
            $table->string('product_unit_total')->nullable(); //ยอดรวมหน่วย

            $table->string('product_qty')->nullable();  //จำนวน
            $table->string('product_price')->nullable();  //ราคา
            $table->string('product_price_total')->nullable();  //ยอดรวมราคา
            $table->string('product_lot')->nullable();  //lot

            $table->date('warehouse_deb_req_sub_exedate')->nullable();//วันที่ผลิต     
            $table->date('warehouse_deb_req_sub_expdate')->nullable();//วันที่หมดอายุ 

            $table->string('warehouse_deb_req_sub_status')->nullable();  //สถานะ  
            $table->string('warehouse_deb_req_sub_total')->nullable();  //Totl  
           
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
        Schema::dropIfExists('warehouse_deb_req_sub');
    }
};
