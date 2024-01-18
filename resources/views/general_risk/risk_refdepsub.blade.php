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
    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
            }
</style>
<style>
       
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
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

use App\Http\Controllers\RiskController;
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
                                        <a href="{{ url('general_risk/dashboard_risk/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                            
                                            <span class="nav-main-link-name">Dashboard</span>
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refteam/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงทีม</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refdep/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงกลุ่มงาน</a>
                                </div>
                                <div>&nbsp;</div>

                                <div>
                                <a href="{{ url('general_risk/risk_refdepsub/'.$inforpersonuserid -> ID)}}"class="btn btn-danger" >อ้างอิงฝ่าย</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refdepsubsub/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงหน่วยงาน</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_risk/risk_refperson/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อ้างอิงบุคคล</a>
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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลความเสี่ยงอ้างอิงฝ่าย</B></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <form action="{{ route('gen_risk.risk_refdepsub_search',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
                                @csrf
               
                            <div class="row">
                            <div class="col-sm-0.5">
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ปีงบ &nbsp;&nbsp;&nbsp;
                                           </div>
                                           <div class="col-sm-1.5">
                                               <span>
                                                   <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
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
                                           {{-- <div class="col-sm-0.5">
                                               &nbsp;สถานะ &nbsp;
                                           </div>                                
                                           <div class="col-sm-2">
                                               <span>                                
                                               <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                               <option value="">--ทั้งหมด--</option>                       
                                                    @foreach ($statuss as $status)
                                                               @if($status->RISK_STATUS_NAME == $status_check)
                                                                   <option value="{{ $status->RISK_STATUS_NAME  }}" selected>{{ $status->RISK_STATUS_NAME_TH}}</option>
                                                               @else
                                                                   <option value="{{ $status->RISK_STATUS_NAME  }}" >{{ $status->RISK_STATUS_NAME_TH}}</option>
                                                               @endif
                                                           @endforeach     
                                               </select>
                                               </span>
                                           </div>     --}}
                                           <div class="col-sm-0.5">
                                               &nbsp;คำค้นหา &nbsp;
                                           </div>                            
                                           <div class="col-sm-2">
                                               <span>                            
                                                   <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                                               </span>
                                           </div>     
                                           <div class="col-sm-30">
                                           &nbsp;
                                       </div>                   
                                           <div class="col-sm-1">
                                               <span>
                                                   <button type="submit" class="btn btn-info" >ค้นหา</button>
                                               </span> 
                                           </div>              
                                       </div>  
               
               
                                
                            </form>
                         <div class="table-responsive"> 
                                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                        <thead style="background-color: #FFEBCD;">
                                            <tr height="40">
                                                
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5">ลำดับ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="10%">เอกสาร 1</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="10%">เอกสาร 2</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%" >วันที่บันทึก</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="15%" >หัวข้อ</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%">ทบทวน(ครั้ง)</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ตอบรับ(ครั้ง)</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">รายละเอียด</th>
                                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%" >คำสั่ง</th> 
                                                    
                                                </tr >
                                            </thead>
                                            <tbody>
                                                <?php $number = 0; ?>
                                                @foreach ($rigreps as $rigrep)
                                                    <?php $number++; ?>
                                                <tr height="20">
                                                <td class="text-font" align="center">{{ $number}}</td>
                                              
                                                @if($rigrep->RISKREP_DOCFILE == !null)
                                                <td  align="center" ><span class="btn fa fa-1.5x fa-file-alt" style="background-color:#FF6347;color:#F0FFFF;" ></span></td>
                                                @else
                                                <td  align="center" ></td>
                                                @endif
                                                @if($rigrep->RISKREP_DOCFILE2 == !null)
                                                <td  align="center" ><span class="btn fa fa-1.5x fa-file-alt" style="background-color:#29E9AD;color:#F0FFFF;"></span></td>
                                                @else
                                                <td  align="center" ></td>
                                                @endif
            
                                                <td class="text-font text-pedding" style="text-align: left;" >{{DateThai($rigrep->RISKREP_DATESAVE)}}</td>
                                                <td class="text-font text-pedding" style="text-align: left;">{{$rigrep->INCIDENCE_SETTING_NAME}}</td>
                                                <td class="text-font text-pedding" style="text-align: center;" >
                                                    {{RiskController::checkrepeat_sub($rigrep->RISKREP_ID)}}       
                                                </td>
                                                <td class="text-font text-pedding" style="text-align: center;" >
                                                    {{RiskController::checkaccept_sub($rigrep->RISKREP_ID)}}  
                                                </td>
                                                <td class="text-font text-pedding" >{!!$rigrep->RISKREP_DETAILRISK!!}</td>
                                                <td align="center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                        <div class="dropdown-menu" style="width:10px">      
                                                                 
                                                                <a class="dropdown-item"  href="{{ url('general_risk/risk_notify_detail/'.$rigrep->RISKREP_ID.'/'.$inforpersonuserid -> ID)}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">รายละเอียด</a> 
                                                                <a class="dropdown-item"  href="{{ url('general_risk/risk_notify_repeat_u/'.$rigrep->RISKREP_ID.'/'.$inforpersonuserid -> ID)}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ทวทวน</a>
                                                                <a class="dropdown-item"  href="{{ url('general_risk/risk_notify_accept_u/'.$rigrep->RISKREP_ID.'/'.$inforpersonuserid -> ID)}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ตอบรับ</a>                      
                                                                <a class="dropdown-item"  href="{{ url('general_risk/risk_notify_edit/'.$rigrep->RISKREP_ID.'/'.$inforpersonuserid -> ID)}}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>
                                                                <a class="dropdown-item"  href="" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ลบ</a>
                                                            </div>
                                                        </div>
                                                    </td>                                    
                                                </tr>
                                                @endforeach     
                        
                                            </tbody>
            
                                </table>
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

     
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection