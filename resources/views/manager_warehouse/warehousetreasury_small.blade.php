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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
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

    $small_id = Request::input("small_id");
 
    use App\Http\Controllers\ManagerwarehouseController;

?>       
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;margin-top:10px;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  >             
            <form action="{{ route('mwarehouse.treasury_small') }}" method="GET">
                
            <div class="row">
                <div class="col-sm-5">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังย่อย รพ.สต.</B></h3>
                </div>
                <div class="col-md-6">
                    <select name="small_id" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                        <option value="" >--เลือกคลัง--</option>  
                        @foreach ($small_hospital as $hospital)  
                            <option value="{{$hospital->id}}" {!! ($hospital->id == $small_id)?"selected":"" !!}>{{$hospital->name}}<option>
                        @endforeach  
                    </select> 
                </div>
                <div class="col-sm-1">
                    <span>                   
                        <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ค้นหา</button>
                    </span>
                </div>           
            </div>
        </form>
        </div>
    
    <div align="right">
        <span class="pr-4">มูลค่ารวม {{ number_format($total_amount, 2) }}</span>
    </div>
        <div class="block-content ">            
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #48D1CC;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัสวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ประเภทวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงคลัง</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">เรียกดู</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                        @php
                            $number = 0;
                        @endphp
                        @foreach ($stock_cards as $stock)
                        @php
                            $number++;
                            $num1 = ManagerwarehouseController::sumtreasuryreceivesmall($stock->TREASURY_SMALL_ID);
                            $num2 = ManagerwarehouseController::sumtreasuryexportsmall($stock->TREASURY_SMALL_ID);  
                            $resultnum = $num1-  $num2;
                        @endphp
                        <tr height="20">
                            <td class="text-font" align="center" style="border: 1px solid black;" width="5%">{{$number}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$stock->TREASURY_SMALL_CODE}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$stock->TREASURY_SMALL_NAME}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$stock->SUP_TYPE_NAME}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;">{{$stock->TREASURY_SMALL_TYPE_NAME}}</td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" width="5%">{{$stock->SUP_UNIT_NAME}}</td>
                            <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;" width="5%">{{number_format(ManagerwarehouseController::sumtreasuryreceivesmall($stock->TREASURY_SMALL_ID))}}</td>
                            <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;" width="5%">{{number_format(ManagerwarehouseController::sumtreasuryexportsmall($stock->TREASURY_SMALL_ID))}}</td>
                            <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;" width="5%">{{number_format($resultnum)}}</td>
                            <td class="text-font text-pedding" style="text-align: right;center;border: 1px solid black;" width="10%">{{number_format(ManagerwarehouseController::sumvaluetreasurysmall($stock->TREASURY_SMALL_ID),2)}}</td>
                        
                            
                            <td align="center" style="border: 1px solid black;" width="5%">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;center;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                
                                    <a class="dropdown-item" href="{{ url('manager_warehouse/treasury_small/detail/'.$stock->TREASURY_SMALL_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">เรียกดู</a>
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
                <br>               
                </div>                

        </div>

        </div>
    </div>

  
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

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
      $(document).ready(function() {
    $('select').select2({
    width: '100%'
});

    });
$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
    </script>
@endsection