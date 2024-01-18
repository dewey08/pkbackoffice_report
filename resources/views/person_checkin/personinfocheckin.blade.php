
@extends('layouts.backend')

<meta http-equiv="Content-Security-Policy"  name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    .time-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 10vh;
    }
    .time-container #displayTime {
      display: flex;
      align-self: center;
      font-size: 5rem;

    }
</style>


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
  

    $datenow = date('Y-m-d');
?>
<body onload="startTime()">

                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('person_checkin/personcheckin/'.$id_user)}}" class="btn btn-info loadscreen" >ลงเวลาปฎิบัติงาน</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_checkin/personcheckininfo/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ข้อมูลการลงเวลา</a>
                                </div>
                                <div>&nbsp;</div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                    <div class="content content-full">
                    <div class="block block-rounded block-bordered">
                           <br>
                            <div class="time-container">
                            <h1 id="displayTime"></h1>
                            </div>
                            <center>{{ DateThai($datenow) }}</center>
                            <br>
                            <br>
                            <center>
                            <div class="content">
                        <div class="row push">
                            <div class="col-sm-6 col-md-6 invisible" data-toggle="appear">
                                <a class="block block-rounded block-link-pop" href="{{ url('person_checkin/personcheckin_check/1/'.$id_user)}}">
                                    <div class="block block-rounded text-center bg-success">
                                        <div class="block-content">

                                            <span>
                                            <i class="far fa-5x fa fa-sign-in-alt text-white "></i>
                                            </span>

                                        </div>
                                        <div class="block-content">
                                            <p class="text-white text-uppercase font-w1000" style="font-size: 40px;">
                                              บันทึกเวลาเข้า
                                            </p>
                                        </div>
                                    </div>
                                </a>
                              </div>
                              <div class="col-sm-6 col-md-6 invisible" data-toggle="appear">
                                    <a class="block block-rounded block-link-pop" href="{{ url('person_checkin/personcheckin_check/2/'.$id_user)}}">
                                      <div class="block block-rounded text-center bg-danger">
                                          <div class="block-content">

                                          <span>
                                          <i class="far fa-5x fa fa-sign-out-alt text-white "></i>
                                          </span>

                                      </div>
                                      <div class="block-content">
                                          <p class="text-white text-uppercase font-w1000" style="font-size: 40px;">
                                              บันทึกเวลาออก
                                          </p>
                                      </div>

                                    </div>
                                </div>
                              </a>
                          </div>



                            <B style="font-size: 20px;">ลงข้อมูลวันที่ {{DateThai(date('Y-m-d'))}} </B>


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




                    </div>
                </div>

</body>





@endsection

@section('footer')

 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>

<script>

function startTime(){
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById("displayTime").innerHTML = h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
  function checkTime(i){
    if(i < 10){
      i = "0" + i
    }
    return i;
  }
}

</script>



@endsection
