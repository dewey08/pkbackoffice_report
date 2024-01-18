@extends('layouts.medical')
    
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

.text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

        .text-font {
    font-size: 13px;
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
<body onload="taxcal();">
<center>    
    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                            <div align="left" class="col-sm-7">
                            ตรวจรับยาและเวชภัณฑ์
                            </div>
                            <div class="col-sm-5">
                            เลขที่ตรวจรับยาและเวชภัณฑ์ :       @if($infosuppliecon->CH_NUM == '') 
                                    {{$maxnumberch}}  
                            @else
                                    {{$infosuppliecon->CH_NUM}}
                            @endif วันที่บันทึก {{DateThai(date("Y-m-d"))}}
                            </div>
                            </div>
                
                </h2> 
                <div align="left">
     
                <form  method="post" action="{{ route('mmedical.medical_purchascheck_save') }}" enctype="multipart/form-data"> 
        @csrf

       
        <input type="hidden" name="ID" id="ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->ID}}">

        @if($infosuppliecon->CH_NUM == '')
        <input type="hidden" name="CH_NUM" id="CH_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$maxnumberch}}">    
        @else
        <input type="hidden" name="CH_NUM" id="CH_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->CH_NUM}}">    
        @endif

        <div class="row">

            <div class="col-md-8">

            <div class="row ">
            <div class="col-sm-2">
                <label>อ้างถึงเอกสาร  :</label>
            </div>         
            <div class="col-lg-4">        
            {{$infosuppliecon->CON_NUM}}
            </div>
            <div class="col-sm-2">
                <label>กำหนดส่ง :</label>
            </div>         
            <div class="col-lg-4">        
            {{DateThai($infosuppliecon->DATE_WANT_USE)}}
            </div>
            </div> 

            <div class="row">
            <div class="col-sm-2">
            <label>ร้านค้าผู้จำหน่าย :</label>
            </div> 
            <div class="col-lg-10">
            {{$infovendor->VENDOR_NAME}}
            </div>  
            </div>  

            <div class="row push">
            <div class="col-sm-2">
                <label>ใบสั่งซื้อเลขที่  :</label>
            </div>         
            <div class="col-lg-4">        
            {{$infosuppliecon->PO_NUM}}
            </div>
            <div class="col-sm-2">
                <label>เลขที่ใบส่งของ :</label>
            </div>         
            <div class="col-lg-4">        
            <input name="INVOICE_NUM" id="INVOICE_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->INVOICE_NUM}}" >
            </div>
            </div> 

            <div class="row push">
            <div class="col-sm-2">
                <label>ใบเสนอราคาเลขที่  :</label>
            </div>         
            <div class="col-lg-4">        
            {{$infovendor->QUOTATION_VENDOR_TAXNUM}}
            </div>
            <div class="col-sm-2">
                <label>วันที่ตรวจรับ :</label>
            </div>         
            <div class="col-lg-4">   
            @if($infosuppliecon->CHECK_DATE !== '' && $infosuppliecon->CHECK_DATE !== '0000-00-00' && $infosuppliecon->CHECK_DATE !== null)
            <input name="CHECK_DATE" id="CHECK_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($infosuppliecon->CHECK_DATE)}}" readonly>
            @else
            <input name="CHECK_DATE" id="CHECK_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
            @endif     
           
            </div>
           
            </div> 

            <div class="row push">
                    <div class="col-sm-2">
                        <label>เวลาตรวจรับ  :</label>
                    </div>         
                    <div class="col-lg-4">        
                    <input name="CHECK_TIME" id="CHECK_TIME" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->CHECK_TIME}}" >
                    </div>
            <div class="col-sm-2">
                <label>ผลการตรวจสอบ :</label>
                </div>         
                <div class="col-lg-4">        
                <select name="CHECK_TYPE_ID" id="CHECK_TYPE_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                <option value="1" >ครบถ้วนทุกรายการ</option>
                                               @if($infosuppliecon->CHECK_TYPE_ID == 2) <option value="2" selected>ไม่ครบถ้วน </option>@else <option value="2">ไม่ครบถ้วน </option>@endif
                                                
                                </select> 
        </div>
          
            </div> 


         


            <div class="row push">
            <div class="col-sm-2">
        <label>เจ้าหน้าที่ตรวจรับ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CHECK_USER_ID" id="CHECK_USER_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                         <option value="" selected>--กรุณาเลือกผู้รับใบสั่งซื้อ--</option>
                                         @foreach ($pessonalls as $pessonall) 
                                          @if($infosuppliecon->CHECK_USER_ID == $pessonall -> ID )
                                          <option value="{{ $pessonall -> ID }}" selected>{{ $pessonall -> HR_FNAME }} {{ $pessonall -> HR_LNAME }}</option>           
                                          @else
                                          <option value="{{ $pessonall -> ID }}">{{ $pessonall -> HR_FNAME }} {{ $pessonall -> HR_LNAME }}</option>           
                                          @endif                   
                                                      
                                        @endforeach  )

                         </select> 
        </div>  
        <div class="col-sm-2">
        <label>ค่าปรับ :</label>
        </div> 
        <div class="col-lg-4">
        <input  name="CHECK_FINE" id="CHECK_FINE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->CHECK_FINE}}">
        </div>  
          
            </div> 





          

            </div>

            <div class="col-md-4" style="background-color: #F0F8FF;">
             
            <br>
            <div class="row ">
                <div class="col-sm-3">
                <label>ภาษี :</label>
                </div> 
                <div class="col-lg-9">
               
                @if($infosuppliecon->TAX_TYPE == 0)
                ไม่มี 
                @elseif($infosuppliecon->TAX_TYPE == 1) VAT ใน 
                @else VAT นอก
                @endif
                <input type="hidden" name="TAX_TYPE" id="TAX_TYPE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"   value="{{$infosuppliecon->TAX_TYPE}}">
            
                </div>  
            </div> 

            <div class="row ">
                <div class="col-sm-3">
                <label>ส่วนลด :</label>
                </div> 
                <div class="col-lg-9">
               {{$infosuppliecon->DISCOUNT}}
               <input type="hidden" name="DISC" id="DISC" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$infosuppliecon->DISCOUNT}}">
                </div>  
            </div> 
            <div class="taxcal"> 
            <div class="row ">
                <div class="col-sm-3">
                <label>มูลค่าสินค้า :</label>
                </div> 
                <div class="col-lg-9">
                {{$sumprice}}
                <input type="hidden" id="PRICESUM" name="PRICESUM" value="{{$sumprice}}">
            
                </div>  
            </div> 

            <div class="row ">
                <div class="col-sm-3">
                <label>เปอร์เซ็นภาษี :</label>
                </div> 
                <div class="col-lg-9">
                    7.00 %
                </div>  
            </div> 

            <div class="row ">
                <div class="col-sm-3">
                <label>เป็นเงิน :</label>
                </div> 
                <div class="col-lg-9">
              -
                </div>  
            </div> 

            <div class="row ">
                <div class="col-sm-3">
                <label>รวมราคาสุทธิ :</label>
                </div> 
                <div class="col-lg-9">
                -
                </div>  
            </div> 

            </div>
            </div>

        </div>

    
        <br>
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    <td style="text-align: center;font-size: 14px;" width="5%">ลำดับ</td>
                    <td style="text-align: center;font-size: 14px;"  >รายการ</td>           
                    <td style="text-align: center;font-size: 14px;" width="10%">จำนวน</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">หน่วย</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">ราคาขอซื้อ</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">ราคารับเข้า</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">จำนวนเงิน</td>
                    <td style="text-align: center;font-size: 14px;" width="15%">หมายเหตุ</td>
                   
                </tr>
            </thead>
            <tbody class="tbody1">
            <?php $number=1; ?>
            @foreach ($infosuppliesconlists as $infosuppliesconlist)
                <tr height="40">
                <td class="text-font text-pedding" align="center">{{$number}}</td>
                <td class="text-font text-pedding">{{ $infosuppliesconlist->SUP_NAME }}</td>
                
                <td class="text-font text-pedding" align="right">{{ number_format($infosuppliesconlist->SUP_TOTAL) }}</td>
                <td class="text-font text-pedding" align="center">{{ $infosuppliesconlist->SUP_UNIT_NAME }}</td>
                <td class="text-font text-pedding" align="right">{{ number_format($infosuppliesconlist->PRICE_PER_UNIT,5) }}</td>
                <td class="text-font text-pedding" align="right">{{ number_format($infosuppliesconlist->PRICE_PER_UNIT,5) }}</td>
                <td class="text-font text-pedding" align="right">{{ number_format($infosuppliesconlist->SUP_TOTAL * $infosuppliesconlist->PRICE_PER_UNIT,5) }}</td>
                <td>
                <input type="hidden" name="ID_CHECK[]" id="ID_CHECK[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesconlist->ID}}">
                <input  name="CON_REMARK[]" id="CON_REMARK[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliesconlist->CON_REMARK}}">
                
                </td>    
                  
                </tr>
                <?php $number++; ?>
                @endforeach  
            </tbody>
        </table>
              <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                    <a href="{{ url('manager_medical/purchase')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>
        </div>
    </form>  

   
                  

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

    <script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
    <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>


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

$(document).ready(function() {
    $('select').select2({
        width: '100%'
});
});

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

function taxcal(){
  
  var select= document.getElementById("TAX_TYPE").value;
  var disc= document.getElementById("DISC").value;
  
  var _token=$('input[name="_token"]').val();
  var pricesum = document.getElementById("PRICESUM").value;
  $.ajax({
          url:"{{route('msupplies.fetchtaxcal')}}",
          method:"GET",
          data:{select:select,disc:disc,pricesum:pricesum,_token:_token},
          success:function(result){
             $('.taxcal').html(result);
          }
  })
}
  
</script>



@endsection