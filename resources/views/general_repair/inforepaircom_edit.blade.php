@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />


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

            datalist {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }

      
</style>



                    <!-- Advanced Tables -->
                    <div class="bg-body-light">
                    <div class="content">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">แก้ไขข้อมูลแจ้งซ่อมคอมพิวเตอร์</h2> 
                        
        <form  method="post" action="{{ route('repair.updateinforepaircom') }}" enctype="multipart/form-data">
        @csrf

        <input  type="hidden" name="ID" class="form-control input-lg" value="{{$idlist}}"  >

        <div class="row push">
            <div class="col-sm-2">
            <label>รหัสแจ้งซ่อม :</label>
            </div> 
            <div class="col-lg-5">
            <input name="" id="" class="form-control input-sm"  value="{{$informcomrepair->REPAIR_ID}}"  readonly>
           
            </div> 
            </div> 
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
        <div class="col-lg-4">
        <input name="REPAIR_NAME" id="REPAIR_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$informcomrepair->REPAIR_NAME}}" onkeyup="repairname();">
        <div style="color: red;font-size: 14px;" id="repair_name"></div>
    </div> 



    <div class="col-sm-2">
        <label>ระบบที่ต้องการแจ้งซ่อม :</label>
    </div> 
        <div class="col-lg-4">
       
            <select name="REPAIR_SYSTEM" id="REPAIR_SYSTEM" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                <option value="">--ไม่ระบุ--</option>
                 @foreach ($infotypesystems as $infotypesystem)                                                     
                    @if($infotypesystem->INFORMCOM_ST_ID == $informcomrepair->REPAIR_SYSTEM )
                     <option value="{{$infotypesystem->INFORMCOM_ST_ID}}" selected>{{ $infotypesystem->INFORMCOM_ST_NAME}}</option>
                    @else
                    <option value="{{$infotypesystem->INFORMCOM_ST_ID}}">{{ $infotypesystem->INFORMCOM_ST_NAME}}</option>
                    @endif
                @endforeach 
                 </select>   
      
    
    </div> 
    
   
        </div> 
        
     

    
        <div class="row push">
        <div class="col-sm-2">
        <label>สถานที่พบ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="LOCATION_SEE_ID" id="LOCATION_SEE_ID" class="form-control input-lg location" style=" font-family: 'Kanit', sans-serif;"  onchange="locationsee();" >
            <option value="">--กรุณาเลือกสถานที่--</option>
             @foreach ($infolocations as $infolocation)   
                @if($infolocation->LOCATION_ID == $informcomrepair->LOCATION_SEE_ID)
                <option value="{{$infolocation->LOCATION_ID}}" selected>{{ $infolocation->LOCATION_NAME}}</option>
                @else
                <option value="{{$infolocation->LOCATION_ID}}">{{ $infolocation->LOCATION_NAME}}</option>
                @endif                                                  
          
            @endforeach 
             </select>  
             <div style="color: red;font-size: 14px;" id="location_see"></div>  
        </div> 
        <div class="col-sm-1">
        <label>ชั้น :</label>
        </div> 
        <div class="col-lg-2">
                    <select name="LOCATIONLEVEL_SEE_ID" id="LOCATIONLEVEL_SEE_ID" class="form-control input-lg locationlevel" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกชั้น--</option>
                    @if($infolocationlevels !='')
                    @foreach ($infolocationlevels as $infolocationlevel)   
                        @if($infolocationlevel->LOCATION_LEVEL_ID == $informcomrepair->LOCATIONLEVEL_SEE_ID)
                        <option value="{{$infolocationlevel->LOCATION_LEVEL_ID}}" selected>{{ $infolocationlevel->LOCATION_LEVEL_NAME}}</option>
                        @else
                        <option value="{{$infolocationlevel->LOCATION_LEVEL_ID}}">{{ $infolocationlevel->LOCATION_LEVEL_NAME}}</option>
                        @endif                                                  
          
                    @endforeach 
                    @endif
                    </select>    
        </div> 
        <div class="col-sm-1">
        <label>ห้อง :</label>
        </div> 
        <div class="col-lg-2">
                    <select name="LOCATIONLEVELROOM_SEE_ID" id="LOCATIONLEVELROOM_SEE_ID" class="form-control input-lg locationlevelroom" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="">--กรุณาเลือกห้อง--</option>
                    @if($infolocationlevelrooms !='')
                    @foreach ($infolocationlevelrooms as $infolocationlevelroom)   
                        @if($infolocationlevelroom->LEVEL_ROOM_ID == $informcomrepair->LOCATIONLEVELROOM_SEE_ID)
                        <option value="{{$infolocationlevelroom->LEVEL_ROOM_ID}}" selected>{{ $infolocationlevelroom->LEVEL_ROOM_NAME}}</option>
                        @else
                        <option value="{{$infolocationlevelroom->LEVEL_ROOM_ID}}">{{ $infolocationlevelroom->LEVEL_ROOM_NAME}}</option>
                        @endif                                                  
          
                    @endforeach 
                  @endif
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
       
       @if($informcomrepair->ARTICLE_ID !== '')
     
        <div class="col-sm-2">
        <label>ครุภัณฑ์ทะเบียน :</label>
        </div> 
        <div class="col-lg-10">

        {{-- <input list="article_num" name="ARTICLE_ID" id="ARTICLE_ID" value="{{ $informcomrepair->ARTICLE_ID}} >> {{ $informcomrepair->ARTICLE_NUM}} :: {{ $informcomrepair->ARTICLE_NAME}}" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
            <datalist id="article_num">
                <option value="">--กรุณาเลือกครุภัณฑ์--</option>
                @foreach ($infoassets as $infoasset)   
                      
                        <option value="{{ $infoasset->ARTICLE_ID}}>>{{ $infoasset->ARTICLE_NUM}} :: {{ $infoasset->ARTICLE_NAME}}" ></option>
                     
                @endforeach 
            </datalist> --}}

            <select name="ARTICLE_ID" id="ARTICLE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                    <option value="">--กรุณาเลือกครุภัณฑ์--</option>
                @foreach ($infoassets as $infoasset)
                    @if($infoasset->ARTICLE_ID == $informcomrepair->ARTICLE_ID)
                    <option value="{{ $infoasset->ARTICLE_ID}}" selected>{{ $infoasset->ARTICLE_NUM}} :: {{ $infoasset->ARTICLE_NAME}}</option>      
                    @else
                    <option value="{{ $infoasset->ARTICLE_ID}}">{{ $infoasset->ARTICLE_NUM}} :: {{ $infoasset->ARTICLE_NAME}}</option>      
                    @endif
                   
                @endforeach
            </select>


     
        </div> 
    
        <input type="hidden" value="" name="OTHER_NAME" class="form-control input-lg" >
      
        @else

        <div class="col-sm-2">
        <label>รายการอื่น :</label>
        </div> 
        <div class="col-lg-4">
        <select name="OTHER_NAME" id="OTHER_NAME" class="form-control input-lg other_re" style=" font-family: \'Kanit\', sans-serif;" >
        <option value="">--กรุณาเลือกรายการ--</option>';
       
        @foreach ($infoassetothers as $infoassetother)
                @if($infoassetother->OTHER_NAME == $informcomrepair->OTHER_NAME)      
                    <option value="{{$infoassetother->OTHER_NAME}}" selected>{{$infoassetother->OTHER_NAME}}</option>';
                @else
                    <option value="{{$infoassetother->OTHER_NAME}}">{{$infoassetother->OTHER_NAME}}</option>';
                 @endif
            @endforeach 
        </select>   
         </div>
         <div class="col-sm-4">
         <input name="ADD_OTHER_NAME" id="ADD_OTHER_NAME" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif; background-color: #CCFFFF;" placeholder="ระบุรายการหากต้องการเพิ่ม">
         </div> 
         <div class="col-lg-1">
         <a class="btn btn-hero-sm btn-hero-info" style="font-family: \'Kanit\', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;color:#FFFFFF;" onclick="addother();"><i class="fas fa-plus"></i> เพิ่ม</a>
         </div> 
         <input type="hidden" value="" name="ARTICLE_ID" class="form-control input-lg" >
         </div>


        @endif

        </div> 
  
        <div class="row push">
        <div class="col-sm-6">

                                        <div class="form-group">
                                        <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($informcomrepair->COM_IMG)) }}"  id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="200" width="200"/>
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
                <textarea  name="SYMPTOM" id="SYMPTOM" class="form-control input-sm" onkeyup="symptom();"  rows="4" required>{{$informcomrepair->SYMPTOM}}</textarea>
                <div style="color: red;font-size: 14px;" id="symptom_a"></div>  
        </div>   
        </div>


        <div class="row push">
        <div class="col-sm-2">
        <label>ระบุช่าง :</label>
        </div> 
        <div class="col-sm-10">
        <select name="TECH_REPAIR_ID" id="TECH_REPAIR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onchange="techrepair();">
            <option value="">--กรุณาเลือกช่าง--</option>
            <option value="not">--ไม่ระบุ--</option>
             @foreach ($informrepair_techs as $informrepairtech) 
                        @if($informrepairtech->PERSON_ID == $informcomrepair->TECH_REPAIR_ID)
                        <option value="{{$informrepairtech->PERSON_ID}}" selected>{{ $informrepairtech->HR_FNAME}} {{ $informrepairtech->HR_LNAME}}</option>
                        @else
                        <option value="{{$informrepairtech->PERSON_ID}}">{{ $informrepairtech->HR_FNAME}} {{ $informrepairtech->HR_LNAME}}</option>
                        @endif                                                    
           
            @endforeach 
             </select>   
             <div style="color: red;font-size: 14px;" id="tech_repair"></div>  
     
        </div> 
        </div> 

        <div class="row push">
        <div class="col-sm-2">
        <label>ความเร่งด่วน :</label>
        </div> 
        <div class="col-lg-10">
        <select name="PRIORITY_ID" id="PRIORITY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" onclick="prioruty();">
        @if($informcomrepair->PRIORITY_ID == 1)
            <option value="1" selected>ปกติ</option>
        @else
            <option value="1">ปกติ</option>
        @endif  

        @if($informcomrepair->PRIORITY_ID == 2)
            <option value="2" selected>ด่วน</option>
        @else
            <option value="2">ด่วน</option>
        @endif  

        @if($informcomrepair->PRIORITY_ID == 3)
            <option value="3" selected>ด่วนมาก</option>
        @else
            <option value="3">ด่วนมาก</option>
        @endif  

        @if($informcomrepair->PRIORITY_ID == 4)
            <option value="4" selected>ด่วนที่สุด</option>
        @else
            <option value="4">ด่วนที่สุด</option>
        @endif  
     
             </select> 
             <div style="color: red;font-size: 14px;" id="prioruty_id"></div>     
        </div> 
       
        </div> 
        </div>
       
              
        </div>
      
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกแก้ไขข้อมูล</button>
        <a href="{{ url('general_repair/genrepaircom/'.$inforpersonuserid -> ID)  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
               
                      

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script> 

$(document).ready(function() {
    $('select').select2();
});

function check(asset){
    
             var _token=$('input[name="_token"]').val();
           

             $.ajax({
                     url:"{{route('dropdown.repairnomalasset')}}",
                     method:"GET",
                     data:{asset:asset,_token:_token},
                     success:function(result){
                        $('.assetinput').html(result);
                        $('select').select2();
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


                //===============================เพิ่มหน่วยงาน====================================
                        function addother(){
                            
                            var other_re=document.getElementById("ADD_OTHER_NAME").value;
                            
                            //alert(record_location);
                            
                                var _token=$('input[name="_token"]').val();
                                $.ajax({
                                        url:"{{route('repair.addother')}}",
                                        method:"GET",
                                        data:{other_re:other_re,_token:_token},
                                        success:function(result){
                                            $('.other_re').html(result);
                                        }
                                })

                        }


         //-----------------------Start------------------------------------------
        function repairname()
        {        
               repair_name = document.getElementById("REPAIR_NAME").value;             
                if (repair_name==null || repair_name==''){
                document.getElementById("repair_name").style.display = "";     
                text_repair_name = "*กรุณาระบุแจ้งซ่อม";
                document.getElementById("repair_name").innerHTML = text_repair_name;
                }else{
                document.getElementById("repair_name").style.display = "none";
                }
        }      

        function locationsee()
        {        
               location_see = document.getElementById("LOCATION_SEE_ID").value;             
                if (location_see==null || location_see==''){
                document.getElementById("location_see").style.display = "";     
                text_location_see = "*กรุณาระบุสถานที่";
                document.getElementById("location_see").innerHTML = text_location_see;
                }else{
                document.getElementById("location_see").style.display = "none";
                }
        }      

        function symptom()
        {        
                symptom_name = document.getElementById("SYMPTOM").value;             
                if (symptom_name==null || symptom_name==''){
                document.getElementById("symptom_a").style.display = "";     
                text_symptom_name = "*กรุณาระบุอาการ";
                document.getElementById("symptom_a").innerHTML = text_symptom_name;
                }else{
                document.getElementById("symptom_a").style.display = "none";
                }
        }      

        function techrepair()
        {        
               tech_repair = document.getElementById("TECH_REPAIR_ID").value;             
                if (tech_repair==null || tech_repair==''){
                document.getElementById("tech_repair").style.display = "";     
                text_tech_repair= "*กรุณาระบุช่าง";
                document.getElementById("tech_repair").innerHTML = text_tech_repair;
                }else{
                document.getElementById("tech_repair").style.display = "none";
                }
        }      

     
  
</script>

<script>
 $('form').submit(function () {

         var repair_name,text_repair_name; 
         var location_see,text_location_see; 
         var symptom_name,text_symptom_name; 
         var tech_repair,text_tech_repair; 
         

        //--------------------------------------------------------

                repair_name = document.getElementById("REPAIR_NAME").value;
                if (repair_name==null || repair_name==''){
                document.getElementById("repair_name").style.display = "";     
                text_repair_name = "*กรุณาระบุแจ้งซ่อม";
                document.getElementById("repair_name").innerHTML = text_repair_name;
                }else{
                document.getElementById("repair_name").style.display = "none";
                }

                location_see = document.getElementById("LOCATION_SEE_ID").value;             
                if (location_see==null || location_see==''){
                document.getElementById("location_see").style.display = "";     
                text_location_see = "*กรุณาระบุสถานที่";
                document.getElementById("location_see").innerHTML = text_location_see;
                }else{
                document.getElementById("location_see").style.display = "none";
                }

                symptom_name = document.getElementById("SYMPTOM").value;             
                if (symptom_name==null || symptom_name==''){
                document.getElementById("symptom_a").style.display = "";     
                text_symptom_name = "*กรุณาระบุอาการ";
                document.getElementById("symptom_a").innerHTML = text_symptom_name;
                }else{
                document.getElementById("symptom_a").style.display = "none";
                }

                      
               tech_repair = document.getElementById("TECH_REPAIR_ID").value;             
                if (tech_repair==null || tech_repair==''){
                document.getElementById("tech_repair").style.display = "";     
                text_tech_repair= "*กรุณาระบุช่าง";
                document.getElementById("tech_repair").innerHTML = text_tech_repair;
                }else{
                document.getElementById("tech_repair").style.display = "none";
                }


        if(repair_name==null || repair_name==''|| 
        location_see==null || location_see==''||
        symptom_name==null || symptom_name==''||
        tech_repair==null || tech_repair=='' )

{
  alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");      
  return false;   
}


});
</script>

@endsection