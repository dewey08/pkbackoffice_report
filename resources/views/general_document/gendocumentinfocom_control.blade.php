@extends('layouts.backend')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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



use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ManagerbookController;

$idbook = $infobookreceiptview->BOOK_ID;
$checkbook = DocumentController::checkmanagerbookinfocom($idbook,$user_id);
$checkmanagerbookoffer = ManagerbookController::checkmanagerbookoffer($id_user);
$checkmanagerbookretire = ManagerbookController::checkmanagerbookretire($id_user);


if($checkbook == 0 ){
    echo "คุณไม่มีสิทธิ์เข้าถึงเอกสาร.";
    exit();
}
?>
<?php  
  $m_budget = date("m");
  //$m_budget = 10;
 // echo $m_budget; 
  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }
  //echo $yearbudget;

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
    font-size: 14px;
                  }   
      }


  
#pages{
    text-align: center;
}
.page{
    width: 90%;
    margin: 10px;
    box-shadow: 0px 0px 5px #000;
    animation: pageIn 1s ease;
    transition: all 1s ease, width 0.2s ease;
}
@keyframes pageIn{
  0%{
      transform: translateX(-300px);
      opacity: 0;
  }
  100%{
      transform: translateX(0px);
      opacity: 1;
  }
}
#zoom-in{
    
}
#zoom-percent{
    display: inline-block;
}
#zoom-percent::after{
    content: "%";
}
#zoom-out{
    
}
      
       
</style>

<br>
<br>
<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;text-align: left; font-size:16px;" ><B>เลขที่คำสั่ง</B> {{$infobookreceiptview->BOOK_NUMBER}}     <B>เรื่อง</B> {{$infobookreceiptview->BOOK_NAME}}      <B>ส่งจากหน่วยงาน</B> {{$infobookreceiptview->RECORD_ORG_NAME}} </h3>

</div>

<form  method="post" action="{{ route('document.sendcomdoc') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf
  
<div class="block-content block-content-full">
<div class="row">
   <div class="col-md-7" style="text-align: left">
 
   <div style="text-align:center">

   @if($infobookreceiptview->BOOK_FILE_NAME == '' || $infobookreceiptview->BOOK_FILE_NAME == null)
         ไม่มีข้อมูลไฟล์อัปโหลด 
   @else
   <?php list($a,$b,$c,$d) = explode('/',$url); ?>
    <iframe src="{{ asset('storage/bookpdf/'.$infobookreceiptview->BOOK_FILE_NAME) }}" height="680px" width="100%"></iframe>

   @endif

  
</div>

   </div>
   

   <div class="col-md-5">
       <!-- <div align="right">
         @if($checkmanagerbookoffer != 0)
        <a class="btn btn-hero-sm btn-hero-info" href="#send_modal"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เสนอผู้อำนวยการ</a>
         @endif 
         @if($checkmanagerbookretire != 0)                 
        <a class="btn btn-success btn-lg" href="#retire_modal"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เกษียณหนังสือ</a>
        @endif
        </div>    
    
       <br>-->

        <div class="row" >

        
                                    <div class="block block-rounded block-bordered" style="width:100%;height:auto;">
                                 <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFE4C4;">
                                   <!-- <li class="nav-item">
                                        <a class="nav-link " href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">เสนอ ผอ.</a>
                                    </li>-->
                              
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งกลุ่มงาน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งฝ่าย/แผนก</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งหน่วยงาน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งบุคคล</a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ส่งองค์กร</a>
                                    </li>        
                                                  
                                  
                                </ul>
                                <div class="block-content tab-content">
                                <div class="tab-pane" id="object1" role="tabpanel">
                       
                               
                                <div class="row">
                                    <div class="col" style="height:130px;">
                                     <p style="text-align: left;"><b>ความเห็นที่ 1</b></p>
                                </div>
                                <div class="col-md-9" style="text-align: left;background-color: #F0F8FF;">
                                {{ $sendleaderdetail }}
                                 </div>
                                </div>
                                 <br>  
                                <div class="row">
                                    <div class="col">
                                     <p style="text-align: left;"><b>ผู้เสนอ</b></p>
                                </div>
                                <div class="col-md-9" style="text-align: left">
                                    {{ $sendleaderhrname }}
                                 </div>
                                </div>
                                <BR>
                                <div class="row">
                                    <div class="col" style="height:130px;">
                                     <p style="text-align: left;"><b>ความเห็นที่ 2</b></p>
                                </div>
                                <div class="col-md-9" style="text-align: left;background-color: #F0F8FF;">
                                {{ $sendleaderdetail2 }}
                                 </div>
                                </div>
                                <BR>
                                <div class="row">
                                    <div class="col" >
                                     <p style="text-align: left;"><b>ผู้เสนอ</b></p>
                                </div>
                                <div class="col-md-9" style="text-align: left">
                                {{ $sendleaderhrname2 }}
                                 </div>
                                </div>
                                

                                 </div>
                         
        
                                    <div class="tab-pane active" id="object3" role="tabpanel">
                                    <div align="right"><a class="btn btn-hero-sm btn-hero-info"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;color:#FFFFFF;" onclick="departmentrow3()"><i class="fas fa-plus"></i> เพิ่มทั้งหมด</a><br><br></div>
                                    <div style='overflow:scroll; height:75%;'>
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">กลุ่มงาน</td>
                                               
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow3" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody_sub3">

                                        @if($checksendinfordepartment != 0)

                                        <?php $number_3 =0; ?>    
                                        @foreach ($inforsenddepartments as $inforsenddepartment)
                                        <?php $number_3++; ?>    
                                        <tr>
                                        <td> 
                                        <select name="row3[]" id="row3{{$number_3}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--กรุณาเลือกกลุ่มงาน--</option>
                                                            @foreach ($infordepartments as $infordepartment) 
                                                            @if($infordepartment->HR_DEPARTMENT_ID == $inforsenddepartment ->HR_DEPARTMENT_ID)                                                    
                                                            <option value="{{ $infordepartment->HR_DEPARTMENT_ID }}" selected>{{$infordepartment->HR_DEPARTMENT_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infordepartment->HR_DEPARTMENT_ID }}">{{$infordepartment->HR_DEPARTMENT_NAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                            

                                    @endforeach 


                                        @endif   
                                    
                                    </tbody>   
                                    </table>




                                  

                                    </div> 
                             </div>

                                <div class="tab-pane" id="object4" role="tabpanel"> 
                                  
                                <div align="right"><a class="btn btn-hero-sm btn-hero-info"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;color:#FFFFFF;" onclick="departmentrow4()"><i class="fas fa-plus"></i> เพิ่มทั้งหมด</a><br><br></div>
                                <div style='overflow:scroll; height:410px;'>

                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">ฝ่าย/แผนก</td>
                                               
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow4" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody_sub4">

                                        @if($checksendinfordepartmentsub != 0)

                                        <?php $number_4 =0; ?>   
                                        @foreach ($inforsenddepartmentsubs as $inforsenddepartmentsub)
                                        <?php $number_4++; ?>    
                                        <tr>
                                        <td> 
                                        <select name="row4[]" id="row4{{$number_4}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--กรุณาเลือกฝ่าย/แผนก--</option>
                                                            @foreach ($infordepartmentsubs as $infordepartmentsub) 
                                                            @if($infordepartmentsub->HR_DEPARTMENT_SUB_ID == $inforsenddepartmentsub ->HR_DEPARTMENT_SUB_ID)                                                    
                                                            <option value="{{ $infordepartmentsub->HR_DEPARTMENT_SUB_ID }}" selected>{{$infordepartmentsub->HR_DEPARTMENT_SUB_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infordepartmentsub->HR_DEPARTMENT_SUB_ID }}">{{$infordepartmentsub->HR_DEPARTMENT_SUB_NAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                               

                                    @endforeach 


                                        @endif   
                                    
                                    </tbody>   
                                    </table>

                                    </div> 

                                 </div>

                                    <div class="tab-pane" id="object5" role="tabpanel">
                                    <div align="right"><a class="btn btn-hero-sm btn-hero-info"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;color:#FFFFFF;" onclick="departmentrow5()"><i class="fas fa-plus"></i> เพิ่มทั้งหมด</a><br><br></div>
                                    <div style='overflow:scroll; height:420px;'>
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">หน่วยงาน</td>
                                               
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow5" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody_sub5">
                                        @if($checksendinfordepartmentsubsub != 0)

                                        <?php $number_5 =0; ?>  
                                        @foreach ($inforsenddepartmentsubsubs as $inforsenddepartmentsubsub)
                                        <?php $number_5++; ?> 
                                        <tr>
                                        <td> 
                                        <select name="row5[]" id="row5{{$number_5}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--กรุณาเลือกหน่วยงาน--</option>
                                                            @foreach ($infordepartmentsubsubs as $infordepartmentsubsub) 
                                                            @if($infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID == $inforsenddepartmentsubsub ->HR_DEPARTMENT_SUB_SUB_ID)                                                    
                                                            <option value="{{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID }}" selected>{{$infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_ID }}">{{$infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-danger remove5" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                                 

                                    @endforeach 


                                        @endif   
                                    
                                    </tbody>   
                                    </table>     

                                    </div> 
                            </div>  

                                  
                                
                              
                                    <div class="tab-pane" id="object6" role="tabpanel">
                                    <div style='overflow:scroll; height:80%;'>
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;border: 1px solid black;">ชื่อ สกุล</td>
                                               
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1">

                                        @if($checksendbookper != 0)

                                        <?php $checkper = 0; ?>
                                        @foreach ($infosendbooks as $infosendbook)
                                        <tr>
                                        <td> 
                                        <select name="MEMBER_ID[]" id="MEMBER_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--กรุณาเลือกผู้รับ--</option>
                                                            @foreach ($inforpositions as $inforposition) 
                                                            @if($inforposition->ID == $infosendbook ->HR_PERSON_ID)                                                    
                                                            <option value="{{ $inforposition->ID }}" selected>{{$inforposition->HR_FNAME}} {{$inforposition->HR_LNAME}}</option>
                                                            @else
                                                            <option value="{{ $inforposition->ID }}">{{$inforposition->HR_FNAME}} {{$inforposition->HR_LNAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $checkper++; ?>               

                                    @endforeach 


                                        @endif   
                                    
                                    </tbody>   
                                    </table>




                                  

                                    </div> 
                                    </div> 

                                    <div class="tab-pane" id="object7" role="tabpanel">
                                    <div style='overflow:scroll; height:80%;'>
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
        <tr>
                                                <td style="text-align: center;border: 1px solid black;">ชื่อองค์กร</td>
                                               
                                                <td style="text-align: center;border: 1px solid black;" width="12%"><a  class="btn btn-success addRow7" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody7">

                                        @if($checksendbookorg != 0)

                                        <?php $checkorg = 0; ?>
                                        @foreach ($infosendbookorgs as $infosendbookorg)
                                        <tr>
                                        <td> 
                                        <select name="ORG_ID[]" id="ORG_ID{{$checkorg}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                        <option value="">--กรุณาเลือกองค์กร--</option>
                                                            @foreach ($infororgs as $infororg) 
                                                            @if($infororg->RECORD_ORG_ID == $infosendbookorg ->ORG_ID)                                                    
                                                            <option value="{{ $infororg->RECORD_ORG_ID }}" selected>{{$infororg->RECORD_ORG_NAME}}</option>
                                                            @else
                                                            <option value="{{ $infororg->RECORD_ORG_ID }}">{{$infororg->RECORD_ORG_NAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>
                                      
                                        <td style="text-align: center;"><a class="btn btn-danger remove7" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php $checkorg++; ?>               

                                    @endforeach 


                                        @endif   
                                    
                                    </tbody>   
                                    </table>




                                  

                                    </div> 
                                    </div> 
                                </div>
                                </div>
                                </div>
                        
                   
      <!--  <div class="row">
            <div class="col" style="height:130px;">
            <p style="text-align: left;"><b>ความเห็น ผอ.</b></p>
            </div>
            <div class="col-md-9" style="text-align: left;background-color: #FFF8DC;">
            {{ $sendleader }}
            </div>
          
        </div> -->
        </div>           

   <input type="hidden"  name="BOOK_ID" id="BOOK_ID" value="{{$infobookreceiptview->BOOK_ID}}">
   <input type="hidden" name="SEND_BY_ID" id="SEND_BY_ID" value="{{ $infobooksend -> ID }}">
   <input type="hidden" name="SEND_BY_NAME" id="SEND_BY_NAME" value="{{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}">
   <input  type="hidden" name="ID_USER" id="ID_USER" value="{{$iduser}}">

</div>
<br>
<div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >ส่งต่อ</button>
        <a  href="{{ url('general_document/genodocdocumentcom/'.$iduser) }}" class="btn btn-hero-sm btn-hero-danger"  style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;">ยกเลิก</a>
        </div>

</form>

<!---================================================================--->
<div id="send_modal" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
    <div class="row">
    
    <div>&nbsp;&nbsp;&nbsp;<b>เสนอผู้อำนวยการ หนังสือเลขที่ {{ $infobookreceiptview -> BOOK_NUMBER }}</b>&nbsp;&nbsp;&nbsp;&nbsp;</div>
 
    </div>
        </div>
        <div class="modal-body">

   <form action="{{ route('document.saverpresentcomdoc') }}" method="post">
@csrf
  
 
  
        <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col-md-2" style="text-align: left">
            <b>ชื่อเรื่อง</b>
            </div>
            <div class="col-md-9" style="text-align: left">
           {{ $infobookreceiptview->BOOK_NAME}}
            </div>
          
        </div>
      
    
        <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col"style="text-align: left" >
            <b>จากหน่วยงาน</b>
            </div>
            <div class="col-md-9" style="text-align: left">
            {{$infobookreceiptview->RECORD_ORG_NAME}}
            </div>
         
           
        </div>
        <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col" style="text-align: left">
            <b>ผู้บันทึก</b>
            </div>
            <div class="col-md-9" style="text-align: left">
            {{ $infobookreceiptview -> HR_PREFIX_NAME }}   {{ $infobookreceiptview -> HR_FNAME }}  {{ $infobookreceiptview -> HR_LNAME }}
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col" style="text-align: left">
            <b>รายละเอียด</b>
            </div>
            <div class="col-md-9" style="text-align: left">
            {{ $infobookreceiptview->BOOK_DETAIL}}
            
            </div>
           
           
        </div>
       <br>
        <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col-md-2">
            <p style="text-align: left"><b>ความเห็นที่1</b></p>
            </div>
            <div class="col-md-6">
            @if($iduser == $sendleaderdetailid || $sendleaderdetailid == '')
            <textarea  name = "SEND_LD_DETAIL"  id="SEND_LD_DETAIL" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;">{{ $sendleaderdetail }}</textarea>
            @else
            <textarea  name = "SEND_LD_DETAIL"  id="SEND_LD_DETAIL" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;" readonly>{{ $sendleaderdetail }}</textarea>
            @endif
          
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col">
            <p style="text-align: left"><b>ผู้เสนอ</b></p>
            </div>
            <div class="col-md-9" style="text-align: left">

            @if($checksendleader != 0)
              
              @if($sendleaderdetailid == '')
              {{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}
              @else
              {{$sendleaderhrname}}
              @endif

           @else
           {{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}
           @endif 

            </div>
           
        </div>
        <br>  
        <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col-md-2">
            <p style="text-align: left"><b>ความเห็นที่2</b></p>
            </div>
            <div class="col-md-6">
         @if($checksendleader != 0)
              
            @if($iduser == $sendleaderdetailid2 || $sendleaderdetailid2 == '')
            <textarea  name = "SEND_LD_DETAIL_2"  id="SEND_LD_DETAIL_2" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;">{{ $sendleaderdetail2 }}</textarea>
            @else
            <textarea  name = "SEND_LD_DETAIL_2"  id="SEND_LD_DETAIL_2" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;" readonly>{{ $sendleaderdetail2 }}</textarea>
            @endif
        @else
        <textarea  name = "SEND_LD_DETAIL_2"  id="SEND_LD_DETAIL_2" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;" readonly></textarea>
        @endif
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-md-1" style="text-align: left">
            &nbsp;
            </div>
            <div class="col">
            <p style="text-align: left"><b>ผู้เสนอ</b></p>
            </div>
            <div class="col-md-9" style="text-align: left">
            
            @if($checksendleader != 0)
              
                @if($sendleaderdetailid2 == '')
                {{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}
                @else
                {{$sendleaderhrname2}}
                @endif

    
             @endif 

            </div>
           
        </div>
           


   
            <input type="hidden"  name="BOOK_ID" id="BOOK_ID" value="{{$infobookreceiptview->BOOK_ID}}">
            <input  type="hidden" name="ID_USER" id="ID_USER" value="{{$iduser}}">
          
            @if($checksendleader != 0)
              
               @if($sendleaderdetailid == '')
                <input type="hidden" name = "SEND_LD_BY_HR_ID"  id="SEND_LD_BY_HR_ID" value="{{ $infobooksend -> ID }}">
                <input type="hidden" name = "SEND_LD_BY_HR_NAME"  id="SEND_LD_BY_HR_NAME" value="{{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}">
               @else
                <input type="hidden" name = "SEND_LD_BY_HR_ID"  id="SEND_LD_BY_HR_ID" value="{{ $sendleaderdetailid }}">
                <input type="hidden" name = "SEND_LD_BY_HR_NAME"  id="SEND_LD_BY_HR_NAME" value="{{ $sendleaderhrname }}">

               @endif 
             
             @else
                <input type="hidden" name = "SEND_LD_BY_HR_ID"  id="SEND_LD_BY_HR_ID" value="{{ $infobooksend -> ID }}">
                <input type="hidden" name = "SEND_LD_BY_HR_NAME"  id="SEND_LD_BY_HR_NAME" value="{{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}">
             @endif 

             @if($checksendleader != 0)
               
                @if($sendleaderdetailid2 == '')
                 <input type="hidden" name = "SEND_LD_BY_HR_ID_2"  id="SEND_LD_BY_HR_ID_2" value="{{ $infobooksend -> ID }}">
                 <input type="hidden" name = "SEND_LD_BY_HR_NAME_2"  id="SEND_LD_BY_HR_NAME_2" value="{{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}">
                @else
                <input type="hidden" name = "SEND_LD_BY_HR_ID_2"  id="SEND_LD_BY_HR_ID_2" value="{{ $sendleaderdetailid2 }}">
                <input type="hidden" name = "SEND_LD_BY_HR_NAME_2"  id="SEND_LD_BY_HR_NAME_2" value="{{ $sendleaderhrname2 }}">
                @endif

             @else
                 <input type="hidden" name = "SEND_LD_BY_HR_ID_2"  id="SEND_LD_BY_HR_ID_2" value="">
                 <input type="hidden" name = "SEND_LD_BY_HR_NAME_2"  id="SEND_LD_BY_HR_NAME_2" value="">

             @endif 






</div>


  
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>




<!---================================================================--->
<div id="retire_modal" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
     
    <div class="row">
    
    <div>&nbsp;&nbsp;&nbsp;<b>เกษียนหนังสือเลขที่ {{ $infobookreceiptview -> BOOK_NUMBER }}</b>&nbsp;&nbsp;&nbsp;&nbsp;</div>
 
    </div>
        </div>
        <div class="modal-body">

     
  
  
   <form action="{{ route('document.saveretirecomdoc') }}" method="post">
@csrf
  

  
        <div class="row">
        <div class="col-md-2">
            <p style="text-align: left"><b>ชื่อเรื่อง</b></p>
            </div>
            <div class="col-md-4" style="text-align: left">
           {{ $infobookreceiptview->BOOK_NAME}}
            </div>
            <div class="col-md-2">
            <p style="text-align: left"><b>จากหน่วยงาน</b></p>
            </div>
            <div class="col-md-4" style="text-align: left">
            {{$infobookreceiptview->RECORD_ORG_NAME}}
            </div> 
        </div>
        <div class="row">
        <div class="col-md-2">
            <p style="text-align: left"><b>ผู้บันทึก</b></p>
            </div>
            <div class="col-md-4" style="text-align: left">
            {{ $infobookreceiptview -> HR_PREFIX_NAME }}   {{ $infobookreceiptview -> HR_FNAME }}  {{ $infobookreceiptview -> HR_LNAME }}
            </div>
            <div class="col-md-2">
            <p style="text-align: left"><b>รายละเอียด</b></p>
            </div>
            <div class="col-md-4" style="text-align: left">
            <p style="text-align: left">{{ $infobookreceiptview->BOOK_DETAIL}}</p>
            </div>  
        </div>
        <div class="row">
          <div class="col-md-2">
            <p style="text-align: left"><b>ผู้เสนอ</b></p>
            </div>
            <div class="col-md-4" style="text-align: left">
            {{ $infobooksend -> HR_PREFIX_NAME }}   {{ $infobooksend -> HR_FNAME }}  {{ $infobooksend -> HR_LNAME }}
            </div> 
        </div>
        <div class="row">
            <div class="col-md-2">
            <p style="text-align: left"><b>ความเห็น ผอ.</b></p>
            </div>
            <div class="col-md-9" >
            <textarea  name = "TOP_LEADER_AC_CMD"  id="TOP_LEADER_AC_CMD" rows="3" cols="50" class="form-control textarea-sm" style=" font-family: 'Kanit', sans-serif;">{{ $sendleader }}</textarea>
            </div>
           
        </div>
          <input type="hidden" name = "BOOK_ID"  id="BOOK_ID" value="{{ $infobookreceiptview->BOOK_ID }}"> 
          <input  name="SEND_LD_ID" id="SEND_LD_ID" value=" {{$infobookreceiptview->SEND_LD_ID}}">
          <input  type="hidden" name="ID_USER" id="ID_USER" value="{{$iduser}}">
 
          
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>

 
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>


<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script type="text/javascript">
    PDFJS.workerSrc = "{{ asset('pdfupload/pdf_upwork.js') }}";
</script>

<script>

$(document).ready(function() {
        $('select').select2({
            width: '100%' 
        });
});

   function select_use(){
            $('select').select2({
                    width: '100%' 
                });
   }


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


//------------------------------------------------------------------

function departmentrow3(){
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.departmentrow3')}}",
                   method:"GET",
                   data:{_token:_token},
                   success:function(result){
                      $('.tbody_sub3').html(result);
                      select_use();
                   }
           })
     
  }

$('.addRow3').on('click',function(){
         addRow3();
         select_use();
     });

     function addRow3(){
        var count = $('.tbody_sub3').children('tr').length;
         var tr ='<tr>'+
                '<td>'+
                '<select name="row3[]" id="row3'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกกลุ่มงาน--</option>'+
                '@foreach ($infordepartments as $infordepartment)'+                                                   
                '<option value="{{ $infordepartment ->HR_DEPARTMENT_ID  }}">{{ $infordepartment->HR_DEPARTMENT_NAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+ 
               
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove3" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody_sub3').append(tr);
     };

     $('.tbody_sub3').on('click','.remove3', function(){
            $(this).parent().parent().remove();
     });

//------------------------------------------------------------------


function departmentrow4(){
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.departmentrow4')}}",
                   method:"GET",
                   data:{_token:_token},
                   success:function(result){
                      $('.tbody_sub4').html(result);
                      select_use();
                   }
           })
     
  }

$('.addRow4').on('click',function(){
         addRow4();
         select_use();
     });

     function addRow4(){
        var count = $('.tbody_sub4').children('tr').length;
         var tr ='<tr>'+
                '<td>'+
                '<select name="row4[]" id="row4'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกฝ่าย/แผนก--</option>'+
                '@foreach ($infordepartmentsubs as $infordepartmentsub)'+                                                   
                '<option value="{{ $infordepartmentsub ->HR_DEPARTMENT_SUB_ID  }}">{{ $infordepartmentsub->HR_DEPARTMENT_SUB_NAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+ 
               
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove4" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody_sub4').append(tr);
     };

     $('.tbody_sub4').on('click','.remove4', function(){
            $(this).parent().parent().remove();
     });

//------------------------------------------------------------------


function departmentrow5(){
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mbook.departmentrow5')}}",
                   method:"GET",
                   data:{_token:_token},
                   success:function(result){
                      $('.tbody_sub5').html(result);
                      select_use();
                   }
           })
     
  }

$('.addRow5').on('click',function(){
         addRow5();
         select_use();
     });

     function addRow5(){
        var count = $('.tbody_sub5').children('tr').length;
         var tr ='<tr>'+
                '<td>'+
                '<select name="row5[]" id="row5'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกหน่วยงาน--</option>'+
                '@foreach ($infordepartmentsubsubs as $infordepartmentsubsub)'+                                                   
                '<option value="{{ $infordepartmentsubsub ->HR_DEPARTMENT_SUB_SUB_ID  }}">{{ $infordepartmentsubsub->HR_DEPARTMENT_SUB_SUB_NAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+ 
               
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove5" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody_sub5').append(tr);
     };

     $('.tbody_sub5').on('click','.remove5', function(){
            $(this).parent().parent().remove();
     });

//------------------------------------------------------------------
    $('.addRow').on('click',function(){
         addRow();
         select_use();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
                '<td>'+
                '<select name="MEMBER_ID[]" id="MEMBER_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="checkposition('+count+');">'+
                '<option value="">--กรุณาเลือกผู้รับ--</option>'+
                '@foreach ($inforpositions as $inforposition)'+                                                   
                '<option value="{{ $inforposition ->ID  }}">{{ $inforposition->HR_FNAME}} {{$inforposition->HR_LNAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+ 
               
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });


     //------------------------------------------------------------------
    $('.addRow7').on('click',function(){
         addRow7();
         select_use();
     });

     function addRow7(){
        var count = $('.tbody7').children('tr').length;
         var tr ='<tr>'+
                '<td>'+
                '<select name="ORG_ID[]" id="ORG_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="">--กรุณาเลือกองค์กร--</option>'+
                '@foreach ($infororgs as $infororg)'+                                                   
                '<option value="{{ $infororg ->RECORD_ORG_ID  }}">{{$infororg->RECORD_ORG_NAME}}</option>'+
                '@endforeach'+ 
                '</select>'+      
                '</td>'+ 
               
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove7" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
        $('.tbody7').append(tr);
     };

     $('.tbody7').on('click','.remove7', function(){
            $(this).parent().parent().remove();
     });

     
</script>

@endsection