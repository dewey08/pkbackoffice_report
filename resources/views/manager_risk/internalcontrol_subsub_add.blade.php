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
    font-size: 14px;
                  }   
      
      
      .form-control{
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
<!-- Advanced Tables -->
<br>
<br>
<br>

<center>
<div class="block" style="width: 95%;" >
<div class="block block-rounded block-bordered">

            
<div class="block-content"> 
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-5" align="left">
          ประเมินการควบคุมภายในด้วยตัวเอง
            </div>
          <div class="col-md-7" align="right">
                <a href="{{url('manager_risk/internalcontrol_subsub_detailadd/'.$internalcontrol->INTERNALCONTROL_ID)}}" class="btn btn-hero-sm btn-hero-info" >วิเคราะห์กระบวนการ</a>
                <a href="{{url('manager_risk/internalcontrol_subsub_detailadd_make/'.$internalcontrol->INTERNALCONTROL_ID)}}" class="btn btn-hero-sm btn-hero-primary" >ประเมินกิจกรรม</a>
                <a href="{{url('manager_risk/internalcontrol_subsub_detailadd_risk/'.$internalcontrol->INTERNALCONTROL_ID)}}" class="btn btn-hero-sm btn-hero-warning" >ความเสี่ยงที่พบ</a>
                <!-- <a href="{{url('manager_risk/internalcontrol_subsub_detailadd_risk/'.$internalcontrol->INTERNALCONTROL_ID)}}" class="btn btn-secondary btn-lg" >ประเมินผลควบคุมภายใน</a> -->
                <a href="{{ url('manager_risk/internalcontrol')  }}"  class="btn btn-hero-sm btn-hero-success"  >&nbsp;ย้อนกลับ&nbsp;</a>

             
          </div>
          </div>
          </h2>     
  
<div class="block-content block-content-full" align="left">
<form  method="post" action="{{ route('mrisk.internalcontrol_update') }}" enctype="multipart/form-data">
@csrf

          <input type="hidden" value="{{$internalcontrol->INTERNALCONTROL_ID}}" name="INTERNALCONTROL_ID" id="INTERNALCONTROL_ID" class="form-control input-sm" > 

         


<div class="row push">

<div class="col-sm-2 text-right" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
กลุ่ม/ฝ่าย/งาน :
</div> 
<div class="col-lg-4 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">  
    @foreach($departmentsubs as $departmentsub)
        @if($departmentsub->HR_DEPARTMENT_SUB_ID == $internalcontrol->INTERNALCONTROL_GROUP_NAME)
            {{ $departmentsub-> HR_DEPARTMENT_SUB_NAME}}
        @else           
        @endif
    @endforeach

</div> 
<div class="col-sm-1" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
หัวหน้าฝ่ายงาน:
</div> 
<div class="col-lg-2 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">  
    @foreach($infodepartmentsubs as $infodepartmentsub)
    @if($infodepartmentsub->LEADER_HR_ID == $internalcontrol->INTERNALCONTROL_HEAD_WORK)
        {{ $infodepartmentsub-> HR_FNAME}}  {{ $infodepartmentsub-> HR_LNAME}}
        @else      
        @endif
    @endforeach

</div> 
<div class="col-sm-1 text-right" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
วันที่ :
</div> 
<div class="col-lg-2 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
{{DateThai($internalcontrol->INTERNALCONTROL_DATE)}}
</div> 
</div> 

<div class="row push">
                    <div class="col-sm-2 text-right" style=" font-family:'Kanit', sans-serif;font-size: 14px;font-weight:normal;" >
                             ระยะเวลา :
                        </div>&nbsp;&nbsp;&nbsp;
                     
                        <div class="col-sm-0.5 text-right" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
                        วันที่:
                        </div>
                    <div class="col-md-1 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
             
                   {{DateThai($internalcontrol->INTERNALCONTROL_START_DAY) }}
                    
                    </div>
                    <div class="col-sm-0.5 text-right" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
                        ถึง:
                        </div>
                    <div class="col-md-1 " style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
           
                   {{DateThai($internalcontrol->INTERNALCONTROL_END_DAY) }}
                  
                    </div>
                   

                    <div class="col-sm">
                       
                        </div>


                </div>
         

<div class="row push">
<div class="col-sm-2 text-right">
<label>1 :</label>
</div> 
<div class="col-lg-10 ">
<div align="left" style=" font-family:'Kanit', sans-serif;font-size: 14px;font-weight:normal;">
ให้วิเคราะและเลือกภารกิจงาน/กิจกรรมที่มีความเสี่ยงสูงมา ๑ เรื่องพร้อมระบุวัตถุประสงค์ของภารกิจงาน/กิจกรรมนั้น
</div>
</div> 
</div>

<div class="row push">
<div class="col-sm-2">
<!-- <label>ภารกิจ :</label> -->
</div> 

<div class="col-lg-1 text-right" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
ภารกิจ :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</div> 
<div class="col-lg-9 text-left" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">
{{$internalcontrol->INTERNALCONTROL_MISSION}}
</div> 
</div>

<div class="row push">
<div class="col-md-2 ">


</div>

<div class="col-md-9  ">

<div align="left" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;">วัตถุประสงค์ :</div>
<br>
    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
        <thead style="background-color: #FFEBCD;">
            <tr height="40">
                <td style="text-align: center;font-size: 14px;font-weight:normal;" width="5%">ลำดับ</td>
                <td style="text-align: center;font-size: 14px;font-weight:normal;">รายละเอียด</td>
        
            </tr>
        </thead>
        <tbody class="tbody1">
       
            <tr height="30"> 
            <?php $number = 0; ?>
            @foreach($internalcontrol_subs as $internalcontrol_sub)
            <?php $number++; ?>
                <td height="30" style="text-align: center;font-size: 14x;font-weight:normal;"> {{ $number}} </td>     
                <td height="30" style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;{{$internalcontrol_sub->INTERNALCONTROL_OBJECTIVE}}</td>
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
<div class="col-lg-9 ">
<div align="left" style=" font-family:'Kanit', sans-serif;font-size: 14px;font-weight:normal;">
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
                                <td height="30" style="text-align: center;font-size: 14px;font-weight:normal;" width="5%">ลำดับ</td>
                                <td style="text-align: center;font-size: 14px;font-weight:normal;">รายละเอียด</td>
                               
                                
                            </tr>
                        </thead>
                        <tbody class="tbody2">
                            <tr height="20"> 
                            <?php $number = 0; ?>
                            @foreach($internalcontrol_subsubs as $internalcontrol_subsub)
                            <?php $number++; ?>
                            <td height="30" style="text-align: center;font-size: 14px;font-weight:normal;"> {{ $number}} </td> 
                            <td style="text-align: left;font-size: 14px;font-weight:normal;">&nbsp;{{$internalcontrol_subsub->INTERNALCONTROL_SUBSUB_NAME}}</td>                               
                                <!-- <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                        <div class="dropdown-menu" style="width:10px">
                                            <a class="dropdown-item" href="{{url('manager_risk/internalcontrol_subsub_detailadd/'.$internalcontrol_subsub->INTERNALCONTROL_ID.'/'.$internalcontrol_subsub->INTERNALCONTROL_SUBSUB_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">วิเคราะห์การปฏิบัติจริง</a>
                                            <a class="dropdown-item" href="{{url('manager_risk/internalcontrol_subsub_detailadd_make/'.$internalcontrol_subsub->INTERNALCONTROL_ID.'/'.$internalcontrol_subsub->INTERNALCONTROL_SUBSUB_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ประเมินกิจกรรม</a>
                                            <a class="dropdown-item" href="{{url('manager_risk/internalcontrol_subsub_detailadd_risk/'.$internalcontrol_subsub->INTERNALCONTROL_ID.'/'.$internalcontrol_subsub->INTERNALCONTROL_SUBSUB_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">วิเคราะห์ความเสี่ยงที่พบ</a>
                                        </div>
                                    </div>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    </div> 
</div>
</div>





<div class="modal-footer">
<!-- <div align="right">

<button type="submit" id="button"  class="btn btn-sm btn-info btn-lg savebtn"  >บันทึกข้อมูล</button>
<a href="{{ url('manager_risk/internalcontrol')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-sm btn-danger btn-lg cancel"  >ยกเลิก</a>
</div> -->

</div>
</form>
<!-- <button  class="btn btn-warning savebtn" >Add Alert</button> -->
    
  
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
  <!-- Page ckeditor -->
 <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
 <script src="{{ asset('js/sweetalert.js') }}" rel="stylesheet"> </script>
 <scrip>
    @if (session('status')) 
        alert('{{ session('status') }}')         
    @endif
</scrip>

 <script>                                  
        CKEDITOR.replace( 'myeditor' , {           
        });
</script>
<script>                                  
        CKEDITOR.replace( 'myeditor2' , {           
        });
</script>

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
  
$('.budget').change(function(){
 if($(this).val()!=''){
 var select=$(this).val();
 var _token=$('input[name="_token"]').val();
 $.ajax({
         url:"{{route('admin.selectbudget')}}",
         method:"GET",
         data:{select:select,_token:_token},
         success:function(result){
            $('.date_budget').html(result);
            datepick();
         }
 })
// console.log(select);
 }        
}); 

</script>

@endsection