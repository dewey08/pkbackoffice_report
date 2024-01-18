@extends('layouts.book')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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



use App\Http\Controllers\DashboardController;


$idbook = $infobookoutview->BOOK_ID;
$checkbook = DashboardController::checkbook($id_user);




?>
<?php

  $m_budget = date("m");
  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
            }

            .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 14px;
                  }   
      }


  
#pages{
    text-align: center;
}
.page{
    width: 90%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}
@keyframes pageIn{
  0%{
      transform: translateX(-300px);
      opacity: 0;
  }
  100%{
      transform: translateX(0px);
      opacity: 1;
  }
}
#zoom-in{
    
}
#zoom-percent{
    display: inline-block;
}
#zoom-percent::after{
    content: "%";
}
#zoom-out{
    
}
      
       
</style>

<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;text-align: left; font-size:16px;" >
<div class="row">
<div class="col-md-10" style="text-align: left">
 <B>เลขส่ง</B> {{$infobookoutview->BOOK_NUM_OUT}}     <B>เลขหนังสือ</B> {{$infobookoutview->BOOK_NUMBER}}     <B>ความเร่งด่วน</B> {{$infobookoutview->INSTANT_NAME}}      <B>ส่งไปที่หน่วยงาน</B> {{$infobookoutview->RECORD_ORG_NAME}} 
  </div>
  <div class="col" style="text-align: right">
 <a  href="{{ url('manager_book/bookout') }}" class="btn btn-success btn-lg"  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;">กลับหน้าแสดงข้อมูล</a>
 </div>
 </div>
 </h3> 
 
</div>

  
<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-12" style="text-align: left">
 
   <div style="text-align:center">

   @if($infobookoutview->BOOK_FILE_NAME == '' || $infobookoutview->BOOK_FILE_NAME == null)
         ไม่มีข้อมูลไฟล์อัปโหลด 
   @else
   <?php list($a,$b,$c,$d) = explode('/',$url); ?>
    <iframe src="http://{{$c}}/{{$d}}/storage/app/public/bookpdf/{{ $infobookoutview->BOOK_FILE_NAME }}" height="100%" width="100%"></iframe>

   @endif

  
</div>
   </div>
   </div>
   </div>

</div>
</div>

<!---================================================================--->
 
@endsection

@section('footer')

<script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>


<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script type="text/javascript">
    PDFJS.workerSrc = "{{ asset('pdfupload/pdf_upwork.js') }}";
</script>



@endsection