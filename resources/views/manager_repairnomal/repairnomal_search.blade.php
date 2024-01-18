@extends('layouts.repairnomal')
@section('css_before')
<link rel="stylesheet" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{asset('css/1.10.24.css.jquery.dataTables.css')}}">

@endsection

@section('content')
<div class="block block-content mb-4" style="width:95%;margin:auto">
    <div class="block-header block-header-default">
        <div class="block-title text-center fs-24"> ตารางข้อมูลงานซ่อมทั่วไป </div>
    </div>
    <hr>
    <form class="card mb-2">
        <div class="card-body row">
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                ปีงบประมาณ :
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                <select name="budgetyear" class="form-control" id="">
                    @foreach($budgetyear_dropdown as $key => $value)
                    @if($key == $budgetyear)
                    <option value="{{$key}}" selected>{{$value}}</option>
                    @else
                    <option value="{{$key}}">{{$value}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                สถานะ :
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                <select name="repairstatus" class="form-control" id="">
                    @foreach($repairstatus_dropdown as $key => $value)
                    @if($value->STATUS_NAME == $repairstatus)
                    <option value="{{$value->STATUS_NAME}}" selected>{{$value->STATUS_NAME_TH}}</option>
                    @else
                    <option value="{{$value->STATUS_NAME}}">{{$value->STATUS_NAME_TH}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-info py-1">ค้นหา</button>
            </div>
        </div>
    </form>
    <div class="block-content pt-0 mb-2" style="overflow-y:hidden">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center" style=" font-size: 15px;">
                ความเร่งด่วน ::&nbsp;
                <p class="m-0 fa fa-circle" style="color:#008000;  font-size: 15px;"></p>&nbsp; ปกติ&nbsp;&nbsp;
                <p class="m-0 fa fa-circle" style="color:#87CEFA;  font-size: 15px;"></p>&nbsp; ด่วน&nbsp;&nbsp;
                <p class="m-0 fa fa-circle" style="color:#FFA500;  font-size: 15px;"></p>&nbsp; ด่วนมาก&nbsp;&nbsp;
                <p class="m-0 fa fa-circle" style="color:#FF4500;  font-size: 15px;"></p>&nbsp; ด่วนที่สุด&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                คะแนน ::&nbsp;
                <i class="fa fa-sad-cry" style="color:#ed2e35;"></i>&nbsp; ต้องปรับปรุง&nbsp;&nbsp;
                <i class="fa fa-sad-tear" style="color:#f89b31;"></i>&nbsp; พอใช้&nbsp;&nbsp;
                <i class="fa fa-meh" style="color:#f7c800;"></i> &nbsp;ปานกลาง&nbsp;&nbsp;
                <i class="fa fa-smile" style="color:#96ca4e;"></i> &nbsp;ดี&nbsp;&nbsp;
                <i class="fa fa-smile-beam" style="color:#149c54;"></i> &nbsp;ดีมาก&nbsp;&nbsp;
            </div>
        </div>
        <table id="table" class="table table-striped table-sl-border table-sl-p-5px table-sl-header-center"
            style="border:solid 1px #000;width:100%">
            <thead class="bg-sl-blue text-white">
                <tr height="40" width="100%">
                    <th width="2%">ลำดับ</th>
                    <th width="8%">รหัส</th>
                    <th width="5%">สถานะ</th>
                    <th width="5%">ความเร่งด่วน</th>
                    <th width="5%">ความพึงพอใจ</th>
                    <th width="13%">วดป./เวลา</th>
                    <th width="10%">แจ้งซ่อม</th>
                    <th width="10%">อาการ</th>
                    <th width="10%">ผู้ร้องขอ</th>
                    <th width="10%">หน่วยงาน</th>
                    <th width="10%">สถานที่พบ</th>
                    <th width="10%">ช่างที่ต้องการ</th>
                </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                @foreach ($repairnomals as $row)
                <?php 
                                  if($row->REPAIR_STATUS == 'CANCEL'){
                                    $color = 'background-color: #FFF0F5;';
                                  }else{
                                    $color = '';
                                  }
                                ?>
                <tr height="20" style="{{$color}}">
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">
                        {{$number++}}
                    </td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{ $row->REPAIR_ID }}</td>


                    @if($row->REPAIR_STATUS == 'REPAIR_OUT')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-secondary">แจ้งยกเลิก</span></td>
                    @elseif($row->REPAIR_STATUS== 'REQUEST')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-warning">ร้องขอ</span></td>
                    @elseif($row->REPAIR_STATUS== 'RECEIVE')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-info">รับงาน</span></td>
                    @elseif($row->REPAIR_STATUS == 'PENDING')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-danger">กำลังดำเนินการ</span></td>
                    @elseif($row->REPAIR_STATUS == 'CANCEL')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-dark">ยกเลิก</span></td>
                    @elseif($row->REPAIR_STATUS == 'SUCCESS')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-success">ซ่อมเสร็จ</span></td>
                    @elseif($row->REPAIR_STATUS == 'OUTSIDE')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-danger">ส่งซ่อมนอก</span></td>
                    @elseif($row->REPAIR_STATUS == 'DEAL')
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="badge badge-danger">จำหน่าย</span></td>
                    @else
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                    @endif

                    @if($row->PRIORITY_ID == 1)
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="fa fa-2x fa-circle" style="color:#008000;"></span></td>
                    @elseif($row->PRIORITY_ID == 2)
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                    @elseif($row->PRIORITY_ID == 3)
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>
                    @elseif($row->PRIORITY_ID == 4)
                    <td class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><span
                            class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>

                    @endif
                    
               
                
                
               
                    @if($row->FANCINESS_SCORE == 1)
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><i class="fa fa-sad-cry fs-24" style="color:#ed2e35;"></i></td>
                    @elseif($row->FANCINESS_SCORE == 2)
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><i class="fa fa-sad-tear fs-24" style="color:#f89b31;"></i></td>
                    @elseif($row->FANCINESS_SCORE == 3)
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><i class="fa fa-meh fs-24" style="color:#f7c800;"></i></td>
                    @elseif($row->FANCINESS_SCORE == 4)
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><i class="fa fa-smile fs-24" style="color:#96ca4e;"></i></td>
                    @elseif($row->FANCINESS_SCORE == 5)
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"><i class="fa fa-smile-beam fs-24" style="color:#149c54;"></i></td>
                    @else
                    <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"></td>
                    @endif

                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{ DatetimeThai($row->DATE_TIME_REQUEST) }}</td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{ $row->REPAIR_NAME }}</td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{ $row->SYMPTOM }}</td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{ $row->USRE_REQUEST_NAME }}</td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{$row->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{$row->BUILD_NAME}}</td>
                    <td class="text-font text-pedding"
                        style="border-color:#F0FFFF;text-align: left;border: 1px solid black;">
                        {{$row->TECH_REPAIR_NAME}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="{{asset('js/1.10.24.js.jquery.dataTables.js')}}"></script>
<script src="{{asset('google/Charts.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            info: false,
            "iDisplayLength": 10,
        });
    });
</script>
@endsection