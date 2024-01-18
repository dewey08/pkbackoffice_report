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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลหน่วยงาน</h2>    

    
        <form  method="post" action="{{ route('admin.savepersondepartmentsubsub') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-1">
      <label >หน่วยงาน</label>
      </div>
      <div class="col-lg-3">
      <input  name = "HR_DEPARTMENT_SUB_SUB_NAME"  id="HR_DEPARTMENT_SUB_SUB_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onkeyup="check_hr_department_subsubname();" required>
      <div style="color: red; font-size: 16px;" id="hr_department_subsubname"></div>
</div>
     
      <div class="col-lg-1">
      <label >ฝ่าย/แผนก/กลุ่มงาน</label>
      </div>
      <div class="col-lg-3">
      <select name="HR_DEPARTMENT_SUB_ID" id="HR_DEPARTMENT_SUB_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_text_hr_department_id();" required>
      <option value="">--กรุณาเลือกฝ่าย/แผนก/กลุ่มงาน--</option>
            @foreach ($infodepartmentsubs as $infodepartmentsub)                                                     
                  <option value="{{ $infodepartmentsub ->HR_DEPARTMENT_SUB_ID  }}">{{ $infodepartmentsub-> HR_DEPARTMENT_SUB_NAME }}</option>
            @endforeach 
      </select>
      <div style="color: red; font-size: 16px;" id="hr_department_id"></div>
      </div>
   
    <div >
      
      <label >หัวหน้าหน่วยงาน</label>
      </div>
      <div class="col-lg-3">
      <select name="LEADER_HR_ID" id="LEADER_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
      <option value="">--กรุณาเลือกหัวหน้าหน่วยงาน--</option>
            @foreach ($infopersons as $infoperson)                                                     
                  <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
            @endforeach 
      </select>
      <div style="color: red; font-size: 16px;" id="leader_hr_id"></div>


      </div>
    
       
    <input  type="hidden" name = "ACTIVE"  id="ACTIVE" class="form-control input-lg" value="True">

   

      </div>

      <div class="row push">

                  <div class="col-lg-1">
                  <label >ชื่อย่อ </label>
                  </div>
                  <div class="col-lg-3">
                  <input  name = "DEP_CODE"  id="DEP_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" required>
                  
                  </div>

                
                  <div class="col-lg-1">
                  <label >LINE </label>
                  </div>
                  <div class="col-lg-7">
                  <input  name = "LINE_TOKEN"  id="LINE_TOKEN" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                  
                  </div>

                  </div>
      
      </div>

     


        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" > <i class="fas fa-save mr-2"></i>  บันทึกข้อมูล</button>
         <a href="{{ url('admin_person/setupinfoinstitution')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>   ยกเลิก</a> 
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

      function check_hr_department_subsubname()
      {                         
            hr_department_subsubname = document.getElementById("HR_DEPARTMENT_SUB_SUB_NAME").value;             
              if (hr_department_subsubname==null || hr_department_subsubname==''){
              document.getElementById("hr_department_subsubname").style.display = "";     
              text_hr_department_subsubname = "*กรุณาระบุหน่วยงาน";
              document.getElementById("hr_department_subsubname").innerHTML = text_hr_department_subsubname;
              }else{
              document.getElementById("hr_department_subsubname").style.display = "none";
              }
      }
      function check_text_hr_department_id()
      {                         
            hr_department_id = document.getElementById("HR_DEPARTMENT_SUB_ID").value;             
              if (hr_department_id==null || hr_department_id==''){
              document.getElementById("hr_department_id").style.display = "";     
              text_hr_department_id = "*กรุณาเลือกฝ่าย/แผนก";
              document.getElementById("hr_department_id").innerHTML = text_hr_department_id;
              }else{
              document.getElementById("hr_department_id").style.display = "none";
              }
      }
      function check_leader_hr_id()
      {                         
        leader_hr_id = document.getElementById("LEADER_HR_ID").value;             
              if (leader_hr_id==null || leader_hr_id==''){
              document.getElementById("leader_hr_id").style.display = "";     
              text_leader_hr_id = "*กรุณาเลือกหัวหน้ากลุ่ม";
              document.getElementById("leader_hr_id").innerHTML = text_leader_hr_id;
              }else{
              document.getElementById("leader_hr_id").style.display = "none";
              }
      }
    
    </script>
    <script>      
      $('form').submit(function () {
        var hr_department_subsubname,text_hr_department_subsubname;
        var hr_department_id,text_hr_department_id;
        var leader_hr_id,text_leader_hr_id;
    
        hr_department_subsubname = document.getElementById("HR_DEPARTMENT_SUB_SUB_NAME").value;
        hr_department_id = document.getElementById("HR_DEPARTMENT_SUB_ID").value;
        leader_hr_id = document.getElementById("LEADER_HR_ID").value;
    
    
        if (hr_department_subsubname==null || hr_department_subsubname==''){
        document.getElementById("hr_department_subsubname").style.display = "";     
        text_hr_department_subsubname= "*กรุณาระบุหน่วยงาน";
        document.getElementById("hr_department_subsubname").innerHTML = text_hr_department_subsubname;
        }else{
        document.getElementById("hr_department_subsubname").style.display = "none";
        }
        if (hr_department_id==null || hr_department_id==''){
        document.getElementById("hr_department_id").style.display = "";     
        text_hr_department_id= "*กรุณาเลือกฝ่าย/แผนก";
        document.getElementById("hr_department_id").innerHTML = text_hr_department_id;
        }else{
        document.getElementById("hr_department_id").style.display = "none";
        }
        if (leader_hr_id==null || leader_hr_id==''){
        document.getElementById("leader_hr_id").style.display = "";     
        text_leader_hr_id= "*กรุณาเลือกหัวหน้ากลุ่ม";
        document.getElementById("leader_hr_id").innerHTML = text_leader_hr_id;
        }else{
        document.getElementById("leader_hr_id").style.display = "none";
        }
    
        if(hr_department_subsubname==null || hr_department_subsubname==''||
        hr_department_id==null || hr_department_id==''||
       
        )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection