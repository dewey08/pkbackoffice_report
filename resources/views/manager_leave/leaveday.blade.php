@extends('layouts.leave')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }

    }


    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }


    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
    }
</style>
<script>
    function checklogin() {
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

use App\Http\Controllers\ManagerleaveController;
?>
<?php

$color_a = 'background-color: #F0F8FF;';

?>

<center>

    <div style="width:95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                    <div class="row">
                        <div class="col-md-10" align="left">
                            รายงานวันลาบุคลากร
                        </div>
                        <div class="col-md-2">
                            <a href="{{ url('manager_leave/excelleaveday')}}"  class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>Excel</a>
                        </div>
                    </div>
                </h2>

                <div class="row">
                    <div class="col-md-12">
                        <form  method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 row">
                                <div class="col-md-0.5">
                                    &nbsp;ปี &nbsp;
                                </div>
                                <div class="col-md-1">
                                    <span>
                                        <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                            @foreach ($budgetyears as $budgetyear) 
                                            @if($budgetyear ->LEAVE_YEAR_ID == $budgetyearnow)
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_ID }}</option>
                                            @else
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID }}</option>
                                            @endif
                                            @endforeach 
                                        </select>
                                </div>

                                <div class="col-sm-0.5">
                                           เดือน
                                </div>

                                <div class="col-sm-2">

                                            <select name="BUDGET_MONTH" id="BUDGET_MONTH" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                               
                                                @if($month == '01')<option value="01" selected> มกราคม </option>@else<option value="01" > มกราคม </option>@endif
                                                @if($month == '02')<option value="02" selected> กุมภาพันธ์ </option>@else<option value="02" > กุมภาพันธ์ </option>@endif
                                                @if($month == '03')<option value="03" selected> มีนาคม </option>@else<option value="03" > มีนาคม </option>@endif
                                                @if($month == '04')<option value="04" selected> เมษายน </option>@else<option value="04" > เมษายน </option>@endif
                                                @if($month == '05')<option value="05" selected> พฤษภาคม  </option>@else<option value="05" > พฤษภาคม </option>@endif
                                                @if($month == '06')<option value="06" selected> มิถุนายน </option>@else<option value="06" > มิถุนายน </option>@endif
                                                @if($month == '07')<option value="07" selected> กรกฎาคม </option>@else<option value="07" > กรกฎาคม </option>@endif
                                                @if($month == '08')<option value="08" selected> สิงหาคม </option>@else<option value="08" > สิงหาคม </option>@endif
                                                @if($month == '09')<option value="09" selected> กันยายน </option>@else<option value="09" > กันยายน </option>@endif
                                                @if($month == '10')<option value="10" selected> ตุลาคม </option>@else<option value="10" > ตุลาคม </option>@endif
                                                @if($month == '11')<option value="11" selected> พฤศจิกายน  </option>@else<option value="11" > พฤศจิกายน </option>@endif
                                                @if($month == '12')<option value="12" selected> ธันวาคม </option>@else<option value="12" > ธันวาคม </option>@endif



                                            </select>
                                </div>
                                      
                              

                               

                                <div class="col-md-0.5">
                                    &nbsp;ค้นหา &nbsp;
                                </div>
                                <div class="col-md-2">
                                    <span>
                                        <input type="search" name="search" class="form-control"
                                            style="font-family: 'Kanit', sans-serif; font-weight:normal;" value="{{$search}}">
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
                    </div>

                </div>
                </form>

                <div class="panel-body" style="overflow-x:auto;">

                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                        <thead style="background-color: #FFEBCD;">

                            <tr height="40">
                                <td class="text-font"
                                style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="5%"
                                rowspan="2">ลำดับ</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="15%"
                                    rowspan="2">ชื่อ นามสกุล</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">ตำแหน่ง</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">ฝ่าย/แผนก</td>

                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    colspan="4">ประเภทการลา</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"
                                    rowspan="2">รวมได้ลาแล้ว</td>
                 

                            </tr>
                            <tr>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ลาป่วย</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลากิจ</td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลาพักผ่อน
                                </td>
                                <td class="text-font"
                                    style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลาคลอดบุตร
                                </td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($persons as $person)

                            <?php $number++; 
                  

                            if( $person->HR_STATUS_ID == 5 || $person->HR_STATUS_ID == 6 || $person->HR_STATUS_ID == 7 || $person->HR_STATUS_ID == 8){
                            $color = 'background-color: #FFF0F5;';
                           
                             }else{
                             $color = '';
                            }
                            ?> 

                            <tr style="{{$color}}"  height="20">
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $number }}</td>                     
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                     
        
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> POSITION_IN_WORK }}</td>   
                              
           
                                <td class="text-pedding text-font" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>    
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'01')}}
                                </td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'03') }}</td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'04') }}</td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::leavemonth($person ->ID,$budgetyearnow,$month,'02') }}</td>
                                <td class="text-pedding text-font"
                                    style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ManagerleaveController::sumleavemonth($person ->ID,$budgetyearnow,$month) }}</td>
                              

                            </tr>
                            @endforeach 
                        </tbody>
                    </table>

                </div>

                @endsection
                @section('footer')
                <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
                <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
                <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8">
                </script>

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
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            thaiyear: true,
                            autoclose: true //Set เป็นปี พ.ศ.
                        }); //กำหนดเป็นวันปัจุบัน
                    });
                    $('.budget').change(function() {
                        if ($(this).val() != '') {
                            var select = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{route('admin.selectbudget')}}",
                                method: "GET",
                                data: {
                                    select: select,
                                    _token: _token
                                },
                                success: function(result) {
                                    $('.date_budget').html(result);
                                    datepick();
                                }
                            })
                            // console.log(select);
                        }
                    });

                    function datepick() {
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            thaiyear: true,
                            autoclose: true //Set เป็นปี พ.ศ.
                        }); //กำหนดเป็นวันปัจุบัน
                    }
                </script>

                @endsection