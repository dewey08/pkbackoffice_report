@extends('layouts.warehouse')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}


?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            }
</style>

<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
                         
                          ตรวจรับทั่วไป
                
</B></h3>

</div>


        <div class="col-sm-12">
        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            รหัส :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            เลขที่เอกสาร :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            ผู้ตรวจรับเข้า :              
        </label>
        </div> 
        <div class="col-lg-4">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
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
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        มูลค่า :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            วันที่ตรวจสอบ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-1">
        <label style="text-align: left">                           
                            เวลา :              
        </label>
        </div> 
        <div class="col-lg-1">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        </div>

        <br>
       <div class="row">
       
        <div class="col-lg-1" style="text-align: left">
        <label>รับจาก :</label>
        </div> 
        <div class="col-lg-5">
        <input name="MIN" id="MIN" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
        <div class="col-lg-1 " style="text-align: left">
        <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
        <div class="col-lg-1" style="text-align: left">
        <label>เลข PO :</label>
        </div> 
        <div class="col-lg-1">
        <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
       </div>
       <br>
 
        


       <div class="row">
                        <div class="col-lg-12">
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
                                                <td style="text-align: center; font-size: 13px;">ลำดับ</td>
                                                <td style="text-align: center; font-size: 13px;" width="20%">รายการรับเข้า</td>
                                                <td style="text-align: center; font-size: 13px;" >ประเภท</td>
                                                <td style="text-align: center; font-size: 13px;" >หน่วย</td>
                                                <td style="text-align: center; font-size: 13px;" >จำนวนรับ</td>
                                                <td style="text-align: center; font-size: 13px;" >ราคาต่อหน่วย</td>
                                                <td style="text-align: center; font-size: 13px;" >มูลค่า</td>
                                                <td style="text-align: center; font-size: 13px;" >ล็อตผลิต</td>
                                                <td style="text-align: center; font-size: 13px;" >วันที่ผลิต</td>
                                                <td style="text-align: center; font-size: 13px;" >วันที่หมดอายุ</td>
                                                <td style="text-align: center; font-size: 13px;" width="12%"><a  class="btn btn-success  addRow" style="color:#FFFFFF;"><b>+</b></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        

                                    <tr>
                                        <td> 
                                        <input name="SUP_UNIT_NAME[]" id="SUP_UNIT_NAME[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_TOTAL[]" id="SUP_TOTAL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                    
                                        <td style="text-align: center;"><a class="btn btn-danger fa  remove" style="color:#FFFFFF;"><b>-</b></a></td>
                                    </tr>
                                  
                            
                                    </tbody>   
                                    </table>

                                    </div>


                                    <div class="tab-pane" id="object2" role="tabpanel">
                                      
                                      <table class="table gwt-table" >
                                          <thead>
                                              <tr>
                                                  <td style="text-align: center; font-size: 13px;">ลำดับ</td>
                                                  <td style="text-align: center; font-size: 13px;" >ชื่อกรรมการ</td>
                                                  <td style="text-align: center; font-size: 13px;" >ตำแหน่ง</td>
                                          
                                                  <td style="text-align: center; font-size: 13px;" width="12%"><a  class="btn btn-success fa fa-plus addRow" style="color:#FFFFFF;"></a></td>
                                              </tr>
                                          </thead> 
                                          <tbody class="tbody1"> 
                                          
  
                                      <tr>
                                          <td> 
                                          <input name="SUP_UNIT_NAME[]" id="SUP_UNIT_NAME[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                          </td>
                                          <td>
                                          <input name="SUP_TOTAL[]" id="SUP_TOTAL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                          </td>
                                          <td>
                                          <input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                          </td>
                                      
                                          <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                      </tr>
                                    
                              
                                      </tbody>   
                                      </table>
  
                                      </div>

                                    </div>
                                </div>
                        
      
</div>
</div>
</div>




        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >ตรวจรับ</button>
        <a href="{{ url('manager_warehouse/detail')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
         
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



@endsection