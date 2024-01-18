@extends('layouts.meet')
   
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
      font-size: 10px;
      font-size: 1.0rem;
      }
      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
    font-size: 14px;
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

  
?>

<center>
<div class="block" style="width: 95%;">
    <div class="content content-full">                            
       
            <div class="row">
                    @foreach ($inforooms as $inforoom)
                        <div class="col-md-4 col-xl-4">          
                            <a href="{{ url('manager_meet/managemeet_addmeet/'.$inforoom->ROOM_ID.'/'.$id_user)}}" class="block block-rounded"  href="javascript:void(0)">

                                <div class="block-content" style="background-image:url(data:image/png;base64,{{ chunk_split(base64_encode($inforoom->IMG1)) }});">
                                    <p>
                                            <span class="badge badge-info font-w2000 p-2 text-uppercase">
                                            {{$inforoom->ROOM_NAME}} :: ความจุ {{$inforoom->CONTAIN}} คน
                                            </span>
                                    </p>
                                <div class="mb-4 mb-sm-4 d-sm-flex justify-content-sm-between align-items-sm-center">
                                        <img src="data:image/png;base64,{{ chunk_split(base64_encode($inforoom->IMG1)) }}" height="200px" width="100%">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
</center>
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
    $(document).ready(function () {
                
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    todayBtn: true,
                    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                    thaiyear: true,
                    autoclose: true                         //Set เป็นปี พ.ศ.
                }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
        });


        function chkmunny(ele){
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
            ele.onKeyPress=vchar;
            }
    
    </script>
@endsection