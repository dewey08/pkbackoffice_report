@extends('layouts.personcheck')
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


    .text-pedding{
    padding-left:10px;
                        }

            .text-font {
        font-size: 13px;
                    }
        }

        .form-control{
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

    function Datetime($time_a,$time_b)
{
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));
    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
   
    return $time_diff_h." ชม. ".$time_diff_m." น. ";
  
    }
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');


use App\Http\Controllers\ManagercheckinController;
    use Illuminate\Support\Facades\DB;
    use App\Checkin;
?>
<center>    
    <div class="block" style="width: 95%;">

                          <!-- Dynamic Table Simple -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการลงเวลา</B></h3>
                   
                        <div align="right ">
                            <a href="{{ url('manager_checkin/excel_checkin_new')}}" class="btn btn-hero-sm btn-hero-success" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;"><i class="fas fa-file-excel text-white" style="font-size:17px"></i>&nbsp;&nbsp;Export Excel</a> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                        </div>
            </div>
                       <div class="block-content block-content-full">
                            <form method="post">
                            @csrf
                                <div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="col-sm-1.5"> จำนวนคนที่ลงเวลาวันนี้ &nbsp;&nbsp; {{ $inforcheckin_counts}}       
                                    </div>                                                   
                                    <div class="col-sm-4 date_budget">
                                        <div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="col-sm">วันที่</div>
                                        <div class="col-md-4">  
                                        <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ toDatePicker($displaydate_bigen) }}" readonly>
                                        </div>
                                        <div class="col-sm"> ถึง </div>
                                        <div class="col-md-4">   
                                        <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ toDatePicker($displaydate_end) }}" readonly>   
                                        </div>
                                    </div>            
                                    </div>                            
                                    <div class="col-md-0.5">
                                        &nbsp;สถานะ &nbsp;
                                    </div>
                                    <div class="col-md-2">
                                        <span>
                                            <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                <option value="">--ทั้งหมด--</option>
                                                
                                                    @foreach ($checkintypes as $checkintype)
                                                        @if( $checkintype->CHECKIN_TYPE_ID == $status_check)
                                                        <option value="{{ $checkintype->CHECKIN_TYPE_ID  }}" selected>{{ $checkintype->CHECKIN_TYPE_NAME}}</option>
                                                        @else
                                                        <option value="{{ $checkintype->CHECKIN_TYPE_ID  }}">{{ $checkintype->CHECKIN_TYPE_NAME}}</option>
                                                        @endif
                                                        
                                                    @endforeach
                                            </select>
                                    </span>
                                    </div>
                                    <div class="col-md-0.5">
                                        &nbsp;คำค้นหา &nbsp;
                                    </div>
                                    <div class="col-md-2">
                                        <span>
                                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}" >
                                        
                                        </span>
                                    </div>
                                    <div class="col-md-30">
                                        &nbsp;
                                    </div>
                                    <div class="col-md-1.5">
                                        <span>
                                            <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                      
                    <div class="panel-body" style="overflow-x:auto;">  
                           
                           <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                               <thead style="background-color: #FFEBCD;">
                                   <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" >ลำดับ</th>
                                       <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%" >วันที่</th>
                                       <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">เวลา</th>
                                       <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"width="12%">ชื่อ-นามสกุล</th>
                                       <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">หน่วยงาน</th>
                                       <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ประเภทการลง</th>
                                       <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ประเภทเวร</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ชื่อเวร</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เวลาเวร</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สาย</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ออกก่อน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">รูปภาพ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="7%">คำสั่ง</th>
                                   </tr >
                               </thead>
                               <tbody>
                              <?php $number = 0 ;?>
                               @foreach ($inforcheckins as $inforcheckin)
                               <?php $number++;?>
                             
                                   <tr height="20">
                                   <td class="text-font" align="center">{{  $number }}</td>
                                       <td class="text-font" align="center">{{  DateThai($inforcheckin->CHEACKIN_DATE) }}</td>
                                       <td class="text-font" align="center">{{ formatetime($inforcheckin->CHEACKIN_TIME)  }}</td>
                                       <td class="text-font" align="left">&nbsp;&nbsp;{{  $inforcheckin->HR_FNAME }}  &nbsp;&nbsp; {{  $inforcheckin->HR_LNAME }}</td>
                                       <td class="text-font" align="left">&nbsp;&nbsp;{{  $inforcheckin->HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                                       <td class="text-font" align="center">{{  $inforcheckin->CHECKIN_TYPE_NAME }}</td>
                                       <td class="text-font" align="center">{{  $inforcheckin->OPERATE_TYPE_NAME }}</td>
                                       <td class="text-font" align="center">{{  $inforcheckin->OPERATE_JOB_NAME }}</td>
                                       <td class="text-font" align="center">{{  substr($inforcheckin->OPERATE_JOB_TIMEBIGEN,0,5) }} - {{  substr($inforcheckin->OPERATE_JOB_TIMEEND,0,5) }}</td>

                                      @if(strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->CHEACKIN_TIME) > strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->OPERATE_JOB_TIMEBIGEN))
                                                    @if($inforcheckin->CHECKIN_TYPE_ID == "1")
                                                    <td class="text-font text-pedding" > {{Datetime($inforcheckin->CHEACKIN_TIME,$inforcheckin->OPERATE_JOB_TIMEBIGEN)}} </td>
                                                    @else                                                        
                                                    <td class="text-font text-pedding" > - </td>                                                        
                                                    @endif
                                        @else
                                                    <td class="text-font text-pedding" > - </td>
                                        @endif


                                        @if(strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->CHEACKIN_TIME) < strtotime($inforcheckin->CHEACKIN_DATE.' '.$inforcheckin->OPERATE_JOB_TIMEEND))
                                                @if($inforcheckin->CHECKIN_TYPE_ID == "2")
                                                <td class="text-font text-pedding" > {{Datetime($inforcheckin->CHEACKIN_TIME,$inforcheckin->OPERATE_JOB_TIMEEND)}} </td>                                    
                                                @else
                                                <td class="text-font text-pedding" > - </td>
                                                @endif

                                        @else
                                        <td class="text-font text-pedding" > - </td>
                                        @endif

                                        
                                       @if($inforcheckin->IMG == "")
                                       <td align="center"><i class="fa fa-window-close"></i></td>
                                       @else
                                       <td align="center">
                                       <a href="#img_modal{{ $inforcheckin -> CHECKIN_ID }}"  data-toggle="modal" class="btn btn-warning"><i class="fa fa-image"></i></a>
                                       </td>
                                       @endif
                                       <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $inforcheckin -> CHECKIN_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_checkin/inforpersoncheck_new_edit/'.$inforcheckin -> CHECKIN_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไข</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_checkin/inforpersoncheck_new_destroy/'.$inforcheckin -> CHECKIN_ID)}}"  onclick="return confirm('ต้องการที่จะลบข้อมูลลงเวลา ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                </div>
                                            </div>
                                        </td>                                       
                                   </tr>

                                                <div id="img_modal{{ $inforcheckin -> CHECKIN_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">

                                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">รูปภาพลงเวลาเลขที่ {{ $inforcheckin -> CHECKIN_ID }}</h2>
                                                    </div>
                                                    <div class="modal-body">
                                                    <center>
                                                    <img src="{{ $inforcheckin->IMG }}" height="300px" width="50%">
                                                    </center>


                                                    </div>
                                                    <div class="modal-footer">
                                                    <div align="right">
                                                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
                                                    </div>
                                                    </div>
                                                    </form>
                                                </body>

                                                </div>
                                                </div>
                                                </div>


                                                <div id="detail_modal{{ $inforcheckin -> CHECKIN_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                <div class="modal-header">

                                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">รายละเอียดเลขที่ {{ $inforcheckin -> CHECKIN_ID }}</h2>
                                                    </div>
                                                    <div class="modal-body">


                                                    <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label >ผู้ลงเวลา :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforcheckin -> HR_PREFIX_NAME }}   {{ $inforcheckin -> HR_FNAME }}  {{ $inforcheckin -> HR_LNAME }}</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                        <label >ตำแหน่ง :</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforcheckin ->HR_POSITION_NAME}}</h1>
                                                        </div>
                                                    </div>
                                                    </div>


                                                        <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label >วันที่ :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  DateThai($inforcheckin->CHEACKIN_DATE) }}</h1>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label >เวลา :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->CHEACKIN_TIME }}</h1>
                                                            </div>
                                                        </div>

                                                        </div>

                                                        <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label > ชื่อเวร :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->OPERATE_JOB_NAME }}</h1>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label>ประเภทเวร :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->OPERATE_TYPE_NAME }}</h1>
                                                            </div>
                                                        </div>

                                                        </div>

                                                        <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label >หน่วยงานเวร :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->HR_DEPARTMENT_SUB_SUB_NAME }}</h1>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label>ประเภทการลงเวลา :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->CHECKIN_TYPE_NAME }}</h1>
                                                            </div>
                                                        </div>

                                                        </div>

                                                        <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                            <label >หมายเหตุ :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->CHECKIN_REMARK }}</h1>
                                                            </div>
                                                        </div>

                                                        </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                        <div align="right">
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
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            todayHighlight: true,
                            language: 'th',
                            autoclose: true,
                            thaiyear: true
                        }) 
                     }
             })
             }        
     });

   $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                todayHighlight: true,
                language: 'th',
                autoclose: true,
                thaiyear: true
            }) 
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

</script>

@endsection
