@extends('layouts.backend')
    
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
      font-size: 14px;
      
      }

      .form-control{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            
      }   

      input::-webkit-calendar-picker-indicator{ 
  
    font-family: 'Kanit', sans-serif;
            font-size: 14px;
         
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
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
          
            }
            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
            }

                .table-fixed tbody {
        height: 300px;
        overflow-y: auto;
        width: 100%;
    }

    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead > tr > th {
        float: left;
        position: relative;

        &::after {
            content: '';
            clear: both;
            display: block;
        }
    }
</style>
<body >
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

                <div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>
                          
                             แจ้งปัญหา                     

</B></h3>

</div>
<div class="block-content block-content-full" align="left">

          
    <form  method="post" action="{{ route('guest.guesthouse_problem_save') }}" enctype="multipart/form-data">
        @csrf      
        <div class="row push">
        <div class="col-lg-4">
                <div class="form-group">
                    <label style=" font-family: 'Kanit', sans-serif;">รูปประกอบ</label>      
                        <img src="{{ asset('image/default.jpg')}}" alt="Image" class="img-thumbnail" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="300px"/>
                </div>
                <div class="form-group"> *ขนาดรูปไม่เกิน 350 x 350 pixel
                        <input type="file" name="picture" id="picture" class="form-control">
                </div>                
            </div>
    
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-lg-2">
                        <label style="text-align: left"> ปัญหาที่พบ :</label>
                    </div> 
            
                    <div class="col-lg-10 ">
                            <input name="PROBLEM_NAME" id="PROBLEM_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    </div> 

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2">
                                <label style="text-align: left"> ปัญหาประเภท :</label>
                            </div> 
                            <div class="col-lg-4 ">
    
                            <select name="PROBLEM_TYPE" id="PROBLEM_TYPE" class="form-control input-lg provice" style=" font-family: 'Kanit', sans-serif;" >
                                    <option value="" >--กรุณาประเภท --</option>
                                  
                                    @foreach ($infotypes as $infotype)                             
                                                                
                                    <option value=" {{ $infotype -> PROBLEM_TYPE_ID }}" >{{ $infotype -> PROBLEM_TYPE_NAME }}</option>
                            
                                    @endforeach  
    
    
                                    </select>
                          
                            </div>                 
                        
                            <div class="col-lg-2">
                                <label style="text-align: left"> มูลค่า :</label>
                            </div> 
                            <div class="col-lg-4 ">
                                <input name="PROBLEM_PICE" id="PROBLEM_PICE" class="form-control input-lg "  style=" font-family: 'Kanit', sans-serif;" >
                            </div>                 
                        </div>
                        <br>
                    <div class="row">
                    <div class="col-lg-2">
                        <label style="text-align: left"> อาคาร :</label>
                    </div> 
            
                    <div class="col-lg-10 ">
                        <select name="LOCATION_ID" id="LOCATION_ID" class="form-control input-lg location" style=" font-family: 'Kanit', sans-serif;" >
                            <option value="" >--กรุณาเลือกอาคาร--</option>
                                @foreach ($infolocations as $infolocation)
                            @if ($LOCATION_NAME == $infolocation->INFMATION_NAME)
                            <option value=" {{ $infolocation -> LOCATION_ID }}" selected>{{ $infolocation -> INFMATION_NAME }}</option>
                            @else
                            <option value=" {{ $infolocation -> LOCATION_ID }}" >{{ $infolocation -> INFMATION_NAME }}</option>
                            @endif
                                    
                            
                                @endforeach         
                        </select>
                    </div> 
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-2">
                            <label style="text-align: left"> ชั้น :</label>
                        </div> 
                        <div class="col-lg-4 ">
                            <select name="LOCATION_LEVEL_ID" id="LOCATION_LEVEL_ID" class="form-control input-lg locationlevel" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" >--กรุณาเลือกชั้น--</option>
                                    @foreach ($infolocationlevels as $infolocationlevel)
                                    
                                    @if ($LOCATION_LEVEL_NAME == $infolocationlevel->LOCATION_LEVEL_NAME)
                                    <option value=" {{ $infolocationlevel -> LOCATION_LEVEL_ID }}" selected>{{ $infolocationlevel -> LOCATION_LEVEL_NAME }}</option>  
                                    @else
                                    <option value=" {{ $infolocationlevel -> LOCATION_LEVEL_ID }}" >{{ $infolocationlevel -> LOCATION_LEVEL_NAME }}</option>  
                                    @endif
                                                                          
                                    @endforeach         
                            </select>
            
                        </div>                 
                    
                    <div class="col-lg-2">
                            <label style="text-align: left"> ห้อง :</label>
                        </div> 
                        <div class="col-lg-4 ">
                            <select name="LEVEL_ROOM_ID" id="LEVEL_ROOM_ID" class="form-control input-lg locationlevelroom" style=" font-family: 'Kanit', sans-serif;" >
                                <option value="" >--กรุณาเลือกห้อง--</option>
                                    @foreach ($infolocationlevelrooms as $infolocationlevelroom)
                                        @if ($LEVEL_ROOM_NAME == $infolocationlevelroom->LEVEL_ROOM_NAME)
                                        <option value=" {{ $infolocationlevelroom -> LEVEL_ROOM_ID }}" selected>{{ $infolocationlevelroom -> LEVEL_ROOM_NAME }}</option>
                                        @else
                                        <option value=" {{ $infolocationlevelroom -> LEVEL_ROOM_ID }}" >{{ $infolocationlevelroom -> LEVEL_ROOM_NAME }}</option>
                                        @endif
                                    
                                
                                    @endforeach         
                            </select>
                        </div>                 
                    </div>
                    <br>

                   

                    <div class="row">
                    <div class="col-lg-2">
                            <label style="text-align: left"> ผู้แจ้ง :</label>
                        </div> 
                        <div class="col-lg-4 ">
                        {{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}
                        </div>                 
                    
                    <div class="col-lg-2">
                            <label style="text-align: left"> โทร :</label>
                        </div> 
                        <div class="col-lg-4 ">
                         
                            <input type="hidden" name="PROBLEM_HR_TEL" value="{{$PETITION_HR_TEL}}">
                            {{$PETITION_HR_TEL}}
                        </div>                 
                    </div>
                    <br>
                    
            </div> 
        </div> 

        <input  type="hidden" name="USER_ID" id="USER_ID" class="form-control input-lg "  style=" font-family: 'Kanit', sans-serif;" value="{{$inforpersonid}}">

        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึก</button>
        <a href="{{ url('person_guesthouse/guesthouse_problem/'.$id_user)  }}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
        </div>

       
        </div>
        </form>  

@endsection

@section('footer')



<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script src="{{ asset('select2/select2.min.js') }}"></script>

<script>

$(document).ready(function() {
    $('select').select2();
});

    //=====================================================================
    $('.location').change(function() {
        if ($(this).val() != '') {
            var select = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('dropdown.repairnomal')}}",
                method: "GET",
                data: {
                    select: select,
                    _token: _token
                },
                success: function(result) {
                    $('.locationlevel').html(result);
                }
            })
            // console.log(select);
        }
    });
    $('.locationlevel').change(function() {
        if ($(this).val() != '') {
            var select = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('dropdown.repairnomalsub')}}",
                method: "GET",
                data: {
                    select: select,
                    _token: _token
                },
                success: function(result) {
                    $('.locationlevelroom').html(result);
                }
            })
            // console.log(select);
        }
    });
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true //Set เป็นปี พ.ศ.
        }).datepicker("setDate", 0); //กำหนดเป็นวันปัจุบัน
    });

    function chkNumber(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9')) return false;
        ele.onKeyPress = vchar;
    }

    function chkmunny(ele) {
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
        ele.onKeyPress = vchar;
    }
    $('body').on('keydown', 'input, select, textarea', function(e) {
        var self = $(this),
            form = self.parents('form:eq(0)'),
            focusable, next;
        if (e.keyCode == 13) {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
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
    function readURL1(input) {
        var fileInput = document.getElementById('picture');
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        var numb = input.files[0].size / 1024;
        if (numb > 64) {
            alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
            fileInput.value = '';
            return false;
        }
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
            fileInput.value = '';
            return false;
        }
    }
    $("#picture").change(function() {
        readURL1(this);
    });
    //++++++++++++++++++++++++
    function locationselect() {
        $('.location').change(function() {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('dropdown.repairnomal')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function(result) {
                        $('.locationlevel').html(result);
                    }
                })
                // console.log(select);
            }
        });
        $('.locationlevel').change(function() {
            if ($(this).val() != '') {
                var select = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('dropdown.repairnomalsub')}}",
                    method: "GET",
                    data: {
                        select: select,
                        _token: _token
                    },
                    success: function(result) {
                        $('.locationlevelroom').html(result);
                    }
                })
                // console.log(select);
            }
        });
    }
</script>

@endsection