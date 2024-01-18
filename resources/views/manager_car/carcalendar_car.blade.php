@extends('layouts.car')
    
  
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




$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}


?>

        <center>
                   
                <div style="width:95%;" >
                   
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
<div class="col-md-10" align="right" style="font-family: 'Kanit', sans-serif;">
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

eventClick: function(calEvent, jsEvent, view) {

$.ajax({
                   url:"{{route('mcar.deatailcalendar')}}",
                   method:"GET",
                   data:{type:calEvent.type ,id:calEvent.id},
                   success:function(result){
                      $('.detail').html(result);
                      $('#detail_car').modal();
        
                   }
                   
           })

       

}  
           
});


});



</script>            



@endsection