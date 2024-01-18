@extends('layouts.leave')
  
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
     

      }

label{
            font-family: 'Kanit', sans-serif;
           
          
      }  

      .form-control {
            font-family: 'Kanit', sans-serif;
           
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
<body onload="checkdatebegin();">

<div >

    <form  method="post" action="{{ route('leave.updateedit') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>

        @csrf

<div class="block block-rounded block-bordered">

<div class="block-content"> 
 @if($leavetype == 'sick')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาป่วย</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
          
@elseif($leavetype == 'spawn')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาคลอดบุตร</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3> 
@elseif($leavetype == 'work')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลากิจ</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3> 
@elseif($leavetype == 'rest')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาพักผ่อน</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3> 
@elseif($leavetype == 'religion')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาอุปสมบท/ประกอบพิธีฮัจญ์ </B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3> 
@elseif($leavetype == 'helpspawn')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาช่วยภริยาคลอด </B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3> 
@elseif($leavetype == 'military')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาเกณฑ์ทหาร</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@elseif($leavetype == 'train')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาศึกษา ฝึกอบรม</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@elseif($leavetype == 'abroad')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาทำงานต่างประเทศ</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@elseif($leavetype == 'mate')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาติดตามคู่สมรส</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@elseif($leavetype == 'restore')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาฟื้นฟูอาชีพ</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@elseif($leavetype == 'resign')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขข้อมูลลาออก</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@elseif($leavetype == 'sicklow')
<h3 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขลาป่วยตามกฎหมายฯ :</B><label style="color: #778899;">&nbsp;&nbsp;&nbsp;&nbsp;วันที่บันทึก {{ DateThai(date("Y-m-d"))}}</label></h3>
@endif





<div class="row push">

    <div class="col-lg-4">
            
            @if($leavetype == 'rest')
            <div class="form-group">
                    <label>วันลาพักผ่อนคงเหลือ </label>
                 {{$datebalance}}
                    <label>วัน</label>
                </div>  
            @endif
     
            <div class="form-group">
                    <label>ปีงบประมาณ</label>
                    <select name="LEAVE_YEAR_ID" id="LEAVE_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkdatebegin();checkdateend();checkall();">
                    @foreach ($budgetyears as $budgetyear) 
                            @if($budgetyear ->LEAVE_YEAR_ID == $infoleave->LEAVE_YEAR_ID)
                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                            @else
                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                            @endif
                    @endforeach 
                    </select>
            </div>
            <div class="form-group">
                    <label>สถานที่ไป</label>
                    <select name="LOCATION_ID" id="LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    @foreach ($locations as $location)      
                            @if( $location ->LOCATION_ID == $infoleave->LOCATION_ID)
                            <option value="{{ $location ->LOCATION_ID  }}" seleted>{{ $location->LOCATION_NAME }}</option>
                            @else
                            <option value="{{ $location ->LOCATION_ID  }}">{{ $location->LOCATION_NAME }}</option>
                            @endif
                            
                    @endforeach 
                    </select>
            </div>
        <!---------------------------------------------------------------------->
            
                
             
        @if($leavetype == 'religion')
            <div class="form-group">
                    <label>อุปสมบท ณ วัด <div style="color: red;" id="odentemple"></div> </label>
                    <input name ="ODEIN_TEMPLE" id="ODEIN_TEMPLE" value="{{$infoleave ->ODEIN_TEMPLE}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>ที่ตั้งวัด <div style="color: red;" id="odentempleadd"></div> </label>
                    <input name ="ODEIN_TEMPLE_ADD" id="ODEIN_TEMPLE_ADD" value="{{$infoleave ->ODEIN_TEMPLE_ADD}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
            <div style="color: red;" id="odentype"></div>       
            <label><input type="radio" name="ODEN_TYPE" id="ODEN_TYPE" value="1" onclick="checkall();" checked>&nbsp;เพื่ออุปสมบท  <input type="radio" name="ODEN_TYPE" id="ODEN_TYPE" value="2" onclick="checkall();">&nbsp;เพื่อประกอบพิธีฮัจญ์</label>
            </div>
            <div class="form-group">
                <label>วันที่บวช <div style="color: red;" id="odendate"></div> </label>
                <input name="ODEIN_DATE" id="ODEIN_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" value="{{formate($infoleave ->ODEIN_DATE)}}" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>

        @elseif($leavetype == 'helpspawn')
           <div class="form-group">
                    <label>คำขึ้นต้น <div style="color: red;" id="leavewordbegin"></div> </label>
                    <input name ="LEAVE_WORD_BEGIN" id="LEAVE_WORD_BEGIN" class="form-control input-lg " value="{{$infoleave ->LEAVE_WORD_BEGIN}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>ชื่อ สุกลภริยา <div style="color: red;" id="leavemarryname"></div> </label>                              
                    <input name="LEAVE_MARRY_NAME" id="LEAVE_MARRY_NAME" class="form-control input-lg" value="{{$infoleave ->LEAVE_MARRY_NAME}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                <label>วันที่คลอด <div style="color: red;" id="leavedatespawn"></div> </label>
                <input name="LEAVE_DATE_SPAWN" id="LEAVE_DATE_SPAWN" class="form-control input-lg datepicker" value="{{$infoleave ->LEAVE_DATE_SPAWN}}" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
        @elseif($leavetype == 'military')
        <div class="form-group">
                    <label>รับหมายเรียกจาก <div style="color: red;" id="armyby"></div></label>
                    <input name ="ARMY_BY" id="ARMY_BY" class="form-control input-lg" value="{{$infoleave ->ARMY_BY}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>เลขที่หมายเรียก<div style="color: red;" id="armynum"></div></label>                              
                    <input name="ARMY_NUM" id="ARMY_NUM" class="form-control input-lg" value="{{$infoleave ->ARMY_NUM}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                <label>ระบุวันที่<div style="color: red;" id="armydate"></div></label>
                <input name="ARMY_DATE" id="ARMY_DATE" class="form-control input-lg datepicker"  value="{{formate($infoleave ->ARMY_DATE)}}" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;"  readonly>
            </div>
            <div class="form-group">
                    <label>ให้เข้ารับการ<div style="color: red;" id="armyvisit"></div></label>                              
                    <input name="ARMY_VISIT" id="ARMY_VISIT" class="form-control input-lg" value="{{$infoleave ->ARMY_VISIT}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
        @elseif($leavetype == 'mate')  
           <div class="form-group">
                    <label>ได้รับเงินเดือน  <div style="color: red;" id="fwmarrysalary"></div></label>
                    <input name ="FW_MARRY_SALARY" id="FW_MARRY_SALARY" class="form-control input-lg" value="{{$infoleave ->FW_MARRY_SALARY}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>ชื่อคู่สมรส <div style="color: red;" id="fwmarry"></div></label>                              
                    <input name="FW_MARRY" id="FW_MARRY" class="form-control input-lg" value="{{$infoleave ->FW_MARRY}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>  
            <div class="form-group">
                    <label>ตำแหน่งคู่สมรส <div style="color: red;" id="fwmarryposition"></div></label>                              
                    <input name="FW_MARRY_POSITION" id="FW_MARRY_POSITION" class="form-control input-lg" value="{{$infoleave ->FW_MARRY_POSITION}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div> 
            <div class="form-group">
                    <label>ระดับ <div style="color: red;" id="fwmarrylevel"></div></label>                              
                    <input name="FW_MARRY_LEVEL" id="FW_MARRY_LEVEL" class="form-control input-lg" value="{{$infoleave ->FW_MARRY_LEVEL}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            
        @elseif($leavetype == 'train')
        <div class="form-group">
                    <label>ศึกษาวิชา<div style="color: red;" id="edusubject"></div> </label>                              
                    <input name="EDU_SUBJECT" id="EDU_SUBJECT" class="form-control input-lg" value="{{$infoleave ->EDU_SUBJECT}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div> 
            <div class="form-group">
                    <label>ชั้นปริญญา<div style="color: red;" id="edubranch"></div> </label>                              
                    <input name="EDU_BRANCH" id="EDU_BRANCH" class="form-control input-lg" value="{{$infoleave ->EDU_BRANCH}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div> 
            <div class="form-group">
                    <label>สถานศึกษา<div style="color: red;" id="eduacademy"></div> </label>                              
                    <input name="EDU_ACADEMY" id="EDU_ACADEMY" class="form-control input-lg" value="{{$infoleave ->EDU_ACADEMY}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>ประเทศ</label>                              
                   
                    <select name="EDU_CONTRY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                         @foreach ($infonations as $infonation)
                                                
                                        @if($infonation -> HR_NATIONALITY_ID== '99')
                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}" selected>{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                        @else
                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}">{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                        @endif

                                        @endforeach 
                </select>    
            </div>  
            <div class="form-group">
                    <label>ด้วยทุน<div style="color: red;" id="eduton"></div></label>                              
                    <input name="EDU_TON" id="EDU_TON" class="form-control input-lg" value="{{$infoleave ->EDU_TON}}" style=" font-family: 'Kanit', sans-serif;"  onkeyup="checkall();">
            </div>  

        @elseif($leavetype == 'resign')
         <div class="form-group">
                    <label>ประเภทบุคคลากร</label>
                    
                    <input name ="EXIT_POSITION_TYPE" id="EXIT_POSITION_TYPE" class="form-control input-lg" value="{{$infoleave ->EXIT_POSITION_TYPE}}" style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
            <div class="form-group">
                <label>วันที่ลาออก<div style="color: red;" id="exitindate"></div></label>
                <input name="EXIT_IN_DATE" id="EXIT_IN_DATE" class="form-control input-lg datepicker" value="{{formate($infoleave ->EXIT_IN_DATE)}}" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
            <div class="form-group">
                    <label>สัญญาจ้างเลขที่<div style="color: red;" id="exitpersonvcode"></div></label>
                    <input name ="EXIT_PERSON_VCODE" id="EXIT_PERSON_VCODE" class="form-control input-lg"  value="{{$infoleave ->EXIT_PERSON_VCODE}}" style=" font-family: 'Kanit', sans-serif;"  onkeyup="checkall();">
            </div>
            <div class="form-group">
                <label>ลงวันที่<div style="color: red;" id="exitpersonvcodedate"></div></label>
                <input name="EXIT_PERSON_VCODE_DATE" id="EXIT_PERSON_VCODE_DATE" class="form-control input-lg datepicker"  value="{{$infoleave ->EXIT_PERSON_VCODE_DATE}}" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
          
        @else
         <div class="form-group">
                    <label>เหตุผลการลา </label>
                    <select name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                        @foreach ($reasons as $reason) 
                                                                                    
                                <option value="{{ $reason ->REASON_TYPE_ID  }}">{{ $reason->REASON_TYPE_NAME }}</option>
                        @endforeach 
                    </select>
                    
            </div>
            <div class="form-group">
                    <label>เนื่องจาก <div style="color: red;" id="leavebecaus"></div> </label>
                  
                    <input name="LEAVE_BECAUSE" id="LEAVE_BECAUSE" class="form-control input-lg" value="{{$infoleave ->LEAVE_BECAUSE}}"  style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>

        @endif
        <!---------------------------------------------------------------------->

          
     </div>  
   
    <div class="col-lg-4">
    @if($leavetype == 'military')
    <div class="form-group">
                    <label>สถานที่<div style="color: red;" id="armvisitadd"></div> </label>                              
                    <input name="ARMY_VISIT_ADD" id="ARMY_VISIT_ADD" class="form-control input-lg" value="{{$infoleave ->ARMY_VISIT_ADD}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
    </div>
    @elseif($leavetype == 'religion')
    <div class="form-group">
                    <label>จำพรรษา ณ วัด<div style="color: red;" id="odentemplelive"></div> </label>                              
                    <input name="ODEN_TEMPLE_LIVE" id="ODEN_TEMPLE_LIVE" class="form-control input-lg" value="{{$infoleave ->ODEN_TEMPLE_LIVE}}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
    </div>
    <div class="form-group">
                    <label>ตั้งอยู่<div style="color: red;" id="odentempleliveadd"></div> </label>                              
                    <input name="ODEN_TEMPLE_LIVE_ADD" id="ODEN_TEMPLE_LIVE_ADD" class="form-control input-lg" value="{{$infoleave ->ODEN_TEMPLE_LIVE_ADD}}"  style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
    </div>
    <div class="form-group">
                    <label>ประวัติ<div style="color: red;" id="odeneven"></div> </label>   
                   <p><label><input type="radio" name="ODEN_EVER" id="ODEN_EVER" value="True" onclick="checkall();">&nbsp;เคยบวช <input type="radio" name="ODEN_EVER" id="ODEN_EVER" value="False" onclick="checkall();" checked>&nbsp;ไม่เคยบวช</label></p>
                   </div>
    @elseif($leavetype == 'mate') 
    <div class="form-group">
                    <label>สังกัด <div style="color: red;" id="fwmarryunder"></div> </label>                              
                    <input name="FW_MARRY_UNDER" id="FW_MARRY_UNDER" class="form-control input-lg" value="{{$infoleave ->FW_MARRY_UNDER}}" style=" font-family: 'Kanit', sans-serif;"onkeyup="checkall();">
            </div>  
   
    <div class="form-group">
                    <label>ประเทศ</label>                              
                   
                    <select name="FW_COUNTRY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                         @foreach ($infonations as $infonation)
                                                
                                        @if($infonation -> HR_NATIONALITY_ID== '99')
                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}" selected>{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                        @else
                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}">{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                        @endif

                                        @endforeach 
                </select>    
    </div> 
    @elseif($leavetype == 'resign')
            <div class="form-group">
                    <label>กลุ่ม</label>
                    
                    <input name ="EXIT_GROUP" id="EXIT_GROUP" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> HR_DEPARTMENT_NAME }}" readonly>
            </div>
            <div class="form-group">
                    <label>กลุ่ม/ฝ่าย</label>
                   
                    <input name ="EXIT_POSITION" id="EXIT_POSITION" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> HR_DEPARTMENT_SUB_NAME }}" readonly>
                    
            </div>
            <div class="form-group">
                    <label>ตำแหน่ง</label>
                 
                    <input name ="EXIT_WORK" id="EXIT_WORK" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> POSITION_IN_WORK }}" readonly>
            </div>
            <div class="form-group">
                    <label>หน่วยงาน</label>
                    <input name ="EXIT_DEP" id="EXIT_DEP" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}" readonly>
            </div>
            <div class="form-group">
                    <label>ส่วนราชการ</label>
        
                    <input name ="EXIT_SECTION" id="EXIT_SECTION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{ $inforpersonuser -> HR_KIND_NAME }}" readonly>
            </div>
            <div class="form-group">
                    <label>ค่าจ้างเดือนละ<div style="color: red;" id="exitsalary"></div></label>
                    <input name ="EXIT_SALARY" id="EXIT_SALARY" class="form-control input-lg"  value="{{$infoleave ->EXIT_SALARY}}"  style=" font-family: 'Kanit', sans-serif;"onkeyup="checkall();">
            </div>
    @elseif($leavetype == 'train')     
           <div class="form-group">
                    <label>หลักสูตร<div style="color: red;" id="edutcourse"></div> </label>
                    <input name ="EDU_T_COURSE" id="EDU_T_COURSE" class="form-control input-lg"  value="{{$infoleave ->EDU_T_COURSE}}"  style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>สถานที่<div style="color: red;" id="edutlocation"></div> </label>
                    <input name ="EDU_T_LOCATION" id="EDU_T_LOCATION" class="form-control input-lg"  value="{{$infoleave ->EDU_T_LOCATION}}"  style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
            <div class="form-group">
                    <label>ประเทศ</label>
                    
                    <select name="EDU_T_CONTRY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                         @foreach ($infonations as $infonation)
                                                
                                        @if($infonation -> HR_NATIONALITY_ID== '99')
                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}" selected>{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                        @else
                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}">{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                        @endif

                                        @endforeach 
                                        </select>    
            
            </div>
            <div class="form-group">
                    <label>อบรม/วิจัย/ดูงาน</label>                              
                    <label><input type="radio" name="EDU_TYPE" value="ฝึกอบรม" checked>&nbsp;ฝึกอบรม  <input type="radio" name="EDU_TYPE" value="ปฏิบัติการวิจัย">&nbsp;ปฏิบัติการวิจัย<input type="radio" name="EDU_TYPE" value="ดูงาน">&nbsp;ดูงาน</label>
            </div>  


    @endif

           
    @if($leavetype != 'resign')
                              @if($leavetype == 'train')
                                <div class="form-group">
                                <label>ลาตั้งแต่วันที่ <div style="color: #DC143C;" class="checkdatebegin"><input type="hidden" name ="checkbigin_date" id="checkbigin_date" value="false"></div></label>
                                <input name="date_bigen" id="date_bigen" class="form-control input-lg datepicker" value="{{formate($infoleave ->LEAVE_DATE_BEGIN)}}"  data-date-format="mm/dd/yyyy" onchange="calldate();" style=" font-family: 'Kanit', sans-serif;" readonly>
                                </div>
                                <div class="form-group">
                                <label>ถึงวันที่<div style="color: #DC143C;" class="checkdateend"><input type="hidden" name ="checkend_date" id="checkend_date" value="false"></div></label>
                                <input name="date_end" id="date_end" class="form-control input-lg datepicker" value="{{formate($infoleave ->LEAVE_DATE_END)}}" data-date-format="mm/dd/yyyy" onchange="calldate();" style=" font-family: 'Kanit', sans-serif;" readonly>
                                </div>
                                @else

                                <div class="form-group">
                                <label>ลาตั้งแต่วันที่ <div style="color: #DC143C;" class="checkdatebegin"><input type="hidden" name ="checkbigin_date" id="checkbigin_date" value="false"></div></label>
                                <input name="date_bigen" id="date_bigen" class="form-control input-lg datepicker" value="{{formate($infoleave ->LEAVE_DATE_BEGIN)}}" data-date-format="mm/dd/yyyy" onchange="checkdatebegin();calldate();" style=" font-family: 'Kanit', sans-serif;" readonly>
                                </div>
                                <div class="form-group">
                                <label>ถึงวันที่<div style="color: #DC143C;" class="checkdateend"><input type="hidden" name ="checkend_date" id="checkend_date" value="false"></div></label>
                                <input name="date_end" id="date_end" class="form-control input-lg datepicker" value="{{formate($infoleave ->LEAVE_DATE_END)}}" data-date-format="mm/dd/yyyy" onchange="checkdateend();calldate();" style=" font-family: 'Kanit', sans-serif;" readonly>
                                </div>

                                @endif

                                @if($inforpersonuser -> LEAVEDAY_ACTIVE == 'True' && ($leavetype != 'spawn' && $leavetype != 'religion' && $leavetype != 'military' && $leavetype != 'train' && $leavetype != 'abroad' && $leavetype != 'mate' && $leavetype != 'sicklow'))
                                <div class="form-group">
                                <label>จำนวนวัน Off<br><div style="color: #DC143C;">(เช่น ขอลาวันที่ 1-5 ม.ค. 63 แต่วันที่ 3 เป็นวัน off ของท่านให้ใส่จำนวนเป็น 1)</div><div style="color: #DC143C;" class="checkdateend"><input type="hidden" name ="checkend_date" id="checkend_date" value="false"></div></label>
                                <input name="DATE_OFF" id="DATE_OFF" class="form-control input-lg" value="{{$infoleave->DATE_OFF}}"  onkeyup="checkdateend();calldate();" style=" font-family: 'Kanit', sans-serif;" >
                                </div>

                                @else
                                 <input type="hidden" name="DATE_OFF" id="DATE_OFF" class="form-control input-lg"  value="0" >

    @endif   

<div class="form-group">
    <label>ลาเต็มวัน/ครึ่งวัน <br><div style="color: #DC143C;">(กรณีลาเต็มวันและวันสุดท้ายลาครึ่งวันให้เลือก ครึ่งวันเช้าหรือครึ่งวันบ่าย)</div></label>
    <select name="DAY_TYPE_ID" id="DAY_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkdateend();calldate();">
        @foreach ($daytypes as $daytype) 
            @if( $daytype ->DAY_TYPE_ID  == $infoleave->DAY_TYPE_ID)
            <option value="{{ $daytype ->DAY_TYPE_ID  }}" selected>{{ $daytype->DAY_TYPE_NAME }}</option>
            @else
            <option value="{{ $daytype ->DAY_TYPE_ID  }}">{{ $daytype->DAY_TYPE_NAME }}</option>
            @endif
       
        @endforeach 
    </select>
</div>
<div class="form-group"> 
<label>เบอร์โทรติดต่อ<div style="color: red;" id="leavecontact_phone"></div> </label>  
    <input name="LEAVE_CONTACT_PHONE" id="LEAVE_CONTACT_PHONE" class="form-control input-lg" value="{{$infoleave -> LEAVE_CONTACT_PHONE }}" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
    </div>
    @endif

@if($leavetype !== 'religion' && $leavetype != 'train') 

    <div class="form-group">
    <label>มอบหมายงานให้<div style="color: red;" id="leaveworksend"></div></label>
    <select name="LEAVE_WORK_SEND_ID" id="LEAVE_WORK_SEND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkall();">
    <option value="">--กรุณาเลือกผู้มอบหมายงานให้--</option>
        @foreach ($LEAVEWORK_SENDs as $LEAVEWORK_SEND)                                                     
            @if($LEAVEWORK_SEND ->ID == $infoleave->LEAVE_WORK_SEND_ID)
            <option value="{{ $LEAVEWORK_SEND ->ID  }}" selected>{{ $LEAVEWORK_SEND->HR_FNAME}} {{$LEAVEWORK_SEND->HR_LNAME}}</option>
            @else 
            <option value="{{ $LEAVEWORK_SEND ->ID  }}">{{ $LEAVEWORK_SEND->HR_FNAME}} {{$LEAVEWORK_SEND->HR_LNAME}}</option>
            @endif
        @endforeach 
    </select>

   
    </div>
  


@endif  
</div> 


<div class="col-lg-4">
@if($leavetype == 'religion' || $leavetype == 'train')

    <div class="form-group">
    <label>มอบหมายงานให้<div style="color: red;" id="leaveworksend"></div></label>
    <select name="LEAVE_WORK_SEND_ID" id="LEAVE_WORK_SEND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkall();">
    <option value="">--กรุณาเลือกผู้มอบหมายงานให้--</option>
        @foreach ($LEAVEWORK_SENDs as $LEAVEWORK_SEND)  
            @if($LEAVEWORK_SEND ->ID == $infoleave->LEAVE_WORK_SEND_ID)
            <option value="{{ $LEAVEWORK_SEND ->ID  }}" selected>{{ $LEAVEWORK_SEND->HR_FNAME}} {{$LEAVEWORK_SEND->HR_LNAME}}</option>
            @else 
            <option value="{{ $LEAVEWORK_SEND ->ID  }}">{{ $LEAVEWORK_SEND->HR_FNAME}} {{$LEAVEWORK_SEND->HR_LNAME}}</option>
            @endif
      
        @endforeach 
    </select>

   
    </div>

@elseif($leavetype == 'resign')
<div class="form-group">
                <label>เริ่มตั้งแต่วันที่<div style="color: red;" id="exitdatebegin"></div></label>
                <input name="EXIT_DATE_BEGIN" id="EXIT_DATE_BEGIN" value="{{formate($infoleave ->EXIT_DATE_BEGIN)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
            <div class="form-group">
                <label>สิ้นสุดวันที่<div style="color: red;" id="exitdatefinish"></div></label>
                <input name="EXIT_DATE_FINISH" id="EXIT_DATE_FINISH" value="{{formate($infoleave ->EXIT_DATE_FINISH)}}" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" readonly>
            </div>
            <div class="form-group">
                <label>ลาออกเพราะ<div style="color: red;" id="exitbecause"></div></label>
                <input name="EXIT_BECAUSE" id="EXIT_BECAUSE" value="{{$infoleave ->EXIT_BECAUSE}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkall();">
            </div>
  
@endif  

<div class="form-group">
    <label>ระหว่างลาติดต่อ <div style="color: red;" id="leavecontact"></div></label>
    <textarea  name ="LEAVE_CONTACT" id="LEAVE_CONTACT"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; height: 120px;" onkeyup="checkall();">{{$infoleave->LEAVE_CONTACT}}</textarea>
</div>

<div class="form-group">
    <label >หัวหน้างาน <div style="color: red;" id="leavecontact_leader"></div></label> </label>
    <select name="LEADER_PERSON_ID" id="LEADER_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkall();">
   
        @foreach ($leaders as $leader) 
          @if( $leader ->LEADER_ID  == $infoleave ->LEADER_PERSON_ID)
               <option value="{{ $leader ->LEADER_ID  }}" selected>{{ $leader->LEADER_NAME}}</option>
          @else                                                    
                <option value="{{ $leader ->LEADER_ID  }}">{{ $leader->LEADER_NAME}}</option>
          @endif      
        @endforeach 
    </select>
    
</div>
<div class="form-group">
    <label>หัวหน้าฝ่าย/กลุ่มภารกิจ <div style="color: red;" id="leavecontact_leaderdep"></div></label></label>
    <select name="LEADER_DEP_PERSON_ID" id="LEADER_DEP_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"  onchange="checkall();">
    
        @foreach ($leader_alls as $leader_all)   
                @if( $leader_all ->LEADER_HR_ID  == $infoleave ->LEADER_DEP_PERSON_ID)                                                  
                        <option value="{{ $leader_all ->LEADER_HR_ID  }}" selected>{{ $leader_all->HR_FNAME}} {{ $leader_all->HR_LNAME}}</option>
                 @else 
                        <option value="{{ $leader_all ->LEADER_HR_ID  }}">{{ $leader_all->HR_FNAME}} {{ $leader_all->HR_LNAME}}</option>
                 @endif      

        @endforeach 
    </select>
</div>

<div class="form-group">
    <label>หมายเหตุ</label>
   <input name="LEAVE_COMMENT_BY" id="LEAVE_COMMENT_BY" value="{{$infoleave ->LEAVE_COMMENT_BY}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
</div>



   

  <div class="calldate">
   <input type="hidden" name ="checkcall_date" id="checkcall_date" class="form-control input-lg " value="">
   </div>

   <input type="hidden" name ="ID" id="ID" class="form-control input-lg" value="{{$infoleave -> ID }}">

   <input type="hidden" name ="LEAVE_PERSON_ID" id="LEAVE_PERSON_ID" class="form-control input-lg" value="{{$inforpersonuserid -> ID }}">
   <input type="hidden" name ="LEAVE_PERSON_CODE" id="LEAVE_PERSON_CODE" class="form-control input-lg" value="{{$inforpersonuser -> HR_CID }}">
   <input type="hidden" name ="LEAVE_PERSON_FULLNAME" id="LEAVE_PERSON_FULLNAME" class="form-control input-lg" value="{{$inforpersonuser->HR_PREFIX_NAME}}{{ $inforpersonuser->HR_FNAME}} {{$inforpersonuser->HR_LNAME}}">
   <input type="hidden" name ="LEAVE_POSITION_ID" id="LEAVE_POSITION_ID" class="form-control input-lg" value="{{$inforpersonuser -> HR_POSITION_ID }}">
   <input type="hidden" name ="LEAVE_DEPARTMENT_ID" id="LEAVE_DEPARTMENT_ID" class="form-control input-lg" value="{{$inforpersonuser -> HR_DEPARTMENT_ID }}">
   <input type="hidden" name ="LEAVE_TYPE_PERSON_ID" id="LEAVE_TYPE_PERSON_ID" class="form-control input-lg" value="{{$inforpersonuser -> HR_PERSON_TYPE_ID }}">
   <input type="hidden" name ="LEAVE_STATUS_CODE" id="LEAVE_STATUS_CODE" class="form-control input-lg" value="Pending">
   <input type="hidden" name ="LEAVE_PERSON_LAVEL_NAME" id="LEAVE_PERSON_LAVEL_NAME" class="form-control input-lg" value="{{$inforpersonuser -> HR_LEVEL_NAME }}">
   <input type="hidden" name ="LEAVE_PERSON_LAVEL_ID" id="LEAVE_PERSON_LAVEL_ID" class="form-control input-lg" value="{{$inforpersonuser -> HR_LEVEL_ID }}">

  
                    @if($leavetype == 'sick')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="01">
                    @elseif($leavetype == 'spawn')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="02">
                    @elseif($leavetype == 'work')                                   
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="03">
                    @elseif($leavetype == 'rest')                                   
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="04">
                    @elseif($leavetype == 'religion')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="05">
                    @elseif($leavetype == 'helpspawn')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="06">
                    @elseif($leavetype == 'military')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="07">
                    @elseif($leavetype == 'train')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="08">
                    @elseif($leavetype == 'abroad')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="09">
                    @elseif($leavetype == 'mate')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="10">
                    @elseif($leavetype == 'restore')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="11">
                    @elseif($leavetype == 'resign')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="12">              
                    @elseif($leavetype == 'sicklow')
                    <input type="hidden" name ="LEAVE_TYPE_CODE" id="LEAVE_TYPE_CODE" class="form-control input-lg" value="13">
                    @endif


</div>          
</div>

<div align="right"><table style="border:none;"><tr style="border:none;"><td style="border:none;"><div class="checkall"><button type="button"  class="btn btn-light  btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color: #A9A9A9"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button></div></td><td style="border:none;">&nbsp;&nbsp;<a href="{{ url('manager_leave/personleaveinfocheckver')}}"  class="btn btn-hero-sm btn-hero-danger" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a></td></tr></table></div><br>   
     
     </form>




 
 

      

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


<!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


<script>


$(document).ready(function() {

$('select').select2();

checkdatebegin();
checkdateend();
calldate();
});
           
$('body').on('keydown', 'input, select, textarea', function(e) {
var self = $(this)
, form = self.parents('form:eq(0)')
, focusable
, next
;
if (e.keyCode == 13) {
focusable = form.find('input,a,select,button,textarea').filter(':visible');
next = focusable.eq(focusable.index(this)+1);
if (next.length) {
next.focus();
} else {
form.submit();
}
return false;
}
});


$(document).ready(function () {

$('.datepicker').datepicker({
format: 'dd/mm/yyyy',
todayBtn: true,
language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
thaiyear: true,
autoclose: true               //Set เป็นปี พ.ศ.
});  //กำหนดเป็นวันปัจุบัน


});


function calldate(){
var date_bigen=document.getElementById("date_bigen").value;
var date_end=document.getElementById("date_end").value;

var LEAVE_TYPE_CODE=document.getElementById("LEAVE_TYPE_CODE").value;
var LEAVE_PERSON_LAVEL_ID=document.getElementById("LEAVE_PERSON_ID").value;
var LEAVE_YEAR_ID=document.getElementById("LEAVE_YEAR_ID").value;
var DATE_OFF=document.getElementById("DATE_OFF").value;
var DAY_TYPE_ID=document.getElementById("DAY_TYPE_ID").value;


// alert(date_end);

var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.calldate')}}",
     method:"GET",
     data:{date_bigen:date_bigen,date_end:date_end,LEAVE_TYPE_CODE:LEAVE_TYPE_CODE,DATE_OFF:DATE_OFF,LEAVE_PERSON_LAVEL_ID:LEAVE_PERSON_LAVEL_ID
     ,LEAVE_YEAR_ID:LEAVE_YEAR_ID,DAY_TYPE_ID:DAY_TYPE_ID,_token:_token},
     success:function(result){  
                        
        $('.calldate').html(result);  
        checkall();
     }
})

 
}  

function checkdatebegin(){
var date_bigin=document.getElementById("date_bigen").value;
var LEAVE_YEAR_ID=document.getElementById("LEAVE_YEAR_ID").value;

// alert(date_end);

var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkdatebegin')}}",
     method:"GET",
     data:{date_bigin:date_bigin,LEAVE_YEAR_ID:LEAVE_YEAR_ID,_token:_token},
     success:function(result){
        $('.checkdatebegin').html(result);
        checkall();
     }
})
}        

function checkdateend(){
var date_end=document.getElementById("date_end").value;
var LEAVE_YEAR_ID=document.getElementById("LEAVE_YEAR_ID").value;

// alert(date_end);

var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkdateend')}}",
     method:"GET",
     data:{date_end:date_end,LEAVE_YEAR_ID:LEAVE_YEAR_ID,_token:_token},
     success:function(result){
        $('.checkdateend').html(result);
        checkall();
     }
})
}        




function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

//-----------------------checkall------------------------------------------------

function checkall(){ 

var leavecode=document.getElementById("LEAVE_TYPE_CODE").value;
//alert(leavecode);
//-----------------------------------------------------------    
if(leavecode== '05'){

var checkcall_date=document.getElementById("checkcall_date").value;
var checkbigin_date=document.getElementById("checkbigin_date").value;
var checkend_date=document.getElementById("checkend_date").value;

var ODEIN_TEMPLE=document.getElementById("ODEIN_TEMPLE").value;
var ODEIN_TEMPLE_ADD=document.getElementById("ODEIN_TEMPLE_ADD").value;
var ODEIN_DATE=document.getElementById("ODEIN_DATE").value;
var ODEN_TEMPLE_LIVE=document.getElementById("ODEN_TEMPLE_LIVE").value;
var ODEN_TEMPLE_LIVE_ADD=document.getElementById("ODEN_TEMPLE_LIVE_ADD").value;


var LEAVE_CONTACT_PHONE=document.getElementById("LEAVE_CONTACT_PHONE").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;
var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;

var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน


if (ODEIN_TEMPLE==null || ODEIN_TEMPLE==''){
document.getElementById("odentemple").style.display = "";      
document.getElementById("odentemple").innerHTML = "*กรุณาระบุชื่อวัด";
}else{
document.getElementById("odentemple").style.display = "none";
}
if (ODEIN_TEMPLE_ADD==null || ODEIN_TEMPLE_ADD==''){
document.getElementById("odentempleadd").style.display = "";      
document.getElementById("odentempleadd").innerHTML = "*กรุณาระบุที่อยู่วัด";
}else{
document.getElementById("odentempleadd").style.display = "none";
}

if (ODEIN_DATE==null || ODEIN_DATE==''){
document.getElementById("odendate").style.display = "";      
document.getElementById("odendate").innerHTML = "*กรุณาระบุวันที่";
}else{
document.getElementById("odendate").style.display = "none";
}
if (ODEN_TEMPLE_LIVE==null || ODEN_TEMPLE_LIVE==''){
document.getElementById("odentemplelive").style.display = "";      
document.getElementById("odentemplelive").innerHTML = "*กรุณาระบุชื่อวัด";
}else{
document.getElementById("odentemplelive").style.display = "none";
}
if (ODEN_TEMPLE_LIVE_ADD==null || ODEN_TEMPLE_LIVE_ADD==''){
document.getElementById("odentempleliveadd").style.display = "";      
document.getElementById("odentempleliveadd").innerHTML = "*กรุณาระบุที่อยู่วัด";
}else{
document.getElementById("odentempleliveadd").style.display = "none";
}


if (LEAVE_CONTACT_PHONE==null || LEAVE_CONTACT_PHONE==''){
document.getElementById("leavecontact_phone").style.display = "";      
document.getElementById("leavecontact_phone").innerHTML = "*กรุณาระบุเบอร์โทร";
}else{
document.getElementById("leavecontact_phone").style.display = "none";
}
if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}



//========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}

var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,checkcall_date:checkcall_date,checkbigin_date:checkbigin_date,checkend_date:checkend_date
        ,LEAVE_CONTACT_PHONE:LEAVE_CONTACT_PHONE,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID ,LEAVE_CONTACT:LEAVE_CONTACT
        ,ODEIN_TEMPLE:ODEIN_TEMPLE ,ODEIN_TEMPLE_ADD:ODEIN_TEMPLE_ADD ,ODEIN_DATE:ODEIN_DATE
        ,ODEN_TEMPLE_LIVE:ODEN_TEMPLE_LIVE ,ODEN_TEMPLE_LIVE_ADD:ODEN_TEMPLE_LIVE_ADD,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})

}else if(leavecode== '06'){

var checkcall_date=document.getElementById("checkcall_date").value;
var checkbigin_date=document.getElementById("checkbigin_date").value;
var checkend_date=document.getElementById("checkend_date").value;

var LEAVE_WORD_BEGIN=document.getElementById("LEAVE_WORD_BEGIN").value;
var LEAVE_MARRY_NAME=document.getElementById("LEAVE_MARRY_NAME").value;
var LEAVE_DATE_SPAWN=document.getElementById("LEAVE_DATE_SPAWN").value;

var LEAVE_CONTACT_PHONE=document.getElementById("LEAVE_CONTACT_PHONE").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;
var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;
var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน

if (LEAVE_WORD_BEGIN==null || LEAVE_WORD_BEGIN==''){
document.getElementById("leavewordbegin").style.display = "";      
document.getElementById("leavewordbegin").innerHTML = "*กรุณาระบุคำขึ้นต้น";
}else{
document.getElementById("leavewordbegin").style.display = "none";
}
if (LEAVE_MARRY_NAME==null || LEAVE_MARRY_NAME==''){
document.getElementById("leavemarryname").style.display = "";      
document.getElementById("leavemarryname").innerHTML = "*กรุณาระบุชื่อภริยา";
}else{
document.getElementById("leavemarryname").style.display = "none";
}
if (LEAVE_DATE_SPAWN==null || LEAVE_DATE_SPAWN==''){
document.getElementById("leavedatespawn").style.display = "";      
document.getElementById("leavedatespawn").innerHTML = "*กรุณาระบุวันที่คลอด";
}else{
document.getElementById("leavedatespawn").style.display = "none";
}

if (LEAVE_CONTACT_PHONE==null || LEAVE_CONTACT_PHONE==''){
document.getElementById("leavecontact_phone").style.display = "";      
document.getElementById("leavecontact_phone").innerHTML = "*กรุณาระบุเบอร์โทร";
}else{
document.getElementById("leavecontact_phone").style.display = "none";
}
if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}



//========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}

var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,checkcall_date:checkcall_date,checkbigin_date:checkbigin_date,checkend_date:checkend_date
        ,LEAVE_BECAUSE:LEAVE_BECAUSE,LEAVE_CONTACT_PHONE:LEAVE_CONTACT_PHONE,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID
        ,LEAVE_CONTACT:LEAVE_CONTACT,LEAVE_WORD_BEGIN:LEAVE_WORD_BEGIN,LEAVE_MARRY_NAME:LEAVE_MARRY_NAME,LEAVE_DATE_SPAWN:LEAVE_DATE_SPAWN,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})


}else if(leavecode== '07'){

var checkcall_date=document.getElementById("checkcall_date").value;
var checkbigin_date=document.getElementById("checkbigin_date").value;
var checkend_date=document.getElementById("checkend_date").value;

var ARMY_BY=document.getElementById("ARMY_BY").value;
var ARMY_NUM=document.getElementById("ARMY_NUM").value;
var ARMY_DATE=document.getElementById("ARMY_DATE").value;
var ARMY_VISIT=document.getElementById("ARMY_VISIT").value;
var ARMY_VISIT_ADD=document.getElementById("ARMY_VISIT_ADD").value;

var LEAVE_CONTACT_PHONE=document.getElementById("LEAVE_CONTACT_PHONE").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;
var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;

var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน

//alert(checkend_date);
if (ARMY_BY==null || ARMY_BY==''){
document.getElementById("armyby").style.display = "";      
document.getElementById("armyby").innerHTML = "*กรุณาระบุที่มากรุณาระบุเลขที่หมายเรียก";
}else{
document.getElementById("armyby").style.display = "none";
}
if (ARMY_NUM==null || ARMY_NUM==''){
document.getElementById("armynum").style.display = "";      
document.getElementById("armynum").innerHTML = "*กรุณาระบุเลขที่หมายเรียก";
}else{
document.getElementById("armynum").style.display = "none";
}
if (ARMY_DATE==null || ARMY_DATE==''){
document.getElementById("armydate").style.display = "";      
document.getElementById("armydate").innerHTML = "*กรุณาระบุวันที่";
}else{
document.getElementById("armydate").style.display = "none";
}
if (ARMY_VISIT==null || ARMY_VISIT==''){
document.getElementById("armyvisit").style.display = "";      
document.getElementById("armyvisit").innerHTML = "*กรุณาระบุรายละเอียดเข้ารับการ";
}else{
document.getElementById("armyvisit").style.display = "none";
}
if (ARMY_VISIT_ADD==null || ARMY_VISIT_ADD==''){
document.getElementById("armvisitadd").style.display = "";      
document.getElementById("armvisitadd").innerHTML = "*กรุณาระบุสถานที่";
}else{
document.getElementById("armvisitadd").style.display = "none";
}



if (LEAVE_CONTACT_PHONE==null || LEAVE_CONTACT_PHONE==''){
document.getElementById("leavecontact_phone").style.display = "";      
document.getElementById("leavecontact_phone").innerHTML = "*กรุณาระบุเบอร์โทร";
}else{
document.getElementById("leavecontact_phone").style.display = "none";
}
if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}
  //========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}



var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,checkcall_date:checkcall_date,checkbigin_date:checkbigin_date,checkend_date:checkend_date
        ,LEAVE_CONTACT_PHONE:LEAVE_CONTACT_PHONE,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID
        ,LEAVE_CONTACT:LEAVE_CONTACT,ARMY_BY:ARMY_BY,ARMY_NUM:ARMY_NUM
        ,ARMY_DATE:ARMY_DATE,ARMY_VISIT:ARMY_VISIT,ARMY_VISIT_ADD:ARMY_VISIT_ADD,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})

}else if(leavecode== '08'){

var checkcall_date=document.getElementById("checkcall_date").value;
var checkbigin_date=document.getElementById("checkbigin_date").value;
var checkend_date=document.getElementById("checkend_date").value;

var EDU_SUBJECT=document.getElementById("EDU_SUBJECT").value;
var EDU_BRANCH=document.getElementById("EDU_BRANCH").value;
var EDU_ACADEMY=document.getElementById("EDU_ACADEMY").value;
var EDU_TON=document.getElementById("EDU_TON").value;
var EDU_T_COURSE=document.getElementById("EDU_T_COURSE").value;
var EDU_T_LOCATION=document.getElementById("EDU_T_LOCATION").value;


var LEAVE_CONTACT_PHONE=document.getElementById("LEAVE_CONTACT_PHONE").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;
var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;

var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน

//alert(checkend_date);

if (EDU_SUBJECT==null || EDU_SUBJECT==''){
document.getElementById("edusubject").style.display = "";      
document.getElementById("edusubject").innerHTML = "*กรุณาระบุวิชา";
}else{
document.getElementById("edusubject").style.display = "none";
}
if (EDU_BRANCH==null || EDU_BRANCH==''){
document.getElementById("edubranch").style.display = "";      
document.getElementById("edubranch").innerHTML = "*กรุณาระบุชั้นปริญญา";
}else{
document.getElementById("edubranch").style.display = "none";
}
if (EDU_ACADEMY==null || EDU_ACADEMY==''){
document.getElementById("eduacademy").style.display = "";      
document.getElementById("eduacademy").innerHTML = "*กรุณาระบุสถานศึกษา";
}else{
document.getElementById("eduacademy").style.display = "none";
}
if (EDU_TON==null || EDU_TON==''){
document.getElementById("eduton").style.display = "";      
document.getElementById("eduton").innerHTML = "*กรุณาระบุทุน";
}else{
document.getElementById("eduton").style.display = "none";
}
if (EDU_T_COURSE==null || EDU_T_COURSE==''){
document.getElementById("edutcourse").style.display = "";      
document.getElementById("edutcourse").innerHTML = "*กรุณาระบุหลักสูตร";
}else{
document.getElementById("edutcourse").style.display = "none";
}
if (EDU_T_LOCATION==null || EDU_T_LOCATION==''){
document.getElementById("edutlocation").style.display = "";      
document.getElementById("edutlocation").innerHTML = "*กรุณาระบุสถานที่";
}else{
document.getElementById("edutlocation").style.display = "none";
}


if (LEAVE_CONTACT_PHONE==null || LEAVE_CONTACT_PHONE==''){
document.getElementById("leavecontact_phone").style.display = "";      
document.getElementById("leavecontact_phone").innerHTML = "*กรุณาระบุเบอร์โทร";
}else{
document.getElementById("leavecontact_phone").style.display = "none";
}
if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}

    //========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}


var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,checkcall_date:checkcall_date,checkbigin_date:checkbigin_date,checkend_date:checkend_date
        ,LEAVE_CONTACT_PHONE:LEAVE_CONTACT_PHONE,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID,LEAVE_CONTACT:LEAVE_CONTACT
        ,EDU_SUBJECT:EDU_SUBJECT,EDU_BRANCH:EDU_BRANCH,EDU_ACADEMY:EDU_ACADEMY
        ,EDU_TON:EDU_TON,EDU_T_COURSE:EDU_T_COURSE,EDU_T_LOCATION:EDU_T_LOCATION
        ,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})

}else if(leavecode== '10'){

var checkcall_date=document.getElementById("checkcall_date").value;
var checkbigin_date=document.getElementById("checkbigin_date").value;
var checkend_date=document.getElementById("checkend_date").value;

var FW_MARRY_SALARY=document.getElementById("FW_MARRY_SALARY").value;
var FW_MARRY=document.getElementById("FW_MARRY").value;
var FW_MARRY_POSITION=document.getElementById("FW_MARRY_POSITION").value;
var FW_MARRY_LEVEL=document.getElementById("FW_MARRY_LEVEL").value;
var FW_MARRY_UNDER=document.getElementById("FW_MARRY_UNDER").value;


var LEAVE_CONTACT_PHONE=document.getElementById("LEAVE_CONTACT_PHONE").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;
var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;

var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน

//alert(checkend_date);
if (FW_MARRY_SALARY==null || FW_MARRY_SALARY==''){
document.getElementById("fwmarrysalary").style.display = "";      
document.getElementById("fwmarrysalary").innerHTML = "*กรุณาระบุเงินเดือน";
}else{
document.getElementById("fwmarrysalary").style.display = "none";
}
if (FW_MARRY==null || FW_MARRY==''){
document.getElementById("fwmarry").style.display = "";      
document.getElementById("fwmarry").innerHTML = "*กรุณาระบุชื่อคู่สมรส";
}else{
document.getElementById("fwmarry").style.display = "none";
}
if (FW_MARRY_POSITION==null || FW_MARRY_POSITION==''){
document.getElementById("fwmarryposition").style.display = "";      
document.getElementById("fwmarryposition").innerHTML = "*กรุณาระบุตำแหน่ง";
}else{
document.getElementById("fwmarryposition").style.display = "none";
}
if (FW_MARRY_LEVEL==null || FW_MARRY_LEVEL==''){
document.getElementById("fwmarrylevel").style.display = "";      
document.getElementById("fwmarrylevel").innerHTML = "*กรุณาระบุระดับ";
}else{
document.getElementById("fwmarrylevel").style.display = "none";
}
if (FW_MARRY_UNDER==null || FW_MARRY_UNDER==''){
document.getElementById("fwmarryunder").style.display = "";      
document.getElementById("fwmarryunder").innerHTML = "*กรุณาระบุสังกัด";
}else{
document.getElementById("fwmarryunder").style.display = "none";
}







if (LEAVE_CONTACT_PHONE==null || LEAVE_CONTACT_PHONE==''){
document.getElementById("leavecontact_phone").style.display = "";      
document.getElementById("leavecontact_phone").innerHTML = "*กรุณาระบุเบอร์โทร";
}else{
document.getElementById("leavecontact_phone").style.display = "none";
}
if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}

        //========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}



var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,checkcall_date:checkcall_date,checkbigin_date:checkbigin_date,checkend_date:checkend_date
        ,LEAVE_CONTACT_PHONE:LEAVE_CONTACT_PHONE,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID,LEAVE_CONTACT:LEAVE_CONTACT
        ,FW_MARRY_SALARY:FW_MARRY_SALARY,FW_MARRY:FW_MARRY,FW_MARRY_POSITION:FW_MARRY_POSITION,FW_MARRY_LEVEL:FW_MARRY_LEVEL
        ,FW_MARRY_UNDER:FW_MARRY_UNDER,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})


}else if(leavecode== '12'){


var EXIT_IN_DATE=document.getElementById("EXIT_IN_DATE").value;
var EXIT_PERSON_VCODE=document.getElementById("EXIT_PERSON_VCODE").value;
var EXIT_PERSON_VCODE_DATE=document.getElementById("EXIT_PERSON_VCODE_DATE").value;
var EXIT_SALARY=document.getElementById("EXIT_SALARY").value;
var EXIT_DATE_BEGIN=document.getElementById("EXIT_DATE_BEGIN").value;
var EXIT_DATE_FINISH=document.getElementById("EXIT_DATE_FINISH").value;
var EXIT_BECAUSE=document.getElementById("EXIT_BECAUSE").value;


var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;

var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน

//alert(checkend_date);
if (EXIT_IN_DATE==null || EXIT_IN_DATE==''){
document.getElementById("exitindate").style.display = "";      
document.getElementById("exitindate").innerHTML = "*กรุณาระบุวันที่ลาออก";
}else{
document.getElementById("exitindate").style.display = "none";
}
if (EXIT_PERSON_VCODE==null || EXIT_PERSON_VCODE==''){
document.getElementById("exitpersonvcode").style.display = "";      
document.getElementById("exitpersonvcode").innerHTML = "*กรุณาระบุเลขสัญญาจ้าง";
}else{
document.getElementById("exitpersonvcode").style.display = "none";
}
if (EXIT_PERSON_VCODE_DATE==null || EXIT_PERSON_VCODE_DATE==''){
document.getElementById("exitpersonvcodedate").style.display = "";      
document.getElementById("exitpersonvcodedate").innerHTML = "*กรุณาระบุวันที่สัญญาจ้าง";
}else{
document.getElementById("exitpersonvcodedate").style.display = "none";
}
if (EXIT_SALARY==null || EXIT_SALARY==''){
document.getElementById("exitsalary").style.display = "";      
document.getElementById("exitsalary").innerHTML = "*กรุณาระบุเงินเดือน";
}else{
document.getElementById("exitsalary").style.display = "none";
}
if (EXIT_DATE_BEGIN==null || EXIT_DATE_BEGIN==''){
document.getElementById("exitdatebegin").style.display = "";      
document.getElementById("exitdatebegin").innerHTML = "*กรุณาระบุวันเริ่มต้น";
}else{
document.getElementById("exitdatebegin").style.display = "none";
}
if (EXIT_DATE_FINISH==null || EXIT_DATE_FINISH==''){
document.getElementById("exitdatefinish").style.display = "";      
document.getElementById("exitdatefinish").innerHTML = "*กรุณาระบุวันสิ้นสุด";
}else{
document.getElementById("exitdatefinish").style.display = "none";
}
if (EXIT_BECAUSE==null || EXIT_BECAUSE==''){
document.getElementById("exitbecause").style.display = "";      
document.getElementById("exitbecause").innerHTML = "*กรุณาระบุเหตุผล";
}else{
document.getElementById("exitbecause").style.display = "none";
}


if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}

   //========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}


var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID,LEAVE_CONTACT:LEAVE_CONTACT
        ,EXIT_IN_DATE:EXIT_IN_DATE,EXIT_PERSON_VCODE:EXIT_PERSON_VCODE,EXIT_PERSON_VCODE_DATE:EXIT_PERSON_VCODE_DATE,EXIT_BECAUSE:EXIT_BECAUSE
        ,EXIT_SALARY:EXIT_SALARY,EXIT_DATE_BEGIN:EXIT_DATE_BEGIN,EXIT_DATE_FINISH:EXIT_DATE_FINISH,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})




}else{

var checkcall_date=document.getElementById("checkcall_date").value;
var checkbigin_date=document.getElementById("checkbigin_date").value;
var checkend_date=document.getElementById("checkend_date").value;
var LEAVE_BECAUSE=document.getElementById("LEAVE_BECAUSE").value;
var LEAVE_CONTACT_PHONE=document.getElementById("LEAVE_CONTACT_PHONE").value;
var LEAVE_WORK_SEND_ID=document.getElementById("LEAVE_WORK_SEND_ID").value;
var LEAVE_CONTACT=document.getElementById("LEAVE_CONTACT").value;
var LEADER_PERSON_ID=document.getElementById("LEADER_PERSON_ID").value;//หัวหน้างาน
var LEADER_DEP_PERSON_ID=document.getElementById("LEADER_DEP_PERSON_ID").value;//หัวหน้างานกลุ่มงาน

//alert(checkend_date);

if (LEAVE_BECAUSE==null || LEAVE_BECAUSE==''){
document.getElementById("leavebecaus").style.display = "";      
document.getElementById("leavebecaus").innerHTML = "*กรุณาระบุข้อความ";
}else{
document.getElementById("leavebecaus").style.display = "none";
}
if (LEAVE_CONTACT_PHONE==null || LEAVE_CONTACT_PHONE==''){
document.getElementById("leavecontact_phone").style.display = "";      
document.getElementById("leavecontact_phone").innerHTML = "*กรุณาระบุเบอร์โทร";
}else{
document.getElementById("leavecontact_phone").style.display = "none";
}
if (LEAVE_WORK_SEND_ID==null || LEAVE_WORK_SEND_ID==''){
document.getElementById("leaveworksend").style.display = "";      
document.getElementById("leaveworksend").innerHTML = "*กรุณาเลือกผู้มอบหมายงาน";
}else{
document.getElementById("leaveworksend").style.display = "none";
}
if (LEAVE_CONTACT==null || LEAVE_CONTACT==''){
document.getElementById("leavecontact").style.display = "";      
document.getElementById("leavecontact").innerHTML = "*กรุณาระบุที่อยู่ติดต่อ";
}else{
document.getElementById("leavecontact").style.display = "none";
}

        //========หัวหน้าอนุมัติ========

if (LEADER_PERSON_ID==null || LEADER_PERSON_ID==''){
document.getElementById("leavecontact_leader").style.display = "";      
document.getElementById("leavecontact_leader").innerHTML = "*กรุณาระบุหัวหน้างาน";
}else{
document.getElementById("leavecontact_leader").style.display = "none";
}

if (LEADER_DEP_PERSON_ID==null || LEADER_DEP_PERSON_ID==''){
document.getElementById("leavecontact_leaderdep").style.display = "";      
document.getElementById("leavecontact_leaderdep").innerHTML = "*กรุณาระบุหัวหน้าฝ่าย";
}else{
document.getElementById("leavecontact_leaderdep").style.display = "none";
}



var _token=$('input[name="_token"]').val();
$.ajax({
     url:"{{route('leave.checkall')}}",
     method:"GET",
     data:{leavecode:leavecode,checkcall_date:checkcall_date,checkbigin_date:checkbigin_date,checkend_date:checkend_date
        ,LEAVE_BECAUSE:LEAVE_BECAUSE,LEAVE_CONTACT_PHONE:LEAVE_CONTACT_PHONE,LEAVE_WORK_SEND_ID:LEAVE_WORK_SEND_ID
        ,LEAVE_CONTACT:LEAVE_CONTACT,LEADER_PERSON_ID:LEADER_PERSON_ID,LEADER_DEP_PERSON_ID:LEADER_DEP_PERSON_ID,_token:_token},
     success:function(result){
        $('.checkall').html(result);
     }
})

}
   

} 



</script>



@endsection
