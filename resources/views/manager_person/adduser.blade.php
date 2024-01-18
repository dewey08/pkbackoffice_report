@extends('layouts.person')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
   <style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}

</style>
  
    
@section('content')



<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }
</style>
        <center>
                   
                <div style="width:95%;" >

                <form  method="post" action="{{ route('mperson.store') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>
            
                        @csrf
                       
                <div class="block block-rounded block-bordered" align="left">
               
                <div class="block-header block-header-default ">
                                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B><i class="fas fa-plus"></i> เพิ่มข้อมูลบุคคล</B></h3>
                    </div>
                <div class="block-content"> 
                 <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลส่วนตัว&nbsp;&nbsp;</span></h2>   
                 
                <div class="row push">
                        <div class="col-lg-4">
                                <div class="form-group">
                                        <label style=" font-family: 'Kanit', sans-serif;">รูปประจำตัว</label>                                  
                                        <img id="image_upload_preview" src="{{asset('image/pers.png')}}" alt="กรุณาเพิ่มรูปภาพ" height="200px" width="200px"/>
                                       
                                </div>
                                <div class="form-group">
                                        <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture" id="picture" class="form-control">
                                </div>  
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label >Username</label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">
                                                        <input  name = "HR_USERNAME"  id="HR_USERNAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkusername()">                                                       
                                                        <div style="color: red;" id="username"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3">
                                                        <label>คำนำหน้า </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">
                                                        <select name = "HR_PREFIX" id="HR_PREFIX" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkprefix()">
                                                                <option value="" >--กรุณาเลือกคำนำหน้า--</option>   
                                                        @foreach ($infoprefixs as $infoprefix)
                                                                <option value=" {{ $infoprefix -> HR_PREFIX_ID }}">{{ $infoprefix -> HR_PREFIX_NAME }}</option>
                                                        @endforeach 
                                                        </select>
                                                        <div style="color: red;" id="prefix"></div>
                                                </div>
                                        </div>
                                </div>
                                
                               
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label >ชื่อ </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">
                                                        <input  name = "HR_FNAME"  id="HR_FNAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkname()">
                                                        <div style="color: red;" id="fname"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>นามสกุล </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">
                                                        <input name ="HR_LNAME" id="HR_LNAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checklastname()">
                                                        <div style="color: red;" id="lname"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3">                                                                                                
                                                        <label>ชื่ออังกฤษ </label> <label style="color:red;"> *</label>
                                                </div> 
                                                <div class="col-lg-9">
                                                        <input name ="HR_EN_NAME" id="HR_EN_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                     
                                        </div>
                                </div>
                        </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3">
                                                        <label>ชื่อเล่น </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">
                                                        <input name ="NICKNAME" id="NICKNAME" maxlength="10" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                     
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3">
                                                        <label>วันเกิด </label> <label style="color:red;"> *</label>
                                                </div>                                                       
                                                        <div class="col-lg-9">                                              
                                                        <input name="HR_BIRTHDAY" id="HR_BIRTHDAY" class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;"  data-date-format="mm/dd/yyyy" value=" " onchange="checkbirthdate()" readonly>
                                                        <div style="color: red;" id="birth_date"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-5">
                                                        <label>เลขประจำตัวประชาชน  </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-7">
                                                        <input name="HR_CID" id="HR_CID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)" maxlength="13" onkeyup="checkhrid()" oncontextmenu="checkhrid()">
                                                        <div style="color: red;" id="cid"></div>
                                                </div>
                                        </div>
                                </div>                                       
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-5"> 
                                                        <label>สถานะสมรส   </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-7">
                                                        <select name="HR_MARRY_STATUS" id="HR_MARRY_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        <option value="" >--กรุณาเลือกสถานะสมรส--</option>
                                                                @foreach ($infomarrys as $infomarry)
                                                                <option value=" {{ $infomarry -> HR_MARRY_STATUS_ID }}">{{ $infomarry -> HR_MARRY_STATUS_NAME }}</option>                                        
                                                        @endforeach 
                                                        </select>
                                                     
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-5"> 
                                                        <label>ศาสนา </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-7">
                                                        <select name="HR_RELIGION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">                                
                                                                @foreach ($inforeligions as $inforeligion)                                     
                                                                @if($inforeligion -> HR_RELIGION_ID  == "01")
                                                                        <option value=" {{ $inforeligion -> HR_RELIGION_ID }}" selected>{{ $inforeligion -> HR_RELIGION_NAME }}</option>
                                                                @else
                                                                <option value=" {{ $inforeligion -> HR_RELIGION_ID }}">{{ $inforeligion -> HR_RELIGION_NAME }}</option>
                                                                @endif

                                                                @endforeach 
                                                        </select>
                                                </div>
                                        </div>                                              
                                </div> 
                        </div>                              
                        <div class="col-lg-4">
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>เชื้อชาติ </label> <label style="color:red;"> *</label>
                                                </div> 
                                                <div class="col-lg-9">       
                                                        <select name="HR_NATIONALITY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        <option value="99" >ไทย</option>
                                                         @foreach ($infonations as $infonation)                                                                     
                                                                <option value=" {{ $infonation -> HR_NATIONALITY_ID }}">{{ $infonation -> HR_NATIONALITY_NAME }}</option>
                                                        @endforeach 
                                                        </select>
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>สัญชาติ </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">       
                                                        <select name="HR_CITIZENSHIP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                                        <option value="99" >ไทย</option>
                                                                @foreach ($infocitizens as $infocitizen)                                                                
                                                                        <option value=" {{ $infocitizen -> HR_CITIZENSHIP_ID }}">{{ $infocitizen -> HR_CITIZENSHIP_NAME }}</option>
                                                                @endforeach 
                                                        </select>
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>เพศ </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9">        
                                                        <select name="SEX" id="SEX" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="" >--กรุณาเลือกเพศ--</option>
                                                                        @foreach ($infosexs as $infosex)                                                                
                                                                <option value=" {{ $infosex -> SEX_ID }}">{{ $infosex -> SEX_NAME }}</option> 
                                                                        @endforeach 
                                                        </select>
                                                  
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>กรุ๊ปเลือด </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9"> 
                                                        <select name="HR_BLOODGROUP" id="HR_BLOODGROUP" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                 <option value="" >--กรุณาเลือกกรุ๊ปเลือด--</option>
                                                                         @foreach ($infobloods as $infoblood)                                                             
                                                                <option value=" {{ $infoblood -> HR_BLOODGROUP_ID }}">{{ $infoblood -> HR_BLOODGROUP_NAME }}</option>        
                                                                        @endforeach 
                                                        </select>
                                                    
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>ส่วนสูง </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-6">        
                                                        <input name="HR_HIGH" id="HR_HIGH" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                      
                                                </div>
                                                <div class="col-lg-3"> 
                                                       <label> เซนติเมตร</label>
                                                </div>
                 
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>น้ำหนัก</label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-6"> 
                                                        <input name="HR_WEIGHT" id="HR_WEIGHT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                </div>
                                                <div class="col-lg-3">      
                                                        <label> กิโลกรัม</label>
                                                </div>
                                               
                                        </div>
                                </div>      
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>เบอร์โทร </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9"> 
                                                        <input name="HR_PHONE" id="HR_PHONE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" maxlength="10" >
                                                      
                                                </div>
                                                
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3">                         
                                                        <label>อีเมล </label> <label style="color:red;"> *</label>
                                                </div>
                                                <div class="col-lg-9"> 
                                                        <input name="HR_EMAIL" id="HR_EMAIL"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkemail()">
                                                        <div style="color: red;" id="hremail"></div> 
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>Facebook </label>
                                                </div>
                                                <div class="col-lg-9"> 
                                                        <input name="HR_FACEBOOK"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <div class="row">
                                                <div class="col-lg-3"> 
                                                        <label>Line </label>
                                                </div>
                                                <div class="col-lg-9"> 
                                                        <input name="HR_LINE"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                </div>                                        
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        
        <div class="block-content">  
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลอาชีพ&nbsp;&nbsp;</span></h2>      
                        <div class="row push">
                                <div class="col-lg-4">                               
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3"> 
                                                                <label>กลุ่มงาน </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <select name="HR_DEPARTMENT" id="HR_DEPARTMENT" class="form-control input-lg department" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartment()">
                                                                        <option value="" >--กรุณาเลือกกลุ่มงาน--</option>
                                                                                 @foreach ($infodepartments as $infodepartment)                                                     
                                                                        <option value="{{ $infodepartment ->HR_DEPARTMENT_ID  }}">{{ $infodepartment->HR_DEPARTMENT_NAME  }}</option>
                                                                                @endforeach 
                                                                </select>
                                                                <div style="color: red;" id="hrdepartment"></div> 
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3"> 
                                                                <label>ฝ่าย/แผนก </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <select name="DEPARTMENT_SUB" id="DEPARTMENT_SUB" class="form-control input-lg department_sub" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartmentsub()">
                                                                        <option value="" >--กรุณาเลือกฝ่าย/แผนก--</option>
                                                                                @foreach ($infodepartment_subs as $infodepartment_sub)                                                     
                                                                        <option value="{{ $infodepartment_sub ->HR_DEPARTMENT_SUB_ID  }}">{{ $infodepartment_sub->HR_DEPARTMENT_SUB_NAME  }}</option>
                                                                                @endforeach 
                                                                </select>
                                                                <div style="color: red;" id="hrdepartmentsub"></div>
                                                        </div>
                                                </div>
                                        </div>                                        
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3">
                                                                <label>หน่วยงาน </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <select name="HR_DEPARTMENT_SUB_SUB" id="HR_DEPARTMENT_SUB_SUB" class="form-control input-lg department_sub_sub" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrdepartmentsubsub()">
                                                                        <option value="" >--กรุณาเลือกหน่วยงาน--</option>
                                                                                @foreach ($infodepartment_sub_subs as $infodepartment_sub_sub)                                                     
                                                                        <option value="{{ $infodepartment_sub_sub ->HR_DEPARTMENT_SUB_SUB_ID  }}">{{ $infodepartment_sub_sub->HR_DEPARTMENT_SUB_SUB_NAME  }}</option>
                                                                                @endforeach 
                                                                </select>
                                                                <div style="color: red;" id="hrdepartmentsubsub"></div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3">
                                                                <label>วันที่บรรจุ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <input name="STARTWORK" id="STARTWORK" class="form-control input-lg datepicker2" style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy"  onchange="checkstartworkdate()" readonly>
                                                                <div style="color: red;" id="startworkdate"></div>
                                                        </div>
                                                   
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3">
                                                                <label>เลขตำแหน่ง </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <input name="HR_POSITION_NUM" id="HR_POSITION_NUM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" style=" font-family: 'Kanit', sans-serif;" >
                                                             
                                                        </div>
                                                </div>
                                        </div>    
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>เลขใบประกอบวิชาชีพ </label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <input name="VCODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-4"> 
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5"> 
                                                                <label>วดป.รับใบประกอบ </label>
                                                        </div>
                                                        <div class="col-lg-7"> 
                                                                <input name="VCODE_DATE" id="VCODE_DATE" class="form-control input-lg datepicker3" style=" font-family: 'Kanit', sans-serif;" data-date-format="mm/dd/yyyy" value=" " readonly>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3"> 
                                                                <label>ตำแหน่ง </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <select name="POSITION_IN_WORK" id="POSITION_IN_WORK" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrpositioninwork()">
                                                                        <option value="" >--กรุณาเลือกตำแหน่ง--</option>
                                                                                @foreach ($infopositions as $infoposition)                                                     
                                                                        <option value="{{ $infoposition ->HR_POSITION_ID  }}">{{ $infoposition->HR_POSITION_NAME  }}</option>
                                                                                @endforeach 
                                                                </select>
                                                                <div style="color: red;" id="hrpositioninwork"></div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-3"> 
                                                                <label>ระดับ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                                <select name="HR_LEVEL" id="HR_LEVEL" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        <option value="" >--กรุณาเลือกระดับ--</option>
                                                                                @foreach ($infolevels as $infolevel)                                                     
                                                                        <option value="{{ $infolevel ->HR_LEVEL_ID  }}">{{ $infolevel->HR_LEVEL_NAME  }}</option>
                                                                                @endforeach 
                                                                </select>
                                                             
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>สถานะปัจจุบัน </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <select name="HR_STATUS" id="HR_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrstatus()">
                                                                        <option value="" >--กรุณาเลือกสถานะ--</option>
                                                                                @foreach ($infostatuss as $infostatus)                                                     
                                                                        <option value="{{ $infostatus ->HR_STATUS_ID }}">{{ $infostatus->HR_STATUS_NAME }}</option>
                                                                                @endforeach 
                                                                </select>
                                                                <div style="color: red;" id="hrstatus"></div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>กลุ่มข้าราชการ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-7">               
                                                                <select name="HR_KIND" id="HR_KIND" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                        <option value="" >--กรุณาเลือกกลุ่มข้าราชการ--</option>
                                                                                @foreach ($infokinds as $infokind)                                                     
                                                                        <option value="{{ $infokind ->HR_KIND_ID  }}">{{ $infokind->HR_KIND_NAME }}</option>
                                                                                @endforeach 
                                                                </select>
                                                               
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>ประเภทข้าราชการ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-7"> 
                                                                <select name="HR_KIND_TYPE" id="HR_KIND_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                <option value="" >--กรุณาเลือกประเภทข้าราชการ--</option>
                                                                        @foreach ($infokind_types as $infokind_type)                                                     
                                                                        <option value="{{ $infokind_type ->HR_KIND_TYPE_ID  }}">{{ $infokind_type->HR_KIND_TYPE_NAME  }}</option>
                                                                        @endforeach 
                                                                </select>
                                                               
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>กลุ่มบุคลากร </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <select name="HR_PERSON_TYPE" id="HR_PERSON_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="checkhrpersontype()">
                                                                        <option value="" >--กรุณาเลือกกลุมบุคคลากร--</option>
                                                                                 @foreach ($infoperson_types as $infoperson_type)                                                     
                                                                        <option value="{{ $infoperson_type ->HR_PERSON_TYPE_ID  }}">{{ $infoperson_type->HR_PERSON_TYPE_NAME  }}</option>
                                                                                @endforeach 
                                                                </select>
                                                                <div style="color: red;" id="hrpersontype"></div>
                                                        </div>
                                                </div>
                                        </div>  
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>ต้นสังกัด</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <input name="HR_AGENCY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                        </div>
                                                </div>
                                        </div>   
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>เงินเดือน </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-7"> 
                                                                <input name="HR_SALARY" id="HR_SALARY" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)" onkeyup="checkhrsalary()">
                                                                <div style="color: red;" class="text-left" id="hrsalary"></div>
                                                        </div>  
                                                </div>
                                        </div> 
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>เงินประจำตำแหน่ง </label>
                                                        </div>
                                                        <div class="col-lg-7"> 
                                                                <input name="MONEY_POSITION" id="MONEY_POSITION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkmunny(this)" >
                                                        </div>
                                                        <div style="color: red;" id="moneyposition"></div>
                                                </div>  
                                        </div>
                                </div>
                        </div>
                </div>
               
                <div class="block-content">   
                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลที่อยู่อาศัยปัจจุบัน&nbsp;&nbsp;</span></h2> 
                        <div class="row"> 
                                <div class="col-lg-3">                                       
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>บ้านเลขที่ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8"> 
                                                                <input name="HR_HOME_NUMBER" id="HR_HOME_NUMBER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkhomenumber()" >
                                                                <div style="color: red;" id="homenumber"></div>
                                                         </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>จังหวัด </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8">                
                                                                <select name="PROVINCE_NAME" id="PROVINCE_NAME" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename()">
                                                                        <option value="" >--กรุณาเลือกจังหวัด--</option>
                                                                                 @foreach ($infoprovinces as $infoprovince)
                                                                        <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                                                                @endforeach         
                                                                </select>
                                                                <div style="color: red;" id="provincename"></div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-3"> 
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>หมู่ที่ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8">        
                                                                <input name="HR_VILLAGE_NO" id="HR_VILLAGE_NO" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="checkvillageno()" >
                                                                <div style="color: red;" id="villageno"></div>
                                                        </div>
                                                </div>
                                        </div>                                
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>อำเภอ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8"> 
                                                                <select name="AMPHUR_NAME" id="AMPHUR_NAME" class="form-control input-lg amphures" style=" font-family: 'Kanit', sans-serif;" onchange="checkamphurname()">
                                                                        <option value="">--กรุณาเลือกอำเภอ--</option>
                                                                </select>
                                                                <div style="color: red;" id="amphurname"></div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>ถนน </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input name="HR_ROAD_NAME" id="HR_ROAD_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"   >
                                                             
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>ตำบล </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <select name="TUMBON_NAME" id="TUMBON_NAME" class="form-control input-lg tumbon" style=" font-family: 'Kanit', sans-serif;" onchange="checktumbonname()">
                                                                        <option value="" >--กรุณาเลือกตำบล--</option>
                                                                </select>
                                                                <div style="color: red;" id="tumbonname"></div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-4">
                                                                <label>ซอย </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input name="HR_SOI_NAME" id="HR_SOI_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;"   >
                                                                
                                                        </div>  
                                                </div>
                                        </div>                               
                                        <div class="form-group">
                                                <div class="row">
                                                        <div class="col-lg-5">
                                                                <label>รหัสไปรษณีย์ </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                                <input name="HR_ZIPCODE" id="HR_ZIPCODE" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="" maxlength="5" onkeyup="checkzipcodename()">
                                                                <div style="color: red;" id="zipcodename"></div>
                                                        </div> 
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                               
                <div class="block-content">   
                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลที่อยู่อาศัยตามทะเบียนบ้าน&nbsp;&nbsp;</span></h2>      
                                <div class="row push">        
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                        <input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)" >ข้อมูลที่อยู่อาศัยปัจจุบัน
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <label>บ้านเลขที่</label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                        <input name="HR_HOME_NUMBER_1" id="HR_HOME_NUMBER_1" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" onchange="checkhomenumber1()">
                                                                        <div style="color: red;" id="homenumber1"></div>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <label>จังหวัด </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">                 
                                                                        <select name="PROVINCE_NAME_1" id="PROVINCE_NAME_1" class="form-control input-lg provice_sub" style=" font-family: 'Kanit', sans-serif;" onchange="checkprovincename1()">
                                                                                <option value="" >--กรุณาเลือกจังหวัด--</option>
                                                                                        @foreach ($infoprovinces as $infoprovince) 
                                                                                <option value=" {{ $infoprovince -> ID }}" >{{ $infoprovince -> PROVINCE_NAME }}</option>
                                                                                        @endforeach         
                                                                        </select>
                                                                        <div style="color: red;" id="provincename1"></div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                        <label>&nbsp; </label>
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <label>หมู่ที่ </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                        <input name="HR_VILLAGE_NO_1" id="HR_VILLAGE_NO_1" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" onkeyup="checkvillageno1()">
                                                                        <div style="color: red;" id="villageno1"></div>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <label>อำเภอ </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                        <select name="AMPHUR_NAME_1" id="AMPHUR_NAME_1" class="form-control input-lg amphures_sub" style=" font-family: 'Kanit', sans-serif;" onchange="checkamphurname1()">
                                                                                <option value="">--กรุณาเลือกอำเภอ--</option>                                                                
                                                                        </select>
                                                                        <div style="color: red;" id="amphurname1"></div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                        <label>&nbsp; </label>
                                                </div> 
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <label>ถนน </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                        <input name="HR_ROAD_NAME_1" id="HR_ROAD_NAME_1" class="form-control input-lg"  >
                                                                      
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4">
                                                                        <label>ตำบล </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                        <select name="TUMBON_NAME_1" id="TUMBON_NAME_1" class="form-control input-lg tumbon_sub" style=" font-family: 'Kanit', sans-serif;" onchange="checktumbonname1()">
                                                                                <option value="" >--กรุณาเลือกตำบล--</option>
                                                                        </select>
                                                                        <div style="color: red;" id="tumbonname1"></div>
                                                                </div>
                                                                {{csrf_field()}} 
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                        <label>&nbsp; </label>
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-4"> 
                                                                        <label>ซอย </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                        <input name="HR_SOI_NAME_1" id="HR_SOI_NAME_1" class="form-control input-lg"   >
                                                                       
                                                                </div>  
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <div class="row">
                                                                <div class="col-lg-5">
                                                                        <label>รหัสไปรษณีย์ </label> <label style="color:red;"> *</label>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                        <input name="HR_ZIPCODE_1" id="HR_ZIPCODE_1" class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" maxlength="5" onkeyup="checkzipcodename1()" value="">
                                                                        <div style="color: red;" id="zipcodename1"></div>     
                                                                </div>  
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                </div>
                             
                <div class="block-content">  
                        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"><span style="border-radius: 5px;font-size: 18px;">&nbsp;&nbsp;ข้อมูลบัญชีธนาคาร&nbsp;&nbsp;</span></h2>           
                        <div class="row">        
                                <div class="col-lg-4">
                                       
                                        <div class="form-group">
                                                <label>เงินค่าตอบแทน </label>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4">                                                
                                                                <label>เลขบัญชีธนาคาร </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8"> 
                                                                <input name="BOOK_BANK_NUMBER" id="BOOK_BANK_NUMBER"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                  
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4"> 
                                                                <label>ชื่อบัญชีธนาคาร </label>
                                                        </div>
                                                        <div class="col-lg-8"> 
                                                                <input name="BOOK_BANK_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4"> 
                                                                <label>ธนาคาร </label>
                                                        </div>
                                                        <div class="col-lg-8"> 
                                                                <input name="BOOK_BANK" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4">
                                                                <label>สาขา </label>
                                                        </div>
                                                        <div class="col-lg-8">   
                                                                <input name="BOOK_BANK_BRANCH" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>                                       
                                </div>
                                <div class="col-lg-4">                                        
                                        <div class="form-group">
                                                <label>เงินค่าตอบแทน OT</label>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4">
                                                                <label>เลขบัญชีธนาคาร </label> <label style="color:red;"> *</label>
                                                        </div>
                                                        <div class="col-lg-8"> 
                                                                <input name="BOOK_BANK_OT_NUMBER" id="BOOK_BANK_OT_NUMBER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                                 
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4">
                                                                <label>ชื่อบัญชีธนาคาร </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input name="BOOK_BANK_OT_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4">
                                                                <label>ธนาคาร </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input name="BOOK_BANK_OT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row"> 
                                                        <div class="col-lg-4">
                                                                <label>สาขา </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input name="BOOK_BANK_OT_BRANCH" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div><br>
                <div align="right">       
                        {{-- <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>&nbsp;&nbsp;<a href="{{ url('manager_person/inforperson')}}"  class="btn btn-warning btn-lg" >ยกเลิก</a><br><br>   --}}
                        <div align="right"><button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save"></i> &nbsp;บันทึกข้อมูล</button>&nbsp;&nbsp;<a  href="{{ url('manager_person/inforperson')}}"   class="btn btn-hero-sm btn-hero-danger"  onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"><i class="fas fa-window-close"></i> &nbsp;ยกเลิก</a>  </div><br>  
                </div>
        </form>
</div>   
                                                    
</div>  
@endsection


@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
        $(document).ready(function() {

$('select').select2();


});

    $(document).ready(function () {
            
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true               //Set เป็นปี พ.ศ.
        }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน

        document.getElementById("birth_date").style.display = "none";
    });
    $(document).ready(function () {
       
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    
            document.getElementById("startworkdate").style.display = "none";
    });
    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
        });


        //-------------------------------------------------------------------------------------------------------------------------------------------
        function checkusername()
        {        
                nusername = document.getElementById("HR_USERNAME").value;
                if (nusername==null || nusername==''){      
                        document.getElementById("username").style.display = "";     
                        text_prefix = "*กรุณาระบุ Username";
                        document.getElementById("username").innerHTML = text_prefix;

                }else{
                        document.getElementById("username").style.display = "none"
                }
        }
        
        function checkprefix()
        {        
                nprefix = document.getElementById("HR_PREFIX").value;
                if (nprefix==null || nprefix==''){      
                        document.getElementById("prefix").style.display = "";     
                        text_prefix = "*กรุณาระบุคำนำหน้าชื่อ";
                        document.getElementById("prefix").innerHTML = text_prefix;

                }else{
                        document.getElementById("prefix").style.display = "none"
                }
        }

        function checkname()
        {        
                name = document.getElementById("HR_FNAME").value;             
                if (name==null || name==''){
                document.getElementById("fname").style.display = "";     
                text_name = "*กรุณาระบุข้อมูลชื่อ";
                document.getElementById("fname").innerHTML = text_name;
                }else{
                document.getElementById("fname").style.display = "none";
                }
        }
        function checklastname()
        {        
                lastname = document.getElementById("HR_LNAME").value;               
                if (lastname==null || lastname==''){
                document.getElementById("lname").style.display = "";     
                text_lastname = "*กรุณาระบุข้อมูลนามสกุล";
                document.getElementById("lname").innerHTML = text_lastname;
                }else{
                document.getElementById("lname").style.display = "none";
                }
        }
      

        function checkbirthdate()
        {        
                birthdate = document.getElementById("HR_BIRTHDAY").value;
                if (birthdate==null || birthdate==''){
                document.getElementById("birth_date").style.display = "";     
                text_birthdate= "*กรุณาระบุข้อมูลวันเกิด";
                document.getElementById("birth_date").innerHTML = text_birthdate;
                }else{
                document.getElementById("birth_date").style.display = "none";
                }
        } 
       
      
        function checkhrdepartment()
        { 
                hrdepartment = document.getElementById("HR_DEPARTMENT").value;
                if (hrdepartment==null || hrdepartment==''){
                document.getElementById("hrdepartment").style.display = "";     
                text_department= "*กรุณาระบุกลุ่มงาน";
                document.getElementById("hrdepartment").innerHTML = text_department;
                }else{
                document.getElementById("hrdepartment").style.display = "none";
                }
        }
        function checkhrdepartmentsub()
        { 
                hrdepartmentsub = document.getElementById("DEPARTMENT_SUB").value;
                if (hrdepartmentsub==null || hrdepartmentsub==''){
                document.getElementById("hrdepartmentsub").style.display = "";     
                text_departmentsub= "*กรุณาระบุฝ่าย/แผนก";
                document.getElementById("hrdepartmentsub").innerHTML = text_departmentsub;
                }else{
                document.getElementById("hrdepartmentsub").style.display = "none";
                }
        }
        function checkhrdepartmentsubsub()
        { 
                hrdepartmentsubsub = document.getElementById("HR_DEPARTMENT_SUB_SUB").value;
                if (hrdepartmentsubsub==null || hrdepartmentsubsub==''){
                document.getElementById("hrdepartmentsubsub").style.display = "";     
                text_departmentsubsub= "*กรุณาระบุหน่วยงาน";
                document.getElementById("hrdepartmentsubsub").innerHTML = text_departmentsubsub;
                }else{
                document.getElementById("hrdepartmentsubsub").style.display = "none";
                }
        }
        function checkstartworkdate()
        { 
                startworkdate = document.getElementById("STARTWORK").value;
                if (startworkdate==null || startworkdate==''){
                document.getElementById("startworkdate").style.display = "";     
                text_startworkdate= "*กรุณาระบุวันเริ่มงาน";
                document.getElementById("startworkdate").innerHTML = text_startworkdate;
                }else{
                document.getElementById("startworkdate").style.display = "none";
                }

                
        }
        function checkhrpositioninwork()
        { 
                hrpositioninwork = document.getElementById("POSITION_IN_WORK").value;
                if (hrpositioninwork==null || hrpositioninwork==''){
                document.getElementById("hrpositioninwork").style.display = "";     
                text_positioninwork= "*กรุณาระบุตำแหน่ง";
                document.getElementById("hrpositioninwork").innerHTML = text_positioninwork;
                }else{
                document.getElementById("hrpositioninwork").style.display = "none";
                }
        }
      
        function checkhrstatus()
        { 
                hrstatus = document.getElementById("HR_STATUS").value;
                if (hrstatus==null || hrstatus==''){
                document.getElementById("hrstatus").style.display = "";     
                text_status= "*กรุณาระบุสถานะ";
                document.getElementById("hrstatus").innerHTML = text_status;
                }else{
                document.getElementById("hrstatus").style.display = "none";
                }
        }
      
      
        function checkhrpersontype()
        { 
                hrpersontype = document.getElementById("HR_PERSON_TYPE").value;
                if (hrpersontype==null || hrpersontype==''){
                document.getElementById("hrpersontype").style.display = "";     
                text_persontype= "*กรุณาระบุกลุ่มบุคลากร";
                document.getElementById("hrpersontype").innerHTML = text_persontype;
                }else{
                document.getElementById("hrpersontype").style.display = "none";
                }
        }
        function checkhrsalary()
        { 
                hrsalary = document.getElementById("HR_SALARY").value;
                if (hrsalary==null || hrsalary==''){
                document.getElementById("hrsalary").style.display = "";     
                text_salary= "*กรุณาระบุเงินเดือน";
                document.getElementById("hrsalary").innerHTML = text_salary;
                }else{
                document.getElementById("hrsalary").style.display = "none";
                }
        }
        function checkhomenumber()
        { 
                homenumber = document.getElementById("HR_HOME_NUMBER").value;
                if (homenumber==null || homenumber==''){
                document.getElementById("homenumber").style.display = "";     
                text_homenumber= "*กรุณาระบุบ้านเลขที่";
                document.getElementById("homenumber").innerHTML = text_homenumber;
                }else{
                document.getElementById("homenumber").style.display = "none";
                }
        }
        function checkvillageno()
        { 
                villageno = document.getElementById("HR_VILLAGE_NO").value;
                if (villageno==null || villageno==''){
                document.getElementById("villageno").style.display = "";     
                text_villageno= "*กรุณาระบุหมู่ที่";
                document.getElementById("villageno").innerHTML = text_villageno;
                }else{
                document.getElementById("villageno").style.display = "none";
                }
        }
        function checkprovincename()
        { 
                provincename = document.getElementById("PROVINCE_NAME").value;
                if (provincename==null || provincename==''){
                document.getElementById("provincename").style.display = "";     
                text_provincename= "*กรุณาระบุจังหวัด";
                document.getElementById("provincename").innerHTML = text_provincename;
                }else{
                document.getElementById("provincename").style.display = "none";
                }
        }
        function checkamphurname()
        { 
                amphurname = document.getElementById("AMPHUR_NAME").value;
                if (amphurname==null || amphurname==''){
                document.getElementById("amphurname").style.display = "";     
                text_amphurname= "*กรุณาระบุอำเภอ";
                document.getElementById("amphurname").innerHTML = text_amphurname;
                }else{
                document.getElementById("amphurname").style.display = "none";
                }
        }
        function checktumbonname()
        { 
                tumbonname = document.getElementById("TUMBON_NAME").value;
                if (tumbonname==null || tumbonname==''){
                document.getElementById("tumbonname").style.display = "";     
                text_tumbonname= "*กรุณาระบุตำบล";
                document.getElementById("tumbonname").innerHTML = text_tumbonname;
                }else{
                document.getElementById("tumbonname").style.display = "none";
                }
        }
        function checkzipcodename()
        { 
                zipcodename = document.getElementById("HR_ZIPCODE").value;
                if (zipcodename==null || zipcodename==''){
                document.getElementById("zipcodename").style.display = "";     
                text_zipcodename= "*กรุณาระบุรหัสไปรษณีย์";
                document.getElementById("zipcodename").innerHTML = text_zipcodename;
                }else{
                document.getElementById("zipcodename").style.display = "none";
                }
        }
        function checkvillageno1()
        { 
                villageno1 = document.getElementById("HR_VILLAGE_NO_1").value;
                if (villageno1==null || villageno1==''){
                document.getElementById("villageno1").style.display = "";     
                text_villageno1= "*กรุณาระบุหมู่ที่";
                document.getElementById("villageno1").innerHTML = text_villageno1;
                }else{
                document.getElementById("villageno1").style.display = "none";
                }
        }
        function checkprovincename1()
        { 
                provincename1 = document.getElementById("PROVINCE_NAME_1").value;
                if (provincename1==null || provincename1==''){
                document.getElementById("provincename1").style.display = "";     
                text_provincename1= "*กรุณาระบุจังหวัด";
                document.getElementById("provincename1").innerHTML = text_provincename1;
                }else{
                document.getElementById("provincename1").style.display = "none";
                }
        }
        function checkamphurname1()
        { 
                amphurname1 = document.getElementById("AMPHUR_NAME_1").value;
                if (amphurname1==null || amphurname1==''){
                document.getElementById("amphurname1").style.display = "";     
                text_amphurname1= "*กรุณาระบุอำเภอ";
                document.getElementById("amphurname1").innerHTML = text_amphurname1;
                }else{
                document.getElementById("amphurname1").style.display = "none";
                }
        }
        function checktumbonname1()
        { 
                tumbonname1 = document.getElementById("TUMBON_NAME_1").value;
                if (tumbonname1==null || tumbonname1==''){
                document.getElementById("tumbonname1").style.display = "";     
                text_tumbonname1= "*กรุณาระบุตำบล";
                document.getElementById("tumbonname1").innerHTML = text_tumbonname1;
                }else{
                document.getElementById("tumbonname1").style.display = "none";
                }
        }
        function checkhomenumber1()
        { 
                homenumber1 = document.getElementById("HR_HOME_NUMBER_1").value;
                if (homenumber1==null || homenumber1==''){
                document.getElementById("homenumber1").style.display = "";     
                text_homenumber1= "*กรุณาระบุบ้านเลขที่";
                document.getElementById("homenumber1").innerHTML = text_homenumber1;
                }else{
                document.getElementById("homenumber1").style.display = "none";
                }
        }
        function checkzipcodename1()
        { 
                zipcodename1 = document.getElementById("HR_ZIPCODE_1").value;
                if (zipcodename1==null || zipcodename1==''){
                document.getElementById("zipcodename1").style.display = "";     
                text_zipcodename1= "*กรุณาระบุรหัสไปรษณีย์";
                document.getElementById("zipcodename1").innerHTML = text_zipcodename1;
                }else{
                document.getElementById("zipcodename1").style.display = "none";
                }
        }
        
     
  //--------------------------------------------------------------------------------------------------------------------------------------

        function checkhrid(){        
             var select= document.getElementById("HR_CID").value; 
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('check.checkhrid')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('#cid').html(result);
                     }
             })      
               
     }

        function checkemail(){        
             var select= document.getElementById("HR_EMAIL").value; 
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('check.checkemail')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('#hremail').html(result);
                     }
             })
          
               
     }



</script>

<script>
                        
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


function FillBilling(f) {
  if(f.billingtoo.checked == true) {
    
   
    f.HR_HOME_NUMBER_1.value = f.HR_HOME_NUMBER.value;
    
    f.HR_VILLAGE_NO_1.value = f.HR_VILLAGE_NO.value;
    f.HR_ROAD_NAME_1.value = f.HR_ROAD_NAME.value;
    f.HR_SOI_NAME_1.value = f.HR_SOI_NAME.value;
   
    var found_p = false;
        for (var i = 0; i < f.PROVINCE_NAME_1.options.length; i++) {
            if (f.PROVINCE_NAME_1.options[i].value.toLowerCase() === f.PROVINCE_NAME.value.toLowerCase()) {
                f.PROVINCE_NAME_1.selectedIndex = i;
                found_p = true;
                break;
            }
        }
        if (!found_p) {
            var extraOption = f.PROVINCE_NAME_1.getAttribute("data-extra-option");
            if (extraOption) {
                f.PROVINCE_NAME_1.options[f.PROVINCE_NAME_1.options.length - 1].text = f.PROVINCE_NAME.value;
                f.PROVINCE_NAME_1.options[f.PROVINCE_NAME_1.options.length - 1].value = f.PROVINCE_NAME.value;
            } else {
                var newOption = new Option(f.PROVINCE_NAME.value, f.PROVINCE_NAME.value);
                f.PROVINCE_NAME_1.setAttribute("data-extra-option", "true");
                f.PROVINCE_NAME_1.appendChild(newOption);
                f.PROVINCE_NAME_1.selectedIndex = f.PROVINCE_NAME_1.options.length - 1;
            }
        } else {
            if (f.PROVINCE_NAME_1.getAttribute("data-extra-option")) {
                f.PROVINCE_NAME_1.removeChild(f.PROVINCE_NAME_1.options[f.PROVINCE_NAME_1.options.length - 1]);
                f.PROVINCE_NAME_1.selectedIndex = 0;
            }
        }
 
                var newOption_a = new Option(f.AMPHUR_NAME.options[f.AMPHUR_NAME.selectedIndex].text,f.AMPHUR_NAME.value);
                f.AMPHUR_NAME_1.setAttribute("data-extra-option", "true");
                f.AMPHUR_NAME_1.appendChild(newOption_a);
                f.AMPHUR_NAME_1.selectedIndex = f.AMPHUR_NAME_1.options.length - 1;

                var newOption_t = new Option(f.TUMBON_NAME.options[f.TUMBON_NAME.selectedIndex].text,f.TUMBON_NAME.value);
                f.TUMBON_NAME_1.setAttribute("data-extra-option", "true");
                f.TUMBON_NAME_1.appendChild(newOption_t);
                f.TUMBON_NAME_1.selectedIndex = f.TUMBON_NAME_1.options.length - 1;

                f.HR_ZIPCODE_1.value = f.HR_ZIPCODE.value;
  } 
  if(f.billingtoo.checked == false) {
    f.HR_HOME_NUMBER_1.value = '';
    f.HR_VILLAGE_NO_1.value  = '';
    f.HR_ROAD_NAME_1.value  = '';
    f.HR_SOI_NAME_1.value = '';


    f.PROVINCE_NAME_1.removeChild(f.PROVINCE_NAME_1.options[f.PROVINCE_NAME_1.options.length - 1]);
    f.PROVINCE_NAME_1.selectedIndex = 0;
    
    f.AMPHUR_NAME_1.removeChild(f.AMPHUR_NAME_1.options[f.AMPHUR_NAME_1.options.length - 1]);
    f.AMPHUR_NAME_1.selectedIndex = 0;

    f.TUMBON_NAME_1.removeChild(f.TUMBON_NAME_1.options[f.TUMBON_NAME_1.options.length - 1]);
    f.TUMBON_NAME_1.selectedIndex = 0;


    f.HR_ZIPCODE_1.value = '';
  }
  
  checkhomenumber1();
  checkprovincename1();
  checkvillageno1();
  checkamphurname1();

  checktumbonname1();

  checkzipcodename1();
}

function readURL(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();    
    		
                    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#image_upload_preview').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }else{
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                                fileInput.value = '';
                                return false;
       
                        }
                }
            
                $("#picture").change(function () {
                    readURL(this);
                });
      </script>
     <script>
     
     $('.provice').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.provice_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetch')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.amphures_sub').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.amphures_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.fetchsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.tumbon_sub').html(result);
                     }
             })
            // console.log(select);
             }        
     });

</script>

<script>

$('.department').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('dropdown.department')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.department_sub').html(result);
             }
     })
    // console.log(select);
     }        
});

$('.department_sub').change(function(){
     if($(this).val()!=''){
     var select=$(this).val();
     var _token=$('input[name="_token"]').val();
     $.ajax({
             url:"{{route('dropdown.departmenthsub')}}",
             method:"GET",
             data:{select:select,_token:_token},
             success:function(result){
                $('.department_sub_sub').html(result);
             }
     })
    // console.log(select);
     }        
});



</script>

<script>
function chkNumber(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9')) return false;
ele.onKeyPress=vchar;
}

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}





$('form').submit(function () {
     
 var nusername,text_username;
 var nprefix,text_prefix;
 var name, text_name;
 var lastname,text_lastname;

 var birthdate,text_birthdate;
 var hrcid,text_hrcid;
 var marry,text_marry;

 var hrphone,text_hrphone;

 var hremail,text_email;

 var hrdepartment,text_department;
 var hrdepartmentsub,text_departmentsub;
 var hrdepartmentsubsub,text_departmentsubsub;
 var startworkdate,text_startworkdate;
 var hrpositioninwork,text_positioninwork;

 var hrstatus,text_status;


 var hrpersontype,text_persontype;
 var hrsalary,text_salary;
 var homenumber,text_homenumber;
 var villageno,text_villageno;
 var provincename,text_provincename;
 var amphurname,text_amphurname;
 var tumbonname,text_tumbonname;
 var zipcodename,text_zipcodename;


 var homenumber1,text_homenumber1;
 var villageno1,text_villageno1;
 var provincename1,text_provincename1;
 var amphurname1,text_amphurname1;
 var tumbonname1,text_tumbonname1;
 var zipcodename1,text_zipcodename1;


  nusername = document.getElementById("HR_USERNAME").value;

  nprefix = document.getElementById("HR_PREFIX").value;
  name = document.getElementById("HR_FNAME").value;
  lastname = document.getElementById("HR_LNAME").value;
  
  birthdate = document.getElementById("HR_BIRTHDAY").value;

  hrcid = document.getElementById("HR_CID").value;


  hremail = document.getElementById("HR_EMAIL").value; 
  hrdepartment = document.getElementById("HR_DEPARTMENT").value; 
  hrdepartmentsub = document.getElementById("DEPARTMENT_SUB").value; 
  hrdepartmentsubsub = document.getElementById("HR_DEPARTMENT_SUB_SUB").value; 
  startworkdate = document.getElementById("STARTWORK").value; 
  hrpositioninwork = document.getElementById("POSITION_IN_WORK").value; 

  hrstatus = document.getElementById("HR_STATUS").value;

  hrpersontype = document.getElementById("HR_PERSON_TYPE").value; 
  hrsalary = document.getElementById("HR_SALARY").value;   

  
  homenumber = document.getElementById("HR_HOME_NUMBER").value;
  villageno = document.getElementById("HR_VILLAGE_NO").value;  
  provincename = document.getElementById("PROVINCE_NAME").value;   
  amphurname = document.getElementById("AMPHUR_NAME").value;        
  tumbonname = document.getElementById("TUMBON_NAME").value;   
  zipcodename = document.getElementById("HR_ZIPCODE").value;  
  
  homenumber1 = document.getElementById("HR_HOME_NUMBER_1").value;
  villageno1 = document.getElementById("HR_VILLAGE_NO_1").value;  
  provincename1 = document.getElementById("PROVINCE_NAME_1").value;   
  amphurname1 = document.getElementById("AMPHUR_NAME_1").value;        
  tumbonname1 = document.getElementById("TUMBON_NAME_1").value;   
  zipcodename1 = document.getElementById("HR_ZIPCODE_1").value;       





  if (nusername==null || nusername==''){      
        document.getElementById("username").style.display = "";     
        text_username = "*กรุณาระบุ Username";
        document.getElementById("username").innerHTML = text_username;
        
   }else{
        document.getElementById("username").style.display = "none";
   }
  

  if (nprefix==null || nprefix==''){      
        document.getElementById("prefix").style.display = "";     
        text_prefix = "*กรุณาระบุคำนำหน้าชื่อ";
        document.getElementById("prefix").innerHTML = text_prefix;

   }else{
        document.getElementById("prefix").style.display = "none";
   }

if (name==null || name==''){
   document.getElementById("fname").style.display = "";     
   text_name = "*กรุณาระบุข้อมูลชื่อ";
   document.getElementById("fname").innerHTML = text_name;
}else{
     document.getElementById("fname").style.display = "none";
}


if (lastname==null || lastname==''){
   document.getElementById("lname").style.display = "";     
   text_lastname = "*กรุณาระบุข้อมูลนามสกุล";
   document.getElementById("lname").innerHTML = text_lastname;
}else{
   document.getElementById("lname").style.display = "none";
}


if (birthdate==null || birthdate==''){
   document.getElementById("birth_date").style.display = "";     
   text_birthdate= "*กรุณาระบุข้อมูลวันเกิด";
   document.getElementById("birth_date").innerHTML = text_birthdate;
}else{
   document.getElementById("birth_date").style.display = "none";
}

if (hrcid==null || hrcid==''){
   document.getElementById("cid").style.display = "";     
   text_hrcid= "*กรุณาระบุข้อมูลเลขประจำตัวประชาชน";
   document.getElementById("cid").innerHTML = text_hrcid;
}else{
   document.getElementById("cid").style.display = "none";
}






if (hremail==null || hremail==''){
   document.getElementById("hremail").style.display = "";     
   text_email= "*กรุณาระบุอีเมลล์";
   document.getElementById("hremail").innerHTML = text_email;
}else{
      document.getElementById("hremail").style.display = "none";    
}


if (hrdepartment==null || hrdepartment==''){
   document.getElementById("hrdepartment").style.display = "";     
   text_department= "*กรุณาระบุกลุ่มงาน";
   document.getElementById("hrdepartment").innerHTML = text_department;
}else{
   document.getElementById("hrdepartment").style.display = "none";
}

if (hrdepartmentsub==null || hrdepartmentsub==''){
   document.getElementById("hrdepartmentsub").style.display = "";     
   text_departmentsub= "*กรุณาระบุฝ่าย/แผนก";
   document.getElementById("hrdepartmentsub").innerHTML = text_departmentsub;
}else{
   document.getElementById("hrdepartmentsub").style.display = "none";
}

if (hrdepartmentsubsub==null || hrdepartmentsubsub==''){
   document.getElementById("hrdepartmentsubsub").style.display = "";     
   text_departmentsubsub= "*กรุณาระบุหน่วยงาน";
   document.getElementById("hrdepartmentsubsub").innerHTML = text_departmentsubsub;
}else{
   document.getElementById("hrdepartmentsubsub").style.display = "none";
}

if (startworkdate==null || startworkdate==''){
   document.getElementById("startworkdate").style.display = "";     
   text_startworkdate= "*กรุณาระบุวันเริ่มงาน";
   document.getElementById("startworkdate").innerHTML = text_startworkdate;
}else{
   document.getElementById("startworkdate").style.display = "none";
}

if (hrpositioninwork==null || hrpositioninwork==''){
   document.getElementById("hrpositioninwork").style.display = "";     
   text_positioninwork= "*กรุณาระบุตำแหน่ง";
   document.getElementById("hrpositioninwork").innerHTML = text_positioninwork;
}else{
   document.getElementById("hrpositioninwork").style.display = "none";
}

if (hrstatus==null || hrstatus==''){
   document.getElementById("hrstatus").style.display = "";     
   text_status= "*กรุณาระบุสถานะ";
   document.getElementById("hrstatus").innerHTML = text_status;
}else{
   document.getElementById("hrstatus").style.display = "none";
}



if (hrpersontype==null || hrpersontype==''){
   document.getElementById("hrpersontype").style.display = "";     
   text_persontype= "*กรุณาระบุกลุ่มบุคลากร";
   document.getElementById("hrpersontype").innerHTML = text_persontype;
}else{
   document.getElementById("hrpersontype").style.display = "none";
}

if (hrsalary==null || hrsalary==''){
   document.getElementById("hrsalary").style.display = "";     
   text_salary= "*กรุณาระบุเงินเดือน";
   document.getElementById("hrsalary").innerHTML = text_salary;
}else{
   document.getElementById("hrsalary").style.display = "none";
}

if (homenumber==null || homenumber==''){
   document.getElementById("homenumber").style.display = "";     
   text_homenumber= "*กรุณาระบุบ้านเลขที่";
   document.getElementById("homenumber").innerHTML = text_homenumber;
}else{
   document.getElementById("homenumber").style.display = "none";
}

if (villageno==null || villageno==''){
   document.getElementById("villageno").style.display = "";     
   text_villageno= "&nbsp;*กรุณาระบุหมู่ที่";
   document.getElementById("villageno").innerHTML = text_villageno;
}else{
   document.getElementById("villageno").style.display = "none";
}

if (provincename==null || provincename==''){
   document.getElementById("provincename").style.display = "";     
   text_provincename= "*กรุณาระบุจังหวัด";
   document.getElementById("provincename").innerHTML = text_provincename;
}else{
   document.getElementById("provincename").style.display = "none";
}

if (amphurname==null || amphurname==''){
   document.getElementById("amphurname").style.display = "";     
   text_amphurname= "*กรุณาระบุอำเภอ";
   document.getElementById("amphurname").innerHTML = text_amphurname;
}else{
   document.getElementById("amphurname").style.display = "none";
}

if (tumbonname==null || tumbonname==''){
   document.getElementById("tumbonname").style.display = "";     
   text_tumbonname= "*กรุณาระบุตำบล";
   document.getElementById("tumbonname").innerHTML = text_tumbonname;
}else{
   document.getElementById("tumbonname").style.display = "none";
}

if (zipcodename==null || zipcodename==''){
   document.getElementById("zipcodename").style.display = "";     
   text_zipcodename= "*กรุณาระบุรหัสไปรษณีย์";
   document.getElementById("zipcodename").innerHTML = text_zipcodename;
}else{
   document.getElementById("zipcodename").style.display = "none";
}

if (homenumber1==null || homenumber1==''){
   document.getElementById("homenumber1").style.display = "";     
   text_homenumber1= "*กรุณาระบุบ้านเลขที่";
   document.getElementById("homenumber1").innerHTML = text_homenumber1;
}else{
   document.getElementById("homenumber1").style.display = "none";
}

if (villageno1==null || villageno1==''){
   document.getElementById("villageno1").style.display = "";     
   text_villageno1= "*กรุณาระบุหมู่ที่";
   document.getElementById("villageno1").innerHTML = text_villageno1;
}else{
   document.getElementById("villageno1").style.display = "none";
}

if (provincename1==null || provincename1==''){
   document.getElementById("provincename1").style.display = "";     
   text_provincename1= "*กรุณาระบุจังหวัด";
   document.getElementById("provincename1").innerHTML = text_provincename1;
}else{
   document.getElementById("provincename1").style.display = "none";
}

if (amphurname1==null || amphurname1==''){
   document.getElementById("amphurname1").style.display = "";     
   text_amphurname1= "*กรุณาระบุอำเภอ";
   document.getElementById("amphurname1").innerHTML = text_amphurname1;
}else{
   document.getElementById("amphurname1").style.display = "none";
}


if (tumbonname1==null || tumbonname1==''){
   document.getElementById("tumbonname1").style.display = "";     
   text_tumbonname1= "*กรุณาระบุตำบล";
   document.getElementById("tumbonname1").innerHTML = text_tumbonname1;
}else{
   document.getElementById("tumbonname1").style.display = "none";
}

if (zipcodename1==null || zipcodename1==''){
   document.getElementById("zipcodename1").style.display = "";     
   text_zipcodename1= "*กรุณาระบุรหัสไปรษณีย์";
   document.getElementById("zipcodename1").innerHTML = text_zipcodename1;
}else{
   document.getElementById("zipcodename1").style.display = "none";
}

checkhrpersontype()

//กำหนดการแจ้งเตือนใน submin
if(     nusername==null || nusername=='' ||
        name==null || name=='' || 
        nprefix==null || nprefix=='' ||
        lastname==null || lastname=='' ||
        birthdate==null || birthdate=='' || 
        hrcid==null || hrcid=='' ||
        hremail==null || hremail=='' || 
        hrdepartment==null || hrdepartment=='' ||
        startworkdate==null || startworkdate=='' || 
        hrpositioninwork==null || hrpositioninwork=='' ||
        hrstatus==null || hrstatus=='' ||
        hrpersontype==null || hrpersontype=='' || 
        hrsalary==null || hrsalary=='' ||
        homenumber==null || homenumber=='' || 
        villageno1==null || villageno1=='' || 
        provincename1==null || provincename1=='' ||
        amphurname1==null || amphurname1==''|| 
        tumbonname1==null || tumbonname1=='' ||
        homenumber1==null || homenumber1=='' || 
        // HR_POSITION_NUM==null || HR_POSITION_NUM=='' ||       
        zipcodename1==null || homenumber1==''
)
{
       
        Swal.fire({
                    icon: 'error',
                    title: 'กรอกข้อมูลให้ครบถ้วน',
                    text: 'Something went wrong!',
                  })
    return false;   
}

});
		
</script>


@endsection