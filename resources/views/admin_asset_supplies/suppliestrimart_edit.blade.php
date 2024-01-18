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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลไตรมาส</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliestrimart') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-1">
      <label >ไตรมาส</label>
      </div>
      <div class="col-lg-3">
      <input  name = "TRIMART_NAME"  id="TRIMART_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestrimart->TRIMART_NAME}}" onkeyup="check_trimartname();">
      <div style="color: red; font-size: 16px;" id="trimartname"></div> 
    </div>

      <div class="col-lg-2">
      <label >เริ่มต้นเดือน</label>
      </div>
      <div class="col-lg-2">
      <select name="MONTH_BEGIN" id="MONTH_BEGIN" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_monthbegin();">
            <option value="">--เลือกเดือน--</option>
             @foreach ($months as $month) 
                    @if($infosuppliestrimart->MONTH_BEGIN == $month ->MONTH_ID)
                    <option value="{{ $month ->MONTH_ID  }}" selected>{{ $month->MONTH_NAME}}</option>
                    @else
                    <option value="{{ $month ->MONTH_ID  }}">{{ $month->MONTH_NAME}}</option>
                    @endif
           
            @endforeach 
             </select> 
             <div style="color: red; font-size: 16px;" id="monthbegin"></div>     
      </div>

      <div class="col-lg-2">
      <label >สิ้นสุดเดือน</label>
      </div>
      <div class="col-lg-2">
      <select name="MONTH_END" id="MONTH_END" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_monthend();">
            <option value="">--เลือกเดือน--</option>
            @foreach ($months as $month)                                                     
                    @if($infosuppliestrimart->MONTH_END == $month ->MONTH_ID)
                    <option value="{{ $month ->MONTH_ID  }}" selected>{{ $month->MONTH_NAME}}</option>
                    @else
                    <option value="{{ $month ->MONTH_ID  }}">{{ $month->MONTH_NAME}}</option>
                    @endif
            @endforeach 
             </select>  
             <div style="color: red; font-size: 16px;" id="monthend"></div>   
      </div>
     
      <input type="hidden"  name = "TRIMART_ID"  id="TRIMART_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliestrimart->TRIMART_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliestrimart')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
    function check_trimartname()
    {                         
        trimartname = document.getElementById("TRIMART_NAME").value;             
            if (trimartname==null || trimartname==''){
            document.getElementById("trimartname").style.display = "";     
            text_trimartname = "*กรุณาระบุไตรมาศ";
            document.getElementById("trimartname").innerHTML = text_trimartname;
            }else{
            document.getElementById("trimartname").style.display = "none";
            }
    }
    function check_monthbegin()
    {                         
        monthbegin = document.getElementById("MONTH_BEGIN").value;             
            if (monthbegin==null || monthbegin==''){
            document.getElementById("monthbegin").style.display = "";     
            text_monthbegin = "*กรุณาระบุเริ่มต้นเดือน";
            document.getElementById("monthbegin").innerHTML = text_monthbegin;
            }else{
            document.getElementById("monthbegin").style.display = "none";
            }
    }
    function check_monthend()
    {                         
        monthend = document.getElementById("MONTH_END").value;             
            if (monthend==null || monthend==''){
            document.getElementById("monthend").style.display = "";     
            text_monthend = "*กรุณาระบุสิ้นสุดเดือน";
            document.getElementById("monthend").innerHTML = text_monthend;
            }else{
            document.getElementById("monthend").style.display = "none";
            }
    }

   </script>
    <script>      
    $('form').submit(function () {
     
      var trimartname,text_trimartname; 
      var monthbegin,text_monthbegin;
      var monthend,text_monthend;   
     
      trimartname = document.getElementById("TRIMART_NAME").value; 
      monthbegin = document.getElementById("MONTH_BEGIN").value;  
      monthend = document.getElementById("MONTH_END").value;
                     
      if (trimartname==null || trimartname==''){
      document.getElementById("trimartname").style.display = "";     
      text_trimartname = "*กรุณาระบุไตรมาศ";
      document.getElementById("trimartname").innerHTML = text_trimartname;
      }else{
      document.getElementById("trimartname").style.display = "none";
      }
  
      if (monthbegin==null || monthbegin==''){
      document.getElementById("monthbegin").style.display = "";     
      text_monthbegin = "*กรุณาระบุเริ่มต้นเดือน";
      document.getElementById("monthbegin").innerHTML = text_monthbegin;
      }else{
      document.getElementById("monthbegin").style.display = "none";
      }     
  
        if (monthend==null || monthend==''){
      document.getElementById("monthend").style.display = "";     
      text_monthend = "*กรุณาระบุสิ้นสุดเดือน";
      document.getElementById("monthend").innerHTML = text_monthend;
      }else{
      document.getElementById("monthend").style.display = "none";
      }     
  
      if(trimartname==null || trimartname==''||
      monthbegin==null || monthbegin==''||
      monthend==null || monthend==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection