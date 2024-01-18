@extends('layouts.personhealth')
@section('css_before')
@endsection
@section('content')
<div class="block block-rounded block-bordered mt-5" style="margin:auto;width:95%;">
    <div class="block-content">
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
            <div class="row">
                <div class="col-md-6">
                    ข้อมูลประวัติการเจ็บป่วย <b>{{$name_title}}</b>
                </div>
            </div>
        </h2>
        <form action="{{route('health.healthdashboard_Illness_history')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-2 d-flex align-items-center justify-content-center">
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
                <div class="col-sm-1 d-flex align-items-center justify-content-center">
                    โรค
                </div>
                <div class="col-sm-2">
                    <span>
                        <select name="disease" id="disease" class="form-control input-lg"
                            style=" font-family: 'Kanit', sans-serif;" required>
                            <option value="" disabled selected>--กรุณาเลือก--</option>
                            @foreach($disease_list as $key => $value)
                            @if($select_disease == $key)
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
                        @foreach($diseases as $disease)
                        <tr>
                            <td style="padding:3px 1rem" class="text-center">{{$number++}}</td>
                            <td style="padding:3px 1rem">{{$disease['name']}}</td>
                            <td style="padding:3px 1rem" class="text-center">{{$disease['age']}} ปี</td>
                            <td style="padding:3px 1rem">{{DateThai($disease['screen_date'])}}</td>
                            <td style="padding:3px 1rem" class="text-center">
                                <?php
                                    if($disease['health_result'] == 'have'){
                                        echo '<span class="badge badge-danger">มี</span>';
                                    }elseif($disease['health_result'] == 'nothave') {
                                        echo '<span class="badge badge-success">ไม่มี</span>';
                                    }elseif ($disease['health_result'] == 'never') {
                                        echo '<span class="badge badge-info">ไม่เคยตรวจ</span>';
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
