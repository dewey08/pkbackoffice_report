@extends('layouts.env')
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

    use App\Http\Controllers\ManagerenvController;

?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;           
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

</style>

<center>
<!-- Dynamic Table Simple -->
<div class="block mt-5" style="width: 98%;">
    <div class="block-header block-header-default" >
           
            
            
 <div align="left">
    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดผลวิเคราะห์คุณภาพน้ำทิ้ง</B></h3>
</div>
<div align="right">
    <a href="{{ url('manager_env/watertreatmentexcel')}}"  class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>Export To Excel</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a  href="{{ url('manager_env/watertreatment_add')}}"  class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
</div>
        </div>
    <div class="block-content block-content-full">
        <form action="{{route('menv.watertreatment')}}" method="post">
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
                {{-- <div class="col-sm-0.5">
                    &nbsp;สถานะ &nbsp;
                </div>
                <div class="col-sm-2">
                    <span>
                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--เลือกประเภทการรายงาน--</option>                         
                                
                        </select>
                    </span>                   
                </div> --}}
                <div class="col-sm-0.5">
                    &nbsp;ค้นหา &nbsp;
                </div>
                <div class="col-sm-2">
                    <span>
                        <input type="search"  name="search" class="form-control " style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                    </span>
                </div>
                <div class="col-sm-30">
                         &nbsp;
                </div> 
                <div class="col-sm-1.5">
                    <span>
                         <button type="submit" class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                    </span> 
                </div>
            </div>  
        </form>
<div class="table-responsive" style="height:500px;"> 
<!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
            <thead style="background-color: #F6E1F9;">
                <tr height="40">
                    <th class="text-font" style="text-align: center;" width="2%">ลำดับ</th> 
                    <th  class="text-font" style="text-align: center;" width="4%">ปี</th>  
                    <th  class="text-font" style="text-align: center;" width="6%">วันที่บันทึก</th>
                    <th  class="text-font" style="text-align: center;" width="10%">สถานที่เก็บตัวอย่าง</th>
                    <th  class="text-font" style="text-align: center;"  width="10%">ลักษณะตัวอย่าง</th>
                    <th  class="text-font" style="text-align: center;"  width="7%">วันที่รับตัวอย่าง</th>
                    <th  class="text-font" style="text-align: center;"  width="8.2%">วันที่วิเคราะห์ตัวอย่าง</th>
                    <th  class="text-font" style="text-align: center;" width="10%">ผู้วิเคราะห์ตัวอย่าง</th>
                    {{-- @foreach($lists as $list)
                    <th  class="text-font" style="text-align: center;" width="8%">{{$list->LIST_PARAMETER_DETAIL}}</th>
                    @endforeach  --}}
                    <th  class="text-font" style="text-align: center;" width="8%">ผู้บันทึก</th> 
                    <th  class="text-font" style="text-align: center;" width="8%">คำสั่ง</th>  
                </tr >
            </thead>
            <tbody>
                <?php $number = 0; ?>
                @foreach($parameters as $parameter)
                <?php $number++;  ?>
                <tr height="20">
                    <td class="text-font" align="center" > {{ $number}} </td>
                    <td class="text-font" align="center" >{{ $parameter->PARAMETER_YEAR }}</td>   
                    <td class="text-font text-pedding" >{{ DateThai($parameter->PARAMETER_DATE) }}</td> 
                    <td class="text-font" align="center" >{{$parameter->LOCATION_EX}}</td>
                     <td class="text-font" align="center" >{{$parameter->GROUP_EXCAMPLE}}</td>
                     <td class="text-font text-pedding"  >{{DateThai($parameter->LOCATION_EXDATE)}}</td>
                     <td class="text-font text-pedding"  >{{DateThai($parameter->GROUP_EXCAMPLEDATE)}}</td>
                     <td class="text-font" align="center" >{{$parameter->USER_EXCAMPLE}}</td>
                     {{-- @foreach($lists as $list)
                     <th  class="text-font" style="text-align: center;" >{{ManagerenvController::total_parameter($list->LIST_PARAMETER_ID,$parameter->PARAMETER_ID)}}</th>
              
                     @endforeach   --}}
                   
     
                    <td class="text-font" align="center" >{{ $parameter->HR_FNAME }}  {{ $parameter->HR_LNAME }}</td> 
                    <td class="text-font" align="center" >
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                ทำรายการ
                            </button>
                            <div class="dropdown-menu" style="width:5px">
                                <a class="dropdown-item" href="{{ url('manager_env/watertreatment_edit/'.$parameter->PARAMETER_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;">แก้ไขข้อมูล</a> 
                               
                                <a class="dropdown-item" href="{{ url('manager_env/watertreatment_destroy/'.$parameter->PARAMETER_ID)}}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')"  style="font-family: 'Kanit', sans-serif; font-size: 13px;">ลบข้อมูล</a> 
                            </div>
                        </div>
                    </td>  
                </tr> 
                @endforeach 
            </tbody>
            </div>
        </div>


@endsection

@section('footer')


<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

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
function chkNumber(ele){
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar<'0' || vchar>'9')) return false;
    ele.onKeyPress=vchar;
    }
    datepick();
   function datepick() {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                todayHighlight: true,
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


    //////กดปุ่ม Enter
    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});
</script>
@endsection