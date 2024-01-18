@extends('layouts.risk')   
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
        font-size: 13px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
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
      
      
      .form-control{
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
<br>

<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">รายละเอียดแบบประเมินการควบคุมภายในด้วยตนเอง (Control self Assessment : CSA)</h2> 
               
                <div align="right">
                    <a href="{{ route('mrisk.internalcontrol')}}"  class="btn btn-sm btn-success btn-lg" >&nbsp;ย้อนกลับ&nbsp;</a>
                    </div>
                </div> 
            <div class="block-content block-content-full" align="left">


          <input type="hidden" value="{{$internalcontrols->INTERNALCONTROL_ID}}" name="INTERNALCONTROL_ID" id="INTERNALCONTROL_ID" class="form-control input-sm" > 
   <div class="row push">
<div class="col-sm-2">
<label style="font-family:'Kanit',sans-serif;font-size:13px;">กลุ่ม/ฝ่าย/งาน :</label>
</div> 
<div class="col-lg-4 " style="font-family:'Kanit',sans-serif;font-size:13px;"> 
{{$internalcontrols->HR_DEPARTMENT_SUB_NAME}}

</div> 
<div class="col-sm-1">
<label style="font-family:'Kanit',sans-serif;font-size:13px;">หัวหน้าฝ่ายงาน:</label>
</div> 
<div class="col-lg-2 " style="font-family:'Kanit',sans-serif;font-size:13px;"> 
{{$internalcontrols->HR_FNAME}} &nbsp;  {{$internalcontrols->HR_LNAME}}          

</div> 
<div class="col-sm-1">
<label style=" font-family:'Kanit', sans-serif;font-size: 13px;">วันที่ :</label>
</div> 
<div class="col-lg-2 " style="font-family:'Kanit',sans-serif;font-size:13px;">
{{DateThai($internalcontrols->INTERNALCONTROL_DATE)}}

</div> 
</div> 

<div class="row push">
<div class="col-sm-2">
<label style="font-family:'Kanit',sans-serif;font-size:13px;">ระยะเวลา :</label>
</div> 
<div class="col-lg-10 " style="font-family:'Kanit',sans-serif;font-size:13px;">

{{$internalcontrols->INTERNALCONTROL_TIME}}


</div> 


</div>

<div class="row push">
<div class="col-sm-2 text-right">
<label>1 :</label>
</div> 
<div class="col-lg-10 ">
<div align="left" style="font-family:'Kanit',sans-serif;font-size:13px;">
ให้วิเคราะและเลือกภารกิจงาน/กิจกรรมที่มีความเสี่ยงสูงมา ๑ เรื่องพร้อมระบุวัตถุประสงค์ของภารกิจงาน/กิจกรรมนั้น
</div>
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label></label>
</div> 

<div align="left" class="col-sm-1 " style="font-family:'Kanit',sans-serif;font-size:13px;">ภารกิจ :</div>

<div class="col-lg-9 " style="font-family:'Kanit',sans-serif;font-size:13px;">
{{$internalcontrols->INTERNALCONTROL_MISSION}} 

</div> 
</div>

<div class="row push">
<div class="col-md-2 ">
</div>

<div class="col-md-9  ">

<div align="left" style="font-family:'Kanit',sans-serif;font-size:13px;">วัตถุประสงค์ :</div>
<br>
    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
        <thead style="background-color: #FFEBCD;">
            <tr height="40">
                <td style="text-align: center;font-size: 13px;" width="5%">ลำดับ</td>
                <td style="text-align: center;font-size: 13px;">รายละเอียด</td>
        
               
            </tr>
        </thead>
        <tbody class="tbody1">
       
            <tr height="20"> 
                <?php $number = 0; ?>
                    @foreach($internalcontrol_subs as $internalcontrol_sub)
                        <?php $number++; ?>
                <td height="30" style="text-align: center;font-size: 13px;"> {{$number}} </td>     
                <td height="30" style="text-align: left;font-size: 13px;">&nbsp; {{$internalcontrol_sub->INTERNALCONTROL_OBJECTIVE}}</td>
                   
            </tr>
            @endforeach
        </tbody>
    </table>
</div> 
</div>

<div class="row push">
<div class="col-sm-2 text-right">
<label>2 :</label>
</div> 
<div class="col-lg-10 ">
<div align="left" style="font-family:'Kanit',sans-serif;font-size:13px;">
ภารกิจงาน/กิจกรรมนั้น มีขั้นตอนหรือกระบวนการปฎิบัติอะไรบ้าง หรือทำอย่างไรที่จะทำไห้บรรลุตามวัตถุประสงค์
</div>
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<label></label>
</div> 
<div class="col-lg-9 ">
<table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                                <td style="text-align: center;font-size:13px;" width="5%">ลำดับ</td>
                                <td style="text-align: center;font-size:13px;">รายละเอียด</td>
                        
                               
                            </tr>
                        </thead>
                        <tbody class="tbody2">
                            <tr height="20"> 
                            <?php $number = 0; ?>
                            @foreach($internalcontrol_subsubs as $internalcontrol_subsub)
                        <?php $number++; ?>
                           
                            <td height="30" style="text-align: center;font-size: 13px;"> {{$number}} </td> 
                                <td height="30" style="text-align: left;font-size: 13px;">&nbsp;{{$internalcontrol_subsub->INTERNALCONTROL_SUBSUB_NAME}}</td>
                                
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div> 
</div>
</div>

<div class="modal-footer">

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
 <!-- Page toastr Alert -->
<script src="{{ asset('js/toastr.min.js') }}"></script>

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
    $('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var tr =    '<tr>'+
    '<td style="text-align: center;">'+
                (count+1)+
                '</td>'+
                '<td>'+
                '<input name="INTERNALCONTROL_OBJECTIVE[]" id="INTERNALCONTROL_OBJECTIVE[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
               
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});

$('.addRow2').on('click',function(){
        addRow2();
    });

    function addRow2(){
    var count = $('.tbody2').children('tr').length;
        var tr =   '<tr>'+  
        '<td style="text-align: center;">'+
                (count+1)+
                '</td>'+             
                '<td>'+
                '<input name="INTERNALCONTROL_SUBSUB_NAME[]" id="INTERNALCONTROL_SUBSUB_NAME[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                '</td>'+
               
                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                '</tr>';
    $('.tbody2').append(tr);
    };

    $('.tbody2').on('click','.remove', function(){
        $(this).parent().parent().remove();
});
  
   

</script>

@endsection