@extends('layouts.backend_admin')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อกลุ่มภารกิจ</h2>    

    
        <form  method="post" action="{{ route('admin.updatepersondepartment') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">
      <label >รหัส {{ $infodepartment->HR_DEPARTMENT_ID }}</label>
      <input type = "hidden"  name = "HR_DEPARTMENT_ID"  id="HR_DEPARTMENT_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infodepartment->HR_DEPARTMENT_ID }}">
      </div>
      <div class="col-lg-1">
      <label >ชื่อกลุ่มภารกิจ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "HR_DEPARTMENT_NAME"  id="HR_DEPARTMENT_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infodepartment->HR_DEPARTMENT_NAME }}" onkeyup="check_hr_department_name();" required>
      <div style="color: red; font-size: 16px;" id="hr_department_name"></div>
    </div>
 
      <div class="col-lg-1">
     
      <label >เลขหนังสือ</label>
      </div>
      <div class="col-lg-2">
      <input  name="BOOK_NUM"  id="BOOK_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $infodepartment->BOOK_NUM }}" required>
      <div style="color: red; font-size: 16px;" id="book_num"></div>
    </div>
  

      <div class="col-lg-1">
      <label >หัวหน้ากลุ่มภารกิจ</label>
      </div>
      <div class="col-lg-3">
      <select name="LEADER_HR_ID" id="LEADER_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
      <option value="">--กรุณาเลือกหัวหน้ากลุ่มภารกิจ--</option>
            @foreach ($infopersons as $infoperson)
                    @if($infoperson ->ID == $infodepartment->LEADER_HR_ID)
                    <option value="{{ $infoperson ->ID  }}" selected> {{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                    @else
                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                    @endif                                                     
                
            @endforeach 
      </select>
      <div style="color: red; font-size: 13px;" id="leader_hr_id"></div>
      </div>
  
       
    <input  type="hidden" name = "ACTIVE"  id="ACTIVE" class="form-control input-lg" value="True">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_person/setupinfoworkgroup')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
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


  function check_hr_department_name()
  {                         
    hr_department_name = document.getElementById("HR_DEPARTMENT_NAME").value;             
          if (hr_department_name==null || hr_department_name==''){
          document.getElementById("hr_department_name").style.display = "";     
          text_hr_department_name = "*กรุณาระบุชื่อกลุ่มงาน";
          document.getElementById("hr_department_name").innerHTML = text_hr_department_name;
          }else{
          document.getElementById("hr_department_name").style.display = "none";
          }
  }
  function check_book_num()
  {                         
    book_num = document.getElementById("BOOK_NUM").value;             
          if (book_num==null || book_num==''){
          document.getElementById("book_num").style.display = "";     
          text_book_num = "*กรุณาระบุเลขหนังสือ";
          document.getElementById("book_num").innerHTML = text_book_num;
          }else{
          document.getElementById("book_num").style.display = "none";
          }
  }
  function check_leader_hr_id()
  {                         
    leader_hr_id = document.getElementById("LEADER_HR_ID").value;             
          if (leader_hr_id==null || leader_hr_id==''){
          document.getElementById("leader_hr_id").style.display = "";     
          text_leader_hr_id = "*กรุณาระบุหัวหน้ากลุ่ม";
          document.getElementById("leader_hr_id").innerHTML = text_leader_hr_id;
          }else{
          document.getElementById("leader_hr_id").style.display = "none";
          }
  }

</script>
<script>      
  $('form').submit(function () {
    var hr_department_name,text_hr_department_name;
    var book_num,text_book_num;
    var leader_hr_id,text_leader_hr_id;

    hr_department_name = document.getElementById("HR_DEPARTMENT_NAME").value;
    book_num = document.getElementById("BOOK_NUM").value;
    leader_hr_id = document.getElementById("LEADER_HR_ID").value;


    if (hr_department_name==null || hr_department_name==''){
    document.getElementById("hr_department_name").style.display = "";     
    text_hr_department_name= "*กรุณาระบุชื่อกลุ่มงาน";
    document.getElementById("hr_department_name").innerHTML = text_hr_department_name;
    }else{
    document.getElementById("hr_department_name").style.display = "none";
    }
    if (book_num==null || book_num==''){
    document.getElementById("book_num").style.display = "";     
    text_book_num= "*กรุณาระบุเลขหนังสือ";
    document.getElementById("book_num").innerHTML = text_book_num;
    }else{
    document.getElementById("book_num").style.display = "none";
    }
    if (leader_hr_id==null || leader_hr_id==''){
    document.getElementById("leader_hr_id").style.display = "";     
    text_leader_hr_id= "*กรุณาระบุหัวหน้ากลุ่ม";
    document.getElementById("leader_hr_id").innerHTML = text_leader_hr_id;
    }else{
    document.getElementById("leader_hr_id").style.display = "none";
    }

    if(hr_department_name==null || hr_department_name==''||
      
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
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection