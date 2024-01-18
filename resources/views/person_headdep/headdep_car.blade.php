@extends('layouts.headdep')
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

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลร้องขอใช้รถยนต์</B></h3>
<a href="#modal_allapp" data-toggle="modal"  class="btn btn-success" >อนุมัติทั้งหมด</a>
</div>
<div class="block-content block-content-full">
<form action="" method="post">
                                        @csrf

             <div class="row">

             <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                            
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                        <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="" readonly>
                  
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="" readonly>
                 
                    </div>
                    </div>

                </div>
                    <div class="col-md-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-md-2">
<span>

</span>
</div> 

<div class="col-md-0.5">
&nbsp;ค้นหา &nbsp;
</div>

<div class="col-md-2">
<span>

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="">

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
<div class="col-md-12" style=" font-size: 15px;">
ความเร่งด่วน :: 
<p class="fa fa-circle" style="color:#008000;  font-size: 15px;"></p> ปกติ


<p class="fa fa-circle" style="color:#87CEFA;  font-size: 15px;"></p> ด่วน


<p class="fa fa-circle" style="color:#FFA500;  font-size: 15px;"></p> ด่วนมาก

<p class="fa fa-circle" style="color:#FF4500;  font-size: 15px;"></p> ด่วนที่สุด &nbsp;&nbsp;&nbsp;&nbsp;


</div>
</div>
             <div class="table-responsive"> 
                          
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">สถานะ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ความเร่งด่วน</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ทะเบียน</th>
      
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">บันทึกไป</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">บันทึกกลับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่ไป</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">เวลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ถึงวันที่</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">เวลา</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;" width="10%">สถานที่ไป</th>                             
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%">เหตุผลการขอรถ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ผู้ร้องขอ</th>   
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center"  width="8%">อนุมัติ</th>    
                                        
                                    </tr >
                                </thead>
                                <tbody>
                                </tbody>
                                </table>
                                


@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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




    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection
