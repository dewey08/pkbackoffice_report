@extends('layouts.person')
    
  
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
<?php
  function formatenow($strDate)
{
  $strYear = date("Y");
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));
 
  return $strYear."-".$strMonth."-".$strDay;
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
                @foreach ($birthdays as $birthday)


              
                
                <?php

             

                  $name = $birthday->HR_FNAME." ".$birthday->HR_LNAME;
               
                   $data[] = array(
                    'id'   => $birthday->ID,
                    'title'   =>  $name,   
                    'start'   => formatenow($birthday->HR_BIRTHDAY),
                    'color'=> '#A3DCA6'
                   );

                   $data[] = array(
                    'id'   => $birthday->ID,
                    'title'   =>  $name,   
                    'start'   => DateThairetire($birthday->HR_BIRTHDAY),
                    'color'=> '#00FFFF'
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