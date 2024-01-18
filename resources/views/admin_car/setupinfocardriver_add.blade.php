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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลพนักงานขับรถ</h2>    

    
        <form  method="post" action="{{ route('admin.savecardriver') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ชื่อพนักงานขับรถ</label>
      </div>
      <div class="col-lg-3">
      <select name="PERSON_ID" id="PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_person_id();">
      <option value="">--กรุณาเลือกพนักงาน--</option>
            @foreach ($PERSONALLs as $PERSONALL)                                                     
                  <option value="{{ $PERSONALL ->ID  }}"> {{ $PERSONALL-> HR_FNAME }} {{ $PERSONALL-> HR_LNAME }}</option>
            @endforeach 
      </select>
      <div style="color: red; font-size: 16px;" id="person_id"></div> 
      
      </div>
     

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
         <a href="{{ url('admin_car/setupcardriver')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
  $(document).ready(function() {
$('select').select2();
});
   
    function check_person_id()
    {                         
        person_id = document.getElementById("PERSON_ID").value;             
            if (person_id==null || person_id==''){
            document.getElementById("person_id").style.display = "";     
            text_person_id = "*กรุณาเลือกพนักงาน";
            document.getElementById("person_id").innerHTML = text_person_id;
            }else{
            document.getElementById("person_id").style.display = "none";
            }
    }
   
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var person_id,text_person_id;      
     
      person_id = document.getElementById("PERSON_ID").value;   
                
      if (person_id==null || person_id==''){
      document.getElementById("person_id").style.display = "";     
      text_person_id = "*กรุณาเลือกพนักงาน";
      document.getElementById("person_id").innerHTML = text_person_id;
      }else{
      document.getElementById("person_id").style.display = "none";
      }
     
        
      if(person_id==null || person_id==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>



@endsection