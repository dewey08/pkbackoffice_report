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
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div >
                                <a href="{{ url('person_leave/personleavetype/'.$inforpersonuserid -> ID)}}" class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลการลา</a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('person_leave/personleaveinfo/'.$inforpersonuserid -> ID)}}" class="btn btn-primary" >ข้อมูลการลา</a> 
                                </div>
                                <div>&nbsp;</div>
                              
                                @if($checkapp != 0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfoapp/'.$inforpersonuserid -> ID)}}" class="btn btn-warning" >เห็นชอบ 
                                @if($countapp!=0)
                                    <span class="badge badge-light" >{{$countapp}}</span>
                                @endif
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkver != 0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfover/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#00BFFF;color:#F0FFFF;">ตรวจสอบ 
                                @if($countver!=0)
                                    <span class="badge badge-light" >{{$countver}}</span>
                                @endif
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                @endif

                                @if($checkallow!=0)
                                <div>
                                <a href="{{ url('person_leave/personleaveinfolastapp/'.$inforpersonuserid -> ID)}}" class="btn btn-success" >อนุมัติ 
                                @if($countallow!=0)
                                    <span class="badge badge-light" >{{$countallow}}</span>
                                @endif
                                </a> 
                                </div>           
                                <div>&nbsp;</div>
                                @endif
                                
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
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลผู้ลาที่ผ่านการเห็นชอบจากหัวหน้า รอตรวจสอบ</B></h3>
                        </div>
                        <div class="block-content block-content-full">
                        <form action="{{ route('leave.searchver',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
                        @csrf
                        <div class="row">
                        <div class="col-md-0.5">
                       &nbsp;&nbsp;วันที่ &nbsp;
                       </div>
                       <div class="col-md-2">
                       <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" readonly >
                     </div>
                     <div class="col-md-0.5">
                     &nbsp;ถึง &nbsp;
                     </div>
                     <div class="col-md-2">
                       <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" readonly >
                      </div>

                           
                     <div class="col-md-0.5">
                     &nbsp;สถานะ &nbsp;
                     </div>
                      
                       <div class="col-md-2">
                       <span>
                       <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                       <option value="">--ทั้งหมด--</option>
                        @foreach ($infostatuss as $infostatus)
                         @if($infostatus->STATUS_CODE == 'Approve')
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
                      
                      <input type="search"  name="search" class="form-control" style=" font-family: 'Kanit', sans-serif;" >
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
                </div> 
             </form>     
             <div class="table-responsive"> 
                         
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 97%;">
                                    <thead style="background-color: #FFEBCD;">
                                        <tr height="40">                                           
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5">ลำดับ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="10%">สถานะ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%" >ปีงบ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;width: 15%;"> ชื่อผู้แจ้งลา</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;"width="15%" >ประเภทการลา</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เนื่องจาก</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันเริ่มลา</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ลาถึงวันที่</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%" >คำสั่ง</th> 
                                                
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforleaves as $inforleave)
                                <?php $number++; 
                                  $status =  $inforleave -> STATUS_CODE;
                                  if( $status === 'Pending'){
                                      $statuscol =  "badge badge-danger";
  
                                  }else if($status === 'Approve'){
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
                                        <td class="text-font" align="center">{{ $number }}</td>
                                        <td class="d-none d-sm-table-cell" align="center">
                                            <span class="{{$statuscol}}" >{{ $inforleave -> STATUS_NAME }}</span>
                                        </td>

                                        <td class="text-font" align="center" class="d-none d-sm-table-cell" >
                                        {{ $inforleave -> LEAVE_YEAR_ID }}
                                        </td>
                                        <td class="text-font" align="center">
                                        {{ $inforleave -> LEAVE_PERSON_FULLNAME }}
                                        </td>

                                        <td class="text-font" align="center">
                                        {{ $inforleave -> LEAVE_TYPE_NAME }}
                                        </td>
                                        <td class="text-font text-pedding" class="d-none d-sm-table-cell">{{ $inforleave -> LEAVE_BECAUSE }}</td>
                                        
                     
                                        <td class="text-font" align="center">
                                            {{ DateThai($inforleave -> LEAVE_DATE_BEGIN) }}
                                        </td>
                                        <td class="text-font" align="center">
                                            {{ DateThai($inforleave -> LEAVE_DATE_END) }}
                                        </td>



                                        <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                @if($status == 'Approve')
                                                <a class="dropdown-item" href="#ver_modal{{ $inforleave -> ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ตรวจสอบข้อมูล</a>
                                                @else
                                                <a class="dropdown-item" href="#detail_modal{{ $inforleave -> ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                @endif 

                                                @if($status == 'Cancel')
                                                <a class="dropdown-item"  href="{{ url('admin_leave/setupinfovacation/export_pdf') }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">พิมพ์ใบลา</a>
                                                @else
                                                <a class="dropdown-item" href="{{ url('person_leave/cancelpersonleavever/'.$inforleave -> ID.'/'.$user_id)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ยกเลิกข้อมูล</a>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_WORK_SEND }} </h1>
           </div>                               
       </div>
       </div>

       
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label>หมอบหมายงาน :</label>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;"></h1>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_ALL) }} วัน</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันทำการ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> WORK_DO) }} วัน</h1>
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


      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
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
    <form  method="post" action="{{ route('leave.updatever') }}" enctype="multipart/form-data">
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{$inforleave -> LEAVE_WORK_SEND }} </h1>
           </div>                               
       </div>
       </div>

       
       <div class="row">
       <div class="col-sm-2">
           <div class="form-group">
           <label>หมอบหมายงาน :</label>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;"></h1>
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
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> LEAVE_SUM_ALL) }} วัน</h1>
           </div>                               
       </div> 
       <div class="col-sm-2">
           <div class="form-group">
           <label >วันทำการ :</label>
           </div>                               
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ number_format($inforleave -> WORK_DO) }} วัน</h1>
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
       <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $inforpersonuserid ->ID }} ">
      <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">

      <input type="hidden" name = "USER_CONFIRM_CHECK"  id="USER_CONFIRM_CHECK" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }} ">
      <input type="hidden" name = "USER_CONFIRM_CHECK_ID"  id="USER_CONFIRM_CHECK_ID" value="{{ $inforpersonuserid ->ID }} ">
    
      <!--<label >หมายเหตุ</label>
      <textarea   name = "COMMENT"  id="COMMENT" class="form-control input-lg"></textarea>--->
        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >ผ่าน</button>
        <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่ผ่าน</button>
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
       
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
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection