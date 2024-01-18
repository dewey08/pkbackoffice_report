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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลหมวด/ประเภทย่อยพัสดุ</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliestypesub') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >หมวด/ประเภทพัสดุ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "SUP_TYPE_SUP_NAME"  id="SUP_TYPE_SUP_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>

      <div class="col-lg-1">
      <label >ชนิด</label>
      </div>
      <div class="col-lg-2">
      <select name="SUP_TYPE_KIND_ID" id="SUP_TYPE_KIND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
            <option value="">--เลือกชนิด--</option>
             @foreach ($typekinds as $typekind)                                                     
            <option value="{{ $typekind ->SUP_TYPE_KIND_ID  }}">{{ $typekind->SUP_TYPE_KIND_NAME}}</option>
            @endforeach 
             </select>    
      </div>

      <div class="col-lg-2">
      <label >เลขอ้างอิง</label>
      </div>
      <div class="col-lg-2">
      <input  name = "SUP_TYPE_SUP_CODE"  id="SUP_TYPE_SUP_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>

      <input type="hidden" name = "SUP_TYPE_ID"  id="SUP_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$idtype}}">
      

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliestypesub/'.$idtype)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')





@endsection