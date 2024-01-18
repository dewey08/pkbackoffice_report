@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />




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
            font-size: 14px;
           
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลประเภทหน่วยงาน/กลุ่มงาน</h2>    

    
        <form  method="post" action="{{ route('srisk.setupincidence_category_depart_update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2 text-right">

      <label >ประเภทหน่วยงาน/กลุ่มงาน :</label>
      </div>
      <div class="col-lg-3">
      <input value="{{ $catdepartments->CATEGORY_DEPARTMENT_NAME }}" name = "CATEGORY_DEPARTMENT_NAME"  id="CATEGORY_DEPARTMENT_NAME" class="form-control input-lg" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;" onkeyup="check_cate_name();" >
      <div style="color: red; font-size: 16px;" id="cate_name"></div>
    </div>
    <div class="col-lg-2 text-right">

<label >กลุ่มหน่วยงาน/กลุ่มภารกิจ :</label>
</div>
<div class="col-lg-3">

<select name="CATEGORY_DEPARTMENT_SUBNAME" id="CATEGORY_DEPARTMENT_SUBNAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;" onkeyup="check_cate_subname();">
            <option value="">เลือก</option>
                @foreach($departs as $depart)
                @if($depart->HR_DEPARTMENT_ID == $catdepartments->CATEGORY_DEPARTMENT_SUBNAME)
                    <option value="{{ $depart-> HR_DEPARTMENT_ID}}" selected>{{ $depart-> HR_DEPARTMENT_NAME}}</option>
                    @else
                    <option value="{{ $depart-> HR_DEPARTMENT_ID}}" >{{ $depart-> HR_DEPARTMENT_NAME}}</option>
                    @endif
                @endforeach
    </select> 
<div style="color: red; font-size: 16px;" id="cate_subname"></div>
</div>
    <input type="hidden" value="{{ $catdepartments-> CATEGORY_DEPARTMENT_ID}}" name="CATEGORY_DEPARTMENT_ID" id="CATEGORY_DEPARTMENT_ID" class="form-control">

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_risk/setupincidence_category_depart')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
   
  function check_cate_name()
  {                         
    cate_name = document.getElementById("CATEGORY_DEPARTMENT_NAME").value;             
          if (cate_name==null || cate_name==''){
          document.getElementById("cate_name").style.display = "";     
          text_cate_name = "*กรุณาระบุประเภทหน่วยงาน/กลุ่มงาน";
          document.getElementById("cate_name").innerHTML = text_cate_name;
          }else{
          document.getElementById("cate_name").style.display = "none";
          }
  } 
  function check_cate_subname()
  {                         
    cate_subname = document.getElementById("CATEGORY_DEPARTMENT_SUBNAME").value;             
          if (cate_subname==null || cate_subname==''){
          document.getElementById("cate_subname").style.display = "";     
          text_cate_subname = "*กรุณาระบุกลุ่มหน่วยงาน/กลุ่มภารกิจ";
          document.getElementById("cate_subname").innerHTML = text_cate_subname;
          }else{
          document.getElementById("cate_subname").style.display = "none";
          }
  }
 </script>
 <script>      
  $('form').submit(function () {
   
    var cate_name,text_cate_name;
    var cate_subname,text_cate_subname;
        
    cate_name = document.getElementById("CATEGORY_DEPARTMENT_NAME").value;
    cate_subname = document.getElementById("CATEGORY_DEPARTMENT_SUBNAME").value;
     
    if (cate_name==null || cate_name==''){
    document.getElementById("cate_name").style.display = "";     
    text_cate_name = "*กรุณาระบุประเภทหน่วยงาน/กลุ่มงาน";
    document.getElementById("cate_name").innerHTML = text_cate_name;
    }else{
    document.getElementById("cate_name").style.display = "none";
    }

    if (cate_subname==null || cate_subname==''){
    document.getElementById("cate_subname").style.display = "";     
    text_cate_subname = "*กรุณาระบุกลุ่มหน่วยงาน/กลุ่มภารกิจ";
    document.getElementById("cate_subname").innerHTML = text_cate_subname;
    }else{
    document.getElementById("cate_subname").style.display = "none";
    }
   

    if(cate_name==null || cate_name=='',
    cate_subname==null || cate_subname==''
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