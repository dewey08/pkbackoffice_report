@extends('layouts.warehouse')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 




?>
<?php
      
  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

  
?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 12px;
            }

            table, td, th {
            border: 1px solid black;
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
</style>

<body onload="run01();">

<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
                         
                          ตรวจรับพัสดุ
                
</B></h3>

</div>
<br>
<form  method="post" action="{{ route('mwarehouse.updateinfochecksup') }}" enctype="multipart/form-data">
@csrf


<input type="hidden" name="RECEIVE_ID" id="RECEIVE_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infocheckreceive->RECEIVE_ID}}" >

        <div class="col-sm-12">
        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            รหัส :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="RECEIVE_CODE" id="RECEIVE_CODE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infocheckreceive->RECEIVE_CODE}}" readonly>
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            เลขที่เอกสาร :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="RECEIVE_NUMBER" id="RECEIVE_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-2" style="text-align: left">
        <label >                           
                            ผู้ตรวจรับเข้า :              
        </label>
        </div> 
        <div class="col-lg-4">
        
                <select name="RECEIVE_PERSON_ID" id="RECEIVE_PERSON_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                            @foreach ($infopersons as $infoperson) 
                                    @if($infoperson -> ID == $id_user)
                                    <option value="{{ $infoperson -> ID }}" selected>{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>                                          
                                    @else
                                    <option value="{{ $infoperson -> ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>                                          
                                    @endif 
                                   
                            @endforeach  
                </select> 
        
        </div> 
        </div>

        <br>

        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            คลัง :              
        </label>
        </div> 
        <div class="col-lg-2">
       
        
        <select name="RECEIVE_STORE" id="RECEIVE_STORE" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
        <option value="" >--เลือกคลัง--</option>                                          
            @foreach ($infosuppliesinvens as $infosuppliesinven)  
                <option value="{{ $infosuppliesinven -> INVEN_ID }}" >{{ $infosuppliesinven -> INVEN_NAME }}</option>                                          
             @endforeach  
        </select> 



        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        เลข PO :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="RECEIVE_PO" id="RECEIVE_PO" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infocheckreceive->RECEIVE_PO}}" >
        </div> 
        <div class="col-lg-2" style="text-align: left">
        <label >                           
            วันที่กรรมการตรวจรับ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="RECEIVE_CHECK_DATE" id="RECEIVE_CHECK_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
        </div> 
      
    </div>
        <br>
       <div class="row">
       
        <div class="col-lg-1" style="text-align: left">
        <label>รับจาก :</label>
        </div> 
        <div class="col-lg-5">
       
       
        <select name="RECEIVE_ACCEPT_FROM" id="RECEIVE_ACCEPT_FROM" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
        <option value="" >--เลือกที่มา--</option>                                          
            @foreach ($infosuppliesvendors as $infosuppliesvendor) 
                @if($infosuppliesvendor -> VENDOR_NAME == $infocheckreceive->RECEIVE_ACCEPT_FROM)
                <option value="{{ $infosuppliesvendor -> VENDOR_NAME }}" selected>{{ $infosuppliesvendor -> VENDOR_NAME }}</option>                                          
                @else
                <option value="{{ $infosuppliesvendor -> VENDOR_NAME }}" >{{ $infosuppliesvendor -> VENDOR_NAME }}</option>                                          
                @endif 
               
             @endforeach  
        </select> 
       
       
       
       
        </div>

        
        <div class="col-lg-2" style="text-align: left">
            <label >                           
                วันที่ตรวจรับเข้าคลัง :              
            </label>
            </div> 
            <div class="col-lg-2 text-left">
          
            <input name="RECEIVE_CHECKSTOR_DATE" id="RECEIVE_CHECKSTOR_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 13px;"value="{{formate($infocheckreceive->RECEIVE_CHECKSTOR_DATE)}}" readonly>
    
            </div> 
            <div class="col-lg-1">
            <label style="text-align: left">                           
                                เวลา :              
            </label>
            </div> 
            <div class="col-lg-1 text-left">
            
            <input type="text" name="RECEIVE_CHECK_TIME" id="RECEIVE_CHECK_TIME" class="form-control js-masked-time  input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" value="{{$infocheckreceive->RECEIVE_CHECK_TIME}}">
            </div> 
            </div>
  
        
       </div>
       <br>
       <div class="row">
       
        <div class="col-lg-1" style="text-align: left">
        <label>ประเภทวัสดุ :</label>
        </div> 
        <div class="col-lg-5">
       
       
        <select name="RECEIVE_SUP_TYPE" id="RECEIVE_SUP_TYPE"
            class="form-control input-sm js-example-basic-single"
            style=" font-family: 'Kanit', sans-serif;" required>
                <option value="" selected>--กรุณาเลือกวัสดุครุภัณฑ์--</option>
            @foreach ($suppliestypes as $suppliestype)
               
                <option value="{{ $suppliestype->SUP_TYPE_ID }}">{{ $suppliestype -> SUP_TYPE_NAME }}</option>
               
                
            @endforeach
        </select>
        </div>

        <div class="col-lg-2 " style="text-align: left">
            <label>ปีงบประมาณ :</label>
            </div> 
            <div class="col-lg-2 text-left">
           
                    <select name="RECEIVE_BUDGET_YEAR" id="RECEIVE_BUDGET_YEAR" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                @foreach ($infobudgetyears as $infobudgetyear) 
    
                               
                                 @if($infobudgetyear -> LEAVE_YEAR_ID == $yearbudget)
                                 <option value="{{ $infobudgetyear -> LEAVE_YEAR_ID }}" selected>{{ $infobudgetyear -> LEAVE_YEAR_ID }}</option>                                          
                                 @else
                                 <option value="{{ $infobudgetyear -> LEAVE_YEAR_ID }}" >{{ $infobudgetyear -> LEAVE_YEAR_ID }}</option>                                          
                                 @endif 
                                       
                                @endforeach  
                    </select> 
            
            
            </div>




    </div>
       <br>
 
        


       <div class="row">
       <div class="col-sm-12 row"  align="right">
                                    <div class="col-sm-7"></div> <div class="col-sm-1"><label>รวมมูลค่า </div><div class="col-sm-3 text-left"><input class="form-control input-sm " style="text-align: center;background-color:#E0FFFF ;font-size: 13px;" type="text" name="total" id="total" readonly></div><div class="col-sm-1"><label>  บาท</label></div>
                                        </div><br>
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">วัสดุรับเข้า</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-weight:normal;">กรรมการตรวจรับ</a>
                                    </li>


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                              
                                      
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;">ลำดับ</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" width="20%">รายการรับเข้า</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" width="10%">ประเภท</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" width="10%">หน่วย</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" >จำนวนรับ</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" >ราคาต่อหน่วย</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" >มูลค่า</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" >ล็อตผลิต</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" >วันที่ผลิต</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" >วันที่หมดอายุ</td>
                                                <td style="text-align: center; font-size: 13px;border: 1px solid black;" width="5%"><a  class="btn btn-success" style="color:#FFFFFF;"><i class="fa fa-plus addRow"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        
                                    @if($count == 0)
                                    <tr>
                                        <td style="text-align: center;">
                                             1
                                        </td>
                                        <td>
                                        <select name="RECEIVE_SUB_CODE[]" id="RECEIVE_SUB_CODE[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        
                                        <option value="" >--เลือกวัสดุ--</option>  
                                                 @foreach ($infosuppliess as $infosupplies)  
                                                    @if($infosupplies -> SUP_CODE == '')
                                                    <option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }} </option>     
                                                    @else
                                                    <option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }} [{{ $infosupplies -> SUP_CODE }}]</option>     
                                                    @endif                                     
                                                @endforeach  
                                        </select> 
                                        </td>
                                        <td>
                                        
                                        <select name="RECEIVE_SUB_TYPE[]" id="RECEIVE_SUB_TYPE[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                 @foreach ($infosuptypes as $infosuptype)  
                                                    <option value="{{ $infosuptype -> ID_SUP_TYPE }}" >{{ $infosuptype -> SUP_TYPE_NAME }}</option>                                          
                                                @endforeach  
                                        </select> 
                                        
                                        </td>
                                        <td>
                                        <select name="RECEIVE_SUB_UNIT[]" id="RECEIVE_SUB_UNIT[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="" >--เลือกหน่วย--</option>  
                                                 @foreach ($infosuppliesunitrefs as $infosuppliesunitref)  
                                                
                                                    <option value="{{ $infosuppliesunitref -> ID }}" >{{ $infosuppliesunitref -> SUP_UNIT_NAME }}</option> 
                                                
                                                                                            
                                                @endforeach  
                                        </select> 
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_AMOUNT[]" id="RECEIVE_SUB_AMOUNT0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="checksummoney(0)">
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_PICE_UNIT[]" id="RECEIVE_SUB_PICE_UNIT0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="checksummoney(0)">
                                        </td>
                                        <td>
                                        <div class="summoney0"></div> 
                                        </td>
                                        <td>
                                            <?php  $detallot = 'L'.substr(date("Ymd"),2).'-'.date("His"); ?>
                                            <input name="RECEIVE_SUB_LOT[]" id="RECEIVE_SUB_LOT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$detallot}}" required>
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_GEN_DATE[]" id="RECEIVE_SUB_GEN_DATE[]" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_EXP_DATE[]" id="RECEIVE_SUB_EXP_DATE[]" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                        </td>
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>
                                  
                                  @else

                                        <?php $count=1;?>
                                            @foreach ($infocheckreceivesubs as $infocheckreceivesub)

                                            <tr>
                                        <td style="text-align: center;">
                                             {{$count}}
                                        </td>
                                        <td>
                                        <select name="RECEIVE_SUB_CODE[]" id="RECEIVE_SUB_CODE{{$count}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        
                                        <option value="" >--เลือกวัสดุ--</option>  
                                                 @foreach ($infosuppliess as $infosupplies)  
                                                    @if($infocheckreceivesub->RECEIVE_SUB_CODE == $infosupplies -> ID)
                                                        
                                                        @if($infosupplies->SUP_CODE == '')
                                                            <option value="{{ $infosupplies -> ID }}" selected>{{ $infosupplies -> SUP_NAME }} </option> 
                                                        @else
                                                            <option value="{{ $infosupplies -> ID }}" selected>{{ $infosupplies -> SUP_NAME }} [{{ $infosupplies -> SUP_CODE }}]</option> 
                                                        @endif
                                                       
                                                    @else

                                                        @if($infosupplies->SUP_CODE == '')
                                                            <option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }} </option> 
                                                        @else
                                                            <option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }} [{{ $infosupplies -> SUP_CODE }}]</option> 
                                                        @endif

                                                       
                                                    @endif
                                                                                            
                                                @endforeach  
                                        </select> 
                                        </td>
                                        <td>
                                        
                                        <select name="RECEIVE_SUB_TYPE[]" id="RECEIVE_SUB_TYPE{{$count}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                 @foreach ($infosuptypes as $infosuptype)  
                                                    <option value="{{ $infosuptype -> ID_SUP_TYPE }}" >{{ $infosuptype -> SUP_TYPE_NAME }}</option>                                          
                                                @endforeach  
                                        </select> 
                                        
                                        </td>
                                        <td>

                                       
                                        <select name="RECEIVE_SUB_UNIT[]" id="RECEIVE_SUB_UNIT{{$count}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="" >--เลือกหน่วย--</option>  
                                                 @foreach ($infosuppliesunitrefs as $infosuppliesunitref)  
                                               
                                                    @if( $infosuppliesunitref -> ID == $infocheckreceivesub->RECEIVE_SUB_UNIT)
                                                    <option value="{{ $infosuppliesunitref -> ID }}" selected>{{ $infosuppliesunitref -> SUP_UNIT_NAME }}</option> 
                                                    @else
                                                    <option value="{{ $infosuppliesunitref -> ID }}" >{{ $infosuppliesunitref -> SUP_UNIT_NAME }}</option> 
                                                    @endif
                                                                                            
                                                @endforeach  
                                        </select> 
                                       
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_AMOUNT[]" id="RECEIVE_SUB_AMOUNT{{$count}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infocheckreceivesub->RECEIVE_SUB_AMOUNT}}" onkeyup="checksummoney(<?php echo $count;?>)">
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_PICE_UNIT[]" id="RECEIVE_SUB_PICE_UNIT{{$count}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infocheckreceivesub->RECEIVE_SUB_PICE_UNIT}}" onkeyup="checksummoney(<?php echo $count;?>)">
                                        </td>
                                        <td>
                                        <div class="summoney{{$count}}"></div> 
                                        </td>
                                        <td>
                                            <?php if($infocheckreceivesub->RECEIVE_SUB_LOT <> '' && $infocheckreceivesub->RECEIVE_SUB_LOT <> null){$detallot = $infocheckreceivesub->RECEIVE_SUB_LOT; }else{ $detallot = 'L'.substr(date("Ymd"),2).'-'.date("His"); } ?>
                                            <input name="RECEIVE_SUB_LOT[]" id="RECEIVE_SUB_LOT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$detallot}}" required>
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_GEN_DATE[]" id="RECEIVE_SUB_GEN_DATE[]" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                        </td>
                                        <td>
                                        <input name="RECEIVE_SUB_EXP_DATE[]" id="RECEIVE_SUB_EXP_DATE[]" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" readonly>
                                        </td>
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                    </tr>

                   


                                            <?php  $count++;?>

                                            @endforeach 

                                  @endif
                            
                                    </tbody>   
                                    </table>

                                    </div>


                                    <div class="tab-pane" id="object2" role="tabpanel">
                                      
                                      <table class="table gwt-table"  >
                                          <thead>
                                              <tr>
                                                 
                                                  <td style="text-align: center; font-size: 13px;border: 1px solid black;" width="1000px">ชื่อกรรมการ</td>
                                                  <td style="text-align: center; font-size: 13px;border: 1px solid black;" width="400px">ตำแหน่ง</td>
                                                  
                                          
                                          
                                          
                                                  <td style="text-align: center; font-size: 13px;" width="12%"><a  class="btn btn-success fa fa-plus addRow2" style="color:#FFFFFF;"></a></td>
                                              </tr>
                                          </thead> 
                                          <tbody class="tbody2"> 
                                          
  
                                      <tr>
                                        
                                          <td>
                                         
                                            <select name="RECEIVE_BOARD_PERSON_ID[]" id="RECEIVE_BOARD_PERSON_ID[]" class="form-control input-sm js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="" >--เลือกกรรมการ--</option>                                          
                                                    @foreach ($infopersons as $infoperson) 
                                                    <option value="{{ $infoperson -> ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>                                          
                                                    @endforeach  
                                            </select> 
                                          </td>
                                          <td>
                                        
                                          
                                          <select name="RECEIVE_BOARD_POSITION_ID[]" id="RECEIVE_BOARD_POSITION_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                    <option value="" >--เลือกตำแหน่ง--</option>                                          
                                                  
                                                    <option value="1" >กรรมการ</option>    
                                                    <option value="2" >ประธาน</option>                                          
                                                
                                            </select> 
                                          
                                          
                                          </td>
                                      
                                          <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                                      </tr>
                                    
                              
                                      </tbody>   
                                      </table>
  
                                      </div>

                                    </div>
                             
                        
      
</div>
</div>






        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;">ตรวจรับ</button>
        <a href="{{ url('manager_warehouse/detail')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" style=" font-family: 'Kanit', sans-serif;">ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
         
               
                      

@endsection

@section('footer')


<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

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




    function datepicker(number){
        
        $('.datepicker'+number).datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
   }


   function run01(){
    
    var count = $('.tbody1').children('tr').length;
   
    var number;
        for (number = 1; number < count+1; number++) { 
         
            checksummoney(number);
     
            
        }
      
      
}

$(document).ready(function() {
    $('select').select2();
});
    

$('.addRow').on('click',function(){
        addRow();
        var count = $('.tbody1').children('tr').length;
        var number =  (count).valueOf();
        datepicker(number);
        $('select').select2();

    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();


    var today = new Date();
    var date = String(today.getFullYear()).substring(2)+''+String(today.getMonth()+1).padStart(2, '0')+''+String(today.getDate()).padStart(2, '0');
    var time = String(today.getHours()).padStart(2, '0') + "" + String(today.getMinutes()).padStart(2, '0') + "" + String(today.getSeconds()).padStart(2, '0');;
    var dateTime = 'L'+date+'-'+time;

    
        var tr =   '<tr>'+
                '<td style="text-align: center;">'+
                +number+
                '</td>'+
                '<td>'+
                '<select name="RECEIVE_BOARD_PERSON_ID[]" id="RECEIVE_BOARD_PERSON_ID'+number+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+  
                '<option value="" >--เลือกวัสดุ--</option>'+  
                '@foreach ($infosuppliess as $infosupplies)'+ 
                    '@if($infosupplies -> SUP_CODE == '')'+
                    '<option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }} </option>'+  
                    '@else'+
                    '<option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }} [{{ $infosupplies -> SUP_CODE }}]</option>'+  
                    '@endif'+                                        
                '@endforeach'+  
                '</select>'+ 
                '</td>'+
                '<td>'+         
                '<select name="RECEIVE_SUB_TYPE[]" id="RECEIVE_SUB_TYPE'+number+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                '@foreach ($infosuptypes as $infosuptype)'+  
                '<option value="{{ $infosuptype -> ID_SUP_TYPE }}" >{{ $infosuptype -> SUP_TYPE_NAME }}</option>'+                                          
                '@endforeach'+  
                '</select>'+   
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_UNIT[]" id="RECEIVE_SUB_UNIT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_AMOUNT[]" id="RECEIVE_SUB_AMOUNT'+number+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+number+');">'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_PICE_UNIT[]" id="RECEIVE_SUB_PICE_UNIT'+number+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+number+');">'+
                '</td>'+
                '<td>'+
                '<div class="summoney'+number+'"></div>'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_LOT[]" id="RECEIVE_SUB_LOT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="'+dateTime+'"required>'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_GEN_DATE[]" id="RECEIVE_SUB_GEN_DATE[]" class="form-control input-sm datepicker'+number+'" style=" font-family: \'Kanit\', sans-serif;" readonly>'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_EXP_DATE[]" id="RECEIVE_SUB_EXP_DATE[]" class="form-control input-sm datepicker'+number+'" style=" font-family: \'Kanit\', sans-serif;" readonly>'+
                '</td>'+                  
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});



$('.addRow2').on('click',function(){
        addRow2();
    });

    function addRow2(){
    var count = $('.tbody2').children('tr').length;

        var tr =  '<tr>'+                    
        '<td>'+              
        '<select name="RECEIVE_BOARD_PERSON_ID[]" id="RECEIVE_BOARD_PERSON_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+ 
        '<option value="" >--เลือกกรรมการ--</option>'+                                           
        '@foreach ($infopersons as $infoperson)'+  
        '<option value="{{ $infoperson -> ID }}" >{{ $infoperson -> HR_FNAME }} {{ $infoperson -> HR_LNAME }}</option>'+                                           
        '@endforeach'+   
        '</select>'+  
        '</td>'+ 
        '<td>'+                                
        '<select name="RECEIVE_BOARD_POSITION_ID[]" id="RECEIVE_BOARD_POSITION_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+ 
        '<option value="" >--เลือกตำแหน่ง--</option>'+                                           
        '<option value="1" >กรรมการ</option>'+     
        '<option value="2" >ประธาน</option>'+                                                  
        '</select>'+               
        '</td>'+ 
        '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+ 
        '</tr>';
    $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
});
</script>
<script> 
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



//-----------------------------------------------------



function checksummoney(number){
      
    
      var SUP_TOTAL=document.getElementById("RECEIVE_SUB_AMOUNT"+number).value;
      var PRICE_PER_UNIT=document.getElementById("RECEIVE_SUB_PICE_UNIT"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.checksummoney')}}",
                   method:"GET",
                   data:{SUP_TOTAL:SUP_TOTAL,PRICE_PER_UNIT:PRICE_PER_UNIT,_token:_token},
                   success:function(result){
                      $('.summoney'+number).html(result);
                      findTotal();
                   }
           })
           
  }


  function findTotal(){
    var arr = document.getElementsByName('sum');
    var tot=0;

    count = $('.tbody1').children('tr').length;
    for(var i=0;i<count;i++){
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value =tot.toFixed(5);
}
  

</script>


@endsection