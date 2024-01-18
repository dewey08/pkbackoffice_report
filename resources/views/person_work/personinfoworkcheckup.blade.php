@extends('layouts.backend')

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

      .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
                  }
      }

</style>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;

            }
            .form-control {
            font-family: 'Kanit', sans-serif;
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
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  use App\Http\Controllers\AbilityController;
?>


                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforperson -> HR_PREFIX_NAME }}   {{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <div class="row">

                                <div>
                                                <a href="{{ url('person_work/carcalendarhealth/'.$inforpersonid -> ID)}}"  class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ปฎิทิน</a>
                                        </div>
                                        <div>&nbsp;</div>
                                     
                                        <div>
                                        <a href="{{ url('person_work/personworkscreening/checkup/'.$inforpersonid -> ID)}}" class="btn btn-primary loadscreen" >ตรวจสุขภาพประจําปี</a>
                                        
                                        </div>
                                        <div>&nbsp;</div>
                               
                             
                              
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสุขภาพประจำปี</B></h3>
                            <a href="{{ url('person_work/personworkscreening/screen_add/'.$inforpersonid -> ID)}}" class="btn btn-hero-sm btn-hero-info"   ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                        </div>
                        <div class="block-content block-content-full">

                    
                        <div class="table-responsive">      
                
                        <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
                  
                     
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ปี</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">วันที่คัดกรอง</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">อายุ</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">สถานะ</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">BMI</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ครอบครัว</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">การเจ็บป่วย</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">สูบบุรี่</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ดื่มสุรา</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ออกกำลังกาย</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">อาหาร</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">การขับขี่</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">เพศสัมพันธ์</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">วันที่นัด</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">เวลานัด</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">วันที่ตรวจ</th>


                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;" width="8%">คำสั่ง</th>
        
        
                    </tr>
                   </tr>
                   </thead>
                   <tbody>
                   
                   @foreach ($infoscreens as $infoscreen)  

                   <tr height="20">
                     <td class="text-font text-pedding">{{$infoscreen->HEALTH_SCREEN_YEAR}}</td> 
                     <td class="text-font text-pedding">{{DateThai($infoscreen->HEALTH_SCREEN_DATE)}}</td> 
                     <td class="text-font text-pedding">{{$infoscreen->HEALTH_SCREEN_AGE}}</td> 
                 
                     <td align="center" >
                     @if($infoscreen->HEALTH_SCREEN_STATUS == 'SUCCESS')
                     <span class="badge badge-success" >ตรวจแล้ว</span>       
                    @elseif($infoscreen->HEALTH_SCREEN_STATUS == 'CONFIRM')
                    <span class="badge badge-info" >ยืนยันการตรวจ</span>
                    @else
                    <span class="badge badge-warning" >คัดกรอง</span>
                     @endif
                     
                     </td>
                     

                     <td class="text-font text-pedding">{{AbilityController::checkbmi($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkfamily($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkillness($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checksmok($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkdrink($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkex($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checklike($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checkcar($infoscreen->HEALTH_SCREEN_ID)}}</td> 
                     <td class="text-font text-pedding">{{AbilityController::checksex($infoscreen->HEALTH_SCREEN_ID)}}</td> 

                     <td class="text-font text-pedding">
                     @if($infoscreen->HEALTH_SCREEN_CON_DATE != '' && $infoscreen->HEALTH_SCREEN_CON_DATE != null)
                     {{DateThai($infoscreen->HEALTH_SCREEN_CON_DATE)}}
    
                     @endif
                   
                     
                     </td> 

                     <td class="text-font text-pedding">{{$infoscreen->HEALTH_SCREEN_CON_TIME}}</td> 
                     <td class="text-font text-pedding">
                     
                    
                     @if($infoscreen->HEALTH_BODY_DATE != '' && $infoscreen->HEALTH_BODY_DATE != null)
                     {{DateThai($infoscreen->HEALTH_BODY_DATE)}}
    
                     @endif
                     </td> 

                      
                     <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="{{ url('person_work/personworkscreening/screen/'.$infoscreen->HEALTH_SCREEN_ID.'/'.$inforpersonid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>   
                                                @if($infoscreen->HEALTH_SCREEN_STATUS == 'CONFIRM' || $infoscreen->HEALTH_SCREEN_STATUS == 'SUCCESS')
                                                <a class="dropdown-item"  href="{{ url('person_work/healthpdf/'.$infoscreen->HEALTH_SCREEN_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >พิมพ์เอกสาร</a>
                                                @endif
                                                </div>
                                            </div>
                                </td>     
                    
                   </tr> 
                   @endforeach   
                   </tbody>
                  </table>
 



                  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <div class="modal-header">
                                        
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มปีงบข้อมูลการตรวจสุขภาพประจำปี</h2>
                                        </div>
                                        <div class="modal-body">
                                        <body>
                                        <form  method="post" action="{{ route('health.mana_screen_save') }}" >
                                        @csrf

                                        <input type="hidden" name="HEALTH_SCREEN_PERSON_ID" id="HEALTH_SCREEN_PERSON_ID" value="{{$inforpersonid -> ID}}" >
                                
                                    <div class="row push">
                                    <div>&nbsp;</div>
                                    <div class="col-sm-2">
                                    <label >ปีงบประมาณ</label>
                                    </div>
                                    <div class="col-sm-8">
                                    <select name="HEALTH_SCREEN_YEAR" id="HEALTH_SCREEN_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                @foreach ($budgetyears as $budgetyear)
                                                         <option value="{{ $budgetyear->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                                @endforeach                 
                                    </select>
                                
                                    </div>
                                    </div>
                                
                                

                                    </div>
                                        <div class="modal-footer">
                                        <div align="right">
                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                                        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
                                        </div>
                                        </div>
                                        </form>  
                                </body>
                                    
                                    
                                    </div>
                                </div>
                                </div>

                                <br>                       
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
   $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
