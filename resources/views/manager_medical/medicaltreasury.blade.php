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
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

 
    use App\Http\Controllers\ManagerwarehouseController;

?>       
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;margin-top:10px;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  >             
            <form action="{{ route('mmedical.treasury') }}" method="post">
                @csrf
            <div class="row">
                <div class="col-md-3">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>Stock card :: คลังย่อย</B></h3>
                </div>
                <div class="col-md-4">
                    <select name="DEPART_STORE" id="DEPART_STORE" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                        <option value="" >--เลือกคลัง--</option>                                          
                            @foreach ($infodeparts as $infodepart)  
                                @if($infodepart -> HR_DEPARTMENT_SUB_SUB_ID  == $checkreceive)
                                <option value="{{ $infodepart -> HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodepart -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>                                          

                                @else

                                <option value="{{ $infodepart -> HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodepart -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>                                          
                                @endif
                                
                               
                            @endforeach  
                        </select> 
                </div>
                <div class="col-md-3" >
                        <span>
                        <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                        </span>
                    </div>
                <div class="col-md-1">
                    <span>
                        <button type="submit" class="btn btn-sm btn-info" >&nbsp;ค้นหา&nbsp;</button>
                    </span>
                </div> 
                <div class="col-md-1">
                  <a href="{{ url('manager_warehouse/treasuryexcel')}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 11px;font-weight:normal;" >Excel</a>          
                  </div>           
            </div>
        </div>
    </form>
    
    <div align="right">มูลค่ารวม {{number_format($sumvalue,2)}}  บาท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
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
                   
                    <?php $number=1; ?>
                        @foreach ($infowarehousetreasurys as $infowarehousetreasury)

                        <?php
                                    $num1 = ManagerwarehouseController::sumtreasuryreceive($infowarehousetreasury->TREASURY_ID);
                                    $num2 = ManagerwarehouseController::sumtreasuryexport($infowarehousetreasury->TREASURY_ID);  
                                     $resultnum = $num1-  $num2;
                            ?> 
                       
                        <tr height="20">
                        <td class="text-font" align="center" style="border: 1px solid black;">{{$number}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->TREASURY_CODE}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->TREASURY_NAME}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->SUP_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->TREASURY_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{$infowarehousetreasury->SUP_UNIT_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumtreasuryreceive($infowarehousetreasury->TREASURY_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumtreasuryexport($infowarehousetreasury->TREASURY_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;center;border: 1px solid black;">{{number_format($resultnum)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;center;border: 1px solid black;">{{number_format(ManagerwarehouseController::sumvaluetreasury($infowarehousetreasury->TREASURY_ID),2)}}</td>
                     
                        
                        <td align="center" style="border: 1px solid black;">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;center;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">
                                
                                    <a class="dropdown-item" href="{{ url('manager_medical/treasury_sub/'.$infowarehousetreasury->TREASURY_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">เรียกดู</a>
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

        </div>

        </div>
    </div>

  
@endsection

@section('footer')
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