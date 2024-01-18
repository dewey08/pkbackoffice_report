@extends('layouts.food')
    
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

<br>
<br>
<center>


<body onload="taxcal();">
    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                            <div class="row">
                            <div align="left" class="col-sm-7">
                            รายการใบสั่งซื้อ
                            </div>
                            <div class="col-sm-5">
                            เลขที่สั่ง :  
                            @if($infosuppliecon->PO_NUM == '') 
                                    {{$maxnumberpo}}  
                            
                            @else
                                    {{$infosuppliecon->PO_NUM}}
                            @endif
                            วันที่บันทึก {{DateThai(date("Y-m-d"))}}
                            </div>
                            </div>
                </h2> 
               
                <div align="left">


  
           <form  method="post" action="{{ route('mfood.savepurchaseorders') }}" enctype="multipart/form-data"> 
        @csrf

        <input type="hidden" name="ID" id="ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->ID}}">

        @if($infosuppliecon->PO_NUM == '')
        <input type="hidden" name="PO_NUM" id="PO_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$maxnumberpo}}">    
        @else
        <input type="hidden" name="PO_NUM" id="PO_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->PO_NUM}}">    
        @endif
    <div class="row">
        <div class="col-md-8">
            <div class="row push">
            <div class="col-sm-2">
            <label>ร้านค้าผู้จำหน่าย :</label>
            </div> 
            <div class="col-lg-10">
          @if( $vendor != '')
           {{$vendor->VENDOR_NAME}}
          @endif
            </div>  
            </div>  

            <div class="row push">
            <div class="col-sm-2">
                <label>ใบเสนอราคาเลขที่ :</label>
            </div>         
            <div class="col-lg-4"> 
            @if( $vendor != '')
            {{$vendor->QUOTATION_NUMBER}}
            @endif
            </div>
            <div class="col-sm-2">
                <label>กำหนดวันส่งมอบ :</label>
            </div>         
            <div class="col-lg-4">        
            <input name="SEND_DATE" id="SEND_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($infosuppliecon->SEND_DATE)}}" readonly>
            </div>
            </div> 

            <div class="row push">
            <div class="col-sm-2">
            <label>ลงวันที่ :</label>
            </div> 
            <div class="col-lg-4">
            <input name="PO_DATE" id="PO_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
            </div>  
            <div class="col-sm-2">
            <label>เลขที่สั่งซื้ออ้างอิง :</label>
            </div>         
            <div class="col-lg-4">        
            {{$infosuppliecon->CON_NUM}}
            </div>
            </div>  

            <div class="row push">
            <div class="col-sm-2">
                <label>ผู้รับใบสั่งซื้อ :</label>
                </div> 
                <div class="col-lg-4">
                <input  name="RECIPIENT_NAME" id="RECIPIENT_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->RECIPIENT_NAME}}">
                </div>  
            <div class="col-sm-2">
            <label>การรับประกัน :</label>
            </div>         
            <div class="col-lg-1">        
            <input  name="INSURANCE_YEAR" id="INSURANCE_YEAR" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->INSURANCE_YEAR}}">
            </div>
            <div class="col-sm">
            <label>ปี</label>
            </div>
            <div class="col-lg-1">        
            <input  name="INSURANCE_MONT" id="INSURANCE_MONT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->INSURANCE_MONT}}">
            </div>
            <div class="col-sm">
            <label>เดือน</label>
            </div>  
            <div class="col-sm-6">
            </div>
            </div> 
    
            <div class="row push">
            <div class="col-sm-2">
                <label>ตำแหน่ง :</label>
                </div> 
                <div class="col-lg-4">
                <input  name="RECIPIENT_POSITION" id="RECIPIENT_POSITION" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosuppliecon->RECIPIENT_POSITION}}">
                </div>  
             
                <div class="col-sm-2">
                <label>ผู้สั่งซื้อ :</label>
                </div>         
                <div class="col-lg-4">        
                <select name="BUYER_USER_ID" id="BUYER_USER_ID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" selected>--กรุณาเลือกผู้สั่งซื้อ--</option>
                                @foreach ($pessonalls as $pessonall)     
                              
                                @if($infosuppliecon->BUYER_USER_ID == $pessonall -> ID )              
                                <option value="{{ $pessonall -> ID }}" selected>{{ $pessonall -> HR_FNAME }} {{ $pessonall -> HR_LNAME }}</option>   
                                @else
                                <option value="{{ $pessonall -> ID }}">{{ $pessonall -> HR_FNAME }} {{ $pessonall -> HR_LNAME }}</option>   
                                @endif        
                                @endforeach  )

                </select> 
                </div> 
            </div> 


            <div class="row push">
              <div class="col-sm-2">
                <label>วันที่รับใบสั่ง :</label>
                </div> 
                <div class="col-lg-4">
                <input name="ORDER_DATE" id="ORDER_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($infosuppliecon->ORDER_DATE)}}" readonly>
                </div>  
                <div class="col-sm-2">
                <label>วันที่ลงนาม :</label>
                </div>         
                <div class="col-lg-4">        
                <input name="SIGN_DATE" id="SIGN_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($infosuppliecon->SIGN_DATE)}}" readonly>
                </div> 
            </div> 




        </div>

        <div class="col-md-4" style="background-color: #F0F8FF;">
           <br>
            <div class="row push">
                <div class="col-sm-3">
                <label>ภาษี :</label>
                </div> 
                <div class="col-lg-9">
                <select name="TAX_TYPE" id="TAX_TYPE" class="form-control input-sm tax_sub" style=" font-family: 'Kanit', sans-serif;" >
                            @if($infosuppliecon->TAX_TYPE == 0)<option value="0" selected>ไม่มี</option> @else<option value="0" >ไม่มี</option>@endif
                            @if($infosuppliecon->TAX_TYPE == 1)<option value="1" selected>VAT ใน</option> @else<option value="1" >VAT ใน</option>@endif
                            @if($infosuppliecon->TAX_TYPE == 2)<option value="2" selected>VAT นอก</option> @else<option value="2" >VAT นอก</option>@endif
                </select> 
            
                </div>  
            </div> 
            <div class="row push">
                <div class="col-sm-3">
                <label>ส่วนลด :</label>
                </div> 
                <div class="col-lg-7">
                <input type="text" name="DISC" id="DISC" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="taxcal()"  value="{{$infosuppliecon->DISCOUNT}}">
            
                </div> 
                <div class="col-sm-2">
                <label>บาท</label>
                </div>  
            </div> 
    <div class="taxcal"> 
            <div class="row push">
                <div class="col-sm-3">
                <label>มูลค่าสินค้า :</label>
                </div> 
                <div class="col-lg-7">
                {{number_format($sumprice,5)}}
            
                </div>  
                <div class="col-sm-2">
                <label>บาท</label>
                </div> 
            </div> 

          

            <div class="row push">
                <div class="col-sm-3">
                <label>เปอร์เซ็นภาษี :</label>
                </div> 
                <div class="col-lg-9">
                  -
                </div>  
            
            </div> 

            <div class="row push">
                <div class="col-sm-3">
                <label>เป็นเงิน :</label>
                </div> 
                <div class="col-lg-7">
               -
            
                </div>  
                <div class="col-sm-2">
                <label>บาท</label>
                </div> 
            </div> 

            <div class="row push">
                <div class="col-sm-3">
                <label>รวมราคาสุทธิ :</label>
                </div> 
                <div class="col-lg-7">
                {{number_format($sumprice,5)}}
            
                </div>  
                <div class="col-sm-2">
                <label>บาท</label>
                </div> 
            </div> 

            

        </div>
    </div>    

</div>  

 <input type="hidden" id="PRICESUM" name="PRICESUM" value="{{$sumprice}}">
    
  <br>
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    <td style="text-align: center;" width="5%">ลำดับ</td>
                    <td style="text-align: center;">รายการ</td>
                    <td style="text-align: center;" width="10%">จำนวน</td>
                    <td style="text-align: center;" width="10%">หน่วย</td>
                    <td style="text-align: center;" width="15%">ราคา</td>
                    <td style="text-align: center;" width="15%">รวม</td>
                   
                </tr>
            </thead>
            <tbody class="tbody1">
            <?php $number = 0; ?>
            @foreach ($infosuppliesconlists as $infosuppliesconlist)

            <?php $number++;?>

                <tr height="40">
                <td class="text-font" align="center">{{$number}}</td>
                <td class="text-font text-pedding">{{$infosuppliesconlist->SUP_NAME }}</td>
                <td class="text-font text-pedding" align="right">{{number_format($infosuppliesconlist->SUP_TOTAL) }}</td>
                <td class="text-font text-pedding" align="center">{{$infosuppliesconlist->SUP_UNIT_NAME }}</td>
                <td class="text-font text-pedding" align="right">{{number_format($infosuppliesconlist->PRICE_PER_UNIT,5) }}</td>
                <td class="text-font text-pedding" align="right">{{number_format($infosuppliesconlist->SUP_TOTAL * $infosuppliesconlist->PRICE_PER_UNIT,5) }}</td>
                  
                </tr>
                @endforeach  
            </tbody>
        </table>
              <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                    <a href="{{ url('manager_food/infofoodbilltotal')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>
        </div>
    </form>  

   
                  

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
  $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });




    $('.tax_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             var pricesum = document.getElementById("PRICESUM").value;
             var disc= document.getElementById("DISC").value;
             $.ajax({
                     url:"{{route('msupplies.fetchtaxcal')}}",
                     method:"GET",
                     data:{select:select,disc:disc,pricesum:pricesum,_token:_token},
                     success:function(result){
                        $('.taxcal').html(result);
                     }
             })
            // console.log(select);
             }        
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