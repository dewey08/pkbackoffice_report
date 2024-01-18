@extends('layouts.backend')


<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
</style>


@section('content')
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
use App\Http\Controllers\MeetingController;
$checkver = MeetingController::checkver($user_id);
$countver = MeetingController::countver($user_id);

?>

                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <div class="row">
                                    <div >
                                        <a href="{{ url('general_meet/genmeetindex/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                    </div>
                                    <div>&nbsp;</div>
                        <div >

                        <a href="{{ url('general_meet/genmeetroom/'.$inforpersonuserid -> ID)}}" class="btn btn-info loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">จองห้องประชุม</a>

                        </div>
                        <div>&nbsp;</div>
                        <div>
                        <a href="{{ url('general_meet/genmeetroominfo/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ข้อมูลการจองห้อง</a>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                                @if($checkver!=0)
                                <a href="{{ url('general_meet/genmeetroomver/'.$inforpersonuserid -> ID)}}" class="btn loadscreen" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#00BFFF;color:#F0FFFF;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                                @if($countver!=0)
                                    <span class="badge badge-light" >{{$countver}}</span>
                                @endif

                                </a>
                                </div>
                                <div>&nbsp;</div>
                                @endif
                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">



                        <div class="row">

                        @foreach ($inforooms as $inforoom)
                        <div class="col-md-6 col-xl-4">
                            <!-- Story #1 -->
                            <a href="{{ url('general_meet/genmeetroomadd/'.$inforoom->ROOM_ID.'/'.$inforpersonuserid -> ID)}}" class="block block-rounded"  href="javascript:void(0)">

                                <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($inforoom->IMG1)) }});">
                                    <p>
                                    <span class="badge badge-info font-w2000 p-2 text-uppercase">
                                    {{$inforoom->ROOM_NAME}} :: ความจุ {{$inforoom->CONTAIN}} คน
                                    </span>
                                    </p>
                                <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center">

                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforoom->IMG1)) }}" height="200px" width="100%">

                                    </div>



                                </div>
                            </a>
                            <!-- END Story #1 -->
                        </div>
                        @endforeach
                      </div>


@endsection

@section('footer')



@endsection
