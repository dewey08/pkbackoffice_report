@extends('layouts.supplies')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 15px;
      
      }

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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



?>
<center>    
    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-plus"></i> เพิ่มการขอซื้อขอจ้างพัสดุ</h2> 
                <div class="block-content block-content-full" align="left">
        <form  method="post" action="#" enctype="multipart/form-data">
        @csrf
        <div class="row push">
        <div class="col-sm-2">
        <label>เรียน :</label>
        </div> 
        <div class="col-lg-10">
        <input name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
        </div>         
        </div>
       
        <div class="row push">
        <div class="col-sm-2">
            <label>ลงวันที่ :</label>
        </div> 
        <div class="col-lg-2">        
            <input name="DATE" id="DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
        </div>
        <div class="col-sm-2 text-right">
                <label>เพื่อจัดซื้อ/ซ่อมแซม :</label>
            </div>         
        <div class="col-lg-6">        
            <input name="" id="" class="form-control input-lg "   style=" font-family: 'Kanit', sans-serif;" >
        </div>
       </div>
       <div class="row push">
            <div class="col-sm-2">
                <label>หน่วยงานผู้เบิก :</label>
            </div> 
            <div class="col-lg-7">
                    <select name="RECORD_LOCATION_ID" id="RECORD_LOCATION_ID" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                            <option value="" selected>--กรุณาเลือกหน่วยงานผู้เบิก--</option>
                                        
                    </select> 
                <div style="color: red; font-size: 16px;" id="record_location_id"></div> 
            </div>       
            <div class="col-sm-1">
                <label>เบอร์โทร :</label>
            </div> 
            <div class="col-lg-2">
                <input name="RECORD_HEAD_USE" id="RECORD_HEAD_USE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >                
            </div> 
        </div>
       <div class="row push">
        <div class="col-sm-2">
                <label>ผู้รายงาน :</label>
            </div> 
            <div class="col-lg-4">
                <select name="RECORD_LOCATION_ID" id="RECORD_LOCATION_ID" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                    <option value="" selected>--กรุณาเลือกผู้รายงาน--</option>
                                   
                </select> 
                <div style="color: red; font-size: 16px;" id="record_location_id"></div> 
            </div>
            <div class="col-sm-2">
                    <label>ผู้เห็นชอบ :</label>
                </div> 
                <div class="col-lg-4">
                    <select name="RECORD_LOCATION_ID" id="RECORD_LOCATION_ID" class="form-control input-lg " style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" selected>--กรุณาเลือกผู้เห็นชอบ--</option>
                                 
                    </select> 
                <div style="color: red; font-size: 16px;" id="record_location_id"></div> 
                </div>
            </div>

       <div class="row push">

       <div class="col-sm-2">
        <label>หมายเหตุ | เหตุผล :</label>
        </div> 
        <div class="col-sm-10">
        <input name="ADD_RECORD_ORG" id="ADD_RECORD_ORG" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; background-color: #CCFFFF;" placeholder="หมายเหตุ | เหตุผล">
        </div> 
       </div>

       <table class="table gwt-table" >
            <thead>
                <tr height="40">
                    <td style="text-align: center;" width="8%">ลำดับ</td>
                    <td style="text-align: center;">รายการและรายละเอียดที่ต้องการ</td>
                    <td style="text-align: center;" width="10%">จำนวน</td>
                    <td style="text-align: center;" width="10%">หน่วย</td>
                    <td style="text-align: center;">ราคาประมาณการ</td>
                    <td style="text-align: center;">เหตุผล/ความจำเป็นในการซื้อ</td>
                    <td style="text-align: center;" width="12%">
                        <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">
                <tr height="40">
                    <td>
                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                    <td>
                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                    <td>
                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                    <td>
                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                    <td>
                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                    <td>
                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                </tr>
            </tbody>
        </table>
              <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                    <a href="{{ url('manager_supplies/requestforbuy')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
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


$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
                    '<td>'+
                '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td>'+
                '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
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