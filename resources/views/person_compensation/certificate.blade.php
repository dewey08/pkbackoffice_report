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
                                            
    $yearbudget = date("Y");
                                                                                

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
                                    <a href="{{ url('person_compensation/cominfosalary/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                   ข้อมูลเงินเดือน
                                    </a>
                                    </div>
                                <div>&nbsp;</div>
                                
                                <div>
                                    <a href="{{ url('person_compensation/certificate/'.$id_user)}}" class="btn btn-info loadscreen" >  
                                    <span class="nav-main-link-name">ขอใบรับรอง</span>
                                    </a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                    <a href="{{ url('person_compensation/salaryslip/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                    สลิปเงินเดือน
                                    </a>
                                </div>
                                <div>&nbsp;</div>  <div>
                                    <a href="{{ url('person_compensation/borrow/'.$id_user)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                    ยืม-คืน
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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนขอใบรับรองเงินเดือน</B></h3>
            <a href="{{ url('person_compensation/certificate_add/'.$id_user)}}"   class="btn btn-info" >ขอใบรับรองเงินเดือน</a>
        </div>
        <div class="block-content block-content-full">
        <form action="{{ route('compensation.searchcertificate') }}" method="post">
                @csrf

                
                <input type="hidden" name="userid" id="userid" value="{{$id_user}}">
                
                <div class="row">
                <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
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
                                    @foreach ($info_sendstatuss as $info_sendstatus)
                                        @if($info_sendstatus->STATUS_NAME == $status_check)
                                            <option value="{{ $info_sendstatus->STATUS_NAME }}" selected>{{ $info_sendstatus->STATUS_NAME_TH}}</option>
                                         @else
                                            <option value="{{ $info_sendstatus->STATUS_NAME  }}">{{ $info_sendstatus->STATUS_NAME_TH}}</option>
                                        @endif
                                    @endforeach
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
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">เลขที่</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">ปีงบประมาณ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ขอ</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เหตุผลการขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="17%">หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="12%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>  

                           <?php $number = 0; ?>
                                @foreach ($inforSalarycertificates as $inforSalarycertificate)
                                <?php $number++; ?>
                               
                                    <tr height="40">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>                                      
                                        @if($inforSalarycertificate->CER_STATUS== 'REQUEST')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-warning" >ร้องขอ</span></td>
                                        @elseif($inforSalarycertificate->CER_STATUS == 'SUCCESS')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-success" >อนุมัติ</span></td>
                                        @elseif($inforSalarycertificate->CER_STATUS == 'NOTSUCCESS')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >ไม่อนุมัติ</span></td>
                                        @elseif($inforSalarycertificate->CER_STATUS == 'CANCEL')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >ยกเลิก</span></td>
                                        @elseif($inforSalarycertificate->CER_STATUS == 'DOCSUCCESS')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-info" >เอกสารเรียบร้อย</span></td>
                                        @else
                                        <td class="text-font" align="center" ></td>
                                        @endif
                                        
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforSalarycertificate->CER_NUMBER}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ $inforSalarycertificate->CER_YEAR}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($inforSalarycertificate->CER_DATE)}}</td>
                                        
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforSalarycertificate->CER_COMMENT}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforSalarycertificate->CER_HR_DEP_SUB_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforSalarycertificate->CER_HR_PERSON_NAME}}</td>

                                            

                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                        ทำรายการ
                                                    </button>
                                                    <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $inforSalarycertificate -> CER_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">รายละเอียด</a>
                                                        <a class="dropdown-item"  href="{{ url('person_compensation/certificate_edit/'.$inforSalarycertificate -> CER_ID.'/'.$inforperson -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                        <a class="dropdown-item"  href="#cancel_modal{{ $inforSalarycertificate -> CER_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แจ้งยกเลิก</a>
                                                       
                                                    </div>
                                            </div>
                                        </td>  
                                    </tr>  

                                    <div id="cancel_modal{{ $inforSalarycertificate -> CER_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="row">
                                                        <div>&nbsp;&nbsp;ใบรับรองเงินเดือนเลขที่ {{ $inforSalarycertificate -> CER_NUMBER }} &nbsp;&nbsp;&nbsp;&nbsp;</div>
                                                        
                                                        </div>
                                                    </div>
                                                <div class="modal-body">
                                                <form  method="post" action="{{ route('compensation.certificate_cancel') }}" enctype="multipart/form-data"> 
                                                    @csrf
                                                    <input type="hidden"  name="ID" value="{{ $inforSalarycertificate -> CER_ID}}"/>
                                                    <input type="hidden" name="iduser" id="iduser" value="{{$id_user}}">
                                                                                <div class="row ">
                                                <div class="col-sm-2">
                                                        <label>เลขทะเบียน :</label>
                                                    </div> 
                                                    <div class="col-lg-2"> 
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_NUMBER }}</h1>       
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <label>ลงวันที่ต้องการ :</label>
                                                    </div> 
                                                    <div class="col-lg-2"> 
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalarycertificate -> CER_DATE) }}</h1>      
                                                        </div>
                                                    <div class="col-sm-2 text-right">
                                                        <label>ปีงบประมาณ :</label>
                                                    </div>         
                                                    <div class="col-lg-2"> 
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_YEAR }}</h1>        
                                                    
                                                    </div>
                                                </div>

                                                <div class="row ">
                                                    <div class="col-sm-2">
                                                        <label>ข้าพเจ้า :</label>
                                                    </div> 
                                                    <div class="col-sm-2">

                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_MY_HR_PERSON_NAME }}</h1>  
                                                    </div> 
                                                    <div class="col-sm-2 text-right">
                                                        <label>ตำแหน่ง :</label>
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_POSITION_IN_WORK }}</h1>  
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    </div> 
                                                </div>

                                                <div class="row ">
                                                    <div class="col-sm-2">
                                                        <label>ระดับ :</label>
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_LEVEL_NAME }}</h1>  
                                                        </div> 
                                                    <div class="col-sm-2 text-right">
                                                        <label>รับเงินเดือน :</label>
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_SALARY }}</h1>  
                                                    </div> 
                                                    <div class="col-sm-2 text-right">
                                                        <label>เงินประจำตำแหน่ง :</label>
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_MONEY_POSITION }}</h1>  
                                                        
                                                        </div> 
                                                </div>

                                                <div class="row ">
                                                    <div class="col-sm-2">
                                                        <label>รับราชการเมื่อ :</label>
                                                    </div> 
                                                    <div class="col-sm-2">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalarycertificate -> CER_HR_STARTWORK_DATE) }}</h1>
                                                    
                                                    </div> 
                                                    <div class="col-sm-2 text-right">
                                                        <label>วัตถุประสงค์เพื่อ :</label>
                                                    </div> 
                                                    <div class="col-sm-6">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_BORROW_MONEY }}</h1>
                                                    
                                                    </div> 
                                                </div>

                                                <div class="row ">
                                                    <div class="col-sm-2">
                                                        <label>ผู้รายงาน :</label>
                                                    </div> 
                                                    <div class="col-lg-2">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_PERSON_NAME }}</h1>
                                                
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <label>หน่วยงานผู้เบิก :</label>
                                                    </div>
                                                    <div class="col-lg-3">       
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_DEP_SUB_SUB_NAME }}</h1>
                                                    </div>       
                                                
                                                </div>
                                                
                                                <div class="row ">
                                                    <div class="col-sm-2">
                                                        <label>เหตุผล :</label>
                                                    </div> 
                                                    <div class="col-sm-10">
                                                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"> {{ $inforSalarycertificate -> CER_COMMENT }}</h1>
                                                    
                                                    </div> 
                                                </div>

                                                <div class="modal-footer">
                                            <div align="right">                    
                                                <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >แจ้งยกเลิก</button>
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
                                                </div>
                                        </div>
                                    </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
        
                                            














<div id="detail_modal{{ $inforSalarycertificate -> CER_ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div>&nbsp;&nbsp;ใบรับรองเงินเดือนเลขที่ {{ $inforSalarycertificate -> CER_NUMBER }} &nbsp;&nbsp;&nbsp;&nbsp;</div>
                      
                    </div>
                </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-sm-2">
                            <label>เลขทะเบียน :</label>
                        </div> 
                        <div class="col-lg-2"> 
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_NUMBER }}</h1>       
                         </div>
                        <div class="col-sm-2 text-right">
                            <label>ลงวันที่ต้องการ :</label>
                        </div> 
                        <div class="col-lg-2"> 
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalarycertificate -> CER_DATE) }}</h1>      
                            </div>
                        <div class="col-sm-2 text-right">
                            <label>ปีงบประมาณ :</label>
                        </div>         
                        <div class="col-lg-2"> 
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_YEAR }}</h1>        
                        
                        </div>
                    </div>


                <div class="row ">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">

                       <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_MY_HR_PERSON_NAME }}</h1>  
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_POSITION_IN_WORK }}</h1>  
                    </div> 
                    <div class="col-sm-2">
                    </div> 
                </div>

                <div class="row ">
                    <div class="col-sm-2">
                        <label>ระดับ :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_LEVEL_NAME }}</h1>  
                        </div> 
                    <div class="col-sm-2 text-right">
                        <label>รับเงินเดือน :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_SALARY }}</h1>  
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>เงินประจำตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_MONEY_POSITION }}</h1>  
                        
                         </div> 
                </div>


                <div class="row ">
                    <div class="col-sm-2">
                        <label>รับราชการเมื่อ :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalarycertificate -> CER_HR_STARTWORK_DATE) }}</h1>
                     
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>วัตถุประสงค์เพื่อ :</label>
                    </div> 
                    <div class="col-sm-6">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_BORROW_MONEY }}</h1>
                     
                    </div> 
                </div>




                <div class="row ">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_PERSON_NAME }}</h1>
                   
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-3">       
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_DEP_SUB_SUB_NAME }}</h1>
                    </div>       
                   
                </div>
                
                <div class="row ">
                    <div class="col-sm-2">
                        <label>เหตุผล :</label>
                    </div> 
                    <div class="col-sm-10">
                    <h1 style="font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"> {{ $inforSalarycertificate -> CER_COMMENT }}</h1>
                       
                    </div> 
                </div>
            <br> 



    <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforperson ->ID }} ">
      <input type="hidden" name = "CER_ID"  id="CER_ID" value="{{ $inforSalarycertificate -> CER_ID }}">

            </div>
            <div class="modal-footer">
                <div align="right">
                    <button type="button" class="btn btn-sm btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
                </div>
            </div>
        </form>
        </body>
    </div>
</div>






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


<script>

$('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });



   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });

    

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection