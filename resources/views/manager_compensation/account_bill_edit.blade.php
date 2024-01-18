@extends('layouts.compensation')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


@section('content')
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

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
         
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

use App\Http\Controllers\ManageraccountController;
$refnumberbill = ManageraccountController::refnumberbill();

?>
<body >

<center>    
<body onload="run01();">
    <div class="block mt-5" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                
                <div align="left">
                    <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขรายการวางบิล</h2> 
        <form  method="post" action="{{ route('mcompensation.account_bill_update') }}" enctype="multipart/form-data">
          
        @csrf

        <input type="hidden" name="ACCOUNT_BILL_ID" id="ACCOUNT_BILL_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infobill->ACCOUNT_BILL_ID}}">
        <div class="row">
        <div class="col-sm-2">
        <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-4">
        
        <select name="ACCOUNT_BILL_YEAR" id="ACCOUNT_BILL_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                <option value="">--กรุณาเลือกปีงบ--</option>
                @foreach ($budgetyears as $budgetyear) 
                    @if($yearbudget == $budgetyear ->LEAVE_YEAR_ID )
                        <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_NAME}}</option>
                    @else
                        <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_NAME}}</option>
                    @endif
                @endforeach 
        </select>  

        </div> 
        <div class="col-sm-2">
        <label>เลขทะเบียน :</label>
        </div> 
        <div class="col-lg-4">
        <input name="ACCOUNT_BILL_NUMBER" id="ACCOUNT_BILL_NUMBER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infobill->ACCOUNT_BILL_NUMBER}}">
        </div>   
    

        </div>
        <br>
        <div class="row">
        {{-- <div class="col-sm-2">
        <label>เลขที่บิล :</label>
        </div> 
        <div class="col-lg-4">
        <input name="ACCOUNT_BILL_CODE" id="ACCOUNT_BILL_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infobill->ACCOUNT_BILL_CODE}}" >
        </div>   --}}
        <div class="col-sm-2">
                <label>บริษัท :</label>
            </div>         
        <div class="col-lg-10">        
      
            <select name="ACCOUNT_BILL_VENDOR_ID" id="ACCOUNT_BILL_VENDOR_ID" class="form-control input-lg vendorcheck" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--กรุณาเลือก--</option>
                        @foreach ($infovendors as $infovendor) 

                            @if($infobill->ACCOUNT_BILL_VENDOR_ID == $infovendor ->VENDOR_ID )
                                    <option value="{{ $infovendor ->VENDOR_ID  }}" selected>{{ $infovendor->VENDOR_NAME}}</option>
                            @else
                                    <option value="{{ $infovendor ->VENDOR_ID  }}">{{ $infovendor->VENDOR_NAME}}</option>
                            @endif
                        
                        @endforeach 
                </select>  
        </div>

        </div>
       <br>
       


      <div class="row">
        <div class="col-sm-2">
                <label>วันที่วางบิล :</label>
            </div>         
        <div class="col-lg-4">        
        <input name="ACCOUNT_BILL_OUT_DATE" id="ACCOUNT_BILL_OUT_DATE" value="{{formate($infobill->ACCOUNT_BILL_OUT_DATE)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
        </div>       
     
        <div class="col-sm-2">
                <label>ครบกำหนด :</label>
            </div>         
        <div class="col-lg-4">        
        <input name="ACCOUNT_BILL_SET_DATE" id="ACCOUNT_BILL_SET_DATE" value="{{formate($infobill->ACCOUNT_BILL_SET_DATE)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
        </div>
       
       </div>
    
    
       <br>
       
    
        <div class="row">

           {{-- <div class="col-sm-2">
            <label>จำนวนเงิน :</label>
            </div> 
            <div class="col-sm-4">
            <input name="ACCOUNT_BILL_PICE" id="ACCOUNT_BILL_PICE" value="{{$infobill->ACCOUNT_BILL_PICE}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
            </div>  --}}
            <div class="col-sm-2">
            <label>หมายเหตุ :</label>
            </div> 
            <div class="col-sm-10">
            <input name="ACCOUNT_BILL_REMARK" id="ACCOUNT_BILL_REMARK" value="{{$infobill->ACCOUNT_BILL_REMARK}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
            </div> 
            </div>
        
        <br>

            <div class="row">
                <div class="col-sm-8"  >
                &nbsp;
                </div>

                <div class="col-sm-1"  >
                <label>รวมมูลค่า </label>
                </div>
                <div class="col-sm-2"  >
                    <input class="form-control input-lg" style="text-align: center;background-color: rgba(50, 115, 220, 0.3);" type="text" name="ACCOUNT_BILL_PICE" id="ACCOUNT_BILL_PICE" readonly>  
                </div>
                <div class="col-sm-1"  >
                <label>บาท</label>
                </div>
        </div>
    </div>

  
  

            <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
<thead style="background-color: #FFEBCD;">
        <tr height="40">
            <td style="text-align: center;" width="5%">ลำดับ</td>
            <td style="text-align: center;" width="15%">เลขที่เอกสาร</td>
            <td style="text-align: center;" width="15%">สถานะ</td>
            <td style="text-align: center;">เลขที่ใบแจ้งหนี้</td>
            <td style="text-align: center;" >บริษัท</td>
            <td style="text-align: center;" width="20%">จำนวน</td>
            <td style="text-align: center;" width="12%">
                <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
            </td>
        </tr>
    </thead>
    <tbody class="tbody1 listcheck">    
          
     

                        <tr height="20">
                        
                            <td style="text-align: center;">
                            1
                            </td>
                            <td>               
                                <select name="ACCOUNT_BILL_SUB_NUMBER[]" id="ACCOUNT_BILL_SUB_NUMBER0" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                            <option value="">--กรุณาเลือก--</option>
                                            @foreach ($infoaccounts as $infoaccount) 
                                            
                                                    <option value="{{ $infoaccount ->ACCOUNT_NUMBER  }}">{{ $infoaccount->ACCOUNT_NUMBER}}</option>
                                            
                                            @endforeach 
                                </select>  
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <input type="hidden" name="ACCOUNT_BILL_SUB_DOC[]" id="ACCOUNT_BILL_SUB_DOC0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                            </td>
                            <td>
                                <input type="hidden" name="ACCOUNT_BILL_SUB_VENDOR[]" id="ACCOUNT_BILL_SUB_VENDOR0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                            </td>
                            <td>
                                <input type="hidden" name="ACCOUNT_BILL_SUB_PICE[]" id="ACCOUNT_BILL_SUB_PICE0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                            </td>
                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        
                        </tr>

                    
  

    </tbody>
</table>
       


  
    
                            <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style=" font-family: 'Kanit', sans-serif;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('manager_compensation/account_bill')  }}" class="btn btn-hero-sm btn-hero-danger" style=" font-family: 'Kanit', sans-serif;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
            </div>
        </div>
    </form>  

   
                  

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('select').select2();
});
</script>


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
            });  //กำหนดเป็นวันปัจุบัน
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


function chkNumber(ele){
    var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
//-----------------------------------------------------


 //========================================

  
 $('.addRow').on('click',function(){
        addRow();
        $('select').select2();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number = count+1;
        var tr =   '<tr height="20">'+
         '<td style="text-align: center;">'+
          number+
          '</td>'+
          '<td>'+               
          '<select name="ACCOUNT_BILL_SUB_NUMBER[]" id="ACCOUNT_BILL_SUB_NUMBER'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
          '<option value="">--กรุณาเลือก--</option>'+
          '@foreach ($infoaccounts as $infoaccount)'+                                     
          '<option value="{{ $infoaccount ->ACCOUNT_NUMBER  }}">{{ $infoaccount->ACCOUNT_NUMBER}}</option>'+                                
          '@endforeach'+ 
          '</select>'+  
          '</td>'+
          '<td>'+                    
          '</td>'+
          '<td>'+
          '<input type="hidden" name="ACCOUNT_BILL_SUB_DOC[]" id="ACCOUNT_BILL_SUB_DOC'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
          '</td>'+
          '<td>'+
          '<input type="hidden" name="ACCOUNT_BILL_SUB_VENDOR[]" id="ACCOUNT_BILL_SUB_VENDOR'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
           '</td>'+
           '<td>'+
           '<input type="hidden" name="ACCOUNT_BILL_SUB_PICE[]" id="ACCOUNT_BILL_SUB_PICE'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
           '</td>'+
          '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+    
          '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});
  
  //------------------------------------------
$('.vendorcheck').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('maccount.account_bill_list')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.listcheck').html(result);
                        findTotal();
                     }
             })
             }        
     });



     function run01(){
            
            var select= document.getElementById("ACCOUNT_BILL_VENDOR_ID").value;   
            var _token=$('input[name="_token"]').val();
            $.ajax({
                    url:"{{route('maccount.account_bill_list')}}",
                    method:"GET",
                    data:{select:select,_token:_token},
                    success:function(result){
                       $('.listcheck').html(result);
                       findTotal();
                    }
            })
            }


            
     function findTotal(){
    var arr = document.getElementsByName('ACCOUNT_BILL_SUB_PICE[]');
    var tot=0;

   
    count = $('.tbody1').children('tr').length;
   
   

    for(var i=0;i<count;i++){
        
            tot += parseFloat(arr[i].value);
          
    }
   


    document.getElementById('ACCOUNT_BILL_PICE').value =tot.toFixed(2);
}


</script>



@endsection