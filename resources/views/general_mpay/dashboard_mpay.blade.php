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
    font-size: 14px;
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}

use App\Http\Controllers\PerdevController;
$checkapp = PerdevController::checkapp($user_id);
$checkver = PerdevController::checkver($user_id);

$countapp = PerdevController::countapp($user_id);
$countver = PerdevController::countver($user_id);


?>
<!-- Advanced Tables -->
<div class="bg-body-light">
<div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลจ่ายกลาง</B></h3>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                                            <div class="row">
                                            <!--<div>
                                             <a href="{{ url('general_mpay/dashboard_mpay/'.$inforpersonuserid -> ID) }}" class="btn btn-warning" >Dashboard</a>
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
                                             <a href="{{ url('general_mpay/pay_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จ่ายออก</a>
                                            </div>
                                            <div>&nbsp;</div>


                                            </ol>

                            </nav>
            </div>
            <div class="block-content">

            <div class="block-content">
            <form action="" method="post">
                    @csrf 
            <div class="row" >
        
           
            <div class="col-md-2">
                &nbsp;ประจำปีงบประมาณ : &nbsp;
            </div>
            <div class="col-md-2">
                <span>
                <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">   
                                             
                                </select>

                 
                   
                </span>

                </div> 
                <div class="col-md-1">
                            <span>
                                <button type="submit" class="btn btn-info" >แสดง</button>
                            </span> 
                        </div>
                </div>

             </form>     
<div class="row">
    <div class="col-md-4 col-xl-3">
            <a class="block block-rounded block-link-pop bg-xinspire" href="javascript:void(0)">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <div class="item">
                        <i class="fa fa-2x fa fa-book text-white"></i>
                    </div>
                    <div class="ml-3 text-right" >

                        <p class="text-white mb-0" style="font-size: 2.25rem;">
                    
                        </p>
                        <p class="text-white mb-0">
                        ขอเบิก (เรื่อง)
                        </p>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-xl-3">
            <a class="block block-rounded block-link-pop bg-danger" href="javascript:void(0)">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <div class="item">
                        <i class="fa fa-2x fa fa-paper-plane text-white"></i>
                    </div>
                    <div class="ml-3 text-right">
                    <p class="text-white mb-0" style="font-size: 2.25rem;">
                
                        </p>
                        <p class="text-white mb-0">
                        หน. เห็นชอบ (เรื่อง)
                        </p>

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-xl-3">
            <a class="block block-rounded block-link-pop bg-warning" href="javascript:void(0)">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                <div class="item">
                        <i class="fa fa-2x fa fa-inbox text-white"></i>
                    </div>
                <div class="ml-3 text-right">
                <p class="text-white mb-0" style="font-size: 2.25rem;">
              
                        </p>
                        <p class="text-white mb-0">
                        ตรวจสอบผ่าน (เรื่อง)
                        </p>

                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-4 col-xl-3">
            <a class="block block-rounded block-link-pop bg-info" href="javascript:void(0)">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                <div class="item">
                        <i class="fa fa-2x fa fa-hand-point-up text-white"></i>
                    </div>
                <div class="ml-3 text-right">
                <p class="text-white mb-0" style="font-size: 2.25rem;">
             
                        </p>
                        <p class="text-white mb-0">
                        อนุมัติ (เรื่อง)
                        </p>

                    </div>

                </div>
            </a>
        </div>
</div>

<div style="width: 95%;">
           <div class="block block-content">
            <div id="columnchart_01" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
            </div>
            </div>
            <br>
            <div style="width: 95%;">
           <div class="block block-content">
            <div id="columnchart_02" style="font-family: 'Kanit', sans-serif;width: 100%; height: 500px;"></div>
            </div>
            </div>




</div>

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>


<script src="{{ asset('google/Charts.js') }}"></script>



@endsection
