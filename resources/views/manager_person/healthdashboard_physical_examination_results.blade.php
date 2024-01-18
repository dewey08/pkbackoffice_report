@extends('layouts.personhealth')
@section('css_before')
@endsection
@section('content')
<div class="block block-rounded block-bordered mt-5" style="margin:auto;width:95%;">
    <div class="block-content">
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
            <div class="row">
                <div class="col-md-6">
                    ข้อมูลผลตรวจร่างกาย
                </div>
            </div>
        </h2>
        <form action="{{route('health.healthdashboard_physical_examination_results')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-2 d-flex align-items-center justify-content-center fs-18">
                    ปีงบประมาณ
                </div>
                <div class="col-sm-2">
                    <span>
                        <select name="budgetyear" id="budgetyear" class="form-control input-lg budget"
                            style=" font-family: 'Kanit', sans-serif;">
                            @foreach($budgetyear_list as $budgetyear)
                            @if($budgetyear == $select_budgetyear)
                                <option value="{{$budgetyear}}" selected>{{$budgetyear}}</option>
                            @else
                                <option value="{{$budgetyear}}">{{$budgetyear}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-sm-1 d-flex align-items-center justify-content-center fs-18">
                    ผลการตรวจ
                </div>
                <div class="col-sm-2">
                    <span>
                        <select name="bodyresult" id="bodyresult" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;" required>
                            @foreach($bodyresult_list as $key => $value)
                            @if($select_bodyresult == $key)
                                <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-sm-1">
                    <span>
                        <button type="submit" class="btn btn-info f-kanit">ค้นหา</button>
                    </span>
                </div>


            </div>
        </form>
        <div class="block-content mt-3 mb-4">
            <div class="table-responsive">
                <table class="table table-sl-bordered">
                    <thead class="text-center bg-sl-header">
                        <tr>
                            <th width="5%">#</th>
                            <th width="45%">ชื่อ</th>
                            <th width="10%">อายุ</th>
                            <th width="20%">วันที่ตรวจ</th>
                            <th width="20%">ผลการตรวจ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($number = 1)
                        @foreach($health_result as $row)
                        <tr>
                            <td style="padding:3px 1rem" class="text-center">{{$number++}}</td>
                            <td style="padding:3px 1rem">{{$row->HR_FNAME.' '.$row->HR_LNAME}}</td>
                            <td style="padding:3px 1rem" class="text-center">{{$row->HEALTH_SCREEN_AGE}} ปี</td>
                            <td style="padding:3px 1rem">{{DateThai($row->HEALTH_SCREEN_DATE)}}</td>
                            <td style="padding:3px 1rem" class="text-center">
                                <?php
                                    if($row->HEALTH_BODY_RESULT == 1){
                                        echo '<span class="badge badge-danger">ป่วย</span>';
                                    }elseif($row->HEALTH_BODY_RESULT == 2) {
                                        echo '<span class="badge badge-success">เสี่ยง</span>';
                                    }elseif ($row->HEALTH_BODY_RESULT == 3) {
                                        echo '<span class="badge badge-info">สุขภาพดี</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>
    
</script>
@endsection
