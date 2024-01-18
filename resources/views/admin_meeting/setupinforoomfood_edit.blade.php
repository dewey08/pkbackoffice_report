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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลเมนู</h2>    

    
        <form  method="post" action="{{ route('admin.updateroomfood') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
       <div class="col-lg-1">
      <label >รายละเอียด</label>
      </div>
      <div class="col-lg-3">
      <input  name = "FOOD_NAME"  id="FOOD_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infofood->FOOD_NAME}}" onkeyup="check_food_name();">
      <div style="color: red; font-size: 16px;" id="food_name"></div>
    </div>
      <div class="col-lg-1">
      <label >ราคา</label>
      </div>
      <div class="col-lg-3">
      <input  name = "FOOD_PRICE"  id="FOOD_PRICE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infofood->FOOD_PRICE}}" onkeyup="check_food_price();">
      <div style="color: red; font-size: 16px;" id="food_price"></div>
    </div>
      <div class="col-lg-1">
      <label >หน่วย</label>
      </div>
      <div class="col-lg-3">
      <input  name = "FOOD_UNIT"  id="FOOD_UNIT"  class="form-control input-lg "  style=" font-family: 'Kanit', sans-serif;" value="{{$infofood->FOOD_UNIT}}"onkeyup="check_food_unit();">
      <div style="color: red; font-size: 16px;" id="food_unit"></div> 
    </div>
      </div>
      <div class="row push">
      <div class="col-lg-1">
      <label >ประเภท</label>
      </div>
      <div class="col-lg-3">
      <select name="FOOD_TYPE_ID" id="FOOD_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_food_type_id();">
                    <option value="">--กรุณาเลือกประเภทอาหาร--</option>
                        @foreach ($inforfoodtypes as $inforfoodtype)
                        @if($infofood->FOOD_TYPE_ID == $inforfoodtype ->FOOD_TYPE_ID )
                        <option value="{{ $inforfoodtype ->FOOD_TYPE_ID  }}" selected>{{ $inforfoodtype->FOOD_TYPE_NAME}}</option>
                        @else                                                     
                        <option value="{{ $inforfoodtype ->FOOD_TYPE_ID  }}">{{ $inforfoodtype->FOOD_TYPE_NAME}}</option>
                        @endif
                        @endforeach 
                    </select>
                    <div style="color: red; font-size: 16px;" id="food_type_id"></div> 
      </div>
     
 
   
    <input  type="hidden" name = "FOOD_ID"  id="FOOD_ID" class="form-control input-lg" value="{{$infofood->FOOD_ID}}">
      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
         <a href="{{ url('admin_meeting/setupinforoomfood')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
                    

@endsection

@section('footer')
<script>   
  function check_food_name()
  {                         
    food_name = document.getElementById("FOOD_NAME").value;             
          if (food_name==null || food_name==''){
          document.getElementById("food_name").style.display = "";     
          text_food_name = "*กรุณาระบุรายละเอียด";
          document.getElementById("food_name").innerHTML = text_food_name;
          }else{
          document.getElementById("food_name").style.display = "none";
          }
  }
  function check_food_price()
  {                         
    food_price = document.getElementById("FOOD_PRICE").value;             
          if (food_price==null || food_price==''){
          document.getElementById("food_price").style.display = "";     
          text_food_price = "*กรุณาระบุราคา";
          document.getElementById("food_price").innerHTML = text_food_price;
          }else{
          document.getElementById("food_price").style.display = "none";
          }
  } 
 
  function check_food_unit()
  {                         
    food_unit = document.getElementById("FOOD_UNIT").value;             
          if (food_unit==null || food_unit==''){
          document.getElementById("food_unit").style.display = "";     
          text_food_unit = "*กรุณาระบุหน่วย";
          document.getElementById("food_unit").innerHTML = text_food_unit;
          }else{
          document.getElementById("food_unit").style.display = "none";
          }
  } 
  function check_food_type_id()
  {                         
    food_type_id = document.getElementById("FOOD_TYPE_ID").value;             
          if (food_type_id==null || food_type_id==''){
          document.getElementById("food_type_id").style.display = "";     
          text_food_type_id = "*กรุณาเลือกประเภทอาหาร";
          document.getElementById("food_type_id").innerHTML = text_food_type_id;
          }else{
          document.getElementById("food_type_id").style.display = "none";
          }
  } 
    
</script>


<script> 
     
  $('form').submit(function () {
   
    var food_name,text_food_name;
    var food_price,text_food_price;
    var food_unit,text_food_unit;
    var food_type_id,text_food_type_id;
 
        
    food_name = document.getElementById("FOOD_NAME").value;
    food_price = document.getElementById("FOOD_PRICE").value;
    food_unit = document.getElementById("FOOD_UNIT").value;
    food_type_id = document.getElementById("FOOD_TYPE_ID").value;
      
      
    if (food_name==null || food_name==''){
    document.getElementById("food_name").style.display = "";     
    text_food_name = "*กรุณาระบุรายละเอียด";
    document.getElementById("food_name").innerHTML = text_food_name;
    }else{
    document.getElementById("food_name").style.display = "none";
    }
    if (food_price==null || food_price==''){
    document.getElementById("food_price").style.display = "";     
    text_food_price = "*กรุณาระบุราคา";
    document.getElementById("food_price").innerHTML = text_food_price;
    }else{
    document.getElementById("food_price").style.display = "none";
    }

    if (food_unit==null || food_unit==''){
    document.getElementById("food_unit").style.display = "";     
    text_food_unit = "*กรุณาระบุหน่วย";
    document.getElementById("food_unit").innerHTML = text_food_unit;
    }else{
    document.getElementById("food_unit").style.display = "none";
    }
    if (food_type_id==null || food_type_id==''){
    document.getElementById("food_type_id").style.display = "";     
    text_food_type_id = "*กรุณาเลือกประเภทอาหาร";
    document.getElementById("food_type_id").innerHTML = text_food_type_id;
    }else{
    document.getElementById("food_type_id").style.display = "none";
    }

    if(food_name==null || food_name==''||
    food_price==null || food_price==''||
    food_unit==null || food_unit==''||   
    food_type_id==null || food_type_id=='')
  {
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
  }
  }); 
</script>



@endsection