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
    .a {
        position: fixed;
    }
</style>


<div class="block mb-4 " style="width: 95%;margin: 45px;" >
    <div class="block-content">

        <div class="block-header block-header-default">
            <h3 class="block-title text-center fs-24">หมวดหมู่บทเรียน</h3>
        </div>      
    <hr> <!-- -ขีด --> <br><br><br>
   
        <div class="row">         
        <?php $i = 0; $j = 0;?>          
            @foreach ($info_lesson_group as $row) 
                        <div class="col-md-6 col-xl-3 ">
                            <a class="block block-rounded block-link-pop loadscreen " style="background:#FDF6F0;" href="{{ url('/e_learning/information_lesson/'.$row->ID_LESSON_GROU)}}">
                            <br>    
                            <center><img class="img-fluid options-item " width="200px" src="data:image/png;base64,{{ chunk_split(base64_encode($row->IMG_LESSON_GROUP)) }}" alt=""> </center>
                                <div class="block-content text-center">
                                    
                                    <p class="text-dark mb-1 text" style="font-size: 20px;">
                                       {{ $row ->NAME_LESSON_GROUP}} <br>
                                    </p>
                                    <button type="button" class="btn btn-rounded btn-hero-success text" style="font-size: 14px;"><i class="fa fa-fw fa-location-arrow mr-1"></i>เลือกบทเรียน</button><br><br>
                                    
                                </div>

                                <br>
                                <div class="block-content block-content-full text " style="background:#F6AE99">
                                    <div class="row no-gutters font-size-sm  text-center " >
                                        <div class="col-4">
                                            <span class="text-muted font-w600 text-white">
                                                <i class="fa fa-fw fa-eye mr-1"></i> {{$count_std[$i]}}
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-muted font-w600 text-white">
                                                <i class="fa fa-fw fa-coins mr-1"></i> ไม่เสียค่าใช้จ่าย
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-muted font-w600 text-white">
                                                <i class="fa fa-fw fa-book-open mr-1"></i> {{$count_lesson[$j]}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
             <?php $i++; $j++;?>     
            @endforeach
        </div> 
<br><br><br>
    </div>    
</div>



@endsection

@section('footer')

@endsection