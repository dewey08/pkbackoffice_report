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
<div class="block" style="width: 95%;" >
<div class="block block-rounded block-bordered">

            
<div class="block-content">    

<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-9" align="right">
          แก้ไขรายงานการประเมินผลการควบคุมภายใน &nbsp;&nbsp; ({{ $icontrols-> HR_DEPARTMENT_SUB_NAME}})
            </div>
          <div class="col-md-3" align="right">
         <!-- <small> แบบ ปค.5 หน่วยงานย่อย </small> -->
         <a href="{{ url('manager_risk/excel_risk_depart/'.$icontrol_pk5s->PK5_DEPART_ID)}}" class="btn btn-success btn-lg" ><i class="fas fa-file-excel text-white" style="font-size:20px;"></i>&nbsp;&nbsp;Export Excel</a> 
  
          </div>
          </div>
          </h2>  


<div class="block-content block-content-full" align="left">

<form  method="post" action="{{ route('mrisk.internalcontrol_pk5_depart_update') }}" enctype="multipart/form-data">
@csrf
            <input type="hidden" id="INTERNALCONTROL_ID" name="INTERNALCONTROL_ID" value="{{$icontrols->INTERNALCONTROL_ID}}">    
            <input type="hidden" id="PK5_DEPART_DEPART" name="PK5_DEPART_DEPART" value=" {{ $icontrols-> INTERNALCONTROL_GROUP_NAME}}">   
            <input type="hidden" id="PK5_DEPART_ID" name="PK5_DEPART_ID" value="{{$icontrol_pk5s->PK5_DEPART_ID}}">   
<div class="row push">
<div class="col-sm-1">
<label for="BUDGET_YEAR" style="font-family:'Kanit',sans-serif;font-size:13px;">ระยะเวลา :</label>

</div> 
<div class="col-sm-1.5">
                    <span>
                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style="font-family:'Kanit',sans-serif;font-size:13px;">
                            @foreach ($budgets as $budget)
                            @if($budget->LEAVE_YEAR_ID== $year_id)
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                            @else
                                <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                            @endif                                 
                        @endforeach                         
                            </select>
                        </span>
                    </div>
<div class="col-sm-1">
<label for="DATE_BIGIN" style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่ :</label>

</div> 
<div class="col-lg-2 "> 
<input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($icontrol_pk5s->PK5_DEPART_START_DATE) }}" readonly>
                                 
</div> 
<div class="col-sm-0.5">
<label for="DATE_END" style="font-family:'Kanit',sans-serif;font-size:13px;">ถึง:</label>
</div> 
<div class="col-lg-2"> 
<input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($icontrol_pk5s->PK5_DEPART_LAST_DATE) }}" readonly>
</div> 
<div class="col-sm-0.5">
<label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่บันทึก :</label>
</div> 
<div class="col-lg-2 ">
<input type="text" name="PK5_DEPART_DATE" id="PK5_DEPART_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{ formate($icontrol_pk5s->PK5_DEPART_DATE) }}"  readonly>
</div> 

<div class="col-sm-1.5" style="font-family:'Kanit',sans-serif;font-size:13px;">
หัวหน้าฝ่ายงาน :
</div> 
<div class="col-lg-1 " style="font-family:'Kanit',sans-serif;font-size:13px;">  
 
            {{ $icontrol_pk5s-> HR_FNAME}}  {{ $icontrol_pk5s-> HR_LNAME}}
            <input type="hidden" name="PK5_DEPART_HEAD" id="PK5_DEPART_HEAD" class="form-control input-sm " value="{{$icontrol_pk5s->ID}}">
            </div>   

</div> 
<div class="row push">
    <div class="col-lg-12">
        <table class="gwt-table table-vcenter" style="width: 100%;">
                        <thead style="background-color: #9FFFBF;">
                            <tr height="40">
                             
                                <td style="text-align: center;font-size: 13px;" width="20%">ภารกิจหลัก || วัตถุประสงค์</td>
                                <td style="text-align: center;font-size: 13px;" width="20%">ความเสี่ยง </td>
                                <td style="text-align: center;font-size: 13px;" width="20%">การควบคุมภายในที่มีอยู่</td>
                                <td style="text-align: center;font-size: 13px;">การประเมินผลการควบคุมภายใน</td>
                                <td style="text-align: center;font-size: 13px;">ความเสี่ยงที่ยังมีอยู่</td>
                       
                            </tr>
                        </thead>
                        <tbody class="tbody2">
                        <?php $number = 0; ?>
                       
                            <?php $number++; ?>
                            <tr style="background-color: #EDF9F2;"> 
                          
                                <td rowspan="{{$rowlist}}" style="text-align: left;font-size: 13px;vertical-align: top;">                               
                                &nbsp;&nbsp;&nbsp;{{$icontrols->INTERNALCONTROL_MISSION}}<br><br>
                                <?php $count = 1; ?>
                                @foreach ($icontrol_subs as $item)
                                {{$count}}&nbsp;&nbsp;&nbsp;{{$item->INTERNALCONTROL_OBJECTIVE}}<br><br>
                                <?php $count++; ?>
                                    @endforeach                                   
                                </td>
                                
                                @foreach ($icontrol_detailsubsubs as $icontrol_detailsubsub)
                                <tr style="background-color: #EDF9F2;"> 
                                        <input type="hidden" name="PK5_DEPART_SUB_ID[]" id="PK5_DEPART_SUB_ID[]" value="{{$id}}">
                                        <td  style="text-align: left;font-size: 13px;vertical-align: top;">        
                                        &nbsp;&nbsp;{{$icontrol_detailsubsub->PK5_DEPART_SUB_RISK }}
                                        <input type="hidden" name="PK5_DEPART_SUB_RISK[]" id="PK5_DEPART_SUB_RISK[]" value="{{$icontrol_detailsubsub->PK5_DEPART_SUB_RISK }}">
                                        </td>

                                        <td  style="text-align: left;font-size: 13px;vertical-align: top;">  
                                        &nbsp;&nbsp; {{$icontrol_detailsubsub->PK5_DEPART_SUB_CONTROL }}
                                        <input type="hidden" name="PK5_DEPART_SUB_CONTROL[]" id="PK5_DEPART_SUB_CONTROL[]" value="{{$icontrol_detailsubsub->PK5_DEPART_SUB_CONTROL}}">
                                        </td >
                                 
                                        <td style="text-align: left;font-size: 13px;">                                        
                                            <textarea name="PK5_DEPART_SUB_EVACONTROL[]" id="PK5_DEPART_SUB_EVACONTROL[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" rows="5">{{$icontrol_detailsubsub->PK5_DEPART_SUB_EVACONTROL}}</textarea>
                                        </td>
                                        

                                        <td style="text-align: left;font-size: 13px;">                                       
                                            <textarea name="PK5_DEPART_SUB_HAVERISK[]" id="PK5_DEPART_SUB_HAVERISK[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" rows="5">{{$icontrol_detailsubsub->PK5_DEPART_SUB_HAVERISK}}</textarea>
                                        </td>
                                </tr>
                            @endforeach   
                             

                        </tbody>
                    </table>


                    </div> 
</div>









<div class="modal-footer">



     
          <div class="col-md-9" align="right">
          <button type="submit" id="button"  class="btn btn-info btn-lg savebtn"  >บันทึกข้อมูล</button>
<a href="{{ url('manager_risk/internalcontrol_pk5_depart/'.$icontrols->INTERNALCONTROL_ID.'/'.$icontrols->INTERNALCONTROL_HEAD_WORK.'/'.$icontrols->INTERNALCONTROL_GROUP_NAME)  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')"  class="btn btn-hero-sm btn-hero-danger cancel"  >ยกเลิก</a>

             
          </div>
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

    function checkposition(number){  
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;        
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checkposition')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showposition'+number).html(result);
                   }
           })
  }

  function checklevel(number){   
      var PERSON_ID=document.getElementById("PERSON_ID"+number).value;      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('perdev.checklevel')}}",
                   method:"GET",
                   data:{PERSON_ID:PERSON_ID,_token:_token},
                   success:function(result){
                      $('.showlevel'+number).html(result);
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
        });  //กำหนดเป็นวันปัจุบัน
     
    });
    

$('.addRow2').on('click',function(){
        addRow2();
    });

    function addRow2(){
    var count = $('.tbody2').children('tr').length;
        var tr =   '<tr>'+
                '<td style="text-align: center;font-size:14px;font-weight:normal;">'+
                (count+1)+
                '</td>'+
                '<td>'+
                ' <textarea name="IN_CT_PK5_DEPART_MOTIVE[]" id="IN_CT_PK5_DEPART_MOTIVE[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 14px;font-weight:normal;" rows="4"></textarea>'+
                '</td>'+
                '<td>'+
                ' <textarea name="IN_CT_PK5_DEPART_RISK[]" id="IN_CT_PK5_DEPART_RISK[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 14px;font-weight:normal;" rows="4"></textarea>'+
                '</td>'+
                '<td>'+
                ' <textarea name="IN_CT_PK5_DEPART_CONTROL[]" id="IN_CT_PK5_DEPART_CONTROL[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 14px;font-weight:normal;" rows="4"></textarea>'+
                '</td>'+
                '<td>'+
                ' <textarea name="IN_CT_PK5_DEPART_EVACONTROL[]" id="IN_CT_PK5_DEPART_EVACONTROL[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 14px;font-weight:normal;" rows="4"></textarea>'+
                '</td>'+
                '<td>'+
                ' <textarea name="IN_CT_PK5_DEPART_HAVERISK[]" id="IN_CT_PK5_DEPART_HAVERISK[]" class="form-control input-sm" style=" font-family:\'Kanit\', sans-serif;font-size: 14px;font-weight:normal;" rows="4"></textarea>'+
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