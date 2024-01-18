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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลตึก อาคาร สถานที่ตั้ง</h2>    

    
        <form  method="post" action="{{ route('admin.savesupplieslocation') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ชื่อสถานที่</label>
      </div>
      <div class="col-lg-10">
      <input  name = "LOCATION_NAME"  id="LOCATION_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_localname();">
      <div style="color: red; font-size: 16px;" id="localname"></div> 
    </div>
      </div>
      <div class="row push">
      <div class="col-lg-2">
      <label >เบอร์ติดต่อ</label>
      </div>
      <div class="col-lg-4">
      <input  name = "LOCATION_PHONE"  id="LOCATION_PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_localphone();">
      <div style="color: red; font-size: 16px;" id="localphone"></div> 
    </div>

      <div class="col-lg-2">
      <label >ผู้รับผิดชอบ</label>
      </div>
      <div class="col-lg-4">
      <select name="PERSON_CONTACT_ID" id="PERSON_CONTACT_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_personcontactid();">
            <option value="">--เลือกผู้รับผิดชอบ--</option>
            @foreach ($persons as $person)                                                     
            <option value="{{ $person ->ID  }}">{{ $person->HR_FNAME}} {{ $person->HR_LNAME}}</option>
            @endforeach 
             </select>  
             <div style="color: red; font-size: 16px;" id="personcontactid"></div>   
      </div>
     

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsupplieslocation')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           

@endsection

@section('footer')

<script>   
    function check_localname()
    {                         
        localname = document.getElementById("LOCATION_NAME").value;             
            if (localname==null || localname==''){
            document.getElementById("localname").style.display = "";     
            text_localname = "*กรุณาระบุชื่อสถานที่";
            document.getElementById("localname").innerHTML = text_localname;
            }else{
            document.getElementById("localname").style.display = "none";
            }
    }
    function check_localphone()
    {                         
        localphone = document.getElementById("LOCATION_PHONE").value;             
            if (localphone==null || localphone==''){
            document.getElementById("localphone").style.display = "";     
            text_localphone = "*กรุณาระบุเบอร์ติดต่อ";
            document.getElementById("localphone").innerHTML = text_localphone;
            }else{
            document.getElementById("localphone").style.display = "none";
            }
    }
    function check_personcontactid()
    {                         
        personcontactid = document.getElementById("PERSON_CONTACT_ID").value;             
            if (personcontactid==null || personcontactid==''){
            document.getElementById("personcontactid").style.display = "";     
            text_personcontactid = "*เลือกผู้รับผิดชอบ";
            document.getElementById("personcontactid").innerHTML = text_personcontactid;
            }else{
            document.getElementById("personcontactid").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var localname,text_localname; 
      var localphone,text_localphone; 
      var personcontactid,text_personcontactid; 
     
      localname = document.getElementById("LOCATION_NAME").value; 
      localphone = document.getElementById("LOCATION_PHONE").value; 
      personcontactid = document.getElementById("PERSON_CONTACT_ID").value; 
   
                     
      if (localname==null || localname==''){
      document.getElementById("localname").style.display = "";     
      text_localname = "*กรุณาระบุชื่อสถานที่";
      document.getElementById("localname").innerHTML = text_localname;
      }else{
      document.getElementById("localname").style.display = "none";
      }
      if (localphone==null || localphone==''){
      document.getElementById("localphone").style.display = "";     
      text_localphone = "*กรุณาระบุเบอร์ติดต่อ";
      document.getElementById("localphone").innerHTML = text_localphone;
      }else{
      document.getElementById("localphone").style.display = "none";
      }
      if (personcontactid==null || personcontactid==''){
      document.getElementById("personcontactid").style.display = "";     
      text_personcontactid = "*เลือกผู้รับผิดชอบ";
      document.getElementById("personcontactid").innerHTML = text_personcontactid;
      }else{
      document.getElementById("personcontactid").style.display = "none";
      }
  
  
      if(localname==null || localname=='' ||
      localphone==null || localphone=='' ||
      personcontactid==null || personcontactid==''     
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection