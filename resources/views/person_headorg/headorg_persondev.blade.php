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

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลขออนุมัติไปราชการ</B></h3>
<a href="#modal_allapp" data-toggle="modal"  class="btn btn-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >อนุมัติทั้งหมด</a>
</div>
<div class="block-content block-content-full">


             <form action="{{ route('horg.searchinfoapp') }}" method="post"> 
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

                        @foreach ($grecordstatuss as $grecordstatus)
                        @if($grecordstatus->ID_STATUS == $status_check)
                            <option value="{{ $grecordstatus->ID_STATUS  }}" selected>{{ $grecordstatus->STATUS_NAME}}</option>
                            @else 
                            <option value="{{ $grecordstatus->ID_STATUS  }}">{{ $grecordstatus->STATUS_NAME}}</option>
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
                      <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                      </span>
                      </div>


                  </div>
             </form>
                            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>

                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">สถานะ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ประเภทการไป</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">หนังสืออ้างถึง </th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เรื่อง</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ไปกลับ</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานที่ไป</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">การเดินทาง</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">การเบิกเงิน</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">งบประมาณ</th>
                                        
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">ชื่อผู้บันทึก</th>
                                        



                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">รายละเอียด</th>


                                    </tr >
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($inforrecordindexs as $inforrecordindex)
                                <?php $number++;

                                $status =  $inforrecordindex -> STATUS;
                                if( $status === 'APPLY'){
                                    $statuscol =  "badge badge-warning";

                                }else if($status === 'EDIT'){
                                   $statuscol =  "badge badge-danger";

                                }else if($status === 'RECEIVE'){
                                    $statuscol =  "badge badge-info";
                                }else if($status === 'SUCCESS'){
                                    $statuscol =  "badge badge-success";
                                }else{
                                    $statuscol =  "badge badge-secondary";
                                }





                                ?>

                                    <tr height="20">
                                        <td  class="text-font" align="center">{{$number}}</td>

                                        <td  align="center"><span class="{{$statuscol}}" >{{ $inforrecordindex->STATUS_NAME}}</span></td>
                                        <td class="text-font text-pedding"class="text-font text-pedding">{{ $inforrecordindex->RECORD_TYPE_NAME}}</td>
                                        @if($inforrecordindex->BOOK_NUM == '')
                                        <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ></td>
                                        @else
                                        <td  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" ><span class="btn fa fa-1.5x fa-file-pdf" style="background-color:#FF6347;color:#F0FFFF;"></span></td>
                                        @endif
                                        
                                        <td class="text-font text-pedding">{{$inforrecordindex->RECORD_HEAD_USE}}</td>
                                        <td class="text-font text-pedding">{{DateThai($inforrecordindex -> DATE_GO) }}<br>{{ DateThai($inforrecordindex -> DATE_BACK) }}</td>
                                        <td class="text-font text-pedding">{{$inforrecordindex -> LOCATION_ORG_NAME }}</td>
                                        <td class="text-font text-pedding">{{$inforrecordindex -> RECORD_VEHICLE_NAME }}</td>
                                        <td class="text-font text-pedding">{{$inforrecordindex -> WITHDRAW_NAME }}</td>
                                        <td class="text-font text-pedding" align="right">{{number_format($inforrecordindex -> SUMMONEY,2) }}</td>
                                        <td class="text-font text-pedding">{{$inforrecordindex->USER_POST_NAME}}</td>

                                        <td align="center">
                                        @if($status === 'RECEIVE')
                                        <a href="{{ url('person_headorg/infodevapp_app/'.$inforrecordindex->ID) }}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fa fa-edit"></i></a>
                                        @else
                                        <a href="#detail_modal{{ $inforrecordindex -> ID }}"  data-toggle="modal" class="btn btn-info  fa fa-list"></a>
                                        @endif

                                        </td>



                                    </tr>


                                    <div id="detail_modal{{ $inforrecordindex -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">

          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">

          รายละเอียดการลา {{ $inforrecordindex -> ID }}

          </h2>
        </div>
        <div class="modal-body">

        <div class="row">

       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >หัวข้อประชุม :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group" >
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> RECORD_HEAD_USE }}</h1>
           </div>
       </div>

       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >สถานที่จัดประชุม :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> LOCATION_ORG_NAME }}</h1>
           </div>
       </div>

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >ระดับ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> RECORD_LEVEL_NAME}}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group"  align="right">
           <label >หน่วยงานที่จัด :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> RECORD_ORGANIZER_NAME }}</h1>
           </div>
       </div>
       </div>


       <div class="row">
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >ประเภทสถานที่ประชุม :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> LOCATION_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >ระหว่างวันที่ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ DateThai($inforrecordindex -> DATE_GO) }} ถึง {{ DateThai($inforrecordindex -> DATE_BACK) }}</h1>
           </div>
       </div>
      </div>



       <div class="row">
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >หมายเหตุ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> RECORD_COMMENT }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >ลักษณะ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> RECORD_GO_NAME }}</h1>
           </div>
       </div>

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label > พาหนะเดินทาง :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> RECORD_VEHICLE_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >การเบิกเงิน :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> WITHDRAW_NAME }}</h1>
           </div>
       </div>

       </div>

       <div class="row">
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >หัวหน้าฝ่าย :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> LEADER_HR_NAME }}</h1>
           </div>
       </div>
       <div class="col-sm-2">
           <div class="form-group" align="right">
           <label >มอบหมายงานให้ :</label>
           </div>
       </div>
       <div class="col-sm-3 text-left">
           <div class="form-group">
           <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;" align="left">{{ $inforrecordindex -> OFFER_WORK_HR_NAME }}</h1>
           </div>
       </div>
       </div>



      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="button" class="btn btn-secondary btn-lg" style="font-family: 'Kanit', sans-serif;font-weight:normal;" data-dismiss="modal" >ปิดหน้าต่าง</button>
        </div>
        </div>
        </form>
</body>


    </div>
  </div>
</div>

<!-----------------------------------------ตรวจสอบ----------------------------------->


<div id="app_modal{{ $inforrecordindex -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">

          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">

          อนุมัติข้อมูล ประชุม/อบรม/ดูงาน เลขที่ {{ $inforrecordindex -> ID }}

          </h2>
        </div>
        <div class="modal-body">


        <form  method="post" action="{{ route('horg.updateinfodevapp') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  name="ID" value="{{ $inforrecordindex -> ID }}"/>

        <div class="row">

        <div class="col-sm-2">
            <div class="form-group">
            <label >หัวข้อประชุม :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group" >
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_HEAD_USE }}</h1>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
            <label >สถานที่จัดประชุม :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LOCATION_ORG_NAME }}</h1>
            </div>
        </div>

        </div>

        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >ระดับ :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_LEVEL_NAME}}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label >หน่วยงานที่จัด :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_ORGANIZER_NAME }}</h1>
            </div>
        </div>
        </div>


        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label>ประเภทสถานที่ประชุม :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LOCATION_NAME }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label>ระหว่างวันที่ :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforrecordindex -> DATE_GO) }} ถึง {{ DateThai($inforrecordindex -> DATE_BACK) }}</h1>
            </div>
        </div>
       </div>



        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >หมายเหตุ :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_COMMENT }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label >ลักษณะ :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_GO_NAME }}</h1>
            </div>
        </div>

        </div>

        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label > พาหนะเดินทาง :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> RECORD_VEHICLE_NAME }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label>การเบิกเงิน :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> WITHDRAW_NAME }}</h1>
            </div>
        </div>

        </div>

        <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
            <label >หัวหน้าฝ่าย :</label>
            </div>
        </div>
        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> LEADER_HR_NAME }}</h1>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
            <label >มอบหมายงานให้ :</label>
            </div>
        </div>

        <div class="col-sm-3 text-left">
            <div class="form-group">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforrecordindex -> OFFER_WORK_HR_NAME }}</h1>
            </div>
        </div>
        </div>





     
      <label style="float:left;">หมายเหตุ</label>
      <textarea   name = "APPROVE_COMMENT"  id="APPROVE_COMMENT" class="form-control input-lg" ></textarea>
        <br>
      <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-success btn-lg" value="approved" >อนุมัติ</button>
        <button type="submit"  name = "SUBMIT" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-danger btn-lg" value="not_approved" >ไม่อนุมัติ</button>
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
                                    <a href="{{ url('person_headorg/updateinfodevappall')}}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >ตกลง</a>
                                    <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal"  style="font-family: 'Kanit', sans-serif;font-weight:normal;">ยกเลิก</button>
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
