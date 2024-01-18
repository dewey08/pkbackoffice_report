@extends('layouts.backend')

    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}

 .text-pedding{
   padding-left:10px;
}


.text-font {
    font-size: 14px;
}
</style>

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






$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}



?>
<?php



  function DateThaihead($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));


  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strMonthThai $strYear";
  }


  function satsun($date)
{
  $DayOfWeek = date("w", strtotime($date));


   if($DayOfWeek  == 0 || $DayOfWeek  == 6){
        $resultcoller = '#FF9999';
   }else{
        $resultcoller = '#99FFFF'; 
   }

  return $resultcoller;

}

use App\Http\Controllers\OperateController;

        $checkver = OperateController::checkoperate_ver($user_id);
        $checkallow =  OperateController::checkoperate_allow($user_id);

?>


                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div>
                                <a href="{{ url('general_operate/genoperateindex/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตารางเวรปฏิบัติงาน
                                </a>
                                </div>
                                <div>&nbsp;</div>

                                <div>
                                <a href="{{ url('general_operate/genoperateindexset/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จัดเวร

                                </a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_operate/genoperateswap/'.$inforpersonuserid->ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#4682B4;color:#F0FFFF;">แลกเวร
                                </a>
                                </div>

                                <div>&nbsp;</div>
                                @if($checkver > 0)
                                <div>
                                <a href="{{ url('general_operate/genoperateindexver/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#00BFFF;color:#F0FFFF;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif
                                @if($checkallow > 0)
                                <div>
                                <a href="{{ url('general_operate/genoperateindexapp/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ

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

                   
                    <div class="col-xl-14">
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ขัอมูลการขอแลกเวร</B></h3>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> ขอแลกเวร</button>
                        </div>
                        <div class="table-responsive">
                          
                         
                            <table border="1" style="border-color: #000000;"  width="100%">
                                <thead >
                                    <tr>
                                        <th class="text-center" width="1%" style="background-color: #FFFFCC;">ลำดับ</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">หน่วยงาน</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">ผู้แลกเปลี่ยนเวร</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">ผู้รับเปลี่ยนเวร</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">วันที่ปฏิบัติหน้าที่</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">เวรที่ขอเปลี่ยน</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">วันที่ปฏิบัติหน้าที่แทน</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">เวรที่ปฏิบัติหน้าที่แทน</th>
                                        <th class="text-center" width="5%" style="background-color: #FFFFCC;">เหตุผล</th>
                                        <th class="text-font" style="border-color:black;text-align: center;background-color: #FFFFCC;" width="8%">คำสั่ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                    <?php $number = 0 ; ?>    
                                    @foreach ($operateswaps as $operateswap)
                                    <?php  $number++?>

                                        <tr>
                                            <td align="center"  >{{$number}}</td>
                                            <td class="text-pedding text-font">{{$operateswap->OPSWAP_DEP_NAME}}</td>
                                            <td class="text-pedding text-font">{{$operateswap->OPSWAP_PERSON_1_NAME}}</td>
                                            <td class="text-pedding text-font">{{$operateswap->OPSWAP_PERSON_2_NAME}}</td>
                                            <td class="text-pedding text-font">{{Datethai($operateswap->OPSWAP_DATE_1)}}</td>
                                            <td class="text-pedding text-font">{{$operateswap->OPSWAP_JOB_1}}</td>
                                            <td class="text-pedding text-font">{{Datethai($operateswap->OPSWAP_DATE_2)}}</td>
                                            <td class="text-pedding text-font">{{$operateswap->OPSWAP_JOB_2}}</td>
                                            <td class="text-pedding text-font">{{$operateswap->OPSWAP_REMARK}}</td>    
                                            <td align="center" width="5%">
                                                <div class="dropdown ">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;">                                            
                                                        ทำรายการ                                           
                                                    </button>                                          
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">  
                                
                                                            <a class="dropdown-item" href="#edit_modal{{ $operateswap->OPSWAP_ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-info-circle text-info mr-2"></i>รายละเอียด/แก้ไข</a> 
                                                            <a class="dropdown-item"  href="{{ url('general_operate/infogenoperateswap_pdf/'.$operateswap->OPSWAP_ID ) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank" ><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบแลกเวร</a> 
                                                            <a class="dropdown-item"  href="{{ url('general_operate/infogenoperatechange_pdf/'.$operateswap->OPSWAP_ID) }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank" ><i class="fas fa-print text-info mr-2"></i>พิมพ์ใบเปลี่ยนเวร</a> 
                                                   
                                                        
                                                    </div>
                                                </div>                                       
                                            </td> 
                                        
                                        
                                        </tr>
                            <!--select2 modal form edit  -->
                            <script>
                              $(document).ready(function() {
                                $("#OPSWAP_DEP{{ $operateswap->OPSWAP_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{ $operateswap->OPSWAP_ID}}") 
                                });
                                $("#OPSWAP_JOB_2{{ $operateswap->OPSWAP_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{ $operateswap->OPSWAP_ID}}") 
                                });
                                $("#OPSWAP_JOB_1{{ $operateswap->OPSWAP_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{ $operateswap->OPSWAP_ID}}") 
                                });
                                $("#OPSWAP_PERSON_1{{ $operateswap->OPSWAP_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{ $operateswap->OPSWAP_ID}}") 
                                });
                                $("#OPSWAP_PERSON_2{{ $operateswap->OPSWAP_ID}}").select2({ 
                                    dropdownParent: $("#edit_modal{{ $operateswap->OPSWAP_ID}}") 
                                });
                              });
                            </script>
                            <!--end select2 modal form edit  -->         
<div id="edit_modal{{ $operateswap->OPSWAP_ID}}" class="modal fade" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เแก้ไข รายการขอแลกเวร</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('operate.genoperateswap_update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}">
                <input type="hidden" name="OPSWAP_ID" id="OPSWAP_ID" value="{{$operateswap->OPSWAP_ID}}">
                
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >หน่วยงาน</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_DEP"  id="OPSWAP_DEP{{ $operateswap->OPSWAP_ID}}"  class="form-control input-lg " style="width: 100%;">
                <option value=" " >--เลือกหน่วยงาน--</option>
                @foreach ($infodepsubsubs as $infodepsubsub)
                            @if($infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID == $operateswap->OPSWAP_DEP)
                                <option value=" {{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @else
                                <option value=" {{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @endif
                    @endforeach 
           </select>
    
       </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >ผู้แลกเปลี่ยนเวร</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_PERSON_1"  id="OPSWAP_PERSON_1{{ $operateswap->OPSWAP_ID}}"  class="form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกผู้เปลี่ยนเวร--</option>
                @foreach ($infopersons as $infoperson)
                    @if($infoperson->ID == $operateswap->OPSWAP_PERSON_1)
                    <option value=" {{ $infoperson->ID }}" selected>{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                    @else
                    <option value=" {{ $infoperson->ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                    @endif
                @endforeach 
           </select>
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >ผู้รับเปลี่ยนเวร</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_PERSON_2"  id="OPSWAP_PERSON_2{{ $operateswap->OPSWAP_ID}}"  class="form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกผู้รับเปลี่ยนเวร--</option>
                @foreach ($infopersons as $infoperson)
                   @if($infoperson->ID == $operateswap->OPSWAP_PERSON_2)
                   <option value=" {{ $infoperson->ID }}" selected>{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                   @else
                    <option value=" {{ $infoperson->ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                    @endif
                @endforeach 
           </select>
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >วันที่ปฏิบัติหน้าที่</label>
        </div>
        <div class="col-sm-9">
            <input  name = "OPSWAP_DATE_1"  id="OPSWAP_DATE_1" value="{{formate($operateswap->OPSWAP_DATE_1)}}"class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >เวรที่ขอเปลี่ยน</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_JOB_1"  id="OPSWAP_JOB_1{{ $operateswap->OPSWAP_ID}}"  class="form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกผู้รับเปลี่ยนเวร--</option>
                @foreach ($infojobs as $infojob)
                     @if($infojob->OPERATE_JOB_NAME == $operateswap->OPSWAP_JOB_1)
                     <option value=" {{ $infojob->OPERATE_JOB_NAME }}" selected>{{ $infojob -> OPERATE_JOB_NAME }}</option>
                     @else
                    <option value=" {{ $infojob->OPERATE_JOB_NAME }}" >{{ $infojob -> OPERATE_JOB_NAME }}</option>
                    @endif
                    @endforeach 
           </select>
        </div>
        </div>
        </div>


        <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >เหตุผล</label>
            </div>
            <div class="col-sm-9">
                <input  name = "OPSWAP_REMARK"  id="OPSWAP_REMARK"  value="{{ $operateswap->OPSWAP_REMARK}}" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>

            <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >วันที่ปฏิบัติหน้าที่แทน</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "OPSWAP_DATE_2"  id="OPSWAP_DATE_2" value="{{formate($operateswap->OPSWAP_DATE_2)}}" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                </div>
                </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >เวรที่ปฏิบัติหน้าที่แทน</label>
                    </div>
                    <div class="col-sm-9">
                        <select name = "OPSWAP_JOB_2"  id="OPSWAP_JOB_2{{ $operateswap->OPSWAP_ID}}"  class="form-control input-lg" style="width: 100%;">
                            <option value=" " >--เลือกผู้รับเปลี่ยนเวร--</option>
                            @foreach ($infojobs as $infojob)
                        @if($infojob->OPERATE_JOB_NAME == $operateswap->OPSWAP_JOB_2)
                        <option value=" {{ $infojob->OPERATE_JOB_NAME }}" selected>{{ $infojob -> OPERATE_JOB_NAME }}</option>
                        @else
                        <option value=" {{ $infojob->OPERATE_JOB_NAME }}" >{{ $infojob -> OPERATE_JOB_NAME }}</option>
                        @endif
                    
                    @endforeach 
                       </select>
                    </div>
                    </div>
                    </div>
     
                           
        </div>
          <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
          <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
          </div>
          </div>
          </form>  
            </div>





                              @endforeach
                               

                                </tbody>
                            </table>
                            <br>

                        
                        </div>
</div>






    
<div class="modal fade add" id="add_operate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> เพิ่ม ขอแลกเวร</h2>
          </div>
          <div class="modal-body">
          <body>
            <form method="post" action="{{ route('operate.genoperateswap_save') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="USER_ID" id="USER_ID" value="{{$inforpersonuserid->ID}}">
     
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >หน่วยงาน</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_DEP"  id="OPSWAP_DEP"  class="js-select2 form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกหน่วยงาน--</option>
                @foreach ($infodepsubsubs as $infodepsubsub)
                    <option value=" {{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_ID }}" >{{ $infodepsubsub->HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                    @endforeach 
           </select>
    
       </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >ผู้แลกเปลี่ยนเวร</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_PERSON_1"  id="OPSWAP_PERSON_1"  class="js-select2 form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกผู้เปลี่ยนเวร--</option>
                @foreach ($infopersons as $infoperson)
                    <option value=" {{ $infoperson->ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                @endforeach 
           </select>
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >ผู้รับเปลี่ยนเวร</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_PERSON_2"  id="OPSWAP_PERSON_2"  class="js-select2 form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกผู้รับเปลี่ยนเวร--</option>
                @foreach ($infopersons as $infoperson)
                    <option value=" {{ $infoperson->ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>
                @endforeach 
           </select>
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >วันที่ปฏิบัติหน้าที่</label>
        </div>
        <div class="col-sm-9">
            <input  name = "OPSWAP_DATE_1"  id="OPSWAP_DATE_1" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-3 text-left">
        <label >เวรที่ขอเปลี่ยน</label>
        </div>
        <div class="col-sm-9">
            <select name = "OPSWAP_JOB_1"  id="OPSWAP_JOB_1"  class="js-select2 form-control input-lg" style="width: 100%;">
                <option value=" " >--เลือกผู้รับเปลี่ยนเวร--</option>
                @foreach ($infojobs as $infojob)
                    <option value=" {{ $infojob->OPERATE_JOB_NAME }}" >{{ $infojob -> OPERATE_JOB_NAME }}</option>
                    @endforeach 
           </select>
        </div>
        </div>
        </div>


        <div class="form-group">
            <div class="row">
            <div class="col-sm-3 text-left">
            <label >เหตุผล</label>
            </div>
            <div class="col-sm-9">
                <input  name = "OPSWAP_REMARK"  id="OPSWAP_REMARK" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
            </div>
            </div>
            </div>

            <div class="form-group">
                <div class="row">
                <div class="col-sm-3 text-left">
                <label >วันที่ปฏิบัติหน้าที่แทน</label>
                </div>
                <div class="col-sm-9">
                    <input  name = "OPSWAP_DATE_2"  id="OPSWAP_DATE_2" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                </div>
                </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >เวรที่ปฏิบัติหน้าที่แทน</label>
                    </div>
                    <div class="col-sm-9">
                        <select name = "OPSWAP_JOB_2"  id="OPSWAP_JOB_2"  class="js-select2 form-control input-lg" style="width: 100%;">
                            <option value=" " >--เลือกผู้รับเปลี่ยนเวร--</option>
                            @foreach ($infojobs as $infojob)
                    <option value=" {{ $infojob->OPERATE_JOB_NAME }}" >{{ $infojob -> OPERATE_JOB_NAME }}</option>
                    @endforeach 
                       </select>
                    </div>
                    </div>
                    </div>
     
                           
        </div>
          <div class="modal-footer">
          <div align="right">
            <button type="submit" class="btn btn-hero-sm btn-hero-info"><i
                class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
          <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
          </div>
          </div>
          </form>  
            </div>





@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>

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
$(document).ready(function() {
   $(".js-select2 ").select2({ 
	dropdownParent: $("#add_operate") 
    
	});
});
</script>
<script>
   $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });



    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}


</script>




@endsection
