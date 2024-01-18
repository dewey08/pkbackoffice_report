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
$checkbook = DashboardController::checkbook($id_user);

?>
<?php
  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
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
    font-size: 13px;
                  }   
                  .form-control {
    font-size: 13px;
                  }   
      
       
</style>

<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนรับจำหน่าย</B></h3>

</div>
<div class="block-content block-content-full">
<form action="" method="post">
@csrf

<div class="row">


<div class="col-md-0.5">
                  &nbsp;&nbsp; วันที่ &nbsp;
                  </div>
                  <div class="col-md-2">
                    @if($displaydate_bigen=='')
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($date) }}" readonly>
                    @else
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    @endif
                </div>
                <div class="col-md-0.5">
                &nbsp;ถึง &nbsp;
                </div>
                <div class="col-md-2">
                 @if($displaydate_end=='')
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($date) }}" readonly>
                  @else
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  @endif
                </div> 
            

<div class="col-md-0.5">
&nbsp;สถานะ &nbsp;
</div>

<div class="col-md-2">
<span>
<select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
<option value="">--ทั้งหมด--</option>
@foreach ($infobook_sendstatuss as $infobook_sendstatus)
      @if($infobook_sendstatus->BOOK_STATUS_ID == $status_check)
      <option value="{{ $infobook_sendstatus->BOOK_STATUS_ID  }}" selected>{{ $infobook_sendstatus->BOOK_STATUS_NAME}}</option>
      @else
      <option value="{{ $infobook_sendstatus->BOOK_STATUS_ID  }}">{{ $infobook_sendstatus->BOOK_STATUS_NAME}}</option>
      @endif
  
                                                                           
@endforeach 

</select>
</span>
</div> 

<div class="col-md-0.5">
&nbsp;ค้นหา &nbsp;
</div>

<div class="col-md-2">
<span>

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

</span>
</div>

<div class="col-md-30">
&nbsp;
</div> 
<div class="col-md-1">
<span>
<button type="submit" class="btn btn-info" >ค้นหา</button>
</span> 
</div>


</div>  
</form>
<div class="row">
<div class="col-md-4">
ชั้นความเร็ว :: 
<p class="fa fa-circle" style="color:#008000;"></p> ปกติ


<p class="fa fa-circle" style="color:#87CEFA;"></p> ด่วน


<p class="fa fa-circle" style="color:#FFA500;"></p> ด่วนมาก

<p class="fa fa-circle" style="color:#FF4500;"></p> ด่วนที่สุด
</div>
</div>
<div class="table-responsive" style="height:500px;"> 
<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
         
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">File</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ชั้นความเร็ว</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">สถานะ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เลขรับ</th>                    
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">เลขหนังสือ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่รับ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center"  width="12%">คำสั่ง</th>   
       
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookreceipts as $infobookreceipt)
                                <?php $number++;  ?>
                               
                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        @if($infobookreceipt->BOOK_HAVE_FILE == 'True')
                                            <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookreceipt->BOOK_FILE_NAME) ; ?>
                                                    @if(file_exists($bookpdf))
                                                    <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                    @else
                                                    <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                    @endif
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                                        @if($infobookreceipt->BOOK_URGENT_ID == 1)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td> 
                                        @elseif($infobookreceipt->BOOK_URGENT_ID == 2)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($infobookreceipt->BOOK_URGENT_ID == 3)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>         
                                        @elseif($infobookreceipt->BOOK_URGENT_ID == 4)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                                        
                                        @endif

                                        @if($infobookreceipt->SEND_STATUS == '1')
                                        <td  align="center"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($infobookreceipt->SEND_STATUS == '2')
                                        <td  align="center"><span class="badge badge-warning" >นำเสนอ</span></td>
                                        @elseif($infobookreceipt->SEND_STATUS == '3')
                                        <td  align="center"><span class="badge badge-success" >ผอ.เกษียณ</span></td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif

                                        <td class="text-font" align="center" >{{ $infobookreceipt->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" >{{ $infobookreceipt->BOOK_NUMBER}}</td>
                                        <td class="text-font text-pedding" >{{ $infobookreceipt->BOOK_NAME}}</td>
                                        <td class="text-font" align="center">{{ DateThai($infobookreceipt->DATE_SAVE)}}</td>


                                        
                                        
                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">

                                                    <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                                                    <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                 
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>

</body>
     
     
    </div>
  </div>
</div>


@endforeach  
   </tbody>
</table>

</div>
</div>
</div>



</div>






 
@endsection

@section('footer')


<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


</script>
@endsection