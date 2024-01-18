@extends('layouts.personhealth')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
        
      }

       .text-pedding{
   padding-left:10px;
}

.text-font {
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

  
?>
  <body onload="bodysize()">         
           <br>
           <br>
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ยืนยันการตรวจ</B></h3>
                           
                        </div>
                        <div class="block-content block-content-full">
          
          <div class="row">

          <div class="col-lg-6" style="text-align: left;">

           
          
          <div class="block block-rounded block-bordered" aligh="left">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #E6E6FA;">
                                <li class="nav-item">
                                        <a class="nav-link active" href="#object9" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูลพื้นฐาน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ข้อมูลครอบครัว</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object2" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ประวัติการเจ็บป่วย</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object3" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การสูบบุหรี่</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object4" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การดื่มแอลกอฮอล์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object5" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การออกกำลังกาย</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object6" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การรับประทานอาหาร</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object7" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">การขับขี่หรือโดยสาร</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#object8" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">เพศสัมพันธ์</a>
                                    </li>
                                  


                                  
                                </ul>
                                     <div class="block-content tab-content">

                                        <div class="tab-pane active" id="object9" role="tabpanel">

                        <div class="row push">
                            <div class="col-sm-4">
                                <img id="image_upload_preview" src="data:image/png;base64,{{ chunk_split(base64_encode($infoperson->HR_IMAGE)) }}" height="200px" width="200px"> 
                            </div>
                            <div class="col-sm-8">       
                                <div class="row push">
                                    
                                            <div class="col-sm-6">
                                            {{$infoperson->HR_PREFIX_NAME}} {{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}
                                            </div>
                                            <div class="col-sm-1">
                                            CID 
                                            </div>
                                            <div class="col-sm-5">
                                            {{$infoperson->HR_CID}}
                                            </div>
                                </div>
                                <div class="row push">
                                            <div class="col-sm-6">
                                            สถานะ
                                            </div>
                                            <div class="col-sm-6">
                                            {{$infoperson->HR_MARRY_STATUS_NAME}}
                                            </div>
                                </div>
                                <div class="row push">
                                            <div class="col-sm-6">
                                            กรุ๊ปเลือด
                                            </div>
                                            <div class="col-sm-6">
                                            {{$infoperson->HR_BLOODGROUP_NAME}}
                                            </div>
                                </div>
                                <div class="row push">
                                            <div class="col-sm-6">
                                            หน่วยงาน
                                            </div>
                                            <div class="col-sm-6">
                                            {{$infoperson->HR_DEPARTMENT_SUB_SUB_NAME}}
                                            </div>
                                </div>
                                <div class="row push">
                                <div class="col-sm-6">
                                        วันที่คัดกรอง
                                        </div>
                                        <div class="col-sm-6">
                                        {{ DateThai($inforef -> HEALTH_SCREEN_DATE) }}

                                        </div>
                                </div>

                                <div class="row push">
                      
                                  

                                        <div class="col-sm-2">
                                        อายุ
                                        </div>
                                        <div class="col-sm-2">
                                        {{ $inforef -> HEALTH_SCREEN_AGE }}


                                        </div>
                                        <div class="col-sm-2">
                                        ปี
                                        </div>
                                      

                                        </div>

                                        <div class="row push">
                                        <div class="col-sm-2">
                                        ส่วนสูง
                                        </div>
                                        <div class="col-sm-2">
                                        {{$inforef->HEALTH_SCREEN_HEIGHT}}
                                        </div>
                                        <div class="col-sm-2">
                                        เซนติเมตร 
                                        </div>


                                        <div class="col-sm-2">
                                        น้ำหนัก
                                        </div>
                                        <div class="col-sm-2">
                                        {{$inforef->HEALTH_SCREEN_WEIGHT}}
                                        </div>
                                        <div class="col-sm-2">
                                        กิโลกรัม
                                        </div>

                                        </div>
                                        <div class="row push">

                                        <div class="col-sm-4">
                                        ดัชนีมวลกาย
                                        </div>
                                        <div class="col-sm-4">
                                        {{$inforef->HEALTH_SCREEN_BODY}}
                                        <input type="hidden" name = "HEALTH_SCREEN_BODY"  id="HEALTH_SCREEN_BODY" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$inforef->HEALTH_SCREEN_BODY}}">
                                        </div>
                                        <div class="col-sm-4">
                                        กก./ตร.ม.
                                        </div>

                                        </div>
                                        <div class="row push">
                
                                        <div class="col-sm-6">
                                       BMI
                                        </div>

                                        <div class="col-sm-6" style="font-size: 20px;">
                                        <div class="bodysize" ></div>  
                                        </div>
                                        
                                        </div>
                                        <br>
                                           <table>
                                           <tr>
                                                <td>ดัชนีมวลกาย (BMI)</td>
                                                <td></td>
                                           <tr>
                                           <tr>
                                                <td>น้อยกว่า 18</td>
                                                <td>นน. ต่ำกว่าเกณฑ์</td>
                                           <tr>
                                           <tr>
                                                <td>18.5-22.9</td>
                                                <td>สมส่วน</td>
                                           <tr>
                                           <tr>
                                                <td>23.0-24.9</td>
                                                <td>น้ำหนักเกิน</td>
                                           <tr>
                                           <tr>
                                                <td>25.0-29.9</td>
                                                <td>โรคอ้วน</td>
                                           <tr>
                                           <tr>
                                                <td>มากกว่า 30</td>
                                                <td>โรคอ้วนอันตราย</td>
                                           <tr>
                                           </table>

                
                                        </div>
            </div>
    </div>    
                                        <div class="tab-pane" id="object1" role="tabpanel">
                                      
                                         บิดาหรือมารดามีประวัติการเจ็บป่วยด้วย <br> <br>

                                            <div class="row">

                                                    <div class="col-sm-2">
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_DIA" name="HEALTH_SCREEN_FM_DIA" <?php if($inforef->HEALTH_SCREEN_FM_DIA == 'on'){echo "checked";} ?>>
                                                    &nbsp;เบาหวาน
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_BLOOD" name="HEALTH_SCREEN_FM_BLOOD" <?php if($inforef->HEALTH_SCREEN_FM_BLOOD == 'on'){echo "checked";} ?>>
                                                    &nbsp;ความดันโลหิตสูง
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_GOUT" name="HEALTH_SCREEN_FM_GOUT" <?php if($inforef->HEALTH_SCREEN_FM_GOUT == 'on'){echo "checked";} ?>>
                                                    &nbsp;โรคเกาท์
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_KIDNEY" name="HEALTH_SCREEN_FM_KIDNEY" <?php if($inforef->HEALTH_SCREEN_FM_KIDNEY == 'on'){echo "checked";} ?>>
                                                    &nbsp;ไตวายเรื้อรัง
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_HEART" name="HEALTH_SCREEN_FM_HEART" <?php if($inforef->HEALTH_SCREEN_FM_HEART == 'on'){echo "checked";} ?>>
                                                    &nbsp;กล้ามเนื้อหัวใจตาย
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_BRAIN" name="HEALTH_SCREEN_FM_BRAIN" <?php if($inforef->HEALTH_SCREEN_FM_BRAIN == 'on'){echo "checked";} ?>>
                                                    &nbsp;เส้นเลือดในสมอง
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_EMPHY" name="HEALTH_SCREEN_FM_EMPHY" <?php if($inforef->HEALTH_SCREEN_FM_EMPHY == 'on'){echo "checked";} ?>>
                                                    &nbsp;ถุงลมโป่งพอง
                                                    </div> 
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_UNKNOW" name="HEALTH_SCREEN_FM_UNKNOW" <?php if($inforef->HEALTH_SCREEN_FM_UNKNOW == 'on'){echo "checked";} ?>>
                                                    &nbsp;ไม่ทราบ
                                                    </div>  
                                                    <div class="col-sm-2"> 
                                                    <input type="checkbox" id="HEALTH_SCREEN_FM_OTHER" name="HEALTH_SCREEN_FM_OTHER" <?php if($inforef->HEALTH_SCREEN_FM_OTHER == 'on'){echo "checked";} ?>>
                                                    &nbsp;อื่นๆ
                                                    </div>   

                                            </div>
                                            <br> <br>
                                            พี่น้อง (สายตรง) มีประวัติการเจ็บป่วยด้วย <br> <br>

                                        <div class="row">

                                                <div class="col-sm-2">
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_DIA" name="HEALTH_SCREEN_BS_DIA" <?php if($inforef->HEALTH_SCREEN_BS_DIA == 'on'){echo "checked";} ?>>
                                                &nbsp;เบาหวาน
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_BLOOD" name="HEALTH_SCREEN_BS_BLOOD" <?php if($inforef->HEALTH_SCREEN_BS_BLOOD == 'on'){echo "checked";} ?>>
                                                &nbsp;ความดันโลหิตสูง
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_GOUT" name="HEALTH_SCREEN_BS_GOUT" <?php if($inforef->HEALTH_SCREEN_BS_GOUT == 'on'){echo "checked";} ?>>
                                                &nbsp;โรคเกาท์
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_KIDNEY" name="HEALTH_SCREEN_BS_KIDNEY" <?php if($inforef->HEALTH_SCREEN_BS_KIDNEY == 'on'){echo "checked";} ?>>
                                                &nbsp;ไตวายเรื้อรัง
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_HEART" name="HEALTH_SCREEN_BS_HEART" <?php if($inforef->HEALTH_SCREEN_BS_HEART == 'on'){echo "checked";} ?>>
                                                &nbsp;กล้ามเนื้อหัวใจตาย
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_BRAIN" name="HEALTH_SCREEN_BS_BRAIN" <?php if($inforef->HEALTH_SCREEN_BS_BRAIN == 'on'){echo "checked";} ?>>
                                                &nbsp;เส้นเลือดในสมอง
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_EMPHY" name="HEALTH_SCREEN_BS_EMPHY" <?php if($inforef->HEALTH_SCREEN_BS_EMPHY == 'on'){echo "checked";} ?>>
                                                &nbsp;ถุงลมโป่งพอง
                                                </div> 
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_UNKNOW" name="HEALTH_SCREEN_BS_UNKNOW" <?php if($inforef->HEALTH_SCREEN_BS_UNKNOW == 'on'){echo "checked";} ?>>
                                                &nbsp;ไม่ทราบ
                                                </div>  
                                                <div class="col-sm-2"> 
                                                <input type="checkbox" id="HEALTH_SCREEN_BS_OTHER" name="HEALTH_SCREEN_BS_OTHER" <?php if($inforef->HEALTH_SCREEN_BS_OTHER == 'on'){echo "checked";} ?>>
                                                &nbsp;อื่นๆ
                                                </div>   

                                        </div>
                                        <br><br>
                                                  
                                        </div>
                                        <div class="tab-pane" id="object2" role="tabpanel">
                                      
                                        ประวัติเจ็บป่วยในปีที่ผ่านมา <br><br>
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_1">
                                                                เบาหวาน
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_1">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_1" name="HEALTH_SCREEN_H_1"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_1 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_1">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_1" name="HEALTH_SCREEN_H_1"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_1 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_1">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_1" name="HEALTH_SCREEN_H_1"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_1 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_2">
                                                                ความดันโลหิตสูง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_2">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_2" name="HEALTH_SCREEN_H_2"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_2 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_2">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_2" name="HEALTH_SCREEN_H_2"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_2 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_2">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_2" name="HEALTH_SCREEN_H_2"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_2 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_3">
                                                                โรคตับ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_3">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_3" name="HEALTH_SCREEN_H_3"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_3 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_3">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_3" name="HEALTH_SCREEN_H_3"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_3 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_3">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_3" name="HEALTH_SCREEN_H_3"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_3 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_4">
                                                                โรคอัมพาต
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_4">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_4" name="HEALTH_SCREEN_H_4"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_4 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_4">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_4" name="HEALTH_SCREEN_H_4"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_4 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_4">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_4" name="HEALTH_SCREEN_H_4"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_4 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_5">
                                                                โรคหัวใจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_5">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_5" name="HEALTH_SCREEN_H_5"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_5 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_5">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_5" name="HEALTH_SCREEN_H_5"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_5 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_5">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_5" name="HEALTH_SCREEN_H_5"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_5 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_6">
                                                                ไขมันในเลือดผิดปกติ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_6">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_6" name="HEALTH_SCREEN_H_6"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_6 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_6">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_6" name="HEALTH_SCREEN_H_6"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_6 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_6">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_6" name="HEALTH_SCREEN_H_6"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_6 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_7">
                                                                แผลที่เท้า
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_7">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_7" name="HEALTH_SCREEN_H_7"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_7 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_7">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_7" name="HEALTH_SCREEN_H_7"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_7 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_7">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_7" name="HEALTH_SCREEN_H_7"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_7 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_8">
                                                                คลอดบุตรน้ำหนักเกิน 4 กิโลกรัม
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_8">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_8" name="HEALTH_SCREEN_H_8"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_8 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_8">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_8" name="HEALTH_SCREEN_H_8"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_8 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_8">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_8" name="HEALTH_SCREEN_H_8"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_8 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_9">
                                                                ดื่มน้ำบ่อยและมาก
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_9">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_9" name="HEALTH_SCREEN_H_9"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_9 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_9">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_9" name="HEALTH_SCREEN_H_9"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_9 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_9">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_9" name="HEALTH_SCREEN_H_9"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_9 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_10">
                                                                ปัสสาวะกลางคืน 3 ครั้งขึ้นไป
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_10">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_10" name="HEALTH_SCREEN_H_10"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_10 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_10">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_10" name="HEALTH_SCREEN_H_10"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_10 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_10">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_10" name="HEALTH_SCREEN_H_10"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_10 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_11">
                                                                กินจุแต่ผอมลง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_11">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_11" name="HEALTH_SCREEN_H_11"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_11 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_11">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_11" name="HEALTH_SCREEN_H_11"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_11 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_11">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_11" name="HEALTH_SCREEN_H_11"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_11 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_12">
                                                                น้ำหนักลด/อ่อนเพลีย
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_12">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_12" name="HEALTH_SCREEN_H_12"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_12 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_12">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_12" name="HEALTH_SCREEN_H_12"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_12 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_12">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_12" name="HEALTH_SCREEN_H_12"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_12 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_13">
                                                                เป็นแผลที่ริมฝีปากบ่อย
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_13">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_13" name="HEALTH_SCREEN_H_13"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_13 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_13">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_13" name="HEALTH_SCREEN_H_13"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_13 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_13">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_13" name="HEALTH_SCREEN_H_13"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_13 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_14">
                                                                คันตามผิวหนัง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_14">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_14" name="HEALTH_SCREEN_H_14"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_14 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_14">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_14" name="HEALTH_SCREEN_H_14"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_14 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_14">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_14" name="HEALTH_SCREEN_H_14"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_14 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_15">
                                                                ตาพร่ามัวต้องเปลี่ยนแว่นบ่อย
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_15">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_15" name="HEALTH_SCREEN_H_15"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_15 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_15">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_15" name="HEALTH_SCREEN_H_15"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_15 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_15">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_15" name="HEALTH_SCREEN_H_15"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_15 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_16">
                                                                ชาตามปลายมือปลายเท้าโดยไม่ทราบสาเหตุ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_16">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_16" name="HEALTH_SCREEN_H_16"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_16 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_16">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_16" name="HEALTH_SCREEN_H_16"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_16 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_16">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_16" name="HEALTH_SCREEN_H_16"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_16 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_17">
                                                                ท้องผูกสลับท้องเสีย ท้องอืด เกิน 6 สัปดาห์
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_17">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_17" name="HEALTH_SCREEN_H_17"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_17 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_17">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_17" name="HEALTH_SCREEN_H_17"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_17 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_17">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_17" name="HEALTH_SCREEN_H_17"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_17 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_18">
                                                                ปัสสาวะปนเลือด ปัสสาวะลำบาก
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_18">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_18" name="HEALTH_SCREEN_H_18"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_18 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_18">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_18" name="HEALTH_SCREEN_H_18"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_18 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_18">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_18" name="HEALTH_SCREEN_H_18"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_18 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_19">
                                                                เลือดออกผิดปกติประจำเดือนออกมาก
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_19">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_19" name="HEALTH_SCREEN_H_19"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_19 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_19">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_19" name="HEALTH_SCREEN_H_19"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_19 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_19">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_19" name="HEALTH_SCREEN_H_19"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_19 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_20">
                                                                แผลเรื้อรังไม่หายใน 3 สัปดาห์
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_20">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_20" name="HEALTH_SCREEN_H_20"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_20 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_20">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_20" name="HEALTH_SCREEN_H_20"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_20 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_20">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_20" name="HEALTH_SCREEN_H_20"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_20 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_21">
                                                                มีก้อนที่เต้านมหรือตามตัว
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_21">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_21" name="HEALTH_SCREEN_H_21"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_21 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_21">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_21" name="HEALTH_SCREEN_H_21"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_21 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_21">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_21" name="HEALTH_SCREEN_H_21"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_21 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_22">
                                                                ไฝโตขึ้นหรือเปลี่ยนสี
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_22">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_22" name="HEALTH_SCREEN_H_22"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_22 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_22">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_22" name="HEALTH_SCREEN_H_22"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_22 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_22">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_22" name="HEALTH_SCREEN_H_22"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_22 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_23">
                                                                ไอเรื้อรังหรือเสียงแหบเกิน 1 เดือน
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_23">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_23" name="HEALTH_SCREEN_H_23"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_23 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_23">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_23" name="HEALTH_SCREEN_H_23"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_23 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_23">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_23" name="HEALTH_SCREEN_H_23"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_23 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_24">
                                                                น้ำหนักลดเกินร้อยละ 10 ใน 6 เดือน
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_24">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_24" name="HEALTH_SCREEN_H_24"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_24 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_24">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_24" name="HEALTH_SCREEN_H_24"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_24 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_24">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_24" name="HEALTH_SCREEN_H_24"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_24 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_25">
                                                                หูอื้อเรื้อรัง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_25">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_25" name="HEALTH_SCREEN_H_25"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_25 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_25">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_25" name="HEALTH_SCREEN_H_25"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_25 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_25">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_25" name="HEALTH_SCREEN_H_25"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_25 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_26">
                                                                เคยตัวเหลือง ตาเหลือง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_26">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_26" name="HEALTH_SCREEN_H_26"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_26 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_26">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_26" name="HEALTH_SCREEN_H_26"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_26 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_26">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_26" name="HEALTH_SCREEN_H_26"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_26 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_27">
                                                                เคยตรวจพบเชื้อไวรัสตับอักเสบ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_27">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_27" name="HEALTH_SCREEN_H_27"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_27 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_27">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_27" name="HEALTH_SCREEN_H_27"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_27 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_27">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_27" name="HEALTH_SCREEN_H_27"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_27 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_28">
                                                                เป็นโรคต่อมธัยรอยด์
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_28">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_28" name="HEALTH_SCREEN_H_28"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_28 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_28">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_28" name="HEALTH_SCREEN_H_28"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_28 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" for="HEALTH_SCREEN_H_28">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_28" name="HEALTH_SCREEN_H_28"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_28 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label">
                                                                โรคมะเร็ง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                style="cursor:pointer" for="HEALTH_SCREEN_H_29_1">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_29_1" name="HEALTH_SCREEN_H_29"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_29 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_29_2">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_29_2" name="HEALTH_SCREEN_H_29"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_29 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_29_3">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_29_3" name="HEALTH_SCREEN_H_29"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_29 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-8 d-flex align-items-center">
                                                        <label for="HEALTH_SCREEN_H_29_COMMENT"
                                                            style="cursor:pointer">ระบุ&nbsp;:&nbsp;
                                                        </label><input type="text" maxlength="255" class="form-control"
                                                            id="HEALTH_SCREEN_H_29_COMMENT"
                                                            name="HEALTH_SCREEN_H_29_COMMENT"
                                                            value="<?=$inforef->HEALTH_SCREEN_H_29_COMMENT ?>">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label">
                                                                บาดเจ็บ อุบัติเหตุจากการทำงาน
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_30_1">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_30_1" name="HEALTH_SCREEN_H_30"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_30 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_30_2">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_30_2" name="HEALTH_SCREEN_H_30"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_30 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_30_3">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_30_3" name="HEALTH_SCREEN_H_30"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_30 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-8 d-flex align-items-center">
                                                        <label for="HEALTH_SCREEN_H_30_COMMENT"
                                                            style="cursor:pointer">ระบุ&nbsp;:&nbsp;
                                                        </label><input type="text" maxlength="255" class="form-control"
                                                            id="HEALTH_SCREEN_H_30_COMMENT"
                                                            name="HEALTH_SCREEN_H_30_COMMENT"
                                                            value="<?=$inforef->HEALTH_SCREEN_H_30_COMMENT?>">
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label">
                                                                โรคติดเชื้อจากการทำงาน
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_31_1">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_31_1" name="HEALTH_SCREEN_H_31"
                                                                    value="nothave"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_31 == 'nothave'){echo "checked";} ?>>ไม่มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_31_2">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_31_2" name="HEALTH_SCREEN_H_31"
                                                                    value="have"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_31 == 'have'){echo "checked";} ?>>มี
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <label class="form-check-label" style="cursor:pointer"
                                                                for="HEALTH_SCREEN_H_31_3">
                                                                <input type="radio" class="form-check-input"
                                                                    id="HEALTH_SCREEN_H_31_3" name="HEALTH_SCREEN_H_31"
                                                                    value="never"
                                                                    <?php if($inforef->HEALTH_SCREEN_H_31 == 'never'){echo "checked";} ?>>ไม่เคยตรวจ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-8 d-flex align-items-center">
                                                        <label for="HEALTH_SCREEN_H_31_COMMENT"
                                                            style="cursor:pointer">ระบุ&nbsp;:&nbsp;
                                                        </label><input type="text" maxlength="255" class="form-control"
                                                            id="HEALTH_SCREEN_H_31_COMMENT"
                                                            name="HEALTH_SCREEN_H_31_COMMENT"
                                                            value="<?=$inforef->HEALTH_SCREEN_H_31_COMMENT?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                   
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                            กรณีที่ท่านมีประวัติเจ็บป่วย ท่านปฏิบัติตนอย่างไร
                                          
                                        </div>
                                        <br>
                                        <div class="row col-sm-12">
                                               
                                                <div class="col-sm-4">
                                                    <div class="form-check-inline">
                                                    <label class="form-check-label" for="HEALTH_SCREEN_H_HAVE">
                                                        <input type="radio" class="form-check-input" id="HEALTH_SCREEN_H_HAVE" name="HEALTH_SCREEN_H_HAVE" value="nothave"  <?php if($inforef->HEALTH_SCREEN_H_HAVE == 'nothave'){echo "checked";} ?>>รับการรักษาอยู่/ปฏิบัติตามที่แพทย์แนะนำ
                                                    </label>
                                                    </div>
                                                </div>
                                                    <div class="col-sm-4">
                                                    <div class="form-check-inline">
                                                    <label class="form-check-label" for="HEALTH_SCREEN_H_HAVE">
                                                        <input type="radio" class="form-check-input" id="HEALTH_SCREEN_H_HAVE" name="HEALTH_SCREEN_H_HAVE" value="have"  <?php if($inforef->HEALTH_SCREEN_H_HAVE == 'have'){echo "checked";} ?>>รับการรักษา แต่ไม่สม่ำเสมอ
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-check-inline">
                                                    <label class="form-check-label" for="HEALTH_SCREEN_H_HAVE">
                                                        <input type="radio" class="form-check-input" id="HEALTH_SCREEN_H_HAVE" name="HEALTH_SCREEN_H_HAVE" value="never"  <?php if($inforef->HEALTH_SCREEN_H_HAVE == 'never'){echo "checked";} ?>>เคยรักษา ขณะนี้ไม่รักษา/หายาทานเอง
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>



                                       </div>           
                                      </div>
                                      <div class="tab-pane" id="object3" role="tabpanel">
                                      
                                        ท่านสูบบุหรี่หรือไม่ <br> <br>
                                        <div class="row">
                                        <div class="col-sm-1">
                                                    <input type="radio" id="HEALTH_SCREEN_SMOK" name="HEALTH_SCREEN_SMOK" value="smok"  <?php if($inforef->HEALTH_SCREEN_SMOK == 'smok'){echo "checked";} ?>>
                                                    &nbsp;สูบ     
                                        </div>  
                                            <div class="col-sm-1">              
                                                    &nbsp;จำนวน   
                                          </div> 
                                            <div class="col-sm-1">         
                                                    <input type="text" class="form-control" id="HEALTH_SCREEN_SMOK_AMOUNT" name="HEALTH_SCREEN_SMOK_AMOUNT" value="{{$inforef->HEALTH_SCREEN_SMOK_AMOUNT }}"> 
                                            </div>        
                                        <div class="col-sm-1">               
                                                      มวน/วัน
                                        </div>   
                                        <div class="col-sm-1">         
                                        ชนิดของบุหรี่ 
                                        </div>

                                        <div class="col-sm-2">   
                                        <input type="text" class="form-control"  id="HEALTH_SCREEN_SMOK_TYPE" name="HEALTH_SCREEN_SMOK_TYPE" value="{{$inforef->HEALTH_SCREEN_SMOK_TYPE}}">         
                                        </div>
                                        
                                        
                                        <div class="col-sm-1">    
                                        
                                        ระยะเวลา    
                                                    </div>    


                                                    <div class="col-sm-1">
                                                        <input type="text" class="form-control" id="HEALTH_SCREEN_SMOK_TIME" name="HEALTH_SCREEN_SMOK_TIME" value="{{$inforef->HEALTH_SCREEN_SMOK_TIME}}">
                                                    </div>    
                                                    <div class="col-sm-2">    
                                                        ปี 
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-4">
                                        <input type="radio" id="HEALTH_SCREEN_SMOK" name="HEALTH_SCREEN_SMOK" value="onsmok"  <?php if($inforef->HEALTH_SCREEN_SMOK == 'onsmok'){echo "checked";} ?> >
                                                    &nbsp;ไม่สูบ
                                                    </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-4">
                                        <input type="radio" id="HEALTH_SCREEN_SMOK" name="HEALTH_SCREEN_SMOK" value="usesmok"  <?php if($inforef->HEALTH_SCREEN_SMOK == 'usesmok'){echo "checked";} ?>>
                                                    &nbsp;เคยสูบแต่เลิกแล้ว   
                                          </div>     
                                     
                                               
                                      </div>
                                      <br>  
                                      <br>  
                                      </div>    
                                      <div class="tab-pane" id="object4" role="tabpanel">
                                      
                                      <div class="row">
                                        <div class="col-sm-1">
                                                    <input type="radio" id="HEALTH_SCREEN_DRINK" name="HEALTH_SCREEN_DRINK" value="drink"   <?php if($inforef->HEALTH_SCREEN_DRINK == 'drink'){echo "checked";} ?>>
                                                    &nbsp;ดื่ม    
                                        </div>  
                                            <div class="col-sm-1">              
                                                    &nbsp;จำนวน   
                                          </div> 
                                            <div class="col-sm-1">         
                                                    <input type="text"  class="form-control" id="HEALTH_SCREEN_DRINK_AMOUNT" name="HEALTH_SCREEN_DRINK_AMOUNT" value="{{$inforef->HEALTH_SCREEN_DRINK_AMOUNT}}"> 
                                            </div>        
                                        <div class="col-sm-2">               
                                                      ครั้ง/สัปดาห์
                                        </div>   
                                   
                                        
                                        
                                     
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-4">
                                        <input type="radio" id="HEALTH_SCREEN_DRINK" name="HEALTH_SCREEN_DRINK"  value="nodrink" <?php if($inforef->HEALTH_SCREEN_DRINK == 'nodrink'){echo "checked";} ?>>
                                                    &nbsp;ไม่ดื่ม
                                                    </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-4">
                                        <input type="radio"  id="HEALTH_SCREEN_DRINK" name="HEALTH_SCREEN_DRINK" value="usedrink" <?php if($inforef->HEALTH_SCREEN_DRINK == 'usedrink'){echo "checked";} ?>>
                                                    &nbsp;เคยดื่มแต่เลิกแล้ว   
                                          </div>     
                                      
                                        </div>
                                          <br>        
                                                  
                                      </div>
                                      <div class="tab-pane" id="object5" role="tabpanel">
                                      
                                        การออกกำลังกาย<br>

                                        &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_EXERCISE" name="HEALTH_SCREEN_EXERCISE" value="1" <?php if($inforef->HEALTH_SCREEN_EXERCISE == '1'){echo "checked";} ?>> ออกกำลังทุกวัน ครั้งละ 30 นาที<br>
                                        &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_EXERCISE" name="HEALTH_SCREEN_EXERCISE" value="2" <?php if($inforef->HEALTH_SCREEN_EXERCISE == '2'){echo "checked";} ?>> ออกกำลังกายสัปดาห์ละ 3 ครั้ง ครั้งละ 30 นาที <br>
                                        &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_EXERCISE" name="HEALTH_SCREEN_EXERCISE" value="3" <?php if($inforef->HEALTH_SCREEN_EXERCISE == '3'){echo "checked";} ?>> ออกน้อยกว่าสัปดาห์ละ 3 ครั้ง <br>
                                        &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_EXERCISE" name="HEALTH_SCREEN_EXERCISE" value="4" <?php if($inforef->HEALTH_SCREEN_EXERCISE == '4'){echo "checked";} ?>> ไม่ออกกำลังกาย <br>
                                                  
                                      </div>
                                      <div class="tab-pane" id="object6" role="tabpanel">
                                      รสอาหารที่ชอบ <br>
                                      &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_FOOD" name="HEALTH_SCREEN_FOOD" value="1" <?php if($inforef->HEALTH_SCREEN_FOOD == '1'){echo "checked";} ?>> หวาน <br>
                                      &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_FOOD" name="HEALTH_SCREEN_FOOD" value="2" <?php if($inforef->HEALTH_SCREEN_FOOD == '2'){echo "checked";} ?>> เค็ม  <br>
                                      &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_FOOD" name="HEALTH_SCREEN_FOOD" value="3" <?php if($inforef->HEALTH_SCREEN_FOOD == '3'){echo "checked";} ?>> มัน <br>
                                      &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_FOOD" name="HEALTH_SCREEN_FOOD" value="4" <?php if($inforef->HEALTH_SCREEN_FOOD == '4'){echo "checked";} ?>> เปรี้ยว <br>
                                      &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_FOOD" name="HEALTH_SCREEN_FOOD" value="5" <?php if($inforef->HEALTH_SCREEN_FOOD == '5'){echo "checked";} ?>> ไม่ชอบทุกข้อ <br>
            
                                          <br>        
                                      </div>

                                      <div class="tab-pane" id="object7" role="tabpanel">

                                      ท่านขับขี่หรือโดยสารรถจักรยานยนต์/รถยนต์หรือไม่<br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_DRIVE" name="HEALTH_SCREEN_DRIVE" value="1" <?php if($inforef->HEALTH_SCREEN_DRIVE == '1'){echo "checked";} ?>> ไม่ขับขี่ไม่โดยสาร<br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_DRIVE" name="HEALTH_SCREEN_DRIVE" value="2" <?php if($inforef->HEALTH_SCREEN_DRIVE == '2'){echo "checked";} ?>> ขับขี่/โดยสาร และใส่หมวกกันน็อก/คาดเข็มขัดนิรภัยทุกครั้ง <br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_DRIVE" name="HEALTH_SCREEN_DRIVE" value="3" <?php if($inforef->HEALTH_SCREEN_DRIVE == '3'){echo "checked";} ?>> ขับขี่/โดยสาร และใส่หมวกกันน็อก/คาดเข็มขัดนิรภัยบางครั้ง <br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_DRIVE" name="HEALTH_SCREEN_DRIVE" value="4" <?php if($inforef->HEALTH_SCREEN_DRIVE == '4'){echo "checked";} ?>> ขับขี่/โดยสาร และใส่หมวกกันน็อก/คาดเข็มขัดนิรภัยนาน ๆ ครั้ง (ใส่เฉพาะเมื่อมีด่านตรวจ) <br>
                                                    

                                      </div>

                                   

                                      <div class="tab-pane" id="object8" role="tabpanel">

                                      
                                      เมื่อมีเพศสัมพันธ์กับผู้ที่ไม่ใช่สามีหรือภรรยาของท่าน ท่านหรือคู่ของท่าน ใช้ถุงยางอนามัยหรือไม่<br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_SEX" name="HEALTH_SCREEN_SEX" value="1" <?php if($inforef->HEALTH_SCREEN_SEX == '1'){echo "checked";} ?>> ใช้ทุกครั้ง<br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_SEX" name="HEALTH_SCREEN_SEX" value="2" <?php if($inforef->HEALTH_SCREEN_SEX == '2'){echo "checked";} ?>> ใช้เมื่อถูกร้องขอ<br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_SEX" name="HEALTH_SCREEN_SEX" value="3" <?php if($inforef->HEALTH_SCREEN_SEX == '3'){echo "checked";} ?>> ไม่ใช้ <br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_SEX" name="HEALTH_SCREEN_SEX" value="4" <?php if($inforef->HEALTH_SCREEN_SEX == '4'){echo "checked";} ?>> ไม่เคยมีเพศสัมพันธ์กับผู้ที่ไม่ใช่สามีหรือภรรยาของตนเอง<br>
                                            &nbsp;<input type="radio" class="form-check-input" id="HEALTH_SCREEN_SEX" name="HEALTH_SCREEN_SEX" value="5" <?php if($inforef->HEALTH_SCREEN_SEX == '5'){echo "checked";} ?>> ไม่ตอบ <br>       

                                    </div>

              
                        </div>
                        </div>  
                        <br>



          </div>
          <div class="col-lg-6">
         
          <form  method="post" action="{{route('mperson.healthConfirmsave')}}" enctype="multipart/form-data">
            @csrf        
                             
            <input type="hidden" id="HEALTH_SCREEN_ID_UP" name="HEALTH_SCREEN_ID_UP" value="{{$inforef->HEALTH_SCREEN_ID }}" >
                                <div class="col-sm-12 row"  align="right">
                                <div class="col-sm-2"></div> <div class="col-sm-2"><label>รวมมูลค่า </div><div class="col-sm-7"><input class="form-control input-sm " value="{{number_format($infosumlab,2)}}" style="text-align: center;background-color:#E0FFFF ;font-size: 13px;" type="text" name="total" id="total" readonly></div><div class="col-sm-1"><label>  บาท</label></div>
                                    </div><br>
                        <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
              <thead style="background-color: #FFEBCD;">
                <tr height="40">
                  
                    <td style="text-align: center;font-size: 14px;"  width="10%">รหัสรายการ</td>
                    <td style="text-align: center;font-size: 14px;">รายการ</td>
                    <td style="text-align: center;font-size: 14px;" width="10%">จำนวน</td>
                    <td style="text-align: center;font-size: 14px;" width="15%">ราคาต่อหน่วย</td>
                    <td style="text-align: center;font-size: 14px;" width="15%">ราคารวม</td>
                    <td style="text-align: center;font-size: 14px;" width="12%">
                        <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
                    </td>
                </tr>
            </thead>
            <tbody class="tbody1">
            <?php $number=0; ?>
            @foreach ($infoscreenlabcons as $infoscreenlabcon)  
            <?php $number++; ?>
                <tr height="20">
                        <input type="hidden" id="HEALTH_SCREEN_ID[]" name="HEALTH_SCREEN_ID[]" value="{{$inforef->HEALTH_SCREEN_ID }}" >
               
                    <td class="text-font text-pedding" style="text-align: left;">
                        <div class="showcheckcode{{$number}}">
                        {{$infoscreenlabcon->HEALTH_SCREEN_LAB_CODE}}
                        </div>
                    </td>
                    <td  class="text-font text-pedding" style="text-align: left;">
                    <select name="HEALTH_SCREEN_LAB_ID[]" id="HEALTH_SCREEN_LAB_ID{{$number}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;" onchange="checkcode({{$number}});checkpice({{$number}});">
                    @foreach ($infoscreenlabs as $infoscreenlabsub)  
                               @if($infoscreenlabsub->HEALTH_SCREEN_LAB_CODE == $infoscreenlabcon->HEALTH_SCREEN_LAB_CODE)
                               <option value="{{$infoscreenlabsub->HEALTH_SCREEN_LAB_ID}}" selected>{{$infoscreenlabsub->HEALTH_SCREEN_LAB_NAME}}</option>
                               @else
                               <option value="{{$infoscreenlabsub->HEALTH_SCREEN_LAB_ID}}">{{$infoscreenlabsub->HEALTH_SCREEN_LAB_NAME}}</option>
                               @endif  
                               
                    @endforeach    
                    </select>
                    </td>
                    <td class="text-font text-pedding" style="text-align: center;">
                    <input type="text" name="HEALTH_SCREEN_CON_AMOUNT[]" id="HEALTH_SCREEN_CON_AMOUNT{{$number}}" value="1" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onkeyup="checksummoney({{$number}})">
                    </td>
                    <td class="text-font text-pedding" style="text-align: rigth;">
                        <div class="showcheckpice{{$number}}">
                            <input type="text" name="HEALTH_SCREEN_CON_PICE[]" id="HEALTH_SCREEN_CON_PICE{{$number}}" value="{{number_format($infoscreenlabcon->HEALTH_SCREEN_LAB_PICE,2)}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onkeyup="checksummoney({{$number}})">
                        </div>
                    </td>
                    <td class="text-font text-pedding" style="text-align: rigth;">
                    <div class="summoney{{$number}}">
                    {{number_format($infoscreenlabcon->HEALTH_SCREEN_LAB_PICE,2)}}
                    <input type="hidden" name="sum" id="sum" value=" {{$infoscreenlabcon->HEALTH_SCREEN_LAB_PICE}}"  >

                    
                    </div>
                    </td>
                    <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                </tr> 
                @endforeach   
               
            </tbody>
        </table>
        <br>
        <div class="col-lg-12" style="text-align: left;">
        หมายเหตุ  
        </div>
        <textarea rows="4" cols="50" name="HEALTH_SCREEN_CON_COMMENT"   id="HEALTH_SCREEN_CON_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;">
        </textarea>

          


        </div>
                    
                </div> 


               
            <div class="row" align="right">
            <div class="col-lg-6" >
                        <div class="row">
                         <div class="col-lg-3" style="text-align: right;" >
                        วันที่นัดหมาย 
                        </div>
                        <div class="col-lg-3" style="text-align: right;" >
                        <input name="HEALTH_SCREEN_CON_DATE" id="HEALTH_SCREEN_CON_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;sans-serif;font-size: 14px;" readonly>
                        </div>
                        <div class="col-lg-3" style="text-align: right;" >
                        เวลา
                        </div>
                        <div class="col-lg-3" style="text-align: right;" >
                        <input name="HEALTH_SCREEN_CON_TIME" id="HEALTH_SCREEN_CON_TIME" class="js-masked-time form-control" style=" font-family: 'Kanit', sans-serif;" style=" font-family: 'Kanit', sans-serif;sans-serif;font-size: 14px;" value="08:00"  >
                       </div>
                       <input  type="hidden" name="inforeport" id="inforeport" class="form-control" style=" font-family: 'Kanit', sans-serif;" style=" font-family: 'Kanit', sans-serif;sans-serif;font-size: 14px;" value="{{$id_user}}"  >
                       </div>
            </div>
            <div class="col-lg-6" >
                    <button type="submit"  class="btn btn-hero-sm btn-hero-info f-kanit" >ยืนยันการตรวจ</button>
                    <a href="{{ url('manager_person/inforpersonhealth')  }}" class="btn btn-hero-sm btn-hero-danger f-kanit" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
            </div>
          </form>
        </div>

        </div>               

        <div >                 

@endsection
@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>


<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
    
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

                $('.addRow').on('click',function(){
                        addRow();
                    });

                    function addRow(){
                        var count = $('.tbody1').children('tr').length;
                        var number = count+1;
                        var tr ='<tr>'+
                                '<td class="text-font text-pedding" style="text-align: rigth;">'+
                                '<div class="showcheckcode'+number+'"></div>'+
                                '</td>'+ 
                                '<td  class="text-font text-pedding" style="text-align: left;">'+ 
                                '<select name="HEALTH_SCREEN_LAB_ID[]" id="HEALTH_SCREEN_LAB_ID'+number+'" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif; font-size: 13px;" onchange="checkcode('+number+');checkpice('+number+')">'+
                                '<option value="">--กรุณาเลือกรายการ--</option>'+ 
                                '@foreach ($infoscreenlabs as $infoscreenlabsub)'+ 
                                '<option value="{{$infoscreenlabsub->HEALTH_SCREEN_LAB_ID}}">{{$infoscreenlabsub->HEALTH_SCREEN_LAB_NAME}}</option>'+
                                '@endforeach'+    
                                '</select>'+
                                '</td>'+
                                '<td class="text-font text-pedding" style="text-align: rigth;">'+
                                '<input type="text" name="HEALTH_SCREEN_CON_AMOUNT[]" id="HEALTH_SCREEN_CON_AMOUNT'+number+'" value="1" class="form-control input-lg" style="font-family: \'Kanit\', sans-serif;font-size: 13px;" onkeyup="checksummoney('+number+')">'+
                                '</td>'+ 
                                '<td class="text-font text-pedding" style="text-align: rigth;">'+
                                '<div class="showcheckpice'+number+'"></div>'+
                                '</td>'+ 
                                '<td class="text-font text-pedding" style="text-align: rigth;">'+
                                '<div class="summoney'+number+'"></div>'+  
                                '</td>'+ 
                                '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                                '</tr>';
                        $('.tbody1').append(tr);
                    };

                    $('.tbody1').on('click','.remove', function(){
                            $(this).parent().parent().remove();
                    });





        $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });




    function bodysize(){
      var HEALTH_SCREEN_BODY =document.getElementById("HEALTH_SCREEN_BODY").value;
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('health.bodysize')}}",
                   method:"GET",
                   data:{HEALTH_SCREEN_BODY:HEALTH_SCREEN_BODY,_token:_token},
                   success:function(result){
                      $('.bodysize').html(result);
                     
                   }
           })   
        }



        //=================================================

function checkcode(number){
    
      var HEALTH_SCREEN_LAB_ID=document.getElementById("HEALTH_SCREEN_LAB_ID"+number).value;
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mperson.checkcode')}}",
                   method:"GET",
                   data:{HEALTH_SCREEN_LAB_ID:HEALTH_SCREEN_LAB_ID,_token:_token},
                   success:function(result){
                      $('.showcheckcode'+number).html(result);
                   }
           })

        

  }

  function checkpice(number){

      var HEALTH_SCREEN_LAB_ID=document.getElementById("HEALTH_SCREEN_LAB_ID"+number).value;
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mperson.checkpice')}}",
                   method:"GET",
                   data:{HEALTH_SCREEN_LAB_ID:HEALTH_SCREEN_LAB_ID,number:number,_token:_token},
                   success:function(result){
                      $('.showcheckpice'+number).html(result);
                      checksummoney(number);  
                   }
           })

  }


  
  function checksummoney(number){
      
    
      var SUP_TOTAL=document.getElementById("HEALTH_SCREEN_CON_AMOUNT"+number).value;
      var PRICE_PER_UNIT=document.getElementById("HEALTH_SCREEN_CON_PICE"+number).value;
      
      
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mperson.checksummoney')}}",
                   method:"GET",
                   data:{SUP_TOTAL:SUP_TOTAL,PRICE_PER_UNIT:PRICE_PER_UNIT,_token:_token},
                   success:function(result){
                      $('.summoney'+number).html(result);
                      findTotal();
                   }
           })
           
  }

  function findTotal(){
    var arr = document.getElementsByName('sum');
    var tot=0;

    count = $('.tbody1').children('tr').length;
    for(var i=0;i<count;i++){
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('total').value =tot.toFixed(2);
}





$('form').submit(function () {
  
                var HEALTH_SCREEN_CON_DATE;
                HEALTH_SCREEN_CON_DATE = document.getElementById("HEALTH_SCREEN_CON_DATE").value;
            if(
                HEALTH_SCREEN_CON_DATE==null || HEALTH_SCREEN_CON_DATE==''
            ){
                alert("กรุณาลงวันที่นัดหมาย");      
                return false;   
            }
        });
        </script>


@endsection