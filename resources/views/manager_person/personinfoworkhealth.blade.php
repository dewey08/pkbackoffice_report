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
          <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการตรวจสุขภาพประจำปี {{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</B></h3>
                            <a href="" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                        </div>
                        <div class="block-content block-content-full">

                    
                        <div class="table-responsive">      
                
                        <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
                  
                  
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ปี</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">วันที่ตรวจ</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">อายุ</th>                      
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ครอบครัว</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">การเจ็บป่วย</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">สูบบุรี่</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ดื่มสุรา</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">ออกกำลังกาย</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">อาหาร</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">การขับขี่</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;">เพศสัมพันธ์</th>
                        <th class="text-font"  style="border-color:#F0FFFF; text-align: center;" width="8%">คำสั่ง</th>
        
        
                    </tr>
                   </tr>
                   </thead>
                   <tbody>
                   
                   @foreach ($infoscreens as $infoscreen)  

                   <tr height="20">
                     <td class="text-font text-pedding">{{$infoscreen->HEALTH_SCREEN_YEAR}}</td> 
                     <td class="text-font text-pedding">ว/ด/ป</td> 
                     <td class="text-font text-pedding">00</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 
                     <td class="text-font text-pedding">-</td> 

                     <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="{{ url('manager_person/health_add/'.$infoscreen->HEALTH_SCREEN_ID.'/'.$iduser)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>   
                                                <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >พิมพ์เอกสาร</a> 
                                                <a class="dropdown-item"  href="{{ url('manager_person/destroy_screen/'.$infoscreen->HEALTH_SCREEN_ID.'/'.$iduser)}}"   onclick="return confirm('ต้องการที่จะลบข้อมูล ?')"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ลบข้อมูล</a>     
                                                </div>
                                            </div>
                                </td>     
                    
                   </tr> 
                   @endforeach   
                   </tbody>
                  </table>
 



                  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                    <div class="modal-header">
                                        
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มปีงบข้อมูลการตรวจสุขภาพประจำปี</h2>
                                        </div>
                                        <div class="modal-body">
                                        <body>
                                        <form  method="post" action="{{ route('health.mana_screen_save') }}" >
                                        @csrf

                                        <input type="hidden" name="HEALTH_SCREEN_PERSON_ID" id="HEALTH_SCREEN_PERSON_ID" value="{{$iduser}}" >
                                
                                    <div class="row push">
                                    <div>&nbsp;</div>
                                    <div class="col-sm-2">
                                    <label >ปีงบประมาณ</label>
                                    </div>
                                    <div class="col-sm-8">
                                    <select name="HEALTH_SCREEN_YEAR" id="HEALTH_SCREEN_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                @foreach ($budgetyears as $budgetyear)
                                                         <option value="{{ $budgetyear->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                                @endforeach                 
                                    </select>
                                
                                    </div>
                                    </div>
                                
                                

                                    </div>
                                        <div class="modal-footer">
                                        <div align="right">
                                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                                        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
                                        </div>
                                        </div>
                                        </form>  
                                </body>
                                    
                                    
                                    </div>
                                </div>
                                </div>

                                <br>                       
                   </div>               
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