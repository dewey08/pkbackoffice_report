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
                    }

        .text-font {
    font-size: 13px;
                  }
      



            .form-control {
            font-family: 'Kanit', sans-serif;
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




?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');


?>


                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('general_car/gencarindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ปฏิทินยานพาหนะ</a>
                                </div>
                                <div>&nbsp;</div>
                                <div >

                                <a href="{{ url('general_car/gencartype/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เพิ่มข้อมูลขอใช้รถ</a>

                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_car/gencarinfonomal/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนใช้รถทั่วไป</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>

                                <a href="{{ url('general_car/gencarinforefer/'.$inforpersonuserid -> ID)}}" class="btn btn-danger loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ทะเบียนใช้รถพยาบาล</a>

                                </div>

                                <div>&nbsp;</div>

                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนใช้รถพยาบาล</B></h3>

                        </div>
                        <div class="block-content block-content-full">
                    <form action="{{ route('car.inforefer',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
                        @csrf

                <div class="row">
                    <div class="col-sm-0.5">
                        &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
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
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>

                    <div class="col-sm-0.5">
                    &nbsp;ประเภท &nbsp;
                    </div>

                    <div class="col-sm-2">
                    <span>
                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--ทั้งหมด--</option>
                                @foreach ($inforefer_sendstatuss as $inforefer_sendstatus)
                                    @if($inforefer_sendstatus->REFER_TYPE_ID == $status_check)
                                    <option value="{{ $inforefer_sendstatus->REFER_TYPE_ID  }}" selected>{{ $inforefer_sendstatus->REFER_TYPE_NAME}}</option>
                                    @else
                                    <option value="{{ $inforefer_sendstatus->REFER_TYPE_ID  }}">{{ $inforefer_sendstatus->REFER_TYPE_NAME}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </span>
                    </div>

                    <div class="col-sm-0.5">
                    &nbsp;ค้นหา &nbsp;
                    </div>

                    <div class="col-sm-2">
                    <span>

                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                    </span>
                    </div>

                    <div class="col-sm-30">
                    &nbsp;
                    </div>
                    <div class="col-sm-1.5">
                    <span>
                        <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                    </span>
                    </div>
                  </div>
             </form>
             <div class="table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ทะเบียน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ประเภท</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ไป</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">เวลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ถึงวันที่</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">เวลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">พนักงานขับรถ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ผู้ร้องขอ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >สถานที่ </th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หมายเหตุ</th>                                         
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="5%">คำสั่ง</th>    
                                    </tr >
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforefers as $inforefer)
                                <?php $number++; ?>
                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{$number}}</td>

                                        @if($inforefer->STATUS == 'CANCEL')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >ยกเลิก</span></td>
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-success" >ส่งต่อ</span></td>
                                        @endif

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="7%">{{ $inforefer->CAR_REG }}</td>
                                        @if($inforefer->REFER_TYPE_ID == '1')
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">REFER</td>
                                        @elseif($inforefer->REFER_TYPE_ID== '2')
                                        <td  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">EMS</td>
                                        @elseif($inforefer->REFER_TYPE_ID == '3')
                                        <td  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">รับ-ส่ง [ไม่ฉุกเฉิน]</td>
                                       @else
                                       <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%"></td>
                                        @endif

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">{{ DateThai($inforefer->OUT_DATE) }}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{ formatetime($inforefer->OUT_TIME) }}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">{{ DateThai($inforefer->BACK_DATE) }}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{ formatetime($inforefer->BACK_TIME) }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $inforefer->DRIVER_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $inforefer->USER_REQUEST_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="13%">{{ $inforefer->LOCATION_ORG_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforefer->COMMENT }}</td>
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                        <div class="dropdown" width="5%">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_usecar"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="detail({{$inforefer->ID}});">รายละเอียด</a>

                                                <a class="dropdown-item" href="{{ url('general_car/gencarreferedit/'.$inforefer -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>

                                                    <a class="dropdown-item"  href="{{ url('general_car/gencarrefercancel/'.$inforefer -> ID.'/'.$inforpersonuserid -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แจ้งยกเลิก</a>

                                                </div>
                                        </div>
                                        </td>

                                    </tr>


                                    @endforeach

                                    <div id="detail_usecar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">

                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการขอใช้รถพยาบาล&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >



                                                 <div id="detail"></div>


                                                </div>
                                                <div class="modal-footer">
                                                <div align="right">

                                                <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                                                </div>
                                                </div>
                                                </form>
                                        </body>


                                            </div>
                                            </div>
                                        </div>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
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

var type = 'refer';

  $.ajax({
             url:"{{route('car.detailcar')}}",
            method:"GET",
             data:{type:type,id:id},
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

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
