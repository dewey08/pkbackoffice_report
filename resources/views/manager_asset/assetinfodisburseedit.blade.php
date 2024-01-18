@extends('layouts.asset')
    
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
            font-size: 14px;
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



?>
<?php

  $datenow = date('Y-m-d');

  $m_budget = date("m");

  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }


?>  

<center>
    <body onload="run01();">
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
                <div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลการขอเบิกทรัพย์สิน</B></h3>

</div>                
<div class="block-content block-content-full">
           <form  method="post" id="form_edit" action="{{ route('massete.assetinfodisburseupdate') }}"  enctype="multipart/form-data"> 
        @csrf
       
  
        <input type="hidden" name="ID" id="ID"  value="{{ $infoassetrequest -> ID }}">    
       <div class="row push">
            <div class="col-sm-2">
                <label>ผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequest -> SAVE_HR_NAME}} 
          
            </div> 
           
            <div class="col-sm-2">
                <label>หน่วยงานผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$infoassetrequest -> DEP_SUB_SUB_NAME}}

   
         
            </div>
         
        </div>
       <div class="row push">
            <div class="col-sm-2">
                <label>ปีงบประมาณ :</label>
            </div> 
            <div class="col-lg-4">
                                    <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg {{$errors->has('YEAR_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                                    @foreach ($budgetyears as $budgetyear) 
                                            @if($budgetyear ->LEAVE_YEAR_ID == $yearbudget)
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                                            @else
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                                            @endif
                                    @endforeach 
                                    </select> 
            
            </div>
            <div class="col-sm-2">
                <label>ใบสำคัญเบิกเลขที่ :</label>
            </div> 
            <div class="col-lg-4">
            <input name="BILL_NUMBER" id="BILL_NUMBER" class="form-control input-sm {{$errors->has('BILL_NUMBER') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetrequest->BILL_NUMBER}}">
            
            </div>


           
        </div>

        <div class="row push">
            <div class="col-sm-2">
                <label>วันที่ต้องการ :</label>
            </div> 
            <div class="col-lg-4">
            <input name="DATE_WANT" id="DATE_WANT" class="form-control input-sm datepicker {{$errors->has('DATE_WANT') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="{{formate($infoassetrequest->DATE_WANT)}}"  readonly>
            
            </div>
            <div class="col-sm-2">
                <label>วันที่เบิก :</label>
            </div> 
            <div class="col-lg-4">
            <input name="DATE_OPEN" id="DATE_OPEN" class="form-control input-sm datepicker {{$errors->has('DATE_OPEN') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="{{formate($infoassetrequest->DATE_OPEN)}}"  readonly>
            
            </div>


           
        </div>

       <div class="row push">

       <div class="col-sm-2">
        <label>เหตุผลการขอเบิก :</label>
        </div> 
        <div class="col-sm-10">
        <input name="REQUEST_FOR" id="REQUEST_FOR" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetrequest->REQUEST_FOR}}">
        </div> 
       </div>

       <table class="table gwt-table" >
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    
                    <td style="text-align: center;">ครุภัณฑ์ที่ต้องการเบิก </td>
                    <td style="text-align: center;">หน่วยนับ </td>
                    <td style="text-align: center;">ราคาต่อหน่วย </td>
                
                    <td style="text-align: center;" width="12%">
                        <a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">
             
              @if($countchack == 0)
                <tr height="40">
                 
                    <td>
                       
                    
                        <select name="ASSET_REQUEST_SUB_ARTICLE_ID[]" id="ASSET_REQUEST_SUB_ARTICLE_ID0" class="form-control input-sm " onchange="checkunitname(0);checkpice(0);"  style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" selected>--กรุณาเลือกครุภัณฑ์--</option>
                                           @foreach ($inforequestassets as $inforequestasset)                    
                                            <option value="{{ $inforequestasset -> ARTICLE_ID }}">{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>           
                                            @endforeach  
                         </select> 
                    
                    
                    
                    </td>

                    <td><div class="showunitname0"></div></td>
                    <td><div class="showpice0"></div></td>


                 
                  
                    <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                </tr>

             @else
             <?php $number = 0;?>
             @foreach ($infoassetrequestsubs as $infoassetrequestsub) 
             <tr height="40">
                 
                 <td>
                    
                 
                     <select name="ASSET_REQUEST_SUB_ARTICLE_ID[]" id="ASSET_REQUEST_SUB_ARTICLE_ID{{$number}}" class="form-control input-sm "  onchange="checkunitname(0);checkpice(0);" style=" font-family: 'Kanit', sans-serif;" >
                     <option value="" selected>--กรุณาเลือกครุภัณฑ์--</option>
                                        @foreach ($inforequestassets as $inforequestasset)                    
                                            @if($inforequestasset -> ARTICLE_ID == $infoassetrequestsub->ASSET_REQUEST_SUB_ARTICLE_ID)
                                                <option value="{{ $inforequestasset -> ARTICLE_ID }}" selected>{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>           
                                            @else
                                                <option value="{{ $inforequestasset -> ARTICLE_ID }}">{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>           
                                            @endif

                                         @endforeach  
                      </select> 
                 
                 
                 
                 </td>

                 <td><div class="showunitname{{$number}}"></div></td>
                 <td><div class="showpice{{$number}}"></div></td>

              
               
                 <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
             </tr>

             <?php $number++; ?>
             @endforeach 

             @endif

            </tbody>
        </table>
              <br> 
        <div class="modal-footer">
            <div align="right">
                <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-edit" >บันทึกแก้ไขข้อมูล</span>
                    <a href="{{ url('manager_asset/assetinfodisburse') }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
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


function run01(){

  

    var count = $('.tbody1').children('tr').length;
    //alert(count);
    var number;
        for (number = 0; number < count; number++) { 
         
            
            checkunitname(number);
            checkpice(number);
          
        }

}

  $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });


$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
              
                '<td>'+
                '<select name="ASSET_REQUEST_SUB_ARTICLE_ID[]" id="ASSET_REQUEST_SUB_ARTICLE_ID'+count+'" onchange="checkunitname('+count+');checkpice('+count+');" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="" selected>--กรุณาเลือกครุภัณฑ์--</option>'+
                '@foreach ($inforequestassets as $inforequestasset)'+                    
                '<option value="{{ $inforequestasset -> ARTICLE_ID }}">{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>'+           
                '@endforeach'+  
                ' </select>'+            
                '</td>'+
                
                '<td><div class="showunitname'+count+'"></div></td>'+
                '<td><div class="showpice'+count+'"></div></td>'+
              
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


 //-------------------------------------------------

 
 $('.type_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('suplies.fetchdetail')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.detail').html(result);
                     }
             })
            // console.log(select);
             }        
     });

 function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}
//-----------------------------------------------------

 function checksummoney(number){
      
    
      var SUPPLIES_REQUEST_SUB_AMOUNT=document.getElementById("SUPPLIES_REQUEST_SUB_AMOUNT"+number).value;
      var SUPPLIES_REQUEST_SUB_PRICE=document.getElementById("SUPPLIES_REQUEST_SUB_PRICE"+number).value;
      
      //alert(PERSON_ID);
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('suplies.checksummoney')}}",
                   method:"GET",
                   data:{SUPPLIES_REQUEST_SUB_AMOUNT:SUPPLIES_REQUEST_SUB_AMOUNT,SUPPLIES_REQUEST_SUB_PRICE:SUPPLIES_REQUEST_SUB_PRICE,_token:_token},
                   success:function(result){
                      $('.summoney'+number).html(result);
                   }
           })

  }


  function checkunitname(number){
      
    
      var ARTICLE_ID=document.getElementById("ASSET_REQUEST_SUB_ARTICLE_ID"+number).value;
        
        //alert(ARTICLE_ID);
        
        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('asset.checkunitname')}}",
                     method:"GET",
                     data:{ARTICLE_ID:ARTICLE_ID,_token:_token},
                     success:function(result){
                        $('.showunitname'+number).html(result);
                     }
             })
  
          
  
    }
  
    function checkpice(number){
        
      
        var ARTICLE_ID=document.getElementById("ASSET_REQUEST_SUB_ARTICLE_ID"+number).value;
        
        //alert(ARTICLE_ID);
        
        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('asset.checkpice')}}",
                     method:"GET",
                     data:{ARTICLE_ID:ARTICLE_ID,_token:_token},
                     success:function(result){
                        $('.showpice'+number).html(result);
                     }
             })
  
    }

    $('.btn-submit-edit').click(function (e) { 

        var form = $('#form_edit');
        formSubmit(form)
            
        });
  
  
</script>



@endsection