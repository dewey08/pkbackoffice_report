@extends('layouts.backend')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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
            font-size: 10px;
            font-size: 1.0rem;
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

@section('content')
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
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



use App\Http\Controllers\LeaveController;
$checkapp = LeaveController::checkapp($user_id);
$checkver = LeaveController::checkver($user_id);
$checkallow = LeaveController::checkallow($user_id);

$countapp = LeaveController::countapp($user_id);
$countver = LeaveController::countver($user_id);
$countallow = LeaveController::countallow($user_id);

?>
<?php
 
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');    
?>   

           
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                        <div>
                                                <a href="{{ url('person_leave/personleaveindex/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">
                                                 
                                                    <span class="nav-main-link-name"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</span>                                        
                                                </a> 
                                            </div>
                                        <div>&nbsp;</div> 
                                        <div>
                                            <a href="{{ url('person_leave/personleavecalendar/'.$inforpersonuserid -> ID)}}"
                                                class="btn btn-hero-sm btn-hero loadscreen"
                                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                                    class="fas fa-calendar-day mr-2"></i> ปฏิทิน</a>
                                        </div>
                                        <div>&nbsp;</div>
                                <div >
                                <a href="{{ url('person_leave/personleavetype/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-plus mr-1"></i> เพิ่มข้อมูลการลา</a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_leave/personleaveinfo/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero-info loadscreen" ><i class="fas fa-calendar-day mr-2"></i>ข้อมูลการลา</a> 
                                </div>
                                <div>&nbsp;</div>
                              
                                @if($checkapp != 0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfoapp/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-clipboard-check mr-2"></i>เห็นชอบ 
                                @if($countapp!=0)
                                    <span class="badge badge-light" >{{$countapp}}</span>
                                @endif
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkver != 0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfover/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-clipboard-check mr-2"></i>ตรวจสอบ 
                                @if($countver!=0)
                                    <span class="badge badge-light" >{{$countver}}</span>
                                @endif
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkallow!=0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfolastapp/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i class="fas fa-clipboard-check mr-2"></i>อนุมัติ 
                                @if($countallow!=0)
                                    <span class="badge badge-light" >{{$countallow}}</span>
                                @endif
                                </a> 
                                </div>           
                                <div>&nbsp;</div>
                                @endif


                                <div>
                                    <a href="{{ url('person_leave/personleaveinfoaccept/'.$inforpersonuserid -> ID)}}"
                                        class="btn btn-hero-sm btn-hero loadscreen"
                                        style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;"><i
                                            class="fas fa-clipboard-check mr-2"></i>รับมอบงาน
                                        {{-- @if($countallow!=0)
                                        <span class="badge badge-light">{{$countallow}}</span>
                                        @endif --}}
                                    </a>
                                </div>
                                <div>&nbsp;</div>
                                
                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content" style="width: 95%;">

                <!-- Dynamic Table Simple -->
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                           
                                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลการลา</B></h3>
                                <a href="{{ url('person_leave/excel_personleaveinfo/'.$inforpersonuserid->ID)}}"  class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>Export Excel</a>

                              
                            </div> 
                        
            <div class="block-content block-content-full">
                <form action="{{ route('leave.searchinfo',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
                    @csrf
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
                            <div class="col-sm-0.5">
                                &nbsp;สถานะ &nbsp;
                            </div>                                
                            <div class="col-sm-2">
                                <span>                                
                                    <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--ทั้งหมด--</option>
                                            @foreach ($infostatuss as $infostatus)
                                                @if($infostatus->STATUS_CODE == $status_check)
                                                    <option value="{{ $infostatus->STATUS_CODE  }}" selected>{{ $infostatus->STATUS_NAME}}</option>
                                                @else                                                 
                                                    <option value="{{ $infostatus->STATUS_CODE  }}">{{ $infostatus->STATUS_NAME}}</option>                                
                                                @endif
                                            @endforeach 
                                    </select>
                                </span>
                            </div>                   
                            <div class="col-sm-0.5">
                                &nbsp;คำค้นหา &nbsp;
                            </div>                            
                            <div class="col-sm-2">
                                <span>                            
                                    <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                                </span>
                            </div>     
                            <div class="col-sm-30">
                            &nbsp;
                        </div>                   
                            <div class="col-sm-1.5">
                                <span>
                                    <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                                </span> 
                            </div>              
                        </div>  
                    </form>     
                    <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : ผู้รับมอบงานรับงาน&nbsp;&nbsp;  
                    <a  class="btn btn-info btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : หัวหน้างานเห็นชอบ&nbsp;&nbsp;
                    <a  class="btn btn-success btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : หัวหน้ากลุ่มเห็นชอบ&nbsp;&nbsp;

             <div class="table-responsive"> 
                  
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                            <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                    
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%" >ปีงบ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" width="12%">สถานะเห็นชอบ</th>

                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"width="18%" >ประเภทการลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เนื่องจาก</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันเริ่มลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ลาถึงวันที่</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">จำนวนวันลา</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%" >คำสั่ง</th> 
                                        
                                    </tr >
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforleaves as $inforleave)
                                <?php $number++; 
                                 $status =  $inforleave -> STATUS_CODE;

                                 if( $status === 'Disallow' || $status === 'Cancel'){
                                    $statuscol =  "badge badge-danger";

                                }else if($status === 'Pending' || $status === 'Approve'|| $status === 'Appcancel'){
                                   $statuscol =  "badge badge-warning";

                                }else if($status === 'Verify'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'Allow'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }

                                        if($status == "Allow" && date('Y-m-d') > $inforleave->LEAVE_DATE_BEGIN){
                                            $cheackapp = '1' ;
                                        }else{
                                            $cheackapp = '0';
                                        }
                                
                                ?> 
                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{ $number }}</td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%"> 
                                            <span class="{{$statuscol}}">{{ $inforleave -> STATUS_NAME }}</span>
                                        </td>
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" class="d-none d-sm-table-cell" width="7%">
                                        {{ $inforleave -> LEAVE_YEAR_ID }}
                                        </td>


                                        <td  class="text-font" align="center" class="d-none d-sm-table-cell">

                                            @if($inforleave->LEAVE_APP_SEND == 'APP')
                                            <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                            @else   
                                            -
                                            @endif
                                            
                                            @if($inforleave->LEAVE_APP_H1 == 'APP')
                                            <a  class="btn btn-info btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                            @else   
                                            -
                                            @endif
                                            
                                       
                                             @if($inforleave->LEAVE_APP_H2 == 'APP')
                                             <a  class="btn btn-success btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                             @else   
                                             -
                                             @endif
                                           
                                         </td>

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                                        {{ $inforleave -> LEAVE_TYPE_NAME }}
                                        </td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforleave -> LEAVE_BECAUSE }}</td>
                                        
                                     
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" class="d-none d-sm-table-cell" width="10%">
                                            {{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}
                                        </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" class="d-none d-sm-table-cell" width="10%">
                                            {{ DateThai($inforleave -> LEAVE_DATE_END) }}
                                        </td>
                                        
                                        @if($inforleave->WORK_DO == 0.5)
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">ครึ่งวัน</td>
                                        @else
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">{{ number_format($inforleave->WORK_DO,1) }}</td>
                                        @endif

                                        

                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                            <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="#detail_modal{{ $inforleave -> ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด</a>
                                                   @if($inforleave -> LEAVE_TYPE_ID == 1 )
                                                    <a class="dropdown-item"  href="{{ url('manager_leave/leavecertificate/'.$inforleave -> ID.'/'.$inforpersonuserid->ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><i class="fa fa-file text-info mr-2"></i>แนบใบรับรองแพทย์</a>  
                                                   @endif
                                                    @if($status== "Pending")
                                                    <a class="dropdown-item"  href="{{ url('person_leave/editpersonleavecalldate/'.$inforleave -> ID.'/'.$inforleave -> LEAVE_PERSON_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a> 

                                                     @elseif($inforleave -> LEAVE_TYPE_ID == 1 && ($status== "Allow" || $status== "Verify"))
                                                     <a class="dropdown-item"  href="{{ url('person_leave/personleavesick/export_pdfsick/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank" ><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาป่วย</a>  


                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 4 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"   href="{{ url('person_leave/personleaverest/export_pdfrest/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาพักผ่อน</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 3 &&  ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavework/export_pdfwork/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลากิจ</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 2 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavespawn/export_pdfspawn/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาคลอด</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 6 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/give/pdfgive/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาช่วยคลอด</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 8 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/train/pdftrain/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาไปศึกษา ฝึกอบรม</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 5 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/ordain/pdfordain/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาอุปสมบท</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 10 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavefollow/export_pdffollow/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาติดตามคู่สมรส</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 7 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavesoldier/export_pdfsoldier/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาเกณฑ์ทหาร</a>
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 12 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleaveout/export_pdfout/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาออก</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 13 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleaveout/export_pdfsicklow/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบลาป่วยตามกฎหมาย</a> 
                                                    
                                                   @else
                                      
                
                                                    @endif
                                                    @if($status== "Cancel" || $status== "Appcancel")
                                                    <a class="dropdown-item"  href="{{ url('person_leave/cancelleave/pdfcancelleave/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank"><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบขอยกเลิกการลา</a>  
                                                  
                                                    @endif

                                                    
                                                    @if($status !== "Cancel" && $status !==  "Appcancel" && $status !== 'Recancel' && $cheackapp !== '1' )
                                                    <a class="dropdown-item"  href="{{ url('person_leave/cancelpersonleavecalldate/'.$inforleave -> ID.'/'.$inforleave -> LEAVE_PERSON_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-window-close text-danger mr-2"></i>แจ้งยกเลิก</a>  
                                                    @endif
                                                    
                                                     
                                                     
                                                    
                                                   
                                                  
                                                </div>
                    </div>
                     </td>                    
                                        
                                        
                                    
                                    </tr>

                                    
                                    
<div id="detail_modal{{ $inforleave -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">รายละเอียดการลา {{ $inforleave -> ID }}</h2>
        </div>
        <div class="modal-body">

     <div class="row">
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ปีงบประมาณ :</label>
           </div>                               
       </div> 
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_YEAR_ID }}</h1>
           </div>                               
       </div>
       
       <div class="col-sm-2">
           <div class="form-group">
           <label >ชื่อผู้ลา  :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_PERSON_FULLNAME }}</h1>
           </div>                               
       </div>  
      
       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >เหตุผลการลา :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_BECAUSE }}</h1>
           </div>                               
       </div>    
       <div class="col-sm-2">
           <div class="form-group">
           <label >สถานที่ไป :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LOCATION_NAME }} </h1>
           </div>                               
       </div>
       </div>

       
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label>มอบหมายงาน :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_WORK_SEND}}</h1>
           </div>                               
       </div>  
       <div class="col-sm-2">
           <div class="form-group">
           <label>ลาเต็มวัน/ครึ่งวัน :</label>
           </div>                               
       </div>  
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">
           @if($inforleave -> DAY_TYPE_ID == 3)
           ครึ่งวัน(บ่าย)
           @elseif($inforleave -> DAY_TYPE_ID == 2)
           ครึ่งวัน(เช้า)
           @else
           เติมวัน
           @endif   
           
           </h1>
           </div>                               
       </div>    
      </div>
    
      
     
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันเริ่มลา :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >สิ้นสุดวันลา :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforleave -> LEAVE_DATE_END) }}</h1>
           </div>                               
       </div>   
 
       </div>
     
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label > เบอร์ติดต่อ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_CONTACT_PHONE }}</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label > ระหว่างลาติดต่อ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave -> LEAVE_CONTACT }}</h1>
           </div>                               
       </div> 

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >รวมวันลา :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_ALL,1) }} วัน</h1>
           
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันทำการ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> WORK_DO,1) }} วัน</h1>
           </div>                               
       </div>   
 
       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันหยุดเสาร์ - อาทิตย์ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_HOLIDAY) }} วัน</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันหยุดนักขัตฤกษ์ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_SETSUN) }} วัน</h1>
           </div>                               
       </div>   
 
       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label >หมายเหตุ :</label>
           </div>                               
       </div>
       <div class="col-sm-10">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_COMMENT_BY}}</h1>
           </div>                               
       </div> 
     
 
       </div>


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-sign-out-alt mr-2"></i>ปิดหน้าต่าง</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
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
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection