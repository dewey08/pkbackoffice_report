@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 13px;
    
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
         
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}

?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลสมาชิกทีมนำองค์กร</h2>    

    
        <form  method="post" action="{{ route('admin.updatecommittee') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <input  type="hidden" name = "ID"  id="ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforTeamlist->ID}}" >
      <div class="col-lg-1">    
      <label >ชื่อสมาชิก</label>
      </div>
      <div class="col-lg-3">
    
      <select name="PERSON_ID" id="PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                <option value="">--กรุณาเลือกชื่อสมาชิก--</option>
            @foreach ($infopersons as $infoperson)  
                @if($infoperson ->ID == $inforTeamlist->PERSON_ID)
                  <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson->HR_FNAME }} {{ $infoperson->HR_LNAME }}</option>
                @else
                  <option value="{{ $infoperson ->ID  }}" >{{ $infoperson->HR_FNAME }} {{ $infoperson->HR_LNAME }}</option>  
                @endif
           
            @endforeach 
      </select>
      
      </div>
 
    <div class="col-lg-1">   
      <label >ตำแหน่งทีม</label>
      </div>
      <div class="col-lg-3">
     
      <select name="TEAM_POSITION_ID" id="TEAM_POSITION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                 <option value="">--กรุณาเลือกตำแหน่งทีม--</option>
            @foreach ($inforTeampositions as $inforTeamposition)  
                 @if($inforTeamposition ->TEAM_POSITION_ID == $inforTeamlist->TEAM_POSITION_ID)
                 <option value="{{ $inforTeamposition ->TEAM_POSITION_ID  }}" selected>{{ $inforTeamposition->TEAM_POSITION_NAME }}</option>   
                 @else
                 <option value="{{ $inforTeamposition ->TEAM_POSITION_ID  }}">{{ $inforTeamposition->TEAM_POSITION_NAME }}</option>
                 @endif                                                   
                 
            @endforeach 
      </select>
      </div>
      <div class="col-lg-2">   
      <label >ตำแหน่งอื่นๆ</label>
      </div>
      <div class="col-lg-2">
     
      <input  name = "TEAM_POSITION_ETC"  id="TEAM_POSITION_ETC" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$inforTeamlist->TEAM_POSITION_ETC}}" >
      </div>

     

      <input  type="hidden" name = "TEAM_ID"  id="TEAM_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$teamid->HR_TEAM_ID}}" >

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_person_H/setupinfopersonteam/committee/'.$teamid->HR_TEAM_ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  $(document).ready(function() {
      $('select').select2();

      });
</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection