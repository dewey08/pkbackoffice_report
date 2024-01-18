@extends('layouts.backend')


    <link rel="stylesheet" href="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css') }}">
<style>

#calendar{
		max-width: 95%;
		margin: 0 auto;
    font-size:15px;
	}


</style>

@section('content')
<?php
$status = Auth::user()->status;
$id_user = Auth::user()->PERSON_ID;
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos);


$m_budget = date("m");
if($m_budget>9){
  $yearbudget = date("Y")+544;
}else{
  $yearbudget = date("Y")+543;
}


?>

                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">

                                <div class="row">
                                <div >
                                <a href="{{ url('general_car/gencarindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ปฏิทินยานพาหนะ</a>
                                </div>
                                <div>&nbsp;</div>
                                <div >

                                <a href="{{ url('general_car/gencartype/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">เพิ่มข้อมูลขอใช้รถ</a>

                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_car/gencarinfonomal/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนใช้รถทั่วไป</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                <a href="{{ url('general_car/gencarinforefer/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนใช้รถพยาบาล</a>
                                </div>

                                <div>&nbsp;</div>



                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="content" >


                 <div style="text-align: center;">
                    <div class="row gutters-tiny">
                <div class="col-xl-3">
                            <a class="block block-link-shadow text-center" href="{{ url('general_car/gencarnomaladd/'.$inforpersonuserid -> ID)  }}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-5x fa fa-car-alt text-success"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ประชุมอบรมทั่วไป</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3">
                            <a class="block block-link-shadow text-center" href="{{ url('general_car/gencarreferadd/'.$inforpersonuserid -> ID)  }}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-5x fa fa-ambulance text-danger"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ฉุกเฉิน (REFER)</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        </div>

                        </div>

                            <!-- END  -->
                </div>





@endsection

@section('footer')




<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lib/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/js/fullcalendar-2.1.1/lang/th.js') }}"></script>




@endsection
