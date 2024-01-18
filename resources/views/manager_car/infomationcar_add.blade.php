@extends('layouts.car')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 

?>

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
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B><i class="fas fa-plus"></i> เพิ่มข้อมูลยานพหานะ</B></h3>

</div>
<div class="block-content block-content-full" align="left">

          
        <form  method="post" action="{{ route('mcar.saveinfocar') }}" enctype="multipart/form-data">
        @csrf
      
    <div class="row push">

       <div class="col-lg-4">
                                        <div class="form-group">
                                        <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                                        <img id="image_upload_preview" src="{{asset('image/default.jpg')}}" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="300px"/>
                                        </div>
                                        <div class="form-group">
                                        *ขนาดรูปไม่เกิน 350 x 350 pixel
                                        <input type="file" name="picture" id="picture" class="form-control">
                                        </div>
                                       
                                       
                                        
        </div>

        <div class="col-sm-8">
        <div class="row">
        <div class="col-lg-2">
        <label style="text-align: left">รหัสเลขที่ครุภัณฑ์ :</label>
        </div> 
        <div class="col-lg-7">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-3">
        {{-- <a href="" class="btn btn-hero-sm btn-hero-info" >เลือกครุภัณฑ์</a> --}}
        </div> 
        </div>
    <br>
        <div class="row push">
        <div class="col-lg-2">
        <label>ชื่อครุภัณฑ์ :</label>
        </div> 
        <div class="col-lg-7">
        <input name="ARTICLE_NAME" id="ARTICLE_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
       </div>
        
       <div class="row push">
        <div class="col-lg-2">
        <label>ทะเบียนรถ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_REG" id="CAR_REG" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-6">
        <input name="CAR_DETAIL" id="CAR_DETAIL" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
       </div>
        
        <div class="row push">
        <div class="col-lg-2">
        <label>ผู้รับผิดชอบ:</label>
        </div> 
        <div class="col-lg-4">
        <select name="CAR_PERSON_ID" id="CAR_PERSON_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกผู้รับผิดชอบหลัก--</option>
            @foreach ($drivers as $driver)                                                     
            <option value="{{ $driver ->PERSON_ID  }}">{{ $driver->HR_PREFIX_NAME}}{{ $driver->HR_FNAME}} {{$driver->HR_LNAME}}</option>
            @endforeach 
             </select>    
        </div> 
        <div class="col-lg-2">
        <label>สถานะ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CAR_STATUS_ID" id="CAR_STATUS_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกสถานะ--</option>
             @foreach ($carstatuss as $carstatus)                                                     
            <option value="{{ $carstatus ->CAR_STATUS_ID  }}">{{ $carstatus->CAR_STATUS_NAME}}</option>
            @endforeach 
             </select>    
        </div> 
        </div> 
     


        
        <div class="row push">
        <div class="col-lg-2">
        <label>ประเภท :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CAR_TYPE_ID" id="CAR_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกประเภท--</option>
             @foreach ($cartypes as $cartype)                                                     
            <option value="{{ $cartype ->CAR_TYPE_ID  }}">{{ $cartype->CAR_TYPE_NAME}}</option>
            @endforeach 
             </select>    
        </div> 
        <div class="col-lg-2">
        <label>ลักษณะรถ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CAR_STYLE_ID" id="CAR_STYLE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกลักษณะรถ--</option>
             @foreach ($carstyles as $carstyle)                                                     
            <option value="{{ $carstyle ->CAR_STYLE_ID  }}">{{ $carstyle->CAR_STYLE_NAME}}</option>
            @endforeach 
             </select>    
        </div> 
    
   
  
        </div>
     
        <div class="row push">
        <div class="col-lg-2">
        <label>ยี่ห้อ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="BRAND_ID" id="BRAND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกยี่ห้อ--</option>
             @foreach ($carbrands as $carbrand)                                                     
            <option value="{{ $carbrand ->BRAND_ID  }}">{{ $carbrand->BRAND_NAME}}</option>
            @endforeach 
             </select>    
        </div>
        <div class="col-lg-2">
        <label>เชื้อเพลิง :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CAR_POWER_ID" id="CAR_POWER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกเชื้อเพลิง--</option>
             @foreach ($carpowers as $carpower)                                                     
            <option value="{{ $carpower ->CAR_POWER_ID_NAME  }}">{{ $carpower->CAR_POWER_NAME}}</option>
            @endforeach 
             </select>    
        </div> 

        </div>
        <div class="row push">
        <div class="col-lg-2">
        <label>รุ่นปี :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_MODELS_YEAR" id="CAR_MODELS_YEAR" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>แบบ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_FOMATS" id="CAR_FOMATS" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>ยี่ห้อเครื่อง :</label>
        </div> 
        <div class="col-lg-2">
        <select name="CAR_MACHIN_BRAND_ID" id="CAR_MACHIN_BRAND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">-กรุณาเลือกยี่ห้อเครื่อง-</option>
             @foreach ($carmechinbrands as $carmechinbrand)                                                     
            <option value="{{ $carmechinbrand ->CAR_MACHIN_BRAND_ID  }}">{{ $carmechinbrand->CAR_MACHIN_BRAND_NAME}}</option>
            @endforeach 
             </select>    
        </div> 
           
  
        </div>

        <div class="row push">
        <div class="col-lg-2">
        <label>สี :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_COLOR" id="CAR_COLOR" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>จำนวนที่นั่ง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_SIT" id="CAR_SIT" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>เลขตัวรถ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_NUM_BODY" id="CAR_NUM_BODY" class="form-control input-sm " >
        </div> 
        </div>
        <div class="row push">
        <div class="col-lg-2">
        <label>ตำแหน่งเลขตัวรถ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_NUM_BODY_ADDR" id="CAR_NUM_BODY_ADDR" class="form-control input-sm " >
        </div> 
  
        <div class="col-lg-2">
        <label>เลขเครื่อง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_MACHIN_NUM" id="CAR_MACHIN_NUM" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>ตำแหน่งเลขเครื่อง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_MACHIN_ADDR" id="CAR_MACHIN_ADDR" class="form-control input-sm " >
        </div> 
       
        </div>
        <div class="row push">

        <div class="col-lg-2">
        <label>จำนวนแรงม้า :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_HORSE" id="CAR_HORSE" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>ขนาดเครื่อง :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_CC" id="CAR_CC" class="form-control input-sm " >
        </div> 
  
        <div class="col-lg-2">
        <label>เลขถังแก๊ส :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_GASS_NUM" id="CAR_GASS_NUM" class="form-control input-sm " >
        </div> 

        </div>
        <div class="row push">
        <div class="col-lg-2">
        <label>จำนวนลูกสูบ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_SUP" id="CAR_SUP" class="form-control input-sm " >
        </div> 
  
        <div class="col-lg-2">
        <label>จำนวนเพลา :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_PLOW" id="CAR_PLOW" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>จำนวนล้อ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_LO" id="CAR_LO" class="form-control input-sm " >
        </div> 
       
      
  
        </div>

    
        <div class="row push">
        <div class="col-lg-2">
        <label>น้ำหนักรถ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_WEIGHT" id="CAR_WEIGHT" class="form-control input-sm " >
        </div> 
        <div class="col-lg-2">
        <label>น้ำหนักรวม :</label>
        </div> 
        <div class="col-lg-2">
        <input name="CAR_SUM_WEIGHT" id="CAR_SUM_WEIGHT" class="form-control input-sm " >
        </div>
      
      
  
        </div>
        </div>
        </div>


        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('manager_car/infomationcar')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
    

<script>
  


$(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                    //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });





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