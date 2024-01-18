@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{asset('select2/select2.min.css')}}" rel="stylesheet" />


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

<body onload="run01();">
                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                             <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                <div>
                                <a href="{{ url('general_asset/dashboard/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a> 
                                </div>
                                <div>&nbsp;</div>     
                                <div>
                                <a href="{{ url('general_asset/genassetindex/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนครุภัณฑ์</a> 
                                </div>
                                <div>&nbsp;</div>                      
                                <div>
                                <a href="{{ url('general_asset/genassetdisburseindex/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนเบิกครุภัณฑ์  
                                </a> 
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID)}}" class="btn btn-info" >ทะเบียนยืม
                                </a>   
                                </div>           
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_asset/infogiveindex/'.$inforpersonuserid -> ID)}}"  class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนถูกยืม
                                </a>   
                                </div>    
                         
                                
                                </div>
                                </ol>
                            </nav> 
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"> แก้ไขการขอยืมทรัพย์สิน</h2> 
                        
       
           <form  method="post" action="{{ route('asset.infolendupdate') }}"  enctype="multipart/form-data"> 
        @csrf
       
        <input type="hidden" name="ID" id="ID"  value="{{ $infoassetrequestlend -> ID }}">    
       <div class="row push">
            <div class="col-sm-2">
                <label>ผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$inforpersonuser -> HR_FNAME}} {{$inforpersonuser -> HR_LNAME}} 
            <input type="hidden" name="SAVE_HR_ID" id="SAVE_HR_ID"  value="{{ $inforpersonuserid -> ID }}">    
            <input type="hidden" name="SAVE_HR_NAME" id="SAVE_HR_NAME" value="{{ $inforpersonuser -> HR_PREFIX_NAME }}{{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}">    
            </div> 
           
            <div class="col-sm-2">
                <label>หน่วยงานผู้ขอเบิก :</label>
            </div> 
            <div class="col-lg-4">
            {{$inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME}}

   
            <input type="hidden" name="DEP_SUB_SUB_ID" id="DEP_SUB_SUB_ID" value="{{$inforpersonuser -> HR_DEPARTMENT_SUB_SUB_ID}}">
            <input type="hidden" name="DEP_SUB_SUB_NAME" id="DEP_SUB_SUB_NAME" value="{{$inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME}}">
            </div>
         
        </div>
       <div class="row push">
            <div class="col-sm-2">
                <label>ขอเบิกจากหน่วยงาน :</label>
            </div> 
            <div class="col-lg-4">
             
            {{$infoassetrequestlend->GIVE_DEP_SUB_SUB_NAME }}
            
            </div>
            <div class="col-sm-2">
                <label>เหตุผลการขอยืม :</label>
            </div> 
            <div class="col-lg-4">
            <input name="REQUEST_FOR" id="REQUEST_FOR" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infoassetrequestlend->REQUEST_FOR}}">
            
            </div>


           
        </div>

        <div class="row push">
            <div class="col-sm-2">
                <label>วันที่ต้องการ :</label>
            </div> 
            <div class="col-lg-4">
            <input name="DATE_WANT" id="DATE_WANT" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{formate($infoassetrequestlend->DATE_WANT)}}" readonly>
            
            </div>
            <div class="col-sm-2">
                <label>วันที่ขอยืม :</label>
            </div> 
            <div class="col-lg-4">
            <input name="DATE_LEND" id="DATE_LEND" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  value="{{formate($infoassetrequestlend->DATE_LEND)}}"  readonly>
            
            </div>


           
        </div>

    

       <table class="table gwt-table" >
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                    
                    <td style="text-align: center;">ครุภัณฑ์ที่ต้องการยืม </td>  
                    <td style="text-align: center;" width="12%">
                        <a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">
            @if($countcheck == 0)
                <tr height="20">
                 
                    <td>
                       
                    
                        <select name="ASSET_REQUEST_LEND_SUB_ARTICLE_ID[]" id="ASSET_REQUEST_LEND_SUB_ARTICLE_ID0" class="form-control input-sm assetdep" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" selected>--กรุณาครุภัณฑ์--</option>
                        @foreach ($inforequestassets as $inforequestasset)                   
                        <option value="{{ $inforequestasset -> ARTICLE_ID }}">{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>'+           
                        @endforeach 
                         
                         </select> 
                    
                    
                    
                    </td>                 
                  
                    <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                </tr>
            @else
            <?php $number=0; ?>
            @foreach ($infoassetrequestlendsubs as $infoassetrequestlendsub)
            <tr height="20">
                 
                 <td>
                    
                 
                     <select name="ASSET_REQUEST_LEND_SUB_ARTICLE_ID[]" id="ASSET_REQUEST_LEND_SUB_ARTICLE_ID{{$number}}" class="form-control input-sm assetdep" style=" font-family: 'Kanit', sans-serif;" >
                     <option value="" selected>--กรุณาครุภัณฑ์--</option>
                     @foreach ($inforequestassets as $inforequestasset)                   
                     @if($inforequestasset -> ARTICLE_ID == $infoassetrequestlendsub->ASSET_REQUEST_LEND_SUB_ARTICLE_ID)
                     <option value="{{ $inforequestasset -> ARTICLE_ID }}" selected>{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>'+   
                     @else
                     <option value="{{ $inforequestasset -> ARTICLE_ID }}">{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>
                     @endif
                     
                            
                     @endforeach 
                      
                      </select> 
                 
                 
                 
                 </td>

              
               
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
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกแก้ไขข้อมูล</button>
                    <a href="{{ url('general_asset/infolendindex/'.$inforpersonuserid -> ID) }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
            </div>
        </div>
    </form>  

   
                  

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
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

    $(document).ready(function() {
    $('select').select2();
});



$('.addRow').on('click',function(){
        addRow();
        $('select').select2();
    });

    function addRow(){


    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
              
                '<td>'+
                '<select name="ASSET_REQUEST_LEND_SUB_ARTICLE_ID[]" id="ASSET_REQUEST_LEND_SUB_ARTICLE_ID[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="" selected>--กรุณาเลือกครุภัณฑ์--</option>'+
                '@foreach ($inforequestassets as $inforequestasset)'+                    
                '<option value="{{ $inforequestasset -> ARTICLE_ID }}">{{ $inforequestasset -> ARTICLE_NUM }} >> {{ $inforequestasset -> ARTICLE_NAME }}</option>'+           
                '@endforeach'+  
                ' </select>'+            
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


 //-------------------------------------------------


 function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}
//-----------------------------------------------------

  
  
</script>



@endsection