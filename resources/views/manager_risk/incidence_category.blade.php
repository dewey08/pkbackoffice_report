@extends('layouts.risk')   
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

?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประเภทอุบัติการณ์ความเสี่ยง</B></h3>   
                <div align="right">
                    <a href="{{ url('manager_risk/detail_add')}}"  class="btn btn-sm btn-info btn-lg" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                    </div>
                </div>
            <div class="block-content block-content-full">
            <form action="#" method="post">
                @csrf
                    <div class="row">  
                        <div class="col-md-0.5">
                            &nbsp;&nbsp; วันที่ &nbsp;
                        </div>
                        <div class="col-md-2">
                            <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                        </div>
                        <div class="col-md-0.5">
                            &nbsp;ถึง &nbsp;
                                </div>
                        <div class="col-md-2">
                            <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                        </div> 
                        <div class="col-md-0.5">
                            &nbsp;สถานะ &nbsp;
                        </div>                            
                        <div class="col-md-2">
                            <span>                            
                                <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">--ทั้งหมด--</option>                            
                                </select>
                            </span>
                        </div> 
              
                        <div class="col-md-0.5">
                            &nbsp;ค้นหา &nbsp;
                        </div>
                        <div class="col-md-2">
                            <span>                 
                                <input type="search"  name="search" class="form-control"  >
                            </span>
                        </div>               
                        <div class="col-md-30">
                            &nbsp;
                        </div> 
                        <div class="col-md-1">
                            <span>
                                <button type="submit" class="btn btn-info" >ค้นหา</button>
                            </span> 
                        </div>
                    </div>  
            </form>
             <div class="table-responsive"> 

                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="20%">รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หัวข้อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่บันทึก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เอกสารประกอบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ใช้กับความเสี่ยง</th>                           
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                   
                        <tr height="20">
                        <td class="text-font" align="center">1</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td align="center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button>
                            <div class="dropdown-menu" style="width:10px">      
                                    <a class="dropdown-item"  href=""  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>                        
                                    <a class="dropdown-item"  href="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ตรวจสอบข้อมูลเพื่อยืนยัน/แก้ไข</a>  
                                    <a class="dropdown-item"  href="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ยกเลิก</a>
                                </div>
                            </div>
                        </td> 
                       
            
                        </tr>
                        
                        <tr height="20">
                        <td class="text-font" align="center">2</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td class="text-font text-pedding" >ทดสอบ</td>
                        <td align="center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button>
                            <div class="dropdown-menu" style="width:10px">      
                                    <a class="dropdown-item"  href=""  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>                        
                                    <a class="dropdown-item"  href="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ตรวจสอบข้อมูลเพื่อยืนยัน/แก้ไข</a>   
                                    <a class="dropdown-item"  href="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ยกเลิก</a>
                                </div>
                            </div>
                        </td> 

                        </tr>
                                         

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>

  
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

<script>


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection