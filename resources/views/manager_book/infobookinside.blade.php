@extends('layouts.book')
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

use App\Http\Controllers\DashboardController;
$checkbook = DashboardController::checkbook($id_user);



use App\Http\Controllers\ManagerbookController;
$checkmanagerbooksecret = ManagerbookController::checkmanagerbooksecret($id_user);

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

<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนหนังสือส่ง</B></h3>
<a href="{{ url('manager_book/bookinside/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fa fa-plus mr-2"></i>ออกเลขหนังสือส่ง</a>
&nbsp;
<?php 
        if($status_check==''){$status_check_send='null';}else{$status_check_send=$status_check;} 
        if($search==''){$search_send='null';}else{$search_send=$search;} 
?>
<a href="{{ url('manager_book/bookinside_excel/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$status_check_send.'/'.$search_send) }}"  class="btn btn-hero-sm btn-hero-success" ><i class="fas fa-file-excel mr-2"></i>Excel</a>
</div>
<div class="block-content block-content-full">
<form method="post">
@csrf

<div class="row">
                <div class="col-sm-0.5 col-form-label">
                            &nbsp;&nbsp; ปี พ.ศ. &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget== $year_id)
                                    <option value="{{ $budget  }}" selected>{{ $budget}}</option>
                                @else
                                    <option value="{{ $budget  }}">{{ $budget}}</option>
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
<select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
<option value="">--ทั้งหมด--</option>
@foreach ($infobook_sendstatuss as $infobook_sendstatus)
      @if($infobook_sendstatus->BOOK_STATUS_ID == $status_check)
      <option value="{{ $infobook_sendstatus->BOOK_STATUS_ID  }}" selected>{{ $infobook_sendstatus->BOOK_STATUS_NAME}}</option>
      @else
      <option value="{{ $infobook_sendstatus->BOOK_STATUS_ID  }}">{{ $infobook_sendstatus->BOOK_STATUS_NAME}}</option>
      @endif
  
                                                                           
@endforeach 

</select>
</span>
</div> 

<div class="col-sm-0.5">
&nbsp;ค้นหา &nbsp;
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
    <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
</span> 
</div>



</div>  
</form>
<div class="row">
<div class="col-md-4">
ชั้นความเร็ว :: 
<p class="fa fa-circle" style="color:#008000;"></p> ปกติ


<p class="fa fa-circle" style="color:#87CEFA;"></p> ด่วน


<p class="fa fa-circle" style="color:#FFA500;"></p> ด่วนมาก

<p class="fa fa-circle" style="color:#FF4500;"></p> ด่วนที่สุด
</div>
</div>
<div class="table-responsive"> 

<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
   <thead style="background-color: #FFEBCD;">
       <tr height="40">
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
         
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">File</th>
           <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">Attach <br>File</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ความเร่งด่วน</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เลขหนังสือส่ง</th>                    
        
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อเรื่อง</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ส่ง</th>

           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">รายละเอียด</th>

           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ส่งหน่วยงาน</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ผู้จัดทำ</th>
           <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="5%">คำสั่ง</th>   
       
           
       </tr >
   </thead>
   <tbody>
                                <?php $number = 0; ?>
                                @foreach ($infobookinsides as $infobookinside)
                                <?php $number++;  ?>
                                @if($checkmanagerbooksecret != 0)

                                    @if($infobookinside->BOOK_SECRET_ID == 1)
                                    <tr height="20">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>

                                        @if($infobookinside->BOOK_HAVE_FILE == 'True')
                                        <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookinside->BOOK_FILE_NAME) ; ?>
                                            @if(file_exists($bookpdf))
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @else
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @endif
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif

                                        
                                        @if($infobookinside->BOOK_HAVE_FILE_2 == 'True')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn fa fa-1.5x" style="background-color:#0000FF;color:#F0FFFF;"><i class="fa fa-paperclip"></i></span></td>
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                                        @endif


                               
                                        @if($infobookinside->BOOK_URGENT_ID == 1)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td> 
                                        @elseif($infobookinside->BOOK_URGENT_ID == 2)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($infobookinside->BOOK_URGENT_ID == 3)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>         
                                        @elseif($infobookinside->BOOK_URGENT_ID == 4)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                                        
                                        @endif

                                       
                                        @if($infobookinside->SEND_STATUS == '1')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($infobookinside->SEND_STATUS == '2')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-warning" >ส่งหน่วยงาน</span></td>
                                        @elseif($infobookinside->SEND_STATUS == '3')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-success" >ผอ.ลงนาม</span></td>
                                
                                       @elseif($infobookinside->SEND_STATUS == '4')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-info" >เสนอ ผอ.</span></td>
                                       @else
                                       <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>
                                        @endif

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ $infobookinside->BOOK_NUM_IN}}</td>

                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookinside->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">{{ DateThai($infobookinside->DATE_SAVE)}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->BOOK_DETAIL}} </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->RECORD_ORG_NAME}} </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->HR_FNAME}} {{ $infobookinside->HR_LNAME}}</td>
                                        
                                        
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                   <a class="dropdown-item"  href="{{ url('manager_book/bookinside/control/'.$infobookinside->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_book/bookinside/edit/'.$infobookinside->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                 
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>
                                    @else
                                     
                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>

                                        @if($infobookinside->BOOK_HAVE_FILE == 'True')
                                            <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookinside->BOOK_FILE_NAME) ; ?>
                                                @if(file_exists($bookpdf))
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @else
                                                <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                @endif
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                                        @if($infobookinside->BOOK_HAVE_FILE_2 == 'True')
                                        <td  align="center" ><span class="btn fa fa-1.5x" style="background-color:#0000FF;color:#F0FFFF;"><i class="fa fa-paperclip"></i></span></td>
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                               
                                        @if($infobookinside->BOOK_URGENT_ID == 1)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td> 
                                        @elseif($infobookinside->BOOK_URGENT_ID == 2)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($infobookinside->BOOK_URGENT_ID == 3)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>         
                                        @elseif($infobookinside->BOOK_URGENT_ID == 4)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                                        
                                        @endif

                                        @if($infobookinside->SEND_STATUS == '1')
                                        <td  align="center"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($infobookinside->SEND_STATUS == '2')
                                        <td  align="center"><span class="badge badge-warning" >ส่งหน่วยงาน</span></td>
                                        @elseif($infobookinside->SEND_STATUS == '3')
                                        <td  align="center"><span class="badge badge-success" >ผอ.ลงนาม</span></td>
                                
                                       @elseif($infobookinside->SEND_STATUS == '4')
                                        <td  align="center"><span class="badge badge-info" >เสนอ ผอ.</span></td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif

                                        <td class="text-font" align="center" >{{ $infobookinside->BOOK_NUM_IN}}</td>
                                        {{-- <td class="text-font text-pedding" >{{ $infobookinside->BOOK_NUMBER}}</td> --}}
                                       
                                        @if($infobookinside->BOOK_SECRET_ID == 2)
                                        <td class="text-font text-pedding" style="color: red;">ลับ :: {{ $infobookinside->BOOK_NAME}}</td>
                                        @elseif($infobookinside->BOOK_SECRET_ID == 3)
                                        <td class="text-font text-pedding" style="color: red;">ลับมาก :: {{ $infobookinside->BOOK_NAME}}</td>
                                        @elseif($infobookinside->BOOK_SECRET_ID == 4)
                                        <td class="text-font text-pedding" style="color: red;">ลับที่สุด :: {{ $infobookinside->BOOK_NAME}}</td>
                                        @else
                                        <td class="text-font text-pedding" style="color: red;"> {{ $infobookinside->BOOK_NAME}}</td>
                                        @endif


                                      
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">{{ DateThai($infobookinside->DATE_SAVE)}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->RECORD_ORG_NAME}} </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->HR_FNAME}} {{ $infobookinside->HR_LNAME}}</td>



                                        
                                        
                                        <td align="center" width="5%">
                                        <div class="dropdown" >
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                   <a class="dropdown-item"  href="{{ url('manager_book/bookinside/control/'.$infobookinside->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_book/bookinside/edit/'.$infobookinside->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                 
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>
                                    @endif

                                @else
                                @if($infobookinside->BOOK_SECRET_ID == 1)

                                <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>

                                        @if($infobookinside->BOOK_HAVE_FILE == 'True')
                                        <?php $bookpdf = storage_path('app/public/bookpdf/'.$infobookinside->BOOK_FILE_NAME) ; ?>
                                            @if(file_exists($bookpdf))
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @else
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @endif
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                                        @if($infobookinside->BOOK_HAVE_FILE_2 == 'True')
                                        <td  align="center" ><span class="btn fa fa-1.5x" style="background-color:#0000FF;color:#F0FFFF;"><i class="fa fa-paperclip"></i></span></td>
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                               
                                        @if($infobookinside->BOOK_URGENT_ID == 1)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td> 
                                        @elseif($infobookinside->BOOK_URGENT_ID == 2)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($infobookinside->BOOK_URGENT_ID == 3)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>         
                                        @elseif($infobookinside->BOOK_URGENT_ID == 4)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                                        
                                        @endif

                                        @if($infobookinside->SEND_STATUS == '1')
                                        <td  align="center"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($infobookinside->SEND_STATUS == '2')
                                        <td  align="center"><span class="badge badge-warning" >ส่งหน่วยงาน</span></td>
                                        @elseif($infobookinside->SEND_STATUS == '3')
                                        <td  align="center"><span class="badge badge-success" >ผอ.ลงนาม</span></td>
                                
                                       @elseif($infobookinside->SEND_STATUS == '4')
                                        <td  align="center"><span class="badge badge-info" >เสนอ ผอ.</span></td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif
                                        <td class="text-font" align="center" >{{ $infobookinside->BOOK_NUM_IN}}</td>
                            
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $infobookinside->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">{{ DateThai($infobookinside->DATE_SAVE)}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->BOOK_DETAIL}} </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->RECORD_ORG_NAME}} </td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ $infobookinside->HR_FNAME}} {{ $infobookinside->HR_LNAME}}</td>
                                        
                                        
                                        <td align="center" width="5%">
                                        <div class="dropdown" >
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                   <a class="dropdown-item"  href="{{ url('manager_book/bookinside/control/'.$infobookinside->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">อ่าน/จัดการหนังสือ</a>
                                                    <a class="dropdown-item"  href="{{ url('manager_book/bookinside/edit/'.$infobookinside->BOOK_ID) }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                 
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>



                                @endif


                            @endif


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

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>

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
                todayHighlight: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    $('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectyear')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            thaiyear: true,
                            todayHighlight: true,
                            autoclose: true                         //Set เป็นปี พ.ศ.
                        });  //กำหนดเป็นวันปัจุบัน
                     }
             })
            // console.log(select);
             }        
     });
     
</script>
@endsection