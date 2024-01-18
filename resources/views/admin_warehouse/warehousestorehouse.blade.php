@extends('layouts.warehouse')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@section('content')

<style>
    .center {
    margin: auto;
    width: 100%;
    padding: 10px;
    }
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
    }    

  
</style>

<script>
    function checklogin(){
    window.location.href = '{{route("index")}}'; 
    }
</script>
<?php
    if(Auth::check()){
        $status = Auth::user()->status;
        $id_user = Auth::user()->PERSON_ID;   
    }else{
        
        echo "<body onload=\"checklogin()\"></body>";
        exit();
    } 
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

    if($status=='USER' and $user_id != $id_user  ){
        echo "You do not have access to data.";
        exit();
    }

?>        
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
               <div class="row">
                <div class="col-sm-7">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>Stock card :: คลังหลัก</B></h3>
                </div>
                <div class="col-sm-5">
                <select name="" id="" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                            <option value="" >-เลือกคลัง-</option>                       
                            <option value="" selected>คลังพัสดุ</option>
                            <option value="">คลังยา</option>                  
                                          
                    </select> 
                </div>

               
                </div>

            </div>
            <div class="block-content ">
             
              
            <div class="col-lg-12" style="height:50%;">


 
                            <!-- Block Tabs Default Style -->
                          

             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัสวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >มูลค่าคงคลัง</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">เรียกดู</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                   
                        <tr height="20">
                        <td class="text-font" align="center">1</td>
                        <td class="text-font text-pedding" >5523-5231</td>
                        <td class="text-font text-pedding" >ปากกาลูกลื่น</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >แท่ง</td>
                        <td class="text-font text-pedding" >100</td>
                        <td class="text-font text-pedding" >50</td>
                        <td class="text-font text-pedding" >50</td>
                        <td class="text-font text-pedding" >500.0000</td>
                        <td class="text-font text-pedding"><button style="font-size: 10px;background-color: #4CAF50; color: #FFFFFF;">เรียกดู</button></td>
                        </tr>
                        
                        <tr height="20">
                        <td class="text-font" align="center">2</td>
                        <td class="text-font text-pedding" >5523-51254</td>
                        <td class="text-font text-pedding" >กระดาษ A4</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >รีม</td>
                        <td class="text-font text-pedding" >100</td>
                        <td class="text-font text-pedding" >20</td>
                        <td class="text-font text-pedding" >80</td>
                        <td class="text-font text-pedding" >15000.00000</td>
                        <td class="text-font text-pedding"><button style="font-size: 10px;background-color: #4CAF50;color: #FFFFFF;">เรียกดู</button></td>
                        </tr>
                        <tr height="20">
                        <td class="text-font" align="center">3</td>
                        <td class="text-font text-pedding" >5523-52452</td>
                        <td class="text-font text-pedding" >ดินสอ 2B</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >แท่ง</td>
                        <td class="text-font text-pedding" >100</td>
                        <td class="text-font text-pedding" >55</td>
                        <td class="text-font text-pedding" >45</td>
                        <td class="text-font text-pedding" >2500.00000</td>
                        <td class="text-font text-pedding"><button style="font-size: 10px;background-color: #4CAF50;color: #FFFFFF;">เรียกดู</button></td>
                        </tr>
                        <tr height="20">
                      
                  

                    </tbody>
                </table>
               
                </div>
                
                        <dic class="row" style="height:50%;">
                        <div class="col-lg-12">

                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการรับเข้าพัสดุ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">รายการเบิกจ่ายวัสดุ</a>
                                    </li>


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                    <div class="row push" style="text-align: left;">
                                    <div class="col-sm-3">
                                    <label>รายการรับเข้าพัสดุ :: ปากกาลูกลื่น </label>
                                    </div> 
                                         <div class="col-sm-1">
                                                <label>วันที่รับ :</label>
                                         </div> 
                                         <div class="col-sm-2">        
                                             <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                                        </div>
                                        <div class="col-sm-1">
                                                <label>ถึง</label>
                                         </div> 
                                         <div class="col-sm-2">        
                                             <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                                        </div>
                                        <div class="col-sm-1">
                                        <button type="submit"  class="btn btn-info btn-sm" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">ค้นหา</button> 
                                         </div>
                
                                    </div>
                                    
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #F0F8FF;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >วันที่รับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ล็อต</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รับเข้า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จ่ายออก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จำนวนคงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ราคาต่อหน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >Exp</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รับจาก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ผู้รับ</th>
                        </tr >
                    </thead>
                    <tbody>
                    <tr height="20">
                        <td class="text-font" align="center">1</td>
                        <td class="text-font text-pedding" >9 ม.ค. 2563</td>
                        <td class="text-font text-pedding" >อื่นๆ</td>
                        <td class="text-font text-pedding" >ปากกาลูกลื่น</td>
                        <td class="text-font text-pedding" >ล็อต1</td>
                        <td class="text-font text-pedding" >30</td>
                        <td class="text-font text-pedding" >10</td>
                        <td class="text-font text-pedding" >20</td>
                        <td class="text-font text-pedding" >แท่ง</td>
                        <td class="text-font text-pedding" >20.00000</td>
                        <td class="text-font text-pedding" >300.0000</td>
                        <td class="text-font text-pedding" >5 ม.ค. 2564</td>
                        <td class="text-font text-pedding" >บ.เครื่องเขียน</td>
                        <td class="text-font text-pedding" >คลังบริหาร</td>
                        </tr>
                        <tr height="20">
                        <td class="text-font" align="center">2</td>
                        <td class="text-font text-pedding" >10 ม.ค. 2563</td>
                        <td class="text-font text-pedding" >จัดซื้อ</td>
                        <td class="text-font text-pedding" >ปากกาลูกลื่น</td>
                        <td class="text-font text-pedding" >ล็อต2</td>
                        <td class="text-font text-pedding" >20</td>
                        <td class="text-font text-pedding" >10</td>
                        <td class="text-font text-pedding" >10</td>
                        <td class="text-font text-pedding" >แท่ง</td>
                        <td class="text-font text-pedding" >20.00000</td>
                        <td class="text-font text-pedding" >200.0000</td>
                        <td class="text-font text-pedding" >15 ม.ค. 2564</td>
                        <td class="text-font text-pedding" >บ. กอไก่</td>
                        <td class="text-font text-pedding" >คลังอุบัติเหตุฉุกเฉิน</td>
                        </tr>
                    
            
                     
                  

                    </tbody>
                </table>
                <br>




                                    </div>

                                    <div class="tab-pane" id="object2" role="tabpanel">

                                    <div class="row push" style="text-align: left;">
                                    <div class="col-sm-3">
                                    <label>รายการเบิกจ่ายวัสดุ :: ปากกาลูกลื่น </label>
                                    </div> 
                                         <div class="col-sm-1">
                                                <label>วันที่จ่าย :</label>
                                         </div> 
                                         <div class="col-sm-2">        
                                             <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                                        </div>
                                        <div class="col-sm-1">
                                                <label>ถึง</label>
                                         </div> 
                                         <div class="col-sm-2">        
                                             <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;font-size: 10px;" readonly>
                                        </div>
                                        <div class="col-sm-1">
                                        <button type="submit"  class="btn btn-info btn-sm" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">ค้นหา</button> 
                                         </div>
                
                                    </div>

                                
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFF8DC;">
                      
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัสจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ล็อต</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จ่ายออก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ราคาต่อหน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >Exp</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ผู้รับ</th>
                     
                        </tr >
                    </thead>
                    <tbody>
                   
                    <tr height="20">
                        <td class="text-font" align="center">1</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" >ปกติ</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                
                        </tr>

                        <tr height="20">
                        <td class="text-font" align="center">2</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" >ฉุกเฉิน</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" ></td>
                     
                        </tr>
            
                     
                  

                    </tbody>
                </table>
                <br>





                                    </div>

                                    </div>


               
             

  
@endsection

@section('footer')
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
    </script>
@endsection