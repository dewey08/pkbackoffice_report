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
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลจัดซื้อจัดจ้าง</B></h3>
<a href=""  class="btn btn-info" >ออกเลขจัดซื้อจัดจ้าง</a>
</div>
<div class="block-content block-content-full">
<form action="#" method="post">
@csrf

<div class="row">


<div class="col-md-0.5">
                  &nbsp;&nbsp; วันที่ &nbsp;
                  </div>
                  <div class="col-md-2">
                  <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                </div>
                <div class="col-md-0.5">
                &nbsp;ถึง &nbsp;
                </div>
                <div class="col-md-2">
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                 </div> 
            

<div class="col-md-0.5">
&nbsp;สถานะ &nbsp;
</div>

<div class="col-md-2">
<span>

<select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
<option value="">--ทั้งหมด--</option>

</select>
</span>
</div> 

<div class="col-md-0.5">
&nbsp;ค้นหา &nbsp;
</div>

<div class="col-md-2">
<span>

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >
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
สถานะ :: 
<p class="fa fa-circle" style="color:#FF6347;"></p> {{$infobookstatus1->BOOK_STATUS_NAME}}


<p class="fa fa-circle" style="color:#FFFF00;"></p> {{$infobookstatus2->BOOK_STATUS_NAME}}


<p class="fa fa-circle" style="color:#9ACD32;"></p> {{$infobookstatus3->BOOK_STATUS_NAME}}
</div>
</div>
<div class="table-responsive"> 
<!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
         
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">File</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ความเร่งด่วน</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">สถานะ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เลขรับ</th>                    
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">เลขหนังสือ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่รับ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center"  width="12%">คำสั่ง</th>   
       
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookpurchases as $infobookpurchase)
                                <?php $number++;  ?>
                               
                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>

                                        @if($infobookpurchase->BOOK_HAVE_FILE == 'True')
                                            <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookpurchase->BOOK_FILE_NAME) ; ?>
                                                @if(file_exists($bookpdf))
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @else
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @endif
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                                        @if($infobookpurchase->BOOK_URGENT_ID == 1)
                                        <td  align="center"><span class="btn si si-book-open" style="background-color:#32CD32;color:#F0FFFF;"></span></td>
                                        @elseif($infobookpurchase->BOOK_URGENT_ID == 2)
                                        <td  align="center"><span class="btn si si-book-open" style="background-color:#F0E68C;color:#F0FFFF;"></span></td>
                                        @elseif($infobookpurchase->BOOK_URGENT_ID == 3)
                                        <td  align="center"><span class="btn si si-book-open" style="background-color:#FFA500;color:#F0FFFF;"></span></td>
                                        @elseif($infobookpurchase->BOOK_URGENT_ID == 4)
                                        <td  align="center"><span class="btn si si-book-open" style="background-color:#FF4500;color:#F0FFFF;"></span></td>
                                        
                                        @endif

                                        @if($infobookpurchase->SEND_STATUS == '1')
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FF6347;"></span></td>
                                        @elseif($infobookpurchase->SEND_STATUS == '2')
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FFFF00;"></span></td>
                                        @elseif($infobookpurchase->SEND_STATUS == '3')
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#9ACD32;"></span></td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif

                                        <td class="text-font" align="center" >{{ $infobookpurchase->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" >{{ $infobookpurchase->BOOK_NUMBER}}</td>
                                        <td class="text-font text-pedding" >{{ $infobookpurchase->BOOK_NAME}}</td>
                                        <td class="text-font" align="center">{{ DateThai($infobookpurchase->DATE_SAVE)}}</td>


                                        
                                        
                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $infobookpurchase -> ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                 
                                                    <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เสนอผู้อำนวยการ</a>
                                                 
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>
                                    @endforeach  
   </tbody>
</table>

</div>
</div>
</div>



</div>






 
@endsection

@section('footer')

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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>
@endsection