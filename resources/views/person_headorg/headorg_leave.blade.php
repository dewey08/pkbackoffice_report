@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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

?>
<?php
  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
            }

            .text-pedding{
   padding-left:10px;
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

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลผู้ลาที่ผ่านการตรวจสอบ รออนุมัติ</B></h3>
<a href="#modal_allapp" data-toggle="modal" style="font-family: 'Kanit', sans-serif;" class="btn btn-success" >อนุมัติทั้งหมด</a>
</div>
<div class="block-content block-content-full">
            <form action="{{ route('horg.infoleavesearch') }}" method="post"> 
                @csrf
              
                    <div class="row">
                     
<div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                            <span>
                                <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
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


                     <div class="col-md-0.5">
                     &nbsp;คำค้นหา &nbsp;
                     </div>

                       <div class="col-md-2">
                       <span>

                       <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                     </span>
                      </div>
                      <div class="col-md-30">
                     &nbsp;
                     </div>
                      <div class="col-md-1">
                      <span>
                      <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;">ค้นหา</button>
                      </span>
                      </div>


                  </div>
             </form>
             <a  class="btn btn-info btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : หัวหน้างานเห็นชอบ&nbsp;&nbsp;
             <a  class="btn btn-success btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : หัวหน้ากลุ่มเห็นชอบ&nbsp;&nbsp;
             <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : ผู้รับมอบงานรับงาน&nbsp;&nbsp;  
               <div class="panel-body" style="overflow-x:auto;">
                           
                            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ปีงบ</th>

                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" width="12%" >สถานะเห็นชอบ</th>

                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%"> ชื่อผู้แจ้งลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%" >ตำแหน่ง</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%" >หน่วยงาน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%" >ประเภทการลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เหตุผลการลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">วันเริ่มลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">ลาถึงวันที่</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"width="8%">จำนวนวันลา</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"width="15%">ผู้รับมอบงาน</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"width="15%">ผู้ตรวจสอบ</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">อนุมัติ</th>


                                    </tr>
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

                                ?>
                                    <tr height="40">
                                        <td  class="text-font" align="center">{{ $number }}</td>
                                        <td class="d-none d-sm-table-cell" align="center">
                                            <span class="{{$statuscol}}" >{{ $inforleave -> STATUS_NAME }}</span>
                                        </td>
                                        <td  class="text-font" align="center" class="d-none d-sm-table-cell" >
                                        {{ $inforleave -> LEAVE_YEAR_ID }}
                                        </td>

                                        <td  class="text-font" align="center" class="d-none d-sm-table-cell">
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
                                             @if($inforleave->LEAVE_APP_SEND == 'APP')
                                             <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a>
                                             @else   
                                             -
                                             @endif
                                         </td>
                                         
                                        <td class="text-font text-pedding" align="left">
                                        {{ $inforleave -> LEAVE_PERSON_FULLNAME }}
                                        </td>
                                        <td class="text-font text-pedding" align="left">
                                            {{ $inforleave -> POSITION_IN_WORK }}
                                        </td>
                                        <td class="text-font text-pedding" align="left">
                                                {{ $inforleave -> HR_DEPARTMENT_SUB_SUB_NAME }}
                                        </td>

                                        <td class="text-font text-pedding" align="left">
                                        {{ $inforleave -> LEAVE_TYPE_NAME }}
                                        </td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{ $inforleave -> LEAVE_BECAUSE }}</td>

                                        <td class="text-font" class="d-none d-sm-table-cell" align="center">
                                            {{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}
                                        </td>
                                        <td class="text-font" class="d-none d-sm-table-cell" align="center">
                                            {{ DateThai($inforleave -> LEAVE_DATE_END) }}
                                        </td>

                                        @if($inforleave->WORK_DO == 0.5)
                                        <td class="text-font"  align="center">ครึ่งวัน</td>
                                        @else
                                        <td class="text-font"  align="center">{{ number_format($inforleave->WORK_DO) }}</td>
                                        @endif

                                        <td class="text-font text-pedding"  align="left">{{$inforleave -> LEAVE_WORK_SEND}}</td>
                                        <td class="text-font text-pedding"  align="left">{{$inforleave -> USER_CONFIRM_CHECK}}</td>
                                        <td align="center">
                                        @if($status === 'Verify')
                                        <a href="{{ url('person_headorg/headorg_leave_app/'.$inforleave->ID) }}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fa fa-edit"></i></a>
                                      
                                        @else
                                        <a href="#detail_modal{{ $inforleave -> ID }}" data-toggle="modal" class="btn btn-info  fa fa-list"></a>
                                        @endif

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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_SETSUN) }} วัน</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันหยุดนักขัตฤกษ์ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_HOLIDAY) }} วัน</h1>
           </div>
       </div>

       </div>

       ข้อมูลใบรับรองแพทย์
       <iframe src="{{ asset('storage/leavepdf/certificate_'.$inforleave->ID.'.pdf') }}" height="600px" width="100%"></iframe>
   
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;">ปิดหน้าต่าง</button>
        </div>
        </div>

</body>


    </div>
  </div>
</div>

<!------------------------อนุมัติ------------------------------------------>

<div id="lastapp_modal{{ $inforleave -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-xl">
                                         <div class="modal-content">
                                         <div class="modal-header">

                                    <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">อนุมัติข้อมูลการลา เลขที่ {{ $inforleave -> ID }}</h2>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">

         <form  method="post" action="{{ route('horg.updatelastapp') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $inforleave -> ID }}"/>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_SETSUN) }} วัน</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันหยุดนักขัตฤกษ์ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_HOLIDAY) }} วัน</h1>
           </div>
       </div>

       </div>


    

      <input type="hidden" name = "TOP_LEADER_AC_ID"  id="TOP_LEADER_AC_ID" value="{{ $id_user }} ">
      


      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "COMMENT"  id="COMMENT" class="form-control input-lg"></textarea>
      <br>
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-success" value="approved" style="font-family: 'Kanit', sans-serif;">อนุมัติ</button>
        <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" style="font-family: 'Kanit', sans-serif;">ไม่อนุมัติ</button>
        <button type="button" class="btn btn-hero-sm btn-secondary" data-dismiss="modal"  style="font-family: 'Kanit', sans-serif;">ปิดหน้าต่าง</button>

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

                </div>




                <div id="modal_allapp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                         <div class="modal-header">

                                         <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"></h2>
                                        </div>
                                        <div class="modal-body">
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ท่านต้องการอนุมัติรายการทั้งหมด !!</h2>

                                    </div>
                                    <div class="modal-footer">
                                    <div align="right">
                                    <a href="{{ url('person_headorg/infoleaveupdatelastappall')}}" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-success" >ตกลง</a>
                                    <button type="button" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" data-dismiss="modal" >ยกเลิก</button>
                                </div>
                                </div>
                            </body>
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
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });




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

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>



@endsection