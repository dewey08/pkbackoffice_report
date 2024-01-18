@extends('layouts.risk')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
            font-size: 13px;

        }

        label {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;

        }

    </style>

    <script>
        function checklogin() {
            window.location.href = '{{ route('index') }}';
        }

    </script>
    <?php
    if (Auth::check()) {
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;
    } else {
    echo "

    <body onload=\"checklogin()\"></body>";
    exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    $user_id = substr($url, $pos);

    function timeformate($strtime)
    {
    [$a, $b] = explode(':', $strtime);
    return $a . ':' . $b;
    }
    ?>

    <center>
        <div class="block mt-5" style="width: 95%;">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">

                    <div align="left">
                        <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">
                            <B>แก้ไขรายงานอุบัติการณ์ความเสี่ยง</B> ==>> {{ $rigreps->RISKREP_USEREFFECT_FULLNAME }}
                        </h2>
                    </div>

                </div>
                <div class="block-content block-content-full">
                    <form method="post" action="{{ route('mrisk.detail_update') }}" enctype="multipart/form-data">
                        @csrf

                        <input value="{{ $rigreps->RISKREP_ID }}" type="hidden" name="RISKREP_ID" id="RISKREP_ID"
                            class="form-control input-lg">

                        <div class="row push text-left">
                            <div class="col-sm-2 fo14">
                                <label for="RISKREP_NO ">Risk no. :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input type="text" name="RISKREP_NO" id="RISKREP_NO" class="form-control input-sm fo13"
                                    value="{{ $rigreps->RISKREP_NO }}" readonly>
                            </div>

                            <div class="col-sm-1">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่บันทึก:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input name="RISKREP_DATESAVE" id="RISKREP_DATESAVE"
                                    class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy"
                                    value="{{ formate($rigreps->RISKREP_DATESAVE) }}" readonly>

                            </div>
                            <div class="col-sm-2">
                                <label for="RISKREP_DEPARTMENT_SUB"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">หน่วยงานที่รายงาน :</label>
                            </div>
                            <div class="col-lg-3 ">
                                @foreach($departsubs as $departsub)
                                <input type="text" class="form-control input-sm fo13" name="" id="" value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_NAME}}" readonly>
                                <input type="hidden" class="form-control input-sm fo13" name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB" value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_ID}}" >
                                @endforeach                  
                            </div>
                        </div>
                        <div class="row push text-left">
                           
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">แหล่งที่มา/วิธีการค้นพบ
                                    :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_SEARCHLOCATE" id="RISKREP_SEARCHLOCATE"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--เลือก--</option>
                                    @foreach ($locations as $location)
                                        @if ($location->INCIDENCE_LOCATION_ID == $rigreps->RISKREP_SEARCHLOCATE)
                                            <option value="{{ $location->INCIDENCE_LOCATION_ID }}" selected>
                                                {{ $location->INCIDENCE_LOCATION_NAME }} </option>
                                        @else
                                            <option value="{{ $location->INCIDENCE_LOCATION_ID }}">
                                                {{ $location->INCIDENCE_LOCATION_NAME }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-1">
                                <label for="RISKREP_TYPE"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ประเภทสถานที่:</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_TYPE" id="RISKREP_TYPE"
                                    class="form-control js-example-basic-single typelocation fo13" style="width: 100%"
                                    required>
                                    @foreach ($typelocations as $typelocation)

                                        @if ($typelocation->SETUP_TYPELOCATION_ID == $rigreps->RISKREP_TYPE)

                                            <option value="{{ $typelocation->SETUP_TYPELOCATION_ID }}" selected>
                                                {{ $typelocation->SETUP_TYPELOCATION_NAME }} </option>
                                        @else
                                            <option value="{{ $typelocation->SETUP_TYPELOCATION_ID }}">
                                                {{ $typelocation->SETUP_TYPELOCATION_NAME }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISKREP_STARTDATE"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่เกิดอุบัติการณ์ความเสี่ยง
                                </label><label style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input name="RISKREP_STARTDATE" id="RISKREP_STARTDATE"
                                    class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy"
                                    value="{{ formate( $rigreps->RISKREP_STARTDATE ) }}" readonly>
                            </div>
                            <div class="col-sm-1">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่ค้นพบ </label><label
                                    style="color:red;"> *</label><label> :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <input name="RISKREP_DIGDATE" id="RISKREP_DIGDATE"
                                    class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy"
                                    value="{{ formate($rigreps->RISKREP_DIGDATE) }}" readonly>
                            </div>

                            <div class="col-sm-2">
                                <label for="RISKREP_LOCAL"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ชนิดสถานที่ </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-3 ">
                                <select name="RISKREP_LOCAL" id="RISKREP_LOCAL"
                                    class="form-control js-example-basic-single typelocationdetail fo13" required>
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($grouplocations as $grouplocation)
                                        @if ($rigreps->RISKREP_LOCAL == $grouplocation->RISK_LOCATION_ID)
                                            <option value="{{ $grouplocation->RISK_LOCATION_ID }}" selected>
                                                {{ $grouplocation->RISK_LOCATION_CODE }} ::
                                                {{ $grouplocation->RISK_LOCATION_NAME }}</option>

                                        @else
                                            <option value="{{ $grouplocation->RISK_LOCATION_ID }}">
                                                {{ $grouplocation->RISK_LOCATION_CODE }} ::
                                                {{ $grouplocation->RISK_LOCATION_NAME }}</option>

                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">สถานที่เกิดเหตุ อาคาร :</label>
                            </div>
                    
                            <div class="col-lg-2 ">     
                    
                                <select name="RISKREP_LOCATION_ID" id="RISKREP_LOCATION_ID" class="form-control input-lg location "
                                style=" font-family: 'Kanit', sans-serif;" onchange="locationsee();" >
                                <!-- {{-- <select name="LOCATION_SEE_ID" id="LOCATION_SEE_ID" class="form-control input-lg location {{ $errors->has('LOCATION_SEE_ID') ? 'is-invalid' : '' }}"
                                style=" font-family: 'Kanit', sans-serif;" onchange="locationsee();" > --}} -->
                                <option value="">--กรุณาเลือกสถานที่--</option>
                                @foreach ($infolocations as $infolocation)
                                 @if($infolocation->LOCATION_ID == $rigreps->RISKREP_LOCATION_ID)
                                 <option value="{{$infolocation->LOCATION_ID}}" selected>{{ $infolocation->LOCATION_NAME}}</option>
                                 @else 
                                 <option value="{{$infolocation->LOCATION_ID}}">{{ $infolocation->LOCATION_NAME}}</option>
                                 @endif
                                
                                @endforeach
                            </select>
                    
                            </div>
                    
                            <div class="col-sm-1">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ชั้น :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_LOCATION_LEVEL" id="RISKREP_LOCATION_LEVEL"
                                class="form-control input-lg locationlevel" style=" font-family: 'Kanit', sans-serif;"
                                >
                                <!-- {{-- <select name="LOCATIONLEVEL_SEE_ID" id="LOCATIONLEVEL_SEE_ID" class="form-control input-lg locationlevel {{ $errors->has('LOCATIONLEVEL_SEE_ID') ? 'is-invalid' : '' }}"
                                style=" font-family: 'Kanit', sans-serif;" > --}} -->
                                <option value="">--กรุณาเลือกชั้น--</option>
                                @foreach ($infolocationlevels as $infolocationlevel)
                                  @if($infolocationlevel->LOCATION_LEVEL_ID == $rigreps->RISKREP_LOCATION_LEVEL )
                                    <option value="{{$infolocationlevel->LOCATION_LEVEL_ID}}" selected>{{$infolocationlevel->LOCATION_LEVEL_NAME}}</option>
                                  @else
                                    <option value="{{$infolocationlevel->LOCATION_LEVEL_ID}}">{{$infolocationlevel->LOCATION_LEVEL_NAME}}</option>
                                  @endif
                                @endforeach
                            </select>
                            </div>
                    
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ห้อง :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISKREP_LOCATION_LEVEL_ROOM" id="RISKREP_LOCATION_LEVEL_ROOM"
                            class="form-control input-lg locationlevelroom " style=" font-family: 'Kanit', sans-serif;"
                            >
                            {{-- <select name="LOCATIONLEVELROOM_SEE_ID" id="LOCATIONLEVELROOM_SEE_ID" class="form-control input-lg locationlevelroom {{ $errors->has('LOCATIONLEVELROOM_SEE_ID') ? 'is-invalid' : '' }}"
                            style=" font-family: 'Kanit', sans-serif;" > --}}
                            <option value="">--กรุณาเลือกห้อง--</option>
                            @foreach ($infolocationlevelrooms as $infolocationlevelroom)
                                    @if($infolocationlevelroom->LEVEL_ROOM_ID == $rigreps->RISKREP_LOCATION_LEVEL_ROOM  )
                                        <option value="{{$infolocationlevelroom->LEVEL_ROOM_ID}}" selected>{{$infolocationlevelroom->LEVEL_ROOM_NAME}}</option>
                                    @else
                                        <option value="{{$infolocationlevelroom->LEVEL_ROOM_ID}}">{{$infolocationlevelroom->LEVEL_ROOM_NAME}}</option>
                                    @endif
                    
                            @endforeach
                        </select>
                            </div>
                    
                        </div>
                        <div class="row push text-left">
                            
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">พื้นที่นอกโรงพยาบาล :</label>
                            </div>
                            <div class="col-lg-10"> 
                                <input class="form-control" style="font-family:'Kanit',sans-serif;font-size:13px;" name="RISKREP_LOCATION_OTHER" id="RISKREP_LOCATION_OTHER" placeholder="ระบุสถานที่กรณีพื้นที่นอกโรงพยาบาล" value="{{$rigreps->RISKREP_LOCATION_OTHER}}"  >
                            </div>
                        </div>
                    
                            <div class="row push text-left">
                    
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ช่วงเวลา :</label>
                            </div>
                            <div class="col-lg-5 ">
                                <select name="RISKREP_FATE" id="RISKREP_FATE" class="form-control input-sm fo13" required>
                                    <option value="">--เลือก--</option>
                                    @foreach ($worktimes as $worktime)
                                      @if($worktime->RISK_TIME_ID == $rigreps->RISKREP_FATE )
                                      <option value="{{ $worktime->RISK_TIME_ID }}" selected>
                                        {{ $worktime->RISK_TIME_NAME }}</option>
                                      @else
                                            <option value="{{ $worktime->RISK_TIME_ID }}">
                                                {{ $worktime->RISK_TIME_NAME }}</option>
                    
                                      @endif
                                   
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">หรือเวลา :</label>
                            </div>
                            <div class="col-lg-1 ">
                                <input name="RISKREP_TIME" id="RISKREP_TIME" class="js-masked-time form-control fo13" value="{{$rigreps->RISKREP_TIME}}">
                            </div>
                            <div class="col-sm-1">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">เช่น 21.59</label>
                            </div>
                        </div>



                          


                      

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดเหตุการณ์ :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <textarea name="RISKREP_DETAILRISK" id="RISKREP_DETAILRISK"
                                    class="form-control input-lg time fo13" rows="3"
                                    required> {{ $rigreps->RISKREP_DETAILRISK }} </textarea>
                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">การจัดการเบื้องต้น :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <textarea name="RISKREP_BASICMANAGE" id="RISKREP_BASICMANAGE"
                                    class="form-control input-lg time"
                                    style=" font-family:'Kanit', sans-serif;font-size:13px;" rows="3"
                                    required> {{ $rigreps->RISKREP_BASICMANAGE }} </textarea>
                            </div>
                        </div>

                        <hr>
 
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for=""
                                    style="font-family:'Kanit',sans-serif;font-size:15px;color:rgb(0,0,128);">หัวหน้าหน่วยงานตรวจสอบ
                                    :</label>
                            </div>
                            <div class="col-lg-10">
                                <label for=""
                                    style="font-family:'Kanit',sans-serif;font-size:15px;color:rgb(0,0,128);">{{ $rigreps->LEADER_PERSON_NAME }}</label>
                            </div>
                        </div>

                       

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REPPROGRAM_ID"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ลักษณะอุบัติการณ์ </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <select name="RISK_REPPROGRAM_ID" id="RISK_REPPROGRAM_ID"
                                    class="form-control js-example-basic-single program fo13" style="width: 100%" required>
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($riskprograms as $g)
                                        @if ($rigreps->RISK_REPPROGRAM_ID == $g->RISK_REPPROGRAM_ID)
                                            <option value="{{ $g->RISK_REPPROGRAM_ID }}" selected>
                                                {{ $g->RISK_REPPROGRAM_NAME }}</option>
                                        @else
                                            <option value="{{ $g->RISK_REPPROGRAM_ID }}">
                                                {{ $g->RISK_REPPROGRAM_NAME }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REPPROGRAMSUB_ID"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดย่อย 1 </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <select name="RISK_REPPROGRAMSUB_ID" id="RISK_REPPROGRAMSUB_ID"
                                    class="form-control js-example-basic-single programsub fo13" style="width: 100%">
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($riskprogramsubs as $gs)
                                        @if ($rigreps->RISK_REPPROGRAM_ID == $gs->RISK_REPPROGRAM_ID)
                                            <option value="{{ $gs->RISK_REPPROGRAMSUB_ID }}" selected>
                                                {{ $gs->RISK_REPPROGRAMSUB_NAME }}</option>
                                        @else
                                            <option value="{{ $gs->RISK_REPPROGRAMSUB_ID }}">
                                                {{ $gs->RISK_REPPROGRAMSUB_NAME }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REPPROGRAMSUBSUB_ID"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดย่อย2 </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <select name="RISK_REPPROGRAMSUBSUB_ID" id="RISK_REPPROGRAMSUBSUB_ID"
                                    class="form-control js-example-basic-single programsubsub fo13" style="width: 100%">
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($riskprogramsubsubs as $gss)
                                        @if ($rigreps->RISK_REPPROGRAMSUBSUB_ID == $gss->RISK_REPPROGRAMSUBSUB_ID)
                                            <option value="{{ $gss->RISK_REPPROGRAMSUBSUB_ID }}" selected>
                                                {{ $gss->RISK_REPPROGRAMSUBSUB_NAME }}</option>
                                        @else
                                            <option value="{{ $gss->RISK_REPPROGRAMSUBSUB_ID }}">
                                                {{ $gss->RISK_REPPROGRAMSUBSUB_NAME }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REPTYPERESON_ID"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">สาเหตุที่ชัดแจ้ง </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <select name="RISK_REPTYPERESON_ID" id="RISK_REPTYPERESON_ID"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($risktypereasons as $gt)
                                        @if ($rigreps->RISK_REPTYPERESON_ID == $gt->RISK_REPTYPERESON_ID)
                                            <option value="{{ $gt->RISK_REPTYPERESON_ID }}" selected>
                                                {{ $gt->RISK_REPTYPERESON_NAME }}</option>
                                        @else
                                            <option value="{{ $gt->RISK_REPTYPERESON_ID }}">
                                                {{ $gt->RISK_REPTYPERESON_NAME }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REPTYPERESONSYS_ID"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">สาเหตุเชิงระบบ </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <select name="RISK_REPTYPERESONSYS_ID" id="RISK_REPTYPERESONSYS_ID"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($risktypereasonsyss as $gts)
                                    @if ($rigreps->RISK_REPTYPERESONSYS_ID == $gts->RISK_REPTYPERESONSYS_ID)
                                        <option value="{{ $gts->RISK_REPTYPERESONSYS_ID }}" selected>
                                            {{ $gts->RISK_REPTYPERESONSYS_NAME }} ::  {{$gts->RISK_REPTYPERESONSYS_DETAIL}} </option>
                                    @else
                                        <option value="{{ $gts->RISK_REPTYPERESONSYS_ID }}">
                                            {{ $gts->RISK_REPTYPERESONSYS_NAME }} ::  {{$gts->RISK_REPTYPERESONSYS_DETAIL}} </option>
                                    @endif

                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row push text-left">  
                            <div class="col-sm-2">
                                <label for="RISKREP_LEVEL"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ระดับความรุนแรง </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-10 ">
                                <select name="RISKREP_LEVEL" id="RISKREP_LEVEL"
                                    class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                    <option value="">-เลือก-</option>
                                    @foreach ($levels as $item)
                                    @if ($rigreps->RISKREP_LEVEL == $item->RISK_REP_LEVEL_ID)
                                        <option value="{{ $item->RISK_REP_LEVEL_ID }}" selected>
                                            {{ $item->RISK_REP_LEVEL_NAME }} :: {{ $item->RISK_REP_LEVEL_DETAIL}}</option>
                                    @else
                                        <option value="{{ $item->RISK_REP_LEVEL_ID }}">
                                           {{ $item->RISK_REP_LEVEL_NAME }}:: {{ $item->RISK_REP_LEVEL_DETAIL}}</option>
                                    @endif

                                @endforeach
                                </select>
                            </div>
                       
                        </div>
                 
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REP_FEEDBACK"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ข้อเสนอแนะ/รายละเอียดเพิ่มเติม
                                    :</label>
                            </div>
                            <div class="col-lg-9 ">
                                {{-- <p>บันทึกตามรูปแบบเพื่อบอกให้ทราบว่า เกิดอะไร อย่างไร(Free Text) ไม่เกิน 3 บันทัด</p> --}}
                                <textarea name="RISK_REP_FEEDBACK" id="RISK_REP_FEEDBACK"
                                    class="form-control input-lg time fo13 mt-0"
                                    rows="3"> {{ $rigreps->RISK_REP_FEEDBACK }} </textarea>
                            </div>
                        </div>
                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REP_EFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">ผู้ได้รับผลกระทบ </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-2 ">
                                <select name="RISK_REP_EFFECT" id="RISK_REP_EFFECT" class="js-example-basic-single fo13"
                                    style="width: 100%" >
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($uefects as $uefect)
                                        @if ($rigreps->RISK_REP_EFFECT == $uefect->INCEDENCE_USEREFFECT_ID)
                                            <option value="{{ $uefect->INCEDENCE_USEREFFECT_ID }}" selected>
                                                {{ $uefect->INCEDENCE_USEREFFECT_NAME }}</option>
                                        @else
                                            <option value="{{ $uefect->INCEDENCE_USEREFFECT_ID }}">
                                                {{ $uefect->INCEDENCE_USEREFFECT_NAME }} </option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-0.5">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">เพศ </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-1 ">
                                <select name="RISKREP_SEX" id="RISKREP_SEX" class="form-control input-sm"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">
                                    <option value="">--กรุณาเลือก--</option>
                                    @foreach ($sexs as $sex)
                                        @if ($rigreps->RISKREP_SEX == $sex->SEX_ID)
                                            <option value="{{ $sex->SEX_ID }}" selected>{{ $sex->SEX_NAME }} </option>
                                        @else
                                            <option value="{{ $sex->SEX_ID }}">{{ $sex->SEX_NAME }} </option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-0.5">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">อายุ </label><label
                                    style="color:red;"> **</label><label> :</label>
                            </div>
                            <div class="col-lg-1 ">
                                <input name="RISKREP_AGE" id="RISKREP_AGE" class="form-control input-sm fo13"
                                    value="{{ $rigreps->RISKREP_AGE }}">
                            </div>
                            <div class="col-sm-0.5 text-left">
                                <label style="font-family:'Kanit',sans-serif;font-size:13px;">ปี</label>
                            </div>
                            <div class="col-sm-4 text-left">
                                <p>( เศษของปี น้อยกว่า 6 เดือน ไห้นับเป็น 0 ปี ตั้งแต่ 6 เดือนขึ้นไปไห้นับเป็น 1 ปี)</p>
                            </div>
                        </div>

                        <div class="row push text-left">
                            <div class="col-sm-2">
                                <label for="RISK_REP_EFFECT"
                                    style="font-family:'Kanit',sans-serif;font-size:13px;">อ้างอิงบัญชีความเสี่ยง </label> :</label>
                            </div>
                            <div class="col-lg-10 ">

                                <select name="RISKREP_ACC_ID" id="RISKREP_ACC_ID" class="form-control input-sm"
                                style="font-family:'Kanit',sans-serif;font-size:13px;">
                                <option value="">--กรุณาเลือก--</option>
                                @foreach ($inforiskaccs as $inforiskacc)
                                    @if ($rigreps->RISKREP_ACC_ID == $inforiskacc->RISK_ACC_ID)
                                        <option value="{{ $inforiskacc->RISK_ACC_ID }}" selected>{{ $inforiskacc->RISK_ACC_ISSUE }} </option>
                                    @else
                                        <option value="{{ $inforiskacc->RISK_ACC_ID }}">{{ $inforiskacc->RISK_ACC_ISSUE }} </option>
                                    @endif

                                @endforeach
                            </select>
                               
                            </div>
                          
                        </div>


                        <hr>


                        <div class="block-footer ">
                            <div align="right">
                                <button type="submit" class="btn btn-hero-sm btn-hero-info foo15"><i
                                        class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                <a href="{{ url('manager_risk/detail') }}"
                                    onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')"
                                    class="btn btn-hero-sm btn-hero-danger foo15"
                                    onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')"><i
                                        class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                            </div>
                        </div>
                </div>


                <div class="modal fade addlevel" id="addlevel" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modallevel">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-info shadow-lg">
                            <h2 class="modal-title text-white"
                                style="font-family: 'Kanit', sans-serif; font-size:19px;font-size: 1rem;font-weight:normal;color:rgb(0,0,128);">
                                รายละเอียดความรุนแรง</h2>
                        </div>
                        <div class="modal-body">

                            <body>
                                <div style='overflow:scroll; height:300px;'>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;font-size:13px;" width="10%">รหัส
                                                </td>
                                                <td style="text-align: center;font-size:13px;" width="10%">
                                                    ความรุนแรง</th>
                                                <td style="text-align: center;font-size:13px;">รายละเอียด</td>

                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach ($levels as $level)
                                                <tr>
                                                    <td style="text-align: center;font-size:13px;">
                                                        {{ $level->RISK_REP_LEVEL_CODE }}</td>
                                                    <td style="text-align: center;font-size:13px;">
                                                        {{ $level->RISK_REP_LEVEL_NAME }}</td>
                                                    <td style="text-align:left;font-size:13px;">
                                                        {{ $level->RISK_REP_LEVEL_DETAIL }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        </body>
                        <div class="modal-footer ">
                            <div align="right">
                                <a href="" class="btn btn-hero-sm btn-hero-danger foo15" data-dismiss="modal"><i
                                        class="fas fa-window-close mr-2"></i>Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






            @endsection

            @section('footer')

                <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}">
                </script>
                <script>
                    jQuery(function() {
                        Dashmix.helpers(['masked-inputs']);
                    });

                </script>

                <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
                <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8">
                </script>

                <script src="{{ asset('select2/select2.min.js') }}"></script>
                <script>
                    $(document).ready(function() {
                        $('select').select2();
                    });
                    $('#RISKREP_ACC_ID').select2();
                </script>


                <script>
                    function detail(id) {
                        $.ajax({
                            url: "{{ route('suplies.detailapp') }}",
                            method: "GET",
                            data: {
                                id: id
                            },
                            success: function(result) {
                                $('#detail').html(result);
                            }
                        })
                    }
                    $('.program').change(function() {
                        if ($(this).val() != '') {
                            var select = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('mrisk.fectprogram') }}",
                                method: "GET",
                                data: {
                                    select: select,
                                    _token: _token
                                },
                                success: function(result) {
                                    $('.programsub').html(result);
                                }
                            })
                        }
                    });

                    $('.programsub').change(function() {
                        if ($(this).val() != '') {
                            var select = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('mrisk.fectprogramsub') }}",
                                method: "GET",
                                data: {
                                    select: select,
                                    _token: _token
                                },
                                success: function(result) {
                                    $('.programsubsub').html(result);
                                }
                            })
                        }
                    });
                    $('.fectteam').change(function() {
                        if ($(this).val() != '') {
                            var select = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('mrisk.fectteam') }}",
                                method: "GET",
                                data: {
                                    select: select,
                                    _token: _token
                                },
                                success: function(result) {
                                    $('.teamdetial').html(result);
                                }
                            })
                        }
                    });
                    $('.typelocation').change(function() {
                        if ($(this).val() != '') {
                            var select = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('mrisk.fecttypelocation') }}",
                                method: "GET",
                                data: {
                                    select: select,
                                    _token: _token
                                },
                                success: function(result) {
                                    $('.typelocationdetail').html(result);
                                }
                            })
                        }
                    });
                    $('.items').change(function() {
                        if ($(this).val() != '') {
                            var select = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('mrisk.fectitems') }}",
                                method: "GET",
                                data: {
                                    select: select,
                                    _token: _token
                                },
                                success: function(result) {
                                    $('.itemsub').html(result);
                                }
                            })
                        }
                    });
                    $('.depsub').change(function(){
                        if($(this).val()!=''){
                        var select=$(this).val();
                        var _token=$('input[name="_token"]').val();
                        $.ajax({
                                url:"{{ route('mrisk.fectriskdepsub') }}",
                                method:"GET",
                                data:{select:select,_token:_token},
                                success:function(result){
                                    $('.team').html(result);
                                }
                        })

                        }        
                    }); 
                    $(document).ready(function() {
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            todayBtn: true,
                            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                            thaiyear: true,
                            autoclose: true //Set เป็นปี พ.ศ.
                        }); //กำหนดเป็นวันปัจุบัน
                    });


                    $('.location').change(function () {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('dropdown.repairnomal')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function (result) {
                        $('.locationlevel').html(result);
                    }
                })
                //console.log(select);
            }
        });

        $('.locationlevel').change(function () {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('dropdown.repairnomalsub')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function (result) {
                        $('.locationlevelroom').html(result);
                    }
                })
                // console.log(select);
            }
        });

                </script>

            @endsection
