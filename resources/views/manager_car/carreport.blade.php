@extends('layouts.car')
   
 
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


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

 list($a,$b,$c,$d) = explode('/',$url); 
?>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
            }

            .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
        .form-control {
    font-size: 13px;
                  }   
      
       
</style>

<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานการขอใช้รถทั่วไป</B></h3>
                            <a href="{{ url('manager_car/excelcar')}}"  class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>Export Excel</a>
                        </div>
                        <div class="block-content block-content-full">


                <form method="post" action="">
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
                        &nbsp;ทะเบียนรถ &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">--ทั้งหมด--</option>
                                    @foreach ($infocar_sendstatuss as $infocar_sendstatus)
                                        @if($infocar_sendstatus->CAR_ID == $status_check)
                                        <option value="{{ $infocar_sendstatus->CAR_ID  }}" selected>{{ $infocar_sendstatus->CAR_REG}}</option>
                                         @else
                                         <option value="{{ $infocar_sendstatus->CAR_ID  }}">{{ $infocar_sendstatus->CAR_REG}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </span>
                    </div>

                    <div class="col-md-0.5">
                        &nbsp;ค้นหา &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                        </span>
                    </div>
                    <div class="col-md-30">
                        &nbsp;
                    </div>
                    <div class="col-md-1.5">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>


             <div class="table-responsive"> 
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ไป</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ทะเบียน</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ใช้รถ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">สถานที่ไป</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ระยะทางเมื่อรถออกเดินทาง</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">กลับถึงสำนักงานวันที่</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ระยะทางเมื่อรถกลับสำนักงาน</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ระยะทาง กม.</th>

                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >พนักงานขับรถ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หมายเหตุ</th>
    
                                    </tr >
                                </thead>
                                <tbody>
                               
                                <?php $number = 0; ?>
                                @foreach ($infocars as $infocar)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font"style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($infocar->RESERVE_BEGIN_DATE) }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->CAR_REG }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->RESERVE_PERSON_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->LOCATION_ORG_NAME }}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{number_format($infocar->CAR_NUMBER_BEGIN) }}</td>
                                        @if($infocar->BACK_DATE != '' || $infocar->BACK_DATE != NUll)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{DateThai($infocar->BACK_DATE)}}</td>
                                        
                                        @else
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif                                       
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ number_format($infocar->CAR_NUMBER_BACK) }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{(number_format($infocar->CAR_NUMBER_BACK - $infocar->CAR_NUMBER_BEGIN))}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->HR_FNAME }} {{ $infocar->HR_LNAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{ $infocar->COMMENT }}</td>                                    
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
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                todayHighlight: true,
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


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
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            todayHighlight: true,
                            thaiyear: true,
                            autoclose: true                         //Set เป็นปี พ.ศ.
                        });  //กำหนดเป็นวันปัจุบัน
                     }
             })
            // console.log(select);
             }        
     });
  
</script>



@endsection