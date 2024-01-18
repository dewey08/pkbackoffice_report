@extends('layouts.backend')
   
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


use App\Http\Controllers\WarehouseController;

$checkagree = WarehouseController::agree($user_id);

use App\Http\Controllers\ManagerwarehouseController;


?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
  
?>
        
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">                                           
                <div class="row">
                                            <div>
                                             <a href="{{ url('general_warehouse/dashboard/'.$inforpersonuserid -> ID) }}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                                <a href="{{ url('general_warehouse/infowithdrawindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เบิกจากคลังหลัก</a>
                                               </div>
                                               <div>&nbsp;</div>
                                               
                                            <div>
                                            <a href="{{ url('general_warehouse/infostockcard/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">คลังย่อย

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>


                                    
                                          

                                            <div>
                                             <a href="{{ url('general_warehouse/infopayindex/'.$inforpersonuserid -> ID)}}" class="btn  btn-info loadscreen" >จ่ายวัสดุ</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>

                                                @if($checkagree <> 0)
                                           <a href="{{ url('general_warehouse/infoapp/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เห็นชอบ

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            @endif
                                            
                                            </div>
                                            <div>&nbsp;</div>
                            


                                   


                                            </ol>
                   
                </nav>
        </div>
    </div>
    </div>

<center>    
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;text-align: left;" ><B>รายงานสรุปยอดคงคลัง  | หน่วยงาน {{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}</B></h3>
                <a href="{{ url('general_warehouse/reportinfopayexcel/'.$year_id.'/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$inforpersonuserid->ID)}}"  class="btn btn-success btn-lg" ><i class="fas fa-file-excel text-white" style="font-size:20px;"></i>&nbsp;&nbsp;Export Excel</a>
             
            </div>
            <div class="block-content ">
            <form action="{{ route('warehouse.reportinfopaysearch',['iduser' => $inforpersonuserid->ID ]) }}" method="post">
                @csrf
                <div class="row">

                <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                                <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
            <div class="col-sm">
                        วันที่
                        </div>
                  
                        <div class="col-sm-4">
                   
                        <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                        <div class="col-sm-4">
               
                       <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                        </div>

                </div>
                <div class="col-sm-0.5">
                    &nbsp;ประเภท &nbsp;
                </div>
                <div class="col-sm-2">
                    <span>
                        <select name="TYPE_CODE" id="TYPE_CODE" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--ทั้งหมด--</option>
                            @foreach ($infotypes as $infotype)
                            @if($infotype->SUP_TYPE_ID == $type_check)
                            <option value="{{ $infotype->SUP_TYPE_ID  }}" selected>
                                {{ $infotype->SUP_TYPE_NAME}}</option>
                            @else
                            <option value="{{ $infotype->SUP_TYPE_ID  }}">{{ $infotype->SUP_TYPE_NAME}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>


                 
                    <div class="col-md-30">
                        &nbsp;
                    </div>
                    <div class="col-md-1.5">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>

             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการสินค้า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนยกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ายกมา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนรับใหม่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ารับใหม่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าการจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนคงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงเหลือ</th>

                        </tr >
                    </thead>
                    <tbody>     
                        <?php $number=0;  ?>
                        @foreach ($infosuptypes as $infosuptype)
                        <?php $number++; 
                        
                       
                      $sum1 =  ManagerwarehouseController::valueamountforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueamountforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end);
    
    
                      $sum2 =  ManagerwarehouseController::valuesubforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valuesubforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end);
    
    
                        ?>
                
                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>        
                            <td class="text-font text-pedding" >{{$infosuptype->TREASURY_TYPE_NAME}}</td>
                            <td class="text-font text-pedding" >{{$infosuptype->TREASURY_CODE}}</td>
                            <td class="text-font text-pedding" >{{$infosuptype->TREASURY_NAME}}</td>
                            <td class="text-font text-pedding" >{{$infosuptype->SUP_TYPE_NAME}}</td>
                            <td class="text-font text-pedding" >{{$infosuptype->SUP_UNIT_NAME}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::valueamountforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valuesubforwardtreasury($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::valueamountforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valuesubforwardtreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::valueamountpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valuesubpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                            <td class="text-font text-pedding" style="text-align: center;">{{$sum1 - ManagerwarehouseController::valueamountpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end)}}</td>
                            <td class="text-font text-pedding" style="text-align: right;">{{ number_format($sum2 -ManagerwarehouseController::valuesubpaytreasuryinmonth($infosuptype->TREASURY_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
    
                            </tr>    
           
                            @endforeach  
    
                            <?php
                        
                       
                        $sum11 =  ManagerwarehouseController::sumvalueamountforwardtreasury($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueamountforwardtreasuryinmonth($displaydate_bigen,$displaydate_end);
      
      
                        $sum22 =  ManagerwarehouseController::sumvaluesubforwardtreasury($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvaluesubforwardtreasuryinmonth($displaydate_bigen,$displaydate_end);
      
      
                          ?>
                  
                          <tr height="20" style="background-color: #FFB6C1;">
                          <td  colspan="6" style="text-align: center; font-size: 13px;">รวม</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::sumvalueamountforwardtreasury($displaydate_bigen,$displaydate_end)}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluesubforwardtreasury($displaydate_bigen,$displaydate_end),5)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::sumvalueamountforwardtreasuryinmonth($displaydate_bigen,$displaydate_end)}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluesubforwardtreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{ManagerwarehouseController::sumvalueamountpaytreasuryinmonth($displaydate_bigen,$displaydate_end)}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluesubpaytreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                              <td class="text-font text-pedding" style="text-align: center;">{{$sum11 - ManagerwarehouseController::sumvalueamountpaytreasuryinmonth($displaydate_bigen,$displaydate_end)}}</td>
                              <td class="text-font text-pedding" style="text-align: right;">{{ number_format($sum22 -ManagerwarehouseController::sumvaluesubpaytreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
      
                              </tr>    
    
                        </tbody>
                    </table>
                <br>
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

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2();
});
</script>


@endsection