@extends('layouts.headdep')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')

<style>
.fc-content{
    cursor:pointer;
}
#calendar{
		max-width: 95%;
		margin: 0 auto;
    font-size:15px;
	}

    body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
      }

      
      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
                  .form-control {
    font-size: 13px;
                  }   
      
                  table, td, th {
            border: 1px solid black;
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

use App\Http\Controllers\LeaveController;

$checkapp = LeaveController::checkapp($user_id);
$checkver = LeaveController::checkver($user_id);
$checkallow = LeaveController::checkallow($user_id);

$countapp = LeaveController::countapp($user_id);
$countver = LeaveController::countver($user_id);
$countallow = LeaveController::countallow($user_id);

$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}




$balancerest = LeaveController::balancerest($user_id,$yearbudget);
$countsick = LeaveController::countsick($user_id,$yearbudget);
$countwork = LeaveController::countwork($user_id,$yearbudget);

?>
<!-- Advanced Tables -->
<div class="bg-body-light">
   <br> <br>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
    <div class="block-content row px-0">
        <div class="col-lg-7 mb-2">
        <div class="row">
                <div class="col-md-6">
                    <div class="dropdown dropright">
                        <button type="button" style="background:#A2D2FF;font-family: 'Kanit', sans-serif;" class=" btn dropdown-toggle" id="dropdown-dropright" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            หน่วยงาน
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-dropright" x-placement="right-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(78px, 0px, 0px);">
                        <a class="dropdown-item devleave fs-18 " href="{{route('horg.infoleave.calender')}}">ทั้งหมด</a>
                        @foreach($depinfos as $row)
                        <a class="dropdown-item pl-3 devleave" href="{{route('horg.infoleave.calender').'?depid='.$row->HR_DEPARTMENT_ID.'&depname='.$row->HR_DEPARTMENT_NAME}}">{{$row->HR_DEPARTMENT_NAME}}</a>
                        @endforeach                    
                        </div>
                    </div>
                </div>
            </div><br>
                <a class="nav-main-link{{ request()->is('person_headdep/headdep_leave_calendar') ? ' active' : '' }}" href="{{ url('person_headdep/headdep_leave') }}">
                <i class="nav-main-link-icon fa fa-table"></i>
                <span class="nav-main-link-name" style="font-size: 14px;">รายละเอียดข้อมูลการลา</span>
            </a>
            <div class="panel bg-sl-blue p-1">
                <div class="panel-header text-left px-3 py-2 text-white">
                    ปฎิทินข้อมูลการลา <span
                        class="fw-3 fs-18 text-white bg-sl-r2 px-2 radius-5">{{$depname['name']}}</span>
                </div>
                <div class="panel-body bg-white p-2 d-flex justify-content-center">
                    <div id='calendar' style="width:100%; display: inline-block;"></div>
                </div>
                <div class="panel-footer text-right bg-white pr-5 py-2">
                    <p class="m-0 fa fa-circle" style="color:#A3DCA6;"></p> <b style="color:rgb(7, 7, 7)">ลาป่วย</b>
                    <p class="m-0 fa fa-circle" style="color:#ffadea;"></p> <b style="color:rgb(7, 7, 7)">ลากิจ</b>
                    <p class="m-0 fa fa-circle" style="color:#ADD8E6;"></p> <b style="color:rgb(7, 7, 7)">ลาพักผ่อน</b>
                    <p class="m-0 fa fa-circle" style="color:#F1C54D;"></p> <b style="color:rgb(7, 7, 7)">ลาอื่น ๆ</b>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-2">
        <br><br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-info p-1 mx-0">

                <div class="card-header px-3 py-2 text-white">
                    รายงานการลาวันนี้ ( {{Datethai(date('Y-m-d'))}} )
                </div>
                <div class="card-body bg-white text-left">
                    <table class="table-bordered table-striped table-vcenter" style="width: 100%;font-size: 13px;" >
                        @foreach($infoleavetodates as $infoleavetodate)
                        <tr> 
                              <td>{{$infoleavetodate->LEAVE_TYPE_NAME}}</td>
                              <td>{{$infoleavetodate->LEAVE_PERSON_FULLNAME}}</td>
                              <td>{{Datethai($infoleavetodate->LEAVE_DATE_BEGIN)}}</td>
                              <td>{{$infoleavetodate->STATUS_NAME}}</td>
                        
                        </tr>
                        @endforeach
                        
                    </table>
                </div>


                <div class="card-header px-3 py-2 text-white">
                    รายงานการลาวันพรุ่งนี้ ( {{Datethai(date('Y-m-d', time() + 86400))}} )
                </div>
                <div class="card-body bg-white text-left">
                 
                    <table class="table-bordered table-striped table-vcenter" style="width: 100%;font-size: 13px;" >
                        @foreach($infoleavetomorrows as $infoleavetomorrow)
                        <tr> 
                            <td>{{$infoleavetomorrow->LEAVE_TYPE_NAME}}</td>
                            <td>{{$infoleavetomorrow->LEAVE_PERSON_FULLNAME}}</td>
                            <td>{{Datethai($infoleavetomorrow->LEAVE_DATE_BEGIN)}}</td>
                            <td>{{$infoleavetomorrow->STATUS_NAME}}</td>
                      
                        </tr>
                        @endforeach
                    </table>
                </div>

</div><br>
<div class="block-header block-header-default" >
                    <h2 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลผู้ลา</B></h2>
                        <a  class="btn btn-info btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>&nbsp; : หัวหน้างานเห็นชอบ&nbsp;&nbsp;
                        <a  class="btn btn-success btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>&nbsp; : หัวหน้ากลุ่มเห็นชอบ&nbsp;&nbsp;
                        <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>&nbsp; : ผู้รับมอบงานรับงาน&nbsp;&nbsp;  
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple " style="width: 100%;">
                                <thead style="background-color: #FFEBCD;" class="text-center">
                                    <tr height="20">
                                        <th  class="text-font" style="border-color:#F0FFFF;  border: 1px solid black;" width="15%" >สถานะเห็นชอบ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;  border: 1px solid black;" width="15%"> ชื่อผู้แจ้งลา</th>
                                        <th   class="text-font" style="border-color:#F0FFFF;  border: 1px solid black;" width="15%">ประเภทการลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;  border: 1px solid black;" class="d-none d-sm-table-cell" width="15%">เนื่องจาก</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;  border: 1px solid black;" class="d-none d-sm-table-cell" width="13%">วันที่ลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;  border: 1px solid black;" width="12%">ตรวจสอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforleavess as $inforleave)
                                <?php $number++;
                                 $status =  $inforleave -> STATUS_CODE;
                                if( $status === 'Pending'){
                                    $statuscol =  "badge badge-danger";

                                }else if($status === 'Approve'){
                                   $statuscol =  "badge badge-warning";

                                }else if($status === 'Verify'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'Allow'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }

                                ?>
                                    <tr height="20">
                                        <td  class="text-font" align="center" class="d-none d-sm-table-cell">
                                            @if($inforleave->LEAVE_APP_H1 == 'APP')
                                                <a  class="btn btn-info btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                            @else   
                                            -
                                            @endif
                                            
                                            @if($inforleave->LEAVE_APP_H2 == 'APP')
                                                <a  class="btn btn-success btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                            @else   
                                            -
                                            @endif

                                            @if($inforleave->LEAVE_APP_SEND == 'APP')
                                                <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                            @else   
                                            -
                                            @endif
                                         </td>

                                        <td class="text-font text-pedding">{{ $inforleave -> LEAVE_PERSON_FULLNAME }}</td>
                                        <td class="text-font text-pedding text-center">{{ $inforleave -> LEAVE_TYPE_NAME }}</td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{ $inforleave -> LEAVE_BECAUSE }}</td>
                                        <td  class="text-font" align="center">
                                            {{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }} - <br>
                                            {{ DateThai($inforleave -> LEAVE_DATE_END) }}
                                        </td>
                                        <td align="center">
                                        @if($status === 'Pending')
                                            <a href="{{ url('person_headdep/headdep_leave_app/'.$inforleave->ID) }}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fa fa-edit"></i></a>
                                        @else
                                        @endif
                                        </td>
                                    </tr>
                            @endforeach

                            </tbody>
                            </table>
            </div>
        </div> 
    </div>  
</div>

<div class="detail"></div>
<?php 
$count=0;
foreach ($infopersonleaves as $infoleave){
    if($infoleave->LEAVE_TYPE_CODE == '01'){
        $color_code = '#A3DCA6';
    }elseif($infoleave->LEAVE_TYPE_CODE == '03'){
        $color_code = '#ffadea';
    }elseif($infoleave->LEAVE_TYPE_CODE == '04'){
        $color_code = '#ADD8E6';
    }else{
        $color_code = '#F1C54D';
    }

    $TIME_BEGIN = '00:00:00';
    $TIME_END = '23:59:00';

    $data[] = array(
        'id' => $infoleave->ID,
        'title' => $infoleave->LEAVE_PERSON_FULLNAME,
        'start' => $infoleave->LEAVE_DATE_BEGIN.'T08:30:00',
        'end' => $infoleave->LEAVE_DATE_END.'T16:30:00',
        'person' => $infoleave->PERSON_REQUEST_NAME,
        'color'=> $color_code
        );
    $count++;
}
?>
@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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


<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lib/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lang/th.js') }}"></script>

<script type="text/javascript">
$(function(){

$('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',  //  prevYear nextYea
        center: 'title',
        right: 'month,agendaWeek,agendaDay',
    },
    buttonIcons:{
        prev: 'left-single-arrow',
        next: 'right-single-arrow',
        prevYear: 'left-double-arrow',
        nextYear: 'right-double-arrow'
    },

    viewRender: function(view, element) {
    setTimeout(function(){
        var strDate = $.trim($(".fc-center").find("h2").text());
        var arrDate = strDate.split(" ");
        var lengthArr = arrDate.length;
        var newstrDate = "";
        for(var i=0;i<lengthArr;i++){
            if(lengthArr-1==i || parseInt(arrDate[i])>1000){
                var yearBuddha=parseInt(arrDate[i])+543;
                newstrDate+=yearBuddha;
            }else{
                newstrDate+=arrDate[i]+" ";
            }
        }
        $(".fc-center").find("h2").text(newstrDate);
    },5);
},

    events:<?php
    if($count == 0 ){
        echo '[]';
    }else{
        echo json_encode($data);

    }


    ?>,

    eventLimit:true,
//        hiddenDays: [ 2, 4 ],
    lang: 'th',

eventClick: function(calEvent, jsEvent, view) {

    $.ajax({
                   url:"{{route('meeting.deatailcalendar')}}",
                   method:"GET",
                   data:{id:calEvent.id},
                   success:function(result){
                      $('.detail').html(result);
                
            
                   }

           })



}




});


});



</script>



@endsection
