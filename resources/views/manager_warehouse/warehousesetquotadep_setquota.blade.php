@extends('layouts.warehouse')
    
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

<body>
<center>    

    <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row" align="left" >
                        <div class="col-sm-6">
                            &nbsp;&nbsp;&nbsp;รายการโควตาของหน่วยงาน {{$detaildep->HR_DEPARTMENT_SUB_SUB_NAME}}
                        </div>
                    
                </div>
                </h2> 
               
                <div align="left">
                    <form  method="post" action="{{ route('mwarehouse.savewarehousesetquotadep_setquota') }}" enctype="multipart/form-data">
                        @csrf

      
    
           <input type="hidden" name="DEPID" id="DEPID" value="{{$detaildep->HR_DEPARTMENT_SUB_SUB_ID}}">
         <table class="table-bordered table-striped table-vcenter" style="width: 100%;">
       <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    <td style="text-align: center;font-size: 14px;" width="5%">ลำดับ</td>
                    <td style="text-align: center;font-size: 14px;">รายการและรายละเอียด</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">จำนวนโควตา</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">จำนวนน้อยสุด</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">จำนวนมากสุด</td>
                    <td style="text-align: center;font-size: 14px;" width="12%">
                        <a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">

            @if($countcheck==0)
                <tr height="20">
                 
                    <td style="text-align: center;">
                     1
                    </td>
                    <td>
                        <select name="WAREHOUSE_TREASARY_QUOTA_SUP_ID[]" id="WAREHOUSE_TREASARY_QUOTA_SUP_ID0" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;">
                                <option value="" selected>--กรุณาเลือก--</option>
                                @foreach ($infoassets as $infoasset)                    
                                        <option value="{{ $infoasset -> ID }}">{{ $infoasset -> SUP_NAME }}</option>           
                                @endforeach                  
                         </select> 

                    </td>
                    <td>
                        <input name="WAREHOUSE_TREASARY_QUOTA_AMOUNT[]" id="WAREHOUSE_TREASARY_QUOTA_AMOUNT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                    </td>
                 
                    <td>
                        <input name="WAREHOUSE_TREASARY_QUOTA_MIN[]" id="WAREHOUSE_TREASARY_QUOTA_MIN[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                    </td>

                    <td>
                        <input name="WAREHOUSE_TREASARY_QUOTA_MAX[]" id="WAREHOUSE_TREASARY_QUOTA_MAX[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                    </td>
                  
                    <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                </tr>
               
            @else
            
             <?php $num = 0; $count=1;?>
            @foreach ($infotreasuryquotas as $infotreasuryquota) 
            
            <tr height="20">
                    <td style="text-align: center;">
                    {{$count}}
                    </td>
                 
                 <td>
                     <select name="WAREHOUSE_TREASARY_QUOTA_SUP_ID[]" id="WAREHOUSE_TREASARY_QUOTA_SUP_ID{{$num}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                      <option value="" selected>--กรุณาเลือก--</option>
                                    @foreach ($infoassets as $infoasset) 
                                       @if($infoasset->ID == $infotreasuryquota->WAREHOUSE_TREASARY_QUOTA_SUP_ID)                   
                                      <option value="{{ $infoasset -> ID }}" selected>{{ $infoasset -> SUP_NAME }}</option> 
                                      @else
                                      <option value="{{ $infoasset -> ID }}">{{ $infoasset -> SUP_NAME }}</option> 
                                      @endif
                                    @endforeach                 
                                      
                      </select> 

                 </td>
                 <td>
                    <input name="WAREHOUSE_TREASARY_QUOTA_AMOUNT[]" id="WAREHOUSE_TREASARY_QUOTA_AMOUNT[]"  value="{{$infotreasuryquota->WAREHOUSE_TREASARY_QUOTA_AMOUNT}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                </td>
             
                <td>
                     <input name="WAREHOUSE_TREASARY_QUOTA_MIN[]" id="WAREHOUSE_TREASARY_QUOTA_MIN[]"  value="{{$infotreasuryquota->WAREHOUSE_TREASARY_QUOTA_MIN}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                </td>

                <td>
                    <input name="WAREHOUSE_TREASARY_QUOTA_MAX[]" id="WAREHOUSE_TREASARY_QUOTA_MAX[]" value="{{$infotreasuryquota->WAREHOUSE_TREASARY_QUOTA_MAX}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                </td>
                
                 <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt "></i></a></td>
 
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
                    <a href="{{ url('manager_warehouse/warehousesetquotadep')  }}" class="btn btn-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ยกเลิก</a>
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


$('.addRow').on('click',function(){
        addRow();
        $("select").select2();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();;
        var tr =   '<tr>'+
                '<td style="text-align: center;">'+
                +number+
                '</td>'+
                '<td>'+
                '<select name="WAREHOUSE_TREASARY_QUOTA_SUP_ID[]" id="WAREHOUSE_TREASARY_QUOTA_SUP_ID'+count+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="" >--กรุณาเลือก--</option>'+
                ' @foreach ($infoassets as $infoasset)'+                    
                '<option value="{{ $infoasset -> ID }}">{{ $infoasset -> SUP_NAME }}</option>'+           
                '@endforeach'+                                
                '</select>'+ 
                '</td>'+
                '<td>'+
                '<input name="WAREHOUSE_TREASARY_QUOTA_AMOUNT[]" id="WAREHOUSE_TREASARY_QUOTA_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
                '</td>'+                
                '<td> '+  
                '<input name="WAREHOUSE_TREASARY_QUOTA_MIN[]" id="WAREHOUSE_TREASARY_QUOTA_MIN[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
                '</td>'+           
                '<td>'+
                '<input name="WAREHOUSE_TREASARY_QUOTA_MAX[]" id="WAREHOUSE_TREASARY_QUOTA_MAX[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
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


</script>



@endsection