@extends('layouts.medical')
    
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
</style>
<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>

    เพิ่มข้อมูลยาและเวชภัณฑ์                  


</B></h3>

</div>
<div class="block-content block-content-full" align="left">

          
        <form  method="post" action="" enctype="multipart/form-data">
        @csrf
      
    <div class="row push">

       <div class="col-lg-4">
                                        <div class="form-group">
                                        <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                                        <img id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="300px"/>
                                        </div>
                                        <div class="form-group">
                                        *ขนาดรูปไม่เกิน 350 x 350 pixel
                                        <input type="file" name="picture" id="picture" class="form-control">
                                        </div>
                                       
                                       
                                        
        </div>

        <div class="col-sm-8">
        <div class="row">
        <div class="col-lg-2">
        <label style="text-align: left">กำหนดเลขพัสดุ :</label>
        </div> 
        <div class="col-lg-7">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
  
        </div>
        <br>
        
       <div class="row push">
        <div class="col-lg-2">
        <label>รายการพัสดุ :</label>
        </div> 
        <div class="col-lg-3">
        <select name="" id="" class="form-control input-lg typekind_sub" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกรายการพัสดุ--</option>
             @foreach ($suppliestypekinds as $suppliestypekind)

             <option value="{{ $suppliestypekind ->SUP_TYPE_KIND_ID  }}">{{ $suppliestypekind->SUP_TYPE_KIND_NAME}}</option>

            @endforeach 
        </select>    
        </div> 
        <div class="col-lg-1">
        <label>พัสดุ :</label>
        </div> 
        <div class="col-lg-6">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>ลักษณะ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>หมวดพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="" id="" class="form-control input-lg type_sub" style=" font-family: 'Kanit', sans-serif;">
            
            <option value="">--กรุณาเลือกหมวดพัสดุ--</option>
             @foreach ($suppliestypes as $suppliestype)

             <option value="{{ $suppliestype ->SUP_TYPE_ID  }}">{{ $suppliestype->SUP_TYPE_NAME}}</option>

           
            @endforeach 
        </select>   
        </div> 
        <div class="col-lg-2">
        <label>ประเภทพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="" id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
            <option value="">--กรุณาเลือกประเภทพัสดุ--</option>
             @foreach ($suppliestypemasters as $suppliestypemaster)

             <option value="{{ $suppliestypemaster ->SUP_TYPE_MASTER_ID  }}">{{ $suppliestypemaster->SUP_TYPE_MASTER_NAME}}</option>

            @endforeach 
        </select>   
        </div>
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-10">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>ราคาต่อหน่วย :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-2">
        <label>จำนวนต่ำสุด :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
        <div class="col-lg-2">
        <label>จำนวนสูงสุด :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div>
       </div>


       <div class="row push">
        <div class="col-lg-2">
        <label>หน่วยนับ :</label>
        </div> 
        <div class="col-lg-2">
        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
        <div class="col-lg-8 checktypesub">
          
        </div>
       
       </div>
                <div class="row push">
                    ------------------------------------------------------
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>รหัสยา :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ชื่อยาสามัญ :</label>
                        </div> 
                        <div class="col-lg-5">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                        <div class="col-lg-1">
       
                        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addfsn"  >...</button>

                        </div> 

                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>รูปแบบยา :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>หน่วยจำหน่าย :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>
                    <div class="row push">
                        <div class="col-lg-2">
                        <label>กลุ่มยา :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>VEN gr. :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>กรรมการยา :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>กลุ่มบัญชี :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
             
                    
                    </div>
                    <div class="row push">
                    <div class="col-lg-2">
                        <label>กลุ่มบัญชีย่อย :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                        <div class="col-lg-2">
                        <label>บัญชียา รพ. :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                       
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>รหัสยา :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ชื่อทางการค้า. :</label>
                        </div> 
                        <div class="col-lg-5">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                        <div class="col-lg-1">
       
                        <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addfsn"  >...</button>

                        </div> 
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>ชื่อยาสามัญ :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ชื่อผู้ผลิต :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>
                    <div class="row push">
                    <div class="col-lg-2">
                        <label>ประเภท :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                        
                       
                    
                    </div>

                    <div class="row push">
                    ------------------------------------------------------
                    </div>
                    <div class="row push">
                        <div class="col-lg-2">
                        <label>ICODE :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>รายการยา :</label>
                        </div> 
                        <div class="col-lg-6">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>

                                                        
                    <div class="row push">
                        <div class="col-lg-2">
                        <label>STRENGTH :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ยูนิตย่อย :</label>
                        </div> 
                        <div class="col-lg-6">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>
                    <div class="row push">
                        <div class="col-lg-2">
                        <label>DOSAGEFORM :</label>
                        </div> 
                        <div class="col-lg-7">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-1">
                        <label>ราคา :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>
                    <div class="row push">
                        <div class="col-lg-2">
                        <label>ราคากลาง :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ราคาอ้างอิง :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>DID :</label>
                        </div> 
                        <div class="col-lg-3">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>การใช้ต่อเดือน :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                        <div class="col-lg-1">
                        <label>มูลค่า :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>TMT :</label>
                        </div> 
                        <div class="col-lg-3">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>การใช้ต่อปี :</label>
                        </div> 
                        <div class="col-lg-2">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                     
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>กลุ่มยา :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ประเภทยา :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                     
                    
                    </div>

                    <div class="row push">
                        <div class="col-lg-2">
                        <label>ประเภทจัดซื้อ :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div> 
                        <div class="col-lg-2">
                        <label>ED/NED :</label>
                        </div> 
                        <div class="col-lg-4">
                        <input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >
                        </div>
                     
                    
                    </div>

       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">หน่วยนับ</a>
                                    </li>
                                 


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">หน่วยนับ</td>
                                                <td style="text-align: center;" width="20%">จำนวน</td>
                                                <td style="text-align: center;" width="20%">ราคา</td>
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-success fa fa-plus addRow" style="color:#FFFFFF;"></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                     
                                    <tr>
                                        <td> 
                                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td>
                                        <input name="" id="" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
                                        </td>
                                        <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                                    </tr>
                                  
                            
                                    </tbody>   
                                    </table>

                                    </div>
                                    </div>
                                </div>
                                </div>
      
</div>
</div>
</div>




        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('manager_medical/suppliesinfo')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

       
        </div>
        </form>  


       
       
               

               <!--    เมนูเลือก   -->
       
        <div class="modal fade addfsn" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalbook">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ออกเลข FSN</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style="text-align: center;" width="20%">เลข FSN</td>
                                    <td style="text-align: center;">ชื่อพัสดุ</th>
                                
                                    <td style="text-align: center;" width="5%">เลือก</td>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                            
                                    <tr>
                                        <td ></td>
                                        <td ></td>
                                                                
                                        <td >
                                             <button type="button" class="btn btn-hero-sm btn-hero-info"    onclick="">เลือก</button> 
                                           
                                        </td>
                                    </tr>
                           
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
            </div>
          </div>
        </div>
               
                      

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

    
    

<script>
  
  $('.typekind_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchsubtype')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.type_sub').html(result);
                     }
             })
            // console.log(select);

            $.ajax({
                     url:"{{route('msupplies.checkfetchsubtype')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.checktypesub').html(result);
                     }
             })



             }        
     });

//-------------------------------------------------------------------------

  $('.type_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('msupplies.fetchmedicine')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.medicine').html(result);
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


//-------------------------------------------------------

$('.addRow').on('click',function(){
         addRow();
     });

     function addRow(){
        var count = $('.tbody1').children('tr').length;
         var tr =   '<tr>'+
                    '<td>'+ 
                    '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '</td>'+
                    '<td>'+
                    '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '</td>'+
                    '<td>'+
                    '<input name="" id="" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '</td>'+
                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                    '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });

     //-------------------------------------------------

  
</script>


@endsection