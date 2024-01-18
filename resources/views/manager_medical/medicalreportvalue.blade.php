@extends('layouts.medical')   
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
?>        
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สรุปงานยาและเวชภัณฑ์</B></h3>
             
             
            </div>
            <div class="block-content ">
            <form action="{{ route('mwarehouse.reportvaluesearch') }}" method="post">
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
         
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ยอดคงเหลือยกมา<br>คลังหลัก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ยอดคงเหลือยกมา<br>คลังย่อย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ยอดคงเหลือยกมา<br>รวม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ซื้อระหว่างเดือน<br>คลังหลัก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ซื้อระหว่างเดือน<br>คลังย่อย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ซื้อระหว่างเดือน<br>รวม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >มูลค่ารวม</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">จ่ายส่วนของ รพ.สต.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จ่ายส่วนของ รพร.</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รวมจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >มูลค่าคงเหลือ</th>
                  
                        </tr >
                    </thead>
                    <tbody>     
                 <?php $number=0;  ?>
                    @foreach ($infosuptypes as $infosuptype)
                    <?php $number++; 
                  $sum1  = ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueforwardtreasury($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end);

                  $sum2 = ManagerwarehouseController::valueforwardstoreinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueforwardtreasuryinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end);
                    
                    
                    ?>
            
                    <tr height="20">
                    <td class="text-font" align="center">{{$number}}</td>
                         
                        <td class="text-font text-pedding" >{{ $infosuptype -> SUP_TYPE_NAME }}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valueforwardtreasury($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format((ManagerwarehouseController::valueforwardstore($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueforwardtreasury($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end)),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valueforwardstoreinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valueforwardtreasuryinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format((ManagerwarehouseController::valueforwardstoreinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end) + ManagerwarehouseController::valueforwardtreasuryinmonth($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end)),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{ number_format($sum1 + $sum2,5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">0.0000</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valueforuser($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::valueforuser($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(($sum1 + $sum2)-ManagerwarehouseController::valueforuser($infosuptype->SUP_TYPE_ID,$displaydate_bigen,$displaydate_end),5)}}</td>
                
            
                     
            
                        </tr>    
       
                        @endforeach  

                        <tr height="20" style="background-color: #FFB6C1;">
                        <?php 
                 
                 $sum11  = ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueforwardtreasury($displaydate_bigen,$displaydate_end);

                 $sum22 = ManagerwarehouseController::sumvalueforwardstoreinmonth($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueforwardtreasuryinmonth($displaydate_bigen,$displaydate_end);
                   
                   
                   ?>
           
                         
                  <td  colspan="2" style="text-align: center; font-size: 13px;">รวม</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvalueforwardtreasury($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format((ManagerwarehouseController::sumvalueforwardstore($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueforwardtreasury($displaydate_bigen,$displaydate_end)),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvalueforwardstoreinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvalueforwardtreasuryinmonth($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format((ManagerwarehouseController::sumvalueforwardstoreinmonth($displaydate_bigen,$displaydate_end) + ManagerwarehouseController::sumvalueforwardtreasuryinmonth($displaydate_bigen,$displaydate_end)),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{ number_format($sum11 + $sum22,5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">0.0000</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvalueforuser($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvalueforuser($displaydate_bigen,$displaydate_end),5)}}</td>
                  <td class="text-font text-pedding" style="text-align: right;">{{number_format(($sum11 + $sum22)-ManagerwarehouseController::sumvalueforuser($displaydate_bigen,$displaydate_end),5)}}</td>
                 
                  </tr>    

                    </tbody>
                </table>
                <br><br>
               
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



function detaillast(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detaillastappall'+id).html(result);


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


</script>

@endsection