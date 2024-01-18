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
     function MonthThai($strmonth)
   {
     $strMonth= $strmonth;
   
   
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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลเงินเดือนบุคคล</B></h3>
             
                <a href="{{ url('manager_compensation/infosalaryslip')}}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
            </div>
            <div class="block-content block-content-full">

            <div class="block-header block-header-default" style="text-align: left;"> 
                        <img id="image_upload_preview" src="data:image/png;base64,{{ chunk_split(base64_encode($inforpersonuser->HR_IMAGE)) }}" height="100px" width="100px"> &nbsp;
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;  font-size: 15px;" ><B>
                            {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}   </B> <br><B>เลขประจำตัว</B> {{ $inforpersonuser -> HR_CID }}     <B>ตำแหน่ง</B> {{ $inforpersonuser -> POSITION_IN_WORK }}     <B>เงินเดือน</B> {{ number_format($inforpersonuser -> HR_SALARY,2) }}
                            <br>   <B>กลุ่มงาน</B> {{ $inforpersonuser -> HR_DEPARTMENT_NAME }} <B>ฝ่ายแผนก</B> {{ $inforpersonuser -> HR_DEPARTMENT_SUB_NAME }}              <B>หน่วยงาน</B> {{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }} 

                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                                       
                        <form action="{{ route('mcompensation.infopersonsalarydetail_search',['iduser' =>  $inforperson->ID]) }}" method="post"> 
                        @csrf

             <div class="row">

                 <div class="col-md-0.5" style="  font-size: 13px;";>
                     &nbsp;ปี &nbsp;
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
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">วันที่</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ประเภท</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">จำนวนรับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">จำนวนจ่าย</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">รายรับสุทธิ</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="7%">พิมพ์</th> 
                        </tr >
                    </thead>
                    <tbody>  

                    
                    <?php $number = 0; ?>
                                @foreach ($infosalarys as $infosalary)
                                <?php $number++; 
                              
                                $totalreceive =  DB::table('salary_all_receive')
                                ->leftjoin('salary_all','salary_all.SALARYALL_ID','=','salary_all_receive.SALARYALL_ID')
                                ->where('salary_all_receive.SALARYALL_RECEIVE_TYPE','=',$infosalary->SALARYALL_HEAD_TYPE)
                                ->where('SALARYALL_PERSON_ID','=',$infosalary->SALARYALL_PERSON_ID)
                                ->where('salary_all_receive.SALARYALL_RECEIVE_DAY','=',$infosalary->SALARYALL_HEAD_DAY_ID)
                                ->where('salary_all_receive.SALARYALL_RECEIVE_MONTH','=',$infosalary->SALARYALL_HEAD_MONTH_ID)
                                ->where('salary_all_receive.SALARYALL_RECEIVE_YEAR','=',$infosalary->SALARYALL_HEAD_YEAR_ID)
                                ->sum('SALARYALL_RECEIVE_AMOUNT');               
                                
                  

                                $totalpay =  DB::table('salary_all_pay')
                                ->leftjoin('salary_all','salary_all.SALARYALL_ID','=','salary_all_pay.SALARYALL_ID')
                                ->where('salary_all_pay.SALARYALL_PAY_TYPE','=',$infosalary->SALARYALL_HEAD_TYPE)
                                ->where('SALARYALL_PERSON_ID','=',$infosalary->SALARYALL_PERSON_ID)
                                ->where('salary_all_pay.SALARYALL_PAY_DAY','=',$infosalary->SALARYALL_HEAD_DAY_ID)
                                ->where('salary_all_pay.SALARYALL_PAY_MONTH','=',$infosalary->SALARYALL_HEAD_MONTH_ID)
                                ->where('salary_all_pay.SALARYALL_PAY_YEAR','=',$infosalary->SALARYALL_HEAD_YEAR_ID)
                                ->sum('SALARYALL_PAY_AMOUNT');               
                                
                                ?>
                               
                    <tr height="20" onclick="salarydetail({{$infosalary->SALARYALL_ID}})">
                                        <td  class="text-font  text-pedding" style="text-align: center;">
                                         {{$number}}
                                        </td >
                                        <td class="text-font text-pedding">
                                        
                                        
                                        {{$infosalary->SALARYALL_HEAD_DAY_ID}}  {{MonthThai($infosalary->SALARYALL_MONTH_ID)}} {{$infosalary->SALARYALL_HEAD_YEAR_ID}}
                                        
                                           
                                        </td>
                                        <td class="text-font text-pedding">
                                          @if($infosalary->SALARYALL_HEAD_TYPE == 'salary')
                                                เงินเดือน
                                          @else
                                                ค่าตอบแทน
                                          @endif 
                                        
                                         
                                              
                                        </td>
                                    
                                        <td class="text-font text-pedding"  style="text-align: right;">
                                            {{number_format( $totalreceive,2)}}
                                        </td>
                                      
                                        <td class="text-font text-pedding"  style="text-align: right;">
                                            {{number_format( $totalpay,2)}}
                                        </td>
                                        <td class="text-font text-pedding"  style="text-align: right;">
                                            {{number_format($infosalary->SALARYALL_TOTAL,2)}}
                                        </td>
                                        <td class="text-font text-pedding"  style="text-align: center;">
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


@endsection