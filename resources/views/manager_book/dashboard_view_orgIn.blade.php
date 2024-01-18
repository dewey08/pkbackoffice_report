@extends('layouts.book')

@section('css_before')
<link rel="stylesheet" href="http://localhost/gtwbackoffice/css/1.10.24.css.jquery.dataTables.css">
<style>
    .header-group tr th , tr td{
        border:1px solid #000000;
    }
</style>
<script>
    function checklogin() {
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
use App\Http\Controllers\DashboardController;
$checkbook = DashboardController::checkbook($id_user);
?>
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="block shadow" style="width: 95%;">
        <div class="block-content">
            <div class="block-header block-header-default">
                <h3 class="block-title text-center fs-18">ตารางข้อมูลสารบรรณอิเล็กทรอนิกส์ จำแนกโดยประเภทหนังสือ</h3>
            </div>
            <hr>
            <div class="block-content my-3">
                <div class="row">
                    <div class="col-xl-12 mb-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-sl-border table-sl-header-center" id="table">
                                    <thead class="header-group bg-sl-blue text-white">
                                        <tr>
                                            <th class="py-2" width="10px">#</th>
                                            @foreach($countTypeebookreceive_byORG['header'] as $fild)
                                            <th class="py-2">{{$fild}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($countTypeebookreceive_byORG['content']))
                                        @php $num = 0; @endphp
                                        @foreach($countTypeebookreceive_byORG['content'] as $row)
                                        @php $num++; @endphp
                                        <tr class="text-center">
                                            <td class="py-1">{{$num}}</td>
                                            @php $i = 1; @endphp
                                            @foreach($row as $value)
                                                @if($i == 1 )
                                                <td class="py-1 text-left">{{$value}}</td>
                                                @else
                                                <td class="py-1">{{$value}}</td>
                                                @endif
                                                @php $i++; @endphp
                                            @endforeach
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('google/Charts.js') }}"></script>
<script type="text/javascript" charset="utf8" src="http://localhost/gtwbackoffice/js/1.10.24.js.jquery.dataTables.js"></script>
<script>
    let table = $(document).ready(function () {
        $('#table').DataTable({
            info: false,
            "iDisplayLength": 50,
        });
    });
</script>
@endsection