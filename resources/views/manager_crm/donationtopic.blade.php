@extends('layouts.crm')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@section('content')

<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }

      
      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
      
      .form-control{
    font-size: 13px;
                  }   

                  table, td, th {
            border: 1px solid black;
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
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
  
?>         

<center>    
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
         
                <div class="block-header block-header-default">
                    <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>หัวข้อการรับบริจาค</B></h3>
                    &nbsp;&nbsp;
              
                    <a href="{{ url('manager_crm/donationtopic_add')}}"  class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fas fa-plus mr-2"></i> เพิ่มข้อมูล</a>
                </div>  
           
            <div class="block-content block-content-full">

       
            <form action="{{ route('mcrm.donationtopicsearch' )}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2">
     
                    </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm text-right">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm text-right">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>

<div class="col-sm-0.5 text-right">
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
<div class="col-sm-1.5 text-left">
<span>
<button type="submit" class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
</span> 
</div>


              
                  </div>  
             </form>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="6%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >หัวข้อการรับบริจาค</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >เป้าหมายเงิน</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="11%">วันที่เริ่มรับ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="10%">วันที่สิ้นสุด</th>                                                                              
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                   
                    <?php $number = 0; ?>
                        @foreach ($donationtopics as $donationtopic)
                        <?php $number++; ?>
                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>                        
                        <td class="text-font text-pedding" >{{$donationtopic->DONATIONTOPIC_NAME}}</td>  
                        <td class="text-font text-pedding" >{{$donationtopic->DONATIONTOPIC_TARGET}}</td>   
                        <td class="text-font text-pedding" >{{DateThai($donationtopic->DONATIONTOPIC_DATE_START)}}</td>  
                        <td class="text-font text-pedding" >{{DateThai($donationtopic->DONATIONTOPIC_DATE_END)}}</td> 
                        <td align="center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button>
                            <div class="dropdown-menu" style="width:10px">                           
                                    <a class="dropdown-item loadscreen"  href="{{ url('manager_crm/donationtopic_edit/'.$donationtopic->DONATIONTOPIC_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไข</a>
                                    <a class="dropdown-item "  href="{{ url('manager_crm/donationtopic/destroy/'.$donationtopic->DONATIONTOPIC_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="return confirm('คุณต้องการที่จะลบ {{ $donationtopic->DONATIONTOPIC_ID}} ใช่หรือไม่ ?')">ลบ</a>
                                </div>
                            </div>
                        </td> 
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

    <!-- Page JS Plugins -->
    <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

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
</script>

@endsection