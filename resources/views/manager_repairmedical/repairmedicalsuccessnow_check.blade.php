@extends('layouts.repairmedical')
  
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
      p{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
         
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

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


?>
<?php

  function formateDatetime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $H= date("H",strtotime($strDate));
    $I= date("i",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];

  return  "$strDay $strMonthThai $strYear $H:$I";
    }
?>
<center>    
     <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

                <div class="block-header block-header-default ">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ดำเนินการสำเร็จแจ้งซ่อมเครื่องมือแพทย์ กรณีไม่ต้องการบันทึกรายละเอียดอย่างละเอียด</B></h3>
                </div>
                <div class="block-content block-content-full" align="left"> 

    
        <form  method="post" action="{{ route('mrepairmedical.repairmedicalsuccessnowupdate') }}" enctype="multipart/form-data">
        @csrf
     
       
        <div class="row">
       
        <div class="col-sm-2">
           <div class="form-group">
           <label >รหัสรายการ :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->REPAIR_ID }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันที่แจ้ง  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{formateDatetime($inforepairmedicaldetail->DATE_TIME_REQUEST) }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >อาคาร :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->BUILD_NAME}}</h1>
           </div>                               
       </div>    
       <div class="col-sm-2">
           <div class="form-group">
           <label >ชั้น :</label>
           </div>                               
       </div>  
       <div class="col-sm-2">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->LOCATION_LEVEL_NAME}}</h1>
           </div>                               
       </div>
       <div class="col-sm-1">
           <div class="form-group">
           <label >ห้อง :</label>
           </div>                               
       </div>  
       <div class="col-sm-2">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->LEVEL_ROOM_NAME}}</h1>
           </div>                               
       </div>
       </div>

       
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label>รหัสครุภัณฑ์ :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->ARTICLE_NUM}}</h1>
           </div>                               
       </div>  
       <div class="col-sm-2">
           <div class="form-group">
           <label>ชื่อครุภัณฑ์ :</label>
           </div>                               
       </div>  
       <div class="col-sm-5">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->ARTICLE_NAME}}</h1>
           </div>                               
       </div>    
      </div>
    
      
     
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >อาการ :</label>
           </div>                               
       </div>
       <div class="col-sm-10">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->SYMPTOM}}</h1>
           </div>                               
       </div> 
     
 
       </div>
     
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label > ผู้แจ้ง :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->USRE_REQUEST_NAME}}</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label > ฝ่าย/แผนก :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforepairmedicaldetail->HR_DEPARTMENT_SUB_SUB_NAME}}</h1>
           </div>                               
       </div> 
       
 
       </div>
     
      
       <input type="hidden"  name = "ID"  id="ID" value="{{ $inforepairmedicaldetailid->ID }} ">
      
      <input type="hidden" name = "CANCEL_MANAGER_EDIT_ID"  id="CANCEL_MANAGER_EDIT_ID" value="{{ $id_user }} ">
    
     
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>ยืนยันการดำเนินการสำเร็จ</button>
        
        <a href="{{ route('mrepairmedical.repairmedicalinfo')  }}" class="btn btn-hero-sm btn-hero-secondary" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a>
       
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
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


  
</script>



@endsection