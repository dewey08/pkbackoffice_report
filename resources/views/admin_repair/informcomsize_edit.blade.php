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
    
          
          .text-pedding{
       padding-left:10px;
                        }
    
            .text-font {
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
?>          
                    <!-- Advanced Tables -->               
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-content"> 
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขขนาด</h2> 
    <form  method="post" action="{{ route('admin.updateinformcomsize') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row push">
                            <div class="col-lg-2">
                                <label >ขนาด</label>
                            </div>
                            <div class="col-lg-4">
                                <input  name = "SIZE_NAME"  id="SIZE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomsizeT->SIZE_NAME}}" onkeyup="check_sizename();">
                                <div style="color: red; font-size: 16px;" id="sizename"></div> 
                            </div>
                            <div class="col-lg-6">
                                
                            </div>                       
                        <input type="hidden"  name = "SIZE_ID"  id="SIZE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoinformcomsizeT->SIZE_ID}}">
                    </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                        <a href="{{ url('admin_repair/Setupinformcomsize')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
                </div>  
            </div>
    </form>  
 
@endsection

@section('footer')

<script>   
    function check_sizename()
    {                         
        sizename = document.getElementById("SIZE_NAME").value;             
            if (sizename==null || sizename==''){
            document.getElementById("sizename").style.display = "";     
            text_sizename = "*กรุณาระบุขนาด";
            document.getElementById("sizename").innerHTML = text_sizename;
            }else{
            document.getElementById("sizename").style.display = "none";
            }
    }
 

   </script>
    <script>      
    $('form').submit(function () {
     
      var sizename,text_sizename; 
     
     
      sizename = document.getElementById("SIZE_NAME").value; 
     
   
                     
      if (sizename==null || sizename==''){
      document.getElementById("sizename").style.display = "";     
      text_sizename = "*กรุณาระบุขนาด";
      document.getElementById("sizename").innerHTML = text_sizename;
      }else{
      document.getElementById("sizename").style.display = "none";
      }
      
  
      if(sizename==null || sizename=='' 
         
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection