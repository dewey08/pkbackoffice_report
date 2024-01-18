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
                         
จ่ายวัสดุ
                
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
                            วันที่ขอเบิก :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            เหตุผล:              
        </label>
        </div> 
        <div class="col-lg-4">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        </div>

        <br>


       <div class="row">
       
        <div class="col-lg-1" style="text-align: left">
        <label>ผู้ขอเบิก :</label>
        </div> 
        <div class="col-lg-2">
        <input name="MIN" id="MIN" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
        <div class="col-lg-1 " style="text-align: left">
        <label>หน่วยงานที่ขอ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
        <div class="col-lg-1 " style="text-align: left">
        <label>คลัง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
        <div class="col-lg-1" style="text-align: left">
        <label>ประเภทรอบ  :</label>
        </div> 
        <div class="col-lg-2">
        <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
       </div>
       <br>
 
       
       <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center; font-size: 13px;">ลำดับ</td>
                                                <td style="text-align: center; font-size: 13px;" width="20%">รายการ</td>
                                                <td style="text-align: center; font-size: 13px;" >ประเภท</td>
                                                <td style="text-align: center; font-size: 13px;" >หน่วย</td>
                                                <td style="text-align: center; font-size: 13px;" >จำนวนจ่าย/td>
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




        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >ตรวจรับ</button>
        <a href="{{ url('manager_warehouse/disburse')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
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