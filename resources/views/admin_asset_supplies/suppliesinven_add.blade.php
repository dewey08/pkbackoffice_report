@extends('layouts.backend_admin')
  
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
?>

           
                    <!-- Advanced Tables -->
                 
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-content"> 
            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;"> เพิ่มรายการคลังพัสดุ</h2>     
        <form  method="post" action="{{ route('admin.savesuppliesinven') }}" enctype="multipart/form-data">
            @csrf
                <div class="row push">                       
                    <div class="col-lg-1">
                        <label >ชื่อคลังพัสดุ</label>
                    </div>
                    <div class="col-lg-3">
                        <input  name = "INVEN_NAME"  id="INVEN_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_invenname();">
                        <div style="color: red; font-size: 16px;" id="invenname"></div> 
                    </div>
                    <div class="col-lg-1">
                            <label >ชื่อย่อ</label>
                    </div>
                    <div class="col-lg-3">
                        <input  name = "INVEN_NAME_SHORT"  id="INVEN_NAME_SHORT" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onkeyup="check_invennameshort();">
                        <div style="color: red; font-size: 16px;" id="invennameshort"></div> 
                    </div>                    
                    <div class="col-sm-1">
                        <label >ผู้รับผิดชอบหลัก</label>
                    </div>
                    <div class="col-sm-3">
                            <select name="INVEN_HR_ID" id="INVEN_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_invenhrid();">
                                    <option value="">--เลือกผู้รับผิดชอบหลัก--</option>
                                        @foreach ($personuserT as $personuser)                                                     
                                            <option value="{{$personuser->ID}}">{{ $personuser->HR_FNAME }} {{ $personuser->HR_LNAME }}</option>                                            
                                             @endforeach                                             
                            </select>
                            <div style="color: red; font-size: 16px;" id="invenhrid"></div>                              
                        </div>                        
                    </div>
                    <div class="row push">                       
                        <div class="col-lg-1">
                            <label >สถานที่ตั้ง</label>
                        </div>
                        <div class="col-lg-3">
                            <select name="INVEN_LOCATION_ID" id="INVEN_LOCATION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_invenlocationid();">
                                <option value="">--เลือกสถานที่ตั้ง--</option>
                                    @foreach ($locationT as $location)                                                     
                                        <option value="{{ $location ->LOCATION_ID  }}">{{ $location->LOCATION_NAME}}</option>
                                        @endforeach  
                            </select> 
                            <div style="color: red; font-size: 16px;" id="invenlocationid"></div> 
                        </div>                      
                        <div class="col-sm-1">
                            <label >ผู้ออกใบสั่งซื้อ</label>
                        </div>
                        <div class="col-sm-3">
                            <select name="INVEN_ORDER_HR_ID" id="INVEN_ORDER_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_invenorderhrid();">
                                    <option value="">--เลือกผู้ออกใบสั่งซื้อ--</option>
                                    @foreach ($personuserT as $personuser)                                                     
                                    <option value="{{$personuser->ID}}">{{ $personuser->HR_FNAME }} {{ $personuser->HR_LNAME }}</option>                                            
                                     @endforeach 
                            </select> 
                            <div style="color: red; font-size: 16px;" id="invenorderhrid"></div> 
                        </div>
                        <div class="col-sm-1">
                            <label >ผู้ขอซื้อ</label>
                        </div>
                        <div class="col-sm-3">
                            <select name="INVEN_WRITE_HR_ID" id="INVEN_WRITE_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_invenwritehrid();">
                                    <option value="">--เลือกผู้ขอซื้อ--</option>
                                    @foreach ($personuserT as $personuser)                                                     
                                    <option value="{{$personuser->ID}}">{{ $personuser->HR_FNAME }} {{ $personuser->HR_LNAME }}</option>                                            
                                     @endforeach 
                            </select> 
                            <div style="color: red; font-size: 16px;" id="invenwritehrid"></div> 
                        </div>
                        </div>
                        <div class="row push">                       
                            <div class="col-sm-1">
                                <label >ผู้อนุมัติซื้อ</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="INVEN_BUY_HR_ID" id="INVEN_BUY_HR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_invenbuyhrid();">
                                    <option value="">--เลือกผู้อนุมัติซื้อ--</option>
                                    @foreach ($personuserT as $personuser)                                                     
                                    <option value="{{$personuser->ID}}">{{ $personuser->HR_FNAME }} {{ $personuser->HR_LNAME }}</option>                                            
                                     @endforeach 
                                </select> 
                                <div style="color: red; font-size: 16px;" id="invenbuyhrid"></div> 
                            </div>
                        <div class="col-sm-1">
                            <label >ตำแหน่งผู้อนุมัติซื้อ</label>
                        </div>
                        <div class="col-sm-3">
                            <select name="INVEN_BUY_POSITION" id="INVEN_BUY_POSITION" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" onchange="check_invenbuyposition();" >
                                    <option value="">--เลือกตำแหน่งผู้อนุมัติซื้อ--</option>
                                    @foreach ($positionT as $position)                                                     
                                    <option value="{{ $position ->HR_POSITION_ID  }}">{{ $position->HR_POSITION_NAME}}</option>
                                    @endforeach 
                            </select> 
                            <div style="color: red; font-size: 16px;" id="invenbuyposition"></div> 
                        </div>
                        </div>  
                        <div class="modal-footer">
                            <div align="right">
                                <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                <a href="{{ url('admin_warehouse/setupsuppliesinven')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a> 
                            </div>
                        </div>
                </form>  
           

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>


<script>  

$(document).ready(function() {
    $("select").select2();
});

    function check_invenname()
    {                         
        invenname = document.getElementById("INVEN_NAME").value;             
            if (invenname==null || invenname==''){
            document.getElementById("invenname").style.display = "";     
            text_invenname = "*กรุณาระบุชื่อคลังพัสดุ";
            document.getElementById("invenname").innerHTML = text_invenname;
            }else{
            document.getElementById("invenname").style.display = "none";
            }
    }
    function check_invennameshort()
    {                         
        invennameshort = document.getElementById("INVEN_NAME_SHORT").value;             
            if (invennameshort==null || invennameshort==''){
            document.getElementById("invennameshort").style.display = "";     
            text_invennameshort = "*กรุณาระบุชื่อย่อ";
            document.getElementById("invennameshort").innerHTML = text_invennameshort;
            }else{
            document.getElementById("invennameshort").style.display = "none";
            }
    }
    function check_invenhrid()
    {                         
        invenhrid = document.getElementById("INVEN_HR_ID").value;             
            if (invenhrid==null || invenhrid==''){
            document.getElementById("invenhrid").style.display = "";     
            text_invenhrid = "*กรุณาระบุผู้รับผิดชอบหลัก";
            document.getElementById("invenhrid").innerHTML = text_invenhrid;
            }else{
            document.getElementById("invenhrid").style.display = "none";
            }
    }
    function check_invenlocationid()
    {                         
        invenlocationid = document.getElementById("INVEN_LOCATION_ID").value;             
            if (invenlocationid==null || invenlocationid==''){
            document.getElementById("invenlocationid").style.display = "";     
            text_invenlocationid = "*กรุณาระบุสถานที่ตั้ง";
            document.getElementById("invenlocationid").innerHTML = text_invenlocationid;
            }else{
            document.getElementById("invenlocationid").style.display = "none";
            }
    }
    function check_invenorderhrid()
    {                         
        invenorderhrid = document.getElementById("INVEN_ORDER_HR_ID").value;             
            if (invenorderhrid==null || invenorderhrid==''){
            document.getElementById("invenorderhrid").style.display = "";     
            text_invenorderhrid = "*กรุณาระบุผู้ออกใบสั่งซื้อ";
            document.getElementById("invenorderhrid").innerHTML = text_invenorderhrid;
            }else{
            document.getElementById("invenorderhrid").style.display = "none";
            }
    }
    function check_invenwritehrid()
    {                         
        invenwritehrid = document.getElementById("INVEN_WRITE_HR_ID").value;             
            if (invenwritehrid==null || invenwritehrid==''){
            document.getElementById("invenwritehrid").style.display = "";     
            text_invenwritehrid = "*กรุณาระบุผู้ขอใบสั่งซื้อ";
            document.getElementById("invenwritehrid").innerHTML = text_invenwritehrid;
            }else{
            document.getElementById("invenwritehrid").style.display = "none";
            }
    }
    function check_invenbuyhrid()
    {                         
        invenbuyhrid = document.getElementById("INVEN_BUY_HR_ID").value;             
            if (invenbuyhrid==null || invenbuyhrid==''){
            document.getElementById("invenbuyhrid").style.display = "";     
            text_invenbuyhrid = "*กรุณาระบุผู้อนุมัติซื้อ";
            document.getElementById("invenbuyhrid").innerHTML = text_invenbuyhrid;
            }else{
            document.getElementById("invenbuyhrid").style.display = "none";
            }
    }
    function check_invenbuyposition()
    {                         
        invenbuyposition = document.getElementById("INVEN_BUY_POSITION").value;             
            if (invenbuyposition==null || invenbuyposition==''){
            document.getElementById("invenbuyposition").style.display = "";     
            text_invenbuyposition = "*กรุณาระบุตำแหน่งผู้อนุมัติซื้อ";
            document.getElementById("invenbuyposition").innerHTML = text_invenbuyposition;
            }else{
            document.getElementById("invenbuyposition").style.display = "none";
            }
    }
   </script>
    <script>      
    $('form').submit(function () {
     
      var invenname,text_invenname; 
      var invennameshort,text_invennameshort;
      var invenhrid,text_invenhrid; 
      var invenlocationid,text_invenlocationid; 
      var invenorderhrid,text_invenorderhrid; 
      var invenwritehrid,text_invenwritehrid;  
      var invenbuyhrid,text_invenbuyhrid;  
      var invenbuyposition,text_invenbuyposition;     
     
      invenname = document.getElementById("INVEN_NAME").value; 
      invennameshort = document.getElementById("INVEN_NAME_SHORT").value;  
      invenhrid = document.getElementById("INVEN_HR_ID").value;
      invenlocationid = document.getElementById("INVEN_LOCATION_ID").value;
      invenorderhrid = document.getElementById("INVEN_ORDER_HR_ID").value;
      invenwritehrid = document.getElementById("INVEN_WRITE_HR_ID").value;
      invenbuyhrid = document.getElementById("INVEN_BUY_HR_ID").value;
      invenbuyposition = document.getElementById("INVEN_BUY_POSITION").value; 
                
      if (invenname==null || invenname==''){
      document.getElementById("invenname").style.display = "";     
      text_invenname = "*กรุณาระบุชื่อคลังพัสดุ";
      document.getElementById("invenname").innerHTML = text_invenname;
      }else{
      document.getElementById("invenname").style.display = "none";
      }
  
      if (invennameshort==null || invennameshort==''){
      document.getElementById("invennameshort").style.display = "";     
      text_invennameshort = "*กรุณาระบุชื่อย่อ";
      document.getElementById("invennameshort").innerHTML = text_invennameshort;
      }else{
      document.getElementById("invennameshort").style.display = "none";
      }     
  
        if (invenhrid==null || invenhrid==''){
      document.getElementById("invenhrid").style.display = "";     
      text_invenhrid = "*กรุณาระบุผู้รับผิดชอบหลัก";
      document.getElementById("invenhrid").innerHTML = text_invenhrid;
      }else{
      document.getElementById("invenhrid").style.display = "none";
      }     
  
          if (invenlocationid==null || invenlocationid==''){
      document.getElementById("invenlocationid").style.display = "";     
      text_invenlocationid = "*กรุณาระบุสถานที่ตั้ง";
      document.getElementById("invenlocationid").innerHTML = text_invenlocationid;
      }else{
      document.getElementById("invenlocationid").style.display = "none";
      }     
  
          if (invenorderhrid==null || invenorderhrid==''){
      document.getElementById("invenorderhrid").style.display = "";     
      text_invenorderhrid = "*กรุณาระบุผู้ออกใบสั่งซื้อ";
      document.getElementById("invenorderhrid").innerHTML = text_invenorderhrid;
      }else{
      document.getElementById("invenorderhrid").style.display = "none";
      }  
      if (invenwritehrid==null || invenwritehrid==''){
      document.getElementById("invenwritehrid").style.display = "";     
      text_invenwritehrid = "*กรุณาระบุผู้ขอใบสั่งซื้อ";
      document.getElementById("invenwritehrid").innerHTML = text_invenwritehrid;
      }else{
      document.getElementById("invenwritehrid").style.display = "none";
      }     
  
          if (invenbuyhrid==null || invenbuyhrid==''){
      document.getElementById("invenbuyhrid").style.display = "";     
      text_invenbuyhrid = "*กรุณาระบุผู้ขอใบสั่งซื้อ";
      document.getElementById("invenbuyhrid").innerHTML = text_invenbuyhrid;
      }else{
      document.getElementById("invenbuyhrid").style.display = "none";
      }     
  
          if (invenbuyposition==null || invenbuyposition==''){
      document.getElementById("invenbuyposition").style.display = "";     
      text_invenbuyposition = "*กรุณาระบุตำแหน่งผู้อนุมัติซื้อ";
      document.getElementById("invenbuyposition").innerHTML = text_invenbuyposition;
      }else{
      document.getElementById("invenbuyposition").style.display = "none";
      }    
          
      if(invenname==null || invenname==''||
      invennameshort==null || invennameshort==''||
      invenhrid==null || invenhrid==''||
      invenlocationid==null || invenlocationid==''||
      invenorderhrid==null || invenorderhrid==''||
      invenwritehrid==null || invenwritehrid==''||
      invenbuyhrid==null || invenbuyhrid==''||
      invenbuyposition==null || invenbuyposition==''
       )
    {
    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
    return false;   
    }
    }); 
</script>

@endsection