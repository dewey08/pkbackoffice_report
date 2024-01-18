@extends('layouts.elearning')
@section('content')
<style>
    body * {
        font-family: 'Kanit', sans-serif;
    }
    p {
        word-wrap: break-word;
    }
    .text {
        font-family: 'Kanit', sans-serif;
    }
    .button1 {
    border: none;
    color: white;
    padding: 15px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 2px 2px;
    font-size: 17px;
    }
</style>


<style>
    .body{
        font-family: 'Kanit', sans-serif;
    }
    .p {
        word-wrap: break-word;
    }
    .text {
        font-family: 'Kanit', sans-serif;
    }
    .button1 {
    border: none;
    color: white;
    padding: 15px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 2px 2px;
    font-size: 17px;
    }

</style>

<div class="block  " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text text-center fs-24"> {{$info_lesson->NAME_LESSON}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
        <div class="row">
            <div class="col-md-1">
                <span><a href="{{ url('e_learning/information_lesson/'.$info_lesson->ID_LESSON_GROUP) }}"><button type="submit" class="btn btn-hero-sm btn-hero-warning foo14 loadscreen" ><i class="fas fa-angle-left mr-1"></i></button></a></span> 
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-2"align = 'right'>
                <a href="{{ url('e_learning/lesson_pre_exam/'.$info_lesson->ID_LESSON) }}"><button type="submit" class="btn  btn-hero-success text button1 fs-36 loadscreen"><i class="fas fa-book-reader mr-1"></i>เริ่มเรียน</button></a> 
            </div>
            
        </div>
    
        
        <div class="block-content  shadow"><br>

            <div class="row">
                <div class="col-md-6 col-xl-6 "> 
                        <img width="100%"  height="450px" src="data:image/png;base64,{{ chunk_split(base64_encode($info_lesson->IMG_LESSON)) }}">
                </div>
                <div class=" col-md-6 col-xl-6 text">
                <div class="block block-themed ">
                                <div class="block-content"  style="padding:3px 15px 3px 10px;background-color: #FFF5E1"> <!--อ่อน  F4EEED-->
                                   <h3 class="block-title text  fs-28"> <b>ข้อมูลบทเรียน</b></h3>
                                </div>

                                <div class="block-header " style="background-color: #CA965C; padding:3px 15px 3px 10px;"> <!--เข้ม  D8AC9C-->
                                    <h3 class="block-title text fs-20">แบบทดสอบก่อนเรียน</h3>
                                </div>
                                <div class="block-content " style="background-color: #FFF5E1; padding:7px 15px 0px 10px;">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p class="fs-18"><i class="fa fa-1x fa-lock " ></i>&nbsp; แบบทดสอบก่อนเรียน </p>
                                        </div>
                                        <div class="col-md-5" align = 'right'>
                                            <span class="badge badge-success text fs-18"  >{{$num_exam}} คำถาม</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="block-header " style="background-color: #CA965C; padding:3px 15px 3px 10px;">
                                    <h3 class="block-title text fs-20">{{$info_lesson->NAME_LESSON}}</h3>
                                </div>
                                <div class="block-content " style="background-color: #FFF5E1;padding:7px 15px 0px 10px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="fs-18"><i class="fa fa-1x fa-lock "></i>&nbsp; {{$info_lesson->NAME_LESSON}} </p>
                                        </div>
                                        <div class="col-md-4" align = 'right'>
                                            <h5 class="text fs-18"> {{$info_lesson->TIME_LESSON}} </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="block-header " style="background-color: #CA965C; padding:3px 15px 3px 10px;">
                                    <h3 class="block-title text fs-20">แบบทดสอบหลังเรียน</h3>
                                </div>
                                <div class="block-content " style="background-color: #FFF5E1;padding:7px 15px 3px 10px;">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p class="fs-18"><i class="fa fa-1x fa-lock "></i>&nbsp; แบบทดสอบหลังเรียน </p>
                                        </div>
                                        <div class="col-md-5"align = 'right'>
                                            <span class="badge badge-success text fs-18" >{{$num_exam}} คำถาม</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="block-header " style="background-color: #CA965C;padding:3px 15px 3px 10px;">
                                    <h3 class="block-title text fs-20">เอกสารประกอบการเรียน</h3>
                                </div>
                                <div class="block-content " style="background-color: #FFF5E1; padding:7px 15px 3px 10px;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="fs-18"><i class="fa fa-1x fa-download "></i>&nbsp; {{$info_lesson->NAME_LESSON}}.pfd </p>
                                        </div>
                                        <div class="col-md-4" align = 'right'>
                                            <a href="{{ asset('storage/lesson_doc/'.$info_lesson->DOCUMENT_LESSON) }}" target="_blank"><p align = 'right'><button type="submit" class="btn btn-hero-sm btn-hero-danger fs-16 text" ><i class="fas fa-download mr-1"></i>ดาวน์โหลด</button></p></a>
                                        </div>
                                    </div>
                                </div>     
                            </div>     
                </div>
                <br><br>
            </div>
<br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text">
                            <div class="block block-rounded block-bordered fs-18">
                                <ul class="nav nav-tabs nav-tabs-block bg-info-lighter" data-toggle="tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#btabs-animated-slideup-objective">วัตถุประสงค์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#btabs-animated-slideup-details">รายละเอียด</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#btabs-animated-slideup-teach">ผู้สอน</a>
                                    </li>
                                    
                                </ul>
                                <div class="block-content tab-content overflow-hidden">
                                    <div class="tab-pane fade fade-up show active" id="btabs-animated-slideup-objective" role="tabpanel">
                                        <p style="text-indent: 2.5em;">{{$info_lesson-> OBJECTIVE_LESSON}}</p>
                                    </div>
                                    <div class="tab-pane fade fade-up" id="btabs-animated-slideup-details" role="tabpanel">
                                         <p style="text-indent: 2.5em;">{{$info_lesson-> DETAIL_LESSON}}</p>
                                    </div>
                                    <div class="tab-pane fade fade-up" id="btabs-animated-slideup-teach" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-5" >
                                                    <br><br>            
                                                    <p>{{$info_lesson-> TEACH_LESSON}}</p>
                                                </div>
                                                <div class="col-md-5" >
                                                    @if($info_lesson->TEACH_IMG_LESSON == '' || $info_lesson->TEACH_IMG_LESSON == null)
                                                    @else
                                                    <img  width="100px"  height="100px" src="data:image/png;base64,{{ chunk_split(base64_encode($info_lesson->TEACH_IMG_LESSON)) }}">
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
</div>
@endsection


@section('footer')
<!-- css, js dataTables --> 
    <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>

@endsection

