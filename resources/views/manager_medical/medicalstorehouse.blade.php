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
    use App\Http\Controllers\ManagermedicalController;
?>        
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;margin-top:10px;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  >
                <form action="{{ route('mmedical.storehouse') }}" method="post">
                    @csrf
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังหลัก</B></h3>
                    </div>
                    <div class="col-md-3">
                        <select name="RECEIVE_STORE" id="RECEIVE_STORE" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                            <option value="" >--ทั้งหมด--</option>                                          
                                @foreach ($infosuppliesinvens as $infosuppliesinven) 
                                    @if($infosuppliesinven->INVEN_ID == $checkreceive)
                                    <option value="{{$infosuppliesinven->INVEN_ID}}" selected>{{$infosuppliesinven->SETINVEN_NAME}}</option>
                                    @else
                                    <option value="{{$infosuppliesinven->INVEN_ID}}" >{{$infosuppliesinven->SETINVEN_NAME}}</option>
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
                  <a href="{{ url('manager_warehouse/storehouseexcel')}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 11px;font-weight:normal;" >Excel</a>          
                  </div>                
                </div>           
            </div>
        </form>

           <div align="right">มูลค่ารวม {{number_format($sumvalue,2)}}  บาท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div class="block-content ">
                    <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัสวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >TPU</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >GPU</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รูปแบบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คุณลักษณะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภทวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คลัง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >บรรจุภัณฑ์</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าคงคลัง</th>                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">คำสั่ง</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                        <?php $number=1; ?>
                        @foreach ($infowarehousestores as $infowarehousestore)
                        <?php
                                    $num1 = ManagerwarehouseController::sumstorereceive($infowarehousestore->STORE_ID);
                                    $num2 = ManagerwarehouseController::sumstoreexport($infowarehousestore->STORE_ID);  
                                     $resultnum = $num1-  $num2;

                                     $numconvert = ManagermedicalController::convertunit($infowarehousestore->STORE_SUP_ID);
                            ?> 
                       
                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->STORE_CODE}}</td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->TPU_NUMBER}}</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->STORE_NAME}}</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->CONTENT}}</td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->SUP_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->STORE_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infowarehousestore->SUP_UNIT_NAME}}</td>
                        <td class="text-font text-pedding" ></td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerwarehouseController::sumstorereceive($infowarehousestore->STORE_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerwarehouseController::sumstoreexport($infowarehousestore->STORE_ID))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{(number_format($resultnum))}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagerwarehouseController::sumvaluestore($infowarehousestore->STORE_ID),2)}}</td>
                    
                        <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                <div class="dropdown-menu" style="width:10px">
                                    <a class="dropdown-item" href="{{ url('manager_medical/medical_edit/'.$infowarehousestore->STORE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">รายละเอียด</a>
                                <a class="dropdown-item" href="{{ url('manager_medical/storehousesub/'.$infowarehousestore->STORE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">Stock card </a>
                                <a class="dropdown-item" href="{{ url('manager_medical/medical_order/'.$infowarehousestore->STORE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ประวัติการสั่งซื้อ</a>
                                <a class="dropdown-item" href="{{ url('manager_medical/medical_withdrawal/'.$infowarehousestore->STORE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">สถิติการเบิก</a>
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