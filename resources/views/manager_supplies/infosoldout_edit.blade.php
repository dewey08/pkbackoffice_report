@extends('layouts.supplies')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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

    use App\Http\Controllers\ManagersuppliesController;
    $refnumber = ManagersuppliesController::refnumbersouldout();
    $datenow = date('Y-m-d');
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

<h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>ขายทอดตลาด</B></h3>
{{-- <a href="{{ url('manager_guesthouse/guesthouserequestdetail_flat_edit/'.$infoguesthouse->INFMATION_ID)}}"   class="btn btn-hero-sm btn-hero-warning foo15" ><i class="fas fa-edit mr-2"></i>แก้ไข</a> --}}
&nbsp;&nbsp;

<a href="{{ url('manager_supplies/infosoldout')  }}"   class="btn btn-hero-sm btn-hero-success foo15" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>

</div>
<div class="block-content block-content-full" align="left">

          
    <form  method="post" action="{{ route('msupplies.infosoldout_update') }}" enctype="multipart/form-data">
        @csrf
      
        <input type="hidden"name="SOLDOUT_ID" id="SOLDOUT_ID" class="form-control input-sm " value="{{$soldout->SOLDOUT_ID}}">
        
        <div class="row push">
            <div class="col-lg-2">
                <label>เลขที่บิล :</label>
            </div> 
            <div class="col-lg-3">
                <input name="SOLDOUT_NO" id="SOLDOUT_NO" class="form-control input-sm " value="{{$soldout->SOLDOUT_NO}}">
            </div>
            <div class="col-lg-1">
                <label>วันที่ :</label>
            </div> 
            <div class="col-lg-2">
                <input name="SOLDOUT_DATE" id="SOLDOUT_DATE" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style="font-family:'Kanit',sans-serif;font-size:13px;" value="{{formate($soldout->SOLDOUT_DATE)}}" readonly> 
            </div> 
           
            <div class="col-lg-2">
                <label>ปีงบประมาณ :</label>
            </div> 
            <div class="col-lg-2">
                <select name="SOLDOUT_YEAR" id="SOLDOUT_YEAR" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                    <option value="">--เลือก--</option>
                    @foreach ($budgetyears as $budgetyear) 
                    @if($budgetyear ->LEAVE_YEAR_ID == $yearbudget)
                        <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                    @else
                        <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear->LEAVE_YEAR_NAME }}</option>
                    @endif
                @endforeach 
                </select>    
            </div>
            </div>
            <div class="row push">
                <div class="col-lg-2">
                    <label>รายการ :</label>
                </div> 
                <div class="col-lg-3">
                    <select name="SOLDOUT_ARTICLE_ID" id="SOLDOUT_ARTICLE_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" required>
                        <option value="">--เลือก--</option>
                        @foreach ($article as $item)   
                        @if ($soldout->SOLDOUT_ARTICLE_ID == $item->ARTICLE_ID)
                        <option value="{{ $item ->ARTICLE_ID  }}" selected>{{ $item->ARTICLE_NUM}} &nbsp;&nbsp; {{ $item->ARTICLE_NAME}}</option>
                        @else
                        <option value="{{ $item ->ARTICLE_ID  }}">{{ $item->ARTICLE_NUM}} &nbsp;&nbsp; {{ $item->ARTICLE_NAME}}</option>
                        @endif                                                  
                       
                        @endforeach 
                    </select>  
                </div>  
                <div class="col-lg-1">
                    <label>ผู้ชนะ :</label>
                </div> 
                <div class="col-lg-2">
                    {{-- <input name="SOLDOUT_WIN" id="SOLDOUT_WIN" class="form-control input-sm " > --}}
                    <select name="SOLDOUT_WIN" id="SOLDOUT_WIN" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" >
                        <option value="">--เลือก--</option>
                        @foreach ($suppliesvendor as $itemven)                                                     
                      
                        @if ($soldout->SOLDOUT_WIN == $itemven->VENDOR_ID)
                        <option value="{{ $itemven ->VENDOR_ID  }}" selected>{{ $itemven->VENDOR_NAME}} &nbsp;&nbsp;</option>
                        @else
                        <option value="{{ $itemven ->VENDOR_ID  }}">{{ $itemven->VENDOR_NAME}} &nbsp;&nbsp;</option>
                        @endif  
                        @endforeach 
                    </select> 
                </div>
                <div class="col-lg-2">
                    <label>จำนวนเงิน :</label>
                </div> 
                <div class="col-lg-2">
                    <input name="SOLDOUT_PRICE" id="SOLDOUT_PRICE" class="form-control input-sm " value="{{$soldout->SOLDOUT_PRICE}}">
                </div>  
            </div>
            <div class="row push">
                <div class="col-lg-2">
                    <label>รายละเอียด :</label>
                </div> 
                <div class="col-lg-10">
                    <input name="SOLDOUT_DETAIL" id="SOLDOUT_DETAIL" class="form-control input-sm " value="{{$soldout->SOLDOUT_DETAIL}}">
                </div>         
            </div>
         
        <div class="row push">
            <div class="col-lg-2">
                <label>หมายเหตุ :</label>
            </div> 
            <div class="col-lg-10">
                <input name="SOLDOUT_COMMENT" id="SOLDOUT_COMMENT" class="form-control input-sm " value="{{$soldout->SOLDOUT_COMMENT}}">
            </div>         
        </div>


        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <a href="{{ url('manager_supplies/infosoldout')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" style="font-family: 'Kanit', sans-serif;"><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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
    $("select").select2();
});
  $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
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

  
</script>


@endsection