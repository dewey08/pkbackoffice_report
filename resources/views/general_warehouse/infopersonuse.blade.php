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
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>จ่ายออกวัสดุบุคคล | หน่วยงาน {{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}</B></h3>
            <a href="{{ url('general_warehouse/infopersonuse_excel/'.$inforpersonuserid->ID)}}" class="btn btn-success btn-lg" ><i class="fas fa-file-excel text-white" style="font-size:20px;"></i>&nbsp;&nbsp;Export Excel</a> 
        </div>
        <div class="block-content block-content-full">
     
        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยนับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ราคาต่อหน่วย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่ารวม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้จ่ายวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้เบิกวัสดุ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">คลัง</th>

                       
                        </tr >
                    </thead>
                    <tbody>     
                  
                    <?php $number = 0; ?>
                    @foreach ($infomationuses as $infomationuse)

                    <?php $number++;   ?>
                    <tr height="20">
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{$number}}</td>
                       
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infomationuse ->TREASURT_PAY_CODE  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ Datethai($infomationuse ->TREASURT_PAY_DATE)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURY_EXPORT_SUB_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ number_format($infomationuse ->TREASURY_EXPORT_SUB_AMOUNT,0)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->SUP_UNIT_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">{{ number_format($infomationuse ->TREASURY_EXPORT_SUB_PICE_UNIT,2)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">{{ number_format($infomationuse ->TREASURY_EXPORT_SUB_VALUE,2)  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURT_PAY_SAVE_HR_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURT_PAY_REQUEST_HR_NAME  }}</td>
                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infomationuse ->TREASURT_PAY_NAME  }}</td>
            
                        </tr>
                    @endforeach   
                 
                


                    </tbody>
                </table>
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

    // alert("Hello! I am an alert box!!");
$.ajax({
           url:"{{route('warehouse.detailpay')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);


             
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