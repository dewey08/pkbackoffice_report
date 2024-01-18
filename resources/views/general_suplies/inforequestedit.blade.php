@extends('layouts.backend')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')

<style>
          .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }
                    
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





use App\Http\Controllers\SupliesController;
$checkapp = SupliesController::checkapp($user_id);
$checkallow = SupliesController::checkallow($user_id);

$countapp = SupliesController::countapp($user_id);
$countallow = SupliesController::countallow($user_id);



?>
<?php


  $datenow = date('Y-m-d');
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
                                             <a href="{{ url('general_suplies/dashboard/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>



                                            <div>
                                             <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}" class="btn btn-hero-sm btn-hero-primary" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ขอจัดซื้อ/จัดจ้าง</a>
                                            </div>
                                            <div>&nbsp;</div>

                                       
                                            @if($checkapp != 0)
                                            <div>
                                           <a href="{{ url('general_suplies/inforequestapp/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เห็นชอบ

                                           @if($countapp!=0)
                                    <span class="badge badge-light" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">{{$countapp}}</span>
                                            @endif
                                            </a>
                                            </div>
                                            <div>&nbsp;</div>
                                            @endif

                                            @if($checkallow!=0)
                                            <div>
                                            <a href="{{ url('general_suplies/inforequestlastapp/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ

                                            @if($countallow!=0)
                                            <span class="badge badge-light" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">{{$countallow}}</span>
                                            @endif
                                            </a>
                                            </div>
                                            <div>&nbsp;</div>
                                            @endif 

                                            </ol>

                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">


                <div class="block-content">
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขการขอซื้อขอจ้างพัสดุ</h2>


           <form  method="post" action="{{ route('suplies.inforequestupdate') }}" enctype="multipart/form-data">
        @csrf
         
        <input type="hidden" name="ID" id="ID" value="{{$inforequest->ID}}">

        <div class="row push">
            <div class="col-sm-2">
                <label>รหัสขอซื้อ/ขอจ้าง :</label>
            </div> 
            {{$inforequest->REQUEST_ID}}

        </div>
     
        <div class="row push">
        <div class="col-sm-2">
            <label>ลงวันที่ต้องการ :</label>
        </div>
        <div class="col-lg-2">
            <input name="DATE_WANT" id="DATE_WANT" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate($inforequest->DATE_WANT)}}" readonly>
        </div>
        <div class="col-sm-2 text-right">
                <label>เพื่อจัดซื้อ/ซ่อมแซม :</label>
            </div>
        <div class="col-lg-6">
                    <select name="REQUEST_FOR_ID" id="REQUEST_FOR_ID" class="form-control input-sm js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" required>
                            <option value="" selected>--กรุณาเลือกวัสดุครุภัณฑ์--</option>
                             @foreach ($inforequesttypes as $inforequesttype)
                                 @if($inforequest-> REQUEST_FOR_ID == $inforequesttype->SUP_TYPE_ID)
                                    <option value="{{ $inforequesttype -> SUP_TYPE_ID }}" selected>{{ $inforequesttype -> SUP_TYPE_NAME }}</option>
                                @else
                                    <option value="{{ $inforequesttype -> SUP_TYPE_ID }}">{{ $inforequesttype -> SUP_TYPE_NAME }}</option>
                                @endif
                            @endforeach
                    </select>
        </div>
       </div>

       <div class="detail">
       <input type="hidden" name="HIRE_DETAIL" id="HIRE_DETAIL" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" value="">
        </div>

       <div class="row push">
       <div class="col-sm-2">
                <label>ปีงบประมาณ :</label>
            </div> 
            <div class="col-lg-2">

                         <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                @foreach ($budgets as $budget)
                                @if($budget->LEAVE_YEAR_ID== $year_id)
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                @else
                                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                @endif                                 
                            @endforeach                         
                                </select>
            </div>

            <div class="col-sm-2 text-right">
                <label>หน่วยงานผู้เบิก :</label>
            </div>
            <div class="col-lg-3">
                 {{$inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME}}
                   
                 <input type="hidden" name="DEP_SUB_SUB_ID" id="DEP_SUB_SUB_ID" value="{{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_ID}}">
                 <input type="hidden" name="DEP_SUB_SUB_NAME" id="DEP_SUB_SUB_NAME" value="{{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}">
                 
                <div style="color: red; font-size: 16px;" id="record_location_id"></div>
            </div>
            <div class="col-sm-1">
                <label>เบอร์โทร :</label>
            </div>
            <div class="col-lg-2">
                <input name="DEP_SUB_SUB_PHONE" id="DEP_SUB_SUB_PHONE" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)" maxlength="10" value="{{$inforequest->DEP_SUB_SUB_PHONE}}" required>
            </div>
        </div>
       <div class="row push">
        <div class="col-sm-2">
                <label>ผู้รายงาน :</label>
            </div>
            <div class="col-lg-4">
            <input type="hidden" name="SAVE_HR_ID" id="SAVE_HR_ID" value="{{$inforpersonuserid->ID}}">
            {{$inforpersonuser -> HR_FNAME}} {{$inforpersonuser -> HR_LNAME}}



            </div>
            <div class="col-sm-2">
                    <label>ผู้เห็นชอบ :</label>
                </div>
                <div class="col-lg-4">
                    <select name="AGREE_HR_ID" id="AGREE_HR_ID" class="form-control input-sm js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" >--กรุณาเลือกผู้เห็นชอบ--</option>
                            @foreach ($pessonalls as $pessonall)
                            @if($inforequest->AGREE_HR_ID == $pessonall->ID)
                                    <option value="{{ $pessonall -> ID }}" selected> {{ $pessonall -> HR_FNAME }}  {{ $pessonall -> HR_LNAME }}</option>
                                    @else
                                    <option value="{{ $pessonall -> ID }}"> {{ $pessonall -> HR_FNAME }}  {{ $pessonall -> HR_LNAME }}</option>
                                    @endif
                            @endforeach 
                    </select>
                <div style="color: red; font-size: 16px;" id="record_location_id"></div>
                </div>
            </div>

       <div class="row push">

       <div class="col-sm-2">
        <label>เหตุผล :</label>
        </div>
        <div class="col-sm-10">
        <input name="REQUEST_BUY_COMMENT" id="REQUEST_BUY_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforequest->REQUEST_BUY_COMMENT}}" maxlength="70"  required>
        </div>
       </div>


       <div class="row push">
       <div class="col-sm-2">
        <label>บริษัทแนะนำ :</label>
        </div> 
        <div class="col-sm-10">

        <select name="REQUEST_VANDOR_ID" id="REQUEST_VANDOR_ID" class="form-control input-sm js-example-basic-single" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="" selected>--กรุณาเลือกบริษัท--</option>
                                           @foreach ($suppliesvendors as $suppliesvendor)
                                            @if($suppliesvendor -> VENDOR_ID == $inforequest->REQUEST_VANDOR_ID)
                                            <option value="{{ $suppliesvendor -> VENDOR_ID }}" selected> {{ $suppliesvendor -> VENDOR_NAME }}</option>           
                                            @else                    
                                            <option value="{{ $suppliesvendor -> VENDOR_ID }}"> {{ $suppliesvendor -> VENDOR_NAME }}</option>           
                                            @endif
                                            @endforeach  
                    </select> 
        </div> 
       </div>

       <div class="row push">
       <div class="col-sm-2">
        <label>หมายเหตุ :</label>
        </div> 
        <div class="col-sm-10">
        <textarea  name="REQUEST_REMARK" id="REQUEST_REMARK" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" required>{{$inforequest->REQUEST_REMARK}}</textarea >

        </div> 
       </div>

       <div class="col-sm-12 row"  align="right">
       <div class="col-sm-7"></div> <div class="col-sm-1"><label>รวมมูลค่า </div><div class="col-sm-3"><input class="form-control input-sm " style="text-align: center;background-color:#E0FFFF ;font-size: 13px;" type="text" name="total" id="total" readonly></div><div class="col-sm-1"><label>  บาท</label></div>
         </div><br>
         <table class="table-bordered table-striped table-vcenter" style="width: 100%;">
            <thead style="background-color: #FFEBCD;">
            <tr height="40">
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">ลำดับ</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;">รายละเอียด</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">เลือก</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">จำนวน</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">หน่วย</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="20%">ราคาต่อหน่วย</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="20%">จำนวนเงิน</td>
                    <td style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="12%">
                        <a  class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">
           
          
              <?php $count=0; $number=1; ?>

              
             @foreach ($inforequestsubs as $inforequestsub)    
         
             <tr height="20">
                    <td style="text-align: center;border: 1px solid black;">
                    {{$number}}
                    </td>    
                 
                    <td class="infoselectsupreq{{$count}}" style="border: 1px solid black;padding-left:10px;">
                      
                    {{$inforequestsub->SUPPLIES_REQUEST_SUB_DETAIL}}
                    <input type="hidden" name="SUPPLIES_REQUEST_SUBRE_ID[]" id="SUPPLIES_REQUEST_SUBRE_ID{{$count}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforequestsub->SUPPLIES_REQUEST_SUBRE_ID}}" >
                    
                    </td>
                    <td style="text-align: left;border: 1px solid black;" class="text-pedding">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".addsup" style="font-family: \'Kanit\', sans-serif; font-size: 10px;font-weight:normal;"   onclick="supselect({{$count}});">เลือก</button>
                                        </td>
                    <td style="text-align: left;border: 1px solid black;">
                        <input  name="SUPPLIES_REQUEST_SUB_AMOUNT[]"  id="SUPPLIES_REQUEST_SUB_AMOUNT{{$count}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforequestsub->SUPPLIES_REQUEST_SUB_AMOUNT}}" onkeyup="checksummoney({{$count}})" OnKeyPress="return chkNumber(this)">
                    </td>
                    <td style="text-align: left;border: 1px solid black;" class="text-pedding infounitname{{$count}}" >
                    <input name="SUPPLIES_REQUEST_SUB_UNIT[]" id="SUPPLIES_REQUEST_SUB_UNIT{{$count}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforequestsub->SUPPLIES_REQUEST_SUB_UNIT}}">                   
                    </td>
                 
                    <td style="text-align: left;border: 1px solid black;">
                        <input name="SUPPLIES_REQUEST_SUB_PRICE[]" id="SUPPLIES_REQUEST_SUB_PRICE{{$count}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforequestsub->SUPPLIES_REQUEST_SUB_PRICE}}" onkeyup="checksummoney({{$count}})" OnKeyPress="return chkNumber(this)">
                    </td>
                    <td style="text-align: left;border: 1px solid black;">
                    <div class="summoney{{$count}}" ></div>  
                    </td>
                    <td style="text-align: center;border: 1px solid black;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
                </tr>

           <?php $count++; $number++;?>
             @endforeach 
            
            </tbody>
        </table>
              <br>
        <div class="modal-footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                    <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}" class="btn btn-hero-sm btn-hero-danger btn-lg" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
            </div>
        </div>
    </form>

  
   
       
    
<!--    เมนูเลือก   -->
       
<div class="modal fade addsup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modeladdsup">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">รายการที่ต้องการซื้อ</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                
                        <div id="supselectdetail"></div>

                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
            </div>
          </div>
        </div>


@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>

<script>


            $(document).ready(function() {
                $('.js-example-basic-single').select2();
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

    
    function run01(){
    var count = $('.tbody1').children('tr').length;
    

    var number;
        for (number = 0; number < count; number++) { 
          
           
        checksummoney(number);
          
        }
    }  


$('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
        var tr =   '<tr>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;">'+
                (count+1)+
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: left; padding-left:10px;font-family: \'Kanit\', sans-serif;border: 1px solid black;" class="infoselectsupreq'+count+'" >'+
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;" class="text-pedding">'+
                '<button type="button" class="btn btn-info" data-toggle="modal" data-target=".addsup" style="font-family: \'Kanit\', sans-serif; font-size: 10px;font-weight:normal;"   onclick="supselect('+count+');">เลือก</button>'+
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;">'+
                '<input name="SUPPLIES_REQUEST_SUB_AMOUNT[]" id="SUPPLIES_REQUEST_SUB_AMOUNT'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+count+');" OnKeyPress="return chkNumber(this)">'+
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;" class="text-pedding infounitname'+count+'" >'+                
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;">'+
                '<input name="SUPPLIES_REQUEST_SUB_PRICE[]" id="SUPPLIES_REQUEST_SUB_PRICE'+count+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" onkeyup="checksummoney('+count+');" OnKeyPress="return chkNumber(this)">'+
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;">'+
                '<div class="summoney'+count+'"></div>'+
                '</td>'+
                '<td style="border-color:#F0FFFF;text-align: center;font-family: \'Kanit\', sans-serif;border: 1px solid black;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
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
       
             
             }  

                          if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('suplies.selectsup')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.infosup').html(result);
                        
                     }
                     
             })


             
            
             }
            
     });

 function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
//-----------------------------------------------------






  function findTotal(){
    var arr = document.getElementsByName('sum');
    var tot=0;

    count = $('.tbody1').children('tr').length;
    for(var i=0;i<count;i++){
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value =tot.toFixed(5);
}


//------------------------------------------function-----------------

function supselect(count){
  
  var idinven = document.getElementById("REQUEST_FOR_ID").value;

$.ajax({
           url:"{{route('suplies.supselect')}}",
          method:"GET",
           data:{idinven:idinven,count:count},
           success:function(result){
               $('#supselectdetail').html(result);
           }

   })
   

}
  


function selectsupreq(idinven,count){

var _token=$('input[name="_token"]').val();



$.ajax({
               url:"{{route('suplies.supre')}}",
               method:"GET",
               data:{idinven:idinven,_token:_token},
               success:function(result){
                $('.infoselectsupreq'+count).html(result);
               }
       })



       $.ajax({
                   url:"{{route('suplies.supunitname')}}",
                   method:"GET",
                   data:{idinven:idinven,_token:_token},
                   success:function(result){
                    $('.infounitname'+count).html(result);
                   }
           })

        
    
     
       $('#modeladdsup').modal('hide');

}


function checksummoney(number){
   
   var PRICE_PER_UNIT=document.getElementById("SUPPLIES_REQUEST_SUB_PRICE"+number).value;
   var SUP_TOTAL=document.getElementById("SUPPLIES_REQUEST_SUB_AMOUNT"+number).value;

     
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