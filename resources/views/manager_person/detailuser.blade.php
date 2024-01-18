@extends('layouts.backend_person')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
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

$datenow = date('Y-m-d');
?>


<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

                .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }
</style>

<!-- Advanced Tables -->
<center>

        <div style="width:95%;">

                                <div class="block block-rounded block-bordered" align="left">


                                        <div class="block-header block-header-default ">
                                                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดข้อมูลบุคคล</B></h3>              
                                        </div>
                
                                        <div class="content">
                                        <div class="block block-rounded block-bordered">
                                                <div class="block-content">
                                                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                                                                <div class="row">
                                                                        <div class="col-lg-10">
                                                                                ข้อมูลส่วนตัว   
                                                                        </div>
                                                                <div class="col-lg-2">
                                                                        <a href="{{ url('manager_person/inforperson') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
                                                                </div>
                                                                </div>
                                                        </h2>
                
                                                <div class="row push">
                                                        <div class="col-lg-4">
                
                                                                <div class="form-group">
                
                                                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforpersonuser->HR_IMAGE)) }}"
                                                                                height="80%" width="60%">
                                                                </div>
                
                
                                                        </div>
                                                        <div class="col-lg-4">
                
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>คำนำหน้า</label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_PREFIX_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>ชื่อ</label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_FNAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>นามสกุล</label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_LNAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>ชื่ออังกฤษ</label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_EN_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>ชื่อเล่น </label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> NICKNAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>วันเกิด </label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ DateThai($inforpersonuser -> HR_BIRTHDAY) }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-5">
                                                                                        <label>เลขประจำตัวประชาชน </label>
                                                                                </div>
                                                                                <div class="col-lg-7">
                                                                                        {{ $inforpersonuser -> HR_CID }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-5">
                                                                                        <label>สถานะสมรส </label>
                                                                                </div>
                                                                                <div class="col-lg-7">
                                                                                        {{ $inforpersonuser -> HR_MARRY_STATUS_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-5">
                                                                                        <label>ศาสนา </label>
                                                                                </div>
                                                                                <div class="col-lg-7">
                                                                                        {{ $inforpersonuser -> HR_RELIGION_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                
                
                
                                                        </div>
                                                        <div class="col-lg-4">
                
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>เชื้อชาติ </label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_NATIONALITY_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>สัญชาติ </label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_CITIZENSHIP_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>เพศ </label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> SEX_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-3">
                                                                                        <label>กรุ๊ปเลือด </label>
                                                                                </div>
                                                                                <div class="col-lg-9">
                                                                                        {{ $inforpersonuser -> HR_BLOODGROUP_NAME }}
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                                <div class="form">
                                                                        <div class="row">
                                                                                <div class="col-lg-12">
                                                                                        <label>ส่วนสูง </label>
                                                                                        {{ $inforpersonuser -> HR_HIGH }}
                                                                                        <label>เซนติเมตร</label>
                                                                                        <label>น้ำหนัก </label>
                                                                                        {{ $inforpersonuser -> HR_WEIGHT }}
                                                                                        <label>กิโลกรัม</label>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-3">
                                                                                                <label>เบอร์โทร </label>
                                                                                        </div>
                                                                                        <div class="col-lg-9">
                                                                                                {{ $inforpersonuser -> HR_PHONE }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-3">
                                                                                                <label>อีเมล </label>
                                                                                        </div>
                                                                                        <div class="col-lg-9">
                                                                                                {{ $inforpersonuser -> HR_EMAIL  }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-3">
                                                                                                <label>Facebook </label>
                                                                                        </div>
                                                                                        <div class="col-lg-9">
                                                                                                <p>{{ $inforpersonuser -> HR_FACEBOOK }}
                                                                                                </p>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-3">
                                                                                                <label>Line </label>
                                                                                        </div>
                                                                                        <div class="col-lg-9">
                                                                                                {{ $inforpersonuser -> HR_LINE }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                
                                                        </div>
                
                                                </div>
                
                
                
                                                <div class="block-content">
                                                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span
                                                                        style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลอาชีพ&nbsp;&nbsp;</span>
                                                        </h2>
                                                        <div class="row push">
                                                                <div class="col-lg-4">
                                                                        <form role="form">
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>กลุ่มงาน </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> HR_DEPARTMENT_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>ฝ่าย/แผนก </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> HR_DEPARTMENT_SUB_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>หน่วยงาน </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{$inforpersonuser -> HR_DEPARTMENT_SUB_SUB_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>วันที่บรรจุ </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{DateThai($inforpersonuser -> HR_STARTWORK_DATE)}}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>เลขตำแหน่ง </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> HR_POSITION_NUM }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                        <form role="form">
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>เลขใบประกอบวิชาชีพ
                                                                                                        </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> VCODE }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>วดป.รับใบประกอบ </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ DateThai($inforpersonuser -> VCODE_DATE) }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>ตำแหน่ง </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> POSITION_IN_WORK }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>ระดับ </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> HR_LEVEL_NAME}}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-4">
                                                                                                        <label>สถานะปัจจุบัน </label>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                        {{ $inforpersonuser -> HR_STATUS_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                
                                                                        </form>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                        <form role="form">
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>กลุ่มข้าราชการ </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> HR_KIND_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>ประเภทข้าราชการ </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> HR_KIND_TYPE_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>กลุ่มบุคลากร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> HR_PERSON_TYPE_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>ต้นสังกัด </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> HR_AGENCY_ID }}
                
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>เงินเดือน</label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ number_format($inforpersonuser -> HR_SALARY,2) }}
                                                                                                        <label>บาท</label>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>เงินประจำตำแหน่ง</label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ number_format($inforpersonuser -> MONEY_POSITION,2) }}
                                                                                                        <label>บาท</label>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                        </div>
                
                                                </div>
                
                
                                                <div class="block-content">
                                                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span
                                                                        style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลที่อยู่อาศัยปัจจุบัน&nbsp;&nbsp;</span>
                                                        </h2>
                                                        <div class="row">
                
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>บ้านเลขที่ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser ->HR_HOME_NUMBER  }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>ตำบล </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> TUMBON_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>หมู่ที่ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser ->HR_VILLAGE_NO  }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>อำเภอ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> AMPHUR_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>ถนน </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{  $inforpersonuser -> HR_ROAD_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>จังหวัด </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> PROVINCE_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>ซอย </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> HR_SOI_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-5">
                                                                                                <label>รหัสไปรษณีย์ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-7">
                                                                                                {{ $inforpersonuser -> HR_ZIPCODE }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                        </div>
                                                </div>
                
                
                                                <div class="block-content">
                                                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span
                                                                        style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลที่อยู่อาศัยตามทะเบียนบ้าน&nbsp;&nbsp;</span>
                                                        </h2>
                                                        <div class="row push">
                
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>บ้านเลขที่ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> HR_HOME_NUMBER_1 }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>ตำบล </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforadd2 -> TUMBON_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>หมู่ที่ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> HR_VILLAGE_NO_1 }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>อำเภอ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforadd2 -> AMPHUR_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>ถนน </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{  $inforpersonuser -> HR_ROAD_NAME_1 }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>จังหวัด </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforadd2 -> PROVINCE_NAME }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-4">
                                                                                                <label>ซอย </label>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
                                                                                                {{ $inforpersonuser -> HR_SOI_NAME_1 }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="form">
                                                                                <div class="row">
                                                                                        <div class="col-lg-5">
                                                                                                <label>รหัสไปรษณีย์ </label>
                                                                                        </div>
                                                                                        <div class="col-lg-7">
                                                                                                {{ $inforpersonuser -> HR_ZIPCODE_1 }}
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                
                                                                </div>
                                                        </div>
                                                </div>
                
                
                                                <div class="block-content">
                                                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span
                                                                        style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลบัญชีธนาคาร&nbsp;&nbsp;</span>
                                                        </h2>
                                                       
                                                        <div class="row">
                                                                <div class="col-lg-3">
                                                                        <form role="form">
                                                                                <div class="form">
                
                                                                                        <label>เงินค่าตอบแทน </label>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>เลขบัญชีธนาคาร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_NUMBER }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>ชื่อบัญชีธนาคาร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>ธนาคาร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>สาขา </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_BRANCH }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                        <form role="form">
                                                                                <div class="form">
                                                                                        <label>เงินค่าตอบแทน OT</label>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>เลขบัญชีธนาคาร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_OT_NUMBER }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>ชื่อบัญชีธนาคาร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_OT_NAME }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>ธนาคาร </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_OT }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="form">
                                                                                        <div class="row">
                                                                                                <div class="col-lg-5">
                                                                                                        <label>สาขา </label>
                                                                                                </div>
                                                                                                <div class="col-lg-7">
                                                                                                        {{ $inforpersonuser -> BOOK_BANK_OT_BRANCH }}
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                
                                                                        </form>
                                                                </div>
                                                                <div class="col-lg-3">
                
                                                                </div>
                                                        </div>                
                                                </div>

                                                <div class="block-content">
                                                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span
                                                                style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลการเลือนขั้นเงินเดือน&nbsp;&nbsp;</span>
                                                        </h2>
                                                        <div class="row">
                                                                <div class="col-12">
                                                                        <div class="table-responsive"> 
                                                                                <table class="gwt-table table-striped table-vcenter" width="100%">
                                                                                    <thead style="background-color: #FFEBCD;">                  
                                                                                        <tr height="40">
                                                                                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">เลขที่คำสั่ง</th>
                                                                                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ลงวันที่</th>
                                                                                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="20%">ตำแหน่ง</th>
                                                                                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">ระดับ</th>
                                                                                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เงินเดือนใหม่</th>   
                                                                                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">หมายเหตุ</th>     
                                                                                              <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">คำสั่ง</th>                         
                                                                                          </tr>                  
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach ($infosalarys as $infosalary)
                                                                                      <tr height="20">
                                                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="20%">{{ $infosalary-> SALARY_NUMBER }}</td>
                                                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%">{{ DateThai($infosalary-> DATE_CHANGE)}} </td> 
                                                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="20%">{{ $infosalary-> POSITION_IN_WORK }}</td> 
                                                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="8%">{{ $infosalary-> LAVEL_NAME }}</td> 
                                                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: right;border: 1px solid black;" width="10%">{{ number_format($infosalary-> SALARYNEW,2) }}&nbsp;&nbsp;&nbsp;&nbsp;</td> 
                                                                                            <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" width="10%"> {{ $infosalary-> COMMENT }}</td> 
                                                                                            <td style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">
                                                                                                <div class="dropdown">
                                                                                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                                                                                                    ทำรายการ
                                                                                                    </button>
                                                                                                              <div class="dropdown-menu" style="width:10px">
                                                                                                                <a class="dropdown-item" href="#edit_modal{{ $infosalary -> ID }}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                                                                                <a class="dropdown-item" href="{{ url('manager_person/infousersalary_destroy/'.$infosalary->ID.'/'.$infosalary->PERSON_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลการเลือนขั้นเงินเดือน ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบข้อมูล</a>
                                                                                                              
                                                                                                            </div>
                                                                                                </div>
                                                                                            </td>  
                                                                                      </tr> 
                                                          
                                                                                                  
                                                          
                                                                                            <div id="edit_modal{{ $infosalary -> ID }}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                                              <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                
                                                                                                      <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขข้อมูลการเลือนขั้นเงินเดือน</h2>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                    <body>
                                                                                                    <form  method="post" id="form_edit{{ $infosalary -> ID }}"  action="{{ route('mperson.infousersalaryupdate') }}" >
                                                                                                    @csrf
                                                                                                    <input type="hidden" name="ID" value="{{ $infosalary -> ID }}"/>
                                                          
                                                                                                    <div class="form-group">
                                                                                                    <div class="row">
                                                                                                  <div class="col-sm-3 text-left">
                                                                                                  <label >เลขที่คำสั่ง</label>
                                                                                                  </div>
                                                                                                  <div class="col-sm-9">
                                                                                                  <input  name = "SALARY_NUMBER_edit"  id="SALARY_NUMBER_edit"  class="form-control input-lg {{ $errors->has('SALARY_NUMBER_edit') ? 'is-invalid' : '' }}"  value="{{$infosalary-> SALARY_NUMBER}}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  </div>
                                                          
                                                                                                    <div class="form-group">
                                                                                                    <div class="row">
                                                                                                  <div class="col-sm-3 text-left">
                                                                                                  <label >ลงวันที่</label>
                                                                                                  </div>
                                                                                                  <div class="col-sm-9">
                                                                                                  <input  name = "DATE_CHANGE_edit"  id="DATE_CHANGE_edit"  class="form-control input-lg datepicker3 {{ $errors->has('DATE_CHANGE_edit') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="{{ formate($infosalary-> DATE_CHANGE) }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  </div>
                                                                                                
                                                                                                  <div class="form-group">
                                                                                                  <div class="row">
                                                                                                  <div class="col-sm-3 text-left">
                                                                                                  <label >ตำแหน่ง</label>
                                                                                                  </div>
                                                                                                  <div class="col-sm-9">
                                                                                                
                                                                                                  <select name="POSITION_ID_edit" id="POSITION_ID_edit" class="form-control input-lg {{ $errors->has('POSITION_ID_edit') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;width:100%;" >
                                                                                                          <option value="">--กรุณาเลือก--</option>
                                                                                                        @foreach ($infopositions as $infoposition) 
                                                          
                                                                                                            @if($infosalary-> POSITION_ID == $infoposition ->HR_POSITION_ID)
                                                                                                            <option value="{{ $infoposition ->HR_POSITION_ID  }}" selected>{{ $infoposition->HR_POSITION_NAME }}</option>
                                                                                                            @else
                                                                                                            <option value="{{ $infoposition ->HR_POSITION_ID  }}">{{ $infoposition->HR_POSITION_NAME }}</option>
                                                                                                            @endif
                                                                                                        
                                                                                                        @endforeach 
                                                                                                </select>
                                                                                                  
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  <div class="form-group">
                                                                                                  <div class="row">
                                                                                                  <div class="col-sm-3 text-left">
                                                                                                  <label >ระดับ</label>
                                                                                                  </div>
                                                                                                  <div class="col-sm-9">
                                                                                              
                                                                                                  
                                                                                                  <select name="LAVEL_ID_edit" id="LAVEL_ID_edit" class="form-control input-lg {{ $errors->has('LAVEL_ID_edit') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;width:100%;" >
                                                                                                        <option value="">--กรุณาเลือก--</option>
                                                                                                        @foreach ($infolevels as $infolevel) 
                                                          
                                                                                                            @if($infosalary-> LAVEL_ID == $infolevel ->HR_LEVEL_ID)
                                                                                                            <option value="{{ $infolevel ->HR_LEVEL_ID  }}" selected>{{ $infolevel->HR_LEVEL_NAME  }}</option>
                                                                                                            @else
                                                                                                            <option value="{{ $infolevel ->HR_LEVEL_ID  }}">{{ $infolevel->HR_LEVEL_NAME  }}</option>
                                                                                                            @endif
                                                                                                      
                                                                                                        @endforeach 
                                                                                                  </select>
                                                                                                  
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  </div>
                                                                                              
                                                                                                  <div class="form-group">
                                                                                                  <div class="row">
                                                                                                  <div class="col-sm-3 text-left">
                                                                                                  <label >เงินเดือนใหม่</label>
                                                                                                  </div>
                                                                                                  <div class="col-sm-9">
                                                                                                  <input  name = "SALARYNEW_edit"  id="SALARYNEW_edit" OnKeyPress="return chkmunny(this)" class="form-control input-lg {{ $errors->has('SALARYNEW_edit') ? 'is-invalid' : '' }}" value="{{ $infosalary -> SALARYNEW }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  <div class="form-group">
                                                                                                  <div class="row">
                                                                                                  <div class="col-sm-3 text-left">
                                                                                                  <label >หมายเหตุ</label>
                                                                                                  </div>
                                                                                                  <div class="col-sm-9">
                                                                                                  <input  name = "COMMENT"  id="COMMENT" class="form-control input-lg" value="{{ $infosalary -> COMMENT }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                                                                                                  </div>
                                                                                                  </div>
                                                                                                  </div>
                                                          
                                                                                                  <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $userid->ID }} ">
                                                                                                  <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">
                                                          
                                                          
                                                                                                  </div>
                                                                                                    <div class="modal-footer">
                                                                                                    <div align="right">
                                                                                                    <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-edit" onclick="editnumber({{ $infosalary -> ID }});"><i class="fas fa-save"></i> &nbsp;บันทึกแก้ไขข้อมูล</span>
                                                                                                    <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
                                                                                                    </div>
                                                                                                    </div>
                                                                                                    </form>  
                                                                                            </body>
                                                                                                
                                                                                                
                                                                                              </div>
                                                                                            </div>
                                                                                          </div>
                                                          
                                                                                @endforeach 
                                                                                </tbody>
                                                                                </table>
                                                                </div>
                                                        </div>
                                                </div>
                                                        <!--<div align="right"><a href="{{ url('person/personinfouser/edit/'.$userid -> ID)}}"  class="btn btn-warning btn-lg" >แก้ไขข้อมูล</a></div> <br>-->
                
                                                        <hr>
                                                <div align="right">
                                                        <a href="{{ url('manager_person/inforperson')}}"
                                                        class="btn btn-danger"><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</a><br><br>
                                                </div>
                
                                                </div>
                                        </div>

                                </div>

                        </div>
                {{-- </div> --}}

               
        </div>


        <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                  <div class="modal-header">
                        
                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">เพิ่มข้อมูลการเลือนขั้นเงินเดือน</h2>
                      </div>
                      <div class="modal-body">
                      <body>
                      <form  method="post" id="form_add"  action="{{ route('mperson.infousersalarysave') }}" >
                      @csrf

                      
                      <div class="form-group">
                      <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >เลขที่คำสั่ง</label>
                    </div>
                    <div class="col-sm-9">
                    <input  name = "SALARY_NUMBER"  id="SALARY_NUMBER"  class="form-control input-lg {{ $errors->has('SALARY_NUMBER') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
                    </div>
                    </div>
                    </div>

                      <div class="form-group">
                      <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >ลงวันที่</label>
                    </div>
                    <div class="col-sm-9">
                    <input  name = "DATE_CHANGE"  id="DATE_CHANGE"  class="form-control input-lg datepicker {{ $errors->has('DATE_CHANGE') ? 'is-invalid' : '' }}" data-date-format="mm/dd/yyyy" value="{{formate($datenow)}}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" readonly>
                    </div>
                    </div>
                    </div>
                  
                    <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >ตำแหน่ง</label>
                    </div>
                    <div class="col-sm-9">
                  
                    <select name="POSITION_ID" id="POSITION_ID" class="form-control input-lg{{ $errors->has('POSITION_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;width:100%;" >
                            <option value="">--กรุณาเลือก--</option>
                          @foreach ($infopositions as $infoposition) 
                                @if ($inforpersonuser ->HR_POSITION_ID == $infoposition ->HR_POSITION_ID )
                                <option value="{{ $infoposition ->HR_POSITION_ID}}" selected>{{ $infoposition->HR_POSITION_NAME }}</option>
                                @else
                                <option value="{{ $infoposition ->HR_POSITION_ID}}">{{ $infoposition->HR_POSITION_NAME }}</option>
                                @endif
                           
                          @endforeach 
                  </select>
                    
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >ระดับ</label>
                    </div>
                    <div class="col-sm-9">
                
                    
                    <select name="LAVEL_ID" id="LAVEL_ID" class="form-control input-lg{{ $errors->has('LAVEL_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;width:100%;" >
                          <option value="">--กรุณาเลือก--</option>
                          @foreach ($infolevels as $infolevel) 
                          @if ($inforpersonuser ->HR_LEVEL_ID == $infolevel ->HR_LEVEL_ID )
                          <option value="{{ $infolevel ->HR_LEVEL_ID}}" selected>{{ $infolevel->HR_LEVEL_NAME }}</option>
                          @else
                          <option value="{{ $infolevel ->HR_LEVEL_ID  }}">{{ $infolevel->HR_LEVEL_NAME  }}</option>
                          @endif
                           
                          @endforeach 
                    </select>
                    
                    </div>
                    </div>
                    </div>
                  <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >เงินเดือนใหม่</label>
                    </div>
                    <div class="col-sm-9">
                    <input  name = "SALARYNEW"  id="SALARYNEW" OnKeyPress="return chkmunny(this)"  class="form-control input-lg {{ $errors->has('SALARYNEW') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                    <div class="col-sm-3 text-left">
                    <label >หมายเหตุ</label>
                    </div>
                    <div class="col-sm-9">
                    <input  name = "COMMENT"  id="COMMENT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
                    </div>
                    </div>
                  </div>
              
                  <input type="hidden" name = "PERSON_ID"  id="PERSON_ID"  value="{{ $userid->ID }} ">
                  <input type="hidden" name = "USER_EDIT_ID"  id="USER_EDIT_ID" value="{{ $id_user }} ">

                  </div>
                    <div class="modal-footer">
                      <div align="right">
                      <span type="button"  class="btn btn-hero-sm btn-hero-info btn-submit-add" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</span>
                      <span type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</span>
                      </div>
                    </div>
                    </form>  
                </div>
        </div>


        </main>
        @endsection

        @section('footer')
        <script src="{{ asset('select2/select2.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
        <script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>
        
        <script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
        <script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

        <script>
                $(document).ready(function() {
    $("select").select2();
});

                $('#edit_modal').on('show.bs.modal', function(e) {
                  var Id = $(e.relatedTarget).data('id');
                  var VUTId = $(e.relatedTarget).data('vutid');
                  $(e.currentTarget).find('input[name="ID"]').val(Id);
                  $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);
              
              });
              
              </script>
              
              <script>
                 $(document).ready(function () {
                          
                          $('.datepicker').datepicker({
                              format: 'dd/mm/yyyy',
                              todayBtn: true,
                              language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                              thaiyear: true,
                              autoclose: true               //Set เป็นปี พ.ศ.
                          });  //กำหนดเป็นวันปัจุบัน
                  });
              
                  $(document).ready(function () {
                          
                          $('.datepicker2').datepicker({
                              format: 'dd/mm/yyyy',
                              todayBtn: true,
                              language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                              thaiyear: true,
                              autoclose: true               //Set เป็นปี พ.ศ.
                          }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
                  });
              
                  $(document).ready(function () {
                          
                          $('.datepicker3').datepicker({
                              format: 'dd/mm/yyyy',
                              todayBtn: true,
                              language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                              thaiyear: true,
                              autoclose: true               //Set เป็นปี พ.ศ.
                          });  //กำหนดเป็นวันปัจุบัน
                  });
              
                  function chkmunny(ele){
              var vchar = String.fromCharCode(event.keyCode);
              if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
              ele.onKeyPress=vchar;
              }
                  
              
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
              
              
              
              $('.btn-submit-add').click(function (e) { 
              
              
              
              var form = $('#form_add');
              formSubmit(form)
                     
              });
              
              function editnumber(number){ 
                          var form = $('#form_edit'+number);
                          formSubmit(form)      
                          }
              
                
              </script>
        @endsection