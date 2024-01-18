@extends('layouts.backend')
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}

.text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
                  }  

                   .form-control{
    font-size: 13px;
                  }   

                  table, td, th {
            border: 1px solid black;
            }    
</style>

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




                                            
    $yearbudget = date("Y");
                                                 
          //echo  $yearbudget;                                 
    use Illuminate\Support\Facades\DB;
?>
<?php

  function MonthThai($strmonth)
{

  $strMonth= $strmonth;
  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strMonthThai";
  
}
  
?>

           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('person_compensation/dashboard/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                        <a href="{{ url('person_compensation/cominfosalary/'.$id_user)}}" class="btn btn-info loadscreen" >
                                            
                                            <span class="nav-main-link-name">ข้อมูลเงินเดือน</span>
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/certificate/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ขอใบรับรอง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/salaryslip/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">สลิปเงินเดือน</a>
                                </div>
                                <div>&nbsp;</div>  <div>
                                <a href="{{ url('person_compensation/borrow/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ยืม-คืน</a>
                                </div>
                                <div>&nbsp;</div>




                             

                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">


                    <!-- Dynamic Table Simple -->
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                        <img id="image_upload_preview" src="data:image/png;base64,{{ chunk_split(base64_encode($inforpersonuser->HR_IMAGE)) }}" height="100px" width="100px"> &nbsp;
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;  font-size: 15px;"><B>
                            &nbsp;&nbsp;&nbsp; {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}   </B> <br>&nbsp;&nbsp;&nbsp; <B>เลขประจำตัว</B> &nbsp;{{ $inforpersonuser -> HR_CID }}     &nbsp;&nbsp;&nbsp; <B>ตำแหน่ง</B> {{ $inforpersonuser -> POSITION_IN_WORK }}     &nbsp;&nbsp;&nbsp; <B>เงินเดือน</B>&nbsp; {{ number_format($inforpersonuser -> HR_SALARY,2) }} &nbsp;<B>บาท</B>
                            <br>&nbsp;&nbsp;&nbsp; <B>กลุ่มงาน</B> &nbsp;{{ $inforpersonuser -> HR_DEPARTMENT_NAME }} &nbsp;&nbsp;&nbsp; <B>ฝ่ายแผนก</B> &nbsp;{{ $inforpersonuser -> HR_DEPARTMENT_SUB_NAME }}              &nbsp;&nbsp;&nbsp; <B>หน่วยงาน</B> {{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }} 

                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                                       
                        <form action="{{ route('compensation.cominfosalary_search',['iduser' =>  $inforperson->ID]) }}" method="post"> 
                        @csrf

             <div class="row">

                 <div class="col-md-0.5" style="  font-size: 13px;";>
                     &nbsp;ปีงบประมาณ &nbsp;
                     </div>

                       <div class="col-md-2">
                       <span>

                       <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                       @foreach ($budgets as $budget)
                            @if($budget->LEAVE_YEAR_ID == $checkyear)
                            <option value="{{$budget->LEAVE_YEAR_ID}}" selected>{{$budget->LEAVE_YEAR_ID}}</option>
                            @else
                            <option value="{{$budget->LEAVE_YEAR_ID}}">{{$budget->LEAVE_YEAR_ID}}</option>
                            @endif
                       @endforeach 
                    </select>
                     </span>
                      </div>
           
                 <div class="col-md-1">
                 <span>
                 <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ค้นหา</button>
                 </span>
                 </div>


                  </div>
             </form>
             <div class="table-responsive">

             <table class="gwt-table table-striped table-hover table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">วันที่</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ประเภท</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">จำนวนรับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">จำนวนจ่าย</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รายรับสุทธิ</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">พิมพ์</th> 
                        </tr >
                    </thead>
                    <tbody>  

                    
                    <?php $number = 0; ?>
                                @foreach ($infosalarys as $infosalary)
                                <?php $number++; 
                              
                                $totalreceive =  DB::table('salary_all_receive')->where('SALARYALL_ID','=',$infosalary->SALARYALL_ID)->sum('SALARYALL_RECEIVE_AMOUNT');          
                                
                                $totalpay =  DB::table('salary_all_pay')->where('SALARYALL_ID','=',$infosalary->SALARYALL_ID)->sum('SALARYALL_PAY_AMOUNT');               
                                
                                ?>
                               
                    <tr height="20" onclick="salarydetail({{$infosalary->SALARYALL_ID}})">
                                        <td  class="text-font  text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                         {{$number}}
                                        </td >
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                           
                                        
                                        {{$infosalary->SALARYALL_HEAD_DAY_ID}}  {{MonthThai($infosalary->SALARYALL_MONTH_ID)}} 
                                                    @if($infosalary->SALARYALL_MONTH_ID > 9)
                                                        {{$infosalary->SALARYALL_HEAD_YEAR_ID -1}}
                                                    @else
                                                        {{$infosalary->SALARYALL_HEAD_YEAR_ID}}
                                                    @endif
                                                    
                                        ปีงบประมาณ {{$infosalary->SALARYALL_HEAD_YEAR_ID}}
                                           
                                        </td class="text-font">

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                          @if($infosalary->SALARYALL_HEAD_TYPE == 'salary')
                                                เงินเดือน
                                          @else
                                                ค่าตอบแทน
                                          @endif 
                                        
                                         
                                              
                                        </td>
                                    
                                        <td class="text-font text-pedding"  style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">
                                            {{number_format( $totalreceive,2)}}
                                        </td>
                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">
                                            {{number_format( $totalpay,2)}}
                                        </td>
                                        <td class="text-font text-pedding"  style="border-color:#F0FFFF;text-align: right;border: 1px solid black;">
                                            {{number_format($infosalary->SALARYALL_TOTAL,2)}}
                                        </td>

                                        <td class="text-font text-pedding"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                        <a href="{{ url('manager_compensation/pdfcertificate/export_pdfslip/'.$infosalary->SALARYALL_ID)}}" class="btn btn-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                    </tr>
                 
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
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


function salarydetail(id){

   // alert('test');

   $.ajax({
                   url:"{{route('compensation.salarydetail')}}",
                   method:"GET",
                   data:{id:id},
                   success:function(result){
                      $('.detail').html(result);
                      $('#detailsalary').modal('show');
                      //alert("Hello! I am an alert box!!");
                   }
                   
           })


}
    
  
</script>



@endsection