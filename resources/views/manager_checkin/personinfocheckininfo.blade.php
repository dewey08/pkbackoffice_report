@extends('layouts.personcheck')

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

<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B> ข้อมูลการลงเวลา {{$infouser->HR_FNAME}} {{$infouser->HR_LNAME}}</B></h3>
                            
                        </div>
                        <div class="block-content block-content-full">
                       
<div class="panel-body" style="overflow-x:auto;">  
                           
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                         <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="5%" >ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="15%" >วันที่</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เวลา</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="15%">ประเภทการลง</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="15%">ประเภทเวร</th>

                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"  width="10%">ชื่อเวร</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="20%" >หมายเหตุ</th>

                                        <th  style="border-color:#F0FFFF;text-align: center;" >รูปภาพ</th>




                                    </tr >
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
                                        <td class="text-font text-pedding" >{{  $inforcheckin->CHECKIN_REMARK }}</td>

                                        @if($inforcheckin->IMG == "")
                                        <td align="center"><span class="fa fa-window-close"></span></td>
                                        @else
                                        <td align="center">
                                        <a href="#img_modal{{ $inforcheckin -> CHECKIN_ID }}"  data-toggle="modal" class="btn btn-warning  fa fa-image"></a>
                                        </td>

                                        @endif

                                        
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection
