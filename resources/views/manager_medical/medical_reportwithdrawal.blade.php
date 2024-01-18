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
?>
      
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered ">
            <div class="block-header block-header-default"  style="text-align: left;">
             
               
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>สถิติการเบิก :: {{$warehousestore->STORE_CODE}}  {{$warehousestore->STORE_NAME}}</B></h3>
                <div align="right">

<a href="{{ url('manager_medical/storehouse') }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
</div>
            </div>
            <div class="block-content ">
             
              
         
                
                 

                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="object1" role="tabpanel">

                        <div class="row">                                      
               
                        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                            <thead style="background-color: #F0F8FF;">
                                                <tr height="40">
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">วันที่จ่าย</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="20%">รายการ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">Lot</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยงาน</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">จำนวนที่เบิก</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">หน่วย</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">ราคา</th>
                                                </tr >
                                            </thead>
                                            <tbody>
                                        
                                                
                                                <?php $number = 0 ;?>
                                                @foreach ($infowithdrawals as $infowithdrawal)
                                                <?php $number++;
                    
                                                ?>
                                                <tr >
                                                    <td style="text-align: center;">
                                                        {{$number}}
                                                    </td>
                                                    <td class="text-font text-pedding" align="center">{{DateThai($infowithdrawal->EXPORT_SUB_EXP_DATE)}}</td>
                                                    <td class="text-font text-pedding" >{{$infowithdrawal->EXPORT_SUB_NAME}} {{$infowithdrawal->TYPE_ITEM_NAME}} {{$infowithdrawal->SUP_MASH}}</td>
                                                    <td class="text-font text-pedding" >{{$infowithdrawal->EXPORT_SUB_LOT}}</td>
                                                    <td class="text-font text-pedding" >{{$infowithdrawal->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                                    <td class="text-font text-pedding" align="center">{{$infowithdrawal->EXPORT_SUB_AMOUNT}}</td>
                                                    <td class="text-font text-pedding" align="center">{{$infowithdrawal->SUP_UNIT_NAME}}</td>
                                                    <td class="text-font text-pedding" align="right">{{number_format($infowithdrawal->EXPORT_SUB_AMOUNT * $infowithdrawal->EXPORT_SUB_PICE_UNIT,2)}}</td>

                                                </tr>    
                                   
                                                @endforeach  
                                    
                                            
                                        

                                            </tbody>
                                        </table>
                            
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>


   
 


@endsection

@section('footer')
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
$(document).ready(function () {

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true,
    autoclose: true                    //Set เป็นปี พ.ศ.
});  //กำหนดเป็นวันปัจุบัน
});
</script>
@endsection