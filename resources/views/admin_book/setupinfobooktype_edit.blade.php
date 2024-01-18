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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลประเภทหนังสือ</h2>    

    
        <form  method="post" action="{{ route('admin.updatebooktype') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ประเภทหนังสือ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "BOOK_TYPE_NAME"  id="BOOK_TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infobooktype->BOOK_TYPE_NAME}}" onkeyup="check_book_type_name();">
      <div style="color: red; font-size: 16px;" id="book_type_name"></div>
    </div>
    
      <input  type="hidden" name = "BOOK_TYPE_ID"  id="BOOK_TYPE_ID" class="form-control input-lg" value="{{$infobooktype->BOOK_TYPE_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_book/setupbooktype')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  

@endsection

@section('footer')

<script>
   
    function check_book_type_name()
    {                         
        book_type_name = document.getElementById("BOOK_TYPE_NAME").value;             
            if (book_type_name==null || book_type_name==''){
            document.getElementById("book_type_name").style.display = "";     
            text_book_type_name = "*กรุณาระบุประเภทหนังสือ";
            document.getElementById("book_type_name").innerHTML = text_book_type_name;
            }else{
            document.getElementById("book_type_name").style.display = "none";
            }
    }
   
   
   </script>
   <script>      
    $('form').submit(function () {
     
      var book_type_name,text_book_type_name;
      
     
      book_type_name = document.getElementById("BOOK_TYPE_NAME").value;
     
                
       
      if (book_type_name==null || book_type_name==''){
      document.getElementById("book_type_name").style.display = "";     
      text_book_type_name = "*กรุณาระบุประเภทหนังสือ";
      document.getElementById("book_type_name").innerHTML = text_book_type_name;
      }else{
      document.getElementById("book_type_name").style.display = "none";
      }
     
        
      if(book_type_name==null || book_type_name==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
  </script>


<script>

@endsection