@extends('layouts.guesthouse')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;

    }

    @media only screen and (min-width: 1200px) {
        label {
            float: right;
        }
    }

    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
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


?>

<center>
    <div class="block mt-5 shadow-lg" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>จัดสรรห้องพักชั้น
                        {{$levelname->LOCATION_LEVEL_NAME}} ห้อง {{$roomname->LEVEL_ROOM_NAME}}</B></h3>

                <a href="{{ url('manager_guesthouse/guesthouserequestdetail_flat/'.$id.'/checkperson')  }}"
                    class="btn btn-hero-sm btn-hero-success foo15 loadscreen"><i
                        class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
            </div>
            <div class="block-content block-content-full" align="left">


                <div class="row push">
                    <div class="col-lg-12">
                        <!-- Block Tabs Default Style -->
                        <div class="block block-rounded block-bordered">
                            <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist"
                                style="background-color: #E6E6FA;">
                                <li class="nav-item">
                                    @if($type_check == 'checkoutsider' || $type_check == 'checkasset' || $type_check ==
                                    'checkrepair')
                                    <a class="nav-link " href="#object1"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลเข้าพัก</a>
                                    @else
                                    <a class="nav-link active" href="#object1"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลเข้าพัก</a>
                                    @endif
                                </li>
                                <li class="nav-item">

                                    @if($type_check == 'checkoutsider')
                                    <a class="nav-link active" href="#object2"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลอื่น</a>
                                    @else
                                    <a class="nav-link" href="#object2"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บุคคลอื่น</a>
                                    @endif


                                </li>
                                <li class="nav-item">
                                    @if($type_check == 'checkasset')
                                    <a class="nav-link active" href="#object3"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์</a>
                                    @else
                                    <a class="nav-link" href="#object3"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ครุภัณฑ์</a>
                                    @endif

                                </li>
                                <li class="nav-item">
                                    @if($type_check == 'checkrepair')
                                    <a class="nav-link active" href="#object4"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บันทึกซ่อมแซม</a>
                                    @else
                                    <a class="nav-link" href="#object4"
                                        style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">บันทึกซ่อมแซม</a>
                                    @endif

                                </li>



                            </ul>
                            <div class="block-content tab-content">

                                @if($type_check == 'checkoutsider' || $type_check == 'checkasset' || $type_check ==
                                'checkrepair')
                                <div class="tab-pane" id="object1" role="tabpanel">
                                    @else
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                        @endif
                                        <button type="button" class="btn btn-hero-sm btn-hero-info foo15"
                                            data-toggle="modal" data-target="#preson_in"><i class="fas fa-plus"></i>
                                            เพิ่มข้อมูล</button>
                                        <br><br>

                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                            <thead style="background-color: #FFEBCD;">
                                                <tr height="40">
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">ลำดับ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="15%">ชื่อ-นามสกุล</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="15%">ตำแหน่ง</td>
                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        หน่วยงาน</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">สถานะ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">วันที่เข้า</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">วันที่ออก</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">คำสั่ง</td>


                                                </tr>
                                            </thead>
                                            <tbody class="tbody2">
                                                <?php $number = 0; ?>
                                                @foreach ($infoguesthouspersons as $infoguesthousperson)
                                                <?php $number++; ?>


                                                <tr height="20">
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        {{$number}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="15%">
                                                        {{ $infoguesthousperson->HR_FNAME}}
                                                        {{ $infoguesthousperson->HR_LNAME}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="15%">
                                                        {{ $infoguesthousperson->POSITION_IN_WORK}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{ $infoguesthousperson->HR_DEPARTMENT_SUB_SUB_NAME}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        @if($infoguesthousperson->INFMATION_PERSON_STATUS == '2')
                                                        <span class="badge badge-info">ย้ายออกแล้ว</span>
                                                        @else
                                                        <span class="badge badge-success">ปกติ</span>
                                                        @endif

                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        {{ DateThai($infoguesthousperson->INFMATION_PERSON_INDATE)}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        {{ DateThai($infoguesthousperson->INFMATION_PERSON_OUTDATE)}}
                                                    </td>

                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        <div class="dropdown" width="5%">
                                                            <button type="button"
                                                                class="btn btn-outline-info dropdown-toggle"
                                                                id="dropdown-align-outline-info" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                                ทำรายการ
                                                            </button>
                                                            <div class="dropdown-menu" style="width:10px">
                                                                <a class="dropdown-item" href="" data-toggle="modal"
                                                                    data-target="#editpreson_in{{$infoguesthousperson->INFMATION_PERSON_ID}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                                {{-- <a class="dropdown-item" href=""  data-toggle="modal" data-target="#editpreson_in{{$infoguesthousperson->INFMATION_ID.'/'.$infoguesthousperson->LOCATION_LEVEL_ID.'/'.$infoguesthousperson->LEVEL_ROOM_ID.'/checkperson' }}"
                                                                style="font-family: 'Kanit', sans-serif; font-size:
                                                                13px;font-weight:normal;">แก้ไขข้อมูล</a> --}}

                                                                <a class="dropdown-item"
                                                                    href="{{ url('manager_guesthouse/guesthouserequestdetail_destroyperson/'.$infoguesthousperson->INFMATION_ID.'/flat/'.$infoguesthousperson->LOCATION_LEVEL_ID.'/'.$infoguesthousperson->LEVEL_ROOM_ID.'/'.$infoguesthousperson->INFMATION_PERSON_ID)}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                                    onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>



                                                <div id="editpreson_in{{$infoguesthousperson->INFMATION_PERSON_ID}}"
                                                    class="modal fade " role="dialog"
                                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">>
                                                    <div class="modal-dialog modal-xl">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="margin-left: 20px">
                                                                <h5 style="font-family: 'Kanit', sans-serif;">
                                                                    แก้ไขข้อมูลผู้เข้าพัก</h5>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="post"
                                                                    action="{{ route('mguesthouse.guesthouserequestdetail_flat_roomupdateperson') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="ID" id="ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthousperson->INFMATION_PERSON_ID}}">
                                                                    <input type="hidden" name="INFMATION_ID"
                                                                        id="INFMATION_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthousperson->INFMATION_ID}}">
                                                                    <input type="hidden" name="LOCATION_LEVEL_ID"
                                                                        id="LOCATION_LEVEL_ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthousperson->LOCATION_LEVEL_ID}}">
                                                                    <input type="hidden" name="LEVEL_ROOM_ID"
                                                                        id="LEVEL_ROOM_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthousperson->LEVEL_ROOM_ID}}">

                                                                    <div class="row push">
                                                                        <div class="col-lg-1">
                                                                            <label>ผู้เข้าพัก</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <select name="INFMATION_PERSON_HRID"
                                                                                id="INFMATION_PERSON_HRID"
                                                                                class="form-control input-lg fo13"
                                                                                required>
                                                                                <option value="">
                                                                                    --กรุณาเลือกผู้เข้าพัก--</option>


                                                                                @foreach ($inforpersons as $inforperson)
                                                                                @if($inforperson->ID ==
                                                                                $infoguesthousperson->INFMATION_PERSON_HRID)
                                                                                <option value="{{ $inforperson->ID  }}"
                                                                                    selected>{{ $inforperson->HR_FNAME}}
                                                                                    {{ $inforperson->HR_LNAME}}</option>
                                                                                @else
                                                                                <option value="{{ $inforperson->ID  }}">
                                                                                    {{ $inforperson->HR_FNAME}}
                                                                                    {{ $inforperson->HR_LNAME}}</option>
                                                                                @endif

                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <label>สถานะ</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <select name="INFMATION_PERSON_STATUS"
                                                                                id="INFMATION_PERSON_STATUS"
                                                                                class="form-control input-lg fo13"
                                                                                required>
                                                                                @if($infoguesthousperson->INFMATION_PERSON_STATUS
                                                                                == '1') <option value="1" selected>ปกติ
                                                                                </option> @else<option value="1">ปกติ
                                                                                </option>@endif
                                                                                @if($infoguesthousperson->INFMATION_PERSON_STATUS
                                                                                == '2') <option value="2" selected>
                                                                                    ย้ายออกแล้ว</option> @else<option
                                                                                    value="2">ย้ายออกแล้ว</option>@endif

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-lg-1">
                                                                            <label>วันที่เข้า</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <input name="INFMATION_PERSON_INDATE"
                                                                                id="INFMATION_PERSON_INDATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                value="{{formate($infoguesthousperson->INFMATION_PERSON_INDATE)}}"
                                                                                readonly>
                                                                        </div>

                                                                        <div class="col-lg-1">
                                                                            <label>วันที่ออก</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            @if($infoguesthousperson->INFMATION_PERSON_OUTDATE
                                                                            == '' ||
                                                                            $infoguesthousperson->INFMATION_PERSON_OUTDATE
                                                                            == null )
                                                                            <input name="INFMATION_PERSON_OUTDATE"
                                                                                id="INFMATION_PERSON_OUTDATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                readonly>
                                                                            @else
                                                                            <input name="INFMATION_PERSON_OUTDATE"
                                                                                id="INFMATION_PERSON_OUTDATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                value="{{formate($infoguesthousperson->INFMATION_PERSON_OUTDATE)}}"
                                                                                readonly>
                                                                            @endif

                                                                        </div>


                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-hero-sm btn-hero-info foo15"><i
                                                                        class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                <button type="button"
                                                                    class="btn btn-hero-sm btn-hero-danger foo15"
                                                                    data-dismiss="modal"><i
                                                                        class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    </form>


                                    @endforeach
                                    </tbody>
                                    </table>


                                    <div id="preson_in" class="modal fade" role="dialog"
                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <!-- Modal content-->
                                            <div class="modal-content">

                                                <div class="modal-header" style="margin-left: 20px">
                                                    <h5 style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลผู้เข้าพัก
                                                    </h5>
                                                </div>
                                                <div class="modal-body">

                                                    <form method="post"
                                                        action="{{ route('mguesthouse.guesthouserequestdetail_flat_roomsaveperson') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="INFMATION_ID" id="INFMATION_ID"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$infoguesthouse->INFMATION_ID}}">

                                                        <input type="hidden" name="LOCATION_LEVEL_ID"
                                                            id="LOCATION_LEVEL_ID" class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$level_id}}">
                                                        <input type="hidden" name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$room_id}}">

                                                        <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;" value="flat">

                                                        <div class="row push">
                                                            <div class="col-lg-1">
                                                                <label>ผู้เข้าพัก</label>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <select name="INFMATION_PERSON_HRID"
                                                                    id="INFMATION_PERSON_HRID"
                                                                    class="form-control input-lg fo13" required>
                                                                    <option value="">--กรุณาเลือกผู้เข้าพัก--</option>


                                                                    @foreach ($inforpersons as $inforperson)
                                                                    <option value="{{ $inforperson->ID  }}">
                                                                        {{ $inforperson->HR_FNAME}}
                                                                        {{ $inforperson->HR_LNAME}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label>สถานะ</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <select name="INFMATION_PERSON_STATUS"
                                                                    id="INFMATION_PERSON_STATUS"
                                                                    class="form-control input-lg fo13" required>
                                                                    <option value="1">ปกติ</option>
                                                                    <option value="2">ย้ายออกแล้ว</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label>วันที่เข้า</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input name="INFMATION_PERSON_INDATE"
                                                                    id="INFMATION_PERSON_INDATE"
                                                                    class="form-control input-lg datepicker fo13"
                                                                    readonly>
                                                            </div>

                                                        </div>
                                                </div>



                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                                            class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger foo15"
                                                        data-dismiss="modal"><i
                                                            class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </form>


                                @if($type_check == 'checkoutsider')
                                <div class="tab-pane active" id="object2" role="tabpanel">
                                    @else
                                    <div class="tab-pane" id="object2" role="tabpanel">
                                        @endif
                                        <button type="button" class="btn btn-hero-sm btn-hero-info"
                                            style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;"
                                            data-toggle="modal" data-target="#preson_out"><i class="fas fa-plus"></i>
                                            เพิ่มข้อมูล</button>
                                        <br><br>
                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                            <thead style="background-color: #FFEBCD;">
                                                <tr height="40">
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">ลำดับ</td>
                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        ชื่อ-นามสกุล</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">ความสัมพันธ์</td>
                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        สัมพันธ์กับ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">สถานะ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">คำสั่ง</td>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody1">
                                                <?php $number = 0; ?>
                                                @foreach ($infoguesthousoutsiders as $infoguesthousoutsider)
                                                <?php $number++; ?>

                                                <tr height="20">
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">
                                                        {{$number}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{$infoguesthousoutsider->INFMATION_OUTSIDER_NAME}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{$infoguesthousoutsider->INFMATION_OUTSIDER_RELATION}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{ $infoguesthousoutsider->HR_FNAME}}
                                                        {{ $infoguesthousoutsider->HR_LNAME}}
                                                    </td>

                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        @if($infoguesthousoutsider->STATUS == 'false')

                                                        <span class="badge badge-info">ย้ายออกแล้ว</span>
                                                        @else
                                                        <span class="badge badge-success">ปกติ</span>
                                                        @endif

                                                    </td>

                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-outline-info dropdown-toggle"
                                                                id="dropdown-align-outline-info" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                                ทำรายการ
                                                            </button>
                                                            <div class="dropdown-menu" style="width:10px">
                                                                <a class="dropdown-item" href="" data-toggle="modal"
                                                                    data-target="#editpreson_out{{$infoguesthousoutsider->INFMATION_OUTSIDER_ID}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('manager_guesthouse/guesthouserequestdetail_destroyoutsider/'.$infoguesthouse->INFMATION_ID.'/flat/'.$infoguesthousperson->LOCATION_LEVEL_ID.'/'.$infoguesthousperson->LEVEL_ROOM_ID.'/'.$infoguesthousoutsider->INFMATION_OUTSIDER_ID)}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                                    onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <div id="editpreson_out{{$infoguesthousoutsider->INFMATION_OUTSIDER_ID}}"
                                                    class="modal fade " role="dialog"
                                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="margin-left: 20px">
                                                                <h5 style="font-family: 'Kanit', sans-serif;">
                                                                    แก้ไขข้อมูลบุคคลอื่น</h2>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="post"
                                                                    action="{{ route('mguesthouse.guesthouserequestdetail_updateoutsider') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="INFMATION_ID"
                                                                        id="INFMATION_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthouse->INFMATION_ID}}">
                                                                    <input type="hidden" name="ID" id="ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{ $infoguesthousoutsider->INFMATION_OUTSIDER_ID}}">
                                                                    <input type="hidden" name="LOCATION_LEVEL_ID"
                                                                        id="LOCATION_LEVEL_ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$level_id}}">
                                                                    <input type="hidden" name="LEVEL_ROOM_ID"
                                                                        id="LEVEL_ROOM_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$room_id}}">

                                                                    <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="flat">
                                                                    <div class="row push">
                                                                        <div class="col-lg">
                                                                            <label>ชื่อ-นามสกุล</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <input name="INFMATION_OUTSIDER_NAME"
                                                                                id="INFMATION_OUTSIDER_NAME"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{ $infoguesthousoutsider->INFMATION_OUTSIDER_NAME}}">
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <label>ความสัมพันธ์</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input name="INFMATION_OUTSIDER_RELATION"
                                                                                id="INFMATION_OUTSIDER_RELATION"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{$infoguesthousoutsider->INFMATION_OUTSIDER_RELATION}}">
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <label>สัมพันธ์กับ</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <select
                                                                                name="INFMATION_OUTSIDER_RELATIONADD"
                                                                                id="INFMATION_OUTSIDER_RELATIONADD"
                                                                                class="form-control input-lg fo13">
                                                                                <option value="">
                                                                                    --กรุณาเลือกผู้เข้าพัก--</option>
                                                                                @foreach ($inforpersons as $inforperson)
                                                                                @if($inforperson->ID ==
                                                                                $infoguesthousoutsider->INFMATION_OUTSIDER_RELATIONADD)
                                                                                <option value="{{ $inforperson->ID  }}"
                                                                                    selected>{{ $inforperson->HR_FNAME}}
                                                                                    {{ $inforperson->HR_LNAME}}</option>
                                                                                @else
                                                                                <option value="{{ $inforperson->ID  }}">
                                                                                    {{ $inforperson->HR_FNAME}}
                                                                                    {{ $inforperson->HR_LNAME}}</option>
                                                                                @endif

                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-hero-sm btn-hero-info foo15"><i
                                                                        class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                <button type="button"
                                                                    class="btn btn-hero-sm btn-hero-danger foo15"
                                                                    data-dismiss="modal"><i
                                                                        class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    </form>
                                    @endforeach
                                    </tbody>
                                    </table>
                                    <div id="preson_out" class="modal fade " role="dialog"
                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header" style="margin-left: 20px">
                                                    <h5 style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลบุคคลอื่น
                                                    </h5>
                                                </div>
                                                <div class="modal-body">

                                                    <form method="post"
                                                        action="{{ route('mguesthouse.guesthouserequestdetail_saveoutsider') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="INFMATION_ID" id="INFMATION_ID"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$infoguesthouse->INFMATION_ID}}">

                                                        <input type="hidden" name="LOCATION_LEVEL_ID"
                                                            id="LOCATION_LEVEL_ID" class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$level_id}}">
                                                        <input type="hidden" name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$room_id}}">

                                                        <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;" value="flat">


                                                        <div class="row push">
                                                            <div class="col-lg">
                                                                <label>ชื่อ-นามสกุล</label>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input name="INFMATION_OUTSIDER_NAME"
                                                                    id="INFMATION_OUTSIDER_NAME"
                                                                    class="form-control input-lg fo13" required>
                                                            </div>
                                                            <div class="col-lg">
                                                                <label>ความสัมพันธ์</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input name="INFMATION_OUTSIDER_RELATION"
                                                                    id="INFMATION_OUTSIDER_RELATION"
                                                                    class="form-control input-lg fo13" required>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label>สัมพันธ์กับ</label>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <select name="INFMATION_OUTSIDER_RELATIONADD"
                                                                    id="INFMATION_OUTSIDER_RELATIONADD"
                                                                    class="form-control input-lg fo13" required>
                                                                    <option value="">--กรุณาเลือกผู้เข้าพัก--</option>
                                                                    @foreach ($inforpersons as $inforperson)
                                                                    <option value="{{ $inforperson->ID  }}">
                                                                        {{ $inforperson->HR_FNAME}}
                                                                        {{ $inforperson->HR_LNAME}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                                            class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger foo15"
                                                        data-dismiss="modal"><i
                                                            class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </form>
                                @if($type_check == 'checkasset')
                                <div class="tab-pane active" id="object3" role="tabpanel">
                                    @else
                                    <div class="tab-pane" id="object3" role="tabpanel">
                                        @endif

                                        <button type="button" class="btn btn-hero-sm btn-hero-info"
                                            style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;"
                                            data-toggle="modal" data-target="#asset_in"><i class="fas fa-plus"></i>
                                            เพิ่มข้อมูล</button>
                                        <br><br>
                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                            <thead style="background-color: #FFEBCD;">
                                                <tr height="40">
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">ลำดับ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="15%">เลขอ้างอิง</td>
                                                    <td style="text-align: center;">รายการ</td>

                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">มูลค่า</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">วันที่ซื้อ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">วันที่จำหน่าย</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">สถานะ</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">คำสั่ง</td>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody3">
                                                <?php $number = 0; ?>
                                                @foreach ($infoguesthousassets as $infoguesthousasset)
                                                <?php $number++; ?>

                                                <tr height="20">
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">
                                                        {{$number}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="15%">
                                                        {{$infoguesthousasset->INFMATION_ASSET_NUMBER}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{$infoguesthousasset->INFMATION_ASSET_NAME}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        {{number_format($infoguesthousasset->INFMATION_ASSET_VALUE,2)}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        {{DateThai($infoguesthousasset->INFMATION_ASSET_BUYDATE)}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        @if($infoguesthousasset->INFMATION_ASSET_DISDATE != '' ||
                                                        $infoguesthousasset->INFMATION_ASSET_DISDATE != null)
                                                        {{DateThai($infoguesthousasset->INFMATION_ASSET_DISDATE)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="10%">
                                                        @if($infoguesthousasset->INFMATION_ASSET_STATUS == '1')
                                                        <span class="badge badge-success">ปกติ</span>
                                                        @elseif($infoguesthousasset->INFMATION_ASSET_STATUS == '2')
                                                        <span class="badge badge-info">ซ่อมแซม</span>
                                                        @else
                                                        <span class="badge badge-danger">จำหน่าย</span>
                                                        @endif
                                                    </td>


                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-outline-info dropdown-toggle"
                                                                id="dropdown-align-outline-info" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                                ทำรายการ
                                                            </button>
                                                            <div class="dropdown-menu" style="width:10px">
                                                                <a class="dropdown-item" href="" data-toggle="modal"
                                                                    data-target="#editasset_in{{$infoguesthousasset->INFMATION_ASSET_ID}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                                <!-- {{-- <a class="dropdown-item" href="{{ url('manager_guesthouse/guesthouserequestdetail_destroyasset/'.$infoguesthouse->INFMATION_ID.'/flat/'.$infoguesthousperson->LOCATION_LEVEL_ID.'/'.$infoguesthousperson->LEVEL_ROOM_ID.'/'.$infoguesthousasset->INFMATION_ASSET_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>                                                    --}} -->

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <div id="editasset_in{{$infoguesthousasset->INFMATION_ASSET_ID}}"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="margin-left: 20px">
                                                                <h5 style="font-family: 'Kanit', sans-serif;">
                                                                    แก้ไขรายการครุภัณฑ์</h5>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="post"
                                                                    action="{{ route('mguesthouse.guesthouserequestdetail_updateasset') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="INFMATION_ID"
                                                                        id="INFMATION_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthouse->INFMATION_ID}}">

                                                                    <input type="hidden" name="LOCATION_LEVEL_ID"
                                                                        id="LOCATION_LEVEL_ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$level_id}}">
                                                                    <input type="hidden" name="LEVEL_ROOM_ID"
                                                                        id="LEVEL_ROOM_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$room_id}}">

                                                                    <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="flat">
                                                                    <input type="hidden" name="ID" id="ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthousasset->INFMATION_ASSET_ID}}">

                                                                    <div class="row push">
                                                                        <div class="col-lg">
                                                                            <label>เลขอ้างอิง</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input name="INFMATION_ASSET_NUMBER"
                                                                                id="INFMATION_ASSET_NUMBER"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{$infoguesthousasset->INFMATION_ASSET_NUMBER}}">
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <label>รายการ</label>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input name="INFMATION_ASSET_NAME"
                                                                                id="INFMATION_ASSET_NAME"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{$infoguesthousasset->INFMATION_ASSET_NAME}}">
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <label>มูลค่า</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input name="INFMATION_ASSET_VALUE"
                                                                                id="INFMATION_ASSET_VALUE"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{$infoguesthousasset->INFMATION_ASSET_VALUE}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row push">
                                                                        <div class="col-lg">
                                                                            <label>วันที่ซื้อ</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <input name="INFMATION_ASSET_BUYDATE"
                                                                                id="INFMATION_ASSET_BUYDATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                value="{{ formate($infoguesthousasset->INFMATION_ASSET_BUYDATE)}}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <label>วันที่จำหน่าย</label>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            @if($infoguesthousasset->INFMATION_ASSET_DISDATE
                                                                            == '' ||
                                                                            $infoguesthousasset->INFMATION_ASSET_DISDATE
                                                                            == null)
                                                                            <input name="INFMATION_ASSET_DISDATE"
                                                                                id="INFMATION_ASSET_DISDATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                readonly>
                                                                            @else
                                                                            <input name="INFMATION_ASSET_DISDATE"
                                                                                id="INFMATION_ASSET_DISDATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                value="{{formate($infoguesthousasset->INFMATION_ASSET_DISDATE)}}"
                                                                                readonly>
                                                                            @endif

                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <label>สถานะ</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <select name="INFMATION_ASSET_STATUS"
                                                                                id="INFMATION_ASSET_STATUS"
                                                                                class="form-control input-lg fo13">
                                                                                @if($infoguesthousasset->INFMATION_ASSET_STATUS
                                                                                == '1')<option value="1" selected>ปกติ
                                                                                </option> @else<option value="1">ปกติ
                                                                                </option>@endif
                                                                                @if($infoguesthousasset->INFMATION_ASSET_STATUS
                                                                                == '2')<option value="2" selected>
                                                                                    ซ่อมแซม</option> @else<option
                                                                                    value="2">ซ่อมแซม</option>@endif
                                                                                @if($infoguesthousasset->INFMATION_ASSET_STATUS
                                                                                == '3')<option value="3" selected>
                                                                                    จำหน่าย</option>@else<option
                                                                                    value="3">จำหน่าย</option>@endif
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            &nbsp;
                                                                        </div>

                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-hero-sm btn-hero-info foo15"><i
                                                                        class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                <button type="button"
                                                                    class="btn btn-hero-sm btn-hero-danger foo15"
                                                                    data-dismiss="modal"><i
                                                                        class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    </form>
                                    @endforeach
                                    </tbody>
                                    </table>

                                    <div id="asset_in" class="modal fade " tabindex="-1" role="dialog"
                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header" style="margin-left: 20px">
                                                    <h5 style="font-family: 'Kanit', sans-serif;">เพิ่มรายการครุภัณฑ์
                                                    </h5>
                                                </div>
                                                <div class="modal-body">

                                                    <form method="post"
                                                        action="{{ route('mguesthouse.guesthouserequestdetail_saveasset') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="INFMATION_ID" id="INFMATION_ID"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$infoguesthouse->INFMATION_ID}}">

                                                        <input type="hidden" name="LOCATION_LEVEL_ID"
                                                            id="LOCATION_LEVEL_ID" class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$level_id}}">
                                                        <input type="hidden" name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;"
                                                            value="{{$room_id}}">

                                                        <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                            class="form-control input-lg"
                                                            style=" font-family: 'Kanit', sans-serif;" value="flat">


                                                        <div class="row push">
                                                            <div class="col-lg-1">
                                                                <label>เลขอ้างอิง</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input name="INFMATION_ASSET_NUMBER"
                                                                    id="INFMATION_ASSET_NUMBER"
                                                                    class="form-control input-lg fo13" required>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label>รายการ</label>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <input name="INFMATION_ASSET_NAME"
                                                                    id="INFMATION_ASSET_NAME"
                                                                    class="form-control input-lg fo13" required>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label>มูลค่า</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input name="INFMATION_ASSET_VALUE"
                                                                    id="INFMATION_ASSET_VALUE"
                                                                    class="form-control input-lg fo13" required>
                                                            </div>
                                                        </div>
                                                        <div class="row push">
                                                            <div class="col-lg-1">
                                                                <label>วันที่ซื้อ</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input name="INFMATION_ASSET_BUYDATE"
                                                                    id="INFMATION_ASSET_BUYDATE"
                                                                    class="form-control input-lg datepicker fo13"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <label>สถานะ</label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <select name="INFMATION_ASSET_STATUS"
                                                                    id="INFMATION_ASSET_STATUS"
                                                                    class="form-control input-lg fo13" required>
                                                                    <option value="1">ปกติ</option>
                                                                    <option value="2">ซ่อมแซม</option>
                                                                    <option value="3">จำหน่าย</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                &nbsp;
                                                            </div>

                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                                            class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-danger foo15"
                                                        data-dismiss="modal"><i
                                                            class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </form>

                                @if($type_check == 'checkrepair')
                                <div class="tab-pane active" id="object4" role="tabpanel">
                                    @else
                                    <div class="tab-pane" id="object4" role="tabpanel">
                                        @endif
                                        <button type="button" class="btn btn-hero-sm btn-hero-info"
                                            style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;"
                                            data-toggle="modal" data-target="#repair_in"><i class="fas fa-plus"></i>
                                            เพิ่มข้อมูล</button>
                                        <br><br>
                                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                                            <thead style="background-color: #FFEBCD;">
                                                <tr height="40">
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="5%">ลำดับ</td>
                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        ซ่อมแซม</td>
                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        มูลค่าซ่อมแซม</td>
                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        วันที่ซ่อม</td>
                                                    <td style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;"
                                                        width="8%">คำสั่ง</td>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody4">
                                                <?php $number = 0; ?>
                                                @foreach ($infoguesthousrepairs as $infoguesthousrepair)
                                                <?php $number++; ?>

                                                <tr height="20">
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{$number}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{$infoguesthousrepair->INFMATION_REPAIR_NAME}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{number_format($infoguesthousrepair->INFMATION_REPAIR_VALUE,2)}}
                                                    </td>
                                                    <td class="text-font text-pedding"
                                                        style="border-color:#F0FFFF;text-align: left;font-size: 13px;border: 1px solid black;">
                                                        {{DateThai($infoguesthousrepair->INFMATION_REPAIR_DATE)}}
                                                    </td>

                                                    <td
                                                        style="border-color:#F0FFFF;text-align: center;font-size: 13px;border: 1px solid black;">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-outline-info dropdown-toggle"
                                                                id="dropdown-align-outline-info" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                                ทำรายการ
                                                            </button>
                                                            <div class="dropdown-menu" style="width:10px">
                                                                <a class="dropdown-item" href="" data-toggle="modal"
                                                                    data-target="#editrepair_in{{$infoguesthousrepair->INFMATION_REPAIR_ID}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('manager_guesthouse/guesthouserequestdetail_destroyrepair/'.$infoguesthouse->INFMATION_ID.'/flat/'.$infoguesthousperson->LOCATION_LEVEL_ID.'/'.$infoguesthousperson->LEVEL_ROOM_ID.'/'.$infoguesthousrepair->INFMATION_REPAIR_ID)}}"
                                                                    style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"
                                                                    onclick="return confirm('ต้องการที่จะลบข้อมูล ?')">ลบ</a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <div id="editrepair_in{{$infoguesthousrepair->INFMATION_REPAIR_ID}}"
                                                    class="modal fade " tabindex="-1" role="dialog"
                                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="margin-left: 20px">
                                                                <h5 style="font-family: 'Kanit', sans-serif;">
                                                                    แก้ไขข้อมูลบันทึกการซ่อม</h5>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="post"
                                                                    action="{{ route('mguesthouse.guesthouserequestdetail_updaterepair') }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="INFMATION_ID"
                                                                        id="INFMATION_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthouse->INFMATION_ID}}">

                                                                    <input type="hidden" name="LOCATION_LEVEL_ID"
                                                                        id="LOCATION_LEVEL_ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$level_id}}">
                                                                    <input type="hidden" name="LEVEL_ROOM_ID"
                                                                        id="LEVEL_ROOM_ID" class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$room_id}}">

                                                                    <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="flat">
                                                                    <input type="hidden" name="ID" id="ID"
                                                                        class="form-control input-lg"
                                                                        style=" font-family: 'Kanit', sans-serif;"
                                                                        value="{{$infoguesthousrepair->INFMATION_REPAIR_ID}}">

                                                                    <div class="row push">
                                                                        <div class="col-lg">
                                                                            <label>ซ่อมแซม</label>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input name="INFMATION_REPAIR_NAME"
                                                                                id="INFMATION_REPAIR_NAME"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{$infoguesthousrepair->INFMATION_REPAIR_NAME}}">
                                                                        </div>
                                                                        <div class="col-lg">
                                                                            <label>มูลค่าซ่อมแซม</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input name="INFMATION_REPAIR_VALUE"
                                                                                id="INFMATION_REPAIR_VALUE"
                                                                                class="form-control input-lg fo13"
                                                                                value="{{$infoguesthousrepair->INFMATION_REPAIR_VALUE}}">
                                                                        </div>

                                                                        <div class="col-lg">
                                                                            <label>วันที่</label>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <input name="INFMATION_REPAIR_DATE"
                                                                                id="INFMATION_REPAIR_DATE"
                                                                                class="form-control input-lg datepicker fo13"
                                                                                value="{{formate($infoguesthousrepair->INFMATION_REPAIR_DATE)}}"
                                                                                readonly>
                                                                        </div>


                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-hero-sm btn-hero-info foo15"><i
                                                                        class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                                <button type="button"
                                                                    class="btn btn-hero-sm btn-hero-danger foo15"
                                                                    data-dismiss="modal"><i
                                                                        class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                    </div>

                                    </form>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>


                                <div id="repair_in" class="modal fade " tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header" style="margin-left: 20px">
                                                <h5 style="font-family: 'Kanit', sans-serif;">เพิ่มข้อมูลบันทึกการซ่อม
                                                    </h2>
                                            </div>
                                            <div class="modal-body">

                                                <form method="post"
                                                    action="{{ route('mguesthouse.guesthouserequestdetail_saverepair') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="INFMATION_ID" id="INFMATION_ID"
                                                        class="form-control input-lg"
                                                        style=" font-family: 'Kanit', sans-serif;"
                                                        value="{{$infoguesthouse->INFMATION_ID}}">

                                                    <input type="hidden" name="LOCATION_LEVEL_ID" id="LOCATION_LEVEL_ID"
                                                        class="form-control input-lg"
                                                        style=" font-family: 'Kanit', sans-serif;"
                                                        value="{{$level_id}}">
                                                    <input type="hidden" name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID"
                                                        class="form-control input-lg"
                                                        style=" font-family: 'Kanit', sans-serif;" value="{{$room_id}}">

                                                    <input type="hidden" name="TYPESAVE" id="TYPESAVE"
                                                        class="form-control input-lg"
                                                        style=" font-family: 'Kanit', sans-serif;" value="flat">


                                                    <div class="row push">
                                                        <div class="col-lg">
                                                            <label>ซ่อมแซม</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input name="INFMATION_REPAIR_NAME"
                                                                id="INFMATION_REPAIR_NAME"
                                                                class="form-control input-lg fo13" required>
                                                        </div>
                                                        <div class="col-lg">
                                                            <label>มูลค่าซ่อมแซม</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input name="INFMATION_REPAIR_VALUE"
                                                                id="INFMATION_REPAIR_VALUE"
                                                                class="form-control input-lg fo13" required>
                                                        </div>

                                                        <div class="col-lg">
                                                            <label>วันที่</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input name="INFMATION_REPAIR_DATE"
                                                                id="INFMATION_REPAIR_DATE"
                                                                class="form-control input-lg datepicker fo13" readonly>
                                                        </div>


                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                                        class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                <button type="button" class="btn btn-hero-sm btn-hero-danger foo15"
                                                    data-dismiss="modal"><i
                                                        class="fas fa-window-close mr-2"></i>ยกเลิก</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            </form>

                            <br>
                        </div>




                        @endsection

                        @section('footer')

                        <script src="{{ asset('select2/select2.min.js') }}"></script>

                        <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}">
                        </script>
                        <script>
                            jQuery(function () {
                                Dashmix.helpers(['masked-inputs']);
                            });
                        </script>

                        <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
                        <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}"
                            charset="UTF-8"></script>



                        <script>
                            $(document).ready(function () {
                                $('select').select2({
                                    width: '100%'
                                });

                            });


                            function detail(id) {

                                $.ajax({
                                    url: "{{route('suplies.detailapp')}}",
                                    method: "GET",
                                    data: {
                                        id: id
                                    },
                                    success: function (result) {
                                        $('#detail').html(result);


                                    }

                                })

                            }


                            $(document).ready(function () {

                                $('.datepicker').datepicker({
                                    format: 'dd/mm/yyyy',
                                    todayBtn: true,
                                    language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                                    thaiyear: true,
                                    autoclose: true //Set เป็นปี พ.ศ.
                                }); //กำหนดเป็นวันปัจุบัน
                            });
                        </script>
                        <script>
                            $('#edit_modal').on('show.bs.modal', function (e) {
                                var Id = $(e.relatedTarget).data('id');
                                var VUTId = $(e.relatedTarget).data('vutid');
                                $(e.currentTarget).find('input[name="ID"]').val(Id);
                                $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

                            });
                        </script>

                        <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>


                        <!-- Page JS Code -->
                        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

                        <script>
                            $(document).ready(function () {
                                $("#myInput").on("keyup", function () {
                                    var value = $(this).val().toLowerCase();
                                    $("#myTable tr").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(
                                            value) > -1)
                                    });
                                });
                            });
                        </script>
                        @endsection