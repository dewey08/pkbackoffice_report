@extends('layouts.risk')   
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

                    .text-pedding {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            
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
      
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานการบริหารจัดการความเสี่ยงขององค์กร/หน่วยงาน(Risk Incidents Profile)</B></h3>   
                <div align="right ">
                    <a href="{{ url('manager_risk/report_riskincedentsprofile_excel')}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                    <a class="btn btn-success" href="{{url('manager_risk/report')}}" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-chevron-circle-left text-white-70" style="font-size:18px;"></i>&nbsp;&nbsp;ย้อนกลับ</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                  </div>
                </div>
         
                            <form action="{{ route('mrisk.report_riskincedentsprofile_search') }}" method="post">
                                @csrf
            
                                <div class="row">
                                    <div class="col-sm-0.5">
                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ปีงบ &nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-sm-1.5">
                                        <span>
                                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget"
                                                style=" font-family: 'Kanit', sans-serif;">
                                                @foreach ($budgets as $budget)
                                                    @if ($budget->LEAVE_YEAR_ID == $year_id)
                                                        <option value="{{ $budget->LEAVE_YEAR_ID }}" selected>
                                                            {{ $budget->LEAVE_YEAR_ID }}</option>
                                                    @else
                                                        <option value="{{ $budget->LEAVE_YEAR_ID }}">{{ $budget->LEAVE_YEAR_ID }}
                                                        </option>
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
            
                                                <input name="DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker"
                                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>
            
                                            </div>
                                            <div class="col-sm">
                                                ถึง
                                            </div>
                                            <div class="col-md-4">
            
                                                <input name="DATE_END" id="DATE_END" class="form-control input-lg datepicker"
                                                    data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>
            
                                            </div>
                                        </div>
            
                                    </div>
                                    <div class="col-sm-0.5">
                                               &nbsp;สถานะ &nbsp;
                                           </div>                                
                                           <div class="col-sm-2">
                                               <span>                                
                                               <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                               <option value="">--ทั้งหมด--</option>                       
                                                    @foreach ($statuss as $status)
                                                               @if ($status->RISK_STATUS_NAME == $status_check)
                                                                   <option value="{{ $status->RISK_STATUS_NAME  }}" selected>{{ $status->RISK_STATUS_NAME_TH}}</option>
                                                               @else
                                                                   <option value="{{ $status->RISK_STATUS_NAME  }}" >{{ $status->RISK_STATUS_NAME_TH}}</option>
                                                               @endif
                                                           @endforeach     
                                               </select>
                                               </span>
                                           </div>
                                    <div class="col-sm-0.5">
                                        &nbsp;คำค้นหา &nbsp;
                                    </div>
                                    <div class="col-sm-2">
                                        <span>
                                            <input type="search" name="search" class="form-control"
                                                style="font-family: 'Kanit', sans-serif;font-weight:normal;"
                                                value="{{ $search }}">
                                        </span>
                                    </div>
                                    <div class="col-sm-30">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-1.5">
                                        <span>
                                            <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i
                                                    class="fas fa-search mr-2"></i>ค้นหา</button>
                                        </span>
                                    </div>
                                </div>
            
            
            
                            </form>
        <div class="block-content">  
            <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">

                            <th class="text-font" style="text-align: center;" width="4">ลำดับ</th>
                            <th class="text-font" style="text-align: center;" width="8%">สถานะ</th>
                            {{-- <th class="text-font" style="text-align: center;" width="9%">ทบทวน</th> --}}
                            <th class="text-font" style="text-align: center;" width="9%">ความรุนแรง</th>
                            <th class="text-font" style="text-align: center;" width="10%">วันที่บันทึก</th>
                            <th class="text-font" style="text-align: center;" width="13%">ที่มา</th>
                            {{-- <th  class="text-font" style="text-align: center;"  width="15%">เรื่อง</th> --}}
                            <th class="text-font" style="text-align: center;">รายละเอียดเหตุการณ์</th>
                            <th class="text-font" style="text-align: center;" width="20%">การจัดการเบื้องต้น</th>
                            {{-- <th  class="text-font" style="text-align: center;" width="10%">วันที่รายงาน</th> --}}


                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>
                        @foreach ($rigreps as $rigrep)
                            <?php
                            $number++;
                            $status = $rigrep->RISKREP_STATUS;

                            if ($status === 'CONFIRM') {
                            $statuscol = 'badge badge-primary';
                            } elseif ($status === 'REPORT') {
                            $statuscol = 'badge badge-warning';
                            } elseif ($status === 'ACCEPT') {
                            $statuscol = 'badge badge-danger';
                            } elseif ($status === 'CHECK') {
                            $statuscol = 'badge badge-info';
                            } elseif ($status === 'SUCCESS') {
                            $statuscol = 'badge badge-success';
                            } else {
                            $statuscol = 'badge badge-secondary';
                            }

                            $level = $rigrep->RISKREP_LEVEL;

                            if ($level === '1') {
                                    $statuslevel = 'badge badge-success';
                                    } elseif ($level === '2') {
                                    $statuslevel = 'badge badge-success';
                                    } elseif ($level === '3') {
                                    $statuslevel = 'badge badge-info';
                                    } elseif ($level === '4') {
                                    $statuslevel = 'badge badge-info';
                                    } elseif ($level === '5') {
                                    $statuslevel = 'badge badge-warning';
                                    } elseif ($level === '6') {
                                    $statuslevel = 'badge badge-warning';                                  
                                    } elseif ($level === '7') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '8') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '9') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '10') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '11') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '12') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '13') {
                                    $statuslevel = 'badge badge-danger';
                                    } elseif ($level === '14') {
                                    $statuslevel = 'badge badge-danger';
                                    } else {
                                    $statuslevel = '';
                                    }

                            
                            ?>

                            <tr height="20">
                                <td class="text-font text-pedding" align="center" width="4%">{{ $number }}</td>

                                <td align="center" style="vertical-align: top;" class="text-pedding"> <span class="{{ $statuscol }}"
                                        width="8%">{{ $rigrep->RISK_STATUS_NAME_TH }}</span></td>
                                <td align="center" style="vertical-align: top;" class="text-pedding"> <span class="{{ $statuslevel }}" width="8%" style=" font-size: 20px;">{{ $rigrep->RISK_REP_LEVEL_NAME }}</span></td>
                                <td class="text-font text-pedding" style="text-align: center;vertical-align: top;"  width="10%">
                                    {{ DateThai($rigrep->RISKREP_DATESAVE) }}</td>
                                <td class="text-font text-pedding" style="text-align: left;vertical-align: top;"width="13%">
                                    {{ $rigrep->INCIDENCE_LOCATION_NAME }}</td>
                                <td class="text-font text-pedding">{!! $rigrep->RISKREP_DETAILRISK !!}</td>
                                <td class="text-font text-pedding" style="text-align: left;">{!! $rigrep->RISKREP_BASICMANAGE !!}
                                </td>
        
                          
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
</script>

@endsection