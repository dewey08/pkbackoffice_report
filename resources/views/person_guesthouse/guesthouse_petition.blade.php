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
        }        
        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
    
    .form-control {
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
                             
    $yearbudget = date("Y");
                                                                             

?>


           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                            
                                
                                <div >
                                <a href="{{ url('person_guesthouse/guesthouse_info/'.$id_user)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายละเอียดบ้านพัก</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                        <a href="{{ url('person_guesthouse/guesthouse_petition/'.$id_user)}}" class="btn btn-hero-sm btn-hero-info loadscreen" >         
                                        ยื่นคำร้อง
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                @if($ckeckleave !== 0)
                                <div >
                                <a href="{{ url('person_guesthouse/guesthouse_problem/'.$id_user)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนแจ้งปัญหา</a>
                                </div>
                                <div>&nbsp;</div>

                                @endif
                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนคำร้องขอบ้านพัก</B></h3>
            <a href="{{ url('person_guesthouse/guesthouse_petition_add/'.$id_user)}}"   class="btn btn-hero-sm btn-hero-info mr-2" ><i class="fas fa-plus"></i> เพิ่มคำร้อง</a>
        </div>
        <div class="block-content block-content-full">
                        <form action="{{ route('guest.guesthouse_petitionsearch',$id_user) }}" method="post">
@csrf

<div class="row">
<div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
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

                            <div class="col-sm-0.5">
                            &nbsp;สถานะ &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">

                            <option value="">ทั้งหมด</option>

                            @foreach ($infostatuss as $infostatus)  
                                 @if($infostatus->PETITION_STATUS == $status_check)
                                    <option value="{{$infostatus->PETITION_STATUS}}" selected>{{ $infostatus->PETITION_STATUS_NAME}}</option>
                                @else
                                    <option value="{{$infostatus->PETITION_STATUS}}" >{{ $infostatus->PETITION_STATUS_NAME}}</option>
                                @endif
                            @endforeach 
                            
                            </select>
                            </span>
                            </div> 

                            <div class="col-sm-0.5">
                            &nbsp;ค้นหา &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>

                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                            </span>
                            </div>

                            <div class="col-sm-30">
                            &nbsp;
                            </div> 
                            <div class="col-sm-1.5">
                            <span>
                                <button type="submit" class="btn btn-hero-sm btn-hero-info loadscreen" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span> 
                            </div>


                                        
                                            </div>  
             </form>
        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                    <tr height="40">                          
                        <th  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ประเภทคำร้อง</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่ร้องขอ</th> 
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้ร้องขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ติดต่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ชื่ออาคาร</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ชั้น</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ชื่อห้อง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เจ้าหน้าที่</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>  
                    <?php $number = 0; ?>
                        @foreach ($infopetitions as $infopetition)

                        <?php $number++;?>
            
                        <tr height="40">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                        
                                        
                    
                                         @if($infopetition->PETITION_STATUS == 'SUCCESS')
                                        <span class="badge badge-success" >อนุมัติ</span>
                                        @elseif($infopetition->PETITION_STATUS == 'MOVEOUT')
                                        <span class="badge badge-info" >ย้ายออก</span>
                                        @else

                                        <span class="badge badge-warning" >ร้องขอ</span>
                                        @endif

                                        </td>
                                            @if($infopetition->PETITION_TYPE == '1')
                                           <?php $nametype = 'ขอเข้าพัก' ?>
                                            @elseif($infopetition->PETITION_TYPE == '2')
                                            <?php $nametype = 'ขอเปลี่ยนแปลง' ?>
                                            @elseif($infopetition->PETITION_TYPE == '3')
                                            <?php $nametype = 'ขอย้ายออก' ?>
                                            @else
                                            <?php $nametype = '' ?>
                                            @endif

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$nametype}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{DateThai($infopetition->created_at)}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infopetition->HR_FNAME}} {{$infopetition->HR_LNAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infopetition->PETITION_HR_TEL}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infopetition->INFMATION_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$infopetition->LOCATION_LEVEL_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$infopetition->LEVEL_ROOM_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{$infopetition->INFMATION_HR_NAME}}</td>

                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                        ทำรายการ
                                                </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                        <a class="dropdown-item"  href="#detail_modal{{ $infopetition -> PETITION_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
                                                        <a class="dropdown-item"  href="{{ url('person_guesthouse/guesthouse_petition_edit/'.$infopetition->PETITION_ID.'/'.$id_user)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                      
                                                    </div>
                                            </div>
                                        </td>  
                                    </tr> 

                                                                            

                                                                                            
                                                                            
                                        <div id="detail_modal{{ $infopetition -> PETITION_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">รายละเอียดคำร้อง</h2>
                                                </div>
                                                <div class="modal-body">

                                            <div class="row">
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label >ประเภทคำร้อง :</label>
                                                </div>                               
                                            </div> 
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group" >
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$nametype}}</h1>
                                                </div>                               
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label >วันที่ร้องขอ  :</label>
                                                </div>                               
                                            </div>  
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{DateThai($infopetition->created_at)}}</h1>
                                                </div>                               
                                            </div>  
                                            
                                            </div>

                                            <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label >ผู้ร้องขอ :</label>
                                                </div>                               
                                            </div>  
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infopetition->HR_FNAME}} {{$infopetition->HR_LNAME}}</h1>
                                                </div>                               
                                            </div>    
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label >ติดต่อ :</label>
                                                </div>                               
                                            </div>  
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infopetition->PETITION_HR_TEL}}</h1>
                                                </div>                               
                                            </div>
                                            </div>

                                            
                                            <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label>ชื่ออาคาร :</label>
                                                </div>                               
                                            </div>  
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infopetition->LOCATION_NAME}}</h1>
                                                </div>                               
                                            </div>  
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label>ชั้น :</label>
                                                </div>                               
                                            </div>  
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infopetition->LOCATION_LEVEL_NAME}}</h1>
                                                </div>                               
                                            </div>    
                                            </div>
                                            
                                            
                                            
                                            <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label >ชื่อห้อง :</label>
                                                </div>                               
                                            </div>
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$infopetition->LEVEL_ROOM_NAME}}</h1>
                                                </div>                               
                                            </div> 
                                            <div class="col-sm-5">
                                                   &nbsp;  &nbsp;               
                                            </div>
                                          
                                        
                                            </div>
                                            
                                            <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label > เจ้าหน้าที่ :</label>
                                                </div>                               
                                            </div>
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;"></h1>
                                                </div>                               
                                            </div> 
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                <label > ติดต่อ :</label>
                                                </div>                               
                                            </div>
                                            <div class="col-sm-3 text-left">
                                                <div class="form-group">
                                                <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;"></h1>
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
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });

    

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection