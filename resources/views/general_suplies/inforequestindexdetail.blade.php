@extends('layouts.backend')

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
                                             <a href="{{ url('general_suplies/dashboard/'.$inforpersonuserid -> ID) }}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>



                                            <div>
                                             <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}" class="btn btn-primary loadscreen" >ขอจัดซื้อ/จัดจ้าง</a>
                                            </div>
                                            <div>&nbsp;</div>

                                       
                                            @if($checkapp != 0)
                                            <div>
                                           <a href="{{ url('general_suplies/inforequestapp/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เห็นชอบ

                                           @if($countapp!=0)
                                    <span class="badge badge-light" >{{$countapp}}</span>
                                            @endif
                                            </a>
                                            </div>
                                            <div>&nbsp;</div>
                                            @endif

                                            @if($checkallow!=0)
                                            <div>
                                            <a href="{{ url('general_suplies/inforequestlastapp/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">อนุมัติ

                                            @if($countallow!=0)
                                            <span class="badge badge-light" >{{$countallow}}</span>
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">รายละเอียดการขอซื้อ/ขอจ้างพัสดุ</h2>
    
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
                 {{$inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME}}

                 <input type="hidden" name="DEP_SUB_SUB_ID" id="DEP_SUB_SUB_ID" value="{{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_ID}}">
                 <input type="hidden" name="DEP_SUB_SUB_NAME" id="DEP_SUB_SUB_NAME" value="{{$inforpersonuser->HR_DEPARTMENT_SUB_SUB_NAME}}">

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

            <div class="row push">
        <div class="col-sm-2">
                <label>บริษัทแนะนำ :</label>
            </div>
            <div class="col-lg-4">
          {{$inforequest->REQUEST_VANDOR_NAME}}
            </div>
          

            <div class="col-sm-2">
            <label>หมายเหตุ :</label>
            </div>
            <div class="col-sm-4">
            
            {{ $inforequest ->REQUEST_REMARK }}
            </div>
           
            </div>

        <div class="row">
            <div class="col-sm-2">
                <label>หมายเหตุผู้เห็นชอบ :</label>
                </div>
                <div class="col-sm-4">
                
                {{ $inforequest ->AGREE_COMMENT }}
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
                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                    <th style="text-align: center;border: 1px solid black;">รายละเอียด</th>
                    <th style="text-align: center;border: 1px solid black;" width="10%">จำนวน</th>
                    <th style="text-align: center;border: 1px solid black;" width="10%">หน่วย</th>
                    <th style="text-align: center;border: 1px solid black;" width="20%">ราคาต่อหน่วย</th>
                    <th style="text-align: center;border: 1px solid black;" width="20%">จำนวนเงิน</th>

                </tr>
            </thead>
            <tbody class="tbody1">
          <?php  $count = 1; ?>
                @foreach ($inforequestsubs as $inforequestsub)
                    <tr height="20">
                    <td class="text-font" align="center" style="border: 1px solid black;" >{{$count}}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforequestsub -> SUPPLIES_REQUEST_SUB_DETAIL }}</td>
                        <td class="text-font text-pedding"  style="border: 1px solid black;" align="right">{{ $inforequestsub -> SUPPLIES_REQUEST_SUB_AMOUNT }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;"  align="center">{{ $inforequestsub -> SUPPLIES_REQUEST_SUB_UNIT }}</td>
                        <td class="text-font text-pedding"  style="border: 1px solid black;" align="right">{{ number_format($inforequestsub -> SUPPLIES_REQUEST_SUB_PRICE,2) }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;"  align="right">{{ number_format($inforequestsub -> SUPPLIES_REQUEST_SUB_AMOUNT  *  $inforequestsub -> SUPPLIES_REQUEST_SUB_PRICE,2) }} </td>
                        <?php $count++; ?>
                    </tr>
                @endforeach
            </tbody>
        </table>
              <br>
              
        <div class="modal-footer">
            <div align="right">
              
                    <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}" class="btn btn-secondary btn-lg"  >ปิดหน้าต่าง</a>
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
