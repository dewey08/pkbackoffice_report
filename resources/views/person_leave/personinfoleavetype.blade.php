@extends('layouts.backend')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
.modal {
  text-align: center;

}

.modal-content  {
    -webkit-border-radius: 10px !important;
    -moz-border-radius: 10px !important;
    border-radius: 10px !important;
}
.modal-body  {
    -webkit-border-radius: 10px !important;
    -moz-border-radius: 10px !important;
    border-radius: 10px !important;
}
.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
  border-radius: 20px;
}


</style>

@section('content')
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

use App\Http\Controllers\LeaveController;
$sexuser = LeaveController::checksex($user_id);
$duration = LeaveController::checkduration($user_id);
//echo $duration;




$checkapp = LeaveController::checkapp($user_id);
$checkver = LeaveController::checkver($user_id);
$checkallow = LeaveController::checkallow($user_id);
$dis = 0;


$callleavemont = LeaveController::callleavemonth($user_id);

$countapp = LeaveController::countapp($user_id);
$countver = LeaveController::countver($user_id);
$countallow = LeaveController::countallow($user_id);

?>
<?php
  function leavemonthThai()
{
    $strDate =date("Y-m-d");
    $strMonth= date("n",strtotime($strDate));
  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strMonthThai";
  }


?>
   @if($callleavemont>0)
     <body onload="test()">
   @endif
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                        <div>
                                                <a href="{{ url('person_leave/personleaveindex/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                                 
                                                    <span class="nav-main-link-name"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</span>
                                                </a>
                                            </div>
                                        <div>&nbsp;</div>
                                        <div>
                                            <a href="{{ url('person_leave/personleavecalendar/'.$inforpersonuserid -> ID)}}"
                                                class="btn btn-hero-sm btn-hero loadscreen"
                                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                                    class="fas fa-calendar-day mr-2"></i> ปฏิทิน</a>
                                        </div>
                                        <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('person_leave/personleavetype/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero-info loadscreen" ><i class="fas fa-plus mr-1"></i> เพิ่มข้อมูลการลา</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_leave/personleaveinfo/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-calendar-day mr-2"></i>ข้อมูลการลา</a>
                                </div>
                                <div>&nbsp;</div>

                                @if($checkapp != 0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfoapp/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-clipboard-check mr-2"></i>เห็นชอบ
                                @if($countapp!=0)
                                    <span class="badge badge-light" >{{$countapp}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkver != 0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfover/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-clipboard-check mr-2"></i>ตรวจสอบ
                                @if($countver!=0)
                                    <span class="badge badge-light" >{{$countver}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkallow!=0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfolastapp/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-clipboard-check mr-2"></i>อนุมัติ
                                @if($countallow!=0)
                                    <span class="badge badge-light" >{{$countallow}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                
                                <div>
                                    <a href="{{ url('person_leave/personleaveinfoaccept/'.$inforpersonuserid -> ID)}}"
                                        class="btn btn-hero-sm btn-hero loadscreen"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                            class="fas fa-clipboard-check mr-2"></i>รับมอบงาน
                                     
                                    </a>
                                </div>
                                <div>&nbsp;</div>

                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="row gutters-tiny">
                <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/sick/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-user-injured text-primary"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาป่วย</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/work/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa-envelope-open text-xmodern"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลากิจ</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @if($duration > 180 && $checkdat_setup == 0 )
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-coffee text-danger"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาพักผ่อน</div>
                                        <div class="font-w600 mt-3 text-uppercase" style=" color: red;">*กรุณาตั้งค่าวันลา</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @elseif($duration > 180 && $checkdat_setup > 0 )
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/rest/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-coffee text-danger"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาพักผ่อน</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/train/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-graduation-cap text-xsmooth"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาศึกษา ฝึกอบรม</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @if($dis != 0 )
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/abroad/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-plane-departure text-xmodern"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาทำงานต่างประเทศ</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/restore/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-pencil-ruler text-warning"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาฟื้นฟูอาชีพ</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                       @if($sexuser=="M")
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/military/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-users text-primary"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาเกณฑ์ทหาร</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/religion/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-bookmark text-warning"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาอุปสมบท<br>ประกอบพิธีฮัจญ์</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/helpspawn/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-baby-carriage text-xeco"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาช่วยภริยาคลอด</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        @if($sexuser=="F")
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/spawn/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-baby text-xsmooth"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาคลอดบุตร</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/mate/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-transgender text-danger"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาติดตามคู่สมรส</div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/resign/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-share text-xeco"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาออก</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 col-xl-2">
                            <a class="block block-link-shadow text-center" href="{{ url('person_leave/addpersonleavesick/sicklow/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-2x fa fa-prescription-bottle-alt text-warning"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ลาป่วย<br>ตามกฎหมายฯ</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                </div>

                </div>






<!-- The Modal -->




                                <div id="myModal" class="modal"  role="dialog">
                                         <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                         <center>
                                        <div class="modal-body" style="background-color: #FFE4E1;">
                                        <br><h2 style="font-family: 'Kanit', sans-serif; font-size: 1.5rem;font-weight:normal;">โปรดทราบ !!</h2>
                                        <h2 style="font-family: 'Kanit', sans-serif; font-size: 1.0rem;font-weight:normal;">เดือน {{ leavemonthThai()}} ท่านใช้สิทธ์การลาแล้ว {{ number_format($callleavemont) }} วัน<br>&nbsp;หากลาเพิ่ม วันทำการของท่านอาจจะไม่ถึง 15 วัน&nbsp;<br>ตามที่ราชการกำหนด</h2>



                                    <div align="center">

                                    <button onclick="myclose()" class="btn btn-hero-sm btn-hero-danger"  >ตกลง</button>
                                </div>
                                </div>

                        </div>
                    </div>
                    </div>

@endsection

@section('footer')

<script>





function test() {
    var modal = document.getElementById('myModal');
    modal.style.display = "block";
}

function myclose() {
    document.getElementById("myModal").style.display = "none";
}
</script>

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
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {

            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
