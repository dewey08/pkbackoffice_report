@extends('layouts.compensation')   
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
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
                    table, td, th {
            border: 1px solid black;
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

  
    use App\Http\Controllers\ManagercompensationController;
?>
<?php
    function month($strMonth)
    {

    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strMonthThai";
    }

    
?>   

                        

<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูล วันที่ {{$infohead->SALARYALL_HEAD_DAY_ID}}  เดือน {{month($infohead->SALARYALL_HEAD_MONTH_ID)}}   ปี {{$infohead->SALARYALL_HEAD_YEAR_ID}}  ประเภท 
                    @if($infohead->SALARYALL_HEAD_TYPE == 'compen')
                               ค่าตอบแทน
                           @else
                                เงินเดือน
                           @endif </B></h3>
             
                <div align="right">
                <a href="{{ url('manager_compensation/callcompensationdetail_subexcel/'.$infohead->SALARYALL_HEAD_ID)}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                <a href="{{ url('manager_compensation/infodetailcompensation') }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
                
                </div>
            </div>
            <div class="block-content block-content-full">

            <form action="{{ route('mcompensation.callcompensationdetail_subsearch',['idref' => $infohead->SALARYALL_HEAD_ID]) }}" method="post">
                        @csrf

             <div class="row" >
            
     
                  <div class="col-md-3" >
                    <span>
                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                    </span>
                 </div>
               
          
                 <div class="col-md-1">
                 <span>
                 <button type="submit" class="btn btn-info"  style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                 </span> 
                 </div>
                 <div class="col-md-5">
                 &nbsp;
                 </div>
                 <div class="col-md-3">
                 รายการรวม {{$infocount}} มูลค่ารวม {{number_format($total,2)}} บาท
                </div> 
                
                </div>
          <br>
          
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-hover table-vcenter js-dataTable" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ตำแหน่ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภทข้าราชการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เลขบัญชี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าสุทธิ</th>
     
                         
                        </tr >
                    </thead>
                    <tbody>

                
                    <?php $count=1;?>
                     @foreach ($infopersons as $infoperson)

                   
                        <tr height="20" onclick="salarydetailperson({{$infoperson->SALARYALL_ID}})">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PREFIX_NAME}}{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->POSITION_IN_WORK}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_DEPARTMENT_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PERSON_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >
                            @if($infohead->SALARYALL_HEAD_TYPE == 'compen')
                            {{$infoperson->BOOK_BANK_OT_NUMBER}}
                            @else
                            {{$infoperson->BOOK_BANK_NUMBER}}
                            @endif
                        
                        </td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagercompensationController::callock_receive($infoperson->ID,$infohead->SALARYALL_HEAD_TYPE,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;">{{number_format(ManagercompensationController::callock_pay($infoperson->ID,$infohead->SALARYALL_HEAD_TYPE,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format(ManagercompensationController::callock_all($infoperson->ID,$infohead->SALARYALL_HEAD_TYPE,$infohead->SALARYALL_HEAD_YEAR_ID,$infohead->SALARYALL_HEAD_MONTH_ID,$infohead->SALARYALL_HEAD_DAY_ID),2)}}</td>
                     
            
                        </tr>
                        
                        <?php  $count++;?>
                        @endforeach 
                       
              


                   

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>


<div class="detail"></div>
                                    
  
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


function salarydetailperson(id){

 //alert(typecode);

$.ajax({
                url:"{{route('compensation.salarydetailperson')}}",
                method:"GET",
                data:{id:id},
                success:function(result){
                   $('.detail').html(result);
                   $('#detailsalaryperson').modal('show');
                   //alert("Hello! I am an alert box!!");
                }
                
        })


}


function salarydetailpersonsearch(id,year,month){

// alert('test');

$.ajax({
                url:"{{route('compensation.salarydetailpersonsearch')}}",
                method:"GET",
                data:{id:id,year:year,month:month},
                success:function(result){
                   $('.detail').html(result);
                   $('#detailsalarypersonsearch').modal('show');
                   //alert("Hello! I am an alert box!!");
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