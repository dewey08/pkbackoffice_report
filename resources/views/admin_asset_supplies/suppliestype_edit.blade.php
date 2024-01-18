@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลหมวดพัสดุ</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliestype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >หมวด/ประเภทพัสดุ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "SUP_TYPE_NAME"  id="SUP_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestype->SUP_TYPE_NAME}}" onkeyup="check_subtypename();">
      <div style="color: red; font-size: 16px;" id="subtypename"></div> 
    </div>

      <div class="col-lg-1">
      <label >ชนิด</label>
      </div>
      <div class="col-lg-2">
      <select name="SUP_TYPE_MASTER_ID" id="SUP_TYPE_MASTER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_subtypemasteid();">
            <option value="">--เลือกชนิด--</option>
             @foreach ($typemasters as $typemaster)   

                @if($infosuppliestype->SUP_TYPE_MASTER_ID == $typemaster ->SUP_TYPE_MASTER_ID )
                <option value="{{ $typemaster ->SUP_TYPE_MASTER_ID  }}" selected>{{ $typemaster->SUP_TYPE_MASTER_NAME}}</option>
                @else
                <option value="{{ $typemaster ->SUP_TYPE_MASTER_ID  }}">{{ $typemaster->SUP_TYPE_MASTER_NAME}}</option>
                @endif                                                  
          
            @endforeach 
             </select> 
             <div style="color: red; font-size: 16px;" id="subtypemasteid"></div>    
      </div>

      <input type="hidden" name = "SUP_TYPE_ID"  id="SUP_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestype->SUP_TYPE_ID}}">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliestype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_subtypename()
    {                         
        subtypename = document.getElementById("SUP_TYPE_NAME").value;             
            if (subtypename==null || subtypename==''){
            document.getElementById("subtypename").style.display = "";     
            text_subtypename = "*กรุณาระบุหมวด/ประเภทพัสดุ";
            document.getElementById("subtypename").innerHTML = text_subtypename;
            }else{
            document.getElementById("subtypename").style.display = "none";
            }
    }
    function check_subtypemasteid()
    {                         
        subtypemasteid = document.getElementById("SUP_TYPE_MASTER_ID").value;             
            if (subtypemasteid==null || subtypemasteid==''){
            document.getElementById("subtypemasteid").style.display = "";     
            text_subtypemasteid = "*กรุณาเลือกชนิด";
            document.getElementById("subtypemasteid").innerHTML = text_subtypemasteid;
            }else{
            document.getElementById("subtypemasteid").style.display = "none";
            }
    }
   
   </script>
    <script>      
    $('form').submit(function () {
     
      var subtypename,text_subtypename; 
      var subtypemasteid,text_subtypemasteid;    
     
      subtypename = document.getElementById("SUP_TYPE_NAME").value; 
      subtypemasteid = document.getElementById("SUP_TYPE_MASTER_ID").value; 
                
      if (subtypename==null || subtypename==''){
      document.getElementById("subtypename").style.display = "";     
      text_subtypename = "*กรุณาระบุหมวด/ประเภทพัสดุ";
      document.getElementById("subtypename").innerHTML = text_subtypename;
      }else{
      document.getElementById("subtypename").style.display = "none";
      }
      if (subtypemasteid==null || subtypemasteid==''){
      document.getElementById("subtypemasteid").style.display = "";     
      text_subtypemasteid = "*กรุณาเลือกชนิด";
      document.getElementById("subtypemasteid").innerHTML = text_subtypemasteid;
      }else{
      document.getElementById("subtypemasteid").style.display = "none";
      }     
        
      if(subtypename==null || subtypename==''||
      subtypemasteid==null || subtypemasteid==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection