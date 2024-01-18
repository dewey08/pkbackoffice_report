@extends('layouts.backend')
    
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">



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

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 13px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
    
    .form-control {
    font-size: 13px;
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


use Illuminate\Support\Facades\DB;

                                            
    $yearbudget = date("Y");
                                                                               

?>      
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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดแฟลต</B></h3>
         
        </div>
        <div class="block-content block-content-full">
     
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
                

        </div>


        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="20">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ห้อง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ผู้พัก</th>

                          
                        </tr >
                    </thead>
                    <tbody>  


                    

                    @foreach($infoguesthouse_levels as $infoguesthouse_level)
                    <tr height="20">
                    <td class="text-font text-pedding" colspan="4" style="background-color: #FFF8DC;" >{{$infoguesthouse_level->LOCATION_LEVEL_NAME}}</td>
                    </tr>
                    <?php 
                    $infoguesthouse_rooms = DB::table('supplies_location_level_room')->where('LOCATION_LEVEL_ID','=',$infoguesthouse_level->LOCATION_LEVEL_ID)->get();
                    ?>
                                <?php $number= 0; ?>
                                @foreach($infoguesthouse_rooms as $infoguesthouse_room)
                                <?php $number++; 
                                $checkroom = DB::table('guesthous_infomation_person')->where('LEVEL_ROOM_ID','=',$infoguesthouse_room->LEVEL_ROOM_ID)->where('INFMATION_PERSON_STATUS','=','1')->count();
                                $checkroompersons = DB::table('guesthous_infomation_person')
                                ->leftjoin('hrd_person','hrd_person.ID','=','guesthous_infomation_person.INFMATION_PERSON_HRID')
                                ->where('LEVEL_ROOM_ID','=',$infoguesthouse_room->LEVEL_ROOM_ID)->where('INFMATION_PERSON_STATUS','=','1')->get();
                                ?>
                                                <tr height="20">
                                                <td class="text-font text-pedding" style="text-align: center;">{{$infoguesthouse_room->LEVEL_ROOM_NAME}}</td>
                                                    <td class="text-font text-pedding" style="text-align: center;">
                                                         @if($checkroom !== 0)
                                                        <span class="badge badge-danger">ไม่ว่าง</span>  
                                                         @else
                                                         <span class="badge badge-success">ว่าง</span>      
                                                         @endif
                                                    </td>                                   

                                                                  <td class="text-font text-pedding" style="text-align: left;">
                                                    @foreach($checkroompersons as $checkroomperson)
                                                    {{$checkroomperson->HR_FNAME}} {{$checkroomperson->HR_LNAME}} <br>
                                                    @endforeach

                                                    </td>
                              
                                                
                                                 

                                                
                                                </tr>  
                                @endforeach

                    @endforeach
                              

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


 <!-- Page JS Plugins -->
 <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
<!-- Page JS Code -->
 <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>


<script>

$('.budget').change(function(){
             if($(this).val()!=''){
             var select=$(this).val();
             var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('admin.selectbudget')}}",
                     method:"GET",
                     data:{select:select,_token:_token},
                     success:function(result){
                        $('.date_budget').html(result);
                        datepick();
                     }
             })
            // console.log(select);
             }        
     });



   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true               //Set เป็นปี พ.ศ.
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });

    

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection