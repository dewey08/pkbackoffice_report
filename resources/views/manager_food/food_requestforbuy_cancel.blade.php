@extends('layouts.food')

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
            font-size: 13px;
            }

            .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

                    .text-font {
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
<?php
  $datenow = date('Y-m-d');
?>

<br><br>
<center>

<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
                <div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยกเลิกการขอซื้อขอจ้าง</B></h3>

</div>                
<div class="block-content block-content-full"  style="text-align: left;">

           <form  method="post" action="{{ route('mfood.food_requestforbuy_update_cancel') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="ID" id="ID" value="{{$inforequest ->ID}}">

        <div class="row push">
    <div class="col-sm-10">                                        

        <div class="row push">
        <div class="col-sm-2">
            <label>ลงวันที่ต้องการ :</label>
        </div>
        <div class="col-lg-2">
           
            {{ DateThai($inforequest ->DATE_WANT) }}
        </div>
        <div class="col-sm-2 text-right">
                <label>เพื่อจัดซื้อ/ซ่อมแซม :</label>
            </div>
        <div class="col-lg-6">
            {{ $inforequest ->REQUEST_FOR }}
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
            {{ $inforequest ->BUDGET_YEAR }}
            </div>

            <div class="col-sm-2 text-right">
                <label>หน่วยงานผู้เบิก :</label>
            </div>
            <div class="col-lg-3">
                 {{$inforequest->SAVE_HR_DEP_SUB_NAME}}

             

                <div style="color: red; font-size: 16px;" id="record_location_id"></div>
            </div>
            <div class="col-sm-1">
                <label>เบอร์โทร:</label>
            </div>
            <div class="col-lg-2">
             
                {{ $inforequest ->DEP_SUB_SUB_PHONE }}
            </div>
        </div>
       <div class="row push">
        <div class="col-sm-2">
                <label>ผู้รายงาน :</label>
            </div>
            <div class="col-lg-4">
      
             {{ $inforequest ->SAVE_HR_NAME }}

        
            </div>
            <div class="col-sm-2">
                    <label>ผู้เห็นชอบ :</label>
                </div>
                <div class="col-lg-4">
                        {{ $inforequest ->AGREE_HR_NAME }}
                 
                <div style="color: red; font-size: 16px;" id="record_location_id"></div>
                </div>
            </div>
            <div class="row push">
        <div class="col-sm-2">
                <label>เบอร์โทรผู้รายงาน :</label>
            </div>
            <div class="col-lg-4">
          {{$infohr->HR_PHONE}}
            </div>
          

            <div class="col-sm-2">
            <label>เหตุผล :</label>
            </div>
            <div class="col-sm-4">
           
            {{ $inforequest ->REQUEST_BUY_COMMENT }}
            </div>
            </div>
        
    </div>

    <div class="col-sm-2">
    <img src="data:image/png;base64,{{ chunk_split(base64_encode($infohr->HR_IMAGE)) }}"  height="100px" width="100px"/>
    </div>
    </div>

    <div align="right">จำนวนเงินรวม {{number_format($inforequest -> BUDGET_SUM,2)}}  บาท</div>
       <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
            <thead style="background-color: #FFEBCD;">
                <tr height="40">
                <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลำดับ</th>
                    <th style="text-align: center;">รายละเอียด</th>
                    <th style="text-align: center;" width="10%">จำนวน</th>
                    <th style="text-align: center;" width="10%">หน่วย</th>
                    <th style="text-align: center;" width="20%">ราคาต่อหน่วย</th>
                    <th style="text-align: center;" width="20%">จำนวนเงิน</th>

                </tr>
            </thead>
            <tbody class="tbody1">
          <?php  $count = 1; ?>
                @foreach ($inforequestsubs as $inforequestsub)
                    <tr height="20">
                    <td class="text-font" align="center" >{{$count}}</td>
                        <td class="text-font text-pedding" >{{ $inforequestsub -> SUPPLIES_REQUEST_SUB_DETAIL }}</td>
                        <td class="text-font text-pedding"  align="center">{{ $inforequestsub -> SUPPLIES_REQUEST_SUB_AMOUNT }}</td>
                        <td class="text-font text-pedding"  align="center">{{ $inforequestsub -> SUPPLIES_REQUEST_SUB_UNIT }}</td>
                        <td class="text-font text-pedding"  align="center">{{ number_format($inforequestsub -> SUPPLIES_REQUEST_SUB_PRICE,2) }}</td>
                        <td class="text-font text-pedding"  align="center">{{ number_format($inforequestsub -> SUPPLIES_REQUEST_SUB_AMOUNT  *  $inforequestsub -> SUPPLIES_REQUEST_SUB_PRICE,2) }} </td>
                        <?php $count++; ?>
                    </tr>
                @endforeach
            </tbody>
        </table>
              <br>
        <div class="modal-footer">
            <div align="right">
              <button type="submit"  class="btn btn-hero-sm btn-hero-danger fw-1 f-kanit" >ยืนยันการยกเลิกคำร้อง</button>  
                    <a href="{{ url('manager_food/infofoodrequert') }}" class="btn btn-hero-sm btn-hero-secondary fw-1 f-kanit">ปิดหน้าต่าง</a>
            </div>
        </div>
    </form>




@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



@endsection
