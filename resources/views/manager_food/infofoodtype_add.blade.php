@extends('layouts.backend_admin')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


@section('content')
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
  
        .text-pedding{
     padding-left:10px;
                      }
  
          .text-font {
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


?>       
                    <!-- Advanced Tables -->
                 
                    <div class="content">
    <div class="block block-rounded block-bordered">
          <div class="block-content"> 
              <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าประเภทอาหาร</h2> 
          <form  method="post" action="{{ route('mfood.infofoodtype_save') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
            @csrf
            <div class="row push">       
                <div class="col-lg-2 text-right">
                  <label >ประเภทอาหาร :</label>
                  </div>
                  <div class="col-lg-4">
                  <input  name = ""  id="" class="form-control input-sm" style="font-family: 'Kanit', sans-serif; font-size:14px;" value="">
                  <div style="color: red; font-size: 16px;" id="record_code"></div>
                </div>
                </div>
                <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('manager_food/infofoodtype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>
        </div>
        </form> 
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
   
  function check_record_capacity_name()
  {                         
    record_capacity_name = document.getElementById("RECORD_CAPACITY_NAME").value;             
          if (record_capacity_name==null || record_capacity_name==''){
          document.getElementById("record_capacity_name").style.display = "";     
          text_record_capacity_name = "*กรุณาระบุชื่อด้านที่ได้รับ";
          document.getElementById("record_capacity_name").innerHTML = text_record_capacity_name;
          }else{
          document.getElementById("record_capacity_name").style.display = "none";
          }
  } 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var record_capacity_name,text_record_capacity_name;
        
    record_capacity_name = document.getElementById("RECORD_CAPACITY_NAME").value;
     
    if (record_capacity_name==null || record_capacity_name==''){
    document.getElementById("record_capacity_name").style.display = "";     
    text_record_capacity_name = "*กรุณาระบุชื่อด้านที่ได้รับ";
    document.getElementById("record_capacity_name").innerHTML = text_record_capacity_name;
    }else{
    document.getElementById("record_capacity_name").style.display = "none";
    }
   
   

    if(record_capacity_name==null || record_capacity_name==''
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