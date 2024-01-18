@extends('layouts.general.cpay')
@section('content_cpay')
<div class="block shadow" style="width:95%;margin:10px auto 20px;">
    <div class="block-content">
        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    &nbsp;ประจำปีงบประมาณ : &nbsp;
                </div>
                <div class="col-md-2">
                    <span>
                        <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;">
                        @foreach($yearlist as $year)
                        <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-md-1">
                    <span>
                        <button type="submit" class="btn btn-info">แสดง</button>
                    </span>
                </div>
            </div>
        </form>
        <hr>
        <div class="block-content mt-3 mb-4 shadow">
            <div class="row">
                @for($i=1;$i<=4;$i++)
                <div class="col-md-4 col-xl-3">
                    <div class="block radius-5 bg-sl2-sb4">
                        <div class="block-content block-content-full d-flex align-items-stretch justify-content-between p-2 pb-3 pt-0 ">
                            <div class="ml-3 text-left">
                                <p class="text-white mb-0" style="font-size: 2.5rem;">
                                    {{$i}} <span class="text-font">ครั้ง</span>
                                </p>
                                <p class="text-white m-0 pt-2">ข้อมูล {{$i}}</p>
                            </div>
                            <div class="text-white text-center mr-3">
                                <i class="m-0 fa fa-2x fa fa-paper-plane text-white pt-3 pb-4"></i> <br>
                                <!-- <p class="mb-0 fs-20">0.00%</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
        <div class="block-content mt-3 mb-4 shadow">
            <h3 class="block-title fs-18 fw-b">ข้อมูลตารางจ่ายกลาง</h3>
            <hr>
            <div class="table-responsive">  
                <table class="table table-sl-bordered">
                    <thead class="bg-sl-header">
                        <tr>
                            <th>#</th>
                            <th>รายการ</th>
                            <th>จำนวนการใช้</th>
                            <th>จำนวนการชำรุด</th>
                            <th>จำนวนอื่น ๆ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=1;$i<=20;$i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_cpay')
<script src="{{asset('asset/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $('.table').dataTable({
        'info':false,
        'lengthChange':false,
        "pageLength": 20,
    });
</script>
@endsection