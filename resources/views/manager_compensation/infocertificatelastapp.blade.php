@extends('layouts.compensation')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
    padding-right:10px;
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

?>
        
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติข้อมูลการขอใบรับรองเงินเดือนเลขที่ {{$inforSalarycertificate -> CER_NUMBER}} </B></h3>
             

             
            </div>
            <div class="block-content block-content-full">



         

<form  method="post" action="{{ route('mcompensation.updatecertificatelastapp') }}" enctype="multipart/form-data"> 
                        @csrf
    <input type="hidden"  name="ID" value="{{ $inforSalarycertificate -> CER_ID }}"/>

    <div class="row">         
<div class="col-sm-2">
        <label>เลขทะเบียน :</label>
    </div> 
    <div class="col-lg-2"> 
    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_NUMBER }}</h1>       
     </div>
    <div class="col-sm-2 text-right">
        <label>ลงวันที่ต้องการ :</label>
    </div> 
    <div class="col-lg-2"> 
    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforSalarycertificate -> CER_DATE) }}</h1>      
        </div>
    <div class="col-sm-2 text-right">
        <label>ปีงบประมาณ :</label>
    </div>         
    <div class="col-lg-2"> 
    <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_YEAR }}</h1>        
    
    </div>
</div>


<div class="row ">
<div class="col-sm-2">
    <label>ผู้ร้องขอ :</label>
</div> 
<div class="col-sm-2">

   <h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_MY_HR_PERSON_NAME }}</h1>  
</div> 
<div class="col-sm-2 text-right">
    <label>ตำแหน่ง :</label>
</div> 
<div class="col-sm-2">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_POSITION_IN_WORK }}</h1>  
</div> 
<div class="col-sm-2">
</div> 
</div>

<div class="row ">
<div class="col-sm-2">
    <label>ระดับ :</label>
</div> 
<div class="col-sm-2">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_LEVEL_NAME }}</h1>  
    </div> 
<div class="col-sm-2 text-right">
    <label>รับเงินเดือน :</label>
</div> 
<div class="col-sm-2">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_SALARY }}</h1>  
</div> 
<div class="col-sm-2 text-right">
    <label>เงินประจำตำแหน่ง :</label>
</div> 
<div class="col-sm-2">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_MONEY_POSITION }}</h1>  
    
     </div> 
</div>


<div class="row ">
<div class="col-sm-2">
    <label>รับราชการเมื่อ :</label>
</div> 
<div class="col-sm-2">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ DateThai($inforSalarycertificate -> CER_HR_STARTWORK_DATE) }}</h1>
 
</div> 
<div class="col-sm-2 text-right">
    <label>วัตถุประสงค์เพื่อ :</label>
</div> 
<div class="col-sm-6">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_BORROW_MONEY }}</h1>
 
</div> 
</div>




<div class="row ">
<div class="col-sm-2">
    <label>ผู้รายงาน :</label>
</div> 
<div class="col-lg-2">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_PERSON_NAME }}</h1>

</div>
<div class="col-sm-2 text-right">
    <label>หน่วยงานผู้เบิก :</label>
</div>
<div class="col-lg-3">       
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;">{{ $inforSalarycertificate -> CER_HR_DEP_SUB_SUB_NAME }}</h1>
</div>       

</div>

<div class="row ">
<div class="col-sm-2">
    <label>เหตุผล :</label>
</div> 
<div class="col-sm-10">
<h1 style="text-align: left;font-family: 'Kanit', sans-serif; font-size:10px;font-size: 1.0rem;font-weight:normal;color:#778899;"> {{ $inforSalarycertificate -> CER_COMMENT }}</h1>
   
</div> 
</div>
<br> 


<table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">รายการรับ</td>
                                                <td style="text-align: center;" width="30%">จำนวนเงิน</td>

                                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                        <?php $checkper = 0; ?>
                                    @foreach ($inforeceivepersons as $inforeceiveperson)  
                                    <tr>
                                        <td> 
                                        <select name="RECEIV_ID[]" id="RECEIV_ID{{$checkper}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="">--กรุณาเลือกรายการรับ-</option>
                                                            @foreach ($inforeceives as $inforeceive) 
                                                            @if($inforeceive ->ID == $inforeceiveperson ->SALARY_RECEIVE_ID)                                                    
                                                                <option value="{{ $inforeceive ->ID  }}" selected>{{ $inforeceive->HR_RECEIVE_NAME}}</option>
                                                            @else
                                                                <option value="{{ $inforeceive ->ID  }}">{{ $inforeceive->HR_RECEIVE_NAME}}</option>
                                                            @endif
                                                            @endforeach 
                                         </select>    
                                        </td>

                                        <td>
                                        <input name="AMOUNT_PICE[]" id="AMOUNT_PICE[]" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"   value="{{ $inforeceiveperson -> AMOUNT }}"/>

                                        </td>

                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>
                                    <?php $checkper++; ?>
                                    @endforeach 

                                    </tbody>   
                                    </table>



<div align="right">
<button type="submit" name = "SUBMIT"  style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-success btn-lg" value="approved" >อนุมัติ</button>
<button type="submit"  name = "SUBMIT" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-danger btn-lg" value="not_approved" >ไม่อนุมัติ</button>
<a href="{{ url('manager_compensation/infocertificate') }}" type="button" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-secondary btn-lg"  >ปิดหน้าต่าง</a>

</div>

</form>


   
</div>
  
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
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

$(document).ready(function() {

$('select').select2();

});

$('.addRow').on('click',function(){
         addRow();
         $('select').select2();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr ='<tr>'+
         '<td>'+ 
         '<select name="RECEIV_ID[]" id="RECEIV_ID'+count+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
         '<option value="">--กรุณาเลือกรายการรับ-</option>'+
         '@foreach ($inforeceives as $inforeceive)'+                                                    
         '<option value="{{ $inforeceive ->ID  }}">{{ $inforeceive->HR_RECEIVE_NAME}}</option>'+
         '@endforeach '+
         '</select>'+    
         '</td>'+
         '<td>'+
         '<input name="AMOUNT_PICE[]" id="AMOUNT_PICE[]" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;"   value=""/>'+
         '</td>'+     
            '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
            '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection