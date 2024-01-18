@extends('layouts.plan')   
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
        text-align: center;
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

  
    use App\Http\Controllers\ManagerplanController;
   
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดตัวชี้วัด</B></h3>
                <a href="{{ url('manager_plan/plan_kpiadddetail') }}"   class="btn btn-success btn" style=" font-family: 'Kanit', sans-serif;font-weight: normal;" >ย้อนกลับ</a>
               

            </div>
            <div class="block-content block-content-full">
            
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                                
                            <td  class="text-font" style="border-color:#000000;text-align: center;" rowspan="2" width="8%" >	รหัส</td>       
                            <td  class="text-font" style="border-color:#000000;text-align: center;"rowspan="2"  width="15%">ตัวชี้วัด (KPI)</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" colspan="3" >ผลย้อนหลัง</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" rowspan="2" >เป้าหมาย</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" rowspan="2" >ผลงาน	</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" colspan="5" >ค่าเป้าหมาย</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  rowspan="2">คะแนน</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" rowspan="2" >น้ำหนัก</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" rowspan="2" >ผลรวม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  rowspan="2">ผู้รับผิดชอบ</td>
           
                        </tr >
                        <tr height="40">
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #F0F8FF;" >{{$infokpi->KPI_YEAR - 3}}</td>            
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #F0F8FF;"  >{{$infokpi->KPI_YEAR - 2}}</td>       
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #F0F8FF;" >{{$infokpi->KPI_YEAR - 1}}</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #FF0000;"  >1</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #FFFFE0;"  >2</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #FFA07A;"  >3</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #90EE90;"  >4</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center; background-color: #87CEFA;"  >5</td>


                        </tr >
                    </thead>
                    <tbody>
                 
                
                
                    
                    <?php

                    $plan_kpi_person = DB::table('plan_kpi_person')
                    ->leftJoin('hrd_person','plan_kpi_person.KPI_PERSON_HR_ID','=','hrd_person.ID')
                    ->where('KPI_ID','=',$infokpi->KPI_ID)->first();


                    $countplan_kpi_person = DB::table('plan_kpi_person')->where('KPI_ID','=',$infokpi->KPI_ID)->count();
                    if($countplan_kpi_person == 0){
                        $name = '';
                    }else{
                        $name = $plan_kpi_person->HR_FNAME.' '.$plan_kpi_person->HR_LNAME;
                    }


                    $levelkpi1 = ManagerplanController::levelkpi($infokpi->KPI_ID,1);
                    $levelkpi2 = ManagerplanController::levelkpi($infokpi->KPI_ID,2);
                    $levelkpi3 = ManagerplanController::levelkpi($infokpi->KPI_ID,3);
                    $levelkpi4 = ManagerplanController::levelkpi($infokpi->KPI_ID,4);
                    $levelkpi5 =  ManagerplanController::levelkpi($infokpi->KPI_ID,5);
                    ?>

                        <tr height="20">
                              
                                <td class="text-font text-pedding" >{{$infokpi->KPI_CODE}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->KPI_NAME}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->REYEAR_3,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->REYEAR_2,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->REYEAR_1,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->KPI_GOAL,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->KPI_RESULTS,2)}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi1}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi2}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi3}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi4}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi5}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->KPI_SCORE,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->KPI_WEIGHT,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format(($infokpi->KPI_WEIGHT * $infokpi->KPI_SCORE),2)}}</td>
                                <td class="text-font text-pedding" >{{$name}}</td>
                               
                    </tbody>
                </table>
                <br>
                <br>

                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #E0FFFF;">
                        <tr height="40">
                                
                           
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >มกราคม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >กุมภาพันธ์</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >มีนาคม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >เมษายน</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >พฤษภาคม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >มิถุนายน</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;" >กรกฎาคม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  >สิงหาคม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  >กันยายน</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  >ตุลาคม</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  >พฤศจิกายน</td>
                            <td  class="text-font" style="border-color:#000000;text-align: center;"  >ธันวาคม</td>
           
                        </tr >
               
                    </thead>
                    <tbody>

                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M1,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M2,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M3,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M4,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M5,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M6,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M7,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M8,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M9,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M10,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M11,2)}}</td>
                                <td class="text-font text-pedding;text-align: center;" >{{number_format($infokpi->KPI_SCORE_M12,2)}}</td>
                              
                               
                    </tbody>
                </table>



                <br>
                <br>
                <br>
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