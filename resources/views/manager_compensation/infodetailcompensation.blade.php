@extends('layouts.compensation')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.css')}}">
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


    use App\Http\Controllers\ManagercompensationController;

?>
<?php
    function month($strMonth)
    {

    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strMonthThai";
    }
 
?>          

<center>    
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลประจำเดือน</B></h3>
                <a href="{{ url('manager_compensation/callcompensation') }}"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ประมวลผล</a>
            </div>
            <div class="block-content block-content-full">
            <form action="{{ route('mcompensation.infodetailcompensation') }}" method="post">
                @csrf
                <div class="row">  
                    <div class="col-md-0.5" style="  font-size: 13px;";>
                     &nbsp;ปี &nbsp;
                     </div>

                       <div class="col-md-1">
                       <span>

                       <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                      
                       @foreach ($budgets as $budget)
                                                @if($budget->LEAVE_YEAR_ID == $year_id)                                                     
                                            <option value="{{ $budget ->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                                @else
                                            <option value="{{ $budget ->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                            @endif
                                                              
                                    @endforeach                           

                    </select>
                     </span>
                      </div>
                        <div class="col-md-0.5">
                            &nbsp;&nbsp; เดือน &nbsp;
                        </div>
                        <div class="col-md-2">
                     
                        <select name="MONTH_ID" id="MONTH_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                        <option value="" >--ทุกเดือน--</option>    
                       @if($m_budget == 1)<option value="1" selected>มกราคม</option>@else<option value="1">มกราคม</option>@endif
                       @if($m_budget == 2)<option value="2" selected>กุมภาพันธ์</option>@else<option value="2" >กุมภาพันธ์</option>@endif
                       @if($m_budget == 3)<option value="3" selected>มีนาคม</option>@else<option value="3" >มีนาคม</option>@endif
                       @if($m_budget == 4)<option value="4" selected>เมษายน</option>@else<option value="4" >เมษายน</option>@endif
                       @if($m_budget == 5)<option value="5" selected>พฤษภาคม</option>@else<option value="5" >พฤษภาคม</option>@endif
                       @if($m_budget == 6)<option value="6" selected>มิถุนายน</option>@else<option value="6" >มิถุนายน</option>@endif
                       @if($m_budget == 7)<option value="7" selected>กรกฎาคม</option>@else<option value="7" >กรกฎาคม</option>@endif
                       @if($m_budget == 8)<option value="8" selected>สิงหาคม</option>@else<option value="8" >สิงหาคม</option>@endif
                       @if($m_budget == 9)<option value="9" selected>กันยายน</option>@else<option value="9" >กันยายน</option>@endif
                       @if($m_budget == 10)<option value="10" selected>ตุลาคม</option>@else<option value="10" >ตุลาคม</option>@endif
                       @if($m_budget == 11)<option value="11" selected>พฤศจิกายน</option>@else<option value="11" >พฤศจิกายน</option>@endif
                       @if($m_budget == 12)<option value="12" selected>ธันวาคม</option>@else<option value="12" >ธันวาคม</option>@endif
                   

                    </select>
                        </div>

                 
                        
                        <div class="col-md-0.5">
                            &nbsp;&nbsp; ประเภท &nbsp;
                        </div>
                        <div class="col-md-2">

                                <select name="TYPE_CODE" id="TYPE_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">   
                                <option value="" >--ทั้งหมด--</option>                                        
                                @if($typecode == 'salary')<option value="salary" selected>เงินเดือน</option>@else<option value="salary" >เงินเดือน</option>@endif
                                @if($typecode == 'compen')<option value="compen" selected>ค่าตอบแทน</option>@else<option value="compen" >ค่าตอบแทน</option>@endif                        
                                </select>

                        </div>
                        <div class="col-md-1.5">
                            <span>
                                <button type="submit" class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-search mr-2"></i> ค้นหา</button>
                            </span> 
                        </div>


                        <div class="col-md-1">
                      &nbsp;
                       </div>

                       <div class="col-md-3">
                       รายการรวม {{$counthead}} มูลค่ารวม {{number_format($sumamountall,2)}} บาท
                 </div>
                          
                        
                    </div>  
            </form>
             <div class="table-responsive"> 
           
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">วันที่ทำรายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ผู้บันทึก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ส่งไลน์</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>

                    
                    <?php $count=1;?>
                     @foreach ($infosalaryheads as $infosalaryhead)
                        <tr height="20">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" align="center">{{$infosalaryhead->SALARYALL_HEAD_DAY_ID}} {{month($infosalaryhead->SALARYALL_HEAD_MONTH_ID)}} {{$infosalaryhead->SALARYALL_HEAD_YEAR_ID}}</td>
                        <td class="text-font text-pedding" >
                           @if($infosalaryhead->SALARYALL_HEAD_TYPE == 'compen')
                               ค่าตอบแทน
                           @else
                                เงินเดือน
                           @endif
                        </td>
                        <td class="text-font text-pedding" align="right">{{number_format(ManagercompensationController::compensationvalue($infosalaryhead->SALARYALL_HEAD_ID),2)}}</td>
                        <td class="text-font text-pedding" >{{$infosalaryhead->SALARYALL_HEAD_HR_SAVE}}</td>
                        <td align="center">
                            @if($infosalaryhead->SALARYALL_IS_SENDED)
                            <a href="{{route('mcompensation.infodetailcompensation_linenotify',$infosalaryhead->SALARYALL_HEAD_ID)}}" onclick="return disablesend_again()" class="badge badge-success py-1 px-2 fw-b ml-1 fs-16"><i class="si si-refresh"></i></a>
                            @else
                            <a id="send_id_{{$infosalaryhead->SALARYALL_HEAD_ID}}" href="{{route('mcompensation.infodetailcompensation_linenotify',$infosalaryhead->SALARYALL_HEAD_ID)}}" onclick="return disablesend()" class="badge badge-info py-1 px-2 fw-b ml-1 fs-16"><i class="fa fa-envelope"></i></a>
                            @endif
                        </td>
                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                             
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/callcompensationdetail_sub/'.$infosalaryhead->SALARYALL_HEAD_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >รายละเอียด</a>

                                                <a class="dropdown-item"  href="{{ url('manager_compensation/reportcallcompensationdetail_excel/'.$infosalaryhead->SALARYALL_HEAD_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >Excel รายงานสรุป</a>
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/pdfcompensation/export_pdfcompensation/'.$infosalaryhead->SALARYALL_HEAD_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >PDF</a>
                                            </div>
                                        </div>
                                        </td>     
                        </tr>
                        <?php  $count++;?>
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
 <script src="{{asset('asset/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
let check_btn_send = false;
function disablesend() {
    if(check_btn_send){
        return false;
    }
    swal.fire('กำลังทำรายการ','กรุณารอสักครู่...','info')
    check_btn_send = true;
    return true;
}

function disablesend_again(){
    if(check_btn_send){
        return false;
    }
    if(!confirm('ต้องการส่งไลน์ไปยังบุคคลอีกครั้งจริงหรือไม่ ?')){
        return false;
    }
    swal.fire('กำลังทำรายการ','กรุณารอสักครู่...','info')
    check_btn_send = true;
    return true;
}

function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
               datepick()
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}

datepick()
   function datepick() {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    }
</script>

@endsection