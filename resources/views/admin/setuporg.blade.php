@extends('layouts.backend_admin')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}


 
  $m_budget = date("m");
  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

?>
<body>
           
                    <!-- Advanced Tables -->
                 
                <div class="content">
                <div class="block block-rounded block-bordered">

                <div class="block-content"> 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ข้อมูลองค์กร</h2>    

                

                <form  method="post" action="{{ route('setuporg.updatedata') }}" enctype="multipart/form-data">
                @csrf
       
 <div class="row"> 
  <div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >ชื่อหน่วยงาน :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name = "ORG_NAME"  id="ORG_NAME"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_NAME }}" onkeyup="check_org_name();">
    <div style="color: red; font-size: 16px;" id="org_name"></div>
  </div>
    </div> 
</div> 
<div class="row">
  <div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <label>ชื่อย่อหน่วยงาน :</label>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      <input name="ORG_INITIALS" id="ORG_INITIALS" class="form-control input-lg"
        style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_INITIALS }}">
    </div>
  </div>
</div>
<div class="row">
  <div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <label>ที่อยู่ :</label>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      <input name="ORG_ADDRESS" id="ORG_ADDRESS" class="form-control input-lg"
        style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_ADDRESS }}"
        onkeyup="check_org_address();">
      <div style="color: red; font-size: 16px;" id="org_address"></div>
    </div>
  </div>
</div>
<div class="row">
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>    
    <div class="col-lg-2">
      <div class="form-group">
      <label >อำเภอ :</label>
      </div>
    </div> 
    <div class="col-lg-3">
    <div class="form-group">
    <input  name = "DISTRICT"  id="DISTRICT"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->DISTRICT }}" onkeyup="check_org_district();">
    <div style="color: red; font-size: 16px;" id="org_district"></div>
  </div>
    </div> 
    <div class="col-lg-1">
      <div class="form-group">
      <label >จังหวัด :</label>
      </div>
    </div> 
    <div class="col-lg-2">
    <div class="form-group">
    <input  name = "PROVINCE"  id="PROVINCE"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->PROVINCE }}" onkeyup="check_org_province();">
    <div style="color: red; font-size: 16px;" id="org_province"></div>
  </div>
    </div> 
</div> 
<div class="row">   
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div> 
    <div class="col-lg-2">
      <div class="form-group">
      <label >เบอร์โทร :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name = "ORG_PHONE"  id="ORG_PHONE"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_PHONE }}" onkeyup="check_org_phone();">
    <div style="color: red; font-size: 16px;" id="org_phone"></div>
  </div>
    </div> 
</div> 
<div class="row">   
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div> 
    <div class="col-lg-2">
      <div class="form-group">
      <label >e-mail :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name ="ORG_EMAIL"  id="ORG_EMAIL"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_EMAIL }}" onkeyup="check_org_email();" >
    <div style="color: red; font-size: 16px;" id="org_email"></div>
  </div>
    </div> 
</div> 
<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >WEBSITE  :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name = "ORG_WEBSITE"  id="ORG_WEBSITE"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_WEBSITE }}" onkeyup="check_org_website();">
    <div style="color: red; font-size: 16px;" id="org_website"></div>
  </div>
    </div> 
</div> 
<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >FAX :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name = "ORG_FAX"  id="ORG_FAX"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_FAX }}" onkeyup="check_org_fax();">
    <div style="color: red; font-size: 16px;" id="org_fax"></div>
  </div>
    </div> 
</div> 
<div class="row">  
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>  
    <div class="col-lg-2">
      <div class="form-group">
      <label >HOSPITAL CODE :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name = "ORG_PCODE"  id="ORG_PCODE"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_PCODE }}" onkeyup="check_org_pcode();">
    <div style="color: red; font-size: 16px;" id="org_pcode"></div>
  </div>
    </div> 
</div> 
<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >ชื่อผู้อำนวยการ :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
   
    
    <select name="ORG_LEADER_ID" id="ORG_LEADER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;" onchange="check_org_leaderid();">
      <option value="">--กรุณาเลือกชื่อผู้อำนวยการ--</option>
            @foreach ($infopersons as $infoperson) 
                  @if($infoperson ->ID == $infoorg->ORG_LEADER_ID )
                  <option value="{{ $infoperson ->ID  }}" selected> {{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                  @else
                  <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                  @endif                                                    
                  
            @endforeach 
      </select>
      <div style="color: red; font-size: 16px;" id="org_leaderid"></div>
    </div>
    </div> 
</div> 

<div class="row">  
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>  
    <div class="col-lg-2">
      <div class="form-group">
      <label >ตำแหน่ง :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name = "ORG_LEADER_POSITION"  id="ORG_LEADER_POSITION"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_LEADER_POSITION }}" onkeyup="check_org_leader_position();">
    <div style="color: red; font-size: 16px;" id="org_leader_position"></div>  
  </div>
    </div> 
</div> 


<div class="row">   
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div> 
    <div class="col-lg-2">
      <div class="form-group">
      <label >ปีงบประมาณปัจจุบัน :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <p style=" font-family: 'Kanit', sans-serif; font-size: 13px;">{{ $yearbudget }}</p>
    <input type="hidden"  name = "YEAR_NOW_ID"  id="YEAR_NOW_ID"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $yearbudget }}">
    
    </div>
    </div> 
</div> 
<div class="row">  
  <div>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>  
      <div class="col-lg-2">
        <div class="form-group">
        <label >ค่านิยมองค์กร :</label>
        </div>
      </div> 
      <div class="col-lg-6">
      <div class="form-group">
      <input  name = "ORG_POPULAR"  id="ORG_POPULAR"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_POPULAR }}" >
    </div>
      </div> 
  </div> 
<div class="row"> 
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>   
    <div class="col-lg-2">
      <div class="form-group">
      <label >ผู้ตรวจสอบการลา :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    
    <select name="CHECK_HR_ID" id="CHECK_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;" onchange="check_check_hr_id();">
      <option value="">--กรุณาเลือกชื่อผู้ตรวสอบการลา--</option>
            @foreach ($infopersons as $infoperson) 
                  @if($infoperson ->ID == $infoorg->CHECK_HR_ID )
                  <option value="{{ $infoperson ->ID  }}" selected> {{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                  @else
                  <option value="{{ $infoperson ->ID  }}">{{ $infoperson-> HR_FNAME }} {{ $infoperson-> HR_LNAME }}</option>
                  @endif                                                    
                  
            @endforeach 
      </select>
      <div style="color: red; font-size: 16px;" id="check_hr_id"></div> 
    </div>
    </div> 
</div>     
      
<div class="row">   
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div> 
    <div class="col-lg-2">
      <div class="form-group">
      <label >ชื่อนายอำเภอ :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name ="ORG_AMPHUR"  id="ORG_AMPHUR"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_AMPHUR }}" onkeyup="check_org_amphur();">
    <div style="color: red; font-size: 16px;" id="org_amphur"></div>
  </div>
    </div> 
</div> 

<div class="row">  
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>  
    <div class="col-lg-2">
      <div class="form-group">
      <label >ตำแหน่ง :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input name="ORG_AMPHUR_LEADER" id="ORG_AMPHUR_LEADER" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->ORG_AMPHUR_LEADER }}" onkeyup="check_org_amphur_leader();">
    <div style="color: red; font-size: 16px;" id="org_amphur_leader"></div>
  </div>
    </div> 
</div> 

<div class="row">   
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div> 
    <div class="col-lg-2">
      <div class="form-group">
      <label >ประเภทองค์กร :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
   
    <select name="TYPE" id="TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;">
 
  @if($infoorg->TYPE  == "HOSPITAL")
     <option value="HOSPITAL" selected>โรงพยาบาล</option>
     <option value="MINI-HOS">โรงพยาบาลส่งเสริมสุขภาพตำบล [รพ.สต.]</option>
  @else
     <option value="HOSPITAL" >โรงพยาบาล</option>
      <option value="MINI-HOS" selected>โรงพยาบาลส่งเสริมสุขภาพตำบล [รพ.สต.]</option>
  @endif
                                
    </select>
  
    
    </div>
    </div>
    </div>


    <div class="row">   
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div> 
    <div class="col-lg-2">
      <div class="form-group">
      <label >นายแพทย์ สสจ. :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input  name ="PROVINCE_DR_NAME"  id="PROVINCE_DR_NAME"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->PROVINCE_DR_NAME }}" >
   
  </div>
    </div> 
</div> 

<div class="row">  
<div>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>  
    <div class="col-lg-2">
      <div class="form-group">
      <label >ตำแหน่ง :</label>
      </div>
    </div> 
    <div class="col-lg-6">
    <div class="form-group">
    <input name="PROVINCE_DR_POSITION" id="PROVINCE_DR_POSITION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif; font-size: 13px;" value="{{ $infoorg->PROVINCE_DR_POSITION }}" >
 
  </div>
    </div> 
</div> 
<br><br>

<div class="row">  
  <div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
  <div class="col-lg-2">
    <div class="form-group">
    <label >สัญลักษณ์ (size 150x150) :</label>
  </div>
  </div>
  <div class="col-lg-4">
<div class="form-group">

  
  @if ( $infoorg->img_logo == Null )
  <img id="image_upload_preview" src="{{asset('image/pers.png')}}" height="180" width="180"> 
@else
<img id="image_upload_preview" src="data:image/png;base64,{{ chunk_split(base64_encode($infoorg->img_logo)) }}" height="180" width="180"> 
@endif



</div>                             
  <div class="form-group">
  <input style="font-family: 'Kanit', sans-serif;" type="file" name="picture" id="picture" class="form-control">
  </div>
</div>

</div>

    <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" > <i class="fas fa-save"></i>  บันทึกข้อมูล</button>
       </div>    

</div> 
<input type="hidden"  name = "ORG_ID"  id="ORG_ID"  class="form-control input-lg"  style=" font-family: 'Kanit', sans-serif;" value="{{ $infoorg->ORG_ID }}">
</body>
</form>
@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
        function check_org_name()
        {                         
          org_name = document.getElementById("ORG_NAME").value;             
                if (org_name==null || org_name==''){
                document.getElementById("org_name").style.display = "";     
                text_org_name = "*กรุณาระบุชื่อหน่วยงาน";
                document.getElementById("org_name").innerHTML = text_org_name;
                }else{
                document.getElementById("org_name").style.display = "none";
                }
        }
        function check_org_address()
        {                         
          org_address = document.getElementById("ORG_ADDRESS").value;             
                if (org_address==null || org_address==''){
                document.getElementById("org_address").style.display = "";     
                text_org_address = "*กรุณาระบุที่อยู่";
                document.getElementById("org_address").innerHTML = text_org_address;
                }else{
                document.getElementById("org_address").style.display = "none";
                }
        }
        function check_org_phone()
        {                         
          org_phone = document.getElementById("ORG_PHONE").value;             
                if (org_phone==null || org_phone==''){
                document.getElementById("org_phone").style.display = "";     
                text_org_phone = "*กรุณาระบุเบอร์โทร";
                document.getElementById("org_phone").innerHTML = text_org_phone;
                }else{
                document.getElementById("org_phone").style.display = "none";
                }
        }
        function check_org_email()
        {                         
          org_email = document.getElementById("ORG_EMAIL").value;             
                if (org_email==null || org_email==''){
                document.getElementById("org_email").style.display = "";     
                text_org_email = "*กรุณาระบุ email";
                document.getElementById("org_email").innerHTML = text_org_email;
                }else{
                document.getElementById("org_email").style.display = "none";
                }
        }
        function check_org_website()
        {                         
          org_website = document.getElementById("ORG_WEBSITE").value;             
                if (org_website==null || org_website==''){
                document.getElementById("org_website").style.display = "";     
                text_org_website = "*กรุณาระบุ WEBSITE";
                document.getElementById("org_website").innerHTML = text_org_website;
                }else{
                document.getElementById("org_website").style.display = "none";
                }
        }
        function check_org_fax()
        {                         
          org_fax = document.getElementById("ORG_FAX").value;             
                if (org_fax==null || org_fax==''){
                document.getElementById("org_fax").style.display = "";     
                text_org_fax = "*กรุณาระบุ FAX";
                document.getElementById("org_fax").innerHTML = text_org_fax;
                }else{
                document.getElementById("org_fax").style.display = "none";
                }
        }
        function check_org_pcode()
        {                         
          org_pcode = document.getElementById("ORG_PCODE").value;             
                if (org_pcode==null || org_pcode==''){
                document.getElementById("org_pcode").style.display = "";     
                text_org_pcode = "*กรุณาระบุ HOSPITAL CODE";
                document.getElementById("org_pcode").innerHTML = text_org_pcode;
                }else{
                document.getElementById("org_pcode").style.display = "none";
                }
        }
        function check_org_leaderid()
        {                         
          org_leaderid = document.getElementById("ORG_LEADER_ID").value;             
                if (org_leaderid==null || org_leaderid==''){
                document.getElementById("org_leaderid").style.display = "";     
                text_org_leaderid = "*กรุณาเลือกชื่อผู้อำนวยการ";
                document.getElementById("org_leaderid").innerHTML = text_org_leaderid;
                }else{
                document.getElementById("org_leaderid").style.display = "none";
                }
        }
        function check_org_leader_position()
        {                         
          org_leader_position = document.getElementById("ORG_LEADER_POSITION").value;             
                if (org_leader_position==null || org_leader_position==''){
                document.getElementById("org_leader_position").style.display = "";     
                text_org_leader_position = "*กรุณาระบุตำแหน่ง";
                document.getElementById("org_leader_position").innerHTML = text_org_leader_position;
                }else{
                document.getElementById("org_leader_position").style.display = "none";
                }
        }
        function check_check_hr_id()
        {                         
          check_hr_id = document.getElementById("CHECK_HR_ID").value;             
                if (check_hr_id==null || check_hr_id==''){
                document.getElementById("check_hr_id").style.display = "";     
                text_check_hr_id = "*กรุณาเลือกชื่อผู้ตรวสอบการลา";
                document.getElementById("check_hr_id").innerHTML = text_check_hr_id;
                }else{
                document.getElementById("check_hr_id").style.display = "none";
                }
        }
        function check_org_amphur()
        {                         
          org_amphur = document.getElementById("ORG_AMPHUR").value;             
                if (org_amphur==null || org_amphur==''){
                document.getElementById("org_amphur").style.display = "";     
                text_org_amphur = "*กรุณาเลือกชื่อนายอำเภอ";
                document.getElementById("org_amphur").innerHTML = text_org_amphur;
                }else{
                document.getElementById("org_amphur").style.display = "none";
                }
        }
        function check_org_amphur_leader()
        {                         
          org_amphur_leader = document.getElementById("ORG_AMPHUR_LEADER").value;             
                if (org_amphur_leader==null || org_amphur_leader==''){
                document.getElementById("org_amphur_leader").style.display = "";     
                text_org_amphur_leader = "*กรุณาระบุตำแหน่ง";
                document.getElementById("org_amphur_leader").innerHTML = text_org_amphur_leader;
                }else{
                document.getElementById("org_amphur_leader").style.display = "none";
                }
        }


        function check_org_district()
        {                         
          org_district = document.getElementById("DISTRICT").value;             
                if (org_district==null || org_district==''){
                document.getElementById("org_district").style.display = "";     
                text_org_district= "*กรุณาระบุอำเภอ";
                document.getElementById("org_district").innerHTML = text_org_district;
                }else{
                document.getElementById("org_district").style.display = "none";
                }
        }


        function check_org_province()
        {                         
          org_province = document.getElementById("PROVINCE").value;             
                if (org_province==null || org_province==''){
                document.getElementById("org_province").style.display = "";     
                text_org_province = "*กรุณาระบุจังหวัด";
                document.getElementById("org_province").innerHTML = text_org_province;
                }else{
                document.getElementById("org_province").style.display = "none";
                }
        }
     
</script>
<script>
        $('form').submit(function () {
          var org_name,text_org_name;
          var org_address,text_org_address;
          var org_phone,text_org_phone;
          var org_email,text_org_email;
          var org_website,text_org_website;
          var org_fax,text_org_fax;
          var org_pcode,text_org_pcode;
          var org_leaderid,text_org_leaderid;
          var org_leader_position,text_org_leader_position;
          var check_hr_id,text_check_hr_id;
          var org_amphur,text_org_amphur;
          var org_amphur_leader,text_org_amphur_leader;
          var org_district,text_org_district;
          var org_province,text_org_province;
         

          org_amphur = document.getElementById("ORG_AMPHUR").value;
          check_hr_id = document.getElementById("CHECK_HR_ID").value;
          org_name = document.getElementById("ORG_NAME").value;
          org_address =document.getElementById("ORG_ADDRESS").value;
          org_phone =document.getElementById("ORG_PHONE").value;
          org_email =document.getElementById("ORG_EMAIL").value;
          org_website =document.getElementById("ORG_WEBSITE").value;
          org_fax =document.getElementById("ORG_FAX").value;
          org_pcode =document.getElementById("ORG_PCODE").value;
          org_leaderid =document.getElementById("ORG_LEADER_ID").value;
          org_leader_position =document.getElementById("ORG_LEADER_POSITION").value;
          org_amphur_leader =document.getElementById("ORG_AMPHUR_LEADER").value;
          org_district = document.getElementById("DISTRICT").value;  
          org_province = document.getElementById("PROVINCE").value;   
         

          if (check_hr_id==null || check_hr_id==''){
          document.getElementById("check_hr_id").style.display = "";     
          text_check_hr_id= "*กรุณาเลือกชื่อผู้ตรวสอบการลา";
          document.getElementById("check_hr_id").innerHTML = text_check_hr_id;
          }else{
          document.getElementById("check_hr_id").style.display = "none";
          }
          if (org_leader_position==null || org_leader_position==''){
          document.getElementById("org_leader_position").style.display = "";     
          text_org_leader_position= "*กรุณาระบุตำแหน่ง";
          document.getElementById("org_leader_position").innerHTML = text_org_leader_position;
          }else{
          document.getElementById("org_leader_position").style.display = "none";
          }

          if (org_pcode==null || org_pcode==''){
          document.getElementById("org_pcode").style.display = "";     
          text_org_pcode= "*กรุณาระบุ HOSPITAL CODE";
          document.getElementById("org_pcode").innerHTML = text_org_pcode;
          }else{
          document.getElementById("org_pcode").style.display = "none";
          }
          if (org_name==null || org_name==''){
          document.getElementById("org_name").style.display = "";     
          text_org_name= "*กรุณาระบุชื่อหน่วยงาน";
          document.getElementById("org_name").innerHTML = text_org_name;
          }else{
          document.getElementById("org_name").style.display = "none";
          }
          if (org_address==null || org_address==''){
          document.getElementById("org_address").style.display = "";     
          text_org_address= "*กรุณาระบุที่อยู่";
          document.getElementById("org_address").innerHTML = text_org_address;
          }else{
          document.getElementById("org_address").style.display = "none";
          }

          if (org_phone==null || org_phone==''){
          document.getElementById("org_phone").style.display = "";     
          text_org_phone= "*กรุณาระบุเบอร์โทร";
          document.getElementById("org_phone").innerHTML = text_org_phone;
          }else{
          document.getElementById("org_phone").style.display = "none";
          }
          if (org_email==null || org_email==''){
          document.getElementById("org_email").style.display = "";     
          text_org_email= "*กรุณาระบุ email";
          document.getElementById("org_email").innerHTML = text_org_email;
          }else{
          document.getElementById("org_email").style.display = "none";
          }

          if (org_website==null || org_website==''){
          document.getElementById("org_website").style.display = "";     
          text_org_website= "*กรุณาระบุ WEBSITE";
          document.getElementById("org_website").innerHTML = text_org_website;
          }else{
          document.getElementById("org_website").style.display = "none";
          }
          if (org_fax==null || org_fax==''){
          document.getElementById("org_fax").style.display = "";     
          text_org_fax= "*กรุณาระบุ FAX";
          document.getElementById("org_fax").innerHTML = text_org_fax;
          }else{
          document.getElementById("org_fax").style.display = "none";
          }
          if (org_leaderid==null || org_leaderid==''){
          document.getElementById("org_leaderid").style.display = "";     
          text_org_leaderid= "*กรุณาเลือกชื่อผู้อำนวยการ";
          document.getElementById("org_leaderid").innerHTML = text_org_leaderid;
          }else{
          document.getElementById("org_leaderid").style.display = "none";
          }
       
          if (org_amphur==null || org_amphur==''){
          document.getElementById("org_amphur").style.display = "";     
          text_org_amphur= "*กรุณาเลือกชื่อนายอำเภอ";
          document.getElementById("org_amphur").innerHTML = text_org_amphur;
          }else{
          document.getElementById("org_amphur").style.display = "none";
          }

          if (org_amphur_leader==null || org_amphur_leader==''){
          document.getElementById("org_amphur_leader").style.display = "";     
          text_org_amphur_leader= "*กรุณาระบุตำแหน่ง";
          document.getElementById("org_amphur_leader").innerHTML = text_org_amphur_leader;
          }else{
          document.getElementById("org_amphur_leader").style.display = "none";
          }

          if (org_province==null || org_province==''){
                document.getElementById("org_province").style.display = "";     
                text_org_province = "*กรุณาระบุจังหวัด";
                document.getElementById("org_province").innerHTML = text_org_province;
                }else{
                document.getElementById("org_province").style.display = "none";
                }


                if (org_district==null || org_district==''){
                document.getElementById("org_district").style.display = "";     
                text_org_district= "*กรุณาระบุอำเภอ";
                document.getElementById("org_district").innerHTML = text_org_district;
                }else{
                document.getElementById("org_district").style.display = "none";
                }
         
     
          if(org_name==null || org_name==''||
          org_address==null || org_address==''||
          org_phone==null || org_phone==''||
          org_email==null || org_email==''||
          org_website==null || org_website==''||
          org_fax==null || org_fax==''||
          org_pcode==null || org_pcode==''||
          org_leaderid==null || org_leaderid==''||
          org_leader_position==null || org_leader_position==''||
          check_hr_id==null || check_hr_id==''||
          org_amphur==null || org_amphur==''||
          org_amphur_leader==null || org_amphur_leader=='' ||
          org_province==null || org_province=='' ||
          org_district==null || org_district==''
          
        )
{
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
}
});
</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,  //Set เป็นปี พ.ศ.
                autoclose: true 
            });  //กำหนดเป็นวันปัจุบัน

      
});
    

function updatedata(){

        var ORG_ID=document.getElementById("ORG_ID").value;
        var ORG_NAME=document.getElementById("ORG_NAME").value;   
        var ORG_ADDRESS=document.getElementById("ORG_ADDRESS").value;
        var ORG_PHONE=document.getElementById("ORG_PHONE").value;
        var ORG_EMAIL=document.getElementById("ORG_EMAIL").value;
        var ORG_WEBSITE=document.getElementById("ORG_WEBSITE").value;
        var ORG_FAX=document.getElementById("ORG_FAX").value;
        var ORG_PCODE=document.getElementById("ORG_PCODE").value;
        var ORG_LEADER=document.getElementById("ORG_LEADER").value;
        var YEAR_NOW_ID=document.getElementById("YEAR_NOW_ID").value;
        var CHECK_HR_NAME=document.getElementById("CHECK_HR_NAME").value;
        var ORG_AMPHUR=document.getElementById("ORG_AMPHUR").value;
        var ORG_AMPHUR_LEADER=document.getElementById("ORG_AMPHUR_LEADER").value;
        var TYPE=document.getElementById("TYPE").value;
        
       // alert(date_end);

        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('setuporg.updatedata')}}",
                     method:"GET",
                     data:{ORG_ID:ORG_ID,ORG_NAME:ORG_NAME,ORG_ADDRESS:ORG_ADDRESS,
                      ORG_PHONE:ORG_PHONE,ORG_EMAIL:ORG_EMAIL,ORG_WEBSITE:ORG_WEBSITE,
                      ORG_FAX:ORG_FAX,ORG_PCODE:ORG_PCODE,ORG_LEADER:ORG_LEADER,
                      YEAR_NOW_ID:YEAR_NOW_ID,CHECK_HR_NAME:CHECK_HR_NAME,ORG_AMPHUR:ORG_AMPHUR,  
                      ORG_AMPHUR_LEADER:ORG_AMPHUR_LEADER,TYPE:TYPE,_token:_token}      
             })
             }        


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



@endsection