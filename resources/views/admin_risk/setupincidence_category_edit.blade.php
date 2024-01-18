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

function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  
  return $strDay."/".$strMonth."/".$strYear;
  }
?>

           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลประเภทอุบัติการณ์ความเสี่ยง</h2>    

    
        <form  method="post" action="{{ route('srisk.setupincidence_category_update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2 text-right">

      <label >ประเภทอุบัติการความเสี่ยง :</label>
      </div>
      <div class="col-lg-10">
      <input value="{{ $incidencecategorys->INCIDENCE_CATEGORY_NAME }}"  name = "INCIDENCE_CATEGORY_NAME"  id="INCIDENCE_CATEGORY_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_record_capacity_name();">
      <div style="color: red; font-size: 16px;" id="record_capacity_name"></div>
    </div>
 
    <input type="hidden" value="{{$incidencecategorys->INCIDENCE_CATEGORY_ID  }}"  name = "INCIDENCE_CATEGORY_ID"  id="INCIDENCE_CATEGORY_ID" class="form-control input-lg"  >

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_risk/setupincidence_category')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
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
    record_capacity_name = document.getElementById("INCIDENCE_CATEGORY_NAME").value;             
          if (record_capacity_name==null || record_capacity_name==''){
          document.getElementById("record_capacity_name").style.display = "";     
          text_record_capacity_name = "*กรุณาระบุข้อมูล";
          document.getElementById("record_capacity_name").innerHTML = text_record_capacity_name;
          }else{
          document.getElementById("record_capacity_name").style.display = "none";
          }
  } 
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var record_capacity_name,text_record_capacity_name;
        
    record_capacity_name = document.getElementById("INCIDENCE_CATEGORY_NAME").value;
     
    if (record_capacity_name==null || record_capacity_name==''){
    document.getElementById("record_capacity_name").style.display = "";     
    text_record_capacity_name = "*กรุณาระบุข้อมูล";
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
                language: 'th',            
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

</script>



@endsection