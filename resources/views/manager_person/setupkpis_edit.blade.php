@extends('layouts.person')   
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
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขรายการ ตัวชี้วัดบุคคล KPIs</B></h3>

            </div>
            <div class="block-content block-content-full">




            <br>
            <form  method="post" action="{{route('mperson.setupkpis_update')}}" enctype="multipart/form-data">
        @csrf
       
        <div class="col-sm-12">

        <input type="hidden" name="KPIS_ID" id="KPIS_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infokpis->KPIS_ID}}" >
  
        <div class="row push">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        รหัส :              
        </label>
        </div> 
        <div class="col-lg-3">
        <input name="KPIS_CODE" id="KPIS_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infokpis->KPIS_CODE}}" >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        รายการ :              
        </label>
        </div> 
        <div class="col-lg-7">
        <input name="KPIS_NAME" id="KPIS_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infokpis->KPIS_NAME}}" >
        </div> 
      

        
      
        </div> 

 
      
       </div>
       <br>
 
       



        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <a href="{{ url('manager_person/setupkpis')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
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