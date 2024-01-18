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
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยุทธศาสตร์</B></h3>
                <a href="{{ url('manager_plan/addplanstrategic') }}"   class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
            </div>
            <div class="block-content block-content-full">
            
             <div class="table-responsive"> 
            
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                           
                            <th  class="text-font" style="text-align: center;" >	ยุทธศาสตร์	</th>
                            <th  class="text-font" style="text-align: center;" width="15%">เริ่มต้นปีงบประมาณ</th>
                            <th  class="text-font" style="text-align: center;" width="15%">สิ้นสุดปีงบประมาณ</th>
                            <th  class="text-font" style="text-align: center;" width="8%">เปิดใช้</th>

                            <th  class="text-font" style="text-align: center" width="10%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                   
                    <?php $number = 0; ?>
                                @foreach ($infostrategics as $infostrategic)
                    <?php $number++; ?>

                        <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                              
                                <td class="text-font text-pedding" >{{$infostrategic->STRATEGIC_NAME}}</td>
                                <td class="text-font text-pedding" align="center">{{$infostrategic->STRATEGIC_BEGIN_YEAR}}</td>
                                <td class="text-font text-pedding" align="center">{{$infostrategic->STRATEGIC_END_YEAR}} </td>
                                <td align="center" width="5%">
                                            <div class="custom-control custom-switch custom-control-lg ">
                                             @if($infostrategic->ACTIVE == 'TRUE' )
                                                 <input type="checkbox" class="custom-control-input" id="{{ $infostrategic-> STRATEGIC_ID}}" name="{{ $infostrategic-> STRATEGIC_ID }}" onchange="switchactive({{ $infostrategic-> STRATEGIC_ID}});" checked>
                                             @else
                                                <input type="checkbox" class="custom-control-input" id="{{ $infostrategic-> STRATEGIC_ID}}" name="{{ $infostrategic-> STRATEGIC_ID }}" onchange="switchactive({{$infostrategic-> STRATEGIC_ID }});">
                                             @endif
                                                <label class="custom-control-label" for="{{ $infostrategic-> STRATEGIC_ID }}"></label>
                                            </div>
                                     </td>
                             
                                <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="{{ url('manager_plan/plan_strategic_detail/'.$infostrategic->STRATEGIC_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียด</a>   
                                                <a class="dropdown-item"  href="{{ url('manager_plan/editplanstrategic/'.$infostrategic->STRATEGIC_ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >แก้ไข</a>   
                                                <a class="dropdown-item"  href="{{ url('manager_plan/plan_target/'.$infostrategic->STRATEGIC_ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >เพิ่มเป้าประสงค์และ KPI</a>   


                                                </div>
                                            </div>
                                </td>     
                        
                        </tr>

                    @endforeach
                        
                   

                    </tbody>
                </table>
                <br>
                <br>
                <br>
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
    
    let token= $('meta[name="csrf-token"]').attr('content');
function switchactive(idfunc){
    var checkBox=document.getElementById(idfunc);
    var onoff;

    if (checkBox.checked == true){
        onoff = "True";
    } else {
        onoff = "False";
    }
    $.ajax({
        url:"{{route('mplan.plan_strategic_active')}}",
        method:"POST",
        data:{
            onoff:onoff,
            idfunc:idfunc,
            _token:token
        },
        success:function(result){
            if(!result){
                Swal('เกิดข้อผิดพลาด','ไม่พบรายการที่ต้องการเปลี่ยนสถานะการใช้งาน','error');
            }
        }
    })
}

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