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

table, td, th {
            border: 1px solid black;
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
<body onload="run01();";>
<center>    

    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row" align="left" >
                        <div class="col-sm-6">
                            &nbsp;&nbsp;&nbsp;รายการยาและเวชภัณฑ์
                        </div>
                     
                        <div align="right" class="col-sm-6">
                            @if($requestid !== '' && $requestid !== null)
                            <a href="{{ url('manager_medical/purchaselist_addrequest/'.$requestid)  }}" onclick="return confirm('ต้องการที่จะเพิ่มข้อมูลผ่านคำขอ {{$requestid}}?')"  class="btn btn-info btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">เพิ่มวัสดุครุภัณฑ์จากคำขอ</a> 
                            @endif
                           
                        
                        </div>
                </div>
                </h2> 
               
                <div align="left">
                    <form  method="post" action="{{ route('mmedical.medical_savepurchaselist') }}" enctype="multipart/form-data">
      
                        @csrf

        <input type="hidden" name="CON_ID" id="CON_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$conid}}">
<div class="row">
    <div class="col-sm-8">
        <div class="row">
        <div class="col-sm-2">
        <label>เลขทะเบียนคุม :</label>
        </div> 
        <div class="col-lg-4">
        {{$connum}}
        </div>  
        <div class="col-sm-2">
                <label>ประเภทจัดหา :</label>
            </div>         
        <div class="col-lg-4">        
        {{$suptypename}}
        </div>

        </div>
       
       <br>


      <div class="row">
        <div class="col-sm-2">
                <label>รายละเอียดพัสดุ :</label>
            </div>         
        <div class="col-lg-4">        
        {{$condetail}}
        </div>       
     
        <div class="col-sm-2">
                <label>เหตุผลความจำเป็น :</label>
            </div>         
        <div class="col-lg-4">        
        {{$resonname}}
        </div>
       
       </div>
    
   
       <br>
    
       <div class="row">

            <div class="col-sm-2">
            <label>ผู้ออกทะเบียน :</label>
            </div> 
            <div class="col-sm-4">
            {{$personrequestname}}
            </div> 
            <div class="col-sm-2">
            <label>ผู้ทำรายการ :</label>
            </div> 
            <div class="col-sm-4">
            {{$regisbyname}}
            </div> 
            </div>

            
    </div> 
            <div class="col-sm-4">

            <div class="col-md-12" style="background-color: #F0F8FF;">
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
                    <input type="text" class="form-control input-sm" id="PRICESUM" name="PRICESUM" value="" readonly>
            
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
                    <div class="col-lg-7" >
                    {{number_format($sumprice,5)}}
                    <input type="hidden" class="form-control input-sm" id="PRICESUM_send" name="PRICESUM_send" value="{{$sumprice}}">
                    </div>  
                    <div class="col-sm-2">
                    <label>บาท</label>
                    </div> 
                </div> 
    
                
    
            </div>
        </div>    
    
    </div>  

    </div> 

    
 
    <input type="hidden" class="form-control input-sm" id="PRICESUM_cal" name="PRICESUM_cal" value="">

            <div class="col-sm-12"  align="right">
            <label>รวมมูลค่า <input style="text-align: center;background-color: rgba(50, 115, 220, 0.3);" type="text" name="total" id="total" readonly>   บาท</label>
         </div>
         <table class="table-bordered table-striped table-vcenter" style="width: 100%;">
       <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;" width="5%">ลำดับ</td>
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;">รายการและรายละเอียดที่ต้องการ</td>
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;" width="10%">จำนวน</td>
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;" width="10%">หน่วย</td>
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;" width="15%">ราคา</td>
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;" width="15%">รวม</td>
                    <td style="text-align: center;font-size: 14px;border: 1px solid black;" width="12%">
                        <a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">

            @if($countcheck==0)
                <tr height="20">
                 
                    <td style="text-align: center;border: 1px solid black;">
                     1
                    </td>
                    <td     style="border: 1px solid black;">


                        <select name="SUP_ID[]" id="SUP_ID0" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;border: 1px solid black;" onchange="checkunitref(0);">
                                         <option value="" selected>--กรุณาเลือก--</option>
                                         @foreach ($infoassets as $infoasset)                    
                                                        <option value="{{ $infoasset -> ID }}">{{ $infoasset -> SUP_NAME }}</option>           
                                        @endforeach  
                                         
                         </select> 

                     

                    </td>
                    <td style="border: 1px solid black;">
                        <input name="SUP_TOTAL[]" id="SUP_TOTAL0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="checksummoney(0)" OnKeyPress="return chkNumber(this)" >
                    </td>
                 
                    <td  style="border: 1px solid black;"><div class="showunit0">
                    <select name="SUP_UNIT_ID[]" id="SUP_UNIT_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                                 
                                                                 <option value=" "></option>           
                                                                                        
                                                         </select> 
                    
                    </div></td>

                    <td style="border: 1px solid black;">
                        <input name="PRICE_PER_UNIT[]" id="PRICE_PER_UNIT0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;border: 1px solid black;" onkeyup="checksummoney(0)" OnKeyPress="return chkNumber(this)">
                    </td>
                    <td style="border: 1px solid black;">
                    <div class="summoney0" style="text-align: left;"></div>   
                    </td>
                    <td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                    <input type="hidden" name="SUP_UNIT_ID_H[]" id="SUP_UNIT_ID_H0" value="0">
                </tr>
               
            @else
            
             <?php $num = 0; $count=1;?>
            @foreach ($infosuppliescons as $infosuppliescon) 
            
            <tr height="20">
                    <td style="text-align: center;border: 1px solid black;">
                    {{$count}}
                    </td>
                 
                 <td style="border: 1px solid black;">


                     <select name="SUP_ID[]" id="SUP_ID{{$num}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;border: 1px solid black;" onchange="checkunitref(<?php echo $num ;?>)">
                                      <option value="" selected>--กรุณาเลือก--</option>
                                      @foreach ($infoassets as $infoasset)  
                                        @if($infosuppliescon->SUP_ID ==  $infoasset -> ID)
                                        
                                        <option value="{{ $infoasset -> ID }}" selected>{{ $infoasset -> TPU_NUMBER }} :: {{ $infoasset -> SUP_NAME }}  {{ $infoasset -> TYPE_ITEM_NAME }}  {{ $infoasset -> SUP_MASH }}</option>           
                                        @else
                                        <option value="{{ $infoasset -> ID }}">{{ $infoasset -> TPU_NUMBER }} :: {{ $infoasset -> SUP_NAME }}  {{ $infoasset -> TYPE_ITEM_NAME }}  {{ $infoasset -> SUP_MASH }}</option>           
                                        @endif                  
                                                   
                                     @endforeach  
                                      
                      </select> 

                  

                 </td>
                 <td style="border: 1px solid black;">
                     <input name="SUP_TOTAL[]" id="SUP_TOTAL{{$num}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="checksummoney(<?php echo $num ;?>)" OnKeyPress="return chkNumber(this)" value="{{number_format($infosuppliescon->SUP_TOTAL,2,".","")}}" >
                 </td>
            
                 <td style="border: 1px solid black;"><div class="showunit{{$num}}"></div></td>
                 <td style="border: 1px solid black;">
                     <input name="PRICE_PER_UNIT[]" id="PRICE_PER_UNIT{{$num}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" onkeyup="checksummoney(<?php echo $num ;?>)" OnKeyPress="return chkNumber(this)" value="{{$infosuppliescon->PRICE_PER_UNIT}}">
                 </td>
                 <td style="border: 1px solid black;">
                 <div class="summoney{{$num}}" style="text-align: left;"></div>   
                 </td>
                 <td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt "></i></a></td>
                 <input type="hidden" name="SUP_UNIT_ID_H[]" id="SUP_UNIT_ID_H{{$num}}" value="{{$infosuppliescon->SUP_UNIT_ID}}">
             </tr>

             <?php $num++; $count++;?>

             @endforeach 


            @endif    

            </tbody>
        </table>
              <br> 
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-info btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">บันทึกข้อมูล</button>
                <a href="{{ url('manager_medical/purchase')  }}" class="btn btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ยกเลิก</a>
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

$(document).ready(function() {
    $("select").select2();
});


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
        var count = $('.tbody1').children('tr').length;
        var number =  (count).valueOf();
        $("select").select2();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();;
        var tr =   '<tr>'+
                '<td style="text-align: center;border: 1px solid black;">'+
                +number+
                '</td>'+
                '<td style="border: 1px solid black;">'+
                '<select name="SUP_ID[]" id="SUP_ID'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" onchange="checkunitref('+count+')">'+
                '<option value="" selected>--กรุณาเลือก--</option>'+
                '@foreach ($infoassets as $infoasset)'+                    
                '<option value="{{ $infoasset -> ID }}">{{ $infoasset -> TPU_NUMBER }} :: {{ $infoasset -> SUP_NAME }}  {{ $infoasset -> TYPE_ITEM_NAME }}  {{ $infoasset -> SUP_MASH }}</option>'+           
                '@endforeach'+                            
                '</select>'+ 
                '</td>'+
                '<td style="border: 1px solid black;">'+
                '<input name="SUP_TOTAL[]" id="SUP_TOTAL'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+count+');" OnKeyPress="return chkNumber(this)">'+
                '</td>'+
                
                '<td style="border: 1px solid black;"><div class="showunit'+count+'">'+
                '<select name="SUP_UNIT_ID[]" id="SUP_UNIT_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+                                           
                '<option value=" "></option>'+                                     
                '</select>'+
                '</div></td>'+
           
                '<td style="border: 1px solid black;">'+
                '<input name="PRICE_PER_UNIT[]" id="PRICE_PER_UNIT'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+count+');" OnKeyPress="return chkNumber(this)">'+
                '</td>'+
                '<td style="text-align: left;border: 1px solid black;">'+
                '<div class="summoney'+count+'"></div>'+
                '</td>'+
                '<td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                '<input type="hidden" name="SUP_UNIT_ID_H[]" id="SUP_UNIT_ID_H'+count+'" value="0">'+
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


function chkNumber(ele){
    var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
//-----------------------------------------------------

 function checksummoney(number){
      
    
      var SUP_TOTAL=document.getElementById("SUP_TOTAL"+number).value;
      var PRICE_PER_UNIT=document.getElementById("PRICE_PER_UNIT"+number).value;
      
      
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


  function formatNumber(num) {
    return num.toFixed(5).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
  
  function findTotal(){
    var arr = document.getElementsByName('sum');
    var tot=0;

    count = $('.tbody1').children('tr').length;
    for(var i=0;i<count;i++){

            tot += parseFloat(arr[i].value);   
    }
    document.getElementById('total').value =tot.toFixed(5);
    document.getElementById('PRICESUM').value =tot.toFixed(5);
    document.getElementById('PRICESUM_cal').value =tot.toFixed(5);
  
    taxcal();
}
  
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(5);

}


function run01(){
    var count = $('.tbody1').children('tr').length;
    // alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkunitref(number);
            checksummoney(number);   
        }
       
        findTotal();
      
      
}


function checkunitref(number){
      
    
      var SUP_ID=document.getElementById("SUP_ID"+number).value;
      var SUP_UNIT_ID_H=document.getElementById("SUP_UNIT_ID_H"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.checkunitref')}}",
                   method:"GET",
                   data:{SUP_ID:SUP_ID,SUP_UNIT_ID_H:SUP_UNIT_ID_H,_token:_token},
                   success:function(result){
                      $('.showunit'+number).html(result);
                   }
           })

        

  }


  //======การคำนวณ VAT

  $('.tax_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             var pricesum = document.getElementById("PRICESUM_cal").value;
             var disc= document.getElementById("DISC").value;
             $.ajax({
                     url:"{{route('msupplies.fetchtaxcal_list')}}",
                     method:"GET",
                     data:{select:select,disc:disc,pricesum:pricesum,_token:_token},
                     success:function(result){
                        $('.taxcal').html(result);
                     }
             })
          
             }        
     });

  function taxcal(){
  
  var select= document.getElementById("TAX_TYPE").value;
  var disc= document.getElementById("DISC").value;
  
  var _token=$('input[name="_token"]').val();
  var pricesum = document.getElementById("PRICESUM_cal").value;
  $.ajax({
          url:"{{route('msupplies.fetchtaxcal_list')}}",
          method:"GET",
          data:{select:select,disc:disc,pricesum:pricesum,_token:_token},
          success:function(result){
             $('.taxcal').html(result);
          }
  })
}
  
</script>



@endsection