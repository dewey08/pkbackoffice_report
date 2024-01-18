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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทพัสดุ</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliestypekind') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
     <div class="col-lg-2">
      <label >ชนิดพัสดุ</label>
      </div>
      <div class="col-lg-3">
      <select name="SUP_TYPE_MASTER_ID" id="SUP_TYPE_MASTER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_sub_type_master_id();">
            <option value="">--กรุณาเลือกชนิดพัสดุ--</option>
             @foreach ($typemasters as $typemaster)  
             <option value="{{ $typemaster ->SUP_TYPE_MASTER_ID }}" >{{ $typemaster->SUP_TYPE_MASTER_NAME}}</option>
            @endforeach 
             </select>    
             <div style="color: red; font-size: 16px;" id="sub_type_master_id"></div>  
      </div>
      <div class="col-lg-2">
      <label >ชื่อประเภทพัสดุ</label>
      </div>
      <div class="col-lg-5">
      <input  name = "SUP_TYPE_KIND_NAME"  id="SUP_TYPE_KIND_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_sub_type_kind_name();">
      <div style="color: red; font-size: 16px;" id="sub_type_kind_name"></div>  
    </div>
     </div>
      <div class="row">
      <div class="col-lg-2">
      <label >คำอธิบาย</label>
      </div>
      <div class="col-lg-10">
      <input  name = "SUP_TYPE_KIND_DETAIL"  id="SUP_TYPE_KIND_DETAIL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_sub_type_kind_detail();">
      <div style="color: red; font-size: 16px;" id="sub_type_kind_detail"></div>  
    </div>     

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliestypekind')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
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
    function check_sub_type_master_id()
    {                         
        sub_type_master_id = document.getElementById("SUP_TYPE_MASTER_ID").value;             
            if (sub_type_master_id==null || sub_type_master_id==''){
            document.getElementById("sub_type_master_id").style.display = "";     
            text_sub_type_master_id = "*กรุณาเลือกชนิดพัสดุ";
            document.getElementById("sub_type_master_id").innerHTML = text_sub_type_master_id;
            }else{
            document.getElementById("sub_type_master_id").style.display = "none";
            }
    }
    function check_sub_type_kind_name()
    {                         
        sub_type_kind_name = document.getElementById("SUP_TYPE_KIND_NAME").value;             
            if (sub_type_kind_name==null || sub_type_kind_name==''){
            document.getElementById("sub_type_kind_name").style.display = "";     
            text_sub_type_kind_name = "*กรุณาเลือกชื่อประเภทพัสดุ";
            document.getElementById("sub_type_kind_name").innerHTML = text_sub_type_kind_name;
            }else{
            document.getElementById("sub_type_kind_name").style.display = "none";
            }
    }
    function check_sub_type_kind_detail()
    {                         
        sub_type_kind_detail = document.getElementById("SUP_TYPE_KIND_DETAIL").value;             
            if (sub_type_kind_detail==null || sub_type_kind_detail==''){
            document.getElementById("sub_type_kind_detail").style.display = "";     
            text_sub_type_kind_detail = "*กรุณาระบุคำอธิบาย";
            document.getElementById("sub_type_kind_detail").innerHTML = text_sub_type_kind_detail;
            }else{
            document.getElementById("sub_type_kind_detail").style.display = "none";
            }
    } 
   </script>
   <script>      
    $('form').submit(function () {
     
      var sub_type_master_id,text_sub_type_master_id; 
      var sub_type_kind_name,text_sub_type_kind_name; 
      var sub_type_kind_detail,text_sub_type_kind_detail;      
     
      sub_type_master_id = document.getElementById("SUP_TYPE_MASTER_ID").value; 
      sub_type_kind_name = document.getElementById("SUP_TYPE_KIND_NAME").value;
      sub_type_kind_detail = document.getElementById("SUP_TYPE_KIND_DETAIL").value;  
                
      if (sub_type_master_id==null || sub_type_master_id==''){
      document.getElementById("sub_type_master_id").style.display = "";     
      text_sub_type_master_id = "*กรุณาเลือกชนิดพัสดุ";
      document.getElementById("sub_type_master_id").innerHTML = text_sub_type_master_id;
      }else{
      document.getElementById("sub_type_master_id").style.display = "none";
      }
      if (sub_type_kind_name==null || sub_type_kind_name==''){
      document.getElementById("sub_type_kind_name").style.display = "";     
      text_sub_type_kind_name = "*กรุณาเลือกชื่อประเภทพัสดุ";
      document.getElementById("sub_type_kind_name").innerHTML = text_sub_type_kind_name;
      }else{
      document.getElementById("sub_type_kind_name").style.display = "none";
      }
      if (sub_type_kind_detail==null || sub_type_kind_detail==''){
      document.getElementById("sub_type_kind_detail").style.display = "";     
      text_sub_type_kind_detail = "*กรุณาระบุคำอธิบาย";
      document.getElementById("sub_type_kind_detail").innerHTML = text_sub_type_kind_detail;
      }else{
      document.getElementById("sub_type_kind_detail").style.display = "none";
      }
     
        
      if(sub_type_master_id==null || sub_type_master_id==''||
      sub_type_kind_name==null || sub_type_kind_name==''||
      sub_type_kind_detail==null || sub_type_kind_detail==''

       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection