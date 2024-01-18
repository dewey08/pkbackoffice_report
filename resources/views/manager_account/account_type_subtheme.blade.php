@extends('layouts.account')
    
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
$refnumberrev = ManageraccountController::refnumberrev($typename);

?>
<?php
function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }
  function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  return $strDay."/".$strMonth."/".$strYear;
  }  
?>  
<body onload="run01();">

<br>
<br>
<center>    

    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">  
            <div class="row">
                <div class="col-sm-7"  align="left">
                    @if($typename == 'revenue')
                    <h2 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>01 : บันทึกสมุดบัญชีรายรับ</B></h2>
                    @elseif($typename == 'expenditure')
                    <h2 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>02 : บันทึกสมุดบัญชีรายจ่าย</B></h2>
                    @elseif($typename == 'general')
                    <h2 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>03 : บันทึกสมุดบัญชีทั่วไป</B></h2>
                    @elseif($typename == 'debtor')
                    <h2 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>04 : บันทึกสมุดรายวันลูกหนี้</B></h2>
                    @elseif($typename == 'daily')
                    <h2 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>05 : บันทึกสมุดรายวันซื้อ</B></h2>
                    @endif
                </div>
                <div class="col-sm-5"  align="right">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target=".addtheme"  >เลือกรูปแบบ</button>
                           
                   
                </div>
            </div>

            
               <br>
               
                <div align="left">
        <form  method="post" action="{{ route('maccount.revenueexpenses_save') }}" enctype="multipart/form-data">
          
        @csrf

        

        <input type="hidden" name="ACCOUNT_ID" id="ACCOUNT_ID" value="{{$infoacc->ACCOUNT_ID}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >

             @if($typename == 'revenue')
               <input type="hidden" name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="01">
               @elseif($typename == 'expenditure')
               <input type="hidden" name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="02">
               @elseif($typename == 'general')
               <input type="hidden" name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="03">
               @elseif($typename == 'debtor')
               <input type="hidden" name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="04">
               @elseif($typename == 'daily')
               <input type="hidden" name="ACCOUNT_TYPE" id="ACCOUNT_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="05">
               @endif


     
        <div class="row">
        <div class="col-sm-2">
        <label>ปีงบประมาณ :</label>
        </div> 
        <div class="col-lg-2">
        
        <select name="ACCOUNT_YEAR" id="ACCOUNT_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
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
                <label>บริษัท :</label>
            </div>         
        <div class="col-lg-2">        
                <select name="ACCOUNT_VENDOR_ID" id="ACCOUNT_VENDOR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--กรุณาเลือก--</option>
                        @foreach ($infovendors as $infovendor) 
                               @if($infoacc->ACCOUNT_VENDOR_ID == $infovendor ->VENDOR_ID)
                                <option value="{{ $infovendor ->VENDOR_ID  }}" selected>{{ $infovendor->VENDOR_NAME}}</option>
                               @else
                                <option value="{{ $infovendor ->VENDOR_ID  }}">{{ $infovendor->VENDOR_NAME}}</option>
                               @endif
                        @endforeach 
                </select>  
        
        </div>
        <div class="col-sm-2">
            <label>ประเภทภาษี :</label>
            </div> 
            <div class="col-sm-2">
          
            <select name="ACCOUNT_TEXPICE" id="ACCOUNT_TEXPICE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" >
            @if($infoacc->ACCOUNT_TEXPICE == '1')<option value="1" selected>รวมภาษี</option>@else<option value="1" >รวมภาษี</option>@endif
            @if($infoacc->ACCOUNT_TEXPICE == '2')<option value="2" selected>แยกภาษี</option>@else<option value="2" >แยกภาษี</option>@endif
                        </select>
            
            </div> 

        </div>
        <br>
        <div class="row">
        <div class="col-sm-2">
        <label>เลขที่เอกสาร :</label>
        </div> 
        <div class="col-lg-2">
        <input name="ACCOUNT_NUMBER" id="ACCOUNT_NUMBER" value="{{$refnumberrev}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-sm-2">
            <label>เลขที่ใบกำกับภาษี :</label>
        </div>         
        <div class="col-lg-2">        
            <input name="ACCOUNT_DOCTAX_NUM" id="ACCOUNT_DOCTAX_NUM" value="{{$infoacc->ACCOUNT_DOCTAX_NUM}}" class="form-control input-lg"   style=" font-family: 'Kanit', sans-serif;" >
        </div>

        <div class="col-sm-2">
            <label>เลขที่เอกสารอ้างอิง :</label>
        </div>         
        <div class="col-lg-2">        
            <input name="ACCOUNT_DOCREF_NUM" id="ACCOUNT_DOCREF_NUM" value="{{$infoacc->ACCOUNT_DOCREF_NUM}}" class="form-control input-lg"   style=" font-family: 'Kanit', sans-serif;" >
        </div>

        </div>
       <br>
       
       <div class="row">

       <div class="col-sm-2">
                <label>วันที่เอกสาร:</label>
            </div>         
        <div class="col-lg-2">        
        <input name="ACCOUNT_OUT_DATE" id="ACCOUNT_OUT_DATE" value="{{formate($infoacc->ACCOUNT_OUT_DATE)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  value="{{formate(date('Y-m-d'))}}" readonly>
        </div>    

        <div class="col-sm-2">
            <label>วันที่ใบกำกับภาษี  :</label>
        </div>         
        <div class="col-lg-2">  
                @if($infoacc->ACCOUNT_DOCTAX_DATE !== null  && $infoacc->ACCOUNT_DOCTAX_DATE !== '' )        
                <input name="ACCOUNT_DOCTAX_DATE" id="ACCOUNT_DOCTAX_DATE" value="{{formate($infoacc->ACCOUNT_DOCTAX_DATE)}}"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
                @else
                <input name="ACCOUNT_DOCTAX_DATE" id="ACCOUNT_DOCTAX_DATE"   class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
                @endif
        </div>
        <div class="col-sm-2">
                <label>วันที่เอกสารอ้างอิง :</label>
        </div>         
        <div class="col-lg-2">   
        @if($infoacc->ACCOUNT_DOCTAX_DATE !== null && $infoacc->ACCOUNT_DOCTAX_DATE !== '')     
                <input name="ACCOUNT_DOCREF_DATE" id="ACCOUNT_DOCREF_DATE" value="{{formate($infoacc->ACCOUNT_DOCTAX_DATE)}}"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
        @else
                <input name="ACCOUNT_DOCREF_DATE" id="ACCOUNT_DOCREF_DATE"   class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
        @endif
        </div>

        </div>
        <br>
       
        <div class="row">
            <div class="col-sm-2">
                <label>เลขที่ใบแจ้งหนี้ :</label>
            </div>         
            <div class="col-lg-2">        
                    <input name="ACCOUNT_INVOICE_NUM" id="ACCOUNT_INVOICE_NUM"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" >
            </div>

            <div class="col-sm-2">
            <label>คำอธิบาย :</label>
            </div> 
            <div class="col-sm-6">
            <input name="ACCOUNT_DETAIL" id="ACCOUNT_DETAIL" value="{{$infoacc->ACCOUNT_DETAIL}}"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" >
            </div> 
            </div>
            <br>
  
    
            <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <td style="text-align: center;" width="5%">ลำดับ</td>
                            <td style="text-align: center;" width="15%">เลขบัญชี</td>
                            <td style="text-align: center;">รายละเอียด</td>
                            <td style="text-align: center;" width="20%">เดบิต</td>
                            <td style="text-align: center;" width="20%">เครดิต</td>
                            <td style="text-align: center;" width="12%">
                                <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="tbody1">
                    <?php $count=1;$number=0;?>
                    @foreach ($infoaccsubs as $infoaccsub)
                
                        <tr height="20">
                        
                            <td style="text-align: center;">
                            {{$count}}
                            </td>
                            <td>
                              
                                    <select name="ACCOUNT_SUB_NUM[]" id="ACCOUNT_SUB_NUM{{$number}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="showaccount({{$number}});">
                                        <option value="">--กรุณาเลือกบัญชี--</option>
                                                            @foreach ($infoaccounts as $infoaccount) 
                                                                @if($infoaccount ->ACCOUNT_CHART_CODE == $infoaccsub->ACCOUNT_SUB_NUM)
                                                                <option value="{{ $infoaccount ->ACCOUNT_CHART_CODE  }}" selected>{{ $infoaccount->ACCOUNT_CHART_CODE}}</option>
                                                                @else
                                                                <option value="{{ $infoaccount ->ACCOUNT_CHART_CODE  }}">{{ $infoaccount->ACCOUNT_CHART_CODE}}</option>
                                                                @endif
                                                            @endforeach 
                                    </select>    
                            
                            </td>
                        
                            <td><div class="showaccount{{$number}}"></div></td>
                            
                        
                            <td>
                                <input name="ACCOUNT_SUB_DEBIT[]" id="ACCOUNT_SUB_DEBIT{{$number}}" value="{{$infoaccsub->ACCOUNT_SUB_DEBIT}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                            </td>
                    
                            <td>
                                <input name="ACCOUNT_SUB_CREDIT[]" id="ACCOUNT_SUB_CREDIT{{$number}}" value="{{$infoaccsub->ACCOUNT_SUB_CREDIT}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                            </td>

                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        
                        </tr>
                    
                        <?php  $count++;$number++;?>

                    @endforeach 

                    </tbody>
                </table>
                            <br> 
            
                            <div class="row">
            <div class="col-lg-6" align="left">
                     <button type="submit"  class="btn btn-success btn-lg"  name="SUBMIT" value="savetheme" >บันทึกรูปแบบ</button>
            </div>
            <div class="col-lg-6" align="right">
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info" name="SUBMIT" value="saveinfo" >บันทึกข้อมูล</button>
                   
                    <a href="{{ url('manager_account/account_type_sub/'.$typename)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>
        </div>
    </form>  

    

    <!--    เมนูเลือก   -->
       
    <div class="modal fade addtheme" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalbook">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกรูปแบบ</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style="text-align: center;" width="20%">เลขที่เอกสาร</td>
                                    <td style="text-align: center;">คำอธิบาย</th>
                                    <td style="text-align: center;" width="5%">เลือก</td>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach ($themes as $theme) 
                                    <tr>
                                        <td >{{$theme->ACCOUNT_NUMBER}}</td>
                                        <td >{{$theme->ACCOUNT_DETAIL}}</td>
                                                                   
                                        <td >
                                             <a href="{{ url('manager_account/account_type_subadd_theme/'.$typename.'/'.$theme->ACCOUNT_ID)  }}" type="button" class="btn btn-hero-sm btn-hero-info"   >เลือก</a> 
                                             
                                        </td>
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
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

 function checksummoney(number){
      
    
      var SUP_TOTAL=document.getElementById("SUP_TOTAL"+number).value;
      var PRICE_PER_UNIT=document.getElementById("PRICE_PER_UNIT"+number).value;
      
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
}
  
function chkNum(ele)
{
var num = parseFloat(ele.value);
ele.value = num.toFixed(5);

}


function run01(){
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
            checkunitref(number);
            checksummoney(number);
     
            
        }
      
      
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

   //========================================

  
$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number = count+1;
        var tr =   '<tr height="20">'+
         '<td style="text-align: center;">'+
          number+
          '</td>'+
          '<td>'+
          '<select name="ACCOUNT_SUB_NUM[]" id="ACCOUNT_SUB_NUM'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" onchange="showaccount('+count+');">'+
          '<option value="">--กรุณาเลือกบัญชี--</option>'+
          '@foreach ($infoaccounts as $infoaccount)'+ 
          '<option value="{{ $infoaccount ->ACCOUNT_CHART_CODE  }}">{{ $infoaccount->ACCOUNT_CHART_CODE}}</option>'+
          '@endforeach'+ 
          '</select>'+    
          '</td>'+
          '<td><div class="showaccount'+count+'"></div></td>'+
          '</td>'+
          '<td>'+
          '<input name="ACCOUNT_SUB_DEBIT[]" id="ACCOUNT_SUB_DEBIT0" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
          '</td>'+
          '<td>'+
          '<input name="ACCOUNT_SUB_CREDIT[]" id="ACCOUNT_SUB_CREDIT0" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
          '</td>'+
          '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+    
          '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});
  


function run01(){
    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
         
            showaccount(number);
     
            
        }
      
      
}


function showaccount(number){
      
    
      var ACCOUNT_SUB_NUM=document.getElementById("ACCOUNT_SUB_NUM"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('maccount.showaccount')}}",
                   method:"GET",
                   data:{ACCOUNT_SUB_NUM:ACCOUNT_SUB_NUM,_token:_token},
                   success:function(result){
                      $('.showaccount'+number).html(result);
                   }
           })

}     



</script>



@endsection