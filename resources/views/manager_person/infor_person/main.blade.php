@extends('layouts.personhealth')

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

@section('content')

<style>
    .td-title{
        border-color:#F0FFFF;
        text-align: center;
        border: 1px solid black;
        font-size: 13px;
    }
    .td-content{
        border-color:#F0FFFF;
        font-family: 'Kanit', sans-serif;
        border: 1px solid black;
        font-size: 13px;
    }
    .dropdown-title{
        font-family: 'Kanit', sans-serif; 
        font-size: 13px;
        font-weight:normal;
    }
    .dropdown-content{
        font-family: 'Kanit', sans-serif; 
        font-size: 13px;
        font-weight:normal;
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
function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }

  function RemoveDateThairetire($strDate)
{

  $strMonth= date("n",strtotime($strDate));
  if($strMonth  > 9){
    $strYear = date("Y",strtotime($strDate))+543+61;
  }else{
    $strYear = date("Y",strtotime($strDate))+543+60;
  }

  return "30 ก.ย. $strYear";
  }

  function RemovegetAge($birthday) {
    $then = strtotime($birthday);
    return(floor((time()-$then)/31556926));
}

function RemovegetAgeretire($birthday) {
  $then = strtotime($birthday);

  return(60-(floor((time()-$then)/31556926)));
}



function Removeformate($strDate)
{
$strYear = date("Y",strtotime($strDate));
$strMonth= date("m",strtotime($strDate));
$strDay= date("d",strtotime($strDate));

return $strDay."/".$strMonth."/".$strYear;
}

use App\Http\Controllers\AbilityController;
?>
   <body>        
           <br>
           <br>
        <center>
                   
<div style="width:95%;" class="block block-rounded block-bordered">
    <div class="block-content block-content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-content">    
                {{-- หัวฟอร์ม --}}
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                    <div class="row">
                        <div class="col-md-6" align="left">
                            ข้อมูลทดสอบสมรรถภาพประจำปี
                        </div>
                        <div class="col-md-6" align="right">
                            <span>
                                <a href="{{ route('manager_person.health-check.form') }}" class="btn btn-info btn-md">
                                    <i class="fas fa-plus"></i>
                                    <span>เพิ่มข้อมูล</span>
                                </a>
                            </span>
                            {{-- <span style="margin-left: 10[x;">
                                <a href="#"  class="btn btn-success btn-md"  ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                            </span> --}}
                        </div>
                    </div>
                </h2>  
                                    
                {{-- ฟอร์มเมนูค้นหา  ปีงบ วันที่ ถึง วันที่ สถานะ ช่องค้นหา--}}
                {{-- <form action="{{ route('health.inforpersonhealth_search') }}" method="post"> --}}
                <form action="#" method="post">
                    @csrf
    
                    <div class="row">
                    <div class="col-sm-0.5">
                        &nbsp;&nbsp; ปี &nbsp;
                    </div>
                    <div class="col-sm-1.5">
                        <span>
                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="2565" selected>2565</option>
                                    <option value="2564">2564</option>                      
                                    <option value="2563">2563</option>                      
                                    <option value="2562">2562</option>                      
                                    <option value="2561">2561</option>                      
                                    <option value="2560">2560</option>                      
                            </select>
                        </span>
                    </div>
    
                    <div class="col-sm-4 date_budget">
                        <div class="row">
                            <?php $time_now = date("d/m/Y");?>
                            <div class="col-sm">
                                วันที่
                            </div>
                            <div class="col-md-4">
                                
                                {{-- <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly> --}}
                                <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="<?php echo $time_now ?>" readonly>
                            </div>
                            <div class="col-sm">
                                ถึง 
                            </div>
                            
                            <div class="col-md-4">
                                <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="<?php echo $time_now ?>" readonly>
                            </div>
                        </div>
                    </div>
    
                    {{-- เลือกสถานะ --}}
                    <div class="col-sm-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-sm-2">
                        <span>
                            <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="ALL">--ทั้งหมด--</option>
                            </select>
                        </span>
                    </div> 
    
                    <div class="col-sm-0.5">
                    &nbsp;ค้นหา &nbsp;
                    </div>
    
                    <div class="col-sm-2">
                        <span>
                        {{-- <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}"> --}}
                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="">
                        </span>
                    </div> 
                    <div class="col-sm-1">
                        <span>
                            <button type="submit" class="btn btn-info" >ค้นหา</button>
                        </span> 
                    </div>
    
    
                    </div>  
                </form>
                      
                {{-- data Table --}}
                <div class="panel-body" style="overflow-x:auto;">     
                    <div class="table-responsive">
                        <table class="table-striped table-vcenter js-dataTable-simple" width="100%">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <td width="%" class="text-font td-title text-center" width="7%">
                                        <span style="margin-right:3px;">ลำดับ</span>
                                    </td>
                                    <td width="10%" class="text-font td-title text-center" width="7%">
                                        <span style="margin-right:3px;">สถานะ</span>
                                    </td>
                                    <td width="20%" class="text-font td-title" width="7%">
                                        <span style="margin-right:3px;">วันที่คัดกรอง</span>
                                    </td>
                                    <td width="20%"class="text-font td-title">
                                        <span style="margin-right:3px;">ชื่อ - นามสกุล</span>
                                    </td>
                                    <td width="10%" class="text-font td-title">
                                        <span style="margin-right:3px;">เพศ</span>
                                    </td>
                                    <td width="5%" class="text-font td-title text-center">
                                        <span style="margin-right:3px;">อายุ</span>
                                    </td>
                                    <td class="text-font td-title">
                                        <span style="margin-right:3px;">หน่วยงาน</span>
                                    </td>
                                    <td class="text-font td-title">
                                        <span style="margin-right:3px;">BMI</span>
                                    </td>
                                    <td class="text-font td-title text-center">
                                        <span style="margin-right:3px;">รายละเอียด</span>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($users as $user)
                                    @if ($user->id < 50)
                                    <tr>
                                        <td class="td-content text-center">
                                            {{ $user->id }}
                                        </td>
                                        <td class="td-content text-center">
                                            {{ $user->status }}
                                        </td>
                                        <td class="td-content">
                                            <span style="margin-left:10px;">{{ $user->updated_at }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->name }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->username }}</span>
                                        </td>
                                        <td class="text-font td-content text-center">
                                            <span style="margin-left:10px;">{{ $user->PERSON_ID }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->email }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->password }}</span>
                                        </td>
                                        <td class="td-content text-center" width="10%">
                                            <div class="dropdown" style="margin-top: 5px; margin-bottom: 5px;">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle dropdown-title" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item dropdown-content" href="{{ url('manager_person/health-check/form') }}">
                                                    กรอกข้อมูลรับการตรวจ</a>
                                                <a class="dropdown-item dropdown" href="{{ url('manager_person/health-check/results') }}">
                                                    ข้อมูลผลตรวจสุขภาพ</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
                {{-- data Table --}}
                <div class="panel-body" style="overflow-x:auto;">     
                    <div class="table-responsive">
                        <table class="table-striped table-vcenter js-dataTable-simple" width="100%">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    <td width="%" class="text-font td-title text-center" width="7%">
                                        <span style="margin-right:3px;">ลำดับ</span>
                                    </td>
                                    <td width="10%" class="text-font td-title text-center" width="7%">
                                        <span style="margin-right:3px;">สถานะ</span>
                                    </td>
                                    <td width="20%" class="text-font td-title" width="7%">
                                        <span style="margin-right:3px;">วันที่คัดกรอง</span>
                                    </td>
                                    <td width="20%"class="text-font td-title">
                                        <span style="margin-right:3px;">ชื่อ - นามสกุล</span>
                                    </td>
                                    <td width="10%" class="text-font td-title">
                                        <span style="margin-right:3px;">เพศ</span>
                                    </td>
                                    <td width="5%" class="text-font td-title text-center">
                                        <span style="margin-right:3px;">อายุ</span>
                                    </td>
                                    <td class="text-font td-title">
                                        <span style="margin-right:3px;">หน่วยงาน</span>
                                    </td>
                                    <td class="text-font td-title">
                                        <span style="margin-right:3px;">BMI</span>
                                    </td>
                                    <td class="text-font td-title text-center">
                                        <span style="margin-right:3px;">รายละเอียด</span>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($users as $user)
                                    @if ($user->id < 50)
                                    <tr>
                                        <td class="td-content text-center">
                                            {{ $user->id }}
                                        </td>
                                        <td class="td-content text-center">
                                            {{ $user->status }}
                                        </td>
                                        <td class="td-content">
                                            <span style="margin-left:10px;">{{ $user->updated_at }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->name }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->username }}</span>
                                        </td>
                                        <td class="text-font td-content text-center">
                                            <span style="margin-left:10px;">{{ $user->PERSON_ID }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->email }}</span>
                                        </td>
                                        <td class="text-font td-content">
                                            <span style="margin-left:10px;">{{ $user->password }}</span>
                                        </td>
                                        <td class="td-content text-center" width="10%">
                                            <div class="dropdown" style="margin-top: 5px; margin-bottom: 5px;">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle dropdown-title" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item dropdown-content" href="{{ url('manager_person/health-check/form') }}">
                                                    กรอกข้อมูลรับการตรวจ</a>
                                                <a class="dropdown-item dropdown" href="{{ url('manager_person/health-check/results') }}">
                                                    ข้อมูลผลตรวจสุขภาพ</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                    <tr height="40">
                        <td width="%" class="text-font td-title text-center" width="7%">
                            <span style="margin-right:3px;">ลำดับ</span>
                        </td>
                        <td width="10%" class="text-font td-title text-center" width="7%">
                            <span style="margin-right:3px;">สถานะ</span>
                        </td>
                        <td width="20%" class="text-font td-title" width="7%">
                            <span style="margin-right:3px;">วันที่คัดกรอง</span>
                        </td>
                        <td width="20%"class="text-font td-title">
                            <span style="margin-right:3px;">ชื่อ - นามสกุล</span>
                        </td>
                        <td width="10%" class="text-font td-title">
                            <span style="margin-right:3px;">เพศ</span>
                        </td>
                        <td width="5%" class="text-font td-title text-center">
                            <span style="margin-right:3px;">อายุ</span>
                        </td>
                        <td class="text-font td-title">
                            <span style="margin-right:3px;">หน่วยงาน</span>
                        </td>
                        <td class="text-font td-title">
                            <span style="margin-right:3px;">BMI</span>
                        </td>
                        <td class="text-font td-title text-center">
                            <span style="margin-right:3px;">รายละเอียด</span>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>
</div> --}}
    
                      

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
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

    });

</script>

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

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>

@endsection