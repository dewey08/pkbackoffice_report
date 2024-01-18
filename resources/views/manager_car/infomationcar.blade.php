@extends('layouts.car')
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
    font-size: 13px;
                  }   
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


use App\Http\Controllers\ManagercarController;


?>
  
                    <!-- Advanced Tables -->
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลยานพาหนะ</B></h3>
                            <div align="right">

        <a href="{{ url('general_car/infomationcar/addasset')}}"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการเพิ่มข้อมูลยานพหนะจากทะเบียนครุภัณฑ์ ?')" ><i class="fas fa-plus"></i> เพิ่มจากทะเบียนครุภัณฑ์</a>
        <a href="{{ url('general_car/infomationcar/add')}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลยานพาหนะ</a>
        </div>
                        </div>
                        <div class="block-content block-content-full">
                        <form method="post">
                        @csrf

             <div class="row" >
            
             <div class="col-md-8" >&nbsp;
            </div>
                  <div class="col-md-2" >
                  <span>
                 
                 <input type="search"  name="search" class="form-control btn-sm" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                </span>
                 </div>
               
                 <div class="col-md-30">
                &nbsp;
                </div> 
                 <div class="col-md-1.5">
                 <span>
                 <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search "></i> ค้นหา</button>
                 </span> 
                 </div>
                </div>
              
                
             </form>
             <div class="table-responsive"> 
                            
                            <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                       
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ทะเบียน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ยี่ห้อ</th>    
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สี</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายละเอียด</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เชื้อเพลิง</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ซ่อมครั้งล่าสุด</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >พรบ.หมดอายุ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ต่อภาษีรถ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >กรมธรรม์หมดอายุ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ผู้รับผิดชอบ</th>

                                        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เปิดใช้</th> 
                                        
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">คำสั่ง</th>   
                                        
                                       
                                       
                                        
                                    </tr >
                                </thead>
                                <tbody>
                                

                                <?php $number = 0; ?>
                                @foreach ($infocars as $infocar)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->CAR_REG }}</td>

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->BRAND_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->COLOR_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->CAR_DETAIL }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->CAR_POWER_NAME }}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{Datethai(ManagercarController::detailrepair($infocar->CAR_ID))}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{Datethai(ManagercarController::detailact($infocar->CAR_ID))}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{Datethai(ManagercarController::detailtax($infocar->CAR_ID))}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{Datethai(ManagercarController::detailinsurance($infocar->CAR_ID))}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infocar->HR_FNAME }} {{ $infocar->HR_LNAME }}</td>
                                        
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                            <div class="custom-control custom-switch custom-control-lg ">
                                             @if($infocar-> ACTIVE == 'true' )
                                                 <input type="checkbox" class="custom-control-input" id="{{ $infocar-> CAR_ID }}" name="{{ $infocar-> CAR_ID }}" onchange="switchactive({{ $infocar-> CAR_ID }});" checked>
                                             @else
                                                <input type="checkbox" class="custom-control-input" id="{{ $infocar-> CAR_ID }}" name="{{ $infocar-> CAR_ID }}" onchange="switchactive({{ $infocar-> CAR_ID }});">
                                             @endif
                                                <label class="custom-control-label" for="{{ $infocar-> CAR_ID }}"></label>
                                            </div>
                                     
                                     
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_modal{{ $infocar -> CAR_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
            
                                                <a class="dropdown-item" href="{{ url('manager_car/infomationcar/edit/'.$infocar-> CAR_ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                <a class="dropdown-item" href="{{ url('manager_car/infomationcar/repair/'.$infocar-> CAR_ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">การบำรุงรักษา</a>
                                                    
                                                   <!-- <a class="dropdown-item" href="{{ url('manager_car/infomationcar/destroy/'.$infocar-> CAR_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลรถยนต์?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>-->
                                                   
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>

                                    <div id="detail_modal{{ $infocar -> CAR_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
    <div class="row">
    <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียด&nbsp;&nbsp;ทะเบียน&nbsp;&nbsp;{{ $infocar -> CAR_REG}}</h3></div>
    </div>
        </div>
        <div class="modal-body">
        <body>


        <div class="row push">

<div class="col-lg-4">
                                 <div class="form-group">
                              
                                 <img src="data:image/png;base64,{{ chunk_split(base64_encode($infocar->CAR_IMG)) }}" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="300px"/>
                                 </div>
                               
                                
                                 
 </div>

 <div class="col-sm-8">

 
<div class="row push">
 <div class="col-lg-2">
 <label>ทะเบียนรถ :</label>
 </div> 
 <div class="col-lg-2 text-left">
 {{$infocar->CAR_REG}}
 </div> 
 <div class="col-lg-2">
 <label>รายละเอียด :</label>
 </div> 
 <div class="col-lg-6 text-left">
{{$infocar->CAR_DETAIL}}
 </div>
</div>
 
 <div class="row push">
 <div class="col-lg-2">
 <label>ผู้รับผิดชอบ:</label>
 </div> 
 <div class="col-lg-3 text-left">
 {{$infocar->HR_FNAME}} {{$infocar->HR_LNAME}}
 </div> 
 <div class="col-lg-2">
 <label>สถานะ :</label>
 </div> 
 <div class="col-lg-4 text-left">
 {{$infocar->CAR_STATUS_NAME}}  
 </div> 
 </div> 



 
 <div class="row push">
 <div class="col-lg-2">
 <label>ประเภท :</label>
 </div> 
 <div class="col-lg-3 text-left">
 {{$infocar->CAR_TYPE_NAME}}  
 </div> 
 <div class="col-lg-2">
 <label>ลักษณะรถ :</label>
 </div> 
 <div class="col-lg-4 text-left">
 {{$infocar->CAR_STYLE_NAME}}  
 </div> 



 </div>

 <div class="row push">
 <div class="col-lg-2">
 <label>ยี่ห้อ :</label>
 </div> 
 <div class="col-lg-3 text-left">
 {{$infocar->BRAND_NAME}}  
 </div>
 <div class="col-lg-2">
 <label>เชื้อเพลิง :</label>
 </div> 
 <div class="col-lg-4 text-left">
 {{$infocar->CAR_POWER_NAME}}  
 </div> 

 </div>
 <div class="row push">
 <div class="col-lg-2">
 <label>รุ่นปี :</label>
 </div> 
 <div class="col-lg-3 text-left">
{{$infocar->CAR_MODELS_YEAR}}
 </div> 
 <div class="col-lg-2">
 <label>แบบ :</label>
 </div> 
 <div class="col-lg-4 text-left">
{{$infocar->CAR_FOMATS}}
 </div> 

    

 </div>

 <div class="row push">

 <div class="col-lg-2">
 <label>ยี่ห้อเครื่อง :</label>
 </div> 
 <div class="col-lg-3 text-left">
 {{$infocar->CAR_MACHIN_BRAND_ID}}
 </div> 

 <div class="col-lg-2">
 <label>สี :</label>
 </div> 
 <div class="col-lg-4 text-left">
{{$infocar->CAR_COLOR}}
 </div> 

 </div>

 <div class="row push">
 <div class="col-lg-2">
 <label>จำนวนที่นั่ง :</label>
 </div> 
 <div class="col-lg-3 text-left">
{{$infocar->CAR_SIT}}
 </div> 
 <div class="col-lg-2">
 <label>เลขตัวรถ :</label>
 </div> 
 <div class="col-lg-4 text-left">
 {{$infocar->CAR_NUM_BODY}}
 </div> 
 </div>
 <div class="row push">
 <div class="col-lg-2">
 <label>ตำแหน่งเลขตัวรถ :</label>
 </div> 
 <div class="col-lg-3 text-left">
 {{$infocar->CAR_NUM_BODY_ADDR}}
 </div> 

 <div class="col-lg-2">
 <label>เลขเครื่อง :</label>
 </div> 
 <div class="col-lg-4 text-left">
 {{$infocar->CAR_MACHIN_NUM}}
 </div> 
 </div>

 <div class="row push">
 <div class="col-lg-2">
 <label>ตำแหน่งเลขเครื่อง :</label>
 </div> 
 <div class="col-lg-3 text-left">
{{$infocar->CAR_MACHIN_ADDR}}
 </div> 


 <div class="col-lg-2">
 <label>จำนวนแรงม้า :</label>
 </div> 
 <div class="col-lg-4 text-left">
{{$infocar->CAR_HORSE}}
 </div> 
 </div>


 <div class="row push">
 <div class="col-lg-2">
 <label>ขนาดเครื่อง :</label>
 </div> 
 <div class="col-lg-3 text-left">
 {{$infocar->CAR_CC}}
 </div> 

 <div class="col-lg-2">
 <label>เลขถังแก๊ส :</label>
 </div> 
 <div class="col-lg-4 text-left">
{{$infocar->CAR_GASS_NUM}}
 </div> 

 </div>
 <div class="row push">
 <div class="col-lg-2">
 <label>จำนวนลูกสูบ :</label>
 </div> 
 <div class="col-lg-3 text-left">
{{$infocar->CAR_SUP}}
 </div> 

 <div class="col-lg-2">
 <label>จำนวนเพลา :</label>
 </div> 
 <div class="col-lg-4 text-left">
{{$infocar->CAR_PLOW}}
 </div> 
</div>
 <div class="row push">
 
 <div class="col-lg-2">
 <label>จำนวนล้อ :</label>
 </div> 
 <div class="col-lg-3 text-left">
{{$infocar->CAR_LO}}
 </div> 

 
 
 <div class="col-lg-2">
 <label>น้ำหนักรถ :</label>
 </div> 
 <div class="col-lg-4 text-left">
{{$infocar->CAR_WEIGHT}}
 </div> 

 </div>

 <div class="row push">
 <div class="col-lg-2">
 <label>น้ำหนักรวม :</label>
 </div> 
 <div class="col-lg-2 text-left">
{{$infocar->CAR_SUM_WEIGHT}}
 </div>

 </div>
 </div>
 </div>

       

        </div>
        <div class="modal-footer">
        <div align="right">
     
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" > <i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
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
    
 function switchactive(idcar){
      var checkBox=document.getElementById(idcar);
      var onoff;

      if (checkBox.checked == true){
        onoff = "true";
  } else {
        onoff = "false";
  }

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('mcar.activeinfocar')}}",
              method:"GET",
              data:{onoff:onoff,idcar:idcar,_token:_token}
      })
      }        
  
</script>
@endsection