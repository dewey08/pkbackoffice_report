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

    use App\Http\Controllers\ManagerplanController;

?>
          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
    @if (session('success'))
        <div class="alert alert-success" align="left">
            <ul>
                <li>{{session('success')}}</li>
            </ul>
        </div>
    @endif
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนพัสดุ</B></h3>
                <a href="{{ url('manager_plan/plansupplies_add_year') }}" class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-plus mr-2"></i> เพิ่มปีงบประมาณ</a>
            </div>
            <div class="block-content block-content-full">
            
                <div class="table-responsive"> 
               
                        <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                            <thead style="background-color: #FFEBCD;">                        
                                <tr  height="40">
                                    <th  class="text-font" width="5%" style="text-align: center;">ลำดับ</th>
                                    <th  class="text-font" style="text-align: center;">ปีงบประมาณ</th>
                                    <th  class="text-font" width="15%" style="text-align: center;">แผนจัดซื้อวัสดุ</th>
                                    <th  class="text-font" width="15%" style="text-align: center;">แผนจัดซื้อครุภัณฑ์</th>
                                    <th  class="text-font" width="15%" style="text-align: center;">แผนจ้างเหมา</th>
                                    <th  class="text-font" width="8%" style="text-align: center;">คำสั่ง</th> 
                                </tr>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php $number = 0; ?>
                                @foreach($plan_year as $row)
                                <?php $number++; ?> 
                                    <tr  height="40">
                                        <td class="text-font" align="center" >{{$number}}</td> 
                                        <td class="text-font text-pedding" >ปีงบประมาณ {{$row->PLAN_SUPPLIES_YEAR}}</td> 
                                        <td class="text-font" align="center" >{{ManagerplanController::sum_material_plan($row->PLAN_SUPPLIES_YEAR_ID)}}</td> 
                                        <td class="text-font" align="center" >{{ManagerplanController::sum_durable_plan($row->PLAN_SUPPLIES_YEAR_ID)}}</td> 
                                        <td class="text-font" align="center" >{{ManagerplanController::sum_charter_plan($row->PLAN_SUPPLIES_YEAR_ID)}}</td> 
                                        <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                        ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">                                                    
                                                   <a class="dropdown-item" href="{{ url('manager_plan/plansupplies_detail/'.$row->PLAN_SUPPLIES_YEAR_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                </div>
                                            </div>
                                        </td> 
                                    </tr> 
                               @endforeach
                            </tbody>
                        </table>
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