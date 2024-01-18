@extends('layouts.backend')



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


?>
<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

            p {
	
                word-wrap:break-word;
                }
                .text{
                    font-family: 'Kanit', sans-serif;
                     
                }
</style>
         <!-- Advanced Tables -->
         <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <div class="row">
                         
                              
                                <div >
                                <a href="{{ url('person_guesthouse/guesthouse_info/'.$id_user)}}" class="btn btn-info" >รายละเอียดบ้านพัก</a>
                                </div>
                                <div>&nbsp;</div>
                                <div>
                                        <a href="{{ url('person_guesthouse/guesthouse_petition/'.$id_user)}}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">         
                                        ยื่นคำร้อง
                                        </a>
                                    </div>
                                <div>&nbsp;</div>

                                </div>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="content">
                <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดบ้านพัก</B></h3>
                 
            </div>
            <div class="block-content">

                                         

            <div class="row push">
                    <div class="col-lg-4">

                    <div class="form-group">                         
                        @if($infoguesthouse->IMG == '' || $infoguesthouse->IMG ==null)
                            <img src="{{ asset('image/default.jpg')}}" alt="Image" class="img-thumbnail" id="image_upload_preview" alt="กรุณาเพิ่มรูปภาพ" height="300px" width="200px"/>
                        @else
                            <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoguesthouse->IMG)) }}" id="image_upload_preview"   height="300px" width="300px"/>
                        @endif
                    </div>
                                
                    </div>



                    <div class="col-sm-8">
                    <div class="row push">

                    <div class="col-sm-2">
                    <label>อ้างถึงอาคาร :</label>
                    </div> 
                    <div class="col-lg-9 ">              
                        {{$infoguesthouse->LOCATION_NAME}}
                    </div> 

                    </div>
                    <div class="row push">
                    <div class="col-sm-2">
                    <label>ชื่ออาคาร :</label>
                    </div> 
                    <div class="col-lg-10 ">
                    {{$infoguesthouse->INFMATION_NAME}}
                    </div> 

                    </div>
                    <div class="row push">
                    <div class="col-sm-2">
                    <label>ประเภทที่พัก :</label>
                    </div> 
                    <div class="col-lg-4 ">

                    @if($infoguesthouse->INFMATION_TYPE == '1')
                            แฟลต
                    @else
                            บ้านพัก
                    @endif

                    </div> 

                    <div class="col-sm-2">
                    <label>สถานะ :</label>
                    </div> 
                    <div class="col-lg-4">
                 
                    @if($infoguesthouse->INFMATION_STATUS == '1')
                            ปกติ
                    @elseif($infoguesthouse->INFMATION_STATUS == '2')
                            ปิดปรับปรุง
                    @elseif($infoguesthouse->INFMATION_STATUS == '3')
                            ซ่อมแซม
                    @else
                            ปิด
                    @endif
               
                    </div>  

                    </div>



            <div class="row push">


                    <div class="col-sm-2">
                    <label>ผู้รับผิดชอบ :</label>
                    </div> 
                    <div class="col-lg-4">
                    {{$infoguesthouse->HR_FNAME}} {{$infoguesthouse->HR_LNAME}}
                    </div>

                    <div class="col-sm-2">
                    <label>ติดต่อ :</label>
                    </div> 
                    <div class="col-lg-4">
                    {{$infoguesthouse->INFMATION_HR_TEL}}
               
                    </div>
           </div>

           <div class="row push">


                    <div class="col-sm-2">
                    <label>สถานะเข้าพัก :</label>
                    </div> 
                    <div class="col-lg-10">
                    ว่าง
                    </div>

              
           </div>
                

        </div>
         
        </div>
   

    <script src="{{ asset('google/Charts.js') }}"></script>


@endsection