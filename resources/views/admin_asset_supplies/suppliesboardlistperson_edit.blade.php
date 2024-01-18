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
            font-size: 10px;
            font-size: 1.0rem;
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> แก้ไขข้อมูลกรรมการ</h2>    

    
        <form  method="post" action="{{ route('admin.updatesuppliesboardlistperson') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ชื่อกรรมการ</label>
      </div>
      <div class="col-lg-4">
      <select name="HR_ID" id="HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_hrid();">
            <option value="">--กรุณาเลือกกรรมการ--</option>
             @foreach ($persons as $person)  

             @if($infosuppliesboardlistperson->HR_ID == $person->ID )                                                   
                <option value="{{ $person->ID  }}" selected>{{ $person->HR_FNAME}} {{$person->HR_LNAME}}</option>
            @else
                <option value="{{ $person->ID  }}">{{ $person->HR_FNAME}} {{$person->HR_LNAME}}</option>
            @endif

            @endforeach 
             </select> 
             <div style="color: red; font-size: 16px;" id="hrid"></div>   
      </div>

      <div class="col-lg-1">
      <label >ตำแหน่ง</label>
      </div>
      <div class="col-lg-3">
      <select name="SUP_POSITION_ID" id="SUP_POSITION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_subpositionid()();">
            <option value="">--กรุณาเลือกตำแหน่ง--</option>
             @foreach ($subpositions as $subposition)
                @if($infosuppliesboardlistperson->SUP_POSITION_ID == $subposition ->POSITION_ID)
                    <option value="{{ $subposition ->POSITION_ID  }}" selected>{{ $subposition->POSITION_NAME}}</option>
                @else
                    <option value="{{ $subposition ->POSITION_ID  }}">{{ $subposition->POSITION_NAME}}</option>
                @endif                                                     
            
            @endforeach 
             </select> 
             <div style="color: red; font-size: 16px;" id="subpositionid"></div>   
      </div>

    

      <input type="hidden" name = "BOARD_GROUP_ID"  id="BOARD_GROUP_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$idlist}}">
      <input type="hidden" name = "ID"  id="ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesboardlistperson->ID}}">

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliesboardlistperson/'.$idlist)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
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

    function check_hrid()
    {                         
        hrid = document.getElementById("HR_ID").value;             
            if (hrid==null || hrid==''){
            document.getElementById("hrid").style.display = "";     
            text_hrid = "*กรุณาเลือกกรรมการ";
            document.getElementById("hrid").innerHTML = text_hrid;
            }else{
            document.getElementById("hrid").style.display = "none";
            }
    }
    function check_subpositionid()
    {                         
        subpositionid = document.getElementById("SUP_POSITION_ID").value;             
            if (subpositionid==null || subpositionid==''){
            document.getElementById("subpositionid").style.display = "";     
            text_subpositionid = "*กรุณาเลือกตำแหน่ง";
            document.getElementById("subpositionid").innerHTML = text_subpositionid;
            }else{
            document.getElementById("subpositionid").style.display = "none";
            }
    }
    

   </script>
    <script>      
    $('form').submit(function () {
     
      var hrid,text_hrid;

      hrid = document.getElementById("HR_ID").value;    
                     
      if (hrid==null || hrid==''){
      document.getElementById("hrid").style.display = "";     
      text_hrid = "*กรุณาเลือกกรรมการ";
      document.getElementById("hrid").innerHTML = text_hrid;
      }else{
      document.getElementById("hrid").style.display = "none";
      }

      var subpositionid,text_subpositionid;
            
      subpositionid = document.getElementById("SUP_POSITION_ID").value;    
                     
      if (subpositionid==null || subpositionid==''){
      document.getElementById("subpositionid").style.display = "";     
      text_subpositionid = "*กรุณาเลือกตำแหน่ง";
      document.getElementById("subpositionid").innerHTML = text_subpositionid;
      }else{
      document.getElementById("subpositionid").style.display = "none";
      }
  
  
      if(hrid==null || hrid=='' ||
      subpositionid==null || subpositionid==''   
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>



@endsection