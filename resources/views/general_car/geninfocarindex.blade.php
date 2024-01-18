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
</style>
<?php
$status = Auth::user()->status;
$id_user = Auth::user()->PERSON_ID;
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos);


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
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >

                                <a href="{{ url('general_car/gencarindex/'.$inforpersonuserid -> ID)}}" class="btn btn-warning loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ปฏิทินยานพาหนะ</a>
                                </div>
                                <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('general_car/gencartype/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เพิ่มข้อมูลขอใช้รถ</a>

                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_car/gencarinfonomal/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนใช้รถทั่วไป</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_car/gencarinforefer/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนใช้รถพยาบาล</a>
                                </div>

                                <div>&nbsp;</div>


                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <center>
                <div class="content">

                    <div class="block block-rounded block-bordered">
                        <br>

                    <div id='calendar' style="width:100%; display: inline-block;"></div>

                    <br>
                    <br>
                    </div>

                            <!-- END  -->
                </div>



                <?php $count=0; ?>
                @foreach ($infocarnimal1s as $infocarnimal1)
                
                <?php

                  if($infocarnimal1->STATUS == 'SUCCESS'){
                    $color_code = '#ADD8E6';
                  }elseif($infocarnimal1->STATUS == 'LASTAPP'){
                      $color_code = '#A3DCA6';
                  }else{
                    $color_code = '#F1C54D';
                  }
               
                   $data[] = array(
                    'id'   => $infocarnimal1->RESERVE_ID,
                    'title'   => $infocarnimal1->LOCATION_ORG_NAME,   
                    'start'   => $infocarnimal1->RESERVE_BEGIN_DATE.'T'.$infocarnimal1->RESERVE_BEGIN_TIME,
                    'end'   => $infocarnimal1->RESERVE_END_DATE.'T'.$infocarnimal1->RESERVE_END_TIME,
                    'type'   => 'nomal',
                    'color'=> $color_code
                   );
                   ?>
                <?php $count++; ?>

                  @endforeach 

      


                  <?php $count2=0; ?>
                @foreach ($infocarrefers as $infocarrefer)

                <?php

                   $data[] = array(
                    'id'   => $infocarrefer->ID,
                    'title'   => $infocarrefer->LOCATION_ORG_NAME,
                    'start'   => $infocarrefer->OUT_DATE.'T'.$infocarrefer->OUT_TIME,
                    'end'   => $infocarrefer->BACK_DATE.'T'.$infocarrefer->BACK_TIME,
                    'type'   => 'refer',
                    'color'=> '#FFB6C1'
                   );
                   ?>
                <?php $count2++; ?>
                  @endforeach

                  <div class="row">
<div class="col-md-10" align="right">
<p class="fa fa-circle" style="color:#FFCC33;"></p> รถทั่วไปสถานะร้องขอ
<p class="fa fa-circle" style="color:#ADD8E6;"></p> รถทั่วไปสถานะจัดสรร
<p class="fa fa-circle" style="color:#A3DCA6;"></p> รถทั่วไปสถานะอนุมัติ
<p class="fa fa-circle" style="color:#FFB6C1;"></p> รถพยาบาล
</div>
</div>

                  <div class="detail"></div>

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
    if($count == 0 && $count2==0){
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


    $.ajax({
                   url:"{{route('mcar.deatailcalendar')}}",
                   method:"GET",
                   data:{type:calEvent.type ,id:calEvent.id},
                   success:function(result){
                      $('.detail').html(result);
                      $('#detail_car').modal();
                     // alert("Hello! I am an alert box!!");
                   }

           })




}




});


});



</script>



@endsection
