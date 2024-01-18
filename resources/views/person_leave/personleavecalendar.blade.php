@extends('layouts.backend')


    <link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">


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
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
                {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }}
                {{ $inforpersonuser -> HR_LNAME }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <div class="row">
                            <div>
                                <a href="{{ url('person_leave/personleaveindex/'.$inforpersonuserid -> ID)}}"

                                    class="btn btn-hero-sm btn-hero loadscreen"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                    <i
                                            class="fas fa-tachometer-alt mr-2"></i>Dashboard</span>
                                </a>
                            </div>
                            <div>&nbsp;</div>
                            <div>
                                <a href="{{ url('person_leave/personleavecalendar/'.$inforpersonuserid -> ID)}}"
         
                                        class="btn btn-hero-sm btn-hero-info loadscreen">
                                        <span class="nav-main-link-name"><i
                                                class="fas fa-calendar-day mr-2"></i>ปฏิทิน</span>
                                    </a>
                            </div>
                            <div>&nbsp;</div>
                            <div>
                                <a href="{{ url('person_leave/personleavetype/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-hero-sm btn-hero loadscreen"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                        class="fas fa-plus mr-1"></i> เพิ่มข้อมูลการลา</a>
                            </div>
                            <div>&nbsp;</div>
                          
                            <div>
                                <a href="{{ url('person_leave/personleaveinfo/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-hero-sm btn-hero loadscreen"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                        class="fas fa-calendar-day mr-2"></i>ข้อมูลการลา</a>
                            </div>
                            <div>&nbsp;</div>
                            @if($checkapp != 0)
                            <div>
                                <a href="{{ url('person_leave/personleaveinfoapp/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-hero-sm btn-hero loadscreen"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                        class="fas fa-clipboard-check mr-2"></i>เห็นชอบ
                                    @if($countapp!=0)
                                    <span class="badge badge-light">{{$countapp}}</span>
                                    @endif
                                </a>
                            </div>
                            <div>&nbsp;</div>
                            @endif
                            @if($checkver != 0)
                            <div>
                                <a href="{{ url('person_leave/personleaveinfover/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-hero-sm btn-hero loadscreen"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                        class="fas fa-clipboard-check mr-2"></i>ตรวจสอบ
                                    @if($countver!=0)
                                    <span class="badge badge-light">{{$countver}}</span>
                                    @endif
                                </a>
                            </div>
                            <div>&nbsp;</div>
                            @endif
                            @if($checkallow!=0)
                            <div>
                                <a href="{{ url('person_leave/personleaveinfolastapp/'.$inforpersonuserid -> ID)}}"
                                    class="btn btn-hero-sm btn-hero loadscreen"
                                    style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                        class="fas fa-clipboard-check mr-2"></i>อนุมัติ
                                    @if($countallow!=0)
                                    <span class="badge badge-light">{{$countallow}}</span>
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
                                    {{-- @if($countallow!=0)
                                    <span class="badge badge-light">{{$countallow}}</span>
                                    @endif --}}
                                </a>
                            </div>
                            <div>&nbsp;</div>
                            
                        </div>
                    </ol>
                </nav>
        </div>
    </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
    <div class="block-content row px-0">
        <div class="col-lg-4 mb-2">
            <div class="card bg-info p-1 mx-0">
                <div class="card-header px-3 py-2 text-white">
                    หน่วยงาน
                </div>
                <div class="card-body bg-white text-left">
                    <a class="dropdown-item devleave fs-18 fw-b" href="{{route('leave.infocalendar',$iduser)}}">ทั้งหมด</a>
                    @foreach($depinfos as $row)
                    <a class="dropdown-item pl-3 devleave"
                        href="{{route('leave.infocalendar',$iduser).'?depid='.$row->HR_DEPARTMENT_ID.'&depname='.$row->HR_DEPARTMENT_NAME}}">{{$row->HR_DEPARTMENT_NAME}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-2">
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
