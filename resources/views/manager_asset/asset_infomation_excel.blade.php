<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="INFOMATION_ASSET.xls"');//ชื่อไฟล์
?>
<style type="text/css">

table, td, th {
            border: 1px solid black;
            } 
                
</style>

<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนคุมทรัพย์สิน</B></h3>

</div>
<div class="block-content block-content-full" align="left">

    <div class="row">
            <div class="col-lg-12">
                ประเภท : {{ $repairnomalinfoasset->SUP_TYPE_NAME }}
                รหัส : {{ $repairnomalinfoasset->ARTICLE_NUM }}
                ลักษณะ/คุณสมบัติ : {{ $repairnomalinfoasset->ARTICLE_PROP }}
            </div>           
    </div> 

    <div class="row">
        <div class="col-lg-12">
            สถานที่ตั้ง/หน่วยงานที่รับผิดชอบ : {{ $repairnomalinfoasset->HR_DEPARTMENT_SUB_SUB_NAME }}
            ขื่อผู้ขาย/ผู้รับจ้าง/ผู้บริจาค : {{ $repairnomalinfoasset->VENDOR_NAME }}
          
        </div>           
</div> 
      

<div class="row">
    <div class="col-lg-12">
        ที่อยู่ : {{ $repairnomalinfoasset->VENDOR_ADDRESS }}
        โทรศัพท์ : {{ $repairnomalinfoasset->VENDOR_PHONE }}
    </div>           
</div> 
  

<div class="row">
    <div class="col-lg-12">
        ประเภทเงิน : {{ $repairnomalinfoasset->BUDGET_NAME }}
        วิธีการได้มา ...............................................
    </div>           
</div>

   

<table class="table-striped table-vcenter js-dataTable" style="width: 100%;"> 
        
    <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">ว.ด.ป.</th>   
                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">ที่เอกสาร</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">รายการ</th>    
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">จำนวน<br>หน่วย</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">ราคาต่อ/หน่วย/ชุด</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  >มูลค่ารวม</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%"> อายุการใช้งาน</th> 
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">อัตราค่าเสื่อมราคา</th> 
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">ค่าเสื่อมราคาประจำปี</th> 
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">ค่าเสื่อมราคาสะสม</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">มูลค่าสุทธิ</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">หมายเหตุ</th>
                    </tr>
                </thead>
        <tr>

            <td class="text-font text-pedding" >{{Datethai($repairnomalinfoasset->RECEIVE_DATE)}}</td>
            <td class="text-font text-pedding" ></td>
            <td class="text-font text-pedding" >{{$repairnomalinfoasset->ARTICLE_NAME}}</td>
            <td class="text-font text-pedding" >1</td>
            <td class="text-font text-pedding" >{{$repairnomalinfoasset->PRICE_PER_UNIT}}</td>
            <td class="text-font text-pedding" >{{$repairnomalinfoasset->PRICE_PER_UNIT}}</td>
            <td class="text-font text-pedding" >{{$ageassetyears}}</td>
            <td class="text-font text-pedding" ></td>
            <td class="text-font text-pedding" ></td>
            <td class="text-font text-pedding" ></td>
            <td class="text-font text-pedding" ></td>
            <td class="text-font text-pedding" ></td>

        </tr>


</table>

<br><br>

<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประวัติการซ่อมบำรุงรักษาทรัพย์สิน</B></h3>
<br>
<table class="table-striped table-vcenter js-dataTable" style="width: 100%;"> 
        
    <thead style="background-color: #FFEBCD;">
        <tr height="40">
                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">ครั้งที่</th>
                       
                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">ว.ด.ป.</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">รายการ</th>    
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">จำนวนเงิน</th>
                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">หมายเหตุ</th>

                </thead>
        <tr>
            <?php $number =1; ?>
            @foreach ($infohisrepairs as $infohisrepair)      
            <td class="text-font text-pedding">{{$number}}</td>
            <td class="text-font text-pedding">{{DateThai($infohisrepair->TECH_RECEIVE_DATE)}}</td>
            <td class="text-font text-pedding">{{$infohisrepair->SYMPTOM}}</td>
            <td class="text-font text-pedding"></td>
            <td class="text-font text-pedding"></td>
            
            <? $number++; ?>
            @endforeach  

        </tr>


</table>
