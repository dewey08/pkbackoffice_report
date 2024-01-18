@extends('layouts.backend_admin')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

use App\Models\Leaveover;

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

           
                   
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มกำหนดค่าวันลาพักผ่อน</h2>    

    
        <form  method="post" action="{{ route('setup.savevacation') }}" enctype="multipart/form-data">
        @csrf
        <div class="row push">
       
      <div class="col-lg-2">
      <label for="checkoldsSelect">เจ้าหน้าที่</label>
      </div>
      <div class="col-lg-3">
              <div class="input-group is-invalid">
                <div class="input-group-prepend">
                </div>
                    <select class="custom-select" name="PERSON_ID" id="checkoldsSelect" onchange="checkolds()" required>
                        <option value="">--กรุณาเลือกเจ้าหน้าที่--</option>
                              @foreach ($infopersons as $infoperson)   
                            <?php $countcheck =  Leaveover::where('PERSON_ID','=',$infoperson ->ID)->where('gleave_over.OVER_YEAR_ID','=',$yearbudget)->count();                             
                            ?>                        
                              @if($infoperson ->PERSON_ID == '' && $countcheck == 0  )
                                  <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                              @endif
                        @endforeach 
                    </select>
              </div>                
          <div class="invalid-feedback">
            Please select a valid state.
          </div>
      </div>
      <div class="col-lg-2">
      <label >วันลาปีงบประมาณนี้</label>
      </div>
      <div class="col-lg-1">
      <input  name = "DAY_LEAVE_OVER"  id="DAY_LEAVE_OVER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="10" readonly>
      </div>
      <div class="col-lg-1">
      <label >วัน</label>
      </div>
      <div class="col-lg-1">
      <label >ปีงบประมาณ</label>
      </div>
      <div class="col-lg-2">
          <select name="OVER_YEAR_ID" id="OVER_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="checkdatebegin();checkdateend();checkall();">
              @foreach ($budgetyears as $budgetyear) 
                      @if($budgetyear ->LEAVE_YEAR_ID == $yearbudget)
                      <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_ID }}</option>
                      @else
                      <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID }}</option>
                      @endif
              @endforeach 
          </select>
      </div>
      </div>
      <div class="row push">       
       <div class="col-lg-2">
       <label >อายุการทำงาน</label>
       </div>
       <div class="col-sm-1">
       {{-- <input  name = "OLDS"  id="OLDS" class="form-control input-lg showolds" style=" font-family: 'Kanit', sans-serif;" > --}}
       <div class="showolds"></div>
       </div>
       <div class="col-lg-2">
       <label >ปี</label>
       </div>


       <div class="col-lg-2">
          <label >วันลาสะสม</label>
        </div>
        <div class="col-lg-1">
          <input  name = "DAY_LEAVE_COLLECT"  id="DAY_LEAVE_COLLECT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)" required>
        </div>
        <div class="col-lg-1">
          <label >วัน</label>
        </div>

      
       <div class="col-lg-1.5">
       <label >ปีงบประมาณนี้ลาได้</label>
       </div>
       <div class="col-lg-1">
       <input  name = "DAY_LEAVE_OVER_BEFORE"  id="DAY_LEAVE_OVER_BEFORE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  OnKeyPress="return chkmunny(this)"  required>
       </div>
       <div class="col-lg-0.5">
       <label >วัน</label>
       </div>
   
 
       </div>
      
      
      
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" > <i class="fas fa-save mr-2"></i>  บันทึกข้อมูล</button>
         <a href="{{ url('admin_leave/setupinfovacation')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" > <i class="fas fa-window-close mr-2"></i>  ยกเลิก</a> 
         </div>    
       
        </div>
        </form>  
           
      
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
      $(document).ready(function() {
          $("select").select2();
      });
      $(document).ready(function () {            
          $('.datepicker').datepicker({
              format: 'dd/mm/yyyy',
              todayBtn: true,
              language: 'th',  //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย(ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
              thaiyear: true,  //Set เป็นปี พ.ศ.
              autoclose: true 
          });                  //กำหนดเป็นวันปัจุบัน      
      });
    
      function checkolds(number){  
          var PERSON_ID=document.getElementById("checkoldsSelect").value; 
          // alert(PERSON_ID);
          var _token=$('input[name="_token"]').val();
              $.ajax({
                    url:"{{route('setup.checkolds')}}",
                    method:"GET",
                    data:{PERSON_ID:PERSON_ID,_token:_token},
                    success:function(result){
                      $('.showolds').html(result);
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