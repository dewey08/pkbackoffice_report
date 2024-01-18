@extends('layouts.backend_admin')

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

    label {
        font-family: 'Kanit', sans-serif;
        font-size: 13px;

    }
</style>
<script>
    function checklogin() {
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
            <h2 class="content-heading pt-0" 
            style="font-family: 'Kanit', sans-serif;">
                <i class="fas fa-plus"></i>
                เพิ่มข้อมูลห้องประชุม</h2>


            <form method="post" action="{{ route('admin.saveroom') }}" enctype="multipart/form-data">
                @csrf
                <div class="row push">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>ชื่อห้องประชุม</label>
                            <input name="ROOM_NAME" id="ROOM_NAME" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" onkeyup="check_room_name();">
                            <div style="color: red; font-size: 16px;" id="room_name"></div>
                        </div>
                        <div class="form-group">
                            <label>จองล่วงหน้า (วัน)</label>
                            <input name="GET_BEFORE" id="GET_BEFORE" class="form-control input-lg"
                                style="font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)"
                                onkeyup="check_get_before();">
                            <div style="color: red; font-size: 16px;" id="get_before"></div>

                        </div>

                        <div class="form-group">
                            <img id="image_upload_preview1" height="250px" width="100%" />
                        </div>
                        <div class="form-group">
                            <input type="file" name="picture1" id="picture1" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>สถานที่ตั้ง</label>
                            <input name="ROOM_LOCATION" id="ROOM_LOCATION" class="form-control input-lg "
                                style=" font-family: 'Kanit', sans-serif;" onkeyup="check_room_location();">
                            <div style="color: red; font-size: 16px;" id="room_location"></div>
                        </div>
                        <div class="form-group">
                            <label>ความจุ (คน)</label>
                            <input name="CONTAIN" id="CONTAIN" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;" OnKeyPress="return chkNumber(this)"
                                onkeyup="check_contain();">
                            <div style="color: red; font-size: 16px;" id="contain"></div>
                        </div>
                        <div class="form-group">
                            <img id="image_upload_preview2" height="250px" width="100%" />
                        </div>
                        <div class="form-group">
                            <input type="file" name="picture2" id="picture2" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>ผู้รับผิดชอบ</label>

                            <select name="ROOM_PERSON_ID" id="ROOM_PERSON_ID" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;font-size: 13px;"
                                onchange="check_room_person_id();">
                                <option value="">--กรุณาเลือกผู้รับผิดชอบ--</option>
                                @foreach ($inforpersons as $inforperson)
                                <option value="{{ $inforperson ->ID  }}">{{ $inforperson->HR_FNAME}}
                                    {{$inforperson->HR_LNAME}}</option>
                                @endforeach
                            </select>
                            <div style="color: red; font-size: 16px;" id="room_person_id"></div>
                        </div>
                        <div class="form-group">
                            <label>หมายเหตุ</label>
                            <input name="ROOM_DETAIL" id="ROOM_DETAIL" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                        </div>
                        <div class="form-group">
                            <label>สีห้อง *ควรเลือกสีให้เหมาะกับตัวอักษรสีขาว</label>
                            <input name="ROOM_COLOR" type="color" id="ROOM_COLOR" class="form-control input-lg"
                                style=" font-family: 'Kanit', sans-serif;">
                        </div>
                    </div>


                    <input type="hidden" name="ROOM_STATUS_ID" id="ROOM_STATUS_ID" class="form-control input-lg"
                        value="2">

                </div>
        </div>
        <div class="modal-footer">
            <div align="right">
                <button type="submit" class="btn btn-hero-sm btn-hero-info"><i class="fas fa-save mr-2"></i>
                    บันทึกข้อมูล</button>
                <a href="{{ url('admin_meeting/setupinforoom')  }}" class="btn btn-hero-sm btn-hero-danger"
                    onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')"> <i
                        class="fas fa-window-close mr-2"></i>ยกเลิก</a>
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

            function chkNumber(ele) {
                var vchar = String.fromCharCode(event.keyCode);
                if ((vchar < '0' || vchar > '9')) return false;
                ele.onKeyPress = vchar;
            }

            function check_room_name() {
                room_name = document.getElementById("ROOM_NAME").value;
                if (room_name == null || room_name == '') {
                    document.getElementById("room_name").style.display = "";
                    text_room_name = "*กรุณาระบุชื่อห้องประชุม";
                    document.getElementById("room_name").innerHTML = text_room_name;
                } else {
                    document.getElementById("room_name").style.display = "none";
                }
            }

            function check_get_before() {
                get_before = document.getElementById("GET_BEFORE").value;
                if (get_before == null || get_before == '') {
                    document.getElementById("get_before").style.display = "";
                    text_get_before = "*กรุณาระบุจองล่วงหน้า";
                    document.getElementById("get_before").innerHTML = text_get_before;
                } else {
                    document.getElementById("get_before").style.display = "none";
                }
            }

            function check_room_location() {
                room_location = document.getElementById("ROOM_LOCATION").value;
                if (room_location == null || room_location == '') {
                    document.getElementById("room_location").style.display = "";
                    text_room_location = "*กรุณาระบุสถานที่ตั้ง";
                    document.getElementById("room_location").innerHTML = text_room_location;
                } else {
                    document.getElementById("room_location").style.display = "none";
                }
            }

            function check_contain() {
                contain = document.getElementById("CONTAIN").value;
                if (contain == null || contain == '') {
                    document.getElementById("contain").style.display = "";
                    text_contain = "*กรุณาระบุความจุ";
                    document.getElementById("contain").innerHTML = text_contain;
                } else {
                    document.getElementById("contain").style.display = "none";
                }
            }

            function check_room_person_id() {
                room_person_id = document.getElementById("ROOM_PERSON_ID").value;
                if (room_person_id == null || room_person_id == '') {
                    document.getElementById("room_person_id").style.display = "";
                    text_room_person_id = "*กรุณาเลือกผู้รับผิดชอบ";
                    document.getElementById("room_person_id").innerHTML = text_room_person_id;
                } else {
                    document.getElementById("room_person_id").style.display = "none";
                }
            }
        </script>
        <script>
            $('form').submit(function () {

                var room_name, text_room_name;
                var get_before, text_get_before;
                var room_location, text_room_location;
                var contain, text_contain;
                var room_person_id, text_room_person_id;

                room_name = document.getElementById("ROOM_NAME").value;
                get_before = document.getElementById("GET_BEFORE").value;
                room_location = document.getElementById("ROOM_LOCATION").value;
                contain = document.getElementById("CONTAIN").value;
                room_person_id = document.getElementById("ROOM_PERSON_ID").value;


                if (room_name == null || room_name == '') {
                    document.getElementById("room_name").style.display = "";
                    text_room_name = "*กรุณาระบุชื่อห้องประชุม";
                    document.getElementById("room_name").innerHTML = text_room_name;
                } else {
                    document.getElementById("room_name").style.display = "none";
                }
                if (get_before == null || get_before == '') {
                    document.getElementById("get_before").style.display = "";
                    text_get_before = "*กรุณาระบุจองล่วงหน้า";
                    document.getElementById("get_before").innerHTML = text_get_before;
                } else {
                    document.getElementById("get_before").style.display = "none";
                }
                if (room_location == null || room_location == '') {
                    document.getElementById("room_location").style.display = "";
                    text_room_location = "*กรุณาระบุสถานที่ตั้ง";
                    document.getElementById("room_location").innerHTML = text_room_location;
                } else {
                    document.getElementById("room_location").style.display = "none";
                }
                if (contain == null || contain == '') {
                    document.getElementById("contain").style.display = "";
                    text_contain = "*กรุณาระบุความจุ";
                    document.getElementById("contain").innerHTML = text_contain;
                } else {
                    document.getElementById("contain").style.display = "none";
                }


                if (room_person_id == null || room_person_id == '') {
                    document.getElementById("room_person_id").style.display = "";
                    text_room_person_id = "*กรุณาเลือกผู้รับผิดชอบ";
                    document.getElementById("room_person_id").innerHTML = text_room_person_id;
                } else {
                    document.getElementById("room_person_id").style.display = "none";
                }



                if (room_name == null || room_name == '' ||
                    get_before == null || get_before == '' ||
                    room_location == null || room_location == '' ||
                    contain == null || contain == '' ||
                    room_person_id == null || room_person_id == ''
                ) {
                    alert("กรุณาตรวจสอบความถูกต้องของข้อมูล");
                    return false;
                }
            });
        </script>


        <script>
            function readURL1(input) {
                var fileInput = document.getElementById('picture1');
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

                    reader.onload = function (e) {
                        $('#image_upload_preview1').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }

            }


            function readURL2(input) {
                var fileInput = document.getElementById('picture2');
                var url = input.value;
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                var numb = input.files[0].size / 1024;

                if (numb > 64) {
                    alert('กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 64KB');
                    fileInput.value = '';
                    return false;
                }

                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image_upload_preview2').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('กรุณาอัพโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif .');
                    fileInput.value = '';
                    return false;
                }

            }



            $("#picture1").change(function () {
                readURL1(this);
            });

            $("#picture2").change(function () {
                readURL2(this);
            });
        </script>

        @endsection