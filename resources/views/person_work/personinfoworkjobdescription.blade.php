@extends('layouts.general.person_work')
@section('css_after_infowork')
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
    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }
    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
    }
    .text-font {
        font-size: 13px;
    }
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    }
    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
    }
</style>
<link rel="stylesheet" href="{{asset('css/stylesl.css')}}">
@endsection
@section('content_infowork')
<?php
use App\Models\Infowork_job_person_list;

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
    // date_default_timezone_set("Asia/Bangkok");
?>
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>Job description</B>
            </h3>
        </div>
        <div class="block-content block-content-full">
            <form class="mb-2" action="{{route('person.infowork.jobdescriptions',auth::user()->PERSON_ID)}}" method="post">
            @csrf
                <div class="row">
                    <div class="col-md-1 col-form-label">ปีงบประมาณ</div>
                    <div class="col-md-2">
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg budget"
                            style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
                            @foreach($drop_budgetyear as $value)
                            @if($budgetyear == $value)
                            <option value="{{$value}}" selected>{{$value}}</option>
                            @else
                            <option value="{{$value}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 col-form-label">ค้นหา</div>
                    <div class="col-md-3">
                            <input type="search" name="search" class="form-control"
                                style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                value="{{$search}}" placeholder="ค้นหา">
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-sm btn-info">ค้นหา</button>
                    </div>
                </div>
            </form>
            <table class="gwt-table table-striped table-vcenter" width="100%">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                    <col width="15%">
                </colgroup>
                <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                        <th class="text-font" width="5%" style="border-color:#F0FFFF; text-align: center;">ลำดับ</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">ลักษณะหน้าที่(JD-Job description)</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">ผลที่คาดหวัง</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">ตัวชี้วัด</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">เป้า</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">สถานะ</th>
                        <th class="text-font" style="border-color:#F0FFFF; text-align: center;">วันที่</th>
                        <?php /*
                        <th>คำสั่ง</th>
                        */ ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $number= 0; ?>
                    @foreach ($infowork_person as $row)
                    <?php
                        $kpi_person = Infowork_job_person_list::leftJoin('infowork_kpi','infowork_kpi.IWKPI_ID','infowork_job_person_list.IWKPI_ID')->where('IWJOB_PERSON_ID',$row->IWJOB_PERSON_ID)->get();
                        $countrow = (count($kpi_person) != 0)?count($kpi_person):0;
                    ?>
                    <?php $number++;  ?>
                    <tr height="20">
                        <td rowspan="{{$countrow}}" class="text-font text-pedding text-center">{{$number}}</td>
                        <td rowspan="{{$countrow}}" class="text-font text-pedding">{{$row->IWJD_NAME}}</td>
                        <td rowspan="{{$countrow}}" class="text-center">{{$row->IWJOB_EXPECTED_RESULT}}</td>
                        <td class="p-1"><?=($countrow != 0)?'&nbsp;&nbsp;&nbsp;-'.$kpi_person[0]->IWKPI_NAME:''?></td>
                        <td class="p-1 text-center"><?=($countrow != 0)?$kpi_person[0]->IWJPL_TARGET:''?></td>
                        <td rowspan="{{$countrow}}" class="text-center">
                            @if($row->IWJOB_BE_INFORMED)
                                <div class="badge badge-success fs-14 f-i"><i class="far fa-check-circle"></i> รับทราบ</div>
                            @else
                                <a href="#" onclick="be_informed(this,'{{$row->IWJOB_PERSON_ID}}')" class="badge badge-info fs-14 f-i" style="color:white"><i class="far fa-circle"></i> งานมอบหมาย</a>
                            @endif
                        </td>
                        <td rowspan="{{$countrow}}" class="p-1">
                            วันที่มอบหมาย : {{DateThai(date('Y-m-d',strtotime($row->created_at)))}} <br>
                            วันที่รับทราบ : <?=(!empty($row->IWJOB_BE_INFORMED_DATE))?DateThai($row->IWJOB_BE_INFORMED_DATE):''?>
                        </td>
                
                    </tr>
                    @for($i=1;$i<$countrow;$i++)
                    <tr>
                        <td class="p-1">&nbsp;&nbsp;&nbsp;- {{$kpi_person[$i]->IWKPI_NAME}}</td>
                        <td class="p-1 text-center">{{$kpi_person[$i]->IWJPL_TARGET}}</td>
                    </tr>
                    @endfor
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('footer_infowork')
    <script>
        function checklogin(){
            window.location.href = '{{route("index")}}';
        }
    </script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>
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
<script>
    function be_informed(e,id_job_person){
        $.ajax({
            url: "{{route('person.infowork.update_be_informed',$person_id)}}",
            method: 'post',
            data:{
                _token:$('meta[name="csrf-token"]').attr('content'),
                id_job_person:id_job_person
            },
            success:function(result){
                $(e).parent().html(`<div class="badge badge-success fs-14 f-i"><i class="far fa-check-circle"></i> รับทราบ</div>`)
            }
        });
    }
</script>
@endsection
