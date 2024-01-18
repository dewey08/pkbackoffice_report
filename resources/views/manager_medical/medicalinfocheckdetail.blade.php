@extends('layouts.warehouse')
    
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

            .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   

</style>

<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
                         
                          รายละเอียดพัสดุตรวจรับ
                
</B></h3>

</div>
<br>

        <div class="col-sm-12">
        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            รหัส :              
        </label>
        </div> 
        <div class="col-lg-2">
        {{$infocheckreceive->RECEIVE_CODE}}
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            เลขที่เอกสาร :              
        </label>
        </div> 
        <div class="col-lg-2">

        {{$infocheckreceive->RECEIVE_NUMBER}}
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            ผู้ตรวจรับเข้า :              
        </label>
        </div> 
        <div class="col-lg-4">
        {{$infocheckreceive->RECEIVE_PERSON_NAME}}
              
        
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
        {{$infocheckreceive->INVEN_NAME}}
        
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
        เลข PO :              
        </label>
        </div> 
        <div class="col-lg-2">
        {{$infocheckreceive->RECEIVE_PO}}
     
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            วันที่ตรวจสอบ :              
        </label>
        </div> 
        <div class="col-lg-2">
        @if($infocheckreceive->RECEIVE_CHECK_DATE !== Null)
        {{DateThai($infocheckreceive->RECEIVE_CHECK_DATE)}}
      @endif
        </div> 
        <div class="col-lg-1">
        <label style="text-align: left">                           
                            เวลา :              
        </label>
        </div> 
        <div class="col-lg-1">
        {{$infocheckreceive->RECEIVE_CHECK_TIME}}
    
        </div> 
        </div>

        <br>
       <div class="row">
       
        <div class="col-lg-1" style="text-align: left">
        <label>รับจาก :</label>
        </div> 
        <div class="col-lg-5">
        {{$infocheckreceive->RECEIVE_ACCEPT_FROM}}
      
        </div>
        <div class="col-lg-1 " style="text-align: left">
        <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-2">
        {{$infocheckreceive->RECEIVE_BUDGET_YEAR}}
              
        </div>
        
       </div>
       <br>
 
        


       <div class="row">
                        <div class="col-lg-12">
                        <div style="text-align: right">
                        มูลค่า&nbsp; {{number_format($infocheckreceive->RECEIVE_VALUE,5)}}&nbsp;บาท
                        </div>
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
                                      
                                    
                                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                        <thead style="background-color: #F0F8FF;">
                                            <tr>
                                                <td style="text-align: center; font-size: 13px;">ลำดับ</td>
                                                <td style="text-align: center; font-size: 13px;" width="20%">รายการรับเข้า</td>
                                                <td style="text-align: center; font-size: 13px;" width="10%">ประเภท</td>
                                                <td style="text-align: center; font-size: 13px;" >หน่วย</td>
                                                <td style="text-align: center; font-size: 13px;" >จำนวนรับ</td>
                                                <td style="text-align: center; font-size: 13px;" >ราคาต่อหน่วย</td>
                                                <td style="text-align: center; font-size: 13px;" >มูลค่า</td>
                                                <td style="text-align: center; font-size: 13px;" >ล็อตผลิต</td>
                                                <td style="text-align: center; font-size: 13px;" >วันที่ผลิต</td>
                                                <td style="text-align: center; font-size: 13px;" >วันที่หมดอายุ</td>
                                           
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        
                                  

                                        <?php $count=1;?>
                                            @foreach ($infocheckreceivesubs as $infocheckreceivesub)

                                            <tr height="20">
                                        <td class="text-font text-pedding">
                                             {{$count}}
                                        </td>
                                        <td class="text-font text-pedding">
                                        {{$infocheckreceivesub->RECEIVE_SUB_NAME}}
                                      
                                        </td>
                                        <td class="text-font text-pedding">
                                        {{$infocheckreceivesub->SUP_TYPE_NAME}}
                                        </td>
                                        <td class="text-font text-pedding">
                                        {{$infocheckreceivesub->SUP_UNIT_NAME}}
                                     
                                        </td>
                                        <td class="text-font text-pedding">
                                        {{$infocheckreceivesub->RECEIVE_SUB_AMOUNT}}
                                      
                                        </td>
                                        <td class="text-font text-pedding" align="right">
                                        {{number_format($infocheckreceivesub->RECEIVE_SUB_PICE_UNIT,5)}}
                                     
                                        </td>
                                        <td class="text-font text-pedding" align="right">
                                        {{number_format($infocheckreceivesub->RECEIVE_SUB_VALUE,5)}}
                                       
                                        </td>
                                        <td class="text-font text-pedding">
                                        {{$infocheckreceivesub->RECEIVE_SUB_LOT}}
                                        
                                        </td>
                                        <td class="text-font text-pedding">
                                        @if($infocheckreceivesub->RECEIVE_SUB_GEN_DATE !== Null)
                                        {{DateThai($infocheckreceivesub->RECEIVE_SUB_GEN_DATE)}}
                                        @endif
                                        </td>
                                        <td class="text-font text-pedding">
                                        @if($infocheckreceivesub->RECEIVE_SUB_EXP_DATE !== Null)
                                        {{DateThai($infocheckreceivesub->RECEIVE_SUB_EXP_DATE)}}
                                         @endif
                                        </td>
                                    

                                    </tr>

                   


                                            <?php  $count++;?>

                                            @endforeach 

                           
                            
                                    </tbody>   
                                    </table>

                                    </div>


                                    <div class="tab-pane" id="object2" role="tabpanel">
                                      
                                      
                                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                        <thead style="background-color: #F0F8FF;">
                                              <tr>
                                                 
                                                  <td style="text-align: center; font-size: 13px;" >ชื่อกรรมการ</td>
                                                  <td style="text-align: center; font-size: 13px;" >ตำแหน่ง</td>
                                          
                                                 
                                              </tr>
                                          </thead> 
                                          <tbody class="tbody2"> 
                                          
  
                                      <tr>
                                      @foreach ($infocheckreceiveboards as $infocheckreceiveboard)

                                          <td class="text-font text-pedding">
                                         {{$infocheckreceiveboard->HR_FNAME}}   {{$infocheckreceiveboard->HR_LNAME}}
                                     
                                          </td>
                                          <td class="text-font text-pedding">
                                        @if($infocheckreceiveboard->RECEIVE_BOARD_POSITION_ID==2)
                                        
                                        ประธาน
                                        @elseif($infocheckreceiveboard->RECEIVE_BOARD_POSITION_ID==1)
                                        กรรมการ
                                        @else
                                        
                                        @endif
                                        
                                          
                                          </td>
                                      
                                        
                                      </tr>
                                      @endforeach 

                              
                                      </tbody>   
                                      </table>
  
                                      </div>
<br>
                                    </div>
                                </div>
                        
      
</div>
</div>
</div>




        <div class="modal-footer">
        <div align="right">
     
        <a href="{{ url('manager_warehouse/detail')  }}" class="btn btn-secondary btn-lg"  >ปิดหน้าต่าง</a>
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
    

$('.addRow').on('click',function(){
        addRow();
        var count = $('.tbody1').children('tr').length;
        var number =  (count).valueOf();
        datepicker(number);
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();

    
        var tr =   '<tr>'+
                '<td style="text-align: center;">'+
                +number+
                '</td>'+
                '<td>'+
                '<select name="RECEIVE_BOARD_PERSON_ID[]" id="RECEIVE_BOARD_PERSON_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+  
                '<option value="" >--เลือกวัสดุ--</option>'+  
                '@foreach ($infosuppliess as $infosupplies)'+  
                '<option value="{{ $infosupplies -> ID }}" >{{ $infosupplies -> SUP_NAME }}</option>'+                                          
                '@endforeach'+  
                '</select>'+ 
                '</td>'+
                '<td>'+         
                '<select name="RECEIVE_SUB_TYPE[]" id="RECEIVE_SUB_TYPE[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                '@foreach ($infosuptypes as $infosuptype)'+  
                '<option value="{{ $infosuptype -> ID_SUP_TYPE }}" >{{ $infosuptype -> SUP_TYPE_NAME }}</option>'+                                          
                '@endforeach'+  
                '</select>'+   
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_UNIT[]" id="RECEIVE_SUB_UNIT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_AMOUNT[]" id="RECEIVE_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_PICE_UNIT[]" id="RECEIVE_SUB_PICE_UNIT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_VALUE[]" id="RECEIVE_SUB_VALUE[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_LOT[]" id="RECEIVE_SUB_LOT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_GEN_DATE[]" id="RECEIVE_SUB_GEN_DATE[]" class="form-control input-sm datepicker'+number+'" style=" font-family: \'Kanit\', sans-serif;" readonly>'+
                '</td>'+
                '<td>'+
                '<input name="RECEIVE_SUB_EXP_DATE[]" id="RECEIVE_SUB_EXP_DATE[]" class="form-control input-sm datepicker'+number+'" style=" font-family: \'Kanit\', sans-serif;" readonly>'+
                '</td>'+                  
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
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

</script>


@endsection