@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
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

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">

        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติความต้องการขอซื้อขอจ้างพัสดุ</B></h3>
    
        </div>
        <div class="block-content block-content-full">
            <form action="{{ route('horg.inforequestlastappsearch') }}" method="post">
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
                            <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>
        <div class="table-responsive">
        <div align="right">ราคาประมาณการรวม {{number_format($sumbudget,2)}}  บาท</div>
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เลขใบแสดงความต้องการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ลงวันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เพื่อจัดซื้อ/ซ่อมแซม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วยงานที่ร้องขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ตรวจสอบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ราคาประมาณการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ตรวจสอบ</th>
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
                        <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font" align="center">
                                    <span class="{{$statuscol}}">{{ $inforequest -> STATUS_NAME }}</span>
                            </td>
                            <td class="text-font text-pedding" >{{$inforequest->REQUEST_ID}}</td>
                            <td class="text-font text-pedding" >{{ $inforequest -> BUDGET_YEAR }}</td>
                            <td class="text-font text-pedding" >{{ DateThai($inforequest -> DATE_WANT) }}</td>
                            <td class="text-font text-pedding" >{{ $inforequest -> REQUEST_FOR }}</td>
                            <td class="text-font text-pedding" >{{ $inforequest -> SAVE_HR_DEP_SUB_NAME }}</td>
                            <td class="text-font text-pedding" >
                           
                            @if($inforequest->REQUEST_PLAN_TYPE_ID == 1)
                                    อยู่ในแผน
                            @else
                                    ไม่อยู่ในแผน
                            @endif
                            
                            </td>
                            <td class="text-font text-pedding" >{{ $inforequest -> SAVE_HR_NAME }}</td>
                            <td class="text-font text-pedding" >{{ $inforequest -> USER_CONFIRM_CHECK_NAME }}</td>
                            <td class="text-font text-pedding" align="right" >{{ number_format($inforequest -> BUDGET_SUM,2) }}</td>
                            <td class="text-font text-pedding" align="center">
                            @if($inforequest -> STATUS == 'Verify')

                            <a href="{{ url('person_headorg/supplier_app/'.$inforequest->ID) }}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fa fa-edit"></i></a>
                
                            @else
                              -
                            @endif
                            </td>

                        </tr>


<!-------------------------------------------------------ตรวจอสอบ---------------------------------------->

<div id="detail_repairnomalasset{{$inforequest -> ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                               
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;อนุมัติขอซื้อขอจ้างพัสดุ&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body">
                                                <form  method="post" action="{{ route('horg.updateinforequestlastapp') }}" enctype="multipart/form-data">
                                             @csrf

                                          
                                                 <div id="detail{{$inforequest -> ID}}"></div>

                                               

                                                 <input type="hidden" name = "ID"  id="ID"  value="{{ $inforequest -> ID}}">
                                                 <input type="hidden" name = "TOP_LEADER_AC_ID"  id="TOP_LEADER_AC_ID"  value="{{ $id_user }} ">
                                                    <label style="float:left;">ความเห็นผู้อนุมัติ</label><br>

                                                    <textarea   name = "TOP_LEADER_AC_COMMENT"  id="TOP_LEADER_AC_COMMENT" class="form-control input-lg" ></textarea>
                                                    <br>

                                                    <div class="modal-footer">
                                                    <div align="right">
                                                    <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" style="font-family: 'Kanit', sans-serif;font-weight:normal;">อนุมัติ</button>
                                                    <button type="submit"  name = "SUBMIT"  class="btn btn-danger btn-lg" value="not_approved" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ไม่อนุมัติ</button>
                                                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ปิดหน้าต่าง</button>

                                                    </div>
                                                    </div>
                                                    </form>
                                        </body>


                                            </div>
                                            </div>
                                        </div>


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
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail'+id).html(result);


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