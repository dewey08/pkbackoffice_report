@extends('layouts.repairmedical')
    
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
use Illuminate\Support\Facades\DB;
  
?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

                  
      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      }
      
</style>
<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลครุภัณฑ์เครื่องมือการแพทย์</B></h3>

</div>
<div class="block-content block-content-full" align="left">


      
    <div class="row">

       <div class="col-lg-4" align="center">
                                        <div class="form-group">
                                          
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($repairmedicalinfoasset->IMG)) }}" height="150px" width="150px"/>
                                     
                                    
                                        </div>
              
                                        
        </div>

        <div class="col-sm-8">
 
        
       <div class="row">
        <div class="col-lg-2">
        <label>รหัส :</label>
        </div> 
        <div class="col-lg-4">
        {{$repairmedicalinfoasset->ARTICLE_ID}}
        </div> 
        <div class="col-lg-2">
        <label>เลขครุภัณฑ์ :</label>
        </div> 
        <div class="col-lg-4">
      {{$repairmedicalinfoasset->ARTICLE_NUM}}
        </div>
       </div>
        
        <div class="row">
        <div class="col-lg-2">
        <label>ครุภัณฑ์:</label>
        </div> 
        <div class="col-lg-8">
        {{$repairmedicalinfoasset->ARTICLE_NAME}}
        </div> 
       
        </div> 
     


        
        <div class="row">
      <div class="col-lg-2">
      <label>อาคาร :</label>
      </div> 
      <div class="col-lg-4" >
        {{$repairmedicalinfoasset->LOCATION_NAME}}  
      </div>
          <div class="col-lg-1" >
          <label>ชั้น :</label>
          </div> 
          <div class="col-lg-2" >
            {{$repairmedicalinfoasset->LOCATION_LEVEL_NAME}}  
          </div> 
          <div class="col-lg-1" >
          <label>ห้อง :</label>
          </div> 
          <div class="col-lg-2" >
            {{$repairmedicalinfoasset->LEVEL_ROOM_NAME}}  
          </div> 
     
      </div>    
   
  
    
     
        <div class="row">
        <div class="col-lg-2">
        <label>โมเดล :</label>
        </div> 
        <div class="col-lg-4">
        {{$repairmedicalinfoasset->MODEL_NAME}}  
        </div>
        <div class="col-lg-2">
        <label>ขนาด :</label>
        </div> 
        <div class="col-lg-4">
        {{$repairmedicalinfoasset->SIZE_NAME}}  
        </div> 
        </div> 

        <div class="row">
        <div class="col-lg-2">
        <label>ยี่ห้อ :</label>
        </div> 
        <div class="col-lg-4">
        {{$repairmedicalinfoasset->BRAND_NAME}}  
        </div>
        <div class="col-lg-2">
        <label>สี :</label>
        </div> 
        <div class="col-lg-4">
        {{$repairmedicalinfoasset->COLOR_NAME}}  
        </div> 
        </div>

        <div class="row">
        <div class="col-lg-2">
        <label>วันที่รับ :</label>
        </div> 
        <div class="col-lg-4">
        {{DateThai($repairmedicalinfoasset->RECEIVE_DATE)}}  
        </div>
        <div class="col-lg-2">
        <label>ราคา :</label>
        </div> 
        <div class="col-lg-4">
        {{$repairmedicalinfoasset->PRICE_PER_UNIT}}  
        </div>
        </div> 

        <div class="row">
        <div class="col-lg-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-10">
        {{$repairmedicalinfoasset->ARTICLE_PROP}}  
        </div>
        </div>
        </div> 
</div>   

        
        <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E6E6FA;">
                                    <li class="nav-item">
                           
                                     <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ตรวจเช็คบำรุงรักษา(PM)</a>
                      
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">สอบเทียบคุณภาพ(CAL)</a>
                                    </li>
                               
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ประวัติการซ่อม(CM)</a>
                                    </li>

                                   
                                    
                      
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">แผนบำรุงรักษา</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">แผนสอบเทียบ</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รายการบำรุงรักษา</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รายการสอบเทียบ</a>
                                    </li>





                                  
                                </ul>
                                <div class="block-content tab-content">

                              
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                   
                                  
                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#maintenance"><i class="fas fa-plus"></i> เพิ่มการตรวจบำรุงรักษา</button>
                                   <br><br>
                                   <div id="detail_maintenance">
                                   <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th style="text-align: center;">วันที่ตรวจ</th>
                                        <th style="text-align: center;">เวลา</th>
                                        <th style="text-align: center;">ผู้ตรวจเช็คอุปกรณ์</th>
                                        <th style="text-align: center;">หัวหน้ารับรอง</th>
                                        <th style="text-align: center;">ผลการตรวจ</th>
                                        <th style="text-align: center;">ประเภท</th>
                                        <th style="text-align: center;">หมายเหตุ</th>
                                        <th style="text-align: center;">ตรวจสอบ</th>
                                        <th style="text-align: center;"  width="10%">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead><tbody>

                                    @foreach ($checkrepairs as $checkrepair)
                                    <tr>
                                    <td class="text-font" align="center">{{DateThai($checkrepair->REPAIR_PLAN_DATE)}}</td>
                                    <td class="text-font" align="center">{{$checkrepair->REPAIR_PLAN_BEGIN_TIME}}</td>
                                    <td class="text-font text-pedding">{{$checkrepair->REPAIR_PESON_CHECK_NAME}}</td>
                                    <td class="text-font text-pedding">{{$checkrepair->REPAIR_LEADER_CHECK_NAME}}</td>
                                    <td class="text-font text-pedding">{{$checkrepair->REPAIR_RESULT}}</td>
                                    @if($checkrepair->REPAIR_TYPE_CHECK == 'notplan')
                                    <td class="text-font text-pedding">ตรวจเช็คอื่นๆ</td>
                                    @else
                                    <td class="text-font text-pedding">ตรวจเช็คตามแผน</td>
                                    @endif
                                   
                               
                                    <td class="text-font text-pedding">{{$checkrepair->REPAIR_PLAN_REMARK}}</td>
                                    <td align="center">
                                     
                                        <a class="btn btn-hero-sm btn-hero-success "  href="#detail_check{{$checkrepair->REPAIR_PLAN_ID}}"  data-toggle="modal"><i class="fa fa-file-signature"></i></a>


                                    </td>
                                    <td>
                                    <div class="dropdown" align="center">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">

                                                    <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    
                                                    <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>
                                                   
                                                </div>
                                        </div>
                                    
                                    </td>
                                    
                                    </tr>





                                    <div id="detail_check{{$checkrepair->REPAIR_PLAN_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                             <div class="modal-header">        
                                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;ตรวจบำรุงรักษา</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.checkrepairmedicalall') }}" enctype="multipart/form-data">
                                                                @csrf    

                                                           
                                                                <input type="hidden" name="REPAIR_PLAN_ID" id="REPAIR_PLAN_ID" class="form-control input-sm "  value="{{$checkrepair->REPAIR_PLAN_ID}}">
                                                                   <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$checkrepair->REPAIR_PLAN_ARTICLE_NUM}}">
                                                                   <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$checkrepair->REPAIR_PLAN_ARTICLE_ID}}">

                                                                    <div class="row push">
       
                                                                    <div class="col-lg-2">
                                                                    <label >วันที่ทำรายการ</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    {{DateThai($checkrepair->REPAIR_PLAN_DATE)}}
                                                                    </div>
                                                            
                                                                    <div class="col-lg-1">
                                                                    <label >เวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    {{$checkrepair->REPAIR_PLAN_BEGIN_TIME}}
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >ถึงเวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    {{$checkrepair->REPAIR_PLAN_END_TIME}}
                                                                    </div>

                                                              
                               
                                                                    </div>

                                                                    <div class="row push">

                                                                    <div class="col-lg-2">
                                                                    <label >หัวหน้ารับรอง</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    
                                                                    <select name="REPAIR_LEADER_CHECK_ID" id="REPAIR_LEADER_CHECK_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                <option value="">--กรุณาเลือกหัวหน้ารับรอง--</option>  
                                                                                @foreach ($leaders as $leader)
                                                                                @if($checkrepair->REPAIR_LEADER_CHECK_ID == $leader->LEADER_ID)
                                                                                <option value="{{$leader->LEADER_ID}}" selected>{{$leader->LEADER_NAME}}</option>                                   
                                                                                @else
                                                                                <option value="{{$leader->LEADER_ID}}">{{$leader->LEADER_NAME}}</option>                                   
                                                                                @endif
                                                                              
                                                                                @endforeach   
                                                                            </select>   
                                                                             
                                                                            </select>   
                                                                    </div>
       
                                                                    <div class="col-lg-1">
                                                                    <label >ประเภท</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    @if($checkrepair->REPAIR_TYPE_CHECK == 'notplan')
                                                                        ตรวจเช็คอื่นๆ
                                                                        @else
                                                                        ตรวจเช็คตามแผน
                                                                        @endif
                                                                 
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >หมายเหตุ</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name="REPAIR_PLAN_REMARK"  id="REPAIR_PLAN_REMARK" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                    </div>
                                                                      <BR>
                                                                      <BR>

                                                                    <input  type="hidden" name = "REPAIR_PESON_CHECK_ID"  id="REPAIR_PESON_CHECK_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">


                                                                            <?php    $checkrepairsubs = DB::table('informrepair_plan_sub')->where('REPAIR_PLAN_ID','=',$checkrepair->REPAIR_PLAN_ID)->orderBy('REPAIR_PLAN_SUB_ID', 'desc') ->get(); ?>

                                                                            @foreach ($checkrepairsubs as $checkrepairsub)
                                                                   
                                                                            
                                                                            <div class="row push">
                                                                                 <div class="col-lg-1">
                                                                                        <label >ตรวจสอบ</label>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                        {{$checkrepairsub->REPAIR_PLAN_SUB_NAME}}
                                                                                        <input type="hidden" name="REPAIR_PLAN_SUB_NAME[]" id="REPAIR_PLAN_SUB_NAME[]" class="form-control input-sm" value="{{$checkrepairsub->REPAIR_PLAN_SUB_NAME}}" >  
                                                                                </div> 
                                                                                <div class="col-lg-2">
                                                                                        <label >ผลการตรวจสอบ</label>
                                                                                </div> 
                                                                                <div class="col-lg-2">
                                                                                        <select name="REPAIR_PLAN_SUB_RESULT[]" id="REPAIR_PLAN_SUB_RESULT[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                        
                                                                                        <option value="ปกติ">ปกติ</option>  
                                                  
                                                                                        <option value="ผิดปกติ">ผิดปกติ</option> 

                                                                                        </select>  

                                                                                </div>   
                                                                                <div class="col-lg-1">
                                                                                        <label >หมายเหตุ</label>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                        <input name="REPAIR_PLAN_SUB_REMARK[]" id="REPAIR_PLAN_SUB_REMARK[]" class="form-control input-sm" value="{{$checkrepairsub->REPAIR_PLAN_SUB_REMARK}}" >  
                                                                                        </div> 
                                                                             </div>    
                                                                        @endforeach  


                                                                  
                                                                         


                                                            </div>
                                                            
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-danger"   data-dismiss="modal">ยกเลิก</button>
                                                </div>
                                                </div>
                                                </form>  
                                            </div>
                                            </div>

                                    @endforeach  
                    
                                    </tbody>
                                    </table>
                                   </div>

                                            <div id="maintenance" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            
                                            <div class="modal-dialog modal-xl">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                             <div class="modal-header">        
                                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลการตรวจบำรุงรักษา</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.savecheckrepairmedical') }}" enctype="multipart/form-data">
                                                                @csrf    

                                                           

                                                                   <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                   <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">

                                                                    <div class="row push">
       
                                                                    <div class="col-lg-2">
                                                                    <label >วันที่ทำรายการ</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "REPAIR_PLAN_DATE"  id="REPAIR_PLAN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                    </div>
                                                            
                                                                    <div class="col-lg-1">
                                                                    <label >เวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input type="text" class="js-masked-time form-control" id="REPAIR_PLAN_BEGIN_TIME" name="REPAIR_PLAN_BEGIN_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >ถึงเวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input type="text" class="js-masked-time form-control" id="REPAIR_PLAN_END_TIME" name="REPAIR_PLAN_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                    </div>

                                                              
                               
                                                                    </div>

                                                                    <div class="row push">

                                                                    <div class="col-lg-2">
                                                                    <label >หัวหน้ารับรอง</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    
                                                                    <select name="REPAIR_LEADER_CHECK_ID" id="REPAIR_LEADER_CHECK_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                <option value="">--กรุณาเลือกหัวหน้ารับรอง--</option>  
                                                                                @foreach ($leaders as $leader)
                                                                                <option value="{{$leader->LEADER_ID}}">{{$leader->LEADER_NAME}}</option>                                   
                                                                                @endforeach   
                                                                            </select>   
                                                                             
                                                                            </select>   
                                                                    </div>
       
                                                                    <div class="col-lg-1">
                                                                    <label >ประเภท</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    ตรวจเช็คอื่นๆ
                                                                    <input type="hidden"  name="REPAIR_TYPE_CHECK"  id="REPAIR_TYPE_CHECK" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;"  value="notplan">
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >หมายเหตุ</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name="REPAIR_PLAN_REMARK"  id="REPAIR_PLAN_REMARK" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                                                                    </div>

                                                                    </div>


                                                                    <input  type="hidden" name = "REPAIR_PESON_CHECK_ID"  id="REPAIR_PESON_CHECK_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$id_user}}">



                                                                    <table class="table gwt-table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <td style="text-align: center;" width="40%">รายการปฏิบัติ</td>
                                                                                    <td style="text-align: center;" width="15%">ผลการตรวจเช็ค</td>                                                    
                                                                                    <td style="text-align: center;" >หมายเหตุ</td>                                        
                                                                                    <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow1" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                                                                </tr>
                                                                            </thead> 
                                                                            <tbody class="tbody1">                                                                            
                                                                                <tr>
                                                                                    <td> 
                                                                                    <select name="REPAIR_PLAN_SUB_NAME[]" id="REPAIR_PLAN_SUB_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                    <option value="">--กรุณาเลือกรายการ--</option>  
                                                                                    @foreach ($detailplans as $detailplan)
                                                                                    <option value="{{$detailplan->CARE_LIST_NAME}}">{{$detailplan->CARE_LIST_NAME}}</option>  
                                                                                    @endforeach   
                                                                                
                                                                                    </select>   
                                                                                    </td>
                                                                                    <td> 
                                                                                        <select name="REPAIR_PLAN_SUB_RESULT[]" id="REPAIR_PLAN_SUB_RESULT[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                            <option value="ปกติ">ปกติ</option>  
                                                                                            <option value="ผิดปกติ">ผิดปกติ</option>  
                                                                                        </select>    
                                                                                    </td>
                                                                                    <td> 
                                                                                        <input name="REPAIR_PLAN_SUB_REMARK[]" id="REPAIR_PLAN_SUB_REMARK[]" class="form-control input-sm"  >  
                                                                                    </td>  
                                                                                    <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                                                                </tr>
                                                                            </tbody>   
                                                                    </table>



                                                            </div>
                                                            
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-danger"   data-dismiss="modal">ยกเลิก</button>
                                                </div>
                                                </div>
                                                </form>  
                                            </div>
                                            </div>

                                            <!----------------------------------------------->

                                                         
         
        </div>

        <div class="tab-pane" id="object2" role="tabpanel">  
                                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                                                                <tr>
                                                                                    <td style="text-align: center;" width="15%">วันที่ซ่อม</td>
                                                                                    <td style="text-align: center;" width="8%">สถานะ</td>
                                                                                    <td style="text-align: center;" width="15%">เลขครุภัณฑ์</td>   
                                                                                    <td style="text-align: center;" >แจ้งซ่อม</td>
                                                                                    <td style="text-align: center;" >อาการ</td>
                                                                                    <td style="text-align: center;" width="15%">ช่างซ่อม</td>
                                        
                                
                                                                                </tr>
                                                                            </thead> 
                                                                            <tbody>

                                                                    @foreach ($infohisrepairs as $infohisrepair)      
                                                                        <tr>
                                                                            <td  class="text-font text-pedding" align="center">{{DateThai($infohisrepair->TECH_RECEIVE_DATE)}}</td>
                                                                           
                                                                            @if($infohisrepair->REPAIR_STATUS == 'REPAIR_OUT')
                                                                                <td  align="center"><span class="badge badge-secondary" >แจ้งยกเลิก</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS== 'REQUEST')
                                                                                <td  align="center"><span class="badge badge-warning" >ร้องขอ</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS== 'RECEIVE')
                                                                                <td  align="center"><span class="badge badge-info" >รับงาน</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'PENDING')
                                                                                <td  align="center"><span class="badge badge-danger" >กำลังดำเนินการ</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'CANCEL')
                                                                                <td  align="center"><span class="badge badge-dark" >ยกเลิก</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'SUCCESS')
                                                                                <td  align="center"><span class="badge badge-success" >ซ่อมเสร็จ</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'OUTSIDE')
                                                                                <td  align="center"><span class="badge badge-danger" >ส่งซ่อมนอก</span></td>
                                                                                @elseif($infohisrepair->REPAIR_STATUS == 'DEAL')
                                                                                <td  align="center"><span class="badge badge-danger" >จำหน่าย</span></td>
                                                                            @else
                                                                            <td class="text-font" align="center" ></td>
                                                                                @endif


                                                                            <td class="text-font text-pedding" align="center">{{$infohisrepair->ARTICLE_NUM}}</td>
                                                                            <td class="text-font text-pedding">{{$infohisrepair->REPAIR_NAME}}</td>
                                                                            <td class="text-font text-pedding"> {{$infohisrepair->SYMPTOM}}</td>
                                                                            <td class="text-font text-pedding">{{$infohisrepair->TECH_REPAIR_NAME}}</td>
                                                
                                                                        
                                                                          
                                                                        </tr>
                                                                        @endforeach  

                                                                        </tbody>   
                    </table>

        </div>


        <div class="tab-pane" id="object3" role="tabpanel">

                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#maintenanceplan"><i class="fas fa-plus"></i> เพิ่มแผนบำรุงรักษา</button>
                                   <br><br>
                                   <div >
                                   <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th style="text-align: center;">วันที่</th>
                                        <th style="text-align: center;">เวลา</th>
                                        <th style="text-align: center;" >ตรวจแล้ว</th>
                                        <th style="text-align: center;">หมายเหตุ</th>

                                        <th   style="text-align: center;" width="12%">คำสั่ง</th> 
                                    
                                        </tr>
                                    </thead><tbody>

                                    @foreach ($planrepairs as $planrepair)
                                    <tr>
                                            <td class="text-font" align="center">{{ DateThai($planrepair->REPAIR_PLAN_DATE) }}</td>  
                                            <td class="text-font" align="center">{{ $planrepair->REPAIR_PLAN_BEGIN_TIME }}</td> 
                                            @if($planrepair->REPAIR_RESULT != '')
                                            <td class="text-font" align="center">ตรวจแล้ว</td>
                                            @else
                                            <td class="text-font" align="center">ยังไม่ได้ตรวจสอบ</td>
                                            @endif


                                            <td class="text-font text-pedding" >{{ $planrepair->REPAIR_PLAN_REMARK}}</td> 
                                            <td  align="center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                                ทำรายการ
                                                        </button>
                                                        <div class="dropdown-menu" style="width:10px">
                                                
                                                            <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" data-toggle="modal" data-target="#editmaintenanceplan{{$planrepair->REPAIR_PLAN_ID}}">แก้ไขข้อมูล</a> 
                                                            
                                                            <a class="dropdown-item"  href="{{url('manager_repairmedical/repairmedicalinfoasset_planrepair_destroy/'.$repairmedicalinfoasset->ARTICLE_ID.'/'.$planrepair->REPAIR_PLAN_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>                                                                                                     
                                                        </div>
                                                </div>                                    
                                            </td>                                   
                                    </tr>

                                    <div id="editmaintenanceplan{{$planrepair->REPAIR_PLAN_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">                                                
                                               <div class="modal-content">
                                                           <div class="modal-header">        
                                                         
                                                           <label style="font-family: 'Kanit', sans-serif; font-size: 20px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลแผนบำรุงรักษา</label>
                                                           </div>
                                                           <div class="modal-body">
                                                           <form  method="post" action="" enctype="multipart/form-data">
                                                           @csrf 

                                                               <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                               <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                               <input type="hidden" name="REPAIR_PLAN_ID" id="REPAIR_PLAN_ID" class="form-control input-sm "  value="{{$planrepair->REPAIR_PLAN_ID}}">
                                                               
                                                               <div class="row push">       
                                                                        <div class="col-lg-1 ">
                                                                        <label >วันที่</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input  name = "REPAIR_PLAN_DATE"  id="REPAIR_PLAN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{DateThai($planrepair->REPAIR_PLAN_DATE)}}" readonly>
                                                                        </div>
                                                                
                                                                        <div class="col-lg-1">
                                                                        <label >เวลา</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input type="text" class="js-masked-time form-control" id="REPAIR_PLAN_BEGIN_TIME" name="REPAIR_PLAN_BEGIN_TIME" style=" font-family: 'Kanit', sans-serif;" value="{{$planrepair->REPAIR_PLAN_BEGIN_TIME}}">
                                                                        </div>

                                                                        <div class="col-lg-1">
                                                                        <label >ถึงเวลา</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input type="text" class="js-masked-time form-control" id="REPAIR_PLAN_END_TIME" name="REPAIR_PLAN_END_TIME" style=" font-family: 'Kanit', sans-serif;" value="{{$planrepair->REPAIR_PLAN_END_TIME}}">
                                                                        </div>    
                                                                        </div>
                                                                <div class="row push">
                                                                        <div class="col-lg-1 ">
                                                                        <label >หมายเหตุ</label>
                                                                        </div>
                                                                        <div class="col-lg-11">
                                                                        <input  name = "REPAIR_PLAN_REMARK"  id="REPAIR_PLAN_REMARK" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$planrepair->REPAIR_PLAN_REMARK}}" >
                                                                        </div>                                                             
                                                               </div> 
                                                               
                                                               {{-- <table class="table-bordered table-striped table-vcenter" style="width: 100%;">
                                                                <thead style="background-color: #FFEBCD;">
                                                                    <tr height="40">
                                                                        <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">รายการปฎิบัติ</td>
                                                                        <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">หมายเหตุ</td>
                                                                        <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="12%">
                                                                            <a class="btn btn-hero-sm btn-hero-success addRow8" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="tbody8">
                                                                   
                                                                </tbody>
                                                            </table> --}}
                                               <div class="modal-footer">
                                               <button type="submit" class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                   <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i> ยกเลิก</button>
                                               </div>
                                           </div> 
                                           </form>  
                                    </div>













                                    
                                    @endforeach  

                    
                                    </tbody></table>
                                   </div>

                                        <div id="maintenanceplan" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                           
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">   
                                                        <label style="font-family: 'Kanit', sans-serif; font-size: 20px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลแผนบำรุงรักษา</label>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form  method="post" action="{{ route('mrepairmedical.saveplanrepairmedical') }}" enctype="multipart/form-data">
                                                                @csrf    

                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                  

                                                                    <div class="row push">
       
                                                                    <div class="col-lg-2">
                                                                    <label >วันที่</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input  name = "REPAIR_PLAN_DATE"  id="REPAIR_PLAN_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" required>
                                                                    </div>
                                                            
                                                                    <div class="col-lg-1">
                                                                    <label >เวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                    <input type="text" class="js-masked-time form-control" id="REPAIR_PLAN_BEGIN_TIME" name="REPAIR_PLAN_BEGIN_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                    </div>

                                                                    <div class="col-lg-1">
                                                                    <label >ถึงเวลา</label>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                    <input type="text" class="js-masked-time form-control" id="REPAIR_PLAN_END_TIME" name="REPAIR_PLAN_END_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                    </div>    
                                                                    </div>
                                                                    <div class="row push">
                                                                    <div class="col-lg-2">
                                                                    <label >หมายเหตุ</label>
                                                                    </div>
                                                                    <div class="col-lg-10">
                                                                    <input  name="REPAIR_PLAN_REMARK"  id="REPAIR_PLAN_REMARK" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" required>
                                                                    </div>

                                                                    </div>

                                                                    <table class="table gwt-table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <td style="text-align: center;" width="40%">รายการปฏิบัติ</td>
                                                                                    <td style="text-align: center;" >หมายเหตุ</td>
                                                                                    <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow2" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                                                                </tr>
                                                                            </thead> 
                                                                            <tbody class="tbody2">                                                                            
                                                                                <tr>
                                                                                    <td> 
                                                                                    <select name="REPAIR_PLAN_SUB_NAME[]" id="REPAIR_PLAN_SUB_NAME[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                                    <option value="">--กรุณาเลือกรายการ--</option>  
                                                                                    @foreach ($detailplans as $detailplan)
                                                                                    <option value="{{$detailplan->CARE_LIST_NAME}}">{{$detailplan->CARE_LIST_NAME}}</option>  
                                                                                    @endforeach 

                                                                                    </select>   
                                                                                    </td>
                
                                                                                    <td> 
                                                                                    <input name="REPAIR_PLAN_SUB_REMARK[]" id="REPAIR_PLAN_SUB_REMARK[]" class="form-control input-sm"  >  
                                                                                    </td>                                                
                                                                                
                                                                                    <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                                                                </tr>
                                                                        </tbody>   
                                                                    </table>
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                                </div>
                                                                </div>
                                                            </form>  
                                                    </div>
                                                </div>
                                            </div>


        <div class="tab-pane" id="object4" role="tabpanel">
                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#plan"><i class="fas fa-plus"></i> เพิ่มรายการบำรุงรักษา</button>
                            <br><br>
                            <div id="detail_plan">
                                     <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                          <tr>
                                          <th style="text-align: center;">รายการบำรุงรักษา</th>
                                
                                          <th style="text-align: center;" width="10%">คำสั่ง</th> 
                                      
                                          </tr>
                                      </thead><tbody>                                    
                                  
                                      @foreach ($detailplans as $detailplan)
                                    <tr ><td class="text-font text-pedding" >{{$detailplan->CARE_LIST_NAME}}</td>
                                 
                                        <td>
                                            <div class="dropdown" align="center">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family:'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                        <div class="dropdown-menu" style="width:10px">

                                                            <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" data-toggle="modal" data-target="#editplan{{$detailplan->CARE_LIST_ID}}">แก้ไขข้อมูล</a> 
                                                            
                                                            <a class="dropdown-item"  href="{{url('manager_repairmedical/repairmedicalinfoasset_carelist_destroy/'.$repairmedicalinfoasset->ARTICLE_ID.'/'.$detailplan->CARE_LIST_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>       
                                                        
                                                        </div>
                                                </div>                                            
                                            </td>                                    
                                        </td>
                                    
                                        <div id="editplan{{$detailplan->CARE_LIST_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                              
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                            <div class="modal-header">        
                                                            <label for="" style="font-family: 'Kanit', sans-serif; font-size: 20px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขรายการบำรุงรักษา</label>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form  method="post" action="{{ route('mrepairmedical.repairmedicalassetupdate_carelist') }}" enctype="multipart/form-data">
                                                                @csrf 

                                                            <div class="row push">
                                                                <div class="col-lg-2">
                                                                <label >รายการบำรุงรักษา</label>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                <input  name = "CARE_LIST_NAME"  id="CARE_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$detailplan->CARE_LIST_NAME}}">
                                                                </div>
                                                            </div>         
                                                        </div> 
                                                        <input type="hidden" name="PLAN_ARTICLE_ID" id="PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                        <input type="hidden" name="CARE_LIST_ID" id="CARE_LIST_ID" class="form-control input-sm "  value="{{$detailplan->CARE_LIST_ID}}">
                                                                                                            
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i> ยกเลิก</button>
                                                </div>
                                            </div>  
                                            </form>
                                        </div>                                    
                                    </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            </div>
  
                            <div id="plan" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                              
                                              <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                               <div class="modal-header">        
                                                              <label style="font-family: 'Kanit', sans-serif; font-size: 20px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มรายการบำรุงรักษา</label>
                                                              </div>
                                                              <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.repairmedicalassetsave_carelist') }}" enctype="multipart/form-data">
                                                                    @csrf 
    
                                                              <div class="row push">
                                                                    <div class="col-lg-2">
                                                                    <label >รายการบำรุงรักษา</label>
                                                                    </div>
                                                                    <div class="col-lg-10">
                                                                    <input  name = "CARE_LIST_NAME"  id="CARE_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                    </div>
                                                                </div>         
                                                          </div> 
                                                          <input type="hidden" name="PLAN_ARTICLE_ID" id="PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                                                              
                                                  <div class="modal-footer">
                                                  {{-- <button type="button" class="btn btn-info"   data-dismiss="modal" onclick="saveplan();">บันทึกข้อมูล</button> --}}
                                                  <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                      <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i> ยกเลิก</button>
                                                  </div>
                                                  </div>  
                                                  </form>
                                              </div>
                    </div>
        </div>  


        <div class="tab-pane" id="object5" role="tabpanel"> 
                                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#plan5"><i class="fas fa-plus"></i> เพิ่มการสอบเทียบคุณภาพ(CAL)</button>
                                   <br><br>
                                   <div id="detail_maintenance">
                                   <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                        <tr>
                                        <th style="text-align: center;">วันที่สอบเทียบ</th>
                                        <th style="text-align: center;">เวลา</th> 
                                        <th style="text-align: center;">ประเภท</th> 
                                        <th style="text-align: center;"  width="12%">คำสั่ง</th>                                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calibrations as $calibration)
                                        <tr >
                                            <td class="text-font text-pedding" >{{DateThai($calibration->ASSET_CALIBRATION_DATE)}}</td>
                                            <td class="text-font text-pedding" >{{$calibration->ASSET_CALIBRATION_TIME}}</td>
                                            <td class="text-font text-pedding" >{{$calibration->ASSET_CALIBRATION_TYPE}}</td>
                                          
                                            <td  align="center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                                ทำรายการ
                                                            </button>
                                                            <div class="dropdown-menu" style="width:10px">                                           
                                                            <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" data-toggle="modal" data-target="#plan5{{$calibration->ASSET_CALIBRATION_ID}}">ดูรายละเอียด</a>                                
                                                                <a class="dropdown-item"  href="{{url('manager_repairmedical/repairmedicalinfoasset_calibration_destroy/'.$repairmedicalinfoasset->ARTICLE_ID.'/'.$calibration->ASSET_CALIBRATION_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>                                                                  
                                                            </div>
                                                </div>                                            
                                            </td>
                                                                          

                                            <div id="plan5{{$calibration->ASSET_CALIBRATION_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                
                                                <div class="modal-dialog modal-xl">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                                <div class="modal-header">        
                                                                <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการสอบเทียบคุณภาพ(CAL)</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.repairmedicalinfoasset_calibration_update') }}" enctype="multipart/form-data">
                                                                @csrf 

                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm " value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                    <input type="hidden" name="ASSET_CALIBRATION_ID" id="ASSET_CALIBRATION_ID" class="form-control input-sm "  value="{{$calibration->ASSET_CALIBRATION_ID}}">

                                                                <div class="row push">
                                                                        <div class="col-sm-2 text-right">
                                                                        <label >วันที่สอบเทียบ</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        {{formate($calibration->ASSET_CALIBRATION_DATE)}}
                                                                        </div>
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >เวลา</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        {{$calibration->ASSET_CALIBRATION_TIME}}
                                                                        </div>
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >ประเภท</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        {{$calibration->ASSET_CALIBRATION_TYPE}}
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    @foreach ($calibrationsubs as $calibrationsub)
                                                                    <div class="row push">
                                                                            <div class="col-lg-2 text-right">
                                                                            <label >รายการสอบเทียบ</label>
                                                                            </div>                                                                       
                                                                            <div class="col-lg-4">
                                                                            {{$calibrationsub->ASSET_CALIBRATION_SUB_LIST_NAME}}
                                                                            </div>
                                                                            <div class="col-lg-2 text-right">
                                                                            <label>ผลการสอบเทียบ</label>
                                                                            </div>                                                                       
                                                                            <div class="col-lg-3">
                                                                            {{$calibrationsub->ASSET_CALIBRATION_SUB_LISTTRUE}}
                                                                            </div>
                                                                        </div>
                                                                            <div class="row push">
                                                                            
                                                                                <div class="col-lg-2 text-right">
                                                                                <label >หมายเหตุ</label>
                                                                                </div>                                                                       
                                                                                <div class="col-lg-9">
                                                                                {{$calibrationsub->ASSET_CALIBRATION_SUB_COMMENT}}
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    @endforeach  
                                                    <div class="modal-footer">
                                                    <!-- <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button> -->
                                                        <button type="button" class="btn btn-secondary"   data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>  
                                                    </form>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach   
                                    </tbody>
                    </table>
                   
                </div>  

                <div id="plan5" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">                                                
                        <div class="modal-dialog modal-xl">
                            <!-- Modal content-->
                            <div class="modal-content">
                                        <div class="modal-header">        
                                            <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มการสอบเทียบคุณภาพ(CAL)</h4>
                                        </div>
                                        <div class="modal-body">
                                <form  method="post" action="{{ route('mrepairmedical.repairmedicalinfoasset_calibration_save') }}" enctype="multipart/form-data">
                                    @csrf 

                                            <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                            <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                            
                                            <div class="row push">
                                                <div class="col-sm-2 text-right">
                                                <label >วันที่สอบเทียบ</label>
                                                </div>
                                                <div class="col-lg-2">
                                                <input  name = "ASSET_CALIBRATION_DATE"  id="ASSET_CALIBRATION_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                </div>
                                                <div class="col-lg-1 text-right">
                                                <label >เวลา</label>
                                                </div>
                                                <div class="col-lg-2">
                                                <input type="text" class="js-masked-time form-control" id="ASSET_CALIBRATION_TIME" name="ASSET_CALIBRATION_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                </div>
                                                <div class="col-lg-1 text-right">
                                                <label >ประเภท</label>
                                                </div>
                                                <div class="col-lg-3">
                                                <input  name = "ASSET_CALIBRATION_TYPE"  id="ASSET_CALIBRATION_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                </div>
                                            </div>
                                           
                                            <table class="table gwt-table" >
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: center;" width="40%">รายการสอบเทียบ</td>
                                                        <td style="text-align: center;" width="15%">ผลการสอบเทียบ</td>                                                    
                                                        <td style="text-align: center;" >หมายเหตุ</td>                                        
                                                        <td style="text-align: center;" width="15%"><a  class="btn btn-success fa fa-plus addRow5" style="color:#FFFFFF;"></a></td>
                                                    </tr>
                                                </thead> 
                                                <tbody class="tbody5">                                                                            
                                                    <tr>
                                                        <td> 
                                                            <select name="ASSET_CALIBRATION_SUB_LIST[]" id="ASSET_CALIBRATION_SUB_LIST[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="">--กรุณาเลือกรายการ--</option>  
                                                                    @foreach ($calibration_lists as $calibration_list)
                                                                        <option value="{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}">{{$calibration_list->ASSET_CALIBRATION_LIST_NAME}}</option>  
                                                                    @endforeach  
                                                            </select>   
                                                        </td>
                                                        <td> 
                                                            <select name="ASSET_CALIBRATION_SUB_LISTTRUE[]" id="ASSET_CALIBRATION_SUB_LISTTRUE[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="ผ่าน">ผ่าน</option>  
                                                                <option value="ไม่ผ่าน">ไม่ผ่าน</option>  
                                                            </select>    
                                                        </td>
                                                        <td> 
                                                            <input name="ASSET_CALIBRATION_SUB_COMMENT[]" id="ASSET_CALIBRATION_SUB_COMMENT[]" class="form-control input-sm"  >  
                                                        </td>  
                                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove5" style="color:#FFFFFF;"></a></td>
                                                    </tr>
                                                </tbody>   
                                            </table>
                                        <div class="modal-footer">
                                            <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                                                <button type="button" class="btn btn-danger"   data-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </div>  
                                </form>
                            </div>
                        </div>
                </div>                                     
        </div>


        <div class="tab-pane" id="object6" role="tabpanel">
                    <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#plantest"><i class="fas fa-plus"></i> เพิ่มแผนสอบเทียบ</button>
                                    
                                   <br><br>
                                        <div >
                                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                                    <thead style="background-color: #FFEBCD;">
                                                        <tr>
                                                        <th style="text-align: center;">วันที่</th>
                                                        <th style="text-align: center;">เวลา</th>
                                                        <!-- <th style="text-align: center;" >สอบแล้ว</th> -->
                                                        <th style="text-align: center;">หมายเหตุ</th>
                                                        <th   style="text-align: center;" width="12%">คำสั่ง</th>                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($calibration_trues as $calibration_true)
                                                        <tr >
                                                            <td class="text-font text-pedding" >{{DateThai($calibration_true->ASSET_CALIBRATIONTRUE_DATE)}}</td>
                                                            <td class="text-font text-pedding" >{{$calibration_true->ASSET_CALIBRATIONTRUE_TIME}}</td>                                                            
                                                            <td class="text-font text-pedding" >{{$calibration_true->ASSET_CALIBRATIONTRUE_COMMENT}}</td>
                                                            <td  align="center">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                                            ทำรายการ
                                                                        </button>
                                                                        <div class="dropdown-menu" style="width:10px">                                           
                                                                            <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" data-toggle="modal" data-target="#plantest{{$calibration_true->ASSET_CALIBRATIONTRUE_ID}}">ดูรายละเอียดข้อมูล</a>                                
                                                                            <a class="dropdown-item"  href="{{url('manager_repairmedical/repairmedicalinfoasset_calibration_true_destroy/'.$repairmedicalinfoasset->ARTICLE_ID.'/'.$calibration_true->ASSET_CALIBRATIONTRUE_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>                                                    
                                                                        </div>
                                                                </div>                                            
                                                            </td>
                                                        </tr>                                     
                                                        <div id="plantest{{$calibration_true->ASSET_CALIBRATIONTRUE_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                
                                                <div class="modal-dialog modal-xl">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                                <div class="modal-header">        
                                                                <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดแผนสอบเทียบ</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.repairmedicalinfoasset_calibration_true_update') }}" enctype="multipart/form-data">
                                                                @csrf 

                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                    <input type="hidden" name="ASSET_CALIBRATIONTRUE_ID" id="ASSET_CALIBRATIONTRUE_ID" class="form-control input-sm "  value="{{$calibration_true->ASSET_CALIBRATIONTRUE_ID}}">
                                                                    
                                                                <div class="row push">
                                                                        <div class="col-lg-2 text-right">
                                                                        <label >วันที่</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input  name = "ASSET_CALIBRATIONTRUE_DATE"  id="ASSET_CALIBRATIONTRUE_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate($calibration_true->ASSET_CALIBRATIONTRUE_DATE)}}" readonly>
                                                                        </div>
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >เวลา</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input type="text" class="js-masked-time form-control" id="ASSET_CALIBRATIONTRUE_TIME" name="ASSET_CALIBRATIONTRUE_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{$calibration_true->ASSET_CALIBRATIONTRUE_TIME}}">
                                                                        </div>
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >หมายเหตุ</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                        <input  name = "ASSET_CALIBRATIONTRUE_COMMENT"  id="ASSET_CALIBRATIONTRUE_COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$calibration_true->ASSET_CALIBRATIONTRUE_COMMENT}}">
                                                                        </div>
                                                                    </div>
                                                                  
                                                                    @foreach ($calibration_truesubs as $calibration_truesub)
                                                                    <div class="row push">
                                                                            <div class="col-lg-2 text-right">
                                                                            <label >รายการสอบเทียบ</label>
                                                                            </div>                                                                       
                                                                                                                                              
                                                                                <div class="col-lg-9">
                                                                                {{$calibration_truesub->ASSET_CALIBRATIONTRUE_SUB_LIST_NAME}}
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    @endforeach  

                                                                                                                    
                                                        
                                                    <div class="modal-footer">
                                                    <!-- <button type="submit" class="btn btn-info"  >บันทึกข้อมูล</button> -->
                                                        <button type="button" class="btn btn-secondary"   data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div> 
                                                    </form> 
                                                </div>
                                                </div>

                                                    @endforeach   
                                                    
                                                    </tbody>
                                                </table>                                   
                                        </div>

                                        <div id="plantest" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                
                                                <div class="modal-dialog modal-xl">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                                <div class="modal-header">        
                                                                <h4  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มแผนสอบเทียบ</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.repairmedicalinfoasset_calibration_true_save') }}" enctype="multipart/form-data">
                                                                @csrf 

                                                                <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                    
                                                                <div class="row push">
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >วันที่</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input  name = "ASSET_CALIBRATIONTRUE_DATE"  id="ASSET_CALIBRATIONTRUE_DATE" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                                                        </div>
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >เวลา</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                        <input type="text" class="js-masked-time form-control" id="ASSET_CALIBRATIONTRUE_TIME" name="ASSET_CALIBRATIONTRUE_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" >
                                                                        </div>
                                                                        <div class="col-lg-1 text-right">
                                                                        <label >หมายเหตุ</label>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                        <input  name = "ASSET_CALIBRATIONTRUE_COMMENT"  id="ASSET_CALIBRATIONTRUE_COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        </div>
                                                                    </div>
                                                                    <table class="table gwt-table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <td style="text-align: center;" >รายการสอบเทียบ</td>                                                                                                                                      
                                                                                    <!-- <td style="text-align: center;" >หมายเหตุ</td>  -->
                                                                                    <td style="text-align: center;" width="15%"><a  class="btn btn-hero-sm btn-hero-success addRow66" style="color:#FFFFFF;"><i class="fa fa-plus"></i> </a></td>
                                                                                </tr>
                                                                            </thead> 
                                                                            <tbody class="tbody66">                                                                            
                                                                                <tr>
                                                                                    <td> 
                                                                                        <select name="ASSET_CALIBRATIONTRUE_SUB_LIST[]" id="ASSET_CALIBRATIONTRUE_SUB_LIST[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                                            <option value="">--กรุณาเลือกรายการ--</option>  
                                                                                                @foreach ($calibration_lists as $calibration_list)
                                                                                                    <option value="{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}">{{$calibration_list->ASSET_CALIBRATION_LIST_NAME}}</option>  
                                                                                                @endforeach  
                                                                                        </select>   
                                                                                    </td>                                                                                   
                                                                                   
                                                                                    <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove66" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                                                                </tr>
                                                                            </tbody>   
                                                                        </table>                                                      
                                                        
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-save mr-2"></i> บันทึกข้อมูล</button>
                                                        <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                    </div>
                                                    </div> 
                                                    </form> 
                                                </div>
                                                </div>
            </div> 

        </div> 



        <div class="tab-pane" id="object7" role="tabpanel">
                <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;" data-toggle="modal" data-target="#plantest2"><i class="fas fa-plus"></i> เพิ่มรายการสอบเทียบ</button>
                                     <br><br>
                                     <div id="detail_plan">
                                     <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                     <thead style="background-color: #FFEBCD;">
                                          <tr>
                                          <th style="text-align: center;">รายการสอบเทียบ</th>
                                
                                          <th style="text-align: center;" width="12%">คำสั่ง</th> 
                                      
                                          </tr>
                                      </thead>
                                      <tbody>

                                      @foreach ($calibration_lists as $calibration_list)
                                                        <tr >
                                                            <td class="text-font text-pedding" >{{$calibration_list->ASSET_CALIBRATION_LIST_NAME}}</td>                                                           
                                                            <td  align="center">
                                                                <div class="dropdown">
                                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                                                ทำรายการ
                                                                            </button>
                                                                            <div class="dropdown-menu" style="width:10px">                                           
                                                                                <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" data-toggle="modal" data-target="#editplantest2{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}">แก้ไขข้อมูล</a>                                                    
                                                                                <a class="dropdown-item"  href="{{url('manager_repairmedical/repairmedicalinfoasset_calibration_list_destroy/'.$repairmedicalinfoasset->ARTICLE_ID.'/'.$calibration_list->ASSET_CALIBRATION_LIST_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>                                                   
                                                                            </div>
                                                                    </div>                                            
                                                            </td>                                                                                           
                                                            <div id="editplantest2{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                 <div class="modal-dialog modal-xl">                                                
                                                                        <div class="modal-content">
                                                                                    <div class="modal-header">        
                                                                                  
                                                                                    <label style="font-family: 'Kanit', sans-serif; font-size: 20px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขรายการสอบเทียบ</label>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                    <form  method="post" action="{{ route('mrepairmedical.repairmedicalinfoasset_calibration_list_update') }}" enctype="multipart/form-data">
                                                                                    @csrf 

                                                                                        <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                                        <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                                        <input type="hidden" name="ASSET_CALIBRATION_LIST_ID" id="ASSET_CALIBRATION_LIST_ID" class="form-control input-sm "  value="{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}">

                                                                                    <div class="row push">
                                                                                            <div class="col-lg-2 text-right">
                                                                                            <label >รายการสอบเทียบ</label>
                                                                                            </div>
                                                                                            <div class="col-lg-9">
                                                                                            <input  name = "ASSET_CALIBRATION_LIST_NAME"  id="ASSET_CALIBRATION_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$calibration_list->ASSET_CALIBRATION_LIST_NAME}}" >
                                                                                            </div>                                                             
                                                                                        </div>  
                                                                        <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                            <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i> ยกเลิก</button>
                                                                        </div>
                                                                    </div> 
                                                                    </form>  
                                                                </div>
                                                            <!-- </div> -->
                                                        </tr> 
                                                    @endforeach                             
                
                                      </tbody>
                                      </table>
                                     </div> 
                                     <div id="plantest2" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                
                                                <div class="modal-dialog modal-xl">                                                
                                                    <div class="modal-content">
                                                                <div class="modal-header">        
                                                               
                                                                <label style="font-family: 'Kanit', sans-serif; font-size: 20px;font-weight:normal;">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มรายการสอบเทียบ</label>
                                                                </div>
                                                                <div class="modal-body">
                                                                <form  method="post" action="{{ route('mrepairmedical.repairmedicalinfoasset_calibration_list_save') }}" enctype="multipart/form-data">
                                                                @csrf 

                                                                <input type="hidden" name="REPAIR_PLAN_ARTICLE_ID" id="REPAIR_PLAN_ARTICLE_ID" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_ID}}">
                                                                    <input type="hidden" name="REPAIR_PLAN_ARTICLE_NUM" id="REPAIR_PLAN_ARTICLE_NUM" class="form-control input-sm "  value="{{$repairmedicalinfoasset->ARTICLE_NUM}}">
                                                                    
                                                                <div class="row push">
                                                                        <div class="col-lg-2 text-right">
                                                                        <label >รายการสอบเทียบ</label>
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                        <input  name = "ASSET_CALIBRATION_LIST_NAME"  id="ASSET_CALIBRATION_LIST_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                                                                        </div>                                                             
                                                                    </div>  
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i> บันทึกข้อมูล</button>
                                                        <button type="button" class="btn btn-hero-sm btn-hero-danger"   data-dismiss="modal"><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                    </div>
                                                </div> 
                                            </form>  
                                        </div>
                                     </div>
                </div> 
        </div> 


                              
                                       
                     
@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
    

<script>


$('.addRow1').on('click',function(){
   
   addRow1();
});

function addRow1(){
  var count = $('.tbody1').children('tr').length;
   var tr ='<tr>'+
   '<td>'+ 
   '<select name="REPAIR_PLAN_SUB_NAME[]" id="REPAIR_PLAN_SUB_NAME[]" class="form-control input-lg" style=" font-family:\'Kanit\', sans-serif;" >'+
   '<option value="">--กรุณาเลือกรายการ--</option>'+  
   '@foreach ($detailplans as $detailplan)'+
   '<option value="{{$detailplan->CARE_LIST_NAME}}">{{$detailplan->CARE_LIST_NAME}}</option>'+  
   '@endforeach'+                                                                
   '</select>'+   
   '</td>'+
   '<td>'+ 
   '<select name="REPAIR_PLAN_SUB_RESULT[]" id="REPAIR_PLAN_SUB_RESULT[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
   '<option value="ปกติ">ปกติ</option>'+  
   '<option value="ผิดปกติ">ผิดปกติ</option>'+                                                             
   '</select>'+    
   '</td>'+
   '<td>'+ 
   '<input name="REPAIR_PLAN_SUB_REMARK[]" id="REPAIR_PLAN_SUB_REMARK[]" class="form-control input-sm"  >'+  
   '</td>'+                                               
   '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove1" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
   '</tr>';
  $('.tbody1').append(tr);
};

$('.tbody1').on('click','.remove1', function(){
      $(this).parent().parent().remove();
});
//-------------------------------------------------------------------

$('.addRow2').on('click',function(){
   
   addRow2();
});

function addRow2(){
  var count = $('.tbody2').children('tr').length;
   var tr ='<tr>'+
            '<td>'+ 
            '<select name="REPAIR_PLAN_SUB_NAME[]" id="REPAIR_PLAN_SUB_NAME[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" required>'+
            '<option value="">--กรุณาเลือกรายการ--</option>'+  
            '@foreach ($detailplans as $detailplan)'+
            '<option value="{{$detailplan->CARE_LIST_NAME}}">{{$detailplan->CARE_LIST_NAME}}</option>'+  
            '@endforeach'+ 
            '</select>'+   
            '</td>'+
            '<td>'+ 
            '<input name="REPAIR_PLAN_SUB_REMARK[]" id="REPAIR_PLAN_SUB_REMARK[]" class="form-control input-sm"  >'+  
            '</td>'+ 
            '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove2" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
            '</tr>';
  $('.tbody2').append(tr);
};

$('.tbody2').on('click','.remove2', function(){
      $(this).parent().parent().remove();
});

//-------------------------------------------------------------------

$('.addRow5').on('click',function(){
   
   addRow5();
});

function addRow5(){
  var count = $('.tbody5').children('tr').length;
   var tr ='<tr>'+
            '<td>'+ 
            '<select name="ASSET_CALIBRATION_SUB_LIST[]" id="ASSET_CALIBRATION_SUB_LIST[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="">--กรุณาเลือกรายการ--</option>'+  
            '@foreach ($calibration_lists as $calibration_list)'+
            '<option value="{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}">{{$calibration_list->ASSET_CALIBRATION_LIST_NAME}}</option>'+  
            '@endforeach'+ 
            '</select>'+   
            '</td>'+
            '<td>'+
            '<select name="ASSET_CALIBRATION_SUB_LISTTRUE[]" id="ASSET_CALIBRATION_SUB_LISTTRUE[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="ผ่าน">ผ่าน</option>'+  
            '<option value="ไม่ผ่าน">ไม่ผ่าน</option>'+                                                             
            '</select>'+  
            '</td>'+
            '<td>'+ 
            '<input name="ASSET_CALIBRATION_SUB_COMMENT[]" id="ASSET_CALIBRATION_SUB_COMMENT[]" class="form-control input-sm">'+  
            '</td>'+ 
            '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove5" style="color:#FFFFFF;"></a></td>'+
            '</tr>';
  $('.tbody5').append(tr);
};

$('.tbody5').on('click','.remove5', function(){
      $(this).parent().parent().remove();
});
//-------------------------------------------------------------------

$('.addRow66').on('click',function(){
   
   addRow66();
});

function addRow66(){
  var count = $('.tbody66').children('tr').length;
   var tr ='<tr>'+
            '<td>'+ 
            '<select name="ASSET_CALIBRATIONTRUE_SUB_LIST[]" id="ASSET_CALIBRATIONTRUE_SUB_LIST[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="">--กรุณาเลือกรายการ--</option>'+  
            '@foreach ($calibration_lists as $calibration_list)'+
            '<option value="{{$calibration_list->ASSET_CALIBRATION_LIST_ID}}">{{$calibration_list->ASSET_CALIBRATION_LIST_NAME}}</option>'+  
            '@endforeach'+ 
            '</select>'+   
            '</td>'+     
            '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove66" style="color:#FFFFFF;"></a></td>'+
            '</tr>';
  $('.tbody66').append(tr);
};

$('.tbody66').on('click','.remove66', function(){
      $(this).parent().parent().remove();
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



    function saveplan(){

var PLAN_CARE_LIST_NAME=document.getElementById("PLAN_CARE_LIST_NAME").value;
var PLAN_ARTICLE_ID=document.getElementById("PLAN_ARTICLE_ID").value;



    //alert(type_vehicle_id);
    
        var _token=$('input[name="_token"]').val();
         $.ajax({
                 url:"{{route('mcar.saveplan')}}",
                 method:"GET",
                 data:{PLAN_CARE_LIST_NAME:PLAN_CARE_LIST_NAME,PLAN_ARTICLE_ID:PLAN_ARTICLE_ID,_token:_token},
                 success:function(result){
                    $('#detail_plan').html(result);
                    clearplan();
                 }
         })

}

function clearplan(){
    PLAN_CARE_LIST_NAME.value = '';
}  



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


</script>


@endsection