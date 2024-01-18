@extends('layouts.account')   
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
<?php
    function RemoveDateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }
    function Removeformate($strDate)
    {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    
    return $strDay."/".$strMonth."/".$strYear;
    }
    
    function Removeformatetime($strtime)
    {
    $H = substr($strtime,0,5);
    return $H;
    }  



?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คำนวณค่าเสื่อมโดยรวม</B></h3>
                 
            </div>
            <div class="block-content block-content-full">
            <form action="{{ route('maccount.searchdecline') }}" method="post" >
                    @csrf 
            <div class="row" >
        
           
            <div class="col-md-2">
                &nbsp;ประจำปีงบประมาณ : &nbsp;
            </div>
            <div class="col-md-2">
                <span>
                    <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                     
                    @foreach ($budgets as $budget)
                                @if($budget->YEAR_ID== $year_max)
                        <option value="{{ $budget->YEAR_ID  }}" selected>{{ $budget->YEAR_ID}}</option>
                                @else
                        <option value="{{ $budget->YEAR_ID  }}">{{ $budget->YEAR_ID}}</option>
                                @endif                                 
                            @endforeach  
                    </select>
                </span>

                </div>

                <div class="col-md-1">
                &nbsp;เดือน : &nbsp;
            </div>
            <div class="col-md-2">
                <span>
                    <select name="SEND_MONTH" id="SEND_MONTH" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                     
                    @if($m_budget== '1')<option value="1" selected>มกราคม</option> @else<option value="1" >มกราคม</option>@endif
                    @if($m_budget== '2')<option value="2" selected>กุมภาพันธ์</option> @else<option value="2" >กุมภาพันธ์</option>@endif
                    @if($m_budget== '3')<option value="3" selected>มีนาคม</option> @else<option value="3" >มีนาคม</option>@endif
                    @if($m_budget== '4')<option value="4" selected>เมษายน</option> @else<option value="4" >เมษายน</option>@endif
                    @if($m_budget== '5')<option value="5" selected>พฤษภาคม</option> @else<option value="5" >พฤษภาคม</option>@endif
                    @if($m_budget== '6')<option value="6" selected>มิถุนายน</option> @else<option value="6" >มิถุนายน</option>@endif
                    @if($m_budget== '7')<option value="7" selected>กรกฎาคม</option> @else<option value="7" >กรกฎาคม</option>@endif
                    @if($m_budget== '8')<option value="8" selected>สิงหาคม</option> @else<option value="8" >สิงหาคม</option>@endif
                    @if($m_budget== '9')<option value="9" selected>กันยายน</option> @else<option value="9" >กันยายน</option>@endif
                    @if($m_budget== '10')<option value="10" selected>ตุลาคม</option> @else<option value="10" >ตุลาคม</option>@endif
                    @if($m_budget== '11')<option value="11" selected>พฤศจิกายน</option> @else<option value="11" >พฤศจิกายน</option>@endif
                    @if($m_budget== '12')<option value="12" selected>ธันวาคม</option> @else<option value="12" >ธันวาคม</option>@endif
                     
                            
                    </select>
                </span>

                </div>  
                <div class="col-md-1">
                    <span>
                    <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ค้นหา</button>
                    </span> 
                </div>  


                </div> 
                <br>
         

            <div align="left"><H5  style="font-family: 'Kanit', sans-serif;">อาคารและสิ่งก่อสร้าง</H5></div>
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" >รหัสสินทรัพย์</th>
                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">วัน/เดือน/ปี ที่ซื้อมา</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" >รายการทรัพย์สิน</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนทรัพย์สิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ค่าเสือมยกมา</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนสุทธิทรัพย์สิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >อัตรา</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">จำนวนวัน</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคาเดือนนี้</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคา สะสมยกไป</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ราคาทุนสุทธิทรัพย์สิน</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach ($depbuildings as $depbuilding)
                                <tr>
                                <td class="text-font text-pedding" >{{ $depbuilding->SUP_FSN }}</td>
                                <td class="text-font " align="center">{{ DateThai($depbuilding->BUILD_CREATE) }}</td>
                                <td class="text-font text-pedding" >{{ $depbuilding->BUILD_NAME }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($depbuilding->DEP_BUILDING_PRICE,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($depbuilding->DEP_BUILDING_FORWARD,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($depbuilding->DEP_BUILDING_PRICE - $depbuilding->DEP_BUILDING_FORWARD,2) }}</td>
                                <td class="text-font " align="center">{{ $depbuilding->DECLINE_PERSEN }}</td> 
                                <td class="text-font " align="center">{{cal_days_in_month(CAL_GREGORIAN,$depbuilding->DEP_BUILDING_MONTH,$depbuilding->DEP_BUILDING_YEAR-543)}}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($depbuilding->DEP_BUILDING_DEPRECIATE,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($depbuilding->DEP_BUILDING_CUMULATIVE,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($depbuilding->DEP_BUILDING_VALUE,2) }}</td>

                                </tr>


                                @endforeach   
                      </tbody>
                    </table>

                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                    <thead style="background-color: #CCCCFF;">
                        <tr height="40">
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" >รายการอาคารและสิ่งก่อสร้าง</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนทรัพย์สิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนสุทธิทรัพย์สิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคาเดือนนี้</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคา สะสมยกไป</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ราคาทุนสุทธิทรัพย์สิน</th>
                                </tr>
                                </thead>
                                <tbody >
                               
                                <tr>
                                <td class="text-font text-pedding" >รวมมูลค่าอาคารและสิ่งก่อสร้าง</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumbuilding1,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumbuilding2,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumbuilding3,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumbuilding4,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumbuilding5,2) }}</td>
                            


                                </tr>


                               
                      </tbody>
                    </table>


                    <br>
         
         <div align="left"><H5  style="font-family: 'Kanit', sans-serif;">ครุภัณฑ์</H5></div>
             <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                 <thead style="background-color: #FFEBCD;">
                     <tr height="40">
                                   <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" >รหัสสินทรัพย์</th>
                                    
                                    <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">วัน/เดือน/ปี ที่่ซื้อมา</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" >รายการทรัพย์สิน</th>    
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนทรัพย์สิน</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ค่าเสือมยกมา</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนสุทธิทรัพย์สิน</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >อัตรา</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">จำนวนวัน</th> 
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคาเดือนนี้</th> 
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคา สะสมยกไป</th> 
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ราคาทุนสุทธิทรัพย์สิน</th>
                             </tr>
                             </thead>
                             <tbody >
                             @foreach ($depreciates as $depreciate)
                             <tr>
                             <td class="text-font text-pedding" >{{ $depreciate->ARTICLE_NUM }}</td>
                             <td class="text-font " align="center">{{ DateThai($depreciate->RECEIVE_DATE) }}</td>
                             <td class="text-font text-pedding" >{{ $depreciate->ARTICLE_NAME }}</td>
                             <td class="text-font text-pedding" align="right">{{ number_format($depreciate->DEP_PRICE,2) }}</td>
                             <td class="text-font text-pedding" align="right">{{ number_format($depreciate->DEP_FORWARD,2) }}</td>
                             <td class="text-font text-pedding" align="right">{{ number_format($depreciate->DEP_PRICE - $depbuilding->DEP_FORWARD,2) }}</td>
                             <td class="text-font " align="center">{{ $depreciate->DECLINE_PERSEN }}</td> 
                             <td class="text-font " align="center">{{cal_days_in_month(CAL_GREGORIAN,$depreciate->DEP_MONTH,$depreciate->DEP_YEAR-543)}}</td>
                             <td class="text-font text-pedding" align="right">{{ number_format($depreciate->DEP_DEPRECIATE,2) }}</td>
                             <td class="text-font text-pedding" align="right">{{ number_format($depreciate->DEP_CUMULATIVE,2) }}</td>
                             <td class="text-font text-pedding" align="right">{{ number_format($depreciate->DEP_VALUE,2) }}</td>

                             </tr>


                             @endforeach   
                   </tbody>
                 </table>
                 <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                    <thead style="background-color: #CCCCFF;">
                        <tr height="40">
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;" >รายการครุภัณฑ์</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนทรัพย์สิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;"  >ราคาทุนสุทธิทรัพย์สิน</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคาเดือนนี้</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ค่าเสื่อมราคา สะสมยกไป</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;">ราคาทุนสุทธิทรัพย์สิน</th>
                                </tr>
                                </thead>
                                <tbody >
                               
                                <tr>
                                <td class="text-font text-pedding" >รวมมูลค่าครุภัณฑ์</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumasset1,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumasset2,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumasset3,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumasset4,2) }}</td>
                                <td class="text-font text-pedding" align="right">{{ number_format($sumasset5,2) }}</td>
                            
                               


                                </tr>


                               
                      </tbody>
                    </table>
                 
                    
                                

  
  
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
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection