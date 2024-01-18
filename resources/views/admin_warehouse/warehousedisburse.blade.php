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
    use App\Http\Controllers\MeetingController;
    $checkver = MeetingController::checkver($user_id);
    $countver = MeetingController::countver($user_id);
?>         
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการขอเบิกวัสดุ</B></h3>
             
             
            </div>
            <div class="block-content ">
         
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">เหตุผลขอเบิก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="7%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                   
                        <tr height="20">
                        <td class="text-font" align="center">1</td>
                        <td class="text-font text-pedding" >ร้องขอ</td>
                        <td class="text-font text-pedding" >RQ-6301090001</td>
                        <td class="text-font text-pedding" >12 ม.ค. 2563</td>
                        <td class="text-font text-pedding" >14.00</td>
                        <td class="text-font text-pedding" >ให้บริการผู้ป่วย</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >รอบปกติ</td>
                        <td class="text-font text-pedding" >บริหารทั่วไป</td>
                        <td class="text-font text-pedding" >นายนเดช หล่อมาก</td>
                        <td class="text-font " align="center">

                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button> 
                                <div class="dropdown-menu" style="width:10px">
                                <a class="dropdown-item"  href=""  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
                                <a class="dropdown-item"  href="{{ url('manager_warehouse/warehouseinfopayparcel')  }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จ่ายวัสดุ</a>
                                
                                </div>

                        </td>
            
                        </tr>
                        
                        <tr height="20">
                        <td class="text-font" align="center">2</td>
                        <td class="text-font text-pedding" >ร้องขอ</td>
                        <td class="text-font text-pedding" >RQ-6301090002</td>
                        <td class="text-font text-pedding" >9 ม.ค. 2563</td>
                        <td class="text-font text-pedding" >12.15</td>
                        <td class="text-font text-pedding" >วัสดุในหน่วยงานไม่ครบถ้วน</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >นอกรอบ</td>
                        <td class="text-font text-pedding" >ผู้ป่วยใน</td>
                        <td class="text-font text-pedding" >นางสมลักษ์ กันทนา</td>
                        <td class="text-font " align="center">

<button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
            ทำรายการ
        </button>
        <div class="dropdown-menu" style="width:10px">
        <a class="dropdown-item"  href=""  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
        <a class="dropdown-item"  href="{{ url('manager_warehouse/warehouseinfopayparcel')  }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จ่ายวัสดุ</a>
        
        </div>

</td>
            
                        </tr>
                        <tr height="20">
                        <td class="text-font" align="center">3</td>
                        <td class="text-font text-pedding" >เรียบร้อย</td>
                        <td class="text-font text-pedding" >RQ-6301090003</td>
                        <td class="text-font text-pedding" >9 ม.ค. 2563</td>
                        <td class="text-font text-pedding" >09.00</td>
                        <td class="text-font text-pedding" >เพื่อให้บริการป่วย</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >รอบปกติ</td>
                        <td class="text-font text-pedding" >อุบัติเหตุฉุกเฉิน</td>
                        <td class="text-font text-pedding" >นายสมใจ สมจิตร</td>
                        <td class="text-font " align="center">

<button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
            ทำรายการ
        </button>
        <div class="dropdown-menu" style="width:10px">
        <a class="dropdown-item"  href=""  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
        <a class="dropdown-item"  href="#"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จ่ายวัสดุ</a>
        
        </div>

</td>
            
                        </tr>
                        <tr height="20">
                        <td class="text-font" align="center">3</td>
                        <td class="text-font text-pedding" >เรียบร้อย</td>
                        <td class="text-font text-pedding" >RQ-6301090004</td>
                        <td class="text-font text-pedding" >9 ม.ค. 2563</td>
                        <td class="text-font text-pedding" >08.45</td>
                        <td class="text-font text-pedding" >ต้องการวัสดุในหน่วยงานเพิ่มเติม</td>
                        <td class="text-font text-pedding" >คลังพัสดุ</td>
                        <td class="text-font text-pedding" >รอบปกติ</td>
                        <td class="text-font text-pedding" >บริหารทั่วไป</td>
                        <td class="text-font text-pedding" >นายนเดช หล่อมาก</td>
                        <td class="text-font " align="center">

<button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
            ทำรายการ
        </button>
        <div class="dropdown-menu" style="width:10px">
        <a class="dropdown-item"  href=""  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
        <a class="dropdown-item"  href="{{ url('manager_warehouse/warehouseinfopayparcel')  }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จ่ายวัสดุ</a>
        
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

datepick();
   function datepick() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                todayHighlight: true,
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    };
</script>

@endsection