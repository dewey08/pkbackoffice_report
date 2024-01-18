@extends('layouts.warehouse')
   
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
      font-size: 14px;
    
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
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
                  .form-control {
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

?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
  
?>
<body onload="detaillast()">
  <div class="block-content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติการขอเบิกพัสดุ รพสต.</B></h3>
            <br>
        </div>
        <br>
        <div class="block-content">
        <form  method="post" action="{{ route('mwarehouse.updatewarehouserequestlastapp_small') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name = "WAREHOUSE_ID"  id="WAREHOUSE_ID"  value="{{$inforwarehouserequest -> WAREHOUSE_ID}}">
             
             <div id="detaillastappall{{$inforwarehouserequest -> WAREHOUSE_ID}}"></div>

             
             <input type="hidden" name = "WAREHOUSE_TOP_LEADER_AC_ID"  id="WAREHOUSE_TOP_LEADER_AC_ID"  value="{{$id_user}} ">

               
                <label style="float:left;">ความเห็นผู้อนุมัติ</label><br>

                <textarea   name = "WAREHOUSE_TOP_LEADER_AC_COMMENT"  id="WAREHOUSE_TOP_LEADER_AC_COMMENT" class="form-control input-lg" ></textarea>
                <br>


           
            <div class="modal-footer">
            <div align="right">
            <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-success loadscreen" value="approved" ><i class="fas fa-clipboard-check mr-2"></i>อนุมัติ</button>
                <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger loadscreen" value="not_approved" ><i class="fas fa-times mr-2"></i>ไม่อนุมัติ</button>
                <a href="{{url('manager_warehouse/disbursesmall')}}" type="button"  class="btn btn-hero-sm btn-hero-secondary loadscreen" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a>
              
          
            </div>
            </div>
            </form>

        </body>



   

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
   
});
</script>

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



function detaillast(){
 
    id = document.getElementById("WAREHOUSE_ID").value;
  
$.ajax({
           url:"{{route('smallhos.detailsmallhos')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detaillastappall'+id).html(result);
              
           }

   })



}



</script>



@endsection