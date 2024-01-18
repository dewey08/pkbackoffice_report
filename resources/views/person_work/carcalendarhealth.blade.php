@extends('layouts.backend')
<link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">
<style>

#calendar{
		max-width: 95%;
		margin: 0 auto;
    font-size:15px;
    font-family: 'Kanit', sans-serif;
	}
    body {
      font-family: 'Kanit', sans-serif;
      font-size: 15px;
      }
 
</style>

@section('content')
<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
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
                            
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforperson -> HR_PREFIX_NAME }}   {{ $inforperson -> HR_FNAME }}  {{ $inforperson -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                        <div>
                                                <a href="{{ url('person_work/carcalendarhealth/'.$inforpersonid -> ID)}}"  class="btn btn-primary loadscreen" >ปฎิทิน</a>
                                        </div>
                                        <div>&nbsp;</div>
                               
                                        <div>
                                        <a href="{{ url('person_work/personworkscreening/checkup/'.$inforpersonid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสุขภาพประจําปี</a>
                                        </div>
                                        <div>&nbsp;</div>
                               
                             
                              
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
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
                @foreach ($daychecks as $daycheck)


              
                
                <?php

             

                  $name = $daycheck->HR_FNAME." ".$daycheck->HR_LNAME;
               
                   $data[] = array(
                    'id'   => $daycheck->HEALTH_SCREEN_ID,
                    'title'   =>  $name,   
                    'start'   => $daycheck->HEALTH_SCREEN_CON_DATE.'T'.$daycheck->HEALTH_SCREEN_CON_TIME,
                    'color'=> '#A3DCA6'
                   );

              
                  
                   ?>
                <?php $count++; ?>

                  @endforeach 


             
       
        
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