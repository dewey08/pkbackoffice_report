@extends('layouts.food')
   
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
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
      font-size: 13px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
           
      } 

      .form-control {
            font-family: 'Kanit', sans-serif;
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
<br>
<br>
<br>
<center>
<div class="block" style="width: 95%;" >
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>

                         
                             แก้ไขข้อมูลวัสดุบริโภค
                        


</B></h3>

</div>
<div class="block-content block-content-full" align="left">

          
        <form  method="post" action="{{ route('mfood.infofood_update') }}" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="ID" id="ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->ID}}" >
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
        <label style="text-align: left">
        
                            กำหนดเลขวัสดุ :
                          
        
        </label>
        </div> 
   
        <div class="col-lg-7 detali_fsn">
        <input name="SUP_FSN_NUM" id="SUP_FSN_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->SUP_FSN_NUM}}" readonly>
        </div> 
      

        <div class="col-lg-3">
      
        </div> 
        </div>
        <br>
        
       <div class="row push">
        <div class="col-lg-2">
        <label>               
                            รายการวัสดุ :
        </label>
        </div> 
        <div class="col-lg-3">
                 วัสดุสิ้นเปลือง
               
         <input type="hidden" name="SUP_TYPE_KIND_ID" id="SUP_TYPE_KIND_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="1" >
        </div> 
        <div class="col-lg-1">
        <label>
        
                      
                            วัสดุ :
                        
        
        
        </label>
        </div> 
        <div class="col-lg-6">
        <input name="SUP_NAME" id="SUP_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->SUP_NAME}}">
        </div>
       </div>
       <div class="row push">
       <div class="col-lg-2">
        <label>คุณลักษณะ :</label>
        </div> 
       
        <div class="col-lg-10">
 
        <input name="SUP_PROP" id="SUP_PROP" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->SUP_PROP}}">
        </div> 
       </div>
       
       <div class="row push">
        <div class="col-lg-2">
        <label>รายละเอียด :</label>
        </div> 
        <div class="col-lg-10">
        <input name="CONTENT" id="CONTENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->CONTENT}}">
        </div> 
       </div>
    
       <div class="row push">
       <div class="col-lg-2">
        <label>ราคาสืบ :</label>
        </div> 
        <div class="col-lg-4">
        <select name="CONTINUE_PRICE_ID" id="CONTINUE_PRICE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
            
            <option value="">--กรุณาเลือกราคาสืบ--</option>
             @if($infosupdetail->CONTINUE_PRICE_ID == '1')<option value="1" selected>ราคาสืบจังหวัด</option>@else<option value="1">ราคาสืบจังหวัด</option>@endif
             @if($infosupdetail->CONTINUE_PRICE_ID  == '2')<option value="2" selected>ราคาสืบเขต</option>@else<option value="2">ราคาสืบเขต</option>@endif
             @if($infosupdetail->CONTINUE_PRICE_ID  == '3')<option value="3" selected>ราคาจัดซื้อเอง</option>@else<option value="3">ราคาจัดซื้อเอง</option>@endif
           
        
        </select>   
        </div>
        <div class="col-lg-2">
        <label>เลข EGP :</label>
        </div> 
        <div class="col-lg-4">
        <input name="EGP_NUMBER" id="EGP_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->TPU_NUMBER}}" > 
        </div>
        </div>

   
       

       <div class="row push">
        <div class="col-lg-2">
        <label>หมวดพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
                วัสดุบริโภค
                <input type="hidden" name="SUP_TYPE_ID" id="SUP_TYPE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="18" >
        </div> 
        <div class="col-lg-2">
        <label>ประเภทพัสดุ :</label>
        </div> 
        <div class="col-lg-4">
                <select name="SUP_TYPE_MASTER_ID" id="SUP_TYPE_MASTER_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    
                    @if($infosupdetail->SUP_TYPE_MASTER_ID == '6')<option value="6" selected>อาหารสด</option>@else<option value="6">อาหารสด</option>@endif
                    @if($infosupdetail->SUP_TYPE_MASTER_ID == '1')<option value="1" selected>วัสดุ</option>@else<option value="1">วัสดุ</option>@endif

                </select>   

        </div>
       </div>

   

       <div class="row push">
       
        <div class="col-lg-2">
        <label>จำนวนต่ำสุด :</label>
        </div> 
        <div class="col-lg-4">
        <input name="MIN" id="MIN" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->MIN}}">
        </div>
        <div class="col-lg-2">
        <label>จำนวนสูงสุด :</label>
        </div> 
        <div class="col-lg-4">
        <input name="MAX" id="MAX" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infosupdetail->MAX}}">
        </div>
       </div>

   
       <div class="medicine"> </div>  

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
                                                <td style="text-align: center;  border: 1px solid black;">รายละเอียด</td>
                                                <td style="text-align: center;  border: 1px solid black;">หน่วยนับ</td>
                                                <td style="text-align: center;  border: 1px solid black;" width="20%">จำนวน</td>
                    
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                 
                                    <tr>
                                        <td > 
                                         หน่วยย่อย

                                            @if($infounitref1 == 'null')
                                            <input type="hidden" name="checkid1" id="checkid1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="null" >
                                            @else
                                            <input type="hidden" name="checkid1" id="checkid1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="{{$infounitref1->ID}}" >
                                            @endif

                                        </td>
                                        <td> 
                                        <select name="SUP_UNIT_ID0" id="SUP_UNIT_ID0" class="form-control input-lg js-example-basic-single {{ $errors->has('SUP_UNIT_ID0') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;">
            
                                                <option value="">--กรุณาเลือกหน่วย--</option>
                                                @foreach ($suppliesunits as $suppliesunit)
                                                   
                                                    @if($infounitref1 == 'null')
                                                        <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                    @else
                                                        @if($infounitref1->SUP_UNIT_ID == $suppliesunit ->SUP_UNIT_ID)
                                                        <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}" selected>{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                        @else
                                                        <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach 
                                            
                                            </select>  
                                        </td>
                                        <td>
                                        <input name="SUP_TOTAL0" id="SUP_TOTAL0" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="1" readonly>
                                        </td>
            
                                    
        
                                    </tr>


                                    <tr>
                                        <td>
                                         หน่วยบรรจุ

                                            @if($infounitref2 == 'null')
                                            <input type="hidden" name="checkid2" id="checkid2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="null" >
                                            @else
                                            <input type="hidden" name="checkid2" id="checkid2" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center;" value="{{$infounitref2->ID}}" >
                                            @endif

                                        </td>
                                        <td> 
                                        <select name="SUP_UNIT_ID1" id="SUP_UNIT_ID1" class="form-control input-lg js-example-basic-single" style=" font-family: 'Kanit', sans-serif;">
                                               

                                                <option value="">--กรุณาเลือกหน่วย--</option>
                                                @foreach ($suppliesunits as $suppliesunit)
                                                
                                                        @if($infounitref2 == 'null')
                                                            <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                        @else
                                                            @if($infounitref2->SUP_UNIT_ID == $suppliesunit ->SUP_UNIT_ID)    
                                                            <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}" selected>{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                             @else
                                                            <option value="{{ $suppliesunit ->SUP_UNIT_ID  }}">{{ $suppliesunit->SUP_UNIT_NAME}}</option>
                                                            @endif
                                                        @endif

                                                @endforeach 
                                            
                                            </select>  
                                        </td>
                                        <td>
                                        @if($infounitref2 == 'null')
                                        <input name="SUP_TOTAL1" id="SUP_TOTAL1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center; "  >
                                         @else
                                        <input name="SUP_TOTAL1" id="SUP_TOTAL1" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;text-align: center; " value="{{$infounitref2 ->SUP_TOTAL}}" >
                                        @endif
                                        </td>
                                  
                                    
                                       
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
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึกแก้ไขข้อมูล</button>
        <a href="{{ url('manager_food/infofood')  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" >ยกเลิก</a>
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


$('.type_sub').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('dropdown.parcel')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.number_parcel').html(result);
                     }
             })
            // console.log(select);
             }        
     });




function selectfsn(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('msupplies.selectfsn')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_fsn').html(result);
                   }
           })

           $('#modalfsn').modal('hide');

  }





        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });

</script> 
    

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
                    '<input name="SUP_UNIT_NAME[]" id="SUP_UNIT_NAME[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+
                    '</td>'+
                    '<td>'+
                    '<input name="SUP_TOTAL[]" id="SUP_TOTAL[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+
                    '</td>'+
                    '<td>'+
                    '<input name="SUP_PRICE[]" id="SUP_PRICE[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;font-size: 13px;" >'+
                    '</td>'+
                
                    '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                    '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });

     //-------------------------------------------------


     $('form').submit(function () {


            var select= document.getElementById("SUP_FSN_NUM").value; 
             var _token=$('input[name="_token"]').val();
         
             $.ajax({
                     url:"{{route('check.checkfsn')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        //alert(result);
                        //if (result > 0){
                        
                            //alert("เลข "+select+" ถูกกำหนดไปแล้วรายการจะไม่ถูกเพิ่ม");      
                            
                            }
                     }
             })     
        
            
           
});

  
</script>
