@extends('layouts.meet')
   
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
                    }

        .text-font {
    font-size: 14px;
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
                    <div class="bg-body-light">
                    <div class="content">
                      
                    </div>
                </div>
                <div class="content">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการจองห้องประชุม</B></h3>
                            
                        </div>
<div class="block-content block-content-full">
    <form action="{{route('msafe.infomeetsearch')}}"  method="post">
    
        @csrf

        <div class="row">
            
             
                  <div class="col-md-0.5">
                  &nbsp;&nbsp; วันที่ &nbsp;
                  </div>
                  <div class="col-md-2">
                  <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                </div>
                <div class="col-md-0.5">
                &nbsp;ถึง &nbsp;
                </div>
                <div class="col-md-2">
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                 </div> 
                 <div class="col-md-0.5">
                     &nbsp;สถานะ &nbsp;
                     </div>
                      
                       <div class="col-md-2">
                       <span>
                      
                       <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                      
                       <option value="">--ทั้งหมด--</option>
                       <option value="REANDFORM" selected>ร้องขอ,แจ้งยกเลิก</option>
                       @foreach ($infostatuss as $infostatus) 
                        <option value="{{ $infostatus ->STATUS_CODE  }}">{{ $infostatus->STATUS_NAME }}</option>      
                        @endforeach 
                      
                    </select>
                     </span>
                      </div> 
                
                <div class="col-md-0.5">
                &nbsp;ค้นหา &nbsp;
                </div>
                 
                  <div class="col-md-2">
                  <span>
                 
                 <input type="search"  name="search" class="form-control"  >
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
             <div class="table-responsive"> 
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                                       
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">สถานะ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ห้อง</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" >เรื่อง</th>                    
                                        
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">วันที่จอง</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">เวลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ถึงวันที่</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">เวลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="20%">ผู้ขอจอง</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center"  width="12%">คำสั่ง</th>   
                                        
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
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_modal{{ $inforoomindex -> ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                @if($status === 'REQUEST')
                                                    <a class="dropdown-item"  href="{{ url('general_meet/genmeetroomvercheck/'.$inforoomindex -> ID.'/'.$user_id)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ตรวจสอบ</a>
                                                @endif 
                                                @if($status !== 'CANCEL')
                                      
                                                <a class="dropdown-item"  href="{{ url('general_meet/genmeetroomvercancel/'.$inforoomindex -> ID.'/'.$user_id)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แจ้งยกเลิก</a>
                                                 @endif
                                             
                                                
                                                </div>
                                        </div>
                                        </td>     


                                    </tr>

                                    <div id="detail_modal{{ $inforoomindex -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
    <div class="row">
    <div>&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดคำขอเลขที่ &nbsp;&nbsp;{{ $inforoomindex->ID}}</div>
    </div>
        </div>
        <div class="modal-body">

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