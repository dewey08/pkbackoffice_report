@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />



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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลธุรการกลุ่มงาน</h2>    

    
        <form  method="post" action="{{ route('admin.updatebookdepartmentadmin') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-lg-2">
        <label >รหัส</label>
      </div>
      <div class="col-lg-2">
      <label >{{$infobookdepartmentadmin->HR_DEPARTMENT_ID}}</label >
      </div>
    <div class="col-lg-2">
      <label >ชื่อกลุ่มงาน</label>
      </div>
      <div class="col-lg-6">
      <label >{{$infobookdepartmentadmin->HR_DEPARTMENT_NAME}}</label >
      </div>
      </div>
      <div class="row push">
      <div class="col-lg-2">
      <label >เลขที่หนังสือ</label>
      </div>
      <div class="col-lg-2">
      <input  name = "BOOK_NUM"  id="BOOK_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infobookdepartmentadmin->BOOK_NUM}}">
      </div>
      <div class="col-lg-2">
      <label >ธุรการ</label>
      </div>
      <div class="col-lg-4">

      <select name="BOOK_HR_ID" id="BOOK_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        <option value="">--กรุณาเลือกเจ้าหน้าที่ธุรการ--</option>
                                                            @foreach ($PERSONALLs as $PERSONALL)  
                                                               @if( $infobookdepartmentadmin->BOOK_HR_ID == $PERSONALL ->ID)
                                                               <option value="{{ $PERSONALL ->ID  }}" selected>{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                               @else                                                   
                                                                <option value="{{ $PERSONALL ->ID  }}">{{ $PERSONALL->HR_FNAME}} {{$PERSONALL->HR_LNAME}}</option>
                                                               @endif
                                                            @endforeach 
        </select>    

      </div>
      </div>
      <input  type="hidden" name = "HR_DEPARTMENT_ID"  id="HR_DEPARTMENT_ID" class="form-control input-lg" value="{{$infobookdepartmentadmin->HR_DEPARTMENT_ID}}">
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_book/setupbookdepartmentadmin')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
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
</script>


@endsection