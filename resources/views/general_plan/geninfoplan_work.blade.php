@extends('layouts.backend')


    <link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">


@section('content')

<style>

#calendar{
		max-width: 95%;
		margin: 0 auto;
    font-size:15px;
	}

    body {
      font-family: 'Kanit', sans-serif;
      font-size: 14px;
      }

      table, td, th {
            border: 1px solid black;
            font-size: 12px;
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



use App\Http\Controllers\MeetingController;
$checkver = MeetingController::checkver($user_id);
$countver = MeetingController::countver($user_id);

$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}


?>

<!-- Advanced Tables -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">
        {{ $inforpersonuser -> HR_PREFIX_NAME }} {{ $inforpersonuser -> HR_FNAME }} {{ $inforpersonuser -> HR_LNAME }}
      </h1>
      <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <div class="row">
            <div>
              <a href="{{ url('general_plan/plan_dashboard/'.$inforpersonuserid -> ID)}}"
                class="btn loadscreen"  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/planwork/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen"
               >แผนปฏิบัติงาน</a>
            </div>
            <div>&nbsp;</div>

            <div>
              <a href="{{ url('general_plan/plan_project/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนงานโครงการ</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/plan_humandev/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนพัฒนาบุคลากร</a>
            </div>
            <div>&nbsp;</div>
            <div>
              <a href="{{ url('general_plan/plan_durable/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซื้อครุภัณฑ์</a>
            </div>
            <div>&nbsp;</div>
            <a href="{{ url('general_plan/plan_repair/'.$inforpersonuserid -> ID)}}" class="btn loadscreen"
              style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">แผนซ่อมบำรุง</a>
          </div>
        </ol>
      </nav>
    </div>
  </div>
</div>
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
  <div class="block-content">

    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;">
      <div class="row">
        <div class="col-sm-8">
          <B>ข้อมูลแผนปฏิบัติงาน</B>
        </div>
    
        <div class="col-sm-4" style="text-align:right;">
          <a href="{{ url('general_plan/geninfoplanwork_add/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen" >เพิ่มแผนปฏิบัติงาน</a>
        </div>

      </div>
    </h3>

  

   <div class="row">
      <div class="col-sm-8">

        <div class="panel bg-sl-blue p-1">
          <div class="pane-heading py-2 pl-5 text-white">ปฏิทินแผนปฏิบัติงาน</div>
          <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
            <br><br>    
            <div id='calendar' style="width:100%; display: inline-block;"></div>
            <br><br>       
          </div>
              </div> 
      </div>
      <div class="col-sm-4">
        <div class="col-md-12 mb-2">
          <br>
          <div class="panel bg-sl-o2 p-1">
              <div class="pane-heading py-2 pl-5 text-white">รายงานการปฏิบัติงาน</div>
              <div class="pane-body bg-white d-flex justify-content-center" style="overflow-y:hidden">
                  <table class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th colspan="2">แผนกิจกรรม</th>
                          </tr>
                      </thead>
                      <tbody>
                   
                        <tr>
                          <td colspan="2" align="left" bgcolor="#FFE4C4">ผ่านไปแล้ว</td>
                        </tr>

                        @foreach ($infowork_pass_s as $infowork_pass)
                          <tr>
                            
                              <td class="text-left">
                                เรื่อง : {{$infowork_pass->PLANWORK_HEAD}} <br>
                                สถานะ : 
                                @if($infowork_pass->PLANWORK_STATUS == 'Success')
                                    ดำเนินการเรียบร้อย 
                                @else
                                    กำลังดำเนินการ
                                @endif
                                <br>
                                ผู้รับผิดชอบ : {{$infowork_pass->HR_FNAME}} {{$infowork_pass->HR_LNAME}} <br>
                                วันที่เริ่ม : {{Datethai($infowork_pass->PLANWORK_DATE_BEGIN)}}<br>
                                วันที่สิ้นสุด : {{Datethai($infowork_pass->PLANWORK_DATE_END)}}<br>
                               
                              </td>

                              <td class="py-1 text-center">
                                <button type="button" class="btn btn-outline-info" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                              </button>
                              <div class="dropdown-menu" style="width:10px">

                              <a class="dropdown-item" href=""  onclick="if(confirm('งาน \'จัดการเขียนแนโครงการ\' เสร็จสิ้นเรียบร้อย ?'))Updatestatus({{$infowork_pass->PLANWORK_ID}});"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">งานเสร็จแล้ว</a>                                                                                                                        
                              <a class="dropdown-item" href="{{ url('general_plan/geninfoplanwork_edit/'.$infowork_pass->PLANWORK_ID.'/'.$inforpersonuserid -> ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>  
                                 
                              </div>
                              </td>
                            
                         
                          </tr>

                  @endforeach      


                          <tr>
                            <td colspan="2" align="left" bgcolor="#7FFFD4">วันนี้</td>
                          </tr>

                      @foreach ($infowork_today_s as $infowork_today) 
                    <tr>        
                          <td class="text-left">
                            เรื่อง : {{$infowork_today->PLANWORK_HEAD}} <br>
                            สถานะ : 
                            @if($infowork_today->PLANWORK_STATUS == 'Success')
                                ดำเนินการเรียบร้อย 
                            @else
                                กำลังดำเนินการ
                            @endif
                    
                            <br>
                            ผู้รับผิดชอบ : {{$infowork_today->HR_FNAME}} {{$infowork_today->HR_LNAME}} <br>
                            วันที่เริ่ม : {{Datethai($infowork_today->PLANWORK_DATE_BEGIN)}}<br>
                            วันที่สิ้นสุด : {{Datethai($infowork_today->PLANWORK_DATE_END)}}<br>
                           
                          </td>

                          <td class="py-1 text-center">
                            <button type="button" class="btn btn-outline-info" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                          </button>
                          <div class="dropdown-menu" style="width:10px">
                            <a class="dropdown-item" href=""  onclick="if(confirm('งาน \'จัดการเขียนแนโครงการ\' เสร็จสิ้นเรียบร้อย ?'))Updatestatus({{$infowork_today->PLANWORK_ID}});"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">งานเสร็จแล้ว</a>                                                                                                                        
                            <a class="dropdown-item" href="{{ url('general_plan/geninfoplanwork_edit/'.$infowork_today->PLANWORK_ID.'/'.$inforpersonuserid -> ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                             
                          </div>
                          </td>
                        </tr>
                          @endforeach      
                          <tr>
                            <td colspan="2" align="left" bgcolor="#00FFFF">วันต่อไป</td>
                          </tr>
  
                        @foreach ($infowork_futher_s as $infowork_futher)  
                      <tr>      
                          <td class="text-left">
                            เรื่อง : {{$infowork_futher->PLANWORK_HEAD}} <br>
                            สถานะ : 
                            @if($infowork_futher->PLANWORK_STATUS == 'Success')
                                ดำเนินการเรียบร้อย 
                            @else
                                กำลังดำเนินการ
                            @endif
                            <br>
                            ผู้รับผิดชอบ : {{$infowork_futher->HR_FNAME}} {{$infowork_futher->HR_LNAME}} <br>
                            วันที่เริ่ม : {{Datethai($infowork_futher->PLANWORK_DATE_BEGIN)}}<br>
                            วันที่สิ้นสุด : {{Datethai($infowork_futher->PLANWORK_DATE_END)}}<br>
                           
                          </td>

                          <td class="py-1 text-center">
                            <button type="button" class="btn btn-outline-info" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                          </button>
                          <div class="dropdown-menu" style="width:10px">

                            <a class="dropdown-item" href=""  onclick="if(confirm('งาน \'จัดการเขียนแนโครงการ\' เสร็จสิ้นเรียบร้อย ?'))Updatestatus({{$infowork_futher->PLANWORK_ID}});"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">งานเสร็จแล้ว</a>                                                                                                                        
                            <a class="dropdown-item" href="{{ url('general_plan/geninfoplanwork_edit/'.$infowork_futher->PLANWORK_ID.'/'.$inforpersonuserid -> ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                             
                          </div>
                          </td>
                        </tr>
                          @endforeach     
                        </tbody>
                       
                         
                      </tbody>
                  </table>



                  <?php $count=0; ?>
                  @foreach ($infomationworks as $infomationwork)
                  
                  <?php
  
                    if($infomationwork->PLANWORK_STATUS == 'Process'){
                      $color_code = '#ADD8E6';
                    }elseif($infomationwork->PLANWORK_STATUS == 'Success'){
                        $color_code = '#A3DCA6';
                    }else{
                      $color_code = '#F1C54D';
                    }
                 
                     $data[] = array(
                      'id'   => $infomationwork->PLANWORK_ID,
                      'title'   => $infomationwork->PLANWORK_HEAD,   
                      'start'   => $infomationwork->PLANWORK_DATE_BEGIN,
                      'end'   => $infomationwork->PLANWORK_DATE_END,
                      'type'   => 'nomal',
                      'color'=> $color_code
                     );
                     ?>
                  <?php $count++; ?>
  
                    @endforeach 





              </div>
          </div>
      </div>
      </div>
   </div>
</div>
</div>
@endsection

@section('footer')

<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lib/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lang/th.js') }}"></script>


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
//        theme:false,
//        themeButtonIcons:{
//            prev: 'circle-triangle-w',
//            next: 'circle-triangle-e',
//            prevYear: 'seek-prev',
//            nextYear: 'seek-next'
//        },
//        firstDay:1,
//        isRTL:false,
//        weekends:true,
//        weekNumbers:false,
//        weekNumberCalculation:'local',
//          height:'auto',
//          width:'500px',
//        fixedWeekCount:false,

events:<?php
    if($count == 0){
        echo '[]';
    }else{
        echo json_encode($data);
    }
    ?>,
    eventLimit:true,
//        hiddenDays: [ 2, 4 ],
    lang: 'th',
    dayClick: function(date) {

        alert('Clicked on: ' + date.format());

},
eventClick: function(calEvent, jsEvent, view) {





}




});


});




function Updatestatus(idref){

  var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('guest.geninfoplanwork_updatestatus')}}",
             method:"GET",
             data:{idref:idref,_token:_token},   
             success:function(result){
              location.reload();
             }
     })

}

</script>

@endsection
