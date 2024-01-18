@extends('layouts.launder')   
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
    font-size: 13px;
                  }   
      
      
      .form-control{
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

?>
<?php
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');

        use App\Http\Controllers\ManagerlaunderController;     
?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div  style="width: 95%;">

    @if($type == 'receive')
        <div class="block-header block-header-default">
                    <h4 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลรับผ้า ประจำวันที่ {{DateThai($date)}} </B></h4>
                    <a href="{{ url('manager_launder/launder_getre')}}"   class="btn btn-hero-sm btn-hero-success" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
        </div>      
    @elseif( $type == 'check')
        <div class="block-header block-header-default">
                    <h4 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลตรวจรับผ้า ประจำวันที่ {{DateThai($date)}}</B></h4>
                    <a href="{{ url('manager_launder/launder_getre')}}"   class="btn btn-hero-sm btn-hero-success" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
        </div>      
    @else

        <div class="block-header block-header-default">
                    <h4 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลส่งผ้า ประจำวันที่ {{DateThai($date)}}</B></h4>
                    <a href="{{ url('manager_launder/launder_getre')}}"   class="btn btn-hero-sm btn-hero-success" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
        </div>   

    @endif
    <br>
     
    <div class="row" > 

    @foreach ($infodepuseds as $infodepused)  
 
        <div class="col-6 col-md-4 col-xl-3">
                @if($type == 'receive')
                                <a class="block block-link-pop text-center" href="{{ url('manager_launder/laundergetback_add/'.$type.'/'.$infodepused->LAUNDER_DEP_CODE)}}">
                @elseif( $type == 'check')   
                                <a class="block block-link-pop text-center" href="{{ url('manager_launder/laundercheck_add/'.$type.'/'.$infodepused->LAUNDER_DEP_CODE)}}">
                @else  
                                <a class="block block-link-pop text-center" href="{{ url('manager_launder/launderdisburse_add/'.$type.'/'.$infodepused->LAUNDER_DEP_CODE)}}">
                @endif                 
                                <div class="block-content block-content-full aspect-ratio-4-3 d-flex justify-content-center align-items-center">
                                    <div>
                                      
                       

                                        @if($type == 'receive')
                                           <div class="font-w600 mt-2 text-danger" style="font-size: 60px;">{{$infodepused->LAUNDER_DEP_NAMECODE}}</div>
                                           <div style="font-size: 15px;">{{$infodepused->LAUNDER_DEP_NAME}}</div>
                                            <div class="font-w600 mt-2 text-dark" style="font-size: 15px;">รับผ้า {{ManagerlaunderController::amount1($infodepused->LAUNDER_DEP_CODE)}} ครั้ง <br> ผ้าปนเปื้อน {{ManagerlaunderController::weight1($infodepused->LAUNDER_DEP_CODE)}} กก. <br> ผ้าติดเชื้อ {{ManagerlaunderController::weight2($infodepused->LAUNDER_DEP_CODE)}} กก.</div>
                                        @elseif( $type == 'check')
                                             <div class="font-w600 mt-2 text-warning" style="font-size: 60px;">{{$infodepused->LAUNDER_DEP_NAMECODE}}</div>
                                             <div style="font-size: 15px;">{{$infodepused->LAUNDER_DEP_NAME}}</div>
                                             <div class="font-w600 mt-2 text-dark" style="font-size: 15px;">ตรวจรับผ้า {{ManagerlaunderController::amount2($infodepused->LAUNDER_DEP_CODE)}} ครั้ง,ล่าสุด {{ManagerlaunderController::amountsub1($infodepused->LAUNDER_DEP_CODE)}} ชุด</div>
                                        @else
                                            <div class="font-w600 mt-2 text-success" style="font-size: 60px;">{{$infodepused->LAUNDER_DEP_NAMECODE}}</div>
                                            <div style="font-size: 15px;">{{$infodepused->LAUNDER_DEP_NAME}}</div>
                                            <div class="font-w600 mt-2 text-dark" style="font-size: 15px;">ส่งผ้า {{ManagerlaunderController::amount3($infodepused->LAUNDER_DEP_CODE)}} ครั้ง,ล่าสุด {{ManagerlaunderController::amountsub2($infodepused->LAUNDER_DEP_CODE)}} ชุด</div>
                                        @endif



                                    </div>
                                </div>
                            </a>
        </div>

     
        @endforeach  


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

    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true                         //Set เป็นปี พ.ศ.
        });  //กำหนดเป็นวันปัจุบัน
        });

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

        function chkmunny(ele){
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
        ele.onKeyPress=vchar;
        }
</script>

@endsection