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
      
                  table, td, th {
            border: 1px solid black;
            }  
    
       
</style>

<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลประกาศ</B></h3>
<a href="{{ url('manager_book/bookannounce/add') }}"  class="btn btn-info" >ลงรับประกาศ</a>
&nbsp;

<?php 
        if($search==''){$search_send='null';}else{$search_send=$search;} 
?>

<a href="{{ url('manager_book/bookannounce_excel/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$search_send) }}"  class="btn btn-success" >Excel</a>
</div>
<div class="block-content block-content-full">
<form method="post">
@csrf

<div class="row">
<div class="col-sm-0.5 col-form-label">
                            &nbsp;&nbsp;ปี พ.ศ. &nbsp;&nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                                <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget== $year_id)
                                    <option value="{{ $budget  }}" selected>{{ $budget}}</option>
                                @else
                                    <option value="{{ $budget  }}">{{ $budget}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
                    <div class="row">

<div class="col-sm">
                  &nbsp;&nbsp; วันที่ &nbsp;
                  </div>
                  <div class="col-sm-4">
                    @if($displaydate_bigen=='')
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($date) }}" readonly>
                    @else
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    @endif
                </div>
                <div class="col-sm">
                &nbsp;ถึง &nbsp;
                </div>
                <div class="col-sm-4">
                 @if($displaydate_end=='')
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($date) }}" readonly>
                  @else
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  @endif
                </div> 
                </div> 
                </div> 


<div class="col-sm-0.5">
&nbsp;ค้นหา &nbsp;
</div>

<div class="col-sm-2">
<span>

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

</span>
</div>

<div class="col-sm-30">
&nbsp;
</div> 
<div class="col-sm-1">
<span>
<button type="submit" class="btn btn-info" >ค้นหา</button>
</span> 
</div>


</div>  
</form>


<div class="table-responsive"> 

<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
         
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">File</th>
                       
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายละเอียด</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่รับ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">คำสั่ง</th>   
       
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookannounces as $infobookannounce)
                                <?php $number++;  ?>
                               
                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>

                                        @if($infobookannounce->BOOK_HAVE_FILE == 'True')
                                            <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookannounce->BOOK_FILE_NAME) ; ?>
                                                @if(file_exists($bookpdf))
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @else
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @endif
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif

                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookannounce->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookannounce->BOOK_DETAIL}}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($infobookannounce->DATE_SAVE)}}</td>


                                        
                                        
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="{{ url('manager_book/bookannounce/control/'.$infobookannounce->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_book/bookannounce/edit/'.$infobookannounce->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                 
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
                todayHighlight: true,
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectyear')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            todayHighlight: true,
                            thaiyear: true,
                            autoclose: true                         //Set เป็นปี พ.ศ.
                        });  //กำหนดเป็นวันปัจุบัน
                     }
             })
            // console.log(select);
             }        
     });
</script>
@endsection