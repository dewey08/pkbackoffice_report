@extends('layouts.elearning')

<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

@section('content')
<style>
        .text {
        font-family: 'Kanit', sans-serif;
    }

    .center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
      
        }
        .form-control {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
        }
        #pages{
                text-align: center;
            }
            .page{
                width: 90%;
                margin: 10px;
                box-shadow: 0px 0px 5px #000;
                animation: pageIn 1s ease;
                transition: all 1s ease, width 0.2s ease;
            }
            @keyframes pageIn{
            0%{
                transform: translateX(-300px);
                opacity: 0;
            }
            100%{
                transform: translateX(0px);
                opacity: 1;
            }
            }
            #zoom-in{
                
            }
            #zoom-percent{
                display: inline-block;
            }
            #zoom-percent::after{
                content: "%";
            }
            #zoom-out{
                
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


<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center text fs-24">ข้อมูลบทเรียน</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="block-content my-3 shadow"><br>
        <div class="row">
                <div class="col-md-12">
                    @if (session('alert'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="flex-fill ml-3">
                                            <p class="mb-0">{{ session('alert') }}</p>
                                        </div>
                    </div>

                    @endif
                </div>
            </div>
        <div class="row">
                <div class="col-lg-1"></div>             
                <div class="col-lg-10">
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-9"></div>
                <div class="col-lg-2" align="right">
                        <button type="button" class="btn btn-outline-info mr-1 mb-3 text"  data-toggle="modal" data-target="#add_lesson">
                         <i class="fa fa-fw fa-plus mr-1"></i>เพิ่มบทเรียน 
                        </button>
           
                </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                <table class="table table-bordered table-hover  table-vcenter js-dataTable-full text-center">
                                <thead class=" table-warning">
                                        <tr>
                                            <th width="5%"><span style="font-size: 14px;">ลำดับ</span></th>
                                            <th width="20%"><span style="font-size: 14px;">ภาพปก</span></th>
                                            <th><span style="font-size: 14px;">ชื่อบทเรียน</span></th>
                                            <th width="20%"><span style="font-size: 14px;">หมวดหมู่</span></th>
                                            <th width="5%"><span style="font-size: 14px;">เปิดใช้</span></th>
                                            <th width="5%"><span style="font-size: 14px;">คำสั่ง</span></th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $number = 0; ?>
                                @foreach ($lesson as $row)
                                <?php $number++; ?>
                                        <tr>
                                            <td class="" ><span style="font-size: 14px;">{{ $number }}</span></td> 
                                            <td class="" ><a href="data:image/png;base64,{{ chunk_split(base64_encode($row->IMG_LESSON)) }}"target="_blank"><img  width="100px" src="data:image/png;base64,{{ chunk_split(base64_encode($row->IMG_LESSON)) }}" ></a></td>
                                            <td class="" align="left"><span style="font-size: 14px;">{{$row-> NAME_LESSON}}</span></td>
                                            <td class="text-center" align="left"><span style="font-size: 14px;">{{$row->NAME_LESSON_GROUP}}</span></td>
                                            <td align="center" width="10%">
                                                <div class="custom-control custom-switch custom-control-lg ">
                                                    @if($row-> ACTIVE_LESSON == 'True' )
                                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_LESSON }}" name="{{ $row-> ID_LESSON }}" onchange="switch_status({{ $row-> ID_LESSON }});" checked>
                                                    @else
                                                    <input type="checkbox" class="custom-control-input" id="{{ $row-> ID_LESSON }}" name="{{ $row-> ID_LESSON }}" onchange="switch_status({{ $row-> ID_LESSON }});">
                                                    @endif
                                                    <label class="custom-control-label" for="{{ $row-> ID_LESSON }}"></label>
                                                </div>
                                            </td>
                                            <td >
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle foo13" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                        ทำรายการ
                                                </button>
                                                    <div class="dropdown-menu foo13" style="width:15px">
                                                        <a class="dropdown-item"  href="#details_lesson{{ $row -> ID_LESSON }}"  data-toggle="modal"  >รายละเอียด</a>
                                                        <a class="dropdown-item loadscreen"   href="{{ url('/e_learning/manage_lesson/edit/'.$row->ID_LESSON)}}" >แก้ไขข้อมูล</a>
                                                       
                                                    </div>
                                            </div>
                                        </td>  
                                        </tr> 
                                        <!-- The Modal details-->
                                <div class="modal fade " id="details_lesson{{ $row -> ID_LESSON }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-popout modal-xl" role="document">
                                                <div class="modal-content ">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-gray-dark">
                                                    
                                                            <h2 class="block-title text fs-24">{{$row-> NAME_LESSON}}</h2>
                                                        </div>
                                                        <div class="block-content">
                                                            
                                                            <div class="row">
                                                                <div class="col-6 col-md-4"> 
                                                                    <br><br><br><br><br><br>
                                                                        <video src="{{ asset('storage/lesson_video/'.$row->VIDEO_LESSON) }}" controls width="400" height="215" ></video>
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-7">
                                                            
                                                            <div class="block block-themed bg-warning-lighter">
                                                                            <div class="block-content" style="padding:5px 15px 3px 10px;background-color: #FFF5E1">
                                                                            <h3 class="block-title  text fs-22"> <b> บทเรียน</b></h3>
                                                                            </div>

                                                                            <div class="block-header" style="background-color: #CA965C; padding:5px 15px 3px 10px;">
                                                                                <h3 class="block-title text">แบบทดสอบก่อนเรียน</h3>
                                                                            </div>
                                                                            <div class="block-content" style="padding:5px 15px 0px 10px;background-color: #FFF5E1">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text">
                                                                                        <p><i class="fa fa-1x fa-lock "></i>&nbsp; แบบทดสอบก่อนเรียน </p>
                                                                                    </div>
                                                                                    <div class="col-md-5"></div>
                                                                                    <div class="col-md-3" align="right">
                                                                                        <h4><span class="badge badge-success text" >10 คำถาม</span></h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="block-header" style="background-color: #CA965C; padding:5px 15px 3px 10px;">
                                                                                <h3 class="block-title text">
                                                                                {{$row-> NAME_LESSON}}
                                                                                </h3>
                                                                            </div>
                                                                            <div class="block-content" style="padding:5px 15px 0px 10px;background-color: #FFF5E1">
                                                                                <div class="row">
                                                                                    <div class="col-md-8 text">
                                                                                        <p><i class="fa fa-1x fa-lock "></i>&nbsp; {{$row-> NAME_LESSON}} </p>
                                                                                    </div>
                                                                                    
                                                                                    <div class="col-md-4 fs-18 text" align="right">
                                                                                        <h5 class="text"> {{$row-> TIME_LESSON}} </h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="block-header" style="background-color: #CA965C; padding:5px 15px 3px 10px;">
                                                                                <h3 class="block-title text">แบบทดสอบหลังเรียน</h3>
                                                                            </div>
                                                                            <div class="block-content" style="padding:5px 15px 0px 10px;background-color: #FFF5E1">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 text">
                                                                                        <p><i class="fa fa-1x fa-lock "></i>&nbsp; แบบทดสอบหลังเรียน </p>
                                                                                    </div>
                                                                                    <div class="col-md-5"></div>
                                                                                    <div class="col-md-3" align="right">
                                                                                        <h4><span class="badge badge-success text" >10 คำถาม</span></h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="block-header" style="background-color: #CA965C; padding:5px 15px 3px 10px;">
                                                                                <h3 class="block-title text">เอกสารประกอบการเรียน</h3>
                                                                            </div>
                                                                            <div class="block-content" style="padding:5px 15px 0px 10px;background-color: #FFF5E1">
                                                                                <div class="row">
                                                                                    <div class="col-md-8 text">
                                                                                        <p><i class="fa fa-1x fa-download "></i>&nbsp; {{$row-> NAME_LESSON}}.pfd </p>
                                                                                    </div>
                                                                                
                                                                                    <div class="col-md-4 text">
                                                                                        <a href="{{ asset('storage/lesson_doc/'.$row->DOCUMENT_LESSON) }}" target="_blank"><p align = 'right'><button type="submit" class="btn btn-hero-sm btn-hero-danger foo14" ><i class="fas fa-download mr-1"></i>ดาวน์โหลด</button></p></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>     
                                                                        </div>     
                                                                </div>
                                                            <br><br>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10 text">
                                                                        <div class="block block-rounded block-bordered">
                                                                            <ul class="nav nav-tabs nav-tabs-block bg-info-lighter" data-toggle="tabs" role="tablist">
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link active" href="#btabs-animated-slideup-objective{{$row -> ID_LESSON}}">วัตถุประสงค์</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" href="#btabs-animated-slideup-details{{$row -> ID_LESSON}}">รายละเอียด</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" href="#btabs-animated-slideup-teach{{$row -> ID_LESSON}}">ผู้สอน</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                            <div class="block-content tab-content overflow-hidden">
                                                                                <div class="tab-pane fade fade-up show active" id="btabs-animated-slideup-objective{{$row -> ID_LESSON}}" role="tabpanel">
                                                                                    <p style="text-indent: 2.5em;">{{$row-> OBJECTIVE_LESSON}}</p>
                                                                                </div>
                                                                                <div class="tab-pane fade fade-up" id="btabs-animated-slideup-details{{$row -> ID_LESSON}}" role="tabpanel">
                                                                                    <p style="text-indent: 2.5em;">{{$row-> DETAIL_LESSON}}</p>
                                                                                </div>
                                                                                <div class="tab-pane fade fade-up" id="btabs-animated-slideup-teach{{$row -> ID_LESSON}}" role="tabpanel">
                                                                                    <div class="row">
                                                                                        
                                                                                        <div class="col-md-5">
                                                                                            <p style="text-indent: 2.5em;">{{$row-> TEACH_LESSON}}</p>
                                                                                        </div>
                                                                                        <div class="col-md-5">
                                                                                        @if($row->TEACH_IMG_LESSON == '' || $row->TEACH_IMG_LESSON == null)
                                                                                        @else
                                                                                            <img  width="100px" src="data:image/png;base64,{{ chunk_split(base64_encode($row->TEACH_IMG_LESSON)) }}">
                                                                                        @endif
                                                                                        
                                                                                        </div>
                                                                                        <div class="col-md-1"></div>
                                                                                    </div><br>    
                                                                            
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                  
                                                        </div>
                                                        <div class="block-content block-content-full text-right bg-light">
                                                            <div align="right">
                                                                <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" ><i class="fas fa-times mr-2"></i>ปิดหน้าต่าง</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>

                                @endforeach
                                </tbody>
                        </table><br>
                </div>
            </div>
        </div>    
    </div>
</div>

<!-- The Modal add-->
<div class="modal fade" id="add_lesson"  role="dialog" aria-labelledby="modal-block-fromleft" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft modal-xl" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-success">
                            <h2 class="block-title">เพิ่มบทเรียน</h2>
                        </div>
                        <div class="block-content">
                        <form  method="post" action="{{ route('save_lesson') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">หมวดหมู่บทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-lg-4 text-left" align="left">
                                            <div class="form-group">
                                                <select class="js-select2 form-control" required id="ID_LESSON_GROUP"  name="ID_LESSON_GROUP" style="width: 100%;" data-placeholder="Choose one..">
                                                    <option></option>
                                                    @foreach ($id_lesson_group as $row)
                                                        <option value="{{$row->ID_LESSON_GROU}}" > {{$row->NAME_LESSON_GROUP}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                </div>
                                <div class="col-md-2" >
                                    <label for="" class="fs-20">ชื่อบทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" >
                                    <input type="text" class="form-control" required placeholder="กรุณากรอกชื่อบทเรียน..." id="NAME_LESSON" name="NAME_LESSON" style=" font-family: 'Kanit', sans-serif;">
                                </div>  
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">วัตถุประสงค์ <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" align="left">
                                    <textarea class="form-control" rows="1" required placeholder="กรุณากรอกวัตถุประสงค์..." id="OBJECTIVE_LESSON" name="OBJECTIVE_LESSON" style=" font-family: 'Kanit', sans-serif;"></textarea>
                                </div> 
                                <div class="col-md-2">
                                    <label for="" class="fs-20">รายละเอียด <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" >
                                    <textarea class="form-control" rows="1" required placeholder="กรุณากรอกรายละเอียด..." id="DETAIL_LESSON" name="DETAIL_LESSON" style=" font-family: 'Kanit', sans-serif;"></textarea>
                                </div> 
                            </div><br>  

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">ชื่อผู้สอน</label>
                                </div> 
                                <div class="col-md-4 text-left" align="left">
                                    <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้สอน..." id="TEACH_LESSON" name="TEACH_LESSON" style=" font-family: 'Kanit', sans-serif;">
                                </div>  
                                <div class="col-md-2">
                                    <label for="" class="fs-20">เวลาในการเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4 text-left" align="left">
                                    <input type="text" class="form-control"  required placeholder="กรุณากรอกเวลาในการเรียน..." id="TIME_LESSON" name="TIME_LESSON" style=" font-family: 'Kanit', sans-serif;">
                                </div> 
                            </div><br> 
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">ภาพปกบทเรียน <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <img id="image_upload_preview_lesson" width="300px" height="200px" src="{{asset('image/elearning_question/learning.png') }}">
                                    </div>
                                    **ขนาดภาพแนะนำ 900 * 500 พิกเซล*(กว้างxสูง)
                                    <div class="form-group">
                                    <input style="font-family: 'Kanit', sans-serif;" required type="file" name="picture" id="picture" class="form-control-file border">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="fs-20">รูปผู้สอน </label>
                                </div> 
                                <div class="col-md-4 text-secondary">
                                    <div class="form-group">
                                        <img id="image_upload_preview" width="270px" height="200px" src="{{asset('image/elearning_question/teach.jpg') }}">
                                    </div>
                                   **ขนาดภาพแนะนำ 100 * 100 พิกเซล*(กว้างxสูง)
                                    <div class="form-group">
                                        <input style="font-family: 'Kanit', sans-serif;" type="file" name="TEACH_IMG_LESSON" id="TEACH_IMG_LESSON" class="form-control-file border">
                                    </div>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">วิดีโอ <span class="text-danger">*</span></label>
                                </div> 
                                <div class="col-md-10 text-left text-secondary" align="left">
                                    <div class="form-group">
                                        <video id="preview_video_add" controls autoplay width="400px" height="300px"></video>
                                    </div>
                                    **ขนาดไฟล์วิดีโอแนะนำไม่เกิน 100 MB
                                    <div class="form-group">
                                        <input type="file" class="form-control-file border" required name="upvideo_add" id="upvideo_add" accept="video/*" style=" font-family: 'Kanit', sans-serif;">
                                    </div>
                                </div> 
                            </div><br>
                            
                            <div class="row">
                                 <!-- <div class="col-md-2">
                                    <label  for="" class="fs-20">ลิงค์วิดีโอ :</label>
                                </div>  -->
                                <div class="col-md-10 text-left" align="left">
                                    <input type="hidden" class="form-control" id="LINK_VIDEO_LESSON" name="LINK_VIDEO_LESSON" style=" font-family: 'Kanit', sans-serif;">
                                </div> 
                            </div><br>  

                             <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="fs-20">เอกสารประกอบ </label><br> 
                                </div> 
                                <div class="col-md-10 text-left text-secondary" align="left">
                                    **ขนาดไฟล์pdfแนะนำไม่เกิน 1 MG (ไฟล์นามสกุล .pdf) <br> 
                                    <input type="file" id="pdfupload" name="DOCUMENT_LESSON"  accept="application/pdf" style="width:75%;"/>
                                    <div id="zoom-percent" style="text-align: right;">90</div>
                                    <a id="zoom-in" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-plus"></i></a>
                                    <a id="zoom-out" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a>
                                    <a id="zoom-reset" class="btn btn-info" style="color:#F0FFFF"><i class="fa fa-search-minus"></i></a><br><br>
                                    <div style='overflow:scroll; width:auto;height:700px; text-align: center; background-color: #404040;' id="pages"></div>
                                </div> 
                            </div><br>
                        </div>
                        <div class="block-content block-content-full text-right bg-light">
                            <div align="right">
                            <button type="submit"  class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                <button type="submit"  class="btn btn-hero-sm btn-hero-danger foo15" data-dismiss="modal"><i class="fas fa-times mr-2"></i>ยกเลิก</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
@endsection

@section('footer')
<script>
$(document).ready(function() {
   $("select").select2({ 
	dropdownParent: $("#add_lesson") 
	});
});
</script>

<!-- เช็คค่าว่าง -->
<script>
     function check_namelesson()
        {        
                name = document.getElementById("NAME_LESSON_GROUP").value;             
                if (name==null || name==''){
                document.getElementById("name_lesson_group").style.display = "";     
                text_name = "*กรุณาระบุข้อมูลชื่อหมวดหมู่บทเรียน";
                document.getElementById("name_lesson_group").innerHTML = text_name;
                }else{
                document.getElementById("name_lesson_group").style.display = "none";
                }
        }
</script>

<script>
  function readURL_lesson(input) {
    var fileInput = document.getElementById('picture');
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var numb = input.files[0].size / 1024;
    if (numb > 10000) {
      alert('กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 64KB');
      fileInput.value = '';
      return false;
    }
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_upload_preview_lesson').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#picture").change(function () {
    readURL_lesson(this);
  });
</script>

<script>
  function readURL(input) {
    var fileInput = document.getElementById('TEACH_IMG_LESSON');
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var numb = input.files[0].size / 1024;
    if (numb > 10000) {
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
    } else {
      alert('กรุณาอัปโหลดไฟล์ประเภทรูปภาพ .jpeg/.jpg/.png/.gif');
      fileInput.value = '';
      return false;
    }
  }
  $("#TEACH_IMG_LESSON").change(function () {
    readURL(this);
  });
</script>

<!-- pdf -->
<script src="{{ asset('pdfupload/pdf_up.js') }}"></script>
<script>

pdfjsLib.GlobalWorkerOptions.workerSrc =
"{{ asset('pdfupload/pdf_upwork.js') }}";

  document.querySelector("#pdfupload").addEventListener("change", function(e){
  document.querySelector("#pages").innerHTML = "";

	var file = e.target.files[0]
	if(file.type != "application/pdf"){
		alert(file.name + " is not a pdf file.")
		return
	}
	
	var fileReader = new FileReader();  

	fileReader.onload = function() {
		var typedarray = new Uint8Array(this.result);
    
		pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
			// you can now use *pdf* here
			console.log("the pdf has", pdf.numPages, "page(s).");
      for (var i = 0; i < pdf.numPages; i++) {
        (function(pageNum){
        pdf.getPage(i+1).then(function(page) {
          // you can now use *page* here
          var viewport = page.getViewport(2.0);
          var pageNumDiv = document.createElement("div");
          pageNumDiv.className = "pageNumber";
          pageNumDiv.innerHTML = "Page " + pageNum;
          var canvas = document.createElement("canvas");
          canvas.className = "page";
          canvas.title = "Page " + pageNum;
          document.querySelector("#pages").appendChild(pageNumDiv);
          document.querySelector("#pages").appendChild(canvas);
          canvas.height = viewport.height;
          canvas.width = viewport.width;


          page.render({
            canvasContext: canvas.getContext('2d'),
            viewport: viewport
          }).promise.then(function(){
            console.log('Page rendered');
          });
          page.getTextContent().then(function(text){
              console.log(text);
          });
        });
        })(i+1);
      }

		});
	};
 
	fileReader.readAsArrayBuffer(file);
   

});

var curWidth = 90;
function zoomIn(){
    if (curWidth < 150) {
        curWidth += 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomOut(){
    if (curWidth > 20) {
        curWidth -= 10;
        document.querySelector("#zoom-percent").innerHTML = curWidth;
        document.querySelectorAll(".page").forEach(function(page){

            page.style.width = curWidth + "%";
        });
    }
}
function zoomReset(){

    curWidth = 90;
    document.querySelector("#zoom-percent").innerHTML = curWidth;
   
    document.querySelectorAll(".page").forEach(function(page){
      page.style.width = curWidth + "%";
    });
}
document.querySelector("#zoom-in").onclick = zoomIn;
document.querySelector("#zoom-out").onclick = zoomOut;
document.querySelector("#zoom-reset").onclick = zoomReset;
window.onkeypress = function(e){
    if (e.code == "Equal") {
        zoomIn();
    }
    if (e.code == "Minus") {
        zoomOut();
    }
};
</script>

<!-- on off -->
<script>
        function switch_status(status_lesson) {
            // alert(budget);
            var checkBox = document.getElementById(status_lesson);
            var onoff;

            if (checkBox.checked == true) {
                onoff = "True";
            } else {
                onoff = "False";
            }
            //alert(onoff);

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('switch_lesson')}}",
                method: "GET",
                data: {
                    onoff: onoff,
                    status_lesson: status_lesson,
                    _token: _token
                }
            })
        }
</script>

<script>  
    $(document).ready(function () {
         $('#ID_LESSON_GROUP').select2();
    });
</script>

<!-- preview video -->
<script src="/ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script type="text/javascript" >
$(function () {
    $("#upvideo_add").on("change",function(){
    var file = this.files[0]; // เก็บค่าเป็น  flistlist object
    var video_type = file.type; // ตรวจสอบประเภท video
    var video_canplay=$("#preview_video_add")[0].canPlayType(video_type);// ตรวจสอบว่า ถ้าประเภทไฟล์นี้ สามารถแสดง video ได้หรือไม่
    // ถ้าสามารถแสดงได้
        if(video_canplay){// กำหนด url object อ้างอิงขึ้นกับ browservar URL = window.URL || window.webkitURL;var fileURL = URL.createObjectURL(file); // สร้าง url object$("#preview_video")[0].src = fileURL;  // แสดง video จาก url 
            var URL = window.URL || window.webkitURL;
            var fileURL = URL.createObjectURL(file); // สร้าง url object
            $("#preview_video_add")[0].src = fileURL;  // แสดง video จาก url 
        }else{
            // can't play
        } 
    });
});
</script>

<!-- css, js dataTables --> 
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


<script src="{{ asset('select2/select2.min.js') }}"></script>

 @endsection




