@extends('layouts.backend')

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


use App\Http\Controllers\ManagerwarehouseController;

use App\Http\Controllers\WarehouseController;
$checkagree = WarehouseController::agree($user_id);
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
                                            <a href="{{ url('general_warehouse/infostockcard/'.$inforpersonuserid -> ID)}}" class="btn btn-success loadscreen" >คลังย่อย

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>


                                    
                                           

                                            <div>
                                             <a href="{{ url('general_warehouse/infopayindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จ่ายวัสดุ</a>
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
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังย่อย</B></h3>

        </div>
        <div class="block-content block-content-full">
      
        <form action="{{ route('warehouse.infostockcardsearch',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
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

                        <div class="col-md-0.5">
                            &nbsp;ประเภทวัสดุ &nbsp;
                        </div>                            
                        <div class="col-md-2">
                            <span>                            
                                <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">--ทั้งหมด--</option> 
                                    @foreach ($suppliestypes as $suppliestype)
                                        @if($suppliestype->SUP_TYPE_ID== $STATUS_CODE)
                                            <option value="{{ $suppliestype->SUP_TYPE_ID  }}" selected>{{ $suppliestype->SUP_TYPE_NAME}}</option>
                                        @else
                                            <option value="{{ $suppliestype->SUP_TYPE_ID  }}">{{ $suppliestype->SUP_TYPE_NAME}}</option>
                                        @endif                                 
                                    @endforeach   
                                </select>
                            </span>
                        </div> 
              
                        <div class="col-md-0.5">
                            &nbsp;ค้นหาชื่อ &nbsp;
                        </div>
                        <div class="col-md-1.5">
                            <span>                 
                                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                            </span>
                        </div>               
                        <div class="col-md-0.5">
                            &nbsp;
                        </div> 
                        <div class="col-md-2">
                            <span>
                                {{-- <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ค้นหา</button> --}}
                                <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i> ค้นหา</button>
                            </span> 
                        </div>
                    </div>  
            </form>
            <div style="text-align: right;">    
                          มูลค่าคงเหลือรวม {{ number_format($balance,5)}} บาท          
                </div>
        <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #F08080;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัสวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ประเภทวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">มูลค่าคงคลัง</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">เรียกดู</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                   
                    <?php $number=1; ?>
                        @foreach ($infowarehousetreasurys as $infowarehousetreasury)

                        <?php
                                    $num1 = ManagerwarehouseController::sumtreasuryreceive($infowarehousetreasury->TREASURY_ID);
                                    $num2 = ManagerwarehouseController::sumtreasuryexport($infowarehousetreasury->TREASURY_ID);  
                                     $resultnum = $num1-  $num2;
                            ?> 
                       
                        <tr height="20">
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{$number}}</td>

                        <td class="text-font text-pedding" style="text-align: left;border: 1px solid black;">{{$infowarehousetreasury->TREASURY_CODE}}</td>
                        <td class="text-font text-pedding" style="text-align: left;border: 1px solid black;">{{$infowarehousetreasury->TREASURY_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: left;border: 1px solid black;">{{$infowarehousetreasury->SUP_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: left;border: 1px solid black;">{{$infowarehousetreasury->SUP_UNIT_NAME}}</td>

                        <td class="text-font text-pedding" style="text-align: center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumtreasuryreceive($infowarehousetreasury->TREASURY_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumtreasuryexport($infowarehousetreasury->TREASURY_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format($resultnum)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvaluetreasury($infowarehousetreasury->TREASURY_ID),5)}}</td>
                     
                        
                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                <div class="dropdown-menu" style="width:10px">
                              
                                <a class="dropdown-item" href="{{ url('general_warehouse/infostockcard_sub/'.$infowarehousetreasury->TREASURY_ID.'/'.$inforpersonuserid->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">เรียกดู</a>
                                {{-- <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a> --}}
                                </div>
                                </div>
                            </td> 
                        
                        </tr>
                        <?php $number++; ?>
                        @endforeach  


                      
                  

                    </tbody>
                </table>
                <br>
               

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
               url:"{{route('warehouse.detailappall')}}",
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
                }).datepicker();  //กำหนดเป็นวันปัจุบัน
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
