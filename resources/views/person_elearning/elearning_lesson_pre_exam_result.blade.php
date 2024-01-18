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
            <h3 class="block-title text-center fs-24"> ผลการทดสอบก่อนเรียน : {{$info_lesson->NAME_LESSON}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
    <div class="row">
        <div class="col-md-1">
            <span><a href="{{ url('e_learning/lesson_pre_exam/'.$info_lesson->ID_LESSON) }}"><button type="submit" class="btn btn-hero-sm btn-hero-warning foo14 loadscreen" ><i class="fas fa-angle-left mr-1"></i></button></a></span> 
        </div>
        <div class="col-md-11" align = 'right'>
            <span><a href="{{ url('e_learning/lesson_video/'.$info_lesson->ID_LESSON) }}" ><button type="submit" class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fa fa-arrow-right mr-2"></i>ถัดไป</button></a></span> 
        </div>
    </div>
    
        
        <div class="block-content my-3 shadow">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-12 col-md-8 text-center">
                    <label for="" class="text-center" style=" font-size: 30px; color: #D8B384; text-shadow: 0 0 0.4em #FFD56B"><i class="fas fa-check-circle mr-1 "></i> ทำแบบทดสอบก่อนเรียนสำเร็จแล้ว เข้าสู่บทเรียนกัน!! </label><br>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <center>
                    @if($info_sum > 1)
                    <img  alt="ไม่ได้อัปโหลดรูปภาพ" width="70%" src="{{asset('image/elearning_question/pass.png') }}">
                    @else
                    <img  alt="ไม่ได้อัปโหลดรูปภาพ" width="70%" src="{{asset('image/elearning_question/fail.png') }}">
                    @endif
                </center>                
                </div> 
            </div>
            <div class="row">
                <div class="col-2 col-md-3"></div>
                <div class="col-8 col-md-6">
                    <div class="block" style="background-color: #FFF0F0;  border-radius: 25px;">                     
                        
                    <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <br>
                                <label for="" class="fs-24">ผลการทดสอบก่อนเรียน</label>
                            </div> 
                        </div>
                                        
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-6 col-md-5">
                                @if($info_sum > 1)
                                    <h2><label for="" class="fs-20">สถานะ : &nbsp;&nbsp;<span class="text-success" style="font-size: 32px; text-shadow: 0 0 0.2em #8F7">ผ่าน !!</span></label></h2>
                                @else
                                    <h2><label for="" class="fs-20">สถานะ : &nbsp;&nbsp;<span class="text-danger" style="font-size: 32px; text-shadow: 0 0 0.2em #FF9A8C">ไม่ผ่าน !!</span></label></h2>                    
                                @endif 
                            </div> 
                            <div class="col-6 col-md-4" align="right">
                                @if($info_sum > 1)
                                    <h2><label for="" class="fs-20">คะเเนน : &nbsp;&nbsp;<span class="text-success" style="font-size: 28px; text-shadow: 0 0 0.2em #8F7">{{$info_sum}}</span></label></h2>
                                @else
                                    <h2><label for="" class="fs-20">คะเเนน : &nbsp;&nbsp;<span class="text-danger" style="font-size: 28px; text-shadow: 0 0 0.2em #FF9A8C">{{$info_sum}}</span></label></h2>                    
                                @endif   
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
    <script src="{{ asset('asset/js/pages/be_ui_progress.min.js') }}"></script>
    <script src="{{ asset('asset/js/dashmix.core.min.js') }}"></script>

    <script src="{{ asset('asset/js/pages/be_ui_progress.min.js') }}"></script>




@endsection

