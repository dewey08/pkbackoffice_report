@extends('layouts.food')
   
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
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
      
      .form-control{
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

use App\Http\Controllers\ManagerfoodController;

?>
<?php

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  
?>

           
                    <!-- Advanced Tables -->
                    <br>
<br>
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลรายการจัดซื้อวัตถุดิบประจำวัน</B></h3>
                            <div align="right">

<a href="{{ url('manager_food/infofoodbillday_add')}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fa fa-plus mr-2"></i>บันทึกการจัดซื้อรายวัน</a>
</div>
                </div>
                        <div class="block-content block-content-full">
                        <form action="{{ route('mfood.infofoodbill') }}" method="post"> 
@csrf

<div class="row">


            <div class="col-sm-4">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
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
<div class="col-sm-1.5">
<span>
<button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-search mr-2"></i>ค้นหา</button>
</span> 
</div>


              
                  </div>  
             </form>

             <div style="text-align: right;">มูลค่ารวม   {{number_format($infofoodbillsum,5)}}  บาท</div>
             <div class="table-responsive"> 
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="text-align: center;" width="5">ลำดับ</th>
                                        <th class="text-font" style="text-align: center;" width="10%">เลขทะเบียน</th>
                                        <th class="text-font" style="text-align: center;" width="12%">อ้างอิงเลขทะเบียนจัดซื้อ</th> 
                                        <th class="text-font" style="text-align: center;" width="10%">วันที่</th>
                                        <th class="text-font" style="text-align: center;" >รายละเอียด</th>
                                        <th class="text-font" style="text-align: center;" width="15%">บริษัท</th>
                                        <th class="text-font" style="text-align: center;" width="10%">มูลค่า</th>
                                        <th class="text-font" style="text-align: center;" width="7%">Lock</th>                                
                                        <th class="text-font" style="text-align: center"  width="5%">คำสั่ง</th>  
                                    </tr >
                                </thead>
                                <tbody>
                                  
                                        <?php $number = 0; ?>
                                        @foreach ($infofoodbills as $infofoodbill)  
                                        <?php $number++; 
                                        
                                        $check =  ManagerfoodController::check_infobill($infofoodbill->FOOD_BILL_DAY_ID);
                                        ?>

                                      

                                            <tr height="20">
                                                <td class="text-font" align="center" width="5%">{{$number}}</td>        
                                                <td class="text-font text-pedding" align="left" width="10%">
                                             
                                                {{$infofoodbill->FOOD_BILL_DAY_NUMBER}}
                                                
                                                </td>
                                                <td class="text-font text-pedding" align="left" width="12%">{{$infofoodbill->CON_NUM}}</td> 
                                                <td class="text-font text-pedding" align="left" width="10%">{{DateThai($infofoodbill->FOOD_BILL_DAY_DATE)}}</td>
                                                <td class="text-font text-pedding" align="left">{{$infofoodbill->FOOD_BILL_DAY_NAME}}</td>
                                                <td class="text-font text-pedding" align="left" width="15%">{{$infofoodbill->VENDOR_NAME}}</td>
                                                <td class="text-font text-pedding" align="right" width="10%">{{number_format($infofoodbill->FOOD_BILL_DAY_TOTAL,5)}}</td>  
                                         
                                                <td class="text-font" align="center" width="7%">
                                                @if($check == 1)
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                                @endif
                                                </div>
                                            <td align="center" width="5%">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                    @if($check != 1)
                                                            <a class="dropdown-item"  href="{{ url('manager_food/infofoodbillday_edit/'.$infofoodbill -> FOOD_BILL_DAY_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไข</a>
                                                            <a class="dropdown-item"  href="{{ url('manager_food/infofoodbillstaple_add/'.$infofoodbill -> FOOD_BILL_DAY_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">จัดการวัตถุดิบ</a>
                                                            @endif     
                                                            <a class="dropdown-item"  href="{{ url('manager_food/export_pdfpay/'.$infofoodbill -> FOOD_BILL_DAY_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบสำคัญจ่ายเงิน</a>
                                                            <a class="dropdown-item"  href="{{ route('mfood.export_pdffrontpage',$infofoodbill->FOOD_BILL_DAY_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบปะหน้า</a>
                                                            <a class="dropdown-item"  href="{{ route('mfood.export_pdf_temporary_delivery',$infofoodbill->FOOD_BILL_DAY_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบส่งของชั่วคราว</a>
                                                          
                                                    </div>
                                                </div>
                                            </td> 
                                        </tr>
                                        @endforeach  

                                </tbody>
                            </table>
                                <br><br><br><br><br><br>
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
    datepick()
   function datepick() {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    }

   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

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