@extends('layouts.guesthouse')   
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
        font-size: 14px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
           
        } 
        @media only screen and (min-width: 1200px) {
    label {
        float:right;
    }
        }        
        .text-pedding{
    padding-left:10px;
                        }

            .text-font {
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

?>
         
<center>    
    <div class="block mt-5" style="width: 95%;" >
        <div class="block block-rounded block-bordered">
               
            <div class="block-header block-header-default">
                <h3 class="block-title text-left " style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดบ้านพัก</B></h3>
                <a href="{{ url('manager_guesthouse/guesthouseinfomation_add')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen" ><i class="fas fa-plus"></i> เพิ่มข้อมูลบ้านพัก</a>
            </div>
                     
            <div class="block-content shadow-lg">
            <div class="row" > 

            @foreach ($infoinfomations as $infoinfomation) 

                   @if($infoinfomation->INFMATION_TYPE == 1)



                    <div class="col-md-6 col-xl-4">
                            <!-- Story #1 -->
                            <a href="{{ url('manager_guesthouse/guesthouserequestdetail_flat/'.$infoinfomation->INFMATION_ID.'/checkperson')}}" class="block block-rounded loadscreen"  href="javascript:void(0)">

                                <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }});">
                                    <p>
                                    <span class="btn btn-hero-sm btn-hero-info foo15">
                                    {{$infoinfomation->INFMATION_NAME}}
                                    </span>
                                    </p>
                                <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center img-thumbnail shadow-lg">

                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }}" height="240px" width="100%" >

                                    </div>



                                </div>
                            </a>
               
                        </div>
                    @else

                    <div class="col-md-6 col-xl-4 ">
                            <!-- Story #1 -->
                            <a href="{{ url('manager_guesthouse/guesthouserequestdetail_home/'.$infoinfomation->INFMATION_ID.'/checkperson')}}" class="block block-rounded loadscreen"  href="javascript:void(0)">
                               
                                <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }});" >
                                    <p>
                                    <span class="btn btn-hero-sm btn-hero-info font-w2000 p-2 text-uppercase foo15 " style=" font-size: 14px;">
                                        &nbsp;{{$infoinfomation->INFMATION_NAME}}&nbsp;
                                    </span>
                                   
                                    <?php $checkhom = DB::table('guesthous_infomation_person')->where('INFMATION_ID','=',$infoinfomation->INFMATION_ID)->where('INFMATION_PERSON_STATUS','=','1')->count(); ?>
                                                @if($checkhom !== 0)
                                                <span class="btn btn-hero-sm btn-hero-danger font-w2000 p-2 text-uppercase foo15" style=" font-size: 14px;">
                                                    &nbsp;ไม่ว่าง&nbsp;
                                                </span>
                                                @else
                                                <span class="btn btn-hero-sm btn-hero-success font-w2000 p-2 text-uppercase foo15" style=" font-size: 14px;">
                                                    &nbsp; ว่าง &nbsp;
                                                 
                                                </span>
                                                @endif
                                    {{-- </span> --}}
                                    </p>
                                <div class="mb-3 mb-sm-3 d-sm-flex justify-content-sm-between align-items-sm-center img-thumbnail shadow-lg">

                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($infoinfomation->IMG)) }}" height="240px" width="100%">

                                    </div>



                                </div>
                            </a>
                            <!-- END Story #1 -->
                        </div>

               

                    @endif

                    
            @endforeach     

                  

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


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
              //alert("Hello! I am an alert box!!");
           }
            
   })
    
}


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection