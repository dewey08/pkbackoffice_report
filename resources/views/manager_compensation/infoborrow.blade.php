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

 

?>
<?php

    use App\Http\Controllers\ManagercompensationController;
?>          

<center>    
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนยืม-คืน</B></h3>
             
            </div>
            <div class="block-content block-content-full">
            <form action="{{ route('mcompensation.infoborrow') }}" method="post">
                @csrf

               
                <div class="row">
                <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style="font-family: 'Kanit', sans-serif;">
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
                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                        </span>
                    </div>
                    <div class="col-md-30">
                        &nbsp;
                    </div>
                    {{-- <div class="col-md-1">
                        <span>
                            <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                        </span>
                    </div> --}}
                    <div class="col-md-1.5">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-search mr-2"></i> ค้นหา</button>
                        </span> 
                    </div>
                </div>
        </form>
        <div class="table-responsive">
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">เลขที่</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">หนังสือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">ปีงบประมาณ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">วันที่ขอยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เหตุผลการขอยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="9%">เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">จำนวนเงิน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">วันครบกำหนด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">วันที่คืน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="6%">ผู้รับคืน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>  

                       <?php $number = 0; ?>
                                @foreach ($inforSalaryborrows as $inforSalaryborrow)
                                <?php $number++; ?>
                               
                                    <tr height="40">
                                        <td class="text-font" align="center" width="5%">{{$number}}</td>
  
                                      
                                        @if($inforSalaryborrow->BORROW_STATUS== 'REQUEST')
                                        <td  align="center" width="5%"><span class="badge badge-warning" >ร้องขอ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'APP')
                                        <td  align="center" width="5%"><span class="badge badge-info" >เห็นชอบ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'NOTAPP')
                                        <td  align="center" width="5%"><span class="badge badge-danger" >ไม่เห็นชอบ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'SUCCESS')
                                        <td  align="center" width="5%"><span class="badge badge-success" >อนุมัติ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'NOTSUCCESS')
                                        <td  align="center" width="5%"><span class="badge badge-danger" >ไม่อนุมัติ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'SENDMON')
                                        <td  align="center" width="5%"><span class="badge badge-info" >แจ้งคืนเงิน</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'REMON')
                                        <td  align="center" width="5%"><span class="badge badge-success" >ยืนยันการรับเงิน</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'CANCEL')
                                        <td  align="center" width="5%"><span class="badge badge-danger" >ยกเลิก</span></td>
                                        @else
                                        <td class="text-font" align="center" width="5%"></td>
                                        @endif

                                      

                                        <td class="text-font text-pedding" width="8%">{{ $inforSalaryborrow->BORROW_NUMBER}}</td>
                                        <td class="text-font text-pedding" width="8%">{{$inforSalaryborrow->BORROW_GOVERNMENT_BOOK}}</td>
                                        <td class="text-font" style="text-align: center" width="6%">{{ $inforSalaryborrow->BORROW_YEAR}}</td>
                                        <td class="text-font text-pedding" width="6%">{{ DateThai($inforSalaryborrow->BORROW_DATE)}}</td>
                                     
                                        <td class="text-font text-pedding">{{ $inforSalaryborrow->BORROW_COMMENT}}</td>
                                        <td class="text-font text-pedding" width="10%">{{ $inforSalaryborrow->BORROW_HR_DEP_SUB_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" width="9%">{{ $inforSalaryborrow->BORROW_HR_PERSON_NAME}}</td>

                                            
                                        <td class="text-font text-pedding" style="text-align: right" width="6%">{{number_format(ManagercompensationController::borrowtotal($inforSalaryborrow->BORROW_ID),2)}}</td>
                                       
                                        <td class="text-font text-pedding" width="6%">{{ DateThai($inforSalaryborrow->BORROW_END_DATE)}}</td>

                                        @if($inforSalaryborrow->BORROW_BACK_DATE !== null && $inforSalaryborrow->BORROW_BACK_DATE !== '')
                                        <td class="text-font" style="text-align: center" width="6%">{{ DateThai($inforSalaryborrow->BORROW_BACK_DATE)}}</td>
                                        @else
                                        <td class="text-font" style="text-align: center" width="6%"></td>
                                        @endif

                                        <td class="text-font text-pedding" width="6%"></td>
                                        
                                        
                                        <td align="center" width="5%">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail{{ $inforSalaryborrow -> BORROW_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                                @if($inforSalaryborrow->BORROW_STATUS == 'REQUEST')
                                                <a class="dropdown-item"  href="#app_modal{{ $inforSalaryborrow -> BORROW_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เห็นชอบ</a>
                                                @endif


                                                @if($inforSalaryborrow->BORROW_STATUS == 'SENDMON')
                                                <a class="dropdown-item"  href="#returnmon{{ $inforSalaryborrow -> BORROW_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ยืนยันการรับเงินคืน</a>
                                                @endif
                                                @if($inforSalaryborrow->BORROW_STATUS == 'APP' || $inforSalaryborrow->BORROW_STATUS == 'SUCCESS')
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/pdfborrow/export_pdfborrow/'.$inforSalaryborrow->BORROW_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >พิมพ์สัญญายืมเงิน</a>
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/pdfborrow/export_pdfborrowblack/'.$inforSalaryborrow->BORROW_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >พิมพ์สัญญายืมเงินด้านหลัง</a>
                                                @endif

                                                <a class="dropdown-item"  href="{{ url('manager_compensation/pdfborrow/export_pdfreturnborrow/'.$inforSalaryborrow->BORROW_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >พิมพ์ใบล้างเงินยืม</a>
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/pdfborrow/export_pdftrack1/'.$inforSalaryborrow->BORROW_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >พิมพ์แบบติดตาม 1</a>
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/pdfborrow/export_pdftrack2/'.$inforSalaryborrow->BORROW_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank" >พิมพ์แบบติดตาม 2</a>
                                                </div>
                                        </div>
                                        </td>     


                                    </tr>   
                                             <!------------------------ยืนยันรับเงินยืม------------------------------------------>
                                             <div id="returnmon{{ $inforSalaryborrow -> BORROW_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                <div class="modal-header">
       
                                           <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:20px;font-weight:normal;">ยืนยันรับเงินการขอยืมเงินเลขที่ {{ $inforSalaryborrow -> BORROW_NUMBER}}</h2>
                                               </div>
                                               <div class="modal-body">
                                          
       
                                                   <form  method="post" action="{{ route('mcompensation.infoborrow_re') }}" enctype="multipart/form-data">
                                                   @csrf
                                                   <input type="hidden"  name="BORROW_ID" value="{{ $inforSalaryborrow -> BORROW_ID}}"/>
                                          
                                                
                                                       
                                                           
                                                    <div class="row">
                                                            <div class="col-sm-3" align="left">
                                                                <label>วันที่คืน</label>
                                                            </div> 
                                                            <div class="col-sm-9"> 
                                                            
                                                                <input name="BORROW_BACK_DATE" id="BORROW_BACK_DATE" value="" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  readonly required>
                                                            </div>
                                                        </div> 
                                                    <br> 
                                                        <div class="modal-footer">
                                                            <div align="right">
                                                                <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> &nbsp;ยืนยัน</button>
                                                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</button>
                                                                </div>
                                                           </div>
                                                           </form>
                                                   </body>
       
       
                                                       </div>
                                                   </div>
                                                   </div>
                                                </div>
                                            <!------------------------รายละเอียด------------------------------------------>


                                        <div id="detail{{ $inforSalaryborrow -> BORROW_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-xl">
                                         <div class="modal-content">
                                         <div class="modal-header">

                                    <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เห็นชอบข้อมูลการขอยืมเงินเลขที่ {{ $inforSalaryborrow -> BORROW_NUMBER}}</h2>
                                        </div>
                                        <div class="modal-body">
                                   

                                            <form  method="post" action="{{ route('mcompensation.infoborrow_app') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden"  name="ID" value="{{ $inforSalaryborrow -> BORROW_ID}}"/>
                                   
                                         
                                                
                                                    
                <div class="row">
                    <div class="col-sm-2">
                        <label>เลขทะเบียน :</label>
                    </div> 
                    <div class="col-lg-3">       
                       
                        <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_NUMBER }}</h1>         
                    </div>
                    <div class="col-sm-1 text-right">                    
                        <label>จังหวัด :</label>
                    </div> 
                    <div class="col-lg-2"> 
                       
                        <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_PROVINCE }}</h1> 
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ปีงบประมาณ :</label>
                    </div>         
                    <div class="col-lg-2">  
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_YEAR }}</h1>       
                   
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ยื่นต่อ :</label>
                    </div> 
                    <div class="col-sm-3">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_LOCATION }}</h1>
                         
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label>วันที่ยืม :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalaryborrow -> BORROW_DATE) }}</h1>       
                       
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>เวลา :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TIME }}</h1> 

                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">
                   
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"> {{ $inforSalaryborrow -> BORROW_HR_PERSON_NAME }}</h1> 

    
                   
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_POSITION_IN_WORK }}</h1> 
                    
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>สังกัด :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AFFILIATION }}</h1> 
                         </div> 
                </div>

                <div class="row">
                <div class="col-sm-2">
                        <label>ประเภทเงิน :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TYPE_MONEY }}</h1>        
                         
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ประสงค์ขอยืมเงินจาก :</label>
                    </div> 
                    <div class="col-sm-6">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_FUND }}</h1> 
                                          
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>อ้างหนังสือราชการ :</label>
                    </div> 
                    <div class="col-sm-9 text-left">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_BOOK }}</h1> 
                       
                    </div>    
                                 
                    <div class="col-sm-1">                       
                        <!-- <a href="" class="btn btn-sm btn-primary" style=" font-family: 'Kanit', sans-serif;" >. . .</a> -->
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label>อ้างบันทึกไปราชการ :</label>
                    </div> 
                    <div class="col-sm-9 text-left">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_GO }}</h1> 
                         </div>    
                                 
                    <div class="col-sm-1">                       
                        <!-- <a href="" class="btn btn-sm btn-primary" style=" font-family: 'Kanit', sans-serif;" >. . .</a> -->
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>เพื่อใช้ในการ :</label>
                    </div> 
                    <div class="col-sm-10">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_COMMENT }}</h1> 
                        </div>  
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <label>ระหว่างวันที่ :</label>
                    </div> 
                    <div class="col-lg-2">  
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalaryborrow -> BORROW_START_DATE) }}</h1>       
                      </div>
                    <div class="col-sm-1 text-right">
                        <label>ถึง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalaryborrow -> BORROW_END_DATE) }}</h1> 
                       </div> 
                    <div class="col-sm-1 text-right">
                        <label>ณ :</label>
                    </div> 
                    <div class="col-lg-4"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AT_LOCATION }}</h1>        
                       </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_HR_PERSON_NAME }} </h1>        
                     
                        </select>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-3"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_HR_DEP_SUB_SUB_NAME }}</h1>        
                            
                    
                  
                    </div>       
                   
                    </div>       
                    </div>
            <br> 
                                                    <div class="modal-footer">
                                                    <div align="right">
                                                 
                                                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ปิดหน้าต่าง</button>

                                                    </div>
                                                    </div>
                                                    </form>
                                            </body>


                                                </div>
                                            </div>
                                            </div>



                                               <!------------------------อนุมัติ------------------------------------------>

                            <div id="app_modal{{ $inforSalaryborrow -> BORROW_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-xl">
                                         <div class="modal-content">
                                         <div class="modal-header">

                                    <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เห็นชอบข้อมูลการขอยืมเงินเลขที่ {{ $inforSalaryborrow -> BORROW_NUMBER}}</h2>
                                        </div>
                                        <div class="modal-body">
                                   

                                            <form  method="post" action="{{ route('mcompensation.infoborrow_app') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden"  name="ID" value="{{ $inforSalaryborrow -> BORROW_ID}}"/>
                                   
                                         
                                                
                                                    
                <div class="row">
                    <div class="col-sm-2">
                        <label>เลขทะเบียน :</label>
                    </div> 
                    <div class="col-lg-3">       
                       
                        <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_NUMBER }}</h1>         
                    </div>
                    <div class="col-sm-1 text-right">                    
                        <label>จังหวัด :</label>
                    </div> 
                    <div class="col-lg-2"> 
                       
                        <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_PROVINCE }}</h1> 
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ปีงบประมาณ :</label>
                    </div>         
                    <div class="col-lg-2">  
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_YEAR }}</h1>       
                   
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ยื่นต่อ :</label>
                    </div> 
                    <div class="col-sm-3">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_LOCATION }}</h1>
                         
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label>วันที่ยืม :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalaryborrow -> BORROW_DATE) }}</h1>       
                       
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>เวลา :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TIME }}</h1> 

                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">
                   
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"> {{ $inforSalaryborrow -> BORROW_HR_PERSON_NAME }}</h1> 

    
                   
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_POSITION_IN_WORK }}</h1> 
                    
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>สังกัด :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AFFILIATION }}</h1> 
                         </div> 
                </div>

                <div class="row">
                <div class="col-sm-2">
                        <label>ประเภทเงิน :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TYPE_MONEY }}</h1>        
                         
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ประสงค์ขอยืมเงินจาก :</label>
                    </div> 
                    <div class="col-sm-6">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_FUND }}</h1> 
                                          
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>อ้างหนังสือราชการ :</label>
                    </div> 
                    <div class="col-sm-9 text-left">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_BOOK }}</h1> 
                       
                    </div>    
                                 
                    <div class="col-sm-1">                       
                        <!-- <a href="" class="btn btn-sm btn-primary" style=" font-family: 'Kanit', sans-serif;" >. . .</a> -->
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label>อ้างบันทึกไปราชการ :</label>
                    </div> 
                    <div class="col-sm-9 text-left">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_GO }}</h1> 
                         </div>    
                                 
                    <div class="col-sm-1">                       
                        <!-- <a href="" class="btn btn-sm btn-primary" style=" font-family: 'Kanit', sans-serif;" >. . .</a> -->
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>เพื่อใช้ในการ :</label>
                    </div> 
                    <div class="col-sm-10">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_COMMENT }}</h1> 
                        </div>  
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <label>ระหว่างวันที่ :</label>
                    </div> 
                    <div class="col-lg-2">  
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalaryborrow -> BORROW_START_DATE) }}</h1>       
                      </div>
                    <div class="col-sm-1 text-right">
                        <label>ถึง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ DateThai($inforSalaryborrow -> BORROW_END_DATE) }}</h1> 
                       </div> 
                    <div class="col-sm-1 text-right">
                        <label>ณ :</label>
                    </div> 
                    <div class="col-lg-4"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AT_LOCATION }}</h1>        
                       </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_HR_PERSON_NAME }} </h1>        
                     
                        </select>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-3"> 
                    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_HR_DEP_SUB_SUB_NAME }}</h1>        
                            
                    
                  
                    </div>       
                   
                    </div>       
                   
            <br> 
                                                    <div class="modal-footer">
                                                    <div align="right">
                                                    <button type="submit" name = "SUBMIT"  style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-success btn-lg" value="approved" >เห็นชอบ</button>
                                                    <button type="submit"  name = "SUBMIT" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-danger btn-lg" value="not_approved" >ไม่เห็นชอบ</button>
                                                    <button type="button" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>

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



function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}

datepick()
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