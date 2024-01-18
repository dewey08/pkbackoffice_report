@extends('layouts.headdep')
<!-- Page JS Plugins CSS -->
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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
            font-family: 'Kanit', sans-serif;
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

use App\Http\Controllers\ManagerleaveController;
?>
<?php
$color_a = 'background-color: #F0F8FF;';
$yearbudget = $year_id;

?>
           
           <br>
           <br>
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">    
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
          <div class="row">
          <div class="col-md-10" align="left">
         รายงานข้อมูลการลาของบุคลากรที่ถูกเห็นชอบ
          </div>
          <div class="col-md-2">
         
               <?php  $search = ''; ?>
          </div>
          </div>
          </h2>  
                      
           
            
             <div class="row">
                  
                  <div class="col-md-12">
                  <form action="{{ route('hdep.headdep_leave_reportsearch') }}" method="post">
                @csrf
                    <div class="row">  
                    <div class="col-md-0.5">
                            &nbsp;ปีงบ &nbsp;
                        </div>                            
                        <div class="col-md-2">
                        <span>
                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">      

                                     @foreach ($budgetyears as $budgetyear)
                                                @if($budgetyear->LEAVE_YEAR_ID == $year_id)                                                     
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                                @else
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_ID}}</option>
                                            @endif
                                                              
                                    @endforeach                           

                                                                                                 
                                    </select>
                        </div> 
              
                        <div class="col-sm-4 date_budget">
                    <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                  
                        <div class="col-sm-4">
                         
                                <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>     
                           
                        </div>
                        <div class="col-sm">
                        ถึง 
                        </div>
                        <div class="col-sm-4">
                   
                        <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                       
                        </div>
                        </div>

                </div>
                      

                       
                        <div class="col-md-0.5">
                            &nbsp;ค้นหา &nbsp;
                        </div>
                        <div class="col-md-2">
                            <span>                 
                                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-weight:normal;" value="{{$search}}">
                            </span>
                        </div>               
                        <div class="col-md-30">
                            &nbsp;
                        </div> 
                        <div class="col-md-1">
                            <span>
                                <button type="submit" class="btn btn-info" >ค้นหา</button>
                            </span> 
                        </div>
                      
                    </div>  
            </form>
                 </div>
               
          
                  </div>  
             </form>
            
         
        <div class="panel-body" style="overflow-x:auto;">  
        ค = จำนวนครั้ง ,ว = จำนวนวัน     
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
        <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">    
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%" rowspan="2">ลำดับ</td>       
    
      
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%" rowspan="2">ชื่อ นามสกุล</td> 
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">ตำแหน่ง</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" rowspan="2">ฝ่าย/แผนก</td>
       
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาป่วย</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลากิจ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาพักผ่อน</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาคลอดบุตร</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาช่วยคลอด</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาติดตามคู่สมรส</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาทำงานต่างประเทศ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาฟื้นฟูอาชีพ</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาศึกษา ฝึกอบรม</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาอุปสมบท</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">ลาเกณฑ์ทหาร</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;"width="4%" colspan="2">รวม</td>
      </tr><tr>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" >ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" style="{{$color_a}}">ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;">ว</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" >ค</td>
        <td class="text-font" style="border-color:#F0FFFF;text-align: center;" >ว</td>
     
                   </tr>
                   </thead>
                   <tbody>
                   <?php $number = 0; ?>
                   @foreach ($persons as $person)
                   <?php $number++; 
                  

                   if( $person->HR_STATUS_ID == 5 || $person->HR_STATUS_ID == 6 || $person->HR_STATUS_ID == 7 || $person->HR_STATUS_ID == 8){
                   $color = 'background-color: #FFF0F5;';
                  
                    }else{
                    $color = '';
                   }
                   ?> 
                   <tr style="{{$color}}" height="20">
                   <td class="text-font" align="center"> {{ $number }}</td>  
                 
                     <td class="text-pedding text-font">{{ $person -> HR_PREFIX_NAME }}{{ $person -> HR_FNAME }} {{ $person -> HR_LNAME }}</td>                     
                     
        
                     <td class="text-pedding text-font"> {{ $person -> POSITION_IN_WORK }}</td>   
                   

                     <td class="text-pedding text-font"> {{ $person -> HR_DEPARTMENT_SUB_NAME }}</td>     
                      
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,1,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,1,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,3,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,3,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,4,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,4,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,2,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,2,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,6,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,6,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,10,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,10,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,9,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,9,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,11,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,11,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,8,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,8,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,5,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,5,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="{{$color_a}}" class="text-pedding text-font">{{  number_format(ManagerleaveController::countamountdayleavemonth($person ->ID,$yearbudget,7,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td class="text-pedding text-font">{{  number_format(ManagerleaveController::countdayleavemonth($person ->ID,$yearbudget,7,$displaydate_bigen,$displaydate_end),1) }}</td>
                  <td style="background-color: #FFF0F5;" class="text-pedding text-font">{{  number_format(ManagerleaveController::sumcountamountdayleavemonth($person ->ID,$yearbudget,$displaydate_bigen,$displaydate_end)) }}</td>
                  <td style="background-color: #FFF0F5;" class="text-pedding text-font">{{  number_format(ManagerleaveController::sumcountdayleavemonth($person ->ID,$yearbudget,$displaydate_bigen,$displaydate_end),1) }}</td>

                   </tr>

  
                 
                   @endforeach 
                   </tbody>
                  </table>
</div>
    
                      

@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
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

$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
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