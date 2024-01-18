@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}

use App\Http\Controllers\LeaveController;
$checkleader = LeaveController::checkleader($user_id);

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

            datalist {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }

      
</style>



                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แจ้งซ่อมทั่วไป</h2> 
                        
        <form  method="post" action="{{ route('repair.saveinforepairnomal') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="ID" name="ID" style=" font-family: 'Kanit', sans-serif;" value="{{$inforepairnomal->ID}}">
        <div class="row push">
        <div class="col-sm-2">
        <label>วันที่แจ้งซ่อม :</label>
        </div> 
        <div class="col-lg-2">
        <input name="DATE_REQUEST" id="DATE_REQUEST" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy" value="{{formate(date('Y-m-d'))}}"  readonly>
        </div> 
        <div class="col-sm-1">
        <label>เวลา :</label>
        </div> 
        <div class="col-lg-2">
        <input type="text" class="js-masked-time form-control" id="TIME_REQUEST" name="TIME_REQUEST" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00" value="{{date('H:i')}}">
        </div> 


  
        <div class="col-sm-2">
        <label>ผู้แจ้งซ่อม :</label>
        </div> 
        <div class="col-lg-2">
        {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
        </div>   
    
        <input type="hidden" name="USER_REQUEST_ID" class="form-control input-lg" value="{{$inforpersonuserid->ID}}"  >
        </div>


       <div class="row push">

       
        <div class="col-sm-2">
        <label>แจ้งซ่อม :</label>
        </div> 
        <div class="col-lg-10">
        <input name="REPAIR_NAME" id="REPAIR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
    
   
        </div> 
        
     

    
        <div class="row push">
        <div class="col-sm-2">
        <label>สถานที่พบ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="LOCATION_SEE_ID" id="LOCATION_SEE_ID" class="form-control input-lg location" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกสถานที่--</option>
             @foreach ($infolocations as $infolocation)                                                     
            <option value="{{$infolocation->LOCATION_ID}}">{{ $infolocation->LOCATION_NAME}}</option>
            @endforeach 
             </select>    
        </div> 
        <div class="col-sm-1">
        <label>ชั้น :</label>
        </div> 
        <div class="col-lg-2">
                    <select name="LOCATIONLEVEL_SEE_ID" id="LOCATIONLEVEL_SEE_ID" class="form-control input-lg locationlevel" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกชั้น--</option>
            
                    </select>    
        </div> 
        <div class="col-sm-1">
        <label>ห้อง :</label>
        </div> 
        <div class="col-lg-2">
                    <select name="LOCATIONLEVELROOM_SEE_ID" id="LOCATIONLEVELROOM_SEE_ID" class="form-control input-lg locationlevelroom" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกห้อง--</option>

                    </select>    
        </div> 
        </div>
        <div class="row push">
        <div class="col-sm-2">
        <label>พัสดุครุภัณฑ์เสียหาย :</label>
        </div> 

        <div class="col-lg-6">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="form-check-input" name="checkasset" id="checkasset" value="asset" onclick="check(this.value)" checked>เลขทะเบียนครุภัณฑ์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" class="form-check-input" name="checkasset" id="checkasset" value="notasset" onclick="check(this.value)">รายการไม่ใช้ครุภัณฑ์
        
        </div> 
        </div>


        
        
        <div class="row push assetinput">
   
     
        <div class="col-sm-2">
        <label>ครุภัณฑ์ทะเบียน :</label>
        </div> 
        <div class="col-lg-4">
        <input list="assetall" value="" name="ARTICLE_ID" class="form-control input-lg" >
            <datalist id="assetall" >
            @foreach ($infoassets as $infoasset)                                                     
            <option value="{{ $infoasset->ARTICLE_NUM}}">{{ $infoasset->ARTICLE_NAME}} </option>
            @endforeach 
            </datalist> 
        </div> 
    
        <input type="hidden" value="" name="OTHER_NAME" class="form-control input-lg" >
        </div> 

        <div class="row push">
        <div class="col-sm-6">

                                        <div class="form-group">
                                        <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                                        <img id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="200" width="200"/>
                                        </div>
                                        <div class="form-group">
                                        *ขนาดรูปไม่เกิน 350 x 350 pixel
                                        <input type="file" name="picture" id="picture" class="form-control">
                                        </div>
                                       

        

        </div>

        <div class="col-sm-6">

        <div class="row push">
        <div class="col-sm-2">
        <label>อาการ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="SYMPTOM" id="SYMPTOM" class="form-control input-sm"  >
        </div>   
        </div>


        <div class="row push">
        <div class="col-sm-2">
        <label>ระบุช่าง :</label>
        </div> 
        <div class="col-sm-10">
        <select name="TECH_REPAIR_ID" id="TECH_REPAIR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกช่าง--</option>
             @foreach ($informrepair_techs as $informrepairtech)                                                     
            <option value="{{$informrepairtech->PERSON_ID}}">{{ $informrepairtech->HR_FNAME}} {{ $informrepairtech->HR_LNAME}}</option>
            @endforeach 
             </select>   
     
        </div> 
        </div> 

        <div class="row push">
        <div class="col-sm-2">
        <label>ความเร่งด่วน :</label>
        </div> 
        <div class="col-lg-10">
        <select name="PRIORITY_ID" id="PRIORITY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <option value="1">ปกติ</option>
            <option value="2">ด่วน</option>
            <option value="3">ด่วนมาก</option>
            <option value="4">ด่วนที่สุด</option>
             </select>    
        </div> 
       
        </div> 
        </div>
       
              
        </div>
      
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('general_repair/genrepairtype/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
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



function check(asset){
    
             var _token=$('input[name="_token"]').val();
           

             $.ajax({
                     url:"{{route('dropdown.repairnomalasset')}}",
                     method:"GET",
                     data:{asset:asset,_token:_token},
                     success:function(result){
                        $('.assetinput').html(result);
                     }
             })
         
         
             }        
 


$('.location').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.repairnomal')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.locationlevel').html(result);
                     }
             })
            // console.log(select);
             }        
     });

     $('.locationlevel').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.repairnomalsub')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.locationlevelroom').html(result);
                     }
             })
            // console.log(select);
             }        
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
</script>


  
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
@endsection