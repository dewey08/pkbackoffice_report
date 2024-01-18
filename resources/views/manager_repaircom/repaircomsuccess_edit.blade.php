@extends('layouts.repaircom')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 




?>
<?php
  function formateDatetime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $H= date("H",strtotime($strDate));
    $I= date("i",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];

  return  "$strDay $strMonthThai $strYear $H:$I";
    }
  
?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }
</style>
<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขบันทึกซ่อมอุปกรณ์คอมพิวเตอร์</B></h3>

</div>
<div class="block-content block-content-full" align="left">

          
        <form  method="post" action="{{ route('mrepaircom.updateinforepaircomsuccess') }}"  enctype="multipart/form-data">
        @csrf

  
      
    <div class="row push">

    <div class="col-lg-5">
  <!--------------------------------------------------->    
  <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #CCFFFF;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การแจ้งซ่อม</a>
                                    </li>
                                 
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รับงาน</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ดำเนินการ</a>
                                    </li>

                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">

                                    
                                    <div class="row">
                                                <div class="col-lg-2">
                                                <label>เลขที่ส่ง :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                                {{$inforepaircom->REPAIR_ID}}
                                                </div>
                                                <div class="col-lg-2">
                                                <label>วันที่เวลาแจ้ง :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                                {{ formateDatetime($inforepaircom->DATE_TIME_REQUEST) }}
                                                </div>  
                                        
                                            </div>

                                            <div class="row">      
                                                <div class="col-lg-2">
                                                <label>อาคาร :</label>
                                                </div> 
                                                <div class="col-lg-4">{{$inforepaircom->BUILD_NAME}}        
                                                </div>
                                               </div>
                                        
                                               
                                               <div class="row">      
                                                <div class="col-lg-2">
                                                <label>ชั้น :</label>
                                                </div> 
                                                <div class="col-lg-4">  {{$inforepaircom->LOCATION_LEVEL_NAME}}
                                                </div>
                                                <div class="col-lg-2">
                                                  <label>ห้อง :</label>
                                                  </div> 
                                                  <div class="col-lg-4">  {{$inforepaircom->LEVEL_ROOM_NAME}}
                                                </div>
                                               </div>

                                            <div class="row">
                                            
                                            <div class="col-lg-2">
                                            <label>แจ้งซ่อม :</label>
                                            </div> 
                                            <div class="col-lg-10">
                                            {{$inforepaircom->REPAIR_NAME}}
                                            </div>
                                            
                                            </div>

                                            <div class="row">
      
                                                <div class="col-lg-2">
                                                <label>รหัสครุภัณฑ์ :</label>
                                                </div> 
                                                <div class="col-lg-4">
                                                {{$inforepaircom->ARTICLE_NUM}}
                                                </div>
                                                <div class="col-lg-2">
                                                  <label>ชื่อครุภัณฑ์ :</label>
                                                  </div> 
                                                  <div class="col-lg-4">
                                                      {{$inforepaircom->ARTICLE_NAME}}
                                                </div>
                                               </div>
                                            
                                            <div class="row">
                                            
                                            <div class="col-lg-2">
                                            <label>อาการ :</label>
                                            </div> 
                                            <div class="col-lg-10">
                                            {{$inforepaircom->SYMPTOM}}
                                            </div>
                                            
                                            </div>    

                                                <div class="row">
                                            
                                            <div class="col-lg-2">
                                            <label>ความเร่งด่วน :</label>
                                            </div> 
                                            <div class="col-lg-10">
                                            {{$inforepaircom->PRIORITY_NAME}}
                                            </div>
                                            
                                            </div>    

                                            <div class="row">
                                            
                                            <div class="col-lg-2">
                                            <label>ผู้แจ้งซ่อม :</label>
                                            </div> 
                                            <div class="col-lg-4">
                                            {{$inforepaircom->USRE_REQUEST_NAME}}
                                            </div>
                                            
                                            </div>               


                                            <div class="row">
                                            
                                            <div class="col-lg-2">
                                            <label>ฝ่าย/แผนก  :</label>
                                            </div> 
                                            <div class="col-lg-4">
                                            {{$inforepaircom->HR_DEPARTMENT_SUB_SUB_NAME}}
                                            </div>
                                            
                                            </div>   

                                            <div class="form-group"> 
                                            <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforepaircom->COM_IMG)) }}" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="200" width="200"/>
                                            </div>

                                            
                                     
                                            
                                    </div>   

                                        <div class="tab-pane" id="object2" role="tabpanel">
                                                   
                                                    <div class="row">
                                                    
                                                    <div class="col-lg-2">
                                                    <label>วันที่รับ :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{DateThai($inforepaircom->TECH_RECEIVE_DATE)}}
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <label>เวลา :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{$inforepaircom->TECH_RECEIVE_TIME}}
                                                    </div>
                                                    </div>
                                                
                                                    <div class="row">
                                                    
                                                    <div class="col-lg-2">
                                                    <label>วันที่ซ่อม :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{DateThai($inforepaircom->TECH_REPAIR_DATE)}}
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <label>เวลา :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{$inforepaircom->TECH_REPAIR_TIME}}
                                                    </div>
                                                    </div>

                                                    <div class="row"> 
                                                    <div class="col-lg-2">
                                                    <label>ถึงวันที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{DateThai($inforepaircom->TECH_SUCCESS_DATE)}}
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <label>เวลา :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{$inforepaircom->TECH_SUCCESS_TIME}}
                                                    </div>
                                                    </div>

                                                    <div class="row"> 
                                                    <div class="col-lg-2">
                                                    <label>หมายเหตุ :</label>
                                                    </div> 
                                                    <div class="col-lg-10">
                                                    {{$inforepaircom->TECH_RECEIVE_COMMENT}}
                                                    </div>
                                                 
                                                    </div>


                                                    <div class="row"> 
                                                    <div class="col-lg-2">
                                                    <label>ผู้รับเรื่อง :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{$inforepaircom->TECH_RECEIVE_NAME}}
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <label>ช่างหลัก :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{$inforepaircom->TECH_REPAIR_NAME}}
                                                    </div>
                                                    </div>



                                        </div>

                                        
                                        <div class="tab-pane" id="object3" role="tabpanel">
                                                   
                                                    <div class="row">
                                                    
                                                    <div class="col-lg-3">
                                                    <label>รายละเอียด :</label>
                                                    </div> 
                                                    <div class="col-lg-9">
                                                    {{$inforepaircom->REPAIR_COMMENT}}
                                                    </div>
                                               
                                                    </div>

                                                    <div class="row"> 
                                                    <div class="col-lg-3">
                                                    <label>วันที่ :</label>
                                                    </div> 
                                                    <div class="col-lg-3">
                                                    {{DateThai($inforepaircom->REPAIR_DATE)}}
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <label>เวลา :</label>
                                                    </div> 
                                                    <div class="col-lg-4">
                                                    {{$inforepaircom->REPAIR_TIME}}
                                                    </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    @if($inforepaircom->OUTSIDE_COMMENT != '')
                                                    <div class="row">
                                                    <div class="col-lg-12">
                                                    <label>รายละเอียดส่งซ่อมภายนอก</label>
                                                    </div> 
                                                    </div>

                                                    <div class="row"> 
                                                    <div class="col-lg-4">
                                                    <label>เหตุผลที่ส่งซ่อม :</label>
                                                    </div> 
                                                    <div class="col-lg-8">
                                                    {{$inforepaircom->OUTSIDE_COMMENT}}
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-lg-4">
                                                    <label>อุปกรณ์ที่ติดไปด้วย :</label>
                                                    </div> 
                                                    <div class="col-lg-8">
                                                    {{$inforepaircom->OUTSIDE_TOOL}}
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-lg-4">
                                                    <label>ส่งซ่อมที่ร้าน :</label>
                                                    </div> 
                                                    <div class="col-lg-8">
                                                    {{$inforepaircom->OUTSIDE_SHOP}}
                                                    </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-lg-4">
                                                    <label>ผู้รับสิ่งของ :</label>
                                                    </div> 
                                                    <div class="col-lg-8">
                                                    {{$inforepaircom->OUTSIDE_EMP}}
                                                    </div>
                                                    </div>
                                                    @endif
                                            


                                        </div>
                        
        </div>
        </div>
        </div>
      
        <div class="col-sm-7">
      

     

       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#objectinput1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รายการซ่อม</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#objectinput2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">เบิกอะไหล่</a>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <a class="nav-link" href="#objectinput3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">จำหน่าย</a>
                                    </li>
                                    @if($inforepaircom->GETBACK_ACTIVE=='getback')
                                    <li class="nav-item">
                                        <a class="nav-link" href="#objectinput4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รับกลับ</a>
                                    </li>
                                    
                                    @endif


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="objectinput1" role="tabpanel">
                                      
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr  style="background-color: #FFE4E1;">
                                                <td style="text-align: center;" width=20%">ประเภท</td>
                                                <td style="text-align: center;">รายการซ่อม</td>
                                                <td style="text-align: center;" width="10%">จำนวน</td>
                                                <td style="text-align: center;" width="15%">ราคาต่อหน่วย</td>
                                                <td style="text-align: center;" width="15%">ราคารวม</td>
                                           
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fas fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 

                                        @if($countservice == 0) 
                                     
                                     <tr>
                                         <td> 
                                                 <select name="REPAIR_TYPE_ID[]" id="REPAIR_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                 <option value="">เลือกประเภท</option>
                                                 @foreach ($servicetypes as $servicetype)                                                     
                                                 <option value="{{$servicetype->REPAIR_TYPE_ID}}">{{ $servicetype->REPAIR_TYPE_NAME}}</option>
                                                 @endforeach 
                                                 </select>   
                                         </td>
                                         <td> 
                                         <input name="REPAIR_SERVICE_NAME[]" id="REPAIR_SERVICE_NAME0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                         </td>
                                         <td> 
                                         <input name="REPAIR_TOTAL[]" id="REPAIR_TOTAL0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="checksummoney(0)" >
                                         </td>
                                         <td> 
                                         <input name="REPAIR_PRICE_PER_UNIT[]" id="REPAIR_PRICE_PER_UNIT0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  onkeyup="checksummoney(0)">
                                         </td>
                                         <td> 
                                         <div class="summoney0"></div>
                                        </td>
                                      
                                      
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                     </tr>
 
                                     @else
                                     <?php $cont =0; ?>
                                     @foreach ($services as $service) 
                                      
                                     <tr>
                                         <td> 
                                                 <select name="REPAIR_TYPE_ID[]" id="REPAIR_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                 <option value="">เลือกประเภท</option>
                                                 @foreach ($servicetypes as $servicetype)
                                                     @if($servicetype->REPAIR_TYPE_ID == $service->REPAIR_TYPE_ID)
                                                     <option value="{{$servicetype->REPAIR_TYPE_ID}}" selected>{{ $servicetype->REPAIR_TYPE_NAME}}</option>
                                                     @else
                                                     <option value="{{$servicetype->REPAIR_TYPE_ID}}">{{ $servicetype->REPAIR_TYPE_NAME}}</option>
                                                     @endif
                                                 @endforeach 
                                                 </select>   
                                         </td>
                                         <td> 
                                         <input name="REPAIR_SERVICE_NAME[]" id="REPAIR_SERVICE_NAME[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$service->REPAIR_SERVICE_NAME}}">
                                         </td>
                                         <td> 
                                         <input name="REPAIR_TOTAL[]" id="REPAIR_TOTAL{{$cont}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$service->REPAIR_TOTAL}}" onkeyup="checksummoney({{$cont}})">
                                         </td>
                                         <td> 
                                         <input name="REPAIR_PRICE_PER_UNIT[]" id="REPAIR_PRICE_PER_UNIT{{$cont}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$service->REPAIR_PRICE_PER_UNIT}}" onkeyup="checksummoney({{$cont}})">
                                         </td>
                                         <td> 
                                         <div class="summoney{{$cont}}">{{$service->REPAIR_SUM_PRICE}}</div>
                                         </td>
                                      
                                      
                                         <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                     </tr>
                                   
                                     <?php $cont++; ?>
 
                                     @endforeach 
                                     @endif
                            
                                    </tbody>   
                                    </table>

                                    </div>

                                    <div class="tab-pane" id="objectinput2" role="tabpanel">
                                   
                                        <table class="table-striped table-vcenter " style="width: 100%;border: 1px solid black;">
                                            <thead style="background-color: #FFEBCD;">
                                             
                                                    <tr>
                                                    <td style="text-align: center; font-size: 13px;  border: 1px solid black;">ลำดับ</td>
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" width="20%">รายการรับเข้า</td>
                                                     
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" >ล็อตผลิต</td>
                                            
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" width="5%">หน่วย</td>
                                                        
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" width="8%">จำนวนจ่าย</td>
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" >ราคาต่อหน่วย</td>
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" width="10%" >มูลค่า</td>
                                                        
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" >วันที่ผลิต</td>
                                                        <td style="text-align: center; font-size: 13px;  border: 1px solid black;" >วันที่หมดอายุ</td>

                                                    </tr>
                                                </thead> 
                                                <tbody > 
                                                        <?php $number=1; ?>

                                                    @foreach ($infopays as $infopay) 


                                                    <tr style="text-align: center; font-size: 13px;border: 1px solid black;">
                                                        <td style="text-align: center;">
                                                            {{$number}}
                                                        </td>
                                                        <td style="text-align: left;" class=" text-pedding">  
                                                            
                                                            {{$infopay->TREASURY_EXPORT_SUB_NAME}}
                                                        </td>
  
                                                        <td >
                                                            {{$infopay->TREASURY_EXPORT_SUB_LOT}}
                                                        </td>
                                                                  
                                                        <td >
                                                            {{$infopay->SUP_UNIT_NAME}}
                                                        </td>
                                                        <td >
                                                            {{$infopay->TREASURY_EXPORT_SUB_AMOUNT}}
                                                        </td>
                                                        <td >
                                                            {{$infopay->TREASURY_EXPORT_SUB_PICE_UNIT}}
                                                        </td>
                                                        <td >
                                                            {{$infopay->TREASURY_EXPORT_SUB_VALUE}}
                                                        </td>
                                                 
                                                        <td >
                                                            {{formate($infopay->TREASURY_EXPORT_SUB_GEN_DATE)}}
                                                        </td>
                                                        <td>
                                                            {{formate($infopay->TREASURY_EXPORT_SUB_EXP_DATE)}}
                                                        </td>
                            
                                                        </tr>
                                      
                                                        <?php $number++; ?>
                                              
                                                    @endforeach 
                                              
                                          
                                              
                                     
                                            </tbody>   
                                </table>
                                    </div>
                                    <div class="tab-pane" id="objectinput3" role="tabpanel">
                                   

                                    <div class="row push">
                                          
                                            <div class="col-lg-4">
                                            @if($inforepaircom->DEAL_ACTIVE == 'deal')
                                            <label><input type="checkbox" name="DEAL_ACTIVE" value='deal' checked>&nbsp;&nbsp;&nbsp;จำหน่าย</label>
                                            @else
                                            <label><input type="checkbox" name="DEAL_ACTIVE" value='deal' >&nbsp;&nbsp;&nbsp;จำหน่าย</label>
                                            @endif
                                           
                                            </div>
                                            </div>
                                            <div class="row push"> 
                                            <div class="col-lg-2">
                                            <label>รายละเอียด :</label>
                                            </div> 
                                            <div class="col-lg-10">
                                            <textarea class="form-control input-sm" rows="5" name="DEAL_COMMENT" id="DEAL_COMMENT">{{$inforepaircom->DEAL_COMMENT}}</textarea>
                                            </div>  
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="objectinput4" role="tabpanel">
                                   

                                   <div class="row push">
                                         
                                           <div class="col-lg-4">
                                           @if($inforepaircom->GETBACK_ACTIVE == 'getback')
                                           <label><input type="checkbox" name="GETBACK_ACTIVE" value='getback' checked>&nbsp;&nbsp;&nbsp;รับกลับ</label>
                                            @else
                                            <label><input type="checkbox" name="GETBACK_ACTIVE" value='getback' >&nbsp;&nbsp;&nbsp;รับกลับ</label>
                                            @endif

                                          
                                           </div>
                                           </div>
                                           <div class="row push"> 
                                           <div class="col-lg-2">
                                           <label>วันที่รับกลับ :</label>
                                           </div> 
                                           <div class="col-lg-4">
                                           <input name="GETBACK_DATE" id="GETBACK_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
                                           </div>  
                                           <div class="col-lg-2">
                                           <label>ผู้รับกลับ :</label>
                                           </div> 
                                           <div class="col-lg-4">
                                           <input name="GETBACK_PERSON" id="GETBACK_PERSON" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforepaircom->GETBACK_PERSON}}">
                                           </div>  
                                       </div>

                                   </div>

                                    </div>
                                </div>
                                </div>
      


</div>

<input type="hidden" name="ID" id="ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforepairID->ID}}" >
<input type="hidden" name="REPAIR_ID" id="REPAIR_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$inforepaircom->REPAIR_ID}}"  >
<input type="hidden" name="GETBACK_ACTIVE" id="GETBACK_ACTIVE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$inforepaircom->GETBACK_ACTIVE}}"  >

        <div class="row push">
        <div class="col-lg-2">
        <label>หมายเหตุ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="REPAIR_SUCCESS_REMARK" id="REPAIR_SUCCESS_REMARK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforepaircom->REPAIR_SUCCESS_REMARK}}" >
        </div> 
     
       </div>

</div>




</div>






        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ route('mrepaircom.repaircominfo') }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
    

<script>
  
  $('.typekind_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchsubtype')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.type_sub').html(result);
                     }
             })
            // console.log(select);

            $.ajax({
                     url:"{{route('msupplies.checkfetchsubtype')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.checktypesub').html(result);
                     }
             })



             }        
     });

//-------------------------------------------------------------------------

  $('.type_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchmedicine')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.medicine').html(result);
                     }
             })
            // console.log(select);
             }        
     });

$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });





function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});




function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
        var numb = input.files[0].size/1024;
   
   if(numb > 64){
       alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
           fileInput.value = '';
           return false;
       }	
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                        }
                }
            
                $("#picture").change(function () {
                    readURL(this);
                });


                //-------------------------------------------------------

$('.addRow').on('click',function(){
         addRow();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr =   '<tr>'+
                    '<td>'+ 
                    '<select name="REPAIR_TYPE_ID[]" id="REPAIR_TYPE_ID" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '<option value="">เลือกประเภท</option>'+
                    '@foreach ($servicetypes as $servicetype)'+                                                     
                    '<option value="{{$servicetype->REPAIR_TYPE_ID}}">{{ $servicetype->REPAIR_TYPE_NAME}}</option>'+
                    '@endforeach'+ 
                    '</select>'+
                    '</td>'+
                    '<td>'+ 
                    '<input name="REPAIR_SERVICE_NAME[]" id="REPAIR_SERVICE_NAME[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '</td>'+
                    '<td>'+ 
                    '<input name="REPAIR_TOTAL[]" id="REPAIR_TOTAL'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+count+');">'+
                    '</td>'+
                    '<td>'+ 
                    '<input name="REPAIR_PRICE_PER_UNIT[]" id="REPAIR_PRICE_PER_UNIT'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  onkeyup="checksummoney('+count+');">'+
                    '</td>'+
                    '<td><div class="summoney'+count+'"></div></td>'+
                                     
               
                    '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });

     //-------------------------------------------------------

$('.addRow2').on('click',function(){
         addRow2();
     });

     function addRow2(){
        var count = $('.tbody2').children('tr').length;
         var tr =   '<tr>'+       
                     '<td>'+ 
                     '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                     '</td>'+
                     '<td>'+ 
                   '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '</td>'+                                 
                    '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
        $('.tbody2').append(tr);
     };

     $('.tbody2').on('click','.remove2', function(){
            $(this).parent().parent().remove();
     });

     //-------------------------------------------------

     function checksummoney(number){
      
    
      var REPAIR_TOTAL=document.getElementById("REPAIR_TOTAL"+number).value;
      var REPAIR_PRICE_PER_UNIT=document.getElementById("REPAIR_PRICE_PER_UNIT"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mrepairnomal.checksummoney')}}",
                   method:"GET",
                   data:{REPAIR_TOTAL:REPAIR_TOTAL,REPAIR_PRICE_PER_UNIT:REPAIR_PRICE_PER_UNIT,_token:_token},
                   success:function(result){
                      $('.summoney'+number).html(result);
                   }
           })

  }
  
  
</script>


@endsection