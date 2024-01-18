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
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>บันทึกข้อมูลขยะ</B></h3>
                </div>

            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('menv.trash_save') }}" method="post">
                @csrf       

                <div class="row push text-left">
                    <div class="col-sm-2 ">
                    <label>TRASH_NO :</label>
                    </div> 
                    <div class="col-lg-2">              
                    <input value="{{$billNos}}" name="TRASH_BILL_NO" id="TRASH_BILL_NO"  class="form-control input-lg fo13" >
                    </div> 
                    <div class="col-sm-1 ">
                        <label>วันที่บันทึก :</label>
                        </div> 
                        <div class="col-lg-2 ">              
                        <input  name="TRASH_DATE" id="TRASH_DATE" class="form-control input-lg datepicker fo13" data-date-format="mm/dd/yyyy" value="{{formate(date('Y-m-d'))}}" readonly >
                        </div>
                        <div class="col-sm-1 ">
                            <label>เวลา :</label>
                            </div> 
                            <div class="col-lg-1 ">              
                            <input  name="TRASH_TIME" id="TRASH_TIME" class="js-masked-time form-control fo13" required>
                            </div> 
                    <div class="col-sm-1 ">
                    <label>ปี :</label>
                    </div> 
                    <div class="col-lg-1 "> 
                        <span>
                            <select name="TRASH_YEAR" id="TRASH_YEAR" class="form-control input-lg fo13">
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
                 
                        </div>

                        <div class="row push text-left">                           
                            <div class="col-sm-2">
                                <label>Supplies :</label>
                                </div> 
                                <div class="col-lg-5 ">
                                <span>
                                <select name="TRASH_SUP" id="TRASH_SUP" class="form-control input-lg js-example-basic-single fo13" required>
                                    <option value="">--เลือก--</option>
                                    @foreach ($trash_sups as $trash_sup)
                                        <option value="{{ $trash_sup->VENDOR_ID  }}">{{ $trash_sup->VENDOR_NAME}} </option>
                                    @endforeach 
                                    </select>
                                </span> 
                                </div> 
                               
                        <div class="col-sm-1 ">
                            <label>ผู้บันทึก :</label>
                            </div> 
                            <div class="col-lg-3 ">
                            <span>
                            <select name="TRASH_USER" id="TRASH_USER" class="form-control input-lg js-example-basic-single fo13" required>
                                <option value="">--เลือก--</option>
                                @foreach ($infopers as $infoper)
                                    <option value="{{ $infoper->ID  }}">{{ $infoper->HR_FNAME}}  {{ $infoper->HR_LNAME}}</option>
                                @endforeach 
                                </select>
                            </span> 
                            </div> 
                            </div>


                        <div class="row push">
                            <div class="col-sm-2 ">
                                <div align="left" style=" font-family:'Kanit', sans-serif;font-size: 13px;font-weight:bold;">
                                    ประเภทขยะ :
                                </div>
                            </div>
                            <div class="col-lg-9 ">
                                <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                    <thead style="background-color: #BDFBC9;">
                                        <tr height="40">
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="5%">ลำดับ</td>
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" >ประเภทขยะ</td> 
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="15%">ปริมาณ</td>   
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 14px;font-family: 'Kanit', sans-serif;font-size: 13px;" width="15%">หน่วย</td>                                         
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        <?php $number = 0; ?>
                                        @foreach($trash_sets as $trash_set)
                                        <?php $number++;  ?>
                                        <tr height="20"> 
                                            
                                            <td style="text-align: center;font-family: 'Kanit', sans-serif;font-size: 13px;"> {{ $number}} </td>                                           
                                           <td>                                                
                                                <input type="hidden" value="{{ $trash_set->SET_TRASH_ID  }}" name="SET_TRASH_ID[]" id="SET_TRASH_ID[]" class="form-control input-sm fo13">
                                                <input value="{{ $trash_set->SET_TRASH_NAME  }}" name="" id="" class="form-control input-sm fo13" readonly>
                                           </td>
                                            <td>
                                                <input name="TRASH_SUB_QTY[]" id="TRASH_SUB_QTY[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;"  onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข '); this.value='';}" >
                                            </td>   
                                            <td>
                                                <input value="{{ $trash_set->SET_TRASH_UNIT  }}" name="TRASH_SUB_UNIT[]" id="TRASH_SUB_UNIT[]" class="form-control input-sm fo13" readonly>
                                            </td>                               
                                           
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
                            <a href="{{ url('manager_env/trash')}}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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
    
$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody').children('tr').length;
        var tr =   '<tr>'+
                '<td style="text-align: center;">'+
                (count+1)+
                '</td>'+
                '<td>'+
                '<select name="TRASH_SUB_NAME[]" id="TRASH_SUB_NAME[]" class="form-control  input-lg" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;">'+
                '<option value="">--เลือก--</option>'+
                '@foreach ($trash_types as $trash_type)'+
                '<option value="{{ $trash_type->TRASH_TYPE_ID  }}">{{ $trash_type->TRASH_TYPE_NAME}} </option>'+
                '@endforeach'+
                '</select>'+
                '</td>'+   
                '<td>'+
                '<input name="TRASH_SUB_QTY[]" id="TRASH_SUB_QTY[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 13px;">'+
                '</td>'+   
                '<td>'+
                '<input name="TRASH_SUB_UNIT[]" id="TRASH_SUB_UNIT[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 13px;">'+
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody').append(tr);
    };

    $('.tbody').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
</script>



@endsection