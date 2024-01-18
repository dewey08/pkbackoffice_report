@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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
  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
            }

            .text-pedding{
   padding-left:10px;
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

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">

        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติการขอใช้ห้องประชุม</B></h3>
            <a href="#modal_allapp" data-toggle="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-success" >อนุมัติทั้งหมด</a>
        </div>
        <div class="block-content block-content-full">
            <form action="{{ route('horg.informeetsearch') }}" method="post">
                @csrf
                <div class="row">
                <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                                <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
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
                    <div class="col-md-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">--ทั้งหมด--</option>
                                    @foreach ($info_sendstatuss as $info_sendstatus)
                                        @if($info_sendstatus->STATUS_CODE == $status_check)
                                            <option value="{{ $info_sendstatus->STATUS_CODE }}" selected>{{ $info_sendstatus->STATUS_NAME}}</option>
                                         @else
                                            <option value="{{ $info_sendstatus->STATUS_CODE  }}">{{ $info_sendstatus->STATUS_NAME}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </span>
                    </div>

                    <div class="col-md-0.5">
                        &nbsp;ค้นหา &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                        </span>
                    </div>
                    <div class="col-md-30">
                        &nbsp;
                    </div>
                    <div class="col-md-1">
                        <span>
                            <button type="submit" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-info" >ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>
        <div class="table-responsive">
 
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                    <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ห้อง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เรื่อง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วันที่จอง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ถึงวันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ผู้ขอจอง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">อนุมัติ</th>
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                                @foreach ($inforoomindexs as $inforoomindex)
                                <?php $number++;  
                                
                                $status =  $inforoomindex -> STATUS;
                                if( $status === 'REQUEST'){
                                    $statuscol =  "badge badge-warning";

                                }else if($status === 'SUCCESS'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'LASTAPP'){
                                    $statuscol =  "badge badge-success";
                                }else if($status === 'NOTSUCCESS'){
                                    $statuscol =  "badge badge-danger";
                                }else if($status === 'INFORM'){
                                    $statuscol =  "badge badge-dark";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }
                                
                                
                                
                                ?>
                               
                                    <tr height="40">
                                        <td class="text-font" align="center">{{$number}}</td>
                                       
                                        <td align="center"><span class="{{$statuscol}}" >{{ $inforoomindex->STATUS_NAME}}</span></td>
                               
                                        <td class="text-font" align="center" >{{ $inforoomindex->ROOM_NAME}}</td>
                                        <td class="text-font text-pedding">{{ $inforoomindex->SERVICE_STORY}}</td>
                                        <td class="text-font"  align="center">{{ DateThai($inforoomindex->DATE_BEGIN)}}</td>
                                        <td class="text-font"  align="center">{{ date("H:i",strtotime("$inforoomindex->TIME_BEGIN")) }}</td>
                                        <td class="text-font"  align="center">{{ DateThai($inforoomindex->DATE_END)}}</td>
                                        <td class="text-font"  align="center">{{ date("H:i",strtotime("$inforoomindex->TIME_END")) }}</td>
                                        <td class="text-font text-pedding">{{ $inforoomindex->PERSON_REQUEST_NAME}}</td>

                                            

                                        <td align="center">
                                        @if($inforoomindex->STATUS == 'SUCCESS')

                                        <a href="{{ url('person_headorg/meet_app/'.$inforoomindex->ID) }}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fa fa-edit"></i></a>
                                       
                                        @else
                                            -
                                        @endif
                                        </td>     


                                    </tr>


            

                
<!-------------------------------------------------------ตรวจอสอบ---------------------------------------->

<div id="detail_repairnomalcar{{$inforoomindex->ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">

                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;อนุมัติขอใช้ห้องประชุม&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body">
                                                <form  method="post" action="{{ route('horg.updateinfomeetnomalapp') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden"  name="ID" value="{{$inforoomindex->ID}}"/>
                                                        
                                                            
                                                                                                                

                                                                    <div class="row">
                                                                
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label >เรื่องการประชุม :</label>
                                                                    </div>                               
                                                                </div> 
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group" >
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->SERVICE_STORY }}</h1>
                                                                    </div>                               
                                                                </div>
                                                                
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label >ปีงบประมาณ  :</label>
                                                                    </div>                               
                                                                </div>  
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->YEAR_ID }}</h1>
                                                                    </div>                               
                                                                </div>  
                                                                
                                                                </div>

                                                                <div class="row">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label >กลุ่มบุคคลเป้าหมาย :</label>
                                                                    </div>                               
                                                                </div>  
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->GROUP_FOCUS }}</h1>
                                                                    </div>                               
                                                                </div>    
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label >จำนวน :</label>
                                                                    </div>                               
                                                                </div>  
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->TOTAL_PEOPLE }} คน</h1>
                                                                    </div>                               
                                                                </div>
                                                                </div>

                                                                
                                                                <div class="row">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label>ประสงค์ใช้ห้อง :</label>
                                                                    </div>                               
                                                                </div>  
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->ROOM_NAME}}</h1>
                                                                    </div>                               
                                                                </div>  
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label>วัตถุประสงค์การขอใช้ :</label>
                                                                    </div>                               
                                                                </div>  
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->OBJECTIVE_NAME}}</h1>
                                                                    </div>                               
                                                                </div>    
                                                                </div>
                                                                
                                                                
                                                                
                                                                <div class="row">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label >ตั้งแต่วันที่ :</label>
                                                                    </div>                               
                                                                </div>
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{DateThai($inforoomindex->DATE_BEGIN)}} เวลา {{formatetime($inforoomindex->TIME_BEGIN)}} น.</h1>
                                                                    </div>                               
                                                                </div> 
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label >ถึงแต่วันที่ :</label>
                                                                    </div>                               
                                                                </div>
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{DateThai($inforoomindex->DATE_END)}} เวลา {{formatetime($inforoomindex->TIME_END)}} น.</h1>
                                                                    </div>                               
                                                                </div>   
                                                            
                                                                </div>
                                                                
                                                                <div class="row">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label > ผู้ร้องขอ :</label>
                                                                    </div>                               
                                                                </div>
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->PERSON_REQUEST_NAME}}</h1>
                                                                    </div>                               
                                                                </div> 
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                    <label > เบอร์ติดต่อ :</label>
                                                                    </div>                               
                                                                </div>
                                                                <div class="col-sm-3 text-left">
                                                                    <div class="form-group">
                                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforoomindex->PERSON_REQUEST_PHONE}}</h1>
                                                                    </div>                               
                                                                </div> 
                                                                
                                                            
                                                                </div>


                                                                </div>
                                                    <div class="modal-footer">
                                                    <div align="right">
                                                    <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="approved" >อนุมัติ</button>
                                                    <button type="submit"  name = "SUBMIT"  class="btn btn-danger btn-lg" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="not_approved" >ไม่อนุมัติ</button>
                                                    <button type="button" class="btn btn-secondary btn-lg"  style="font-family: 'Kanit', sans-serif;font-weight:normal;" data-dismiss="modal" >ปิดหน้าต่าง</button>

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


<div id="modal_allapp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                         <div class="modal-header">

                                         <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"></h2>
                                        </div>
                                        <div class="modal-body">
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ท่านต้องการอนุมัติรายการทั้งหมด !!</h2>

                                    </div>
                                    <div class="modal-footer">
                                    <div align="right">
                                    <a href="{{ url('person_headorg/updateinfomeetnomalappall')}}"  style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-hero-sm btn-hero-success" >ตกลง</a>
                                    <button type="button" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
                                </div>
                                </div>
                            </body>
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
</script>



@endsection