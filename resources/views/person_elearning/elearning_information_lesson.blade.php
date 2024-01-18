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



<br>
<br>
<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24"> {{$info_group->NAME_LESSON_GROUP}}</h3>
        </div>      
    <hr> <!-- -ขีด -->
    <div class="row">
        <div class="col-6 col-md-1">
            <span><a href="{{ url('e_learning/information_group') }}"><button type="submit" class="btn btn-hero-sm btn-hero-warning foo14 loadscreen" ><i class="fas fa-angle-left mr-1"></i></button></a></span> 
        </div>
        <!-- <div class="col-md-8"></div>
        <div class="col-6 col-md-2">
            <span><input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value=""></span>
        </div>
        <div class="col-4 col-md-1">
            <span><button type="submit" class="btn btn-hero-sm btn-hero-info foo14" ><i class="fas fa-search mr-2"></i>ค้นหา</button></span> 
        </div> -->
    </div>
    
                            
                           

        
        <div class="block-content my-3 shadow"><br>

        <div class="row">        
            <?php $i = 0; $j = 0;?>          
            @foreach ($info_lesson as $row) 
            <div class="col-md-6 col-xl-3">
                            <a class="block block-rounded block-link-pop loadscreen" style="background:#F0ECE3" href="{{ url('/e_learning/lesson_detail/'.$row->ID_LESSON)}}">
                            <br>    
                            <center><img class="img-fluid options-item " width="200px" height="50%"  src="data:image/png;base64,{{ chunk_split(base64_encode($row->IMG_LESSON)) }}" alt=""> </center>
                                <div class="block-content text-center">
                                    
                                    <p class=" text-dark mb-1 text"  style="font-size: 18px;">
                                         {{ $row ->NAME_LESSON}} <br>
                                    </p>
                                    <button type="button" class="btn btn-rounded btn-hero-success text"><i class="fa fa-fw fa-book-reader mr-1"></i> เข้าสู่บทเรียน</button><br><br>
                                    
                                </div>
                                <div class="block-content block-content-full text" style="background:#C1AC95">
                                    <div class="row no-gutters font-size-sm  text-center">
                                        <div class="col-4">
                                            <span class="text-muted font-w600 text-white">
                                                <i class="fa fa-fw fa-eye mr-1"></i> {{$count_std[$j]}}
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-muted font-w600 text-white">
                                                <i class="fa fa-fw fa-clock mr-1"></i> {{ $row ->TIME_LESSON}}
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-muted font-w600 text-white">
                                                <i class="fa fa-fw fa-file-signature mr-1"></i> {{$num_exam[$i]}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div><br>
            <?php $i++; $j++;?>     
            @endforeach
                   
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

