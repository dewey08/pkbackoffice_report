@extends('layouts.risk')   
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
      
      
      .form-control{
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
         

                <div class="block-content">    

                    <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                            <div class="row">
                            <div class="col-md-8" align="right">
                            ทะเบียน ปค.5 หน่วยงาน &nbsp;&nbsp; ( {{$internalcontrols->HR_DEPARTMENT_SUB_NAME}} )
                                </div>
                            <div class="col-md-4" align="right">
                            <a href="{{ url('manager_risk/internalcontrol_pk5_depart_add/'.$icontrols->INTERNALCONTROL_ID.'/'.$icontrols->INTERNALCONTROL_HEAD_WORK.'/'.$icontrols->INTERNALCONTROL_GROUP_NAME)}}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                    <a href="{{ url('manager_risk/internalcontrol')}}"  class="btn btn-hero-sm btn-hero-success" >ย้อนกลับ</a>
                                
                            </div>
                            </div>
                            </h2>  





            <div class="block-content block-content-full">
            <form action="{{route('mrisk.internalcontrolsearch')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-1 text-right">
                            &nbsp;&nbsp; ปีงบ ;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
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
                        <div class="col-sm text-right">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm text-right">
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

<input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

</span>
</div>

<div class="col-sm-30">
&nbsp;
</div> 
<div class="col-sm-1 text-left">
<span>
<button type="submit" class="btn btn-sm btn-info" >ค้นหา</button>
</span> 
</div>


              
                  </div>  
             </form>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #9FFFBF;">
                        <tr height="40">
                            <th  class="text-font" style="text-align: center;font-size: 13px;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="text-align: center;font-size: 13px;" width="12%">วันที่บันทึก</th> 
                            <th  class="text-font" style="text-align: center;font-size: 13px;" >ระยะเวลา</th>  
                            <th  class="text-font" style="text-align: center;font-size: 13px;" width="20%">หัวหน้าฝ่ายงาน</th>  
                            <th  class="text-font" style="text-align: center;font-size: 13px;" width="10%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                        @foreach ($incontrol_pk5s as $incontrol_pk5)
                            <?php $number++; ?>
                            <tr height="20">                       
                                <td class="text-font" style="text-align: center;font-size: 13px;" align="center">{{ $number}}</td>
                                <td class="text-font text-pedding" style="text-align: center;font-size: 13px;">{{DateThai($incontrol_pk5->PK5_DEPART_DATE)}}</td>
                                <td class="text-font text-pedding" style="text-align: center;font-size: 13px;">{{DateThai($incontrol_pk5->PK5_DEPART_START_DATE)}}&nbsp;&nbsp;ถึง&nbsp;&nbsp; {{DateThai($incontrol_pk5->PK5_DEPART_LAST_DATE)}} </td>
                              
                                <td class="text-font text-pedding" style="text-align: center;font-size: 13px;">{{ $incontrol_pk5-> HR_FNAME}}  {{ $incontrol_pk5-> HR_LNAME}}</td>
                                
                                <td align="center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                    <div class="dropdown-menu" style="width:10px">   
                                            

                                            <a class="dropdown-item"  href="{{ url('manager_risk/internalcontrol_pk5_depart_edit/'.$incontrol_pk5->PK5_DEPART_ID) }}"  style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดแก้ไข</a>                        
                                            <a class="dropdown-item"  href="{{ url('manager_risk/internalcontrol_pk5_depart_destroy/'.$incontrol_pk5->PK5_DEPART_ID.'/'.$incontrol_pk5->PK5_DEPART_HEAD.'/'.$incontrol_pk5->PK5_DEPART_DEPART) }}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family:'Kanit',sans-serif;font-size:13px;">ลบ</a>
                                            
                                        </div>
                                    </div>
                                </td> 
                            </tr>
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
 <script src="{{ asset('js/toastr.min.js') }}"></script>
 <script>
        function error_toast(){
            // toastr.error("error message");
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
        }
 </script>
<script>

function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
           }
            
   })
    
}

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