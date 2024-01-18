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


?>

<center>    
     <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
               
                <div align="left">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B> แก้ไขตรวจวิเคราะห์คุณภาพน้ำ</B></h3>
                </div>

            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('menv.plumbing_update') }}" method="post">
                @csrf       
    
                <input type="hidden" value="{{$pum->PLUMBING_ID}}" name="PLUMBING_ID" id="PLUMBING_ID" class="form-control input-lg fo13" >

                <div class="row push text-left">
                    <div class="col-sm-2 ">
                    <label>เลขที่รับ :</label>
                    </div> 
                    <div class="col-sm-2 ">              
                    <input  name="PLUMBING_REC_NO" id="PLUMBING_REC_NO" class="form-control input-sm fo13" value="{{$pum->PLUMBING_REC_NO}}">
                    </div> 
                    <div class="col-sm-4 ">              
                       
                    </div> 
                   
                    <div class="col-sm-2 ">
                        <label>ปี :</label>
                    </div> 
                    <div class="col-sm-2 ">
                                <span>
                                    <select name="PLUMBING_YEAR" id="PLUMBING_YEAR" class="form-control input-sm js-example-basic-single fo13" required>
                                    @foreach ($budgets as $budget)
                                    @if($budget->LEAVE_YEAR_ID == $pum->PLUMBING_YEAR)
                                        <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                    @else
                                        <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                    @endif                                 
                                @endforeach                         
                                    </select>
                                </span> 
                        </div>
                    </div>  
                    <div class="row push text-left">
                        <div class="col-sm-2 ">
                        <label>รหัสตัวอย่าง :</label>
                        </div> 
                        <div class="col-sm-2 ">              
                        <input name="PLUMBING_BILL_NO" id="PLUMBING_BILL_NO" class="form-control input-sm fo13" value="{{$pum->PLUMBING_BILL_NO}}">
                        </div> 
                       
                            <div class="col-sm-2 ">
                                <label>สัญลักษณ์ชนิดตัวอย่าง :</label>
                                </div> 
                                <div class="col-sm-2 ">              
                                <input  name="PLUMBING_EMBLEM" id="PLUMBING_EMBLEM" class="form-control input-sm fo13" value="{{$pum->PLUMBING_EMBLEM}}" >
                        </div> 
                        <div class="col-sm-2 ">
                            <label>รหัสตัวอย่างผู้ส่ง :</label>
                        </div> 
                        <div class="col-sm-2 ">              
                        <input  name="PLUMBING_NO_SEND" id="PLUMBING_NO_SEND" class="form-control input-sm fo13" value="{{$pum->PLUMBING_NO_SEND}}">
                            </div>
                         
                        </div>    
                    <div class="row push text-left">
                        <div class="col-sm-2 ">
                        <label>ประเภทตัวอย่าง :</label>
                        </div> 
                        <div class="col-sm-2 ">              
                       
                            <select name="PLUMBING_GROUP_EX" id="PLUMBING_GROUP_EX" class="form-control js-example-basic-single fo13" >
                                <option value="">--เลือก--</option>
                                @foreach ($pum_group_exs as $item)
                                    @if ($pum->PLUMBING_GROUP_EX == $item->PLUMBING_GROUP_EX_ID)
                                    <option value="{{$item->PLUMBING_GROUP_EX_ID}}" selected>น้ำดื่ม</option>
                                    @else
                                    <option value="{{$item->PLUMBING_GROUP_EX_ID}}">น้ำดื่ม</option>
                                    @endif
                                @endforeach
                            </select>
    
                        </div> 
                       
                        <div class="col-sm-2 ">
                            <label>สภาพตัวอย่าง</label>
                            </div> 
                            <div class="col-sm-2 ">              
                                <select name="PLUMBING_CONDITION" id="PLUMBING_CONDITION" class="form-control js-example-basic-single fo13" >
                                    @foreach ($pum_conditions as $pum_condition)
                                    @if ($pum->PLUMBING_CONDITION == $pum_condition->PLUMBING_CONDITION_ID)
                                    <option value="{{$pum_condition->PLUMBING_CONDITION_ID}}" selected>{{$pum_condition->PLUMBING_CONDITION_NAME}}</option>
                                    @else
                                    <option value="{{$pum_condition->PLUMBING_CONDITION_ID}}" >{{$pum_condition->PLUMBING_CONDITION_NAME}}</option>
                                    
                                    @endif
                                    @endforeach
                                   
                                </select>
                        </div> 
                        <div class="col-sm-2 ">
                            <label>สภาวะแวดล้อมของตัวอย่าง :</label>
                        </div> 
                        <div class="col-sm-2 ">              
                        <input  name="PLUMBING_ENVIRONMENT" id="PLUMBING_ENVIRONMENT" class="form-control input-sm fo13" value="{{$pum->PLUMBING_ENVIRONMENT}}">
                            </div>  
                        </div>  
                        <div class="row push text-left">
                            <div class="col-sm-2 ">
                            <label>หน่วยงานที่ส่ง :</label>
                            </div> 
                            <div class="col-sm-10 ">              
                                <input name="PLUMBING_DEPRAT_SUBSUB" id="PLUMBING_DEPRAT_SUBSUB" class="form-control input-sm fo13" value="{{$pum->PLUMBING_DEPRAT_SUBSUB}}">
                             
                                </div>  
                            </div> 
               
                    <div class="row push text-left">
                        <div class="col-sm-2 ">
                        <label>สถานที่เก็บ :</label>
                            </div> 
                            <div class="col-sm-4 ">
                                <input  name="PLUMBING_LOCATION" id="PLUMBING_LOCATION" class="form-control input-sm fo13" value="{{$pum->PLUMBING_LOCATION}}">
                    </div> 
                    <div class="col-sm-1 ">
                        <label>จังหวัด :</label>
                            </div> 
                            <div class="col-sm-2 ">
                                <select name="PLUMBING_CH" id="PLUMBING_CH" class="form-control input-sm js-example-basic-single provice_sub fo13" required>
                                    <option value="">--เลือก--</option>
                                    @foreach ($infoprovinces as $infoprovince)
                                    @if($pum->PLUMBING_CH == $infoprovince -> ID)
                                            <option value=" {{ $infoprovince -> ID }}" selected>{{ $infoprovince -> PROVINCE_NAME }}</option>
                                    @else
                                    <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                    @endif
                                    @endforeach         
                                    </select>
                                </div> 
                    <div class="col-sm-1 ">
                        <label>อำเภอ :</label>
                            </div> 
                            <div class="col-sm-2 ">
                                <select name="PLUMBING_AM" id="PLUMBING_AM" class="form-control input-sm js-example-basic-single amphures_sub fo13" >
                                    <option value="">--เลือก--</option>
                                    @foreach ($infoamphurs as $infoamphur)
                                    @if($pum->PLUMBING_AM == $infoamphur -> ID)
                                            <option value=" {{ $infoamphur -> ID }}" selected>{{ $infoamphur -> AMPHUR_NAME }}</option>
                                    @else
                                    <option value=" {{ $infoamphur -> ID }}" >{{ $infoamphur -> AMPHUR_NAME }}</option>
                                    @endif
                                    @endforeach     
                                    </select>
                            </div> 
                        </div>
                    <div class="row push text-left">
                        <div class="col-sm-2 ">
                        <label>วันที่รับ :</label>
                            </div> 
                            <div class="col-sm-2 ">
                                <input name="PLUMBING_REC_DATE" id="PLUMBING_REC_DATE" class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy" value="{{formate($pum->PLUMBING_REC_DATE)}}" readonly >
                          
                    </div> 
                    <div class="col-sm-2 ">
                        <label>วันที่วิเคราะห์ :</label>
                            </div> 
                            <div class="col-sm-2 ">
                                <input name="PLUMBING_ANALYZE_DATE" id="PLUMBING_ANALYZE_DATE" class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy" value="{{formate($pum->PLUMBING_ANALYZE_DATE)}}" readonly >
                          
                    </div> 
    
                    <div class="col-sm-2 ">
                        <label>วันที่ออกใบรายงาน :</label>
                            </div> 
                            <div class="col-sm-2 ">
                                <input name="PLUMBING_DATE" id="PLUMBING_DATE" class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy" value="{{formate($pum->PLUMBING_DATE)}}" readonly >
                    </div> 
    
                    </div>

         
                <div class="row push">
                    <div class="col-sm-2 ">
                        <div align="left" style=" font-family:'Kanit', sans-serif;font-size: 13px;font-weight:bold;">
                        รายการตรวจเช็ค :
                        </div>
                    </div>
                    <div class="col-lg-9 ">
                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                            <thead style="background-color: #BDFBC9;">
                                <tr height="40">
                                    <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="5%">ลำดับ</th>
                                    <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;">รายการทดสอบ</th>
                                    <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;" width="20%">หน่วย</th>
                                    <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;" width="20%">ผลการทดสอบ</th>
                                    <th style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;">วิธีทดสอบ</th>
                                   
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php $number = 0; ?>
                                @foreach($list_checks as $list_check)
                                <?php $number++;  ?>
                                <tr height="20"> 
                                    <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;"> {{ $number}} </td>
                                    <td><input value="{{ $list_check->PLUMBING_SUB_TESTLIST }}" name="PLUMBING_SUB_TESTLIST[]" id="PLUMBING_SUB_TESTLIST[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" readonly></td>
                                    <td><input value="{{ $list_check->PLUMBING_SUB_UNIT }}" name="PLUMBING_SUB_UNIT[]" id="PLUMBING_SUB_UNIT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" readonly></td>
                                    <td><input value="{{ $list_check->PLUMBING_SUB_TEST }}" name="PLUMBING_SUB_TEST[]" id="PLUMBING_SUB_TEST[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" ></td>
                                    <td class="text-font"><input value="{{ $list_check->PLUMBING_SUB_TESTER }}" name="PLUMBING_SUB_TESTER[]" id="PLUMBING_SUB_TESTER[]" class="form-control input-sm fo13" readonly></td>
                                                                      
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
                            <a href="{{ url('manager_env/plumbing')}}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                    </div>
                </div>
        </div>
    </div>


@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

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

<script>
     
    $('.provice').change(function(){
            if($(this).val()!=''){
            var select=$(this).val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('dropdown.fetch')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                       $('.amphures').html(result);
                    }
            })
           // console.log(select);
            }        
    });

    $('.amphures').change(function(){
            if($(this).val()!=''){
            var select=$(this).val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('dropdown.fetchsub')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                       $('.tumbon').html(result);
                    }
            })
           // console.log(select);
            }        
    });

    $('.provice_sub').change(function(){
            if($(this).val()!=''){
            var select=$(this).val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('dropdown.fetch')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                       $('.amphures_sub').html(result);
                    }
            })
           // console.log(select);
            }        
    });

    $('.amphures_sub').change(function(){
            if($(this).val()!=''){
            var select=$(this).val();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('dropdown.fetchsub')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                       $('.tumbon_sub').html(result);
                    }
            })
           // console.log(select);
            }        
    });

     </script>

@endsection