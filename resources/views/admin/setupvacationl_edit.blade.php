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

label{
            font-family: 'Kanit', sans-serif;
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


  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }


?>

     <body onload="checkolds_input()">      
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> แก้ไขกำหนดค่าวันลาพักผ่อน</h2>    

    
        <form  method="post" action="{{ route('setup.updatevacation') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-2">
      <label >เจ้าหน้าที่</label>
      </div>
      <div class="col-lg-3">
      <input type="hidden" name="PERSON_ID" id="PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infoleaveover->PERSON_ID}}" readonly>
    
            @foreach ($infopersons as $infoperson) 
                    @if($infoleaveover->PERSON_ID == $infoperson ->ID )
                    <label>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</label>
                    @endif
               
            @endforeach 
      </select>
      </div>
      <div class="col-lg-2">
      <label >วันลาปีงบประมาณนี้</label>
      </div>
      <div class="col-lg-1">
      <input  name = "DAY_LEAVE_OVER"  id="DAY_LEAVE_OVER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoleaveover->DAY_LEAVE_OVER}}">
      </div>
      <div class="col-lg-1">
      <label >วัน</label>
      </div>
      <div class="col-lg-1">
      <label >ปีงบประมาณ</label>
      </div>
      <div class="col-lg-2">

     <input type="hidden" name="OVER_YEAR_ID" id="OVER_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  value="{{$infoleaveover->OVER_YEAR_ID}}" readonly>
     <label >{{$infoleaveover->OVER_YEAR_ID}}</label>
                                        
      </div>

      </div>

      <div class="row push">
       
       <div class="col-lg-2">
       <label >อายุการทำงาน</label>
       </div>
       <div class="col-lg-2 showolds_input">
      

       </div>
       <div class="col-lg-1">
       <label >ปี</label>
       </div>
       

       <div class="col-lg-2">
        <label >วันลาสะสม</label>
      </div>
      <div class="col-lg-1">
        <input  name = "DAY_LEAVE_COLLECT"  id="DAY_LEAVE_COLLECT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="caldate()" OnKeyPress="return chkmunny(this)" value="{{ number_format($infoleaveover->DAY_LEAVE_COLLECT,1)}}">
      </div>
      <div class="col-lg-1">
        <label >วัน</label>
      </div>

    
     <div class="col-lg-1.5">
     <label >ปีงบประมาณนี้ลาได้</label>
     </div>
     <div class="col-lg-1 caldateinput">
     <input  name = "DAY_LEAVE_OVER_BEFORE"  id="DAY_LEAVE_OVER_BEFORE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)" value="{{ number_format($infoleaveover->DAY_LEAVE_OVER_BEFORE,1)}}">
     </div>
     <div class="col-lg-0.5">
     <label >วัน</label>
     </div>
      
    </div>
    
       <input type="hidden" name = "ID"  id="ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infoleaveover->ID}}">
      
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
         <a href="{{ url('admin_leave/setupinfovacation')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    


function checkolds_input(){  
          var PERSON_ID=document.getElementById("PERSON_ID").value; 
          // alert(PERSON_ID);
          var _token=$('input[name="_token"]').val();
              $.ajax({
                    url:"{{route('setup.checkolds_input')}}",
                    method:"GET",
                    data:{PERSON_ID:PERSON_ID,_token:_token},
                    success:function(result){
                      $('.showolds_input').html(result);
                    }
              })   
      }


      function caldate(){  
          var PERSON_ID=document.getElementById("PERSON_ID").value; 
          var DAY_LEAVE_COLLECT=document.getElementById("DAY_LEAVE_COLLECT").value; 
          var _token=$('input[name="_token"]').val();
              $.ajax({
                    url:"{{route('setup.caldate')}}",
                    method:"GET",
                    data:{PERSON_ID:PERSON_ID,DAY_LEAVE_COLLECT:DAY_LEAVE_COLLECT,_token:_token},
                    success:function(result){
                      $('.caldateinput').html(result);
                    }
              })   
      }


      function chkmunny(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
                ele.onKeyPress = vchar;
        }

</script>



@endsection