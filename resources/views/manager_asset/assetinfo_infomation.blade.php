<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>


<link rel="stylesheet" id="css-main" href="{{ asset('asset/css/dashmix.css') }}">
<link rel="stylesheet" id="css-theme" href="{{ asset('asset/css/themes/xinspire.css') }}">


<?php

     $yearbudget = date("Y")+543;
     
     $yearnow = date("Y")+543;
     $monthnow = date("m");
     $datenow1 = date("d");
     $timenow = date(" H:i:s");
 
     $datenow = $datenow1.'/'.$monthnow.'/'.$yearnow.' '.$timenow;
 
  //echo $yearbudget;

?>

<style>
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 15px;

    }

    .text-pedding {
        padding-left: 10px;
    }

    .text-font {
        font-size: 13px;
    }




    #pages {
        text-align: center;
    }

    .page {
        width: 90%;
        margin: 10px;
        box-shadow: 0px 0px 5px #000;
        animation: pageIn 1s ease;
        transition: all 1s ease, width 0.2s ease;
    }

    @keyframes pageIn {
        0% {
            transform: translateX(-300px);
            opacity: 0;
        }

        100% {
            transform: translateX(0px);
            opacity: 1;
        }
    }

    #zoom-in {}

    #zoom-percent {
        display: inline-block;
    }

    #zoom-percent::after {
        content: "%";
    }

    #zoom-out {}

    .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
    }
</style>

<br>
<br>
<center>
    <!-- Dynamic Table Simple -->
    <div class="block" style="width: 95%;">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดและแก้ไข ครุภัณฑ์
                    เลขรหัสพัสดุ {{$infoasset->SUP_FSN}}</B></h3>

        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-3" style="text-align: center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <img src="data:image/png;base64,{{chunk_split(base64_encode($infoasset->IMG))}}"
                                    id="image_upload_preview" height="300px" width="80%" />
                            </div>
                            <div class="form-group">
                                <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture" id="picture"
                                    class="form-control">
                            </div>
                        </div>
                        <br>
 
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col">
                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;text-align: left"><span
                                style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;รายละเอียด&nbsp;&nbsp;
                            </span></h2>
                    </div>
                </div>
                <input type="hidden" name="ARTICLE_ID" id="ARTICLE_ID" value="{{$infoasset->ARTICLE_ID}}">
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">รหัสเลขครุภัณฑ์</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->ARTICLE_NUM}}

                    </div>
                    <div class="col">
                        <p style="text-align: left">ปีงบประมาณ</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->YEAR_ID}}
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ชื่อครุภัณฑ์</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->ARTICLE_NAME}}
                    </div>
                    <div class="col">
                        <p style="text-align: left">ลักษณะ</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->ARTICLE_PROP}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">หน่วยนับ</p>
                    </div>
                    <div class="col-md-4">

                        <select name="UNIT_ID" id="UNIT_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกหน่วยนับ--</option>
                            @foreach ($infounits as $infounit)
                            @if($infounit -> SUP_UNIT_ID == $infoasset->UNIT_ID)
                            <option value=" {{ $infounit -> SUP_UNIT_ID }}" selected>{{ $infounit -> SUP_UNIT_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infounit -> SUP_UNIT_ID }}">{{ $infounit -> SUP_UNIT_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">เลขเครื่อง</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->SERIAL_NO}}
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ยี่ห้อครุภัณฑ์</p>
                    </div>
                    <div class="col-md-4">
                        <select name="BRAND_ID" id="BRAND_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกยี่ห้อ--</option>
                            @foreach ($inbrands as $inbrand)
                            @if($inbrand ->BRAND_ID == $infoasset->BRAND_ID)
                            <option value=" {{ $inbrand ->BRAND_ID }}" selected>{{ $inbrand -> BRAND_NAME }}</option>
                            @else
                            <option value=" {{ $inbrand -> BRAND_ID }}">{{ $inbrand -> BRAND_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">สีครุภัณฑ์</p>
                    </div>
                    <div class="col-md-4">
                        <select name="COLOR_ID" id="COLOR_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกสี--</option>
                            @foreach ($infocolors as $infocolor)
                            @if($infocolor ->COLOR_ID == $infoasset->COLOR_ID)
                            <option value=" {{ $infocolor ->COLOR_ID }}" selected>{{ $infocolor -> COLOR_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infocolor -> COLOR_ID }}">{{ $infocolor -> COLOR_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">รุ่น</p>
                    </div>
                    <div class="col-md-4">
                        <select name="MODEL_ID" id="MODEL_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกรุ่น--</option>
                            @foreach ($inmodels as $inmodel)
                            @if($inmodel ->MODEL_ID == $infoasset->MODEL_ID)
                            <option value=" {{ $inmodel ->MODEL_ID }}" selected>{{ $inmodel -> MODEL_NAME }}</option>
                            @else
                            <option value=" {{ $inmodel -> MODEL_ID }}">{{ $inmodel -> MODEL_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">ขนาด</p>
                    </div>
                    <div class="col-md-4">
                        <select name="SIZE_ID" id="SIZE_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกขนาด--</option>
                            @foreach ($infosizes as $infosize)
                            @if($infosize ->SIZE_ID == $infoasset->SIZE_ID)
                            <option value=" {{ $infosize ->SIZE_ID }}" selected>{{ $infosize -> SIZE_NAME }}</option>
                            @else
                            <option value=" {{ $infosize -> SIZE_ID }}">{{ $infosize -> SIZE_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ราคา</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->PRICE_PER_UNIT}}
                    </div>
                    <div class="col">
                        <p style="text-align: left">วันที่รับเข้า</p>
                    </div>
                    <div class="col-md-4">
                        {{formate($infoasset->RECEIVE_DATE)}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">วิธีได้มา</p>
                    </div>
                    <div class="col-md-4">
                        <select name="METHOD_ID" id="METHOD_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกวิธีได้มา--</option>
                            @foreach ($infomethods as $infomethod)
                            @if($infomethod ->METHOD_ID == $infoasset->METHOD_ID)
                            <option value=" {{ $infomethod ->METHOD_ID }}" selected>{{ $infomethod -> METHOD_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infomethod -> METHOD_ID }}">{{ $infomethod -> METHOD_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">การจัดซื้อ</p>
                    </div>
                    <div class="col-md-4">
                        <select name="BUY_ID" id="BUY_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกการจัดซื้อ--</option>
                            @foreach ($infobuys as $infobuy)
                            @if($infobuy ->BUY_ID == $infoasset->BUY_ID)
                            <option value=" {{ $infobuy ->BUY_ID }}" selected>{{ $infobuy -> BUY_NAME }}</option>
                            @else
                            <option value=" {{ $infobuy -> BUY_ID }}">{{ $infobuy -> BUY_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">งบที่ใช้</p>
                    </div>
                    <div class="col-md-4">
                        <select name="BUDGET_ID" id="BUDGET_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกงบ--</option>
                            @foreach ($infobudgets as $infobudget)
                            @if($infobudget ->BUDGET_ID == $infoasset->BUDGET_ID)
                            <option value=" {{ $infobudget ->BUDGET_ID }}" selected>{{ $infobudget -> BUDGET_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infobudget -> BUDGET_ID }}">{{ $infobudget -> BUDGET_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">ประเภท</p>
                    </div>
                    <div class="col-md-4">
                        <select name="TYPE_ID" id="TYPE_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกประเภท--</option>
                            @foreach ($infotypes as $infotype)
                            @if($infotype ->SUP_TYPE_ID == $infoasset->TYPE_ID)
                            <option value=" {{ $infotype -> SUP_TYPE_ID }}" selected>{{ $infotype -> SUP_TYPE_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infotype -> SUP_TYPE_ID }}">{{ $infotype -> SUP_TYPE_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ประเภทค่าเสื่อม</p>
                    </div>
                    <div class="col-md-4">
                        <select name="DECLINE_ID" id="DECLINE_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกค่าเสื่อม--</option>
                            @foreach ($infodeclines as $infodecline)
                            @if($infodecline ->DECLINE_ID == $infoasset->DECLINE_ID)
                            <option value=" {{ $infodecline ->DECLINE_ID }}" selected>{{ $infodecline -> DECLINE_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infodecline -> DECLINE_ID }}">{{ $infodecline -> DECLINE_NAME }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">ผู้จำหน่าย</p>
                    </div>
                    <div class="col-md-4">
                        <select name="VENDOR_ID" id="VENDOR_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกผู้จำหน่าย--</option>
                            @foreach ($infovendors as $infovendor)
                            @if($infovendor ->VENDOR_ID == $infoasset->VENDOR_ID)
                            <option value=" {{ $infovendor ->VENDOR_ID }}" selected>{{ $infovendor -> VENDOR_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infovendor -> VENDOR_ID }}">{{ $infovendor -> VENDOR_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ประจำหน่วยงาน</p>
                    </div>
                    <div class="col-md-4">
                        <select name="DEP_ID" id="DEP_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกหน่วยงาน--</option>
                            @foreach ($infodeps as $infodep)
                            @if($infodep ->HR_DEPARTMENT_SUB_SUB_ID == $infoasset->DEP_ID)
                            <option value=" {{ $infodep ->HR_DEPARTMENT_SUB_SUB_ID }}" selected>
                                {{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @else
                            <option value=" {{ $infodep ->HR_DEPARTMENT_SUB_SUB_ID }}">
                                {{ $infodep -> HR_DEPARTMENT_SUB_SUB_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">อาคาร</p>
                    </div>
                    <div class="col-md-4">
                        <select name="LOCATION_ID" id="LOCATION_ID"
                            class="form-control input-lg location js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกอาคาร--</option>
                            @foreach ($infolocations as $infolocation)
                            @if($infolocation ->LOCATION_ID == $infoasset->LOCATION_ID)
                            <option value=" {{ $infolocation ->LOCATION_ID }}" selected>
                                {{ $infolocation -> LOCATION_NAME }}</option>
                            @else
                            <option value=" {{ $infolocation -> LOCATION_ID }}">{{ $infolocation -> LOCATION_NAME }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ชั้น</p>
                    </div>
                    <div class="col-md-4">
                        <select name="LOCATION_LEVEL_ID" id="LOCATION_LEVEL_ID"
                            class="form-control input-lg locationlevel js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกชั้น--</option>
                            @foreach ($infolocationlevels as $infolocationlevel)
                            @if($infolocationlevel ->LOCATION_LEVEL_ID == $infoasset->LOCATION_LEVEL_ID)
                            <option value=" {{ $infolocationlevel ->LOCATION_LEVEL_ID }}" selected>
                                {{ $infolocationlevel -> LOCATION_LEVEL_NAME }}</option>
                            @else
                            <option value=" {{ $infolocationlevel -> LOCATION_LEVEL_ID }}">
                                {{ $infolocationlevel -> LOCATION_LEVEL_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">ห้อง</p>
                    </div>
                    <div class="col-md-4">
                        <select name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID"
                            class="form-control input-lg locationlevelroom js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกห้อง--</option>
                            @foreach ($infolocationlevelrooms as $infolocationlevelroom)
                            @if($infolocationlevelroom ->LEVEL_ROOM_ID == $infoasset->LEVEL_ROOM_ID)
                            <option value=" {{ $infolocationlevelroom ->LEVEL_ROOM_ID }}" selected>
                                {{ $infolocationlevelroom -> LEVEL_ROOM_NAME }}</option>
                            @else
                            <option value=" {{ $infolocationlevelroom -> LEVEL_ROOM_ID }}">
                                {{ $infolocationlevelroom -> LEVEL_ROOM_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">ผู้รับผิดชอบ</p>
                    </div>
                    <div class="col-md-4">
                        <select name="PERSON_ID" id="PERSON_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกผู้รับผิดชอบ--</option>
                            @foreach ($infopersons as $infoperson)
                            @if($infoperson ->ID == $infoasset->PERSON_ID)
                            <option value=" {{ $infoperson ->ID }}" selected>{{ $infoperson -> HR_FNAME }}
                                {{ $infoperson -> HR_LNAME }}</option>
                            @else
                            <option value=" {{ $infoperson -> ID }}">{{ $infoperson -> HR_FNAME }}
                                {{ $infoperson -> HR_LNAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">หมายเหตุ</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->REMARK}}
                    </div>
                </div>
                <br>
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;text-align: left"><span
                        style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;สภาพครุภัณฑ์&nbsp;&nbsp;</span></h2>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">สถานะการใช้งาน</p>
                    </div>
                    <div class="col-md-4">
                        <select name="STATUS_ID" id="STATUS_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกสถานะ--</option>
                            @foreach ($infostatuss as $infostatus)
                            @if($infostatus ->STATUS_ID == $infoasset->STATUS_ID)
                            <option value=" {{ $infostatus ->STATUS_ID }}" selected>{{ $infostatus -> STATUS_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infostatus -> STATUS_ID }}">{{ $infostatus -> STATUS_NAME }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">อายุการใช้งาน</p>
                    </div>
                    <div class="col-md-4">
                        {{$infoasset->OLD_USE}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p style="text-align: left">หมดสภาพ</p>
                    </div>
                    <div class="col-md-4">
                        {{formate($infoasset->EXPIRE_DATE)}}
                    </div>
                </div>
                <br>
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;text-align: left"><span
                        style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;การตรวจสอบบำรุงรักษา&nbsp;&nbsp;</span>
                </h2>
                <div class="row">
                    <div class="col">
                        <p style="text-align: left">การบำรุงรักษา PM</p>
                    </div>
                    <div class="col-md-4">
                        <select name="PM_TYPE_ID" id="PM_TYPE_ID" class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือก--</option>
                            @foreach ($infogrouppms as $infogrouppm)
                            @if($infogrouppm ->PM_TYPE_ID == $infoasset->PM_TYPE_ID)
                            <option value=" {{ $infogrouppm ->PM_TYPE_ID }}" selected>{{ $infogrouppm -> PM_TYPE_NAME }}
                            </option>
                            @else
                            <option value=" {{ $infogrouppm -> PM_TYPE_ID }}">{{ $infogrouppm -> PM_TYPE_NAME }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p style="text-align: left">การสอบเทียบ CAL</p>
                    </div>
                    <div class="col-md-4">
                        <select name="CAL_TYPE_ID" id="CAL_TYPE_ID"
                            class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือก--</option>
                            @foreach ($infogroupcals as $infogroupcal)
                            @if($infogroupcal ->CAL_TYPE_ID == $infoasset->CAL_TYPE_ID)
                            <option value=" {{ $infogroupcal ->CAL_TYPE_ID }}" selected>
                                {{ $infogroupcal -> CAL_TYPE_NAME }}</option>
                            @else
                            <option value=" {{ $infogroupcal -> CAL_TYPE_ID }}">{{ $infogroupcal -> CAL_TYPE_NAME }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p style="text-align: left">ความเสี่ยง</p>
                    </div>
                    <div class="col-md-4">
                        <select name="RISK_TYPE_ID" id="RISK_TYPE_ID"
                            class="form-control input-lg js-example-basic-single"
                            style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--กรุณาเลือกความเสี่ยง--</option>
                            @foreach ($infogrouprisks as $infogrouprisk)
                            @if($infogrouprisk ->RISK_TYPE_ID == $infoasset->RISK_TYPE_ID)
                            <option value=" {{ $infogrouprisk ->RISK_TYPE_ID }}" selected>
                                {{ $infogrouprisk -> RISK_TYPE_NAME }} </option>
                            @else
                            <option value=" {{ $infogrouprisk -> RISK_TYPE_ID }}">{{ $infogrouprisk -> RISK_TYPE_NAME }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>