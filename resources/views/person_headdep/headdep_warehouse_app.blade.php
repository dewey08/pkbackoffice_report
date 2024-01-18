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
   padding-right:10px;
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
    <br>
    <body onload="detail({{$inforwarehouserequest->WAREHOUSE_ID}})">

                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div>
                                                <h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เห็นชอบความต้องการขอเบิกพัสดุ&nbsp;&nbsp;</h3></div>
                                            </div>
                                        </div>
                                    <div class="modal-body" >
                                            <form  method="post" action="{{route('hdep.headdep_warehouseupdate')}}" enctype="multipart/form-data">
                                                @csrf

                                                 <div id="detail"></div>

                                                <input type="hidden" name = "WAREHOUSE_AGREE_HR_ID"  id="WAREHOUSE_AGREE_HR_ID"  value="{{ $inforpersonuserid ->ID }} ">

                                                <label style="float:left;">ความเห็นผู้เห็นชอบ</label>

                                                <textarea   name = "WAREHOUSE_REQUEST_COMMENT"  id="WAREHOUSE_REQUEST_COMMENT" class="form-control input-lg" ></textarea>

                                    </div>
                                    <div class="modal-footer">
                                        <div align="right">
                                            <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-success" value="approved" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">เห็นชอบ</button>
                                            <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ไม่เห็นชอบ</button>
                                           
                                            <a href="{{ url('person_headdep/headdep_warehouse')}}"  class="btn btn-hero-sm btn-secondary" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ปิดหน้าต่าง</a> 
                                        </div>
                                    </div>
                                            </form>
                                </body>
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

function detail(id){


$.ajax({
           url:"{{route('hdep.headdep_warehousedetail')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);


              //alert("Hello! I am an alert box!!");
           }

   })

}


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
 
 
 
 
 function checkreadenter(bookid,userid){
 
 
 
           var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('document.checkreadenter')}}",
                    method:"GET",
                    data:{userid:userid,bookid:bookid,_token:_token}
 
            })
 
   }

   </script>

@endsection