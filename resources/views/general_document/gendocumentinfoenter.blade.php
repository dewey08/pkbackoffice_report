@extends('layouts.backend')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@section('content')

<style>
    .center {
    margin: auto;
    width: 100%;
    padding: 10px;
    }
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
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
                  /* table {
            border-collapse: collapse;
            }

        table, td, th {
            border: 1px solid black;
            }  */
            
            
            table {
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}

table, th, td {
  border: 1px solid black;
}

td {
  padding: 0.5em;
  /* font-family: monospace; */
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



use App\Http\Controllers\ManagerbookController;
$checkmanagerbooksecret = ManagerbookController::checkmanagerbooksecret($id_user);

use App\Http\Controllers\DocumentController;
$count1 = DocumentController::checkreadcountenter($id_user);
$count2 = DocumentController::checkreadcountinside($id_user);
$count3 = DocumentController::checkreadcountcommand($id_user);
$count4 = DocumentController::checkreadcountannounce($id_user);

?>



                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <div class="row">
                                <div >

                                <a href="{{ url('general_document/genodocdocumententer/'.$inforpersonuserid -> ID)}}" class="btn btn-success loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">หนังสือเข้า

                                @if($count1!=0)
                                    <span class="badge badge-light" >{{$count1}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_document/genodocdocumentinside/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">หนังสือส่ง

                                @if($count2!=0)
                                    <span class="badge badge-light" >{{$count2}}</span>
                                @endif
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_document/genodocdocumentcom/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">หนังสือคำสั่ง
                                @if($count3!=0)
                                    <span class="badge badge-light" >{{$count3}}</span>
                                @endif

                                </a>
                                </div>
                                <div>&nbsp;</div>

                                <div>
                                <a href="{{ url('general_document/genodocdocumentannounce/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ประกาศ
                                @if($count4!=0)
                                    <span class="badge badge-light" >{{$count4}}</span>
                                @endif
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

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลหนังสือเข้า</B></h3>
                            <div class="col-sm-1">
                                <a href="{{ url('general_document/gendocumen_updateall/'.$inforpersonuserid -> ID)}}" class="btn btn-hero-sm btn-hero-success " onclick="return confirm('ต้องการที่จะอ่านหนังสือทั้งหมดใช่หรือไม่ ?')" data-toggle="tooltip" data-placement="top" title="ใช้เปลี่ยนสถานะหนังสือที่ยังไม่อ่าน เป็นอ่านแล้ว"><i class="si si-book-open" style="font-size:24px;"></i></a>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                        <form action="{{ route('mbook.enterdocsearch',['iduser'=>  $inforpersonuserid->ID]) }}" method="post">
@csrf

<div class="row">
<div class="col-sm-0.5 col-form-label">
                            &nbsp;&nbsp; ปี พ.ศ. &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-sm budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
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
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
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
                    <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
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
                    <div class="col-sm-1">
                    <span>
                    <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                    </span>
                    </div>
                 

                  </div>
             </form>
            
             <div class="row">
<div class="col-md-6" style="font-size: 15px;">
ชั้นความเร็ว ::
<p class="fa fa-circle" style="color:#008000;"></p> ปกติ


<p class="fa fa-circle" style="color:#87CEFA;"></p> ด่วน


<p class="fa fa-circle" style="color:#FFA500;"></p> ด่วนมาก

<p class="fa fa-circle" style="color:#FF4500;"></p> ด่วนที่สุด
</div>
</div>
             <div class="table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">File</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">Attach <br>File</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ชั้นความเร็ว</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">สถานะ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">อ่าน</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">เลขรับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">เลขหนังสือ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อเรื่อง</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายละเอียด</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ความเห็น ผอ.</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่รับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="5%">คำสั่ง</th>
                                    </tr >
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforbooks as $inforbook)
                                <?php $number++; ?>

                                @if($checkmanagerbooksecret != 0)

                                    @if($inforbook->BOOK_SECRET_ID == 1)


                                <tr height="40">
                                        <td class="text-font" style="border: 1px solid black;vertical-align: text-top;" width="5%">{{$number}}</td>



                                        @if($inforbook->BOOK_HAVE_FILE == 'True')
                                                    <?php $bookpdf = storage_path('app/public/bookpdf/'.$inforbook->BOOK_FILE_NAME) ; ?>
                                                    @if(file_exists($bookpdf))
                                                    <td  style="vertical-align: text-top;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                    @else
                                                    <td  style="vertical-align: text-top;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                                    @endif
                                                
                                        
                                        @else
                                        <td  style="vertical-align: text-top;"></td>
                                        @endif

                                        @if($inforbook->BOOK_HAVE_FILE_2 == 'True')
                                        <td  style="vertical-align: text-top;" ><span class="btn" style="background-color:#0000FF;color:#F0FFFF;"><i class="fa fa-1.5x fa-paperclip"></i></span></td>
                                        @else
                                        <td  style="vertical-align: text-top;"></td>
                                        @endif

                                        @if($inforbook->BOOK_URGENT_ID == 1)
                                        <td class="text-font" style="vertical-align: text-top;" align="center"><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 2)
                                        <td class="text-font" style="vertical-align: text-top;" align="center"><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 3)
                                        <td class="text-font" style="vertical-align: text-top;" align="center"><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 4)
                                        <td class="text-font" style="vertical-align: text-top;" align="center"><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>

                                        @endif

                                        @if($inforbook->SEND_STATUS == '1')
                                        <td  style="vertical-align: text-top;" align="center"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($inforbook->SEND_STATUS == '2')
                                        <td style="vertical-align: text-top;" align="center"><span class="badge badge-warning" >ส่งหน่วยงาน</span></td>
                                        @elseif($inforbook->SEND_STATUS == '3')
                                        <td  style="vertical-align: text-top;" align="center"><span class="badge badge-success" >ผอ.ลงนาม</span></td>
                                
                                       @elseif($inforbook->SEND_STATUS == '4')
                                        <td  style="vertical-align: text-top;" align="center"><span class="badge badge-info" >เสนอ ผอ.</span></td>
                                       @else
                                       <td class="text-font" style="vertical-align: text-top;" align="center"></td>
                                        @endif


                                        @if($inforbook->READ_STATUS == 'True')
                                        <td  style="vertical-align: text-top;"><span class="btn" style="background-color:#32CD32;color:#F0FFFF;"><i class="si si-book-open" ></i></span></td>
                                        @else
                                        <td  style="vertical-align: text-top;"><span class="btn" style="background-color:#DCDCDC;color:#F0FFFF;"><i class="si si-book-open" ></i></span></td>
                                        @endif


                                        <td class="text-font" style="vertical-align: text-top;border: 1px solid black;" width="8%">{{ $inforbook->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;" width="12%">{{ $inforbook->BOOK_NUMBER}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;">{{ $inforbook->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;">{{ $inforbook->BOOK_DETAIL}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;">{{ $inforbook->TOP_LEADER_AC_CMD}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;" width="8%">{{ DateThai($inforbook->DATE_SAVE)}}</td>


                                        <td style="vertical-align: text-top;border: 1px solid black;" width="5%">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="{{ url('general_document/genodocdocumententer/control/'.$inforbook->BOOK_ID.'/'.$inforpersonuserid->ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="checkreadenter({{$inforbook->BOOK_ID}},{{$inforpersonuserid->ID}});">อ่าน/จัดการหนังสือ</a>

                                                </div>
                                        </div>
                                        </td>

                                    </tr>

                                    @else


                                <tr height="40">
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{$number}}</td>



                                        @if($inforbook->BOOK_HAVE_FILE == 'True')
                                        <?php $bookpdf = storage_path('app/public/bookpdf/'.$inforbook->BOOK_FILE_NAME) ; ?>
                                            @if(file_exists($bookpdf))
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @else
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @endif
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>
                                        @endif

                                        @if($inforbook->BOOK_HAVE_FILE_2 == 'True')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="btn fa fa-1.5x fa-paperclip" style="background-color:#0000FF;color:#F0FFFF;"></span></td>
                                        @else
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>
                                        @endif

                                        @if($inforbook->BOOK_URGENT_ID == 1)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 2)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 3)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 4)
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>

                                        @endif

                                        @if($inforbook->SEND_STATUS == '1')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($inforbook->SEND_STATUS == '2')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-warning" >ส่งหน่วยงาน</span></td>
                                        @elseif($inforbook->SEND_STATUS == '3')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-success" >ผอ.ลงนาม</span></td>
                                
                                       @elseif($inforbook->SEND_STATUS == '4')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="badge badge-info" >เสนอ ผอ.</span></td>
                                       @else
                                       <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>
                                        @endif

                                        @if($inforbook->READ_STATUS == 'True')
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn si si-book-open" style="background-color:#32CD32;color:#F0FFFF;"></span></td>
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn si si-book-open" style="background-color:#DCDCDC;color:#F0FFFF;"></span></td>
                                        @endif
                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ $inforbook->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforbook->BOOK_NUMBER}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforbook->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforbook->BOOK_DETAIL}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;">{{ $inforbook->TOP_LEADER_AC_CMD}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ DateThai($inforbook->DATE_SAVE)}}</td>

                                        @if($inforbook->BOOK_SECRET_ID == 2)
                                        <td class="text-font text-pedding" style="color: red;">ลับ :: {{ $inforbook->BOOK_NAME}}</td>
                                        @elseif($inforbook->BOOK_SECRET_ID == 3)
                                        <td class="text-font text-pedding" style="color: red;">ลับมาก :: {{ $inforbook->BOOK_NAME}}</td>
                                        @elseif($inforbook->BOOK_SECRET_ID == 4)
                                        <td class="text-font text-pedding" style="color: red;">ลับที่สุด :: {{ $inforbook->BOOK_NAME}}</td>
                                        @else
                                        <td class="text-font text-pedding" style="color: red;"> {{ $inforbook->BOOK_NAME}}</td>
                                        @endif


                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">{{ DateThai($inforbook->DATE_SAVE)}}</td>


                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="{{ url('general_document/genodocdocumententer/control/'.$inforbook->BOOK_ID.'/'.$inforpersonuserid->ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" onclick="checkreadenter({{$inforbook->BOOK_ID}},{{$inforpersonuserid->ID}});">อ่าน/จัดการหนังสือ</a>

                                                </div>
                                        </div>
                                        </td>

                                    </tr>


                                    @endif

                                @else


                            @if($inforbook->BOOK_SECRET_ID == 1)


                            <tr height="40">
                                        <td class="text-font" align="center">{{$number}}</td>



                                        @if($inforbook->BOOK_HAVE_FILE == 'True')
                                        <?php $bookpdf = storage_path('app/public/bookpdf/'.$inforbook->BOOK_FILE_NAME) ; ?>
                                            @if(file_exists($bookpdf))
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#FF6347;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @else
                                            <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span class="btn" style="background-color:#5a5655;color:#F0FFFF;"><i class="fa fa-1.5x fa-file-pdf"></i></span></td>
                                            @endif
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                                        @if($inforbook->BOOK_HAVE_FILE_2 == 'True')
                                        <td  align="center" ><span class="btn fa fa-1.5x fa-paperclip" style="background-color:#0000FF;color:#F0FFFF;"></span></td>
                                        @else
                                        <td  align="center" ></td>
                                        @endif

                                        @if($inforbook->BOOK_URGENT_ID == 1)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 2)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 3)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>
                                        @elseif($inforbook->BOOK_URGENT_ID == 4)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>

                                        @endif

                                        @if($inforbook->SEND_STATUS == '1')
                                        <td  align="center"><span class="badge badge-danger" >ลงรับ</span></td>
                                        @elseif($inforbook->SEND_STATUS == '2')
                                        <td  align="center"><span class="badge badge-warning" >ส่งหน่วยงาน</span></td>
                                        @elseif($inforbook->SEND_STATUS == '3')
                                        <td  align="center"><span class="badge badge-success" >ผอ.ลงนาม</span></td>
                                
                                       @elseif($inforbook->SEND_STATUS == '4')
                                        <td  align="center"><span class="badge badge-info" >เสนอ ผอ.</span></td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif

                                        @if($inforbook->READ_STATUS == 'True')
                                        <td  align="center"><span class="btn si si-book-open" style="background-color:#32CD32;color:#F0FFFF;"></span></td>
                                        @else
                                        <td  align="center"><span class="btn si si-book-open" style="background-color:#DCDCDC;color:#F0FFFF;"></span></td>
                                        @endif

                                        <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >{{ $inforbook->BOOK_NUM_IN}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforbook->BOOK_NUMBER}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforbook->BOOK_NAME}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ $inforbook->BOOK_DETAIL}}</td>
                                        <td class="text-font text-pedding" style="vertical-align: text-top;border: 1px solid black;">{{ $inforbook->TOP_LEADER_AC_CMD}}</td>
                                        <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">{{ DateThai($inforbook->DATE_SAVE)}}</td>


                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item"  href="{{ url('general_document/genodocdocumententer/control/'.$inforbook->BOOK_ID.'/'.$inforpersonuserid->ID) }}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" onclick="checkreadenter({{$inforbook->BOOK_ID}},{{$inforpersonuserid->ID}});">อ่าน/จัดการหนังสือ</a>

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
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


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
        // alert("Title");
        $('button').tooltip();   //// ToolTip Boostrap
    });
</script>

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
                     url:"{{route('admin.selectyear')}}",
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




function checkreadenter(bookid,userid){



          var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('document.checkreadenter')}}",
                   method:"GET",
                   data:{userid:userid,bookid:bookid,_token:_token}

           })

  }


  function datepick() {
  
  $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      todayBtn: true,
      language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
      thaiyear: true,
      autoclose: true                         //Set เป็นปี พ.ศ.
  });  //กำหนดเป็นวันปัจุบัน
}

</script>



@endsection
