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
                                <a href="{{ url('general_repair/genrepairindex/'.$inforpersonuserid -> ID)}}" class="btn btn-warning" >ปฏิทินแจ้งซ่อม</a> 
                                </div>
                                <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('general_repair/genrepairtype/'.$inforpersonuserid -> ID)}}" class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลแจ้งซ่อม</a> 
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
                   
               
                            <!-- END  -->
                </div>
       

                   
         

@endsection

@section('footer')

  
    

<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lib/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lang/th.js') }}"></script>
       



@endsection