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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสมรรถภาพประจำปี</B></h3>
                           
                        </div>
                        <div class="block-content block-content-full">

                    
                        <div class="table-responsive">      
                
                          <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
                  
                        <th class="text-font"  style="border-color:#000000; text-align: center;" width="8%">ลำดับ</th>
                        <th class="text-font"  style="border-color:#000000; text-align: center;">ชื่อ - นามสกุล</th>
    
                        <th class="text-font"  style="border-color:#000000; text-align: center;" width="8%">รายละเอียด</th>
        
        
                    </tr>
                   </tr>
                   </thead>
                   <tbody>
                  
                     <?php $number = 0; ?>
                      @foreach ($persons as $person)
                      <?php $number++;  ?>
                 
                   <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{$person->HR_FNAME}} {{$person->HR_LNAME}}</td>
                             
                             
                                <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="{{ url('manager_person/capacity/'.$person->ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียด</a>   
                                                

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