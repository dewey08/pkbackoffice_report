@extends('layouts.backend')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
      } 

      @media only screen and (min-width: 1200px) {
label {
    float:right;
  }

      }

      .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
                  .form-control {
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


use App\Http\Controllers\MpayController;
$refnumber = MpayController::refnumberpay();



?>
<?php

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
  
?>
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
             <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                                            <div class="row">
                                           <!-- <div>
                                             <a href="{{ url('general_mpay/dashboard_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                            <a href="{{ url('general_mpay/stockcard_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">คลังย่อย

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>-->

                                            <div>
                                             <a href="{{ url('general_mpay/withdraw_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เบิกอุปกรณ์</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                             <a href="{{ url('general_mpay/pay_mpay/'.$inforpersonuserid -> ID) }}" class="btn btn-primary" >จ่ายออก</a>
                                            </div>
                                            <div>&nbsp;</div>

                                    

                            </nav>
        
        </div>
    </div>
    </div>
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>จ่ายออก| หน่วยงาน</B></h3>
            <br>
        </div>
        <br>
        <form  method="post" action="{{ route('gen_mpay.paympay_save') }}" enctype="multipart/form-data">
@csrf

    
        <div class="col-sm-12" style="text-align: left">
        <div class="row">
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            รหัส :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="MPAY_PAY_CODE" id="MPAY_PAY_CODE" value="{{$refnumber}}"  class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label >                           
                            วันที่ :              
        </label>
        </div> 
        <div class="col-lg-2">
        <input name="MPAY_PAY_DATE" id="MPAY_PAY_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate($date)}}" readonly>
        </div> 
        <div class="col-lg-1" style="text-align: left">
        <label>                           
                            เหตุผล:              
        </label>
        </div> 
        <div class="col-lg-4" >
        <input name="MPAY_PAY_COMMENT" id="MPAY_PAY_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        </div>

        <br>


       <div class="row">
       
        <div class="col-lg-1" style="text-align: left">
        <label>ผู้จ่ายวัสดุ :</label>
        </div> 
        <div class="col-lg-2">
      {{$inforpersonuser->HR_FNAME}} {{$inforpersonuser->HR_LNAME}}
        
      <input type="hidden" name="MPAY_PAY_SAVE_HR_ID" id="LAUNDER_PAY_SAVE_HR_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value=" {{$inforpersonuserid->ID}}">
      <input type="hidden"  name="MPAY_PAY_SAVE_HR_NAME" id="LAUNDER_PAY_SAVE_HR_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforpersonuser->HR_FNAME}} {{$inforpersonuser->HR_LNAME}}">
        
        
        </div>
     
        <div class="col-lg-1 " style="text-align: left">
        <label>คลัง :</label>
        </div> 
        <div class="col-lg-2">

        {{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}
        <input type="hidden" name="MPAY_PAY_TREASURT_NAME" id="LAUNDER_PAY_TREASURT_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}">
        <input type="hidden" name="MPAY_PAY_DEP" id="LAUNDER_PAY_DEP" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_ID}}">
        
        </div>

        <div class="col-lg-1 " style="text-align: left">
        <label>ประเภท :</label>
        </div> 
        <div class="col-lg-3">
        <select name="MPAY_PAY_TYPE" id="MPAY_PAY_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
          
                    <option value="1">จ่ายออก</option>
                    <option value="2">ส่งคืน</option>
          
        </select>
        
        </div>
       
       </div>
       <br>
 
  
       <table class="gwt-table table-striped table-vcenter " style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                                     
                                            <tr>
                                            <td style="text-align: center; font-size: 13px;" width="5%">ลำดับ</td>
                                                <td style="text-align: center; font-size: 13px;" >รายการ</td>
                                                <td style="text-align: center; font-size: 13px;" width="20%">จำนวนจ่าย</td>
                                      
                                                <td style="text-align: center; font-size: 13px;" width="5%"><a  class="btn btn-success fa fa-plus addRow" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        

                                      
                                    <tr style="text-align: center; font-size: 13px;">
                                        <td style="text-align: center; font-size: 13px;">
                                             1
                                        </td>

                                        <td >
                                        
                                        <select name="MPAY_PAY_SUB_TYPEID[]" id="MPAY_PAY_SUB_TYPEID" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                                                    @foreach ($mpay_setupassets as $mpay_setupasset)   
                                                       
                                                                            <option value="{{ $mpay_setupasset ->SETUPASSET_PIECES_ID  }}" >{{ $mpay_setupasset ->SETUPASSET_PIECES_NAME  }}</option>                                                                                                                        
         
                                                                    @endforeach  
                                                                   
                                        </select>

                                       </td>
                               
                                       <td >
                                       <input style="text-align: center; " name="MPAY_PAY_SUB_AMOUNT[]" id="MPAY_PAY_SUB_AMOUNT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  >
                                       </td>

                                       <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                   </tr>
                             
                                    </tbody>   
                                    </table>




        <div class="modal-footer">
        <div align="right">
        <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-info" value="approved" >บันทึก</button>
        <a href="{{ url('general_mpay/pay_mpay/'.$inforpersonuserid->ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการจ่ายผ้า ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
    
<!--    เมนูเลือก   -->
       
<div class="modal fade addsup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modeladdsup">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เลือกพัสดุที่ต้องการจ่าย</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                
                        <div id="detailsup"></div>

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

function datepicker(number){
        
        $('.datepicker'+number).datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
   }


$('.addRow').on('click',function(){
        addRow();
        var count = $('.tbody1').children('tr').length;
        var number =  (count).valueOf();
        datepicker(number);
    });

   


    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();

    
        var tr =   '<tr style="text-align: center; font-size: 13px;">'+
                '<td style="text-align: center;">'+
                +number+
                '</td>'+
                '<td >'+                             
                '<select name="MPAY_PAY_SUB_TYPEID[]" id="MPAY_PAY_SUB_TYPEID" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                '<option value="" >--กรุณาเลือก--</option>'+
                '@foreach ($mpay_setupassets as $mpay_setupasset)'+                                                  
                '<option value="{{ $mpay_setupasset ->SETUPASSET_PIECES_ID  }}" >{{ $mpay_setupasset ->SETUPASSET_PIECES_NAME  }}</option>'+                                                                                                                         
                '@endforeach'+   
                '</select>'+
                '</td>'+
                '<td >'+
                '<input style="text-align: center; " name="MPAY_PAY_SUB_AMOUNT[]" id="MPAY_PAY_SUB_AMOUNT" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"  >'+
                '</td>'+
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
                                  
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});




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




function detail(id){


$.ajax({
           url:"{{route('warehouse.detailappall')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);


              //alert("Hello! I am an alert box!!");
           }

   })

}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });

 //------------------------------------------function-----------------

 function detailsup(iddep,count){


$.ajax({
           url:"{{route('warehouse.detailsup')}}",
          method:"GET",
           data:{iddep:iddep,count:count},
           success:function(result){
               $('#detailsup').html(result);
           }

   })
   

}





function selectsup(idsup,count){

var _token=$('input[name="_token"]').val();



$.ajax({
               url:"{{route('warehouse.selectsup')}}",
               method:"GET",
               data:{idsup:idsup,_token:_token},
               success:function(result){
                $('.infosupselect'+count).html(result);
               }
       })



       $.ajax({
                   url:"{{route('warehouse.selectsuplot')}}",
                   method:"GET",
                   data:{idsup:idsup,_token:_token},
                   success:function(result){
                    $('.infosupselectlot'+count).html(result);
                   }
           })

           $.ajax({
                   url:"{{route('warehouse.selectsuptotal')}}",
                   method:"GET",
                   data:{idsup:idsup,count:count,_token:_token},
                   success:function(result){
                    $('.infosupselecttotal'+count).html(result);
                   }
           })

           $.ajax({
                   url:"{{route('warehouse.selectsupunit')}}",
                   method:"GET",
                   data:{idsup:idsup,_token:_token},
                   success:function(result){
                    $('.infosupselectunit'+count).html(result);
                   }
           })


           $.ajax({
                   url:"{{route('warehouse.selectsuppiceunit')}}",
                   method:"GET",
                   data:{idsup:idsup,count:count,_token:_token},
                   success:function(result){
                    $('.infosupselectpiceunit'+count).html(result);
                   }
           })

           $.ajax({
                   url:"{{route('warehouse.selectsupdatget')}}",
                   method:"GET",
                   data:{idsup:idsup,_token:_token},
                   success:function(result){
                    $('.infosupselectdatget'+count).html(result);
                   }
           })


           $.ajax({
                   url:"{{route('warehouse.selectsupdatexp')}}",
                   method:"GET",
                   data:{idsup:idsup,_token:_token},
                   success:function(result){
                    $('.infosupselectdatexp'+count).html(result);
                   }
           })

    
     
       $('#modeladdsup').modal('hide');

}



//-----------------------------------------------------



function checksummoney(number){
      
    
      var SUP_TOTAL=document.getElementById("RECEIVE_SUB_AMOUNT"+number).value;
      var PRICE_PER_UNIT=document.getElementById("RECEIVE_SUB_PICE_UNIT"+number).value;
      
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


  function checktotal(number){
      
    
      var SUP_TOTAL= Number(document.getElementById("RECEIVE_SUB_AMOUNT"+number).value);
      var TREASURY_EXPORT_SUB_VALUE= Number(document.getElementById("TREASURY_EXPORT_SUB_VALUE"+number).value);
      
      if(TREASURY_EXPORT_SUB_VALUE < SUP_TOTAL){
        alert("ของในคลังมีไม่เพียงพอในการจ่าย !!");
        document.getElementById('RECEIVE_SUB_AMOUNT'+number).value = TREASURY_EXPORT_SUB_VALUE;
      }
     

     
           
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
  


</script>



@endsection