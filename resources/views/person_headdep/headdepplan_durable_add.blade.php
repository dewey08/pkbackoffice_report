@extends('layouts.headdep')   
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
                        }

            .text-font {
        font-size: 13px;
                    }   

                    .form-control {
            font-family: 'Kanit', sans-serif;
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
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B><i class="fas fa-plus"></i> เพิ่มข้อมูลแผนจัดซื้อครุภัณฑ์</B></h3>

            </div>
            <div class="block-content block-content-full">




            <br>
            <form  method="post" action="{{ route('mplan.durable_save') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="DUR_SAVE_HR_ID" id="DUR_SAVE_HR_ID" value="{{$id_user}}">

        <div class="col-sm-12">
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ปีงบประมาณ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">   
                     @foreach ($budgets as $budget)
                             @if($budget->LEAVE_YEAR_ID== $year_id)
            <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                            @else
            <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
            </select>
        </div> 
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ตามยุทธศาสตร์ :              
        </label>
        </div> 
        <div class="col-lg-6">
        <select name="STRATEGIC_ID" id="STRATEGIC_ID" class="form-control input-lg strategic" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartment()">
                        <option value="" >--กรุณาเลือกยุทธศาสตร์--</option>
                                @foreach ($infostrategics as $infostrategic) 
                                                                                                  
                                    <option value="{{ $infostrategic ->STRATEGIC_ID  }}">{{ $infostrategic->STRATEGIC_NAME }}</option>
                                                                       
                        @endforeach 
        </select>
        </div> 
   
        </div>
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        เป้าประสงค์ :              
        </label>
        </div> 
        <div class="col-lg-4">
        <select name="TARGET_ID" id="TARGET_ID" class="form-control input-lg goal" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartmentsub()">
        <option value="" >--กรุณาเลือกเป้าประสงค์--</option>
        </select>
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        ตัวชี้วัด :              
        </label>
        </div> 
        <div class="col-lg-5">
        <select name="KPI_ID" id="KPI_ID" class="form-control input-lg metric" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartmentsubsub()">
        <option value="" >--กรุณาเลือกตัวชี้วัด--</option>
        </select>
        </div> 
   
        </div>

        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        รหัสโครงการ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="DUR_NUMBER" id="DUR_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>

        <div class="col-lg-2" style="text-align: left">
        <label >                           
         แผนงาน/โครงการ :              
        </label>
        </div> 
        <div class="col-lg-6">
        <input name="DUR_NAME" id="DUR_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div> 

        </div>

        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ค่าซื้อครุภัณฑ์ :              
        </label>
        </div> 
        <div class="col-lg-3">
        <input name="DUR_ASS_NAME" id="DUR_ASS_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>

        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ราคาต่อหน่วย :              
        </label>
        </div> 
        <div class="col-lg-3">
        <input name="DUR_ASS_PICE_UNIT" id="DUR_ASS_PICE_UNIT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div>
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        บาท            
        </label>
        </div>

        </div>
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        งบประมาณ:              
        </label>
        </div> 
        <div class="col-lg-3">
       <select name="BUDGET_ID" id="BUDGET_ID" class="form-control input-sm"  style=" font-family: 'Kanit', sans-serif;">   
        <option value="">กรุณาเลือกแผนงาน</option>                         
                @foreach ($infobudgettypes as $infobudgettype)      
                    <option value="{{ $infobudgettype->BUDGET_ID  }}">{{ $infobudgettype->BUDGET_NAME}}</option>                                      
                @endforeach                         
        </select>
        </div> 
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        จำนวน :            
        </label>
        </div> 
        <div class="col-lg-3">
        <input name="BUDGET_PICE" id="BUDGET_PICE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div> 
        

        </div>

  
        <div class="row push">
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ทีมประสาน :              
        </label>
        </div> 
        <div class="col-lg-4">
        <select name="DUR_TEAM_NAME" id="DUR_TEAM_NAME" class="form-control input-sm"  style=" font-family: 'Kanit', sans-serif;">   
        <option value="">กรุณาเลือกแผนงาน</option>                         
                @foreach ($infotreams as $infotream)      
                    <option value="{{ $infotream->HR_TEAM_NAME  }}">{{ $infotream->HR_TEAM_NAME}}</option>                                      
                @endforeach                         
                                </select>
        </div> 
      

        
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        หัวหน้าโครงการ :              
        </label>
        </div> 
        <div class="col-lg-4">
        <select name="DUR_TEAM_HR_ID" id="DUR_TEAM_HR_ID" class="form-control input-sm"  style=" font-family: 'Kanit', sans-serif;">   
        <option value="">กรุณาเลือกหัวหน้า</option>                         
                @foreach ($infotreampersons as $infotreamperson)      
                    <option value="{{ $infotreamperson->PERSON_ID  }}">{{ $infotreamperson->BOARD_NAME}}</option>                                      
                @endforeach                         
                                </select>
        </div> 
        </div> 

 
        <div class="row push">
   
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        หมายเหตุ :            
        </label>
        </div> 
        <div class="col-lg-4">
        <input name="DUR_COMMENT" id="DUR_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
        </div> 

     
   
        </div>
     
       </div>
       <br>
 
       



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <a href="{{ url('manager_plan/durable')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  

            
        



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

$('.strategic').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('plandropdown.strategic')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.goal').html(result);
             }
     })
    
     }        
});

$('.goal').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('plandropdown.goal')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.metric').html(result);
             }
     })
   
     }        
});



</script>

<script>


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection