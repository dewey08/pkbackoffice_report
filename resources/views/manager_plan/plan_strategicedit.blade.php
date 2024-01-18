@extends('layouts.plan')   
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
            <div class="block-header block-header-default" style="text-align: left">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>วิสัยทัศน์ :: {{$usevision->VISION_NAME}}</B></h3>

            </div>
            <div class="block-content block-content-full">
<form  method="post" action="{{ route('mplan.updateplanstrategic') }}" enctype="multipart/form-data">
@csrf

        <input type="hidden" name="STRATEGIC_ID" id="STRATEGIC_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infostrategic->STRATEGIC_ID}}" >

        <div class="col-sm-12">
        <div class="row">
     
        <div class="col-lg-2" style="text-align: left">
                <label >                           
                พันธกิจ :              
                </label>
                </div> 
                <div class="col-lg-8">
                <select name="MISSION_ID" id="MISSION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกพันธกิจ--</option>
                    @foreach ($infomissions as $infomission)     
                        @if($infomission ->MISSION_ID == $infostrategic->MISSION_ID)
                        <option value="{{ $infomission ->MISSION_ID  }}" selected>{{ $infomission->MISSION_DETAIL}}</option>   
                        @else
                        <option value="{{ $infomission ->MISSION_ID  }}">{{ $infomission->MISSION_DETAIL}}</option>
                        @endif                                                
                    
                    @endforeach 
             </select>    
              
                </div> 

        </div>
        <br>
        <div class="row">
     
        <div class="col-lg-2" style="text-align: left">
        <label >                           
        ยุทธศาสตร์ :              
        </label>
        </div> 
        <div class="col-lg-8">
        <input name="STRATEGIC_NAME" id="STRATEGIC_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infostrategic->STRATEGIC_NAME}}" >
        </div> 
   
        </div>
        <br>
        <div class="row">
     
     <div class="col-lg-2" style="text-align: left">
     <label >                           
     เริ่มต้นปีงบประมาณ :              
     </label>
     </div> 
     <div class="col-lg-3">
     <input name="STRATEGIC_BEGIN_YEAR" id="STRATEGIC_BEGIN_YEAR" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infostrategic->STRATEGIC_BEGIN_YEAR}}" >
     </div> 
     <div class="col-lg-2" style="text-align: left">
     <label >                           
     สิ้นสุดปีงบประมาณ :              
     </label>
     </div> 
     <div class="col-lg-3">
     <input name="STRATEGIC_END_YEAR" id="STRATEGIC_END_YEAR" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infostrategic->STRATEGIC_END_YEAR}}" >
     </div> 

     </div>

       </div>
       <br>
 
       



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;font-weight: normal;" ><i class="fas fa-save mr-2"></i>บันทึก</button>
        <a href="{{ url('manager_plan/plan_strategic')  }}" class="btn btn-hero-sm btn-hero-danger" style=" font-family: 'Kanit', sans-serif;font-weight: normal;" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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