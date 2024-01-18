@extends('layouts.medical')   
@section('css_before')
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

  
    use App\Http\Controllers\MeetingController;
    use Illuminate\Support\Facades\DB;
    use App\Models\Medical_set_category;

?>
     
@endsection
@section('content')
    
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการจัดซื้อจัดจ้างยาและเวชภัณฑ์</B></h3>
                    <div align="right">

                           <a href="#detail_setup"  data-toggle="modal" class="btn btn-hero-sm btn-hero-warning " style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >กำหนดค่าเริ่มต้น</a>
                           <a href="{{ url('manager_medical/medical_purchase_register/null')  }}"   class="btn btn-hero-sm btn-hero-info" >ออกทะเบียนคุม</a> 
                    </div>
            </div>
            <div class="block-content block-content-full">
            <form action="{{route('mmedical.purchase')}}" method="post">
                @csrf
                <div class="row">  
                    <div class="col-md-0.5">
                            &nbsp;ปีงบ &nbsp;
                        </div>                            
                        <div class="col-md-1">
                        <span>
                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">      

                                     @foreach ($budgetyears as $budgetyear)
                                                @if($budgetyear->LEAVE_YEAR_ID == $year_id)                                                     
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                                @else
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                            @endif
                                                              
                                    @endforeach                           

                                                                                                 
                                    </select>
                        </div> 
              
                        <div class="col-sm-4 date_budget">
                    <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                  
                        <div class="col-sm-4">
                         
                                <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>     
                           
                        </div>
                        <div class="col-sm">
                        ถึง 
                        </div>
                        <div class="col-sm-4">
                   
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
                                    <option value="">ทั้งหมด</option>                               
                                    @foreach ($suppliesstatuss as $suppliesstatus)
                                                @if($suppliesstatus->REGIS_STATUS_ID == $status_check)                                                     
                                            <option value="{{ $suppliesstatus ->REGIS_STATUS_ID  }}" selected>{{ $suppliesstatus->REGIS_STATUS_NAME}}</option>
                                                @else
                                            <option value="{{ $suppliesstatus ->REGIS_STATUS_ID  }}">{{ $suppliesstatus->REGIS_STATUS_NAME}}</option>
                                    @endif
                                                              
                                    @endforeach                                                                                                  
                                    </select>
                        </div> 

                       
                        <div class="col-md-0.5">
                            &nbsp;ค้นหา &nbsp;
                        </div>
                        <div class="col-md-2">
                            <span>                 
                                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-weight:normal;" value="{{$search}}">
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
            </form>
             
            <div class="table-responsive" style="min-height: 450px;"> 
           
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ปีงบ</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ทะเบียนคุม</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">เลขขอซื้อ</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">สถานะ</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ส่งข้อมูล</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่</th>
                            
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >แผนงานโครงการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >บริษัท</th>
                        
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">งบประมาณ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่ตรวจรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">คำสั่ง</th> 
                        </tr> 
                    </thead>
                    <tbody>

                    
                    <?php $number = 0; ?>
                    @foreach ($infosupcons as $inforequest)  

                    <?php $number++;
                    
                    $status =  $inforequest -> REGIS_STATUS_ID;

                    if( $status === 1){
                       $statuscol =  "badge badge-danger";

                   }else if($status === 2){
                      $statuscol =  "badge badge-warning";

                   }else if($status === 3){
                       $statuscol =  "badge badge-info";
                   }else if($status === 4 || $status === 5 || $status === 7){
                       $statuscol =  "badge badge-success";
                   
                   }else{
                       $statuscol =  "badge badge-secondary";
                   }
                    
                   $checktypeuse = Medical_set_category::where('SUP_TYPE_ID','=',$inforequest->SUP_TYPE_ID)->count();
                    ?>

                    @if($checktypeuse > 0)

                        <tr height="20">
                
                            <td class="text-font" align="center" style="vertical-align: top;">{{$number}}</td>
                            <td class="text-font text-pedding" style="vertical-align: top;">{{$inforequest->CON_YEAR_ID}}</td>
                            <td class="text-font text-pedding" style="vertical-align: top;">{{$inforequest->CON_NUM}}</td>
                            <td class="text-font text-pedding" style="vertical-align: top;">{{$inforequest->REQUEST_ID}}</td>
                            <td class="text-font text-pedding" style="vertical-align: top;">
                            
                            <span class="{{$statuscol}}">{{$inforequest->REGIS_STATUS_NAME}}</span>
                            
                            </td>
                            <td class="text-font" align="center" style="vertical-align: top;">-</td>
                            <td class="text-font" align="center" style="vertical-align: top;">{{DateThai($inforequest->DATE_REGIS)}}</td>

                            <td class="text-font text-pedding" style="vertical-align: top;">{{$inforequest->EGP_PLAN_NAME}}</td>
                            <td class="text-font text-pedding" style="vertical-align: top;">{{$inforequest->SUP_TYPE_NAME}}</td> 
                            <td class="text-font text-pedding" style="vertical-align: top;">{{$inforequest->VENDOR_NAME}}</td>
        
                            
                             
                             <td class="text-font text-pedding" align="right" style="vertical-align: top;">{{number_format($inforequest->BUDGET_SUM,5)}}</td>                          
                             @if($inforequest->CHECK_DATE !== '' && $inforequest->CHECK_DATE !== null)
                             <td class="text-font text-pedding">{{DateThai($inforequest->CHECK_DATE)}}</td>
                             @else
                             <td class="text-font text-pedding"> </td>
                             @endif                    
                               <td align="center">
                                   <div class="dropdown">
                                       <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                           ทำรายการ
                                       </button>
                                   <div class="dropdown-menu" style="width:10px">
                                   @if($status !== 8)        
                                                <a class="dropdown-item" href="{{ url('manager_medical/medical_purchaseregister_edit/'.$inforequest -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขทะเบียนคุม</a>
                                                <a class="dropdown-item"  href="{{ url('manager_medical/medical_purchasecancel/'.$inforequest -> ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i class="fas fa-window-close text-danger mr-2"></i>ยกเลิกทะเบียนคุม</a>
                                                -----------------------
                                             
                                                   <a class="dropdown-item" href="{{ url('manager_medical/medical_purchasequotation_add/'.$inforequest->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i class="fas fa-folder-plus text-primary mr-2"></i>เพิ่มใบเสนอราคา</a>
                                                
                                                   
                                                   <a class="dropdown-item" href="{{ url('manager_medical/medical_purchaselist_add/'.$inforequest->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i class="fas fa-folder-plus text-primary mr-2"></i>เพิ่มรายการพัสดุ</a>
                                                
                                                   <a class="dropdown-item" href="{{ url('manager_medical/medical_purchaseorders_add/'.$inforequest->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"><i class="far fa-file-alt text-info mr-2"></i>ออกใบสั่งซื้อ/สั่งจ้าง</a>
   

                                                   <a class="dropdown-item" href="{{ url('manager_medical/medical_purchascheck/'.$inforequest->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">@if($inforequest->REGIS_STATUS_ID == 5)<i class="fas fa-edit text-warning mr-2"></i>แก้ไขตรวจรับ@else <i class="fas fa-clipboard-check text-success mr-2"></i>ตรวจรับ @endif</a>
                                                
                                               
                                                   <a class="dropdown-item"  href="{{ url('manager_medical/medical_purchasequotation_confirm/'.$inforequest->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ต้องการที่ยืนยันตรวจรับรายการ {{$inforequest->CON_NUM}} หรือไม่? ')"><i
                                                    class="fas fa-clipboard-check text-success mr-2"></i>ยืนยันตรวจรับ</a>
                                              
                                                   <a class="dropdown-item" href="{{ url('manager_medical/medical_send_infomation/'.$inforequest->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" onclick="return confirm('ต้องการที่ยืนยันส่งข้อมูลรายการ {{$inforequest->CON_NUM}} หรือไม่? ')"><i
                                                    class="fas fa-chevron-circle-right text-success mr-2"></i>ส่งข้อมูลไปคลัง</a>
                                                
                                                   @endif   
                                                   <a class="dropdown-item"  href="#detail_print"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" onclick="print({{$inforequest->ID}});"><i
                                                    class="fas fa-print text-info mr-2"></i>พิมพ์เอกสาร</a>
                                   </div>
                                   </div>
                               </td> 
                           </tr>  

                           @endif
                        @endforeach   
   
                       </tbody>
                   </table>
                   <div>จำนวน {{$count}} รายการ</div>

                   <div id="detail_print" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                    
                    <div class="row">
                    <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการการสั่งพิมพ์&nbsp;&nbsp;</h3></div>
                    </div>
                        </div>
                        <div class="modal-body" >
                        <body>   
                
                                    
                         <div id="detailprint"></div>
                        
                            
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



<div class="modal fade print" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">

<h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">พิมพ์เอกสาร</h2>
</div>
<div class="modal-body">
<body>

<div class="row">
<div class="col-sm-6" align="left">

<a class="dropdown-item"  href="{{ url('manager_supplies/pdfmemo/export_pdfmemo')}}"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">[1] บันทึกข้อความรายงานการขอซื้อ</a>
</div>
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">คำสั่งแต่งตั้งคณะกรรมการตรวจรับ</a>
</div>

</div>

<div class="row">
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ประกาศผู้ชนะการเสนอราคา</a>
</div>
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">บันทึกข้อความรายงานผลการพิจารณา</a>
</div>

</div>

<div class="row">
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบสั่งซื้อ</a>
</div>
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบตรวจรับ</a>
</div>

</div>

<div class="row">
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">ใบแสดงความบริสุทธิ์ใจ</a>
</div>
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">รายการคุณลักษณะพัสดุ</a>
</div>

</div>

<div class="row">
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">รายการขออนุมัติบัญชีแนบท้าย</a>
</div>
<div class="col-sm-6" align="center">
<a class="dropdown-item"  href=""  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">บันทึกข้อความจ่ายเงิน</a>
</div>

</div>






<div class="modal-footer">
<div align="right">

<button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
</div>
</div>
</form>  
</body>


</div>
</div>
</div>

</div>
</div>
</div>    
</div> 


<div id="detail_setup" class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
      <div class="modal-header">
            
            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"> ตั้งค่าข้อมูลทะเบียนคุม</h2>
          </div>
        
          <div class="modal-body">
          <body>
         <form  method="post" action="{{route('mmedical.purchasesetup')}}" >
          @csrf
        <div class="form-group">
        <div class="row">
        <div class="col-sm-2 text-left">
        <label >วิธีซื้อหรือจ้าง</label>
        </div>
        <div class="col-sm-4">

            <select name="SETUP_BUY_ID" id="SETUP_BUY_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                <option value="" selected>--กรุณาเลือกวิธีซื้อ--</option>
                @foreach ($suppliesbuys as $suppliesbuy) 
                                @if($suppliesbuy->BUY_ID == $infosetup->SETUP_BUY_ID)                   
                                <option value="{{ $suppliesbuy -> BUY_ID }}" selected>{{ $suppliesbuy -> BUY_NAME }}</option>           
                                @else
                                <option value="{{ $suppliesbuy -> BUY_ID }}">{{ $suppliesbuy -> BUY_NAME }}</option>           
                                @endif
    
                                @endforeach  

            </select> 
   
        </div>
        <div class="col-sm-2 text-left">
            <label >เงื่อนไข</label>
            </div>
            <div class="col-sm-4">

                <select name="SETUP_CONDISION_ID" id="SETUP_CONDISION_ID" class="form-control input-sm condition" style=" font-family: 'Kanit', sans-serif;" required>
                    <option value="" selected>--กรุณาเลือกเงื่อนไข--</option>
                    @foreach ($suppliescondisions as $suppliescondision)     
                                    @if($suppliescondision->CONDISION_ID == $infosetup->SETUP_CONDISION_ID)                  
                                    <option value="{{ $suppliescondision -> CONDISION_ID }}" selected>{{ $suppliescondision -> CONDISION_NAME }}</option>           
                                    @else
                                    <option value="{{ $suppliescondision -> CONDISION_ID }}">{{ $suppliescondision -> CONDISION_NAME }}</option>           
                                    @endif
                    
                    
                                    @endforeach  )

                </select> 

       
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-2 text-left">
        <label >เหตุผลการจัดหา</label>
        </div>
        <div class="col-sm-4">
            <textarea name="SETUP_CONDISION_RESION" id="SETUP_CONDISION_RESION" class="form-control reason" style=" font-family: 'Kanit', sans-serif;" rows="2" id="comment">{{$infosetup->SETUP_CONDISION_RESION}}</textarea>
        </div>
        <div class="col-sm-2 text-left">
            <label >วิธีจัดหา</label>
            </div>
            <div class="col-sm-4">
                <select name="SETUP_METHOD_ID" id="SETUP_METHOD_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                    <option value="" selected>--กรุณาเลือกวิธีจัดหา--</option>
                    @foreach ($suppliesmethods as $suppliesmethod)  
                         @if($suppliesmethod -> METHOD_ID == $infosetup->SETUP_METHOD_ID)                  
                        <option value="{{ $suppliesmethod -> METHOD_ID }}" selected>{{ $suppliesmethod -> METHOD_NAME }}</option>           
                        @else
                        <option value="{{ $suppliesmethod -> METHOD_ID }}">{{ $suppliesmethod -> METHOD_NAME }}</option>           
                        @endif
                        @endforeach  
                </select> 
           
            </div>
        </div>
        </div>
       
        <div class="form-group">
        <div class="row">
        <div class="col-sm-2 text-left">
        <label >ประเภทจัดหา</label>
        </div>
        <div class="col-sm-4">
            <select name="SETUP_SUP_TYPE_ID" id="SETUP_SUP_TYPE_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                <option value="">--กรุณาเลือกประเภท--</option>
                @foreach ($suppliestypes as $suppliestype)  
                      @if($suppliestype -> SUP_TYPE_ID == $infosetup->SETUP_SUP_TYPE_ID)
                      <option value="{{ $suppliestype -> SUP_TYPE_ID }}" selected>{{ $suppliestype -> SUP_TYPE_NAME }}</option> 
                      @else
                      <option value="{{ $suppliestype -> SUP_TYPE_ID }}">{{ $suppliestype -> SUP_TYPE_NAME }}</option> 
                      @endif
                              
                    @endforeach  
            </select> 
       
        </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
        <div class="col-sm-2 text-left">
        <label >รายละเอียดพัสดุ</label>
        </div>
        <div class="col-sm-10">
            <input name="SETUP_CON_DETAIL" id="SETUP_CON_DETAIL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosetup->SETUP_CON_DETAIL}}">
        </div>
        </div>
        </div>

        <div class="form-group">
        <div class="row">
        <div class="col-sm-2 text-left">
        <label >การพิจารณา</label>
        </div>
        <div class="col-sm-4">
            
            <select name="SETUP_ASPECT_ID" id="SETUP_ASPECT_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                <option value="" selected>--กรุณาเลือกการพิจารณา--</option>
                @foreach ($suppliesaspects as $suppliesaspect)     
                     @if($suppliesaspect->ASPECT_ID == $infosetup->SETUP_ASPECT_ID)
                     <option value="{{ $suppliesaspect -> ASPECT_ID }}" selected>{{ $suppliesaspect -> ASPECT_NAME }}</option>         
                     @else
                     <option value="{{ $suppliesaspect -> ASPECT_ID }}">{{ $suppliesaspect -> ASPECT_NAME }}</option>         
                    @endif
                    
                    @endforeach  
            </select> 

       
        </div>
        <div class="col-sm-1">
            <label>ต้องการ :</label>
            </div> 
            <div class="col-lg-2">
                <input name="SETUP_DATE_WANT_USE" id="SETUP_DATE_WANT_USE" value="{{formate($infosetup->SETUP_DATE_WANT_USE)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  readonly >
            </div>
            <div class="col-sm-1">
            <label>ประมาณ :</label>
            </div> 
            <div class="col-lg-1 amountdateuse">
                <input name="SETUP_DATE_WANT_COUNT" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosetup->SETUP_ASPECT_ID}}">
            </div>
            <div class="col-lg-1">
            <label>วัน</label>
            </div>
        </div>
        </div>

<div class="form-group">
    <div class="row">
    <div class="col-sm-2 text-left">
    <label >เหตุผลความจำเป็น</label>
    </div>
    <div class="col-sm-10">
        <textarea name="SETUP_RESON_NAME" id="SETUP_RESON_NAME" class="form-control" rows="2" style=" font-family: 'Kanit', sans-serif;" id="comment">{{$infosetup->SETUP_RESON_NAME}}</textarea>
    </div>
    </div>
    </div>

     <div class="form-group">
        <div class="row">
        <div class="col-sm-2 text-left">
        <label >หมวดเงิน</label>
        </div>
        <div class="col-sm-4">
            <select name="SETUP_MONEY_GROUP_ID" id="SETUP_MONEY_GROUP_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                <option value="" selected>--กรุณาเลือกหมวดเงิน--</option>
                @foreach ($suppliesmoneygroups as $suppliesmoneygroup) 
                    @if($suppliesmoneygroup->MONEY_GROUP_ID == $infosetup->SETUP_MONEY_GROUP_ID)
                    <option value="{{ $suppliesmoneygroup -> MONEY_GROUP_ID }}" selected>{{ $suppliesmoneygroup -> MONEY_GROUP_NAME }}</option>           
                    @else
                    <option value="{{ $suppliesmoneygroup -> MONEY_GROUP_ID }}">{{ $suppliesmoneygroup -> MONEY_GROUP_NAME }}</option>           
                    @endif
                   
                @endforeach  
            </select> 
        </div>
        </div>
        </div>
   
        <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ประเภทเงิน</label>
            </div>
            <div class="col-sm-4">
                <select name="SETUP_BUDGET_ID" id="SETUP_BUDGET_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" required>
                    <option value="" selected>--กรุณาเลือกประเภทเงิน--</option>
                    @foreach ($suppliesbudgets as $suppliesbudget)         
                         @if($suppliesbudget -> BUDGET_ID == $infosetup->SETUP_BUDGET_ID)
                         <option value="{{ $suppliesbudget -> BUDGET_ID }}" selected>{{ $suppliesbudget -> BUDGET_NAME }}</option>           
                         @else
                         <option value="{{ $suppliesbudget -> BUDGET_ID }}">{{ $suppliesbudget -> BUDGET_NAME }}</option>           
                         @endif
                       
                    @endforeach  
                </select> 
            </div>
            </div>
        </div>

           <div class="form-group">
            <div class="row">
            <div class="col-sm-2 text-left">
            <label >ชื่อผู้อนุมัติจ่าย :</label>
            </div>
            <div class="col-sm-4">
                <select name="SETUP_PURCHASE_LEADER_ID" id="SETUP_PURCHASE_LEADER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกชื่อผู้อนุมัติจ่าย--</option>
                            @foreach ($infopersons as $infoperson) 
                                    @if( $infoperson ->ID == $infosetup->SETUP_PURCHASE_LEADER_ID)
                                    <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>  
                                    @else
                                    <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>  
                                    @endif
                                    
                            @endforeach 
                    </select>
            </div>
            <div class="col-sm-2 text-left">
                <label >เจ้าหน้าที่พัสดุ :</label>
                </div>
                <div class="col-sm-4">
                    <select name="SETUP_PURCHASE_OFFICER_ID" id="SETUP_PURCHASE_OFFICER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--กรุณาเลือกชื่อเจ้าหน้าที่พัสดุ--</option>
                                @foreach ($infopersons as $infoperson)   
                                         @if($infoperson ->ID == $infosetup->SETUP_PURCHASE_OFFICER_ID)
                                         <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                         @else
                                         <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                         @endif
                                        
                                       
                                @endforeach 
                        </select>
                </div>
            </div>
            </div>
            </div>

            <div class="form-group">
                <div class="row">
                <div class="col-sm-2 text-left">
                <label >หัวหน้าเจ้าหน้าที่ :</label>
                </div>
                <div class="col-sm-4">
               
                    <select name="SETUP_PURCHASE_HEAD_ID" id="SETUP_PURCHASE_HEAD_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--กรุณาเลือกชื่อหัวหน้าเจ้าหน้าที่--</option>
                                @foreach ($infopersons as $infoperson)   
                                        
                                       @if($infoperson ->ID == $infosetup->SETUP_PURCHASE_HEAD_ID)
                                       <option value="{{ $infoperson ->ID  }}" selected>{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                       @else
                                       <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option> 
                                       @endif
                                       
                                
                                    
                                @endforeach 
                        </select>
                </div>
                <div class="col-sm-2 text-left">
                    <label >กรรมการตรวจรับ :</label>
                    </div>
                    <div class="col-sm-4">
                        <select name="SETUP_THEBOARD" id="SETUP_THEBOARD" class="form-control input-sm theboard"
                        style=" font-family: 'Kanit', sans-serif;">
                        <option value="">--เลือกคณะกรรมการ--</option>
                        @foreach ($suppliesconboardlists as $suppliesconboardlist)
                            @if($suppliesconboardlist ->BOARD_GROUP_ID == $infosetup->SETUP_THEBOARD)
                            <option value="{{ $suppliesconboardlist ->BOARD_GROUP_ID  }}" selected>{{ $suppliesconboardlist-> BOARD_GROUP_NAME }}</option>
                            @else 
                            <option value="{{ $suppliesconboardlist ->BOARD_GROUP_ID  }}">{{ $suppliesconboardlist-> BOARD_GROUP_NAME }}</option>
                            @endif
                          

                        @endforeach

                    </select>
                    </div>
                </div>
                </div>
                
        
           

      
          <div class="modal-footer">
          
                <div class="col-6">
                    @if($infosetup->USE_INFO == 'use')
                    <input type="checkbox" id="USE_INFO" name="USE_INFO" value="use" checked> ตั้งเป็นค่าอัตโนมัติ
                    @else
                    <input type="checkbox" id="USE_INFO" name="USE_INFO" value="use"> ตั้งเป็นค่าอัตโนมัติ
                    @endif
                  
                </div>
                <div class="col-6" align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> &nbsp; บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</button>
                </div>
            </div>
         
          </form>  
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


    function print(id){
    
    
      $.ajax({
                 url:"{{route('msupplies.detailprint')}}",
                method:"GET",
                 data:{id:id},
                 success:function(result){
                     $('#detailprint').html(result);
                   
               
                    //alert("Hello! I am an alert box!!");
                 }
                  
         })
          
    }
    
    
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
    datepick();
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