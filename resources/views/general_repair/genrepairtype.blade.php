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
                                <a href="{{ url('general_repair/genrepairtype/'.$inforpersonuserid -> ID)}}" class="btn btn-info" >แจ้งซ่อม</a>
                                </div>
                                <div>&nbsp;</div>

                                <div >
                                <a href="{{ url('general_repair/genrepairnomal/'.$inforpersonuserid -> ID)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนซ่อมทั่วไป</a>
                                </div>
                                <div>&nbsp;</div>

                                <div >
                                <a href="{{ url('general_repair/genrepaircom/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนซ่อมคอมพิวเตอร์</a>
                                </div>
                                <div>&nbsp;</div>

                                <div >
                                <a href="{{ url('general_repair/genrepairmedical/'.$inforpersonuserid -> ID)}}" class="btn" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ทะเบียนซ่อมเครื่องมือแพทย์</a>
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
                            <a class="block block-link-shadow text-center" href="{{ url('general_repair/genrepairnomaladd/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-5x fa fa-wrench text-success"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ซ่อมทั่วไป</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3">
                            <a class="block block-link-shadow text-center" href="{{ url('general_repair/genrepaircomadd/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        <i class="far fa-5x fa fa-tv text-warning"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ซ่อมคอมพิวเตอร์</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3">
                            <a class="block block-link-shadow text-center" href="{{ url('general_repair/genrepairmedicaladd/'.$inforpersonuserid -> ID)}}">
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center" >
                                    <div>
                                        <i class="far fa-5x fa fa-stethoscope text-danger"></i>
                                        <div class="font-w600 mt-3 text-uppercase">ซ่อมเครื่องมือแพทย์</div>
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
