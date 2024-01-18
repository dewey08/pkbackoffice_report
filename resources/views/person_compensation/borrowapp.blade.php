@extends('layouts.backend')
    
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
    .form-control {
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



                                            
    $yearbudget = date("Y");
                                                 
          //echo  $yearbudget;                                 

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
                                <a href="{{ url('person_compensation/dashboard/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                        <a href="{{ url('person_compensation/cominfosalary/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">         
                                        ข้อมูลเงินเดือน
                                        </a>
                                    </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/certificate/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ขอใบรับรอง</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_compensation/salaryslip/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">สลิปเงินเดือน</a>
                                </div>
                                <div>&nbsp;</div>  <div>
                                <a href="{{ url('person_compensation/borrow/'.$id_user)}}" class="btn btn-info" >
                                <span class="nav-main-link-name">ยืม-คืน</span>
                                </a>
                                </div>
                                <div>&nbsp;</div>




                             

                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนยืม-คืน</B></h3>
            <a href="{{ url('person_compensation/borrow_add/'.$id_user)}}"   class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทำรายการยืม-คืน</a>
            &nbsp;<a href="{{ url('person_compensation/borrowapp/'.$id_user)}}"   class="btn btn-warning" >เห็นชอบ</a>
            &nbsp;<a href="{{ url('person_compensation/borrowlastapp/'.$id_user)}}"   class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ</a>
        </div>
        <div class="block-content block-content-full">
        <form action="" method="post">
                @csrf
                <div class="row">
                <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                                <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">2563</option>
                                          
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                        <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="" readonly>
                  
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="" readonly>
                 
                    </div>
                    </div>

                </div>
                    <div class="col-md-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                <option value="">--ทั้งหมด--</option>
                                  
                            </select>
                        </span>
                    </div>

                    <div class="col-md-0.5">
                        &nbsp;ค้นหา &nbsp;
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="">

                        </span>
                    </div>
                    <div class="col-md-30">
                        &nbsp;
                    </div>
                    <div class="col-md-1">
                        <span>
                            <button type="submit" class="btn btn-info" >ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>
        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="13%">เลขที่</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่ขอยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่คืน</th>
                           
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="29%">เหตุผลการขอยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>   

                       <?php $number = 0; ?>
                                @foreach ($inforSalaryborrows as $inforSalaryborrow)
                                <?php $number++; ?>
                               
                                    <tr height="40">
                                        <td class="text-font" align="center">{{$number}}</td>
  
                                      
                                          
                                        @if($inforSalaryborrow->BORROW_STATUS== 'REQUEST')
                                        <td  align="center"><span class="badge badge-warning" >ร้องขอ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'SUCCESS')
                                        <td  align="center"><span class="badge badge-success" >อนุมัติ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'NOTSUCCESS')
                                        <td  align="center"><span class="badge badge-danger" >ไม่อนุมัติ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'CANCEL')
                                        <td  align="center"><span class="badge badge-danger" >ยกเลิก</span></td>
                                        @else
                                        <td class="text-font" align="center" ></td>
                                        @endif
                                        <td class="text-font" style="text-align: center">{{ $inforSalaryborrow->BORROW_NUMBER}}</td>

                                        <td class="text-font" style="text-align: center">{{ DateThai($inforSalaryborrow->BORROW_DATE)}}</td>
                                        <td></td>
                                      
                                        <td class="text-font" > {{ $inforSalaryborrow->BORROW_COMMENT}}</td>                                       
                                        <td class="text-font" style="text-align: center">{{ $inforSalaryborrow->BORROW_HR_DEP_SUB_SUB_NAME}}</td>
                                        <td class="text-font" style="text-align: center">{{ $inforSalaryborrow->BORROW_HR_PERSON_NAME}}</td>
                                            

                                        <td align="center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $inforSalaryborrow -> BORROW_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                        <a class="dropdown-item"  href="{{ url('person_compensation/borrow_edit/'.$inforSalaryborrow -> BORROW_ID.'/'.$inforperson -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                        <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แจ้งยกเลิก</a>                                                          
                                                    
                                                    </div>
                                            </div>
                                        </td> 
                                    </tr> 

<div id="detail_modal{{ $inforSalaryborrow -> BORROW_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div>&nbsp;&nbsp;ใบยืม-คืน เลขที่ {{ $inforSalaryborrow -> BORROW_ID }} &nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <div>
                        <a href=""  class="btn btn-sm btn-info " >พิมพ์ใบ ยืม-คืน</a>
                        </div>

                    </div>
                </div>
            <div class="modal-body">

            <form  method="post" action="{{ route('compensation.borrow_update') }}" enctype="multipart/form-data"> 
                @csrf

                <div class="row push">
                    <div class="col-sm-2">
                        <label>เลขทะเบียน :</label>
                    </div> 
                    <div class="col-lg-3">       
                       
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_NUMBER }}</h1>         
                    </div>
                    <div class="col-sm-1 text-right">                    
                        <label>จังหวัด :</label>
                    </div> 
                    <div class="col-lg-2"> 
                       
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_PROVINCE }}</h1> 
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ปีงบประมาณ :</label>
                    </div>         
                    <div class="col-lg-2">  
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_YEAR }}</h1>       
                   
                    </div>
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ยื่นต่อ :</label>
                    </div> 
                    <div class="col-sm-3 text-left">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_LOCATION }}</h1>
                         
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label>วันที่ยืม :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_DATE }}</h1>       
                       
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>เวลา :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TIME }}</h1> 

                    </div> 
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">
                   
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;"> {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 

                    <input type="hidden" value=" {{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}"style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" >
                   
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforpersonuser -> HR_PERSON_TYPE_NAME }}</h1> 
                    
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>สังกัด :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AFFILIATION }}</h1> 
                         </div> 
                </div>

                <div class="row push">
                <div class="col-sm-2">
                        <label>ประเภทเงิน :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TYPE_MONEY }}</h1>        
                         
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ประสงค์ขอยืมเงินจาก :</label>
                    </div> 
                    <div class="col-sm-6">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_FUND }}</h1> 
                                          
                    </div> 
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>อ้างหนังสือราชการ :</label>
                    </div> 
                    <div class="col-sm-9">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_BOOK }}</h1> 
                       
                    </div>    
                                 
                    <div class="col-sm-1">                       
                      
                    </div> 
                </div>
                <div class="row push">
                    <div class="col-sm-2">
                        <label>อ้างบันทึกไปราชการ :</label>
                    </div> 
                    <div class="col-sm-9">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_GO }}</h1> 
                         </div>    
                                 
                    <div class="col-sm-1">                       
                      
                    </div> 
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>เพื่อใช้ในการ :</label>
                    </div> 
                    <div class="col-sm-10">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_COMMENT }}</h1> 
                        </div>  
                </div>

                <div class="row push">
                    <div class="col-sm-2 ">
                        <label>ระหว่างวันที่ :</label>
                    </div> 
                    <div class="col-lg-2">  
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_START_DATE }}</h1>       
                      </div>
                    <div class="col-sm-1 text-right">
                        <label>ถึง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_END_DATE }}</h1> 
                       </div> 
                    <div class="col-sm-1 text-right">
                        <label>ณ :</label>
                    </div> 
                    <div class="col-lg-4"> 
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AT_LOCATION }}</h1>        
                       </div>
                </div>

                <div class="row push">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>        
                     
                    
                    <input type="hidden" name="BORROW_HR_PERSON_ID" id="BORROW_HR_PERSON_ID" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{$inforperson -> ID}}">
                    <input type="hidden" name="BORROW_HR_PERSON_NAME" id="BORROW_HR_PERSON_NAME" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">                       
                        </select>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-3"> 
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}</h1>        
                            
                    
                    <input type="hidden" name="BORROW_HR_DEP_SUB_SUB_NAME" id="BORROW_HR_DEP_SUB_SUB_NAME" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="{{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}">                       
                    </div>       
                   
                </div>
            <br> 
            <div class="modal-footer">
                <div align="right">
                 
                        <a href="{{ url('person_compensation/salaryslip/'.$inforperson -> ID)  }}" class="btn btn-sm btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
                </div>
            </div>
        </form>  



                                    @endforeach   
                
                    </tbody>
                </table>
            </div>
        </div>
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
    
  
</script>



@endsection