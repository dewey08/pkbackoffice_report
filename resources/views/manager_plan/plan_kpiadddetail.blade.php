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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
                <div class="row"> 
                    <div class="col-md-2">
                        รายการตัวชี้วัดยุทธศาสตร์
                    </div>  
                    <div class="col-md-2">
                        <form action="{{ route('mplan.plan_kpiadddetail_search') }}" method="post">
                            @csrf
                    <select  name="RESULT_YEAR" id="RESULT_YEAR" style="font-family: 'Kanit', sans-serif;" class="form-control" id="exampleFormControlSelect1">
                        @foreach ($infobudgetyears as $infobudgetyear)
                            @if($planyear_use== $infobudgetyear->LEAVE_YEAR_ID)
                                <option value="{{$infobudgetyear->LEAVE_YEAR_ID}}" selected>{{$infobudgetyear->LEAVE_YEAR_NAME}}</option>
                            @else
                                <option value="{{$infobudgetyear->LEAVE_YEAR_ID}}">{{$infobudgetyear->LEAVE_YEAR_NAME}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">แสดง</button>
                    </div>
                </div>
                </B></h3>

            </div>
            <div class="block-content block-content-full">
            
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="text-align: center;" rowspan="2" width="5%">ลำดับ</th>            
                            <th  class="text-font" style="text-align: center;" rowspan="2" width="8%" >	รหัส</th>       
                            <th  class="text-font" style="text-align: center;"rowspan="2"  width="15%">ตัวชี้วัด (KPI)</th>
                            <th  class="text-font" style="text-align: center;" colspan="3" >ผลย้อนหลัง</th>
                            <th  class="text-font" style="text-align: center;" rowspan="2" >เป้าหมาย</th>
                            <th  class="text-font" style="text-align: center;" rowspan="2" >ผลงาน	</th>
                            <th  class="text-font" style="text-align: center;" colspan="5" >ค่าเป้าหมาย</th>
                            <th  class="text-font" style="text-align: center;"  rowspan="2">คะแนน</th>
                            <th  class="text-font" style="text-align: center;" rowspan="2" >น้ำหนัก</th>
                            <th  class="text-font" style="text-align: center;" rowspan="2" >ผลรวม</th>
                            <th  class="text-font" style="text-align: center;"  rowspan="2">ผู้รับผิดชอบ</th>
                        @if($planyear_use == $planyear_check)
                            <th  class="text-font" style="text-align: center;" rowspan="2" width="8%">เปิดใช้</th>
                            <th  class="text-font" style="text-align: center"rowspan="2"  width="7%">คำสั่ง</th> 
                        @endif
                        </tr >
                        <tr height="40">
                            <th  class="text-font" style="text-align: center; background-color: #F0F8FF;" >{{$planyear->PLAN_YEAR-3}}</th>            
                            <th  class="text-font" style="text-align: center; background-color: #F0F8FF;"  >{{$planyear->PLAN_YEAR-2}}</th>       
                            <th  class="text-font" style="text-align: center; background-color: #F0F8FF;" >{{$planyear->PLAN_YEAR-1}}</th>
                            <th  class="text-font" style="text-align: center; background-color: #FF0000;"  >1</th>
                            <th  class="text-font" style="text-align: center; background-color: #FFFFE0;"  >2</th>
                            <th  class="text-font" style="text-align: center; background-color: #FFA07A;"  >3</th>
                            <th  class="text-font" style="text-align: center; background-color: #90EE90;"  >4</th>
                            <th  class="text-font" style="text-align: center; background-color: #87CEFA;"  >5</th>
                        </tr >
                    </thead>
                    <tbody>
                    @foreach ($infotargets as $infotarget)
                    <tr height="20">
                    <td class="text-font text-pedding" colspan="19" style="background-color: #FFF8DC;" >{{$infotarget->TARGET_NAME}}</td>
                    </tr>
                    
                    <?php 

                    $infokpis = DB::table('plan_kpi')->where('TARGET_ID','=',$infotarget->TARGET_ID)
                    ->where('plan_kpi.KPI_YEAR','=', $planyear_use)
                    ->get();                   
                    $number = 0; 
                          
                    ?>
                                @foreach ($infokpis as $infokpi)
                    <?php $number++; 
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
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->KPI_CODE}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->KPI_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->REYEAR_3}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->REYEAR_2}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->REYEAR_1}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->KPI_GOAL}}</td>
                                <td class="text-font text-pedding" >{{$infokpi->KPI_RESULTS}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi1}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi2}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi3}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi4}}</td>
                                <td class="text-font text-pedding" >{{$levelkpi5}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->KPI_SCORE,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format($infokpi->KPI_WEIGHT,2)}}</td>
                                <td class="text-font text-pedding" >{{number_format(($infokpi->KPI_WEIGHT * $infokpi->KPI_SCORE),2)}}</td>
                                <td class="text-font text-pedding" >{{$name}}</td>
                            
                                @if($planyear_use == $planyear_check)
                                <td align="center" width="5%">
                                            <div class="custom-control custom-switch custom-control-lg ">
                                                 <input type="checkbox" class="custom-control-input" id="" name="" onchange="switchactive();" checked>                                   
                                                <label class="custom-control-label" for=""></label>
                                            </div>
                                </td>
                             
                                <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="{{ url('manager_plan/plan_kpiupdatedetail/'.$infokpi->KPI_ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >เพิ่มรายละเอียดตัวชี้วัด</a>   
                                                <a class="dropdown-item"  href="{{ url('manager_plan/plan_kpidetailfull/'.$infokpi->KPI_ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดตัวชี้วัด</a>  
                                                </div>
                                            </div>
                                </td> 
                                @endif    
                        </tr>

                        @endforeach                        
                   
                @endforeach
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