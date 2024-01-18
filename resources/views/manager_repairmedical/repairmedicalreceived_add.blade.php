@extends('layouts.repairmedical')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



@section('content')


<?php
$status = Auth::user()->status; 
$id_user = Auth::user()->PERSON_ID; 
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 

?>
<?php
  function formateDatetime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $H= date("H",strtotime($strDate));
    $I= date("i",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];

  return  "$strDay $strMonthThai $strYear $H:$I";
    }
  
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
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รับเรื่องรอซ่อม</B></h3>

</div>
<div class="block-content block-content-full" align="left"> 

          
        <form  method="post" id="form_add" action="{{ route('mrepairmedical.updateinfomedicalreceived') }}" enctype="multipart/form-data">
        @csrf
      
    <div class="row">
    <input type="hidden" class="form-control" id="ID" name="ID" style=" font-family: 'Kanit', sans-serif;" value="{{$inforepairmedical->ID}}">
    <div class="col-lg-6">
    <div class="row push">
        <div class="col-lg-2">
        <label>เลขที่ส่ง :</label>
        </div> 
        <div class="col-lg-4">
         {{$inforepairmedical->REPAIR_ID}}
        </div>
        <div class="col-lg-2">
        <label>วันที่เวลาแจ้ง :</label>
        </div> 
        <div class="col-lg-4">
        {{ formateDatetime($inforepairmedical->DATE_TIME_REQUEST) }}
        </div>  
  
       </div>

    <div class="row">      
        <div class="col-lg-2">
        <label>อาคาร :</label>
        </div> 
        <div class="col-lg-4">{{$inforepairmedical->BUILD_NAME}}        
        </div>
       </div>

       
    <div class="row">      
      <div class="col-lg-2">
      <label>ชั้น :</label>
      </div> 
      <div class="col-lg-4">  {{$inforepairmedical->LOCATION_LEVEL_NAME}}
      </div>
      <div class="col-lg-2">
        <label>ห้อง :</label>
        </div> 
        <div class="col-lg-4">  {{$inforepairmedical->LEVEL_ROOM_NAME}}
      </div>
     </div>

     <div class="row">
      
      <div class="col-lg-2">
      <label>แจ้งซ่อม :</label>
      </div> 
      <div class="col-lg-10">
      {{$inforepairmedical->REPAIR_NAME}}
      </div>
     
     </div>

     <div class="row">
      
      <div class="col-lg-2">
      <label>รหัสครุภัณฑ์ :</label>
      </div> 
      <div class="col-lg-4">
      {{$inforepairmedical->ARTICLE_NUM}}
      </div>
      <div class="col-lg-2">
        <label>ชื่อครุภัณฑ์ :</label>
        </div> 
        <div class="col-lg-4">
            {{$inforepairmedical->ARTICLE_NAME}}
      </div>
     </div>
     
     <div class="row">
      
      <div class="col-lg-2">
      <label>อาการ :</label>
      </div> 
      <div class="col-lg-10">
      {{$inforepairmedical->SYMPTOM}}
      </div>
     
     </div>    

         <div class="row">
      
      <div class="col-lg-2">
      <label>ความเร่งด่วน :</label>
      </div> 
      <div class="col-lg-10">
      {{$inforepairmedical->PRIORITY_NAME}}
      </div>
     
     </div>    

       <div class="row">
      
      <div class="col-lg-2">
      <label>ผู้แจ้งซ่อม :</label>
      </div> 
      <div class="col-lg-4">
      {{$inforepairmedical->USRE_REQUEST_NAME}}
      </div>
     
     </div>               


     <div class="row">
      
      <div class="col-lg-2">
      <label>ฝ่าย/แผนก  :</label>
      </div> 
      <div class="col-lg-4">
      {{$inforepairmedical->HR_DEPARTMENT_SUB_SUB_NAME}}
      </div>
     
     </div>   

     <div class="form-group">
    
    <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforepairmedical->MED_IMG)) }}" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="200" width="200"/>
    </div>
                                       
                
                                        
        </div>

        <div class="col-sm-6">
       <div class="row push">
        <div class="col-lg-2">
        <label>วันที่รับ :</label>
        </div> 
        <div class="col-lg-4">
        <input name="TECH_RECEIVE_DATE" id="TECH_RECEIVE_DATE" class="form-control input-sm datepicker" style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
        </div> 
        <div class="col-lg-2">
        <label>เวลา :</label>
        </div> 
        <div class="col-lg-4">
        <input name="TECH_RECEIVE_TIME" id="TECH_RECEIVE_TIME" class=" js-masked-time form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{date('H:i')}}">
        </div>
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>ผู้รับเรื่อง :</label>
        </div> 
        <div class="col-lg-10">
        {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
        <input type="hidden" name="TECH_RECEIVE_ID" id="TECH_RECEIVE_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{$id_user}}">
        </div>
        </div>

        <div class="row push">
        <div class="col-lg-2">
        <label>ช่างหลัก :</label>
        </div> 
        <div class="col-lg-10">
        <select name="TECH_REPAIR_ID" id="TECH_REPAIR_ID" class="form-control input-lg {{ $errors->has('TECH_REPAIR_ID') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" >
            <option value="">--กรุณาเลือกช่าง--</option>
             @foreach ($infotechs as $infotech)                                                     
            <option value="{{$infotech->PERSON_ID}}">{{ $infotech->HR_FNAME}} {{ $infotech->HR_LNAME}}</option>
            @endforeach 
             </select>   
        </div> 
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>หมายเหตุ :</label>
        </div> 
        <div class="col-lg-10">
        <input name="TECH_RECEIVE_COMMENT" id="TECH_RECEIVE_COMMENT" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
        </div> 
     
       </div>

         <div class="row push">
        <div class="col-lg-2">
        <label>วันที่ซ่อม :</label>
        </div> 
        <div class="col-lg-4">
        <input name="TECH_REPAIR_DATE" id="TECH_REPAIR_DATE" class="form-control input-sm datepicker {{ $errors->has('TECH_REPAIR_DATE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" readonly>
        </div> 
        <div class="col-lg-2">
        <label>เวลา :</label>
        </div> 
        <div class="col-lg-4">
        <input type="text" class="js-masked-time form-control" id="TECH_REPAIR_TIME" name="TECH_REPAIR_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00">
        </div>
       </div>

       <div class="row push">
        <div class="col-lg-2">
        <label>ถึงวันที่:</label>
        </div> 
        <div class="col-lg-4">
        <input name="TECH_SUCCESS_DATE" id="TECH_SUCCESS_DATE" class="form-control input-sm datepicker {{ $errors->has('TECH_SUCCESS_DATE') ? 'is-invalid' : '' }}" style=" font-family: 'Kanit', sans-serif;" readonly>
        </div> 
        <div class="col-lg-2">
        <label>เวลา :</label>
        </div> 
        <div class="col-lg-4">
        <input type="text" class="js-masked-time form-control" id="TECH_SUCCESS_TIME" name="TECH_SUCCESS_TIME" style=" font-family: 'Kanit', sans-serif;" placeholder="00:00">
        </div>
       </div>

       <div class="row push">
                        <div class="col-lg-12">
                            <!-- Block Tabs Default Style -->
                            <div class="block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">ช่างผู้ร่วมงาน</a>
                                    </li>
                                 


                                  
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="object1" role="tabpanel">
                                      
                                    <table class="table gwt-table" >
                                        <thead>
                                            <tr>
                                                <td style="text-align: center;">ช่างผู้ร่วมงาน</td>
                            
                                                <td style="text-align: center;" width="12%"><a  class="btn btn-hero-sm btn-hero-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </thead> 
                                        <tbody class="tbody1"> 
                                     
                                    <tr>
                                        <td> 
                                        <select name="HR_PERSON_ID[]" id="TECH_REPAIR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                                                <option value="">--กรุณาเลือกช่าง--</option>
                                                @foreach ($infotechs as $infotech)                                                     
                                                <option value="{{$infotech->PERSON_ID}}">{{ $infotech->HR_FNAME}} {{ $infotech->HR_LNAME}}</option>
                                                @endforeach 
                                                </select>   
                                        </td>
                                     
                                        <td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>
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
        {{-- <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button> --}}
        <span type="button" class="btn btn-hero-sm btn-hero-info btn-submit-add" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</span>
        <a href="{{ route('mrepairmedical.repairmedicalinfo')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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
            });  //กำหนดเป็นวันปัจุบัน
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
        
                                alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
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
                    '<select name="HR_PERSON_ID[]" id="TECH_REPAIR_ID" class="form-control input-lg" style=" font-family: \'Kanit\', sans-serif;" >'+
                    '<option value="">--กรุณาเลือกช่าง--</option>'+
                    '@foreach ($infotechs as $infotech)'+                                                     
                    '<option value="{{$infotech->PERSON_ID}}">{{ $infotech->HR_FNAME}} {{ $infotech->HR_LNAME}}</option>'+
                    '@endforeach'+ 
                    '</select>'+   
                    '</td>'+
               
                    '<td style="text-align: center;"><a class="btn btn-hero-sm btn-hero-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt"></i></a></td>'+
                    '</tr>';
        $('.tbody1').append(tr);
     };

     $('.tbody1').on('click','.remove', function(){
            $(this).parent().parent().remove();
     });

     //-------------------------------------------------
     $('.btn-submit-add').click(function (e) { 
    var form = $('#form_add');
    formSubmit(form)           
 });
  
</script>


@endsection