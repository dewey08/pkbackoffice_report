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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มข้อมูลประเภทงบประมาณ</h2>    

    
        <form  method="post" action="{{ route('admin.savesuppliestypebudget') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
    <div class="col-lg-2">
      <label >ประเภทงบประมาณ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "BUDGET_NAME"  id="BUDGET_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_budgetname();">
      <div style="color: red; font-size: 16px;" id="budgetname"></div> 
    </div>
    <div class="col-lg-2">
      <label >เลขงบประมาณ</label>
      </div>
      <div class="col-lg-3">
      <input  name = "BUDGET_NUM"  id="BUDGET_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_budgetnum();">
      <div style="color: red; font-size: 16px;" id="budgetnum"></div> 
    </div>

      </div></div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_asset_supplies/setupsuppliestypebudget')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
        
                  
      
                      

@endsection

@section('footer')

<script>   
  function check_budgetname()
  {                         
    budgetname = document.getElementById("BUDGET_NAME").value;             
          if (budgetname==null || budgetname==''){
          document.getElementById("budgetname").style.display = "";     
          text_budgetname = "*กรุณาระบุประเภทงบประมาณ";
          document.getElementById("budgetname").innerHTML = text_budgetname;
          }else{
          document.getElementById("budgetname").style.display = "none";
          }
  }
  function check_budgetnum()
  {                         
    budgetnum = document.getElementById("BUDGET_NUM").value;             
          if (budgetnum==null || budgetnum==''){
          document.getElementById("budgetnum").style.display = "";     
          text_budgetnum = "*กรุณาระบุเลขงบประมาณ";
          document.getElementById("budgetnum").innerHTML = text_budgetnum;
          }else{
          document.getElementById("budgetnum").style.display = "none";
          }
  }
 
 </script>
 <script>      
  $('form').submit(function () {
   
    var budgetname,text_budgetname; 
    var budgetnum,text_budgetnum;    
   
    budgetname = document.getElementById("BUDGET_NAME").value; 
    budgetnum = document.getElementById("BUDGET_NUM").value; 
              
    if (budgetname==null || budgetname==''){
    document.getElementById("budgetname").style.display = "";     
    text_budgetname = "*กรุณาระบุประเภทงบประมาณ";
    document.getElementById("budgetname").innerHTML = text_budgetname;
    }else{
    document.getElementById("budgetname").style.display = "none";
    }
    if (budgetnum==null || budgetnum==''){
    document.getElementById("budgetnum").style.display = "";     
    text_budgetnum = "*กรุณาระบุเลขงบประมาณ";
    document.getElementById("budgetnum").innerHTML = text_budgetnum;
    }else{
    document.getElementById("budgetnum").style.display = "none";
    }     
      
    if(budgetname==null || budgetname==''||
    budgetnum==null || budgetnum==''
     )
  {
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
  }
  }); 
</script>



@endsection