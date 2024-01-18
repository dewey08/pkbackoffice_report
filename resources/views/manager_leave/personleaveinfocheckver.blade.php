@extends('layouts.leave')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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



use Illuminate\Support\Facades\DB;
?>
<?php
 
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');    
?>      

    <center>    
        <div class="block" style="width: 95%;">          
                <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลผู้ลาที่ผ่านการเห็นชอบจากหัวหน้า รอตรวจสอบ</B></h3>
                            <?php if($search == '' || $search == null){ $search_excel = 'null';}else{ $search_excel = $search;}?>
                            <a href="{{ url('manager_leave/excelcheck/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$year_id.'/'.$search_excel)}}"  class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>&nbsp;Excel</a>
                        </div>
                <div class="block-content block-content-full">
                    <form method="post">                          
                        @csrf
                        <div class="row">
                        <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
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
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{toDatePicker($displaydate_bigen)}}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{toDatePicker($displaydate_end)}}" readonly>
                  
                    </div>
                    </div>

                </div>
                           
                     <div class="col-sm-0.5">
                     &nbsp;สถานะ &nbsp;
                     </div>
                      
                       <div class="col-sm-2">
                       <span>
                       <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                        
                        @if($status_check == 'all')
                            <option value="all" selected>--ทั้งหมด--</option>
                        @else   
                            <option value="all">--ทั้งหมด--</option>
                        @endif
                        @if($status_check == 'VER')
                                <option value="VER" selected>เห็นชอบ,หน.กลุ่มเห็นชอบ</option>
                        @else   
                                <option value="VER" >เห็นชอบ,หน.กลุ่มเห็นชอบ</option> 
                        @endif

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
                      
                      <input type="search"  name="search" class="form-control" style=" font-family: 'Kanit', sans-serif;" value="{{$search}}">
                     </span>
                      </div>
                      <div class="col-sm-30">
                     &nbsp;
                     </div> 
                      <div class="col-sm-1.5">
                      <span>
                      <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight: normal;"><i class="fas fa-search mr-2"></i>ค้นหา</button>
                      </span> 
                      </div>

              
                  </div>  
             </form>    
             <a  class="btn btn-warning btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : ผู้รับมอบงานรับงาน&nbsp;&nbsp;  
             <a  class="btn btn-info btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : หัวหน้างานเห็นชอบ&nbsp;&nbsp;
             <a  class="btn btn-success btn-sm" style="color:rgb(254, 255, 254)"><i class="fa fa-check fa-sm" aria-hidden="true"></i></a> : หัวหน้ากลุ่มเห็นชอบ&nbsp;&nbsp;
           
             <div class="table-responsive"> 
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">ลำดับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  >สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ปีงบ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;  border: 1px solid black;" width="8%" >สถานะเห็นชอบ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >วันที่บันทึก</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" > ชื่อผู้แจ้งลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภทการลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="" >เหตุผลการลา</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="">ตำแหน่ง</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="">หน่วยงาน</th>                                       
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">วันเริ่มลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">ลาถึงวันที่</th> 
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >จำนวนวันลา</th>  
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="">ตรวจสอบ</th>                                    
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="" >คำสั่ง</th> 
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
                                

                                $countperson = DB::table('gleave_permis_level')->where('PERSON_ID','=',$inforleave->LEAVE_PERSON_ID)->count();

                               if($countperson > 0){
                                $checkuaerlevel = '1';
                               }else{
                                $checkuaerlevel = '2';
                               } 

                                ?> 
                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ $number }}</td>
                                        <td class="d-none d-sm-table-cell" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                                            <span class="{{$statuscol}}" >{{ $inforleave -> STATUS_NAME }}</span>
                                        </td>

                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" class="d-none d-sm-table-cell">
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

                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ DateThai($inforleave->LEAVE_DATETIME_REGIS)}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >
                                        {{ $inforleave -> LEAVE_PERSON_FULLNAME }}
                                        </td>

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;"  >
                                        {{ $inforleave -> LEAVE_TYPE_NAME }}
                                        </td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{ $inforleave -> LEAVE_BECAUSE }}</td>
                                        
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{$inforleave -> POSITION_IN_WORK}}</td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{$inforleave -> HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                                        
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ DateThai($inforleave->LEAVE_DATE_BEGIN)}}</td>
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ DateThai($inforleave->LEAVE_DATE_END)}}</td>
                

                                        @if($inforleave->WORK_DO == 0.5)
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ครึ่งวัน</td>
                                        @else
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ number_format($inforleave->WORK_DO,1) }}</td>
                                        @endif

                                        @if($status == 'ApproveGroup')
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="badge badge-warning" style="font-size: 12px;">รอตรวจสอบ</span></td>
                                        @elseif($checkuaerlevel== '2' && $status == 'Approve')
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="badge badge-warning" style="font-size: 12px;">รอตรวจสอบ</span></td>
                                        @else
                                        <td class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >-</td>
                                        @endif

                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                @if($status == 'ApproveGroup')
                                                <a class="dropdown-item" href="#ver_modal{{ $inforleave -> ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-clipboard-check text-info mr-2"></i>ตรวจสอบข้อมูล</a>
                                                
                                                @elseif($checkuaerlevel== '2' && $status == 'Approve')
                                                
                                                <a class="dropdown-item" href="#ver_modal{{ $inforleave -> ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-clipboard-check text-info mr-2"></i>ตรวจสอบข้อมูล</a>
                                                
                                                @else
                                                <a class="dropdown-item" href="#detail_modal{{$inforleave->ID}}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด</a>
                                                @endif 

                                                <a class="dropdown-item" href="{{ url('manager_leave/personleaveinfocheckedit/'.$inforleave -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>

{{-- 
                                                @if($status !== 'CANCEL')
                                                <a class="dropdown-item" href="{{ url('manager_leave/personleaveinfocheckcancel/'.$inforleave -> ID)}}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ยกเลิกข้อมูล</a>
                                                @endif --}}

                                                @if($inforleave -> LEAVE_TYPE_ID == 1 )
                                                    <a class="dropdown-item"  href="{{ url('manager_leave/certificate/'.$inforleave->ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><i class="fa fa-file text-info mr-2"></i>แนบใบรับรองแพทย์</a>  
                                                @endif


                                                @if($status !== 'CANCEL')
                                      
                                                <a class="dropdown-item"  href="{{ url('manager_leave/personleaveinfocheckcancel/'.$inforleave -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i class="fas fa-window-close text-danger mr-2"></i>ยืนยันยกเลิกการลา</a>
                                                 @endif


                                                    @if($inforleave -> LEAVE_TYPE_ID == 1 && ($status== "Allow" || $status== "Verify"))
                                                     <a class="dropdown-item"  href="{{ url('person_leave/personleavesick/export_pdfsick/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาป่วย</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 4 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"   href="{{ url('person_leave/personleaverest/export_pdfrest/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาพักผ่อน</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 3 &&  ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavework/export_pdfwork/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลากิจ</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 2 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavespawn/export_pdfspawn/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาคลอด</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 6 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/give/pdfgive/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาช่วยคลอด</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 8 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/train/pdftrain/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาไปศึกษา ฝึกอบรม</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 5 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/ordain/pdfordain/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาอุปสมบท</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 10 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavefollow/export_pdffollow/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาติดตามคู่สมรส</a> 
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 7 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleavesoldier/export_pdfsoldier/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาเกณฑ์ทหาร</a>
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 12 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleaveout/export_pdfout/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาออก</a>  
                                                    @elseif($inforleave -> LEAVE_TYPE_ID == 13 && ($status== "Allow" || $status== "Verify"))
                                                    <a class="dropdown-item"  href="{{ url('person_leave/personleaveout/export_pdfsicklow/'.$inforleave -> ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์ใบลาป่วยตามกฎหมาย</a> 
                                                    
                                                   @else
                                      
                
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
            <?php 
                 $infomationsendname = DB::table('hrd_person')
                                ->leftjoin('hrd_prefix','hrd_person.HR_PREFIX_ID','=','hrd_prefix.HR_PREFIX_ID')
                                ->where('hrd_person.ID','=',$inforleave->LEAVE_WORK_SEND_ID)
                                ->first();
              
               if($infomationsendname == null){                       
                    $send_person = '';             
               }else{         
                    $send_person = $infomationsendname->HR_PREFIX_NAME.''.$infomationsendname->HR_FNAME.' '.$infomationsendname->HR_LNAME;
               }
              
            ?> 
        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$send_person}}</h1>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave->LEAVE_SUM_ALL,1) }} วัน</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันทำการ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave->WORK_DO,1) }} วัน</h1>
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
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave ->  LEAVE_COMMENT_BY }}</h1>
                            </div>                               
                        </div> 
                          
                </div>      


      </div>
        <div class="modal-footer">
        <div align="right">
  
        <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
        </div>
        </div>
        </form>  
</body>
                        </div>
                    </div>
                    </div>

                                    
<!-------------------------------------------------------ตรวจสอบ--------------------------->

<div id="ver_modal{{ $inforleave -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">        
                <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ตรวจสอบข้อมูลการลา เลขที่ {{ $inforleave -> ID }}</h2>
                    </div>
                <div class="modal-body">
                    <form  method="post" action="{{ route('leave.updatevercheck') }}" enctype="multipart/form-data">
                         @csrf
                    <input type="hidden"  name="ID" value="{{ $inforleave -> ID }}"/>                            
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
                            <?php 
                          $infomationsendname = DB::table('hrd_person')
                                ->leftjoin('hrd_prefix','hrd_person.HR_PREFIX_ID','=','hrd_prefix.HR_PREFIX_ID')
                                ->where('hrd_person.ID','=',$inforleave->LEAVE_WORK_SEND_ID)
                                ->first();
              
                            if($infomationsendname == null){                       
                                    $send_person = '';             
                            }else{         
                                    $send_person = $infomationsendname->HR_PREFIX_NAME.''.$infomationsendname->HR_FNAME.' '.$infomationsendname->HR_LNAME;
                            }
                            ?> 
                        <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$send_person}}</h1>
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
                            <h1 class="text-left" style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforleave ->  LEAVE_COMMENT_BY }}</h1>
                            </div>                               
                        </div> 
                          
                </div>      


               
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">

      <input type="hidden" name = "USER_CONFIRM_CHECK_ID"  id="USER_CONFIRM_CHECK_ID" value="{{ $id_user }} ">
      
     
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-success" value="approved" style="font-family: 'Kanit', sans-serif;font-weight: normal;" ><i class="fas fa-user-check mr-2"></i>ผ่าน</button>
        <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" style="font-family: 'Kanit', sans-serif;font-weight: normal;"><i class="fas fa-times mr-2"></i>ไม่ผ่าน</button>
        <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight: normal;"><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
       
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
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            language: 'th',
                            autoclose: true,
                            todayHighlight: true,
                            todayBtn: true,
                            thaiyear: true                     //Set เป็นปี พ.ศ.
                        });  //กำหนดเป็นวันปัจุบัน
                     }
             })
             }        
     });
     $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: 'th',
                autoclose: true,
                todayHighlight: true,
                todayBtn: true,
                thaiyear: true                     //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });
    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection