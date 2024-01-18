@extends('layouts.guesthouse')   
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


    use Illuminate\Support\Facades\DB;

?>
<center>    
    <div class="block mt-5" style="width: 95%;" >
        <div class="block block-rounded block-bordered">
               
            <div class="block-header block-header-default">
                <h3 class="block-title text-left " style="font-family: 'Kanit', sans-serif;"><B>รายละเอียด ค่าน้ำ - ค่าไฟ บ้านพัก</B></h3>
                <a href="{{ url('manager_guesthouse/guesthouseutilitybills_addwater')  }}"   class="btn btn-hero-sm btn-hero-info foo15 loadscreen" ><i class="fas fa-plus"></i> เพิ่มข้อมูลค่าน้ำ</a>
                &nbsp;
                <a href="{{ url('manager_guesthouse/guesthouseutilitybills_addelec')  }}"   class="btn btn-hero-sm btn-hero-warning  foo15 loadscreen" ><i class="fas fa-plus"></i> เพิ่มข้อมูลค่าไฟ</a>
               
              
            </div>
            
         
            <div class="block-content shadow-lg">
                รายละเอียดค่าน้ำ
                    <div class="table-responsive" style="height : 500px;">
           
                        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;" >
                        
                            <thead style="background-color:  #6fc5f6;">
                                <tr height="40">
                                    <th class="text-font" style="text-align: center" width="10%">ลำดับ</th> 
                                    <th class="text-font" style="text-align: center" >ประจำเดือน </th> 
                                    <th class="text-font" style="text-align: center" width="10%">คำสั่ง</th>   
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($infomaitonwaterheads as $infomaitonwaterhead)
                                <tr>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                                            {{$infomaitonwaterhead->GUEST_WATER_H_YEAR}}
                                        </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                                     
                                        </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                                        
                                        </td>

                                 </tr>
                                @endforeach
                            </tbody>
                            </table>


                            รายละเอียดค่าไฟ
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;" >
                        
                                <thead style="background-color:  #f6bc71;">
                                    <tr height="40">
                                        <th class="text-font" style="text-align: center" width="10%">ลำดับ</th> 
                                        <th class="text-font" style="text-align: center" >ประจำเดือน </th>   
                                        <th class="text-font" style="text-align: center" width="10%">คำสั่ง</th>   
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($infomaitonelecheads as $infomaitonelechead)
                                    <tr>
                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                                                {{$infomaitonelechead->GUEST_ELEC_H_YEAR}}
                                            </td>
                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                                                {{MonthThai($infomaitonelechead->GUEST_ELEC_H_MONTH)}}
                                            </td>
                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">    
                                        
                                            </td>
                                    </tr>
                                    @endforeach
    
                                </tbody>
                                </table>
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