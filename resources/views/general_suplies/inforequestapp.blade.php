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



use App\Http\Controllers\SupliesController;
$checkapp = SupliesController::checkapp($user_id);
$checkallow = SupliesController::checkallow($user_id);

$countapp = SupliesController::countapp($user_id);
$countallow = SupliesController::countallow($user_id);



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
                                            <div>
                                             <a href="{{ url('general_suplies/dashboard/'.$inforpersonuserid -> ID) }}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>



                                            <div>
                                             <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ขอจัดซื้อ/จัดจ้าง</a>
                                            </div>
                                            <div>&nbsp;</div>

                                       
                                            @if($checkapp != 0)
                                            <div>
                                           <a href="{{ url('general_suplies/inforequestapp/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen" >เห็นชอบ

                                           @if($countapp!=0)
                                    <span class="badge badge-light" >{{$countapp}}</span>
                                            @endif
                                            </a>
                                            </div>
                                            <div>&nbsp;</div>
                                            @endif

                                            @if($checkallow!=0)

                                            <div>
                                            <a href="{{ url('general_suplies/inforequestlastapp/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ

                                            @if($countallow!=0)
                                            <span class="badge badge-light" >{{$countallow}}</span>
                                            @endif

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>
                                            @endif 

                                            </ol>

                </nav>
        </div>
    </div>
    </div>
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เห็นชอบความต้องการขอซื้อขอจ้างพัสดุ</B></h3>

        </div>
        <div class="block-content block-content-full">
            <form action="{{ route('suplies.inforequestappsearch',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
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
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">--ทั้งหมด--</option>
                                    @foreach ($info_sendstatuss as $info_sendstatus)
                                        @if($info_sendstatus->STATUS_CODE == $status_check)
                                            <option value="{{ $info_sendstatus->STATUS_CODE }}" selected>{{ $info_sendstatus->STATUS_NAME}}</option>
                                         @else
                                            <option value="{{ $info_sendstatus->STATUS_CODE  }}">{{ $info_sendstatus->STATUS_NAME}}</option>
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
                    <div class="col-md-1">
                        <span>
                            <button type="submit" class="btn btn-info" >ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>
        <div class="table-responsive">
        <div align="right">ราคาประมาณการรวม {{number_format($sumbudget,2)}}  บาท</div>
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="9%">เลขขอซื้อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ลงวันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เพื่อจัดซื้อ/ซ่อมแซม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วยงานที่ร้องขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">บริษัทแนะนำ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ราคาประมาณการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ตรวจสอบ</th>
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                    @foreach ($inforequests as $inforequest)

                    <?php $number++;

                    $status =  $inforequest -> STATUS;

                    if( $status === 'Pending'){
                       $statuscol =  "badge badge-danger";

                   }else if($status === 'Approve'){
                      $statuscol =  "badge badge-warning";

                   }else if($status === 'Verify'){
                       $statuscol =  "badge badge-info";
                   }else if($status === 'Allow'){
                       $statuscol =  "badge badge-success";
                   }else{
                       $statuscol =  "badge badge-secondary";
                   }

                    ?>
                        <tr height="20">
                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                    <span class="{{$statuscol}}">{{ $inforequest -> STATUS_NAME }}</span>
                            </td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforequest -> BUDGET_YEAR }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforequest -> REQUEST_ID }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ DateThai($inforequest -> DATE_WANT) }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforequest -> REQUEST_FOR }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforequest -> SAVE_HR_DEP_SUB_NAME }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforequest -> REQUEST_VANDOR_NAME }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">{{ number_format($inforequest -> BUDGET_SUM,2) }}</td>
                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforequest -> SAVE_HR_NAME }}</td>
                            
                            <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                            @if($inforequest -> STATUS == 'Pending')
                            <a href="#detail_repairnomalasset" data-toggle="modal" class="btn btn-success" onclick="detail({{ $inforequest -> ID}});"><i class="fa fa-edit"></i></a>
                            @else
                              -
                            @endif
                            </td>

                        </tr>



                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------เห็นชอบ---------------------------------------->
                                    <div id="detail_repairnomalasset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">

                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เห็นชอบขอซื้อขอจ้างพัสดุ&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                                <form  method="post" action="{{ route('suplies.updateinforequestapp') }}" enctype="multipart/form-data">
                                                @csrf


                                                 <div id="detail"></div>



                                                    <input type="hidden" name = "AGREE_HR_ID"  id="AGREE_HR_ID"  value="{{ $inforpersonuserid ->ID }} ">

                                                    <label style="float:left;">ความเห็นผู้เห็นชอบ</label>

                                                    <textarea   name = "AGREE_COMMENT"  id="AGREE_COMMENT" class="form-control input-lg" ></textarea>

                                                </div>
                                                <div class="modal-footer">
                                                <div align="right">
                                                <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >เห็นชอบ</button>
                                                <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่เห็นชอบ</button>
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>

                                                </div>
                                                </div>
                                                </form>
                                        </body>


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


<script
>
function detail(id){


$.ajax({
           url:"{{route('suplies.detailapp')}}",
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


//------------------------เลือกปีงบ

function datepick() {

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true,
    autoclose: true                         //Set เป็นปี พ.ศ.
}).datepicker();  //กำหนดเป็นวันปัจุบัน
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
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });

</script>



@endsection
