@extends('layouts.personhealth')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
}

.text-font {
    font-size: 13px;
}   

table, td, th {
            border: 1px solid black;
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


?>        
           <br>
           <br>
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">  


          <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสมรรถภาพประจำปี {{$infouser->HR_FNAME}} {{$infouser->HR_LNAME}}</B></h3>
                            <a href="{{ url('manager_person/capacity_add/'.$user_id)}}" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif;" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                        </div>
                        <div class="block-content block-content-full">

                    
                        <div class="table-responsive">      
                
                        <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
                  
                        <th class="text-font"  style="border-color:#000000; text-align: center;" width="8%">ลำดับ</th>
                        <th class="text-font"  style="border-color:#000000; text-align: center;">ข้อมูลการตรวจสมรรถภาพประจำปี</th>
    
                        <th class="text-font"  style="border-color:#000000; text-align: center;" width="8%">รายละเอียด</th>
        
        
                    </tr>
                   </tr>
                   </thead>
                   <tbody>
                  
                     <?php $number = 0; ?>
                      @foreach ($infocapas as $infocapa)
                      <?php $number++;  ?>
                 
                   <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{$infocapa->CAPACITY_YEAR}}</td>
                             
                             
                                <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="{{ url('manager_person/capacity_detail/'.$infocapa->CAPACITY_PERSON_ID.'/'.$infocapa->CAPACITY_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>   
                                                <a class="dropdown-item"  href="{{ url('manager_person/destroy_capacity/'.$infocapa->CAPACITY_ID.'/'.$infocapa->CAPACITY_PERSON_ID)}}"   onclick="return confirm('ต้องการที่จะลบข้อมูล ?')"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ลบข้อมูล</a>    

                                                </div>
                                            </div>
                                </td>     
                        </tr>
                        @endforeach 
                   </tbody>
                  </table>

             


             
      
                        
        
         </div>
    
                      

@endsection
@section('footer')
    
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


@endsection