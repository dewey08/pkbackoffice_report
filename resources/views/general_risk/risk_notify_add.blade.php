@extends('layouts.backend')   
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

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }   
      
      
      .form-control{
    font-size: 13px;
                  }   
</style>

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

    use App\Http\Controllers\RiskController;
    $refnumber = RiskController::refnumberRisk();
    $checkrisknotify = RiskController::checkrisknotify($user_id);
    $countrisknotify = RiskController::countrisknotify($user_id);
    $checkver = RiskController::checkpermischeckinfo($user_id);

    use App\Http\Controllers\FectdataController;
    $checkleader_sub = FectdataController::checkleader_sub($id_user);


    $datenow = date('Y-m-d');

    
?>


  <div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
               
                    <div class="row">
                        <div>
                            <a href="{{ url('general_risk/dashboard_risk/' . $inforpersonuserid->ID) }}" class="btn "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">

                                <span class="nav-main-link-name">Dashboard</span>
                            </a>
                        </div>
                        <div>&nbsp;</div>

                        <div>
                            <a href="{{ url('general_risk/risk_notify_internalcontrol/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">กระบวนการทำงาน
                            </a>
                        </div>
                        <div>&nbsp;</div>

                        <div>
                            <a href="{{ url('general_risk/risk_notify_report4/'.$inforpersonuserid->ID) }}"
                              class="btn btn-hero-sm btn-hero"
                              style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน ปค.4
                          </a>
                        </div>
                          <div>&nbsp;</div>

                          <div>
                            <a href="{{ url('general_risk/risk_notify_report5/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">รายงาน ปค.5
                          </a>
                        </div>
                          <div>&nbsp;</div>


                        <div>
                            <a href="{{ url('general_risk/risk_notify_account_detail/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">บัญชีความเสี่ยง
                            </a>
                        </div>
                        <div>&nbsp;</div>

                       

                        <div>
                            <a href="{{ url('general_risk/risk_notify/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero-info "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">บันทึกความเสี่ยง</a>
                        </div>
                        <div>&nbsp;</div>
                    @if($checkver == 1)
                        <div>
                            <a href="{{ url('general_risk/risk_notify_checkinfo/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero"
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ตรวจสอบ
                            </a>
                        </div>
                        <div>&nbsp;</div>
                    @endif
                        <div>
                            <a href="{{ url('general_risk/risk_notify_deal/' . $inforpersonuserid->ID) }}"
                                class="btn btn-hero-sm btn-hero "
                                style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">ความเสี่ยงที่เกี่ยวข้อง</a>
                            <span class="badge badge-light"></span>
                            </a>
                        </div>
                        <div>&nbsp;&nbsp;</div>

                </ol>
            </nav>
        </div>
    </div>
</div>
<br>
<div class="content">
<div class="block block-rounded block-bordered">

            
<div class="block-content">    
<h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">เพิ่มรายงานความเสี่ยง</h2> 
<div class="block-content block-content-full" align="left">

<form  method="post" action="{{ route('gen_risk.risk_notify_save') }}" enctype="multipart/form-data">
@csrf

<input value="{{$id_user}}" type="hidden" name="USER_ID"  id="USER_ID" class="form-control input-lg"  >                                                                 
       
    <div class="row push">
        <div class="col-sm-2">
        <label>Risk no. </label><label style="color: red;">** &nbsp;</label>
        </div> 
        <div class="col-lg-2 ">
            <input type="text" name="RISKREP_NO" id="RISKREP_NO" class="form-control input-sm fo13" value="{{$refnumber}} ">               
        </div> 
       
        <div class="col-sm-1">
            <label>วันที่บันทึก</label>
            </div> 
            <div class="col-lg-2 "> 
            <input name="RISKREP_DATESAVE" id="RISKREP_DATESAVE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style="font-family:'Kanit',sans-serif;font-size:13px;" value="{{formate($datenow)}}" readonly>          
            
            </div> 
            <div class="col-sm-2">
                <label>หน่วยงานที่รายงาน </label>
                </div> 
                <div class="col-lg-3 "> 
                    @foreach($departsubs as $departsub)
                    <input type="text" class="form-control input-sm fo13" name="" id="" value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_NAME}}" readonly>
                    <input type="hidden" class="form-control input-sm fo13" name="RISKREP_DEPARTMENT_SUB" id="RISKREP_DEPARTMENT_SUB" value="{{ $departsub-> HR_DEPARTMENT_SUB_SUB_ID}}" >
                    @endforeach
                </div> 
            </div> 
            <div class="row push">
             
                        <div class="col-sm-2">
                            <label>แหล่งที่มา/วิธีการค้นพบ :</label><label style="color: red;">** &nbsp;</label>
                        </div> 
                        <div class="col-lg-2 ">
                            <select name="RISKREP_SEARCHLOCATE" id="RISKREP_SEARCHLOCATE" class="form-control input-sm js-example-basic-single fo13" required>
                            <option value="">--เลือก--</option>
                            @foreach($locations as $location)
                                    <option value="{{ $location-> INCIDENCE_LOCATION_ID}}">{{ $location-> INCIDENCE_LOCATION_NAME}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label >หัวหน้างาน</label><label style="color: red;">** &nbsp;</label>                           
                        </div>
                        <div class="col-lg-2 ">
                            <select name="LEADER_PERSON_ID" id="LEADER_PERSON_ID" class="form-control input-lg fo13" required>
                           
                                @foreach ($leaders as $leader) 
                                  @if( $leader ->LEADER_ID  == $checkleader_sub)
                                       <option value="{{ $leader ->LEADER_ID  }}" selected>{{ $leader->LEADER_NAME}}</option>
                                  @else                                                    
                                        <option value="{{ $leader ->LEADER_ID  }}">{{ $leader->LEADER_NAME}}</option>
                                  @endif      
                                @endforeach 
                            </select>                            
                        </div>
                <div class="col-sm-2">
                    <label for="RISKREP_TYPE" style="font-family:'Kanit',sans-serif;font-size:13px;">ประเภทสถานที่</label><label style="color: red;">** &nbsp;</label>
                    </div> 
                    <div class="col-lg-3 ">
                        <select name="RISKREP_TYPE" id="RISKREP_TYPE" class="form-control input-sm js-example-basic-single fo13" required>
                            <option value="">--เลือก--</option>
                                @foreach($typelocations as $typelocation)
                                    <option value="{{ $typelocation-> SETUP_TYPELOCATION_ID}}" >{{ $typelocation-> SETUP_TYPELOCATION_NAME}}</option>
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
                 readonly>
        </div>
        <div class="col-sm-1">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">วันที่ค้นพบ </label><label
                style="color:red;"> *</label><label> :</label>
        </div>
        <div class="col-lg-2 ">
            <input name="RISKREP_DIGDATE" id="RISKREP_DIGDATE"
                class="form-control input-sm datepicker fo13" data-date-format="mm/dd/yyyy"
                 readonly>
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
           
                        <option value="{{ $grouplocation->RISK_LOCATION_ID }}">
                            {{ $grouplocation->RISK_LOCATION_CODE }} ::
                            {{ $grouplocation->RISK_LOCATION_NAME }}</option>

    

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
          
            <option value="">--กรุณาเลือกสถานที่--</option>
            @foreach ($infolocations as $infolocation)
            <option value="{{$infolocation->LOCATION_ID}}">{{ $infolocation->LOCATION_NAME}}</option>
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
      
            <option value="">--กรุณาเลือกชั้น--</option>
        </select>
        </div>

        <div class="col-sm-2">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">ห้อง :</label>
        </div>
        <div class="col-lg-2 ">
            <select name="RISKREP_LOCATION_LEVEL_ROOM" id="RISKREP_LOCATION_LEVEL_ROOM"
        class="form-control input-lg locationlevelroom " style=" font-family: 'Kanit', sans-serif;"
        >
    
        <option value="">--กรุณาเลือกห้อง--</option>
    </select>
        </div>

    </div>
    <div class="row push text-left">
        
        <div class="col-sm-2">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">พื้นที่นอกโรงพยาบาล :</label>
        </div>
        <div class="col-lg-10">
            <input class="form-control" name="RISKREP_LOCATION_OTHER" id="RISKREP_LOCATION_OTHER" placeholder="ระบุสถานที่กรณีพื้นที่นอกโรงพยาบาล "  >
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
                  
                        <option value="{{ $worktime->RISK_TIME_ID }}">
                            {{ $worktime->RISK_TIME_NAME }}</option>
               
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">หรือเวลา :</label>
        </div>
        <div class="col-lg-1 ">
            <input name="RISKREP_TIME" id="RISKREP_TIME" class="js-masked-time form-control fo13">
        </div>
        <div class="col-sm-1">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">เช่น 21.59</label>
        </div>
    </div>





                     
    <div class="row push">
        
        <div class="col-sm-2">
            <label style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดเหตุการณ์ </label><label style="color: red;">** &nbsp;</label>
        </div> 
        <div class="col-lg-10 ">
            <p style="font-family:'Kanit',sans-serif;font-size:13px;text-align:left">บรรยายรายละเอียดเหตุการณ์ เพื่อให้ทราบว่า เกิดอะไร ที่ไหน อย่างไร วันที่ เวลา สถานที่ ผู้ประสบเหตุเป็นต้น</p>  
            <textarea name="RISKREP_DETAILRISK" id="RISKREP_DETAILRISK" class="form-control input-lg time fo13" rows="4" required></textarea>
          
        </div>
    </div>                


    <div class="row push">
        <div class="col-sm-2">
        <label style="font-family:'Kanit',sans-serif;font-size:13px;">การจัดการเบื้องต้น </label><label style="color: red;">** &nbsp;</label>
        </div> 
        <div class="col-lg-10 ">
        <textarea name="RISKREP_BASICMANAGE" id="RISKREP_BASICMANAGE" class="form-control input-lg time fo13" rows="3" required></textarea>
       
        </div>
        </div>

   @if($check->ACTIVE  == 'True')

<div class="row push text-left">
    <div class="col-sm-2">
        <label for="RISK_REPPROGRAM_ID"
            style="font-family:'Kanit',sans-serif;font-size:13px;">ลักษณะอุบัติการณ์ </label><label
            style="color:red;"> **</label><label> :</label>
    </div>
    <div class="col-lg-3 ">
        <select name="RISK_REPPROGRAM_ID" id="RISK_REPPROGRAM_ID"
            class="form-control js-example-basic-single program fo13" style="width: 100%" required>
            <option value="">--กรุณาเลือก--</option>
            @foreach ($riskprograms as $g)
           
                    <option value="{{ $g->RISK_REPPROGRAM_ID }}">
                        {{ $g->RISK_REPPROGRAM_NAME }}</option>
             
            @endforeach

        </select>
    </div>
    <div class="col-sm-1">
        <label for="RISK_REPPROGRAMSUB_ID"
            style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดย่อย 1 </label><label
            style="color:red;"> **</label><label> :</label>
    </div>
    <div class="col-lg-2 ">
        <select name="RISK_REPPROGRAMSUB_ID" id="RISK_REPPROGRAMSUB_ID"
            class="form-control js-example-basic-single programsub fo13" style="width: 100%">
            <option value="">--กรุณาเลือก--</option>
            @foreach ($riskprogramsubs as $gs)
             
                    <option value="{{ $gs->RISK_REPPROGRAMSUB_ID }}">
                        {{ $gs->RISK_REPPROGRAMSUB_NAME }}</option>
              
            @endforeach
        </select>
    </div>
    <div class="col-sm-1">
        <label for="RISK_REPPROGRAMSUBSUB_ID"
            style="font-family:'Kanit',sans-serif;font-size:13px;">รายละเอียดย่อย2 </label><label
            style="color:red;"> **</label><label> :</label>
    </div>
    <div class="col-lg-3 ">
        <select name="RISK_REPPROGRAMSUBSUB_ID" id="RISK_REPPROGRAMSUBSUB_ID"
            class="form-control js-example-basic-single programsubsub fo13" style="width: 100%">
            <option value="">--กรุณาเลือก--</option>
            @foreach ($riskprogramsubsubs as $gss)
            
                    <option value="{{ $gss->RISK_REPPROGRAMSUBSUB_ID }}">
                        {{ $gss->RISK_REPPROGRAMSUBSUB_NAME }}</option>
               
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
    <div class="col-lg-2 ">
        <select name="RISK_REPTYPERESON_ID" id="RISK_REPTYPERESON_ID"
            class="form-control js-example-basic-single fo13" style="width: 100%" required>
            <option value="">--กรุณาเลือก--</option>
            @foreach ($risktypereasons as $gt)
            
                    <option value="{{ $gt->RISK_REPTYPERESON_ID }}">
                        {{ $gt->RISK_REPTYPERESON_NAME }}</option>
             

            @endforeach
        </select>
    </div>
    <div class="col-sm-1">
        <label for="RISK_REPTYPERESONSYS_ID"
            style="font-family:'Kanit',sans-serif;font-size:13px;">สาเหตุเชิงระบบ </label><label
            style="color:red;"> **</label><label> :</label>
    </div>
    <div class="col-lg-2 ">
        <select name="RISK_REPTYPERESONSYS_ID" id="RISK_REPTYPERESONSYS_ID"
            class="form-control js-example-basic-single fo13" style="width: 100%" required>
            <option value="">--กรุณาเลือก--</option>
            @foreach ($risktypereasonsyss as $gts)
            
                    <option value="{{ $gts->RISK_REPTYPERESONSYS_ID }}">
                        {{ $gts->RISK_REPTYPERESONSYS_NAME }}</option>
             

            @endforeach
        </select>
    </div>
    <div class="col-sm-2">
        <label for="RISKREP_LEVEL"
            style="font-family:'Kanit',sans-serif;font-size:13px;">ระดับความรุนแรง </label><label
            style="color:red;"> **</label><label> :</label>
    </div>
    <div class="col-lg-1 ">
        <select name="RISKREP_LEVEL" id="RISKREP_LEVEL"
            class="form-control js-example-basic-single fo13" style="width: 100%" required>
            <option value="">-เลือก-</option>
            @foreach ($levels as $item)
         
                    <option value="{{ $item->RISK_REP_LEVEL_ID }}">
                        {{ $item->RISK_REP_LEVEL_NAME }}</option>
              

            @endforeach
        </select>
    </div>
    <div class="col-lg-2 ">
        <button type="button" class="btn btn-hero-sm btn-hero-info foo15" data-toggle="modal"
            data-target="#addlevel"> ดูรายละเอียด</button>
    </div>
</div>

<div class="row push text-left">
    <div class="col-sm-2">
        <label 
            style="font-family:'Kanit',sans-serif;font-size:13px;">ข้อเสนอแนะ/รายละเอียดเพิ่มเติม
            :</label>
    </div>
    <div class="col-lg-9 ">
        {{-- <p>บันทึกตามรูปแบบเพื่อบอกไห้ทราบว่า เกิดอะไร อย่างไร(Free Text) ไม่เกิน 3 บันทัด</p> --}}
        <textarea name="RISK_REP_FEEDBACK" id="RISK_REP_FEEDBACK"
            class="form-control input-lg time fo13 mt-0"
            rows="3"> </textarea>
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
             
                    <option value="{{ $uefect->INCEDENCE_USEREFFECT_ID }}">
                        {{ $uefect->INCEDENCE_USEREFFECT_NAME }} </option>
             

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
          
                    <option value="{{ $sex->SEX_ID }}">{{ $sex->SEX_NAME }} </option>
              

            @endforeach
        </select>
    </div>
    <div class="col-sm-0.5">
        <label style="font-family:'Kanit',sans-serif;font-size:13px;">อายุ </label><label
            style="color:red;"> **</label><label> :</label>
    </div>
    <div class="col-lg-1 ">
        <input name="RISKREP_AGE" id="RISKREP_AGE" class="form-control input-sm fo13"
            >
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
       
                <option value="{{ $inforiskacc->RISK_ACC_ID }}">{{ $inforiskacc->RISK_ACC_ISSUE }} </option>
        

        @endforeach
    </select>
       
    </div>
  
</div>


   @endif
 {{-----------------------------}}
    
        <div class="row push">
            <div class="col-sm-2">
            </div> 
            <div class="col-sm-4">
                <div class="form-group">
                    <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                    <img id="add_preview" src="{{asset('image/camera.png')}}" alt="Image" class="img-thumbnail" height="200" width="200"/>
                    </div>
                    <div class="form-group">
                    *ขนาดรูปไม่เกิน 350 x 350 pixel
                    <input type="file" name="RISK_REP_IMG" id="RISK_REP_IMG" class="form-control" onchange="addURL(this)">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div> 
            <div class="col-sm-1">
            </div> 
            <div class="col-lg-5 ">
                
                <div class="form-group">
                    <br><br><br><br><br><br><br><br><br>
                    <p style="font-family:'Kanit',sans-serif;font-size:13px;">เอกสารประกอบ </p>
                    <input type="file" name="RISKREP_DOCFILE" id="RISKREP_DOCFILE" class="form-control">
                    </div>
            </div>
    </div>  

<div class="modal-footer">
<div align="right">
<button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
<a href="{{ url('general_risk/risk_notify/'.$inforpersonuserid -> ID)  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('select').select2();
});
</script>


<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>

<script>
     function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
        var numb = input.files[0].size/1024;
   
                    if(numb > 64){
                        alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
                            fileInput.value = '';
                            return false;
                        }    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }            
                        reader.readAsDataURL(input.files[0]);
                    }else{        
                                alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;       
                    }
                }            
                $("#picture").change(function () {
                    readURL(this);
                });
</script>
<script>
    function addURL(input) {
        var fileInput = document.getElementById('RISK_REP_IMG');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var numb = input.files[0].size/2048;
   
            if(numb > 64){
                alert('กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 64KB');
                    fileInput.value = '';
                    return false;
                }

            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#add_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                fileInput.value = '';
                return false;
            }
        }
</script>

<script>
function selectlevel(INCIDENCE_LEVEL_ID){
      
      var _token=$('input[name="_token"]').val();

           $.ajax({
                   url:"{{route('car.selectbookname')}}",
                   method:"GET",
                   data:{INCIDENCE_LEVEL_ID:INCIDENCE_LEVEL_ID,_token:_token},
                   success:function(result){
                    $('.detali_levelname').html(result);
                   }
           })

           $.ajax({
                   url:"{{route('car.selectbooknum')}}",
                   method:"GET",
                   data:{INCIDENCE_LEVEL_ID:INCIDENCE_LEVEL_ID,_token:_token},
                   success:function(result){
                    $('.detali_booknum').html(result);
                   }
           })


           $('#modallevel').modal('hide');

}
function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
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