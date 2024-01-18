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

</style>

<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24"> {{$info_lesson->NAME_LESSON}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
    <div class="row">
        <div class="col-md-1">
            <span><a href="{{ url('e_learning/lesson_pre_exam/'.$info_lesson->ID_LESSON) }}"><button type="submit" class="btn btn-hero-sm btn-hero-warning foo14 loadscreen" ><i class="fas fa-angle-left mr-1"></i></button></a></span> 
        </div>
        <div class="col-md-10">
            <br>
             <!-- <div class="progress push">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>             -->
        </div>
        <div class="col-md-1">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><a href="{{ url('e_learning/lesson_post_exam/'.$info_lesson->ID_LESSON) }}" ><button type="submit" class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fa fa-arrow-right mr-2"></i>ถัดไป</button></a></span> 
        </div>
    </div>
    
        
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-6 col-md-10"> 
                    <!-- <iframe width="1150" height="650" src="https://www.youtube.com/embed/CEdDHZ4oNzQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    <video src="{{ asset('storage/lesson_video/'.$info_lesson->VIDEO_LESSON) }}" controls width="1150" height="650" ></video>
                    </div>
            </div>
<br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                            <div class="block block-rounded block-bordered text fs-18">
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
                                                    <p style="text-indent: 2.5em;">{{$info_lesson-> TEACH_LESSON}}</p>
                                                </div>
                                                <div class="col-md-5" >
                                                @if($info_lesson->TEACH_IMG_LESSON == '' || $info_lesson->TEACH_IMG_LESSON == null)
                                                    @else
                                                    <img  width="100px" src="data:image/png;base64,{{ chunk_split(base64_encode($info_lesson->TEACH_IMG_LESSON)) }}">
                                                    @endif                                                </div>
                                               
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

