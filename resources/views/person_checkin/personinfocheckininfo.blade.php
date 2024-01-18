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

  $dat_b = date('Y-m').'-01';
  $dat_e = date('Y-m').'-30';
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
                                <a href="{{ url('person_checkin/personcheckin/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ลงเวลาปฎิบัติงาน</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_checkin/personcheckininfo/'.$id_user)}}" class="btn btn-primary loadscreen" >ข้อมูลการลงเวลา</a>
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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการลงเวลา</B></h3>
                        {{-- </div> --}}
                        <div align="right ">
                           
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
                                <a href="{{ url('person_checkin/excel_checkin',['iduser'=>  $inforpersonuserid->ID]) }}" class="btn btn-success " ><i class="fas fa-file-excel text-white" style="font-size:17px"></i>&nbsp;&nbsp;Export Excel</a> 
                          
                               
                        </div>
            </div>

                <div class="block-content block-content-full">
                        <form action="{{ route('checkin.searchinfo',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
                                @csrf
                        <div class="row">
                            <div class="col-md-0.5">
                                &nbsp;&nbsp; วันที่ &nbsp;
                            </div>
                            <div class="col-md-2">
                             
                                    @if($displaydate_bigen=='')
                                        <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($dat_b) }}" readonly>
                                    @else
                                        <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                                    @endif
                                </div>
                            
                            <div class="col-md-0.5">
                                &nbsp;ถึง &nbsp;
                            </div>
                            <div class="col-md-2">
                               
                                @if($displaydate_end=='')
                                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($dat_e) }}" readonly>
                                @else
                                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                                @endif
                            </div>
                            <div class="col-md-0.5">
                                &nbsp;สถานะ &nbsp;
                            </div>
                            <div class="col-md-2">
                                <span>
                                    <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--ทั้งหมด--</option>
                                        @if($status_check == 1)<option value="1" selected>บันทึกเข้า</option>@else<option value="1">บันทึกเข้า</option> @endif
                                        @if($status_check == 2)<option value="2" selected>บันทึกออก</option>@else<option value="2">บันทึกออก</option> @endif  
                                           
                                                
                                           
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
                            <div class="col-md-1">
                                <span>
                                    <button type="submit" class="btn btn-info" >ค้นหา</button>
                                </span>
                            </div>
                        </div>
                    </form>
             <div class="panel-body" style="overflow-x:auto;">
                        
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                         <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="5%" >ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="12%" >วันที่</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">เวลา</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%">ประเภทการลง</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%">ประเภทเวร</th>

                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%">ชื่อเวร</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="8%">เวลาเวร</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="20%" >หน่วยงาน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">สาย</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ออกก่อน</th>
                                        <th  style="border-color:#F0FFFF;text-align: center;" >รูปภาพ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center"  width="12%">คำสั่ง</th>



                                    </tr>
                                </thead>
                                <tbody>

                               <?php $number = 0 ;?>
                                @foreach ($inforcheckins as $inforcheckin)
                                <?php $number++;?>


                                    <tr height="20">
                                    <td class="text-font" align="center">{{  $number }}</td>
                                        <td class="text-font" align="center">{{  DateThai($inforcheckin->CHEACKIN_DATE) }}</td>
                                        <td class="text-font" align="center">{{  $inforcheckin->CHEACKIN_TIME }}</td>
                                        <td class="text-font" align="center">{{  $inforcheckin->CHECKIN_TYPE_NAME }}</td>
                                        <td class="text-font" align="center">{{  $inforcheckin->OPERATE_TYPE_NAME }}</td>
                                        <td class="text-font" align="center">{{  $inforcheckin->OPERATE_JOB_NAME }}</td>
                                        <td class="text-font" align="center">{{  substr($inforcheckin->OPERATE_JOB_TIMEBIGEN,0,5) }} - {{  substr($inforcheckin->OPERATE_JOB_TIMEEND,0,5) }}</td>

                                        <td class="text-font text-pedding" >{{  $inforcheckin->HR_DEPARTMENT_SUB_SUB_NAME }}</td>


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
                                        <td align="center"><span class="fa fa-window-close"></span></td>
                                        @else
                                        <td align="center">
                                        <a href="#img_modal{{ $inforcheckin -> CHECKIN_ID }}"  data-toggle="modal" class="btn btn-warning "><i class="fa fa-image"></i></a>
                                        </td>

                                        @endif

                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $inforcheckin -> CHECKIN_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>

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
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforcheckin -> HR_PREFIX_NAME }}   {{ $inforcheckin -> HR_FNAME }}  {{ $inforcheckin -> HR_LNAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >ตำแหน่ง :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
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
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  DateThai($inforcheckin->CHEACKIN_DATE) }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >เวลา :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
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
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->OPERATE_JOB_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label>ประเภทเวร :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
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
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->HR_DEPARTMENT_SUB_SUB_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label>ประเภทการลงเวลา :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
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
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{  $inforcheckin->CHECKIN_REMARK }}</h1>
           </div>
       </div>

      </div>


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
