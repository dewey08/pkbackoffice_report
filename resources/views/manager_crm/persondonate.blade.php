@extends('layouts.crm')   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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

use App\Http\Controllers\ManagercrmController;

?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  
?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
           

                <div class="block-header block-header-default">
                    <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนผู้บริจาค</B></h3>
                    &nbsp;&nbsp;
              
                    <a href="{{ url('manager_crm/persondonate_add')}}"  class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fas fa-plus mr-2"></i> เพิ่มทะเบียนผู้บริจาค</a>
                </div>  
               
            <div class="block-content block-content-full">

              

            <form action="{{ route('mcrm.persondonate') }}" method="post">
                @csrf
                <div class="row">
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
                

                        <div class="col-sm-0.5">
                        &nbsp;ค้นหา &nbsp;
                        </div>

                        <div class="col-sm-2">
                        <span>

                        <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;" value="{{$search}}">

                        </span>
                        </div>

                        <div class="col-sm-30">
                        &nbsp;
                        </div> 
                        <div class="col-sm-1.5 text-left">
                        <span>
                        <button type="submit" class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fas fa-search mr-2"></i> ค้นหา</button>
                        </span> 
                        </div>
                  </div>  
             </form>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="3%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;"width="15%" >ชื่อผู้บริจาค</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">เบอร์โทร</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ที่อยู่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="12%">มูลค่า</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">จำนวนครั้ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="15%">เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                        @foreach ($donateinfopersons as $donateinfoperson)
                        <?php $number++;

                        $status =  $donateinfoperson -> DONATE_PERSON_STATUS;

                            if( $status === 'REQUEST'){
                            $statuscol =  "badge badge-warning";

                            }else if($status === 'CANCEL'){
                            $statuscol =  "badge badge-danger";

                            }else if($status === 'NORMAL'){
                            $statuscol =  "badge badge-success";

                            }else{
                            $statuscol =  "badge badge-secondary";
                            }

                            ?>

                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                         <td class="text-font" align="center">{{DateThai($donateinfoperson->DONATE_PERSON_DATE)}} </td>                      
                        <td class="text-font text-pedding" >{{$donateinfoperson->DONATE_PERSON_NAME}}</td>
                        <td class="text-font text-pedding" >{{$donateinfoperson->DONATE_PERSON_TEL}}</td>
                        <td class="text-font text-pedding" >

                        บ้านเลขที่ {{ $donateinfoperson->DONATE_PERSON_NO_HOME }}
                        ถนน {{ $donateinfoperson->DONATE_PERSON_ROAD }}                     
                        หมู่ {{ $donateinfoperson->DONATE_PERSON_MOO }}
                        ตำบล  {{ $donateinfoperson->TUMBON_NAME }}
                        อำเภอ  {{ $donateinfoperson->AMPHUR_NAME }}                                         
                        จังหวัด  {{ $donateinfoperson->PROVINCE_NAME }}

                        </td>
      
                       
                        <td class="text-font text-pedding" align="right">{{  number_format(ManagercrmController::sumamount($donateinfoperson ->DONATE_PERSON_ID),2) }}</td>
                        <td class="text-font text-pedding" align="center">{{  ManagercrmController::countamount($donateinfoperson ->DONATE_PERSON_ID) }}</td>
                        <td class="text-font text-pedding" >{{$donateinfoperson->HR_FNAME}}&nbsp;&nbsp; {{$donateinfoperson->HR_LNAME}}</td>
                        <td align="center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button>
                            <div class="dropdown-menu" style="width:10px">
                            <a class="dropdown-item"  href="#detail_modal{{ $donateinfoperson -> DONATE_PERSON_ID }}" data-toggle="modal" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ดูรายละเอียด</a>
                                    <a class="dropdown-item loadscreen"  href="{{ url('manager_crm/detaildonate/'.$donateinfoperson->DONATE_PERSON_ID)}}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">เพิ่มข้อมูลบริจาค</a>
                                    <a class="dropdown-item loadscreen"  href="{{ url('manager_crm/persondonate_edit/'.$donateinfoperson->DONATE_PERSON_ID)}}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>
                    
                                   
                                   <!-- <a class="dropdown-item"  href="{{ url('manager_crm/persondonate_cancel/'.$donateinfoperson->DONATE_PERSON_ID)}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">ยกเลิก</a>-->
                                </div>
                            </div>
                        </td> 




                        <div id="detail_modal{{ $donateinfoperson-> DONATE_PERSON_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="editsafe_modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">           
                                        <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;font-size:25px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;ทะเบียนผู้บริจาคลำดับที่&nbsp; {{ $donateinfoperson -> DONATE_PERSON_ID }}&nbsp;&nbsp;</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                              
                                        <body> 
                                           
                                            <div class="form-group">                                               
                                                <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>ชื่อผู้บริจาค :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">              
                                                    {{ $donateinfoperson->DONATE_PERSON_NAME }}
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <label>เบอร์โทร :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                   {{ $donateinfoperson->DONATE_PERSON_TEL }}
                                                    </div> 
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>อีเมล :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                  {{ $donateinfoperson->DONATE_PERSON_EMAIL }}
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <label>ไลน์ :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                    {{ $donateinfoperson->DONATE_PERSON_LINE }}
                                                    </div>
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>เลขที่เสียภาษี :</label>
                                                    </div> 
                                                    <div class="col-lg-10 text-left fo14">
                                                   {{ $donateinfoperson->DONATE_PERSON_VAT_NO }}
                                                    </div> 
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>บ้านเลขที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left fo14">
                                                   {{ $donateinfoperson->DONATE_PERSON_NO_HOME }}
                                                    </div>       
                                                    <div class="col-sm-1">
                                                    <label>ถนน :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left fo14">
                                                    {{ $donateinfoperson->DONATE_PERSON_ROAD }}
                                                    </div> 
                                                    <div class="col-sm-1">
                                                    <label>หมู่ :</label>
                                                    </div> 
                                                    <div class="col-lg-1 text-left fo14">
                                                    {{ $donateinfoperson->DONATE_PERSON_MOO }}
                                                    </div> 
                                                    <div class="col-sm-1">
                                                    <label>บ้าน :</label>
                                                    </div> 
                                                    <div class="col-lg-2 text-left fo14">
                                                    {{ $donateinfoperson->DONATE_PERSON_BAN }}
                                                       </div> 
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>จังหวัด :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                    {{ $donateinfoperson->PROVINCE_NAME }}
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label>อำเภอ :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                    {{ $donateinfoperson->AMPHUR_NAME }}
                                                    </div>
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>ตำบล :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                    {{ $donateinfoperson->TUMBON_NAME }}
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <label>ไปรษณีย์ :</label>
                                                    </div> 
                                                    <div class="col-lg-4 text-left fo14">
                                                    {{ $donateinfoperson->DONATE_PERSON_POST }}
                                                    </div> 
                                                    </div>

                                                    <div class="row push">
                                                    <div class="col-sm-2">
                                                    <label>เจ้าหน้าที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-10 text-left fo14">
                                                    {{$donateinfoperson->HR_FNAME }} {{$donateinfoperson->HR_LNAME }}
                                                    <input value="{{$id_user}}" type="hidden" name = "DONATE_PERSON_USER_ID"  id="DONATE_PERSON_USER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div align="right">
                                                            <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>Close</button>
                                                           
                                  
                            </body>


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
datepick()
function datepick() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true,
        autoclose: true                         //Set เป็นปี พ.ศ.
    });  //กำหนดเป็นวันปัจุบัน
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

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
</script>

@endsection