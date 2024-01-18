@extends('layouts.env')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 13px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
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

use App\Http\Controllers\FectdataController;


?>
<?php
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>

<center>    
     <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
               
               
                <div align="left">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลผลวิเคราะห์คุณภาพน้ำทิ้ง</B></h3>
               </div>
            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('menv.watertreatment_update') }}" method="post">
                @csrf       
                <input type="hidden" name="PARAMETER_ID" name="PARAMETER_ID" value=" {{$parameters->PARAMETER_ID}}" class="form-control">

                <div class="row push text-left">
                    <div class="col-sm-2 ">
                    <label>วันที่บันทึก :</label>
                    </div> 
                    <div class="col-lg-2 ">              
                    <input value=" {{formate($parameters->PARAMETER_DATE)}}" style="font-family:'Kanit',sans-serif;font-size:13px;" name="PARAMETER_DATE" id="PARAMETER_DATE"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" readonly >
                    </div> 
                    <div class="col-sm-1 ">
                    <label>ปี :</label>
                    </div> 
                    <div class="col-lg-2 "> 
                        <span>
                            <select name="PARAMETER_YEAR" id="PARAMETER_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                            @foreach ($budgets as $budget)
                            @if($budget->LEAVE_YEAR_ID== $parameters->PARAMETER_YEAR)
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                            @else
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                            @endif                                 
                        @endforeach                         
                            </select>
                        </span> 
                    </div> 
                    <div class="col-sm-1 ">
                        <label>ผู้บันทึก :</label>
                        </div> 
                        <div class="col-lg-3 ">
                        <span>
                        <select name="PARAMETER_USER" id="PARAMETER_USER" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                            <option value="">--เลือก--</option>
                            @foreach ($infopers as $infoper)
                            @if($infoper->ID== $parameters->PARAMETER_USER)
                                <option value="{{ $infoper->ID  }}" selected>{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                @else
                                <option value="{{ $infoper->ID  }}">{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                @endif
                            @endforeach 
                            </select>
                        </span> 
                        </div> 
                        </div>

                        <div class="row push text-left">                           
                            <div class="col-sm-2 ">
                            <label>สถานที่เก็บตัวอย่าง :</label>
                            </div> 
                            <div class="col-lg-2 ">  
                                <input value="{{$parameters->LOCATION_EX}}" name="LOCATION_EX" id="LOCATION_EX" class="form-control  input-lg fo13" required>                           
                            </div> 
                            <div class="col-sm-1 ">
                                <label>ลักษณะตัวอย่าง :</label>
                                </div> 
                                <div class="col-lg-6 "> 
                                    <input value="{{$parameters->GROUP_EXCAMPLE}}" name="GROUP_EXCAMPLE" id="GROUP_EXCAMPLE" class="form-control  input-lg fo13" required>
                                </div> 
                        </div> 

                        <div class="row push text-left">                           
                            <div class="col-sm-2 ">
                            <label>วันที่รับตัวอย่าง :</label>
                            </div> 
                            <div class="col-lg-2 ">              
                                <input value="{{formate($parameters->LOCATION_EXDATE)}}" name="LOCATION_EXDATE" id="LOCATION_EXDATE" class="form-control input-lg datepicker fo13" data-date-format="mm/dd/yyyy" readonly >
                            </div> 
                            <div class="col-sm-1">
                                <label>วันที่วิเคราะห์ตัวอย่าง :</label>
                                </div> 
                                <div class="col-lg-2 "> 
                                <input value="{{formate($parameters->GROUP_EXCAMPLEDATE)}}" name="GROUP_EXCAMPLEDATE" id="GROUP_EXCAMPLEDATE" class="form-control input-lg datepicker fo13" data-date-format="mm/dd/yyyy" readonly >
                                </div> 
                               
                        </div> 
                        <div class="row push text-left">                           
                            <div class="col-sm-2  ">
                            <label>ผู้วิเคราะห์ตัวอย่าง :</label>
                            </div> 
                            <div class="col-lg-9 ">              
                            <input value ="{{$parameters->USER_EXCAMPLE}}" name="USER_EXCAMPLE" id="USER_EXCAMPLE" class="form-control  input-lg fo13" required>
                            </div> 
                        </div> 

                        <div class="row push text-left">                           
                            <div class="col-sm-2">
                            <label>หมายเหตุ :</label>
                            </div> 
                            <div class="col-lg-9 ">              
                            <input value="{{$parameters->PARAMETER_COMMENT}}" name="PARAMETER_COMMENT" id="PARAMETER_COMMENT" class="form-control  input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                            </div> 
                        </div> 
                        <div class="row push">
                            <div class="col-sm-2 ">
                                <div align="left" style=" font-family:'Kanit', sans-serif;font-size: 13px;font-weight:bold;">
                                    รายการพารามิเตอร์ :
                                </div>
                            </div>
                            <div class="col-lg-9 ">
                                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                    <thead style="background-color: #BDFBC9;">
                                        <tr height="40">
                                            <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="5%">ลำดับ</td>
                                                <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;">รายการพารามิเตอร์</th>
                                                <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;" width="10%">หน่วย</th> 
                                                <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;" width="20%">ผลการวิเคราะห์</th> 
                                                <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;" width="20%">วิธี่ที่ใช้วิเคราะห์</th> 
                                                <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;" width="20%">ค่ามาตรฐาน</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        <?php $number = 0; ?>
                                        @foreach($lists as $list)
                                        <?php $number++;  ?>
                                        <tr height="20"> 
                                            
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;"> {{ $number}} </td>                                                
                                                <td>
                                                    <input type="hidden" value="{{ $list->LIST_PARAMETER_ID }}" name="LIST_PARAMETER_ID[]" id="LIST_PARAMETER_ID[]" class="form-control input-sm fo13" >
                                                    <input value="{{ $list->LIST_PARAMETER_DETAIL }}" name="" id="" class="form-control input-sm fo13" readonly>
                                                </td>     

                                                <td><input value="{{ $list->LIST_PARAMETER_UNIT }}" name="LIST_PARAMETER_UNIT[]" id="LIST_PARAMETER_UNIT[]" class="form-control input-sm fo13" readonly></td>
                           
                                                <?php
                                                  
                                                    $item = DB::table('env_parameter_sub')
                                                    ->where('LIST_PARAMETER_IDD','=',$list->LIST_PARAMETER_ID)
                                                    ->where('PARAMETER_ID','=',$parameters->PARAMETER_ID)
                                                    ->first();      
                                         
                                               ?>      
                                                                @if ($item <> '' && $item <> null)        
                                                                    <td><input value="{{ $item->ANALYSIS_RESULTS }}" name="ANALYSIS_RESULTS[]" id="ANALYSIS_RESULTS[]" class="form-control input-sm fo13" ></td>                                                          
                                                                @else                                                                                                                              
                                                                    <td><input name="ANALYSIS_RESULTS[]" id="ANALYSIS_RESULTS[]" class="form-control input-sm fo13" ></td>
                                                                @endif  
                                                 

                                                <td><input value="{{ $list->LIST_USEANALYSIS_RESULTS  }}" name="LIST_USEANALYSIS_RESULTS[]" id="LIST_USEANALYSIS_RESULTS[]" class="form-control input-sm fo13" readonly></td>
                                                <td><input value="{{ $list->LIST_PARAMETER_NORMAL }}" name="LIST_PARAMETER_NORMAL[]" id="LIST_PARAMETER_NORMAL[]" class="form-control input-sm fo13" readonly></td>
                                          
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>   
                            </div> 
                        </div>
                        <hr>

                <div class="footer">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                            <a href="{{ url('manager_env/watertreatment')}}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>

                    </div>
                </div>
        </div>
    </div>


@endsection

@section('footer')

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
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

   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection