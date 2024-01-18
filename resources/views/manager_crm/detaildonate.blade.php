@extends('layouts.crm')   
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

    use App\Http\Controllers\ManagercrmController;
?>        
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">

          
            
             <div class="block-header block-header-default">
                    <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดบริจาค</B></h3>
                    &nbsp;&nbsp;
              
                    <a href="{{ url('manager_crm/persondonate')  }}"   class="btn btn-hero-sm btn-hero-success foo15 loadscreen" ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
                </div>  


            <div class="block-content block-content-full">

              
                
            <form action="{{ route('mcradle.infocradle_save') }}" method="post">
                @csrf       

            <div class="row push">
                <div class="col-sm-2 text-right">
                    <label>ชื่อ-นามสกุล :</label>
                </div> 
                <div class="col-lg-2 text-left">            
                {{$donateinfopersons->DONATE_PERSON_NAME }}
                </div>               
                <div class="col-sm-2 text-right">
                    <label>เบอร์โทร :</label>
                </div> 
                <div class="col-lg-2 text-left">
                {{ $donateinfopersons->DONATE_PERSON_TEL }}
                </div>
                <div class="col-sm-2 text-right">
                    <label>ไลน์ :</label>
                </div> 
                <div class="col-lg-2 text-left">
                {{ $donateinfopersons->DONATE_PERSON_LINE }}
                </div>


            </div>

            <div class="row push">
                <div class="col-sm-2 text-right">
                    <label>อีเมล :</label>
                </div> 
                <div class="col-lg-2 text-left">            
                {{ $donateinfopersons->DONATE_PERSON_EMAIL }}
                </div>               
                <div class="col-sm-2 text-right">
                    <label>เลขผู้เสียภาษี :</label>
                </div> 
                <div class="col-lg-2 text-left">
                {{ $donateinfopersons->DONATE_PERSON_VAT_NO }}
                </div> 
                <div class="col-sm-2 text-right">
                    <label>เจ้าหน้าที่ :</label>
                </div> 
                <div class="col-lg-2 text-left">            
                {{$donateinfopersons->HR_FNAME }}&nbsp;&nbsp; {{$donateinfopersons->HR_LNAME }}
                </div>                 
            </div>
                        
    
    <div class="row" > 
        <div class="col-12">                          
                <div class="card-body" style="width: 100%;margin:2px;2px;2px;2px;" >                           
                    <div class="block block-rounded block-bordered">
                        <ul class="nav nav-tabs nav-tabs-info" data-toggle="tabs" role="tablist" style="background-color: #FFEBCD;">
                            <li class="nav-item">
                                <a class="nav-link active" href="#object1" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;">รายการ</a>
                            </li> 
                             
                        </ul>
                   
                <div class="block-content tab-content">
                <div class="row">
                    
                <div class="col-sm-6" align="left">
                    <a href="{{ url('manager_crm/detaildonate_add/'.$donateinfopersons->DONATE_PERSON_ID )}}" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size:12px;font-size: 1.0rem;font-weight:normal;"><i class="fa fa-plus mr-2"></i> เพิ่มรายการ</a>
                </div>  
                     <div class="col-sm-6"  align="right">   
                     มูลค่า {{  number_format(ManagercrmController::sumamount($donateinfopersons ->DONATE_PERSON_ID),2) }}  บาท   จำนวน {{  ManagercrmController::countamount($donateinfopersons ->DONATE_PERSON_ID) }} ครั้ง
                     </div>
                </div> 
                </div>  
                        <div class="tab-pane active" id="object1" role="tabpanel">  
                            <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="text-align: center;" width="10%">เล่มที่</th>
                            <th  class="text-font" style="text-align: center;" width="10%">เลขที่</th>
                            <th  class="text-font" style="text-align: center;" width="7%" >ปี พศ.</th>
                            <th  class="text-font" style="text-align: center;" >บริจาคในงาน</th>
                            <th  class="text-font" style="text-align: center;" width="7%" >ประเภท</th>
                            <th  class="text-font" style="text-align: center;" width="5%">วันที่</th>
                            <th  class="text-font" style="text-align: center;" >รายการบริจาค</th>
                            <th  class="text-font" style="text-align: center;" width="5%">จำนวน</th>
                            <th  class="text-font" style="text-align: center;" width="5%">หน่วย</th>
                            <th  class="text-font" style="text-align: center;" width="5%">ราคา</th>
                            <th  class="text-font" style="text-align: center;" width="10%">หมายเหตุ</th>                   
                            <th  class="text-font" style="text-align: center;" width="8%">ทำรายการ</th>
                         
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                        @foreach ($donatedetails as $donatedetail)
                        <?php $number++; ?>
                            <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_BOOKNO}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_NO}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_YEAR}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_WORK}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->DONATIONWEALTH_NAME}}</td>
                                <td class="text-font text-pedding" >{{DateThai($donatedetail->PERSON_DONATE_SUB_DATE)}}</td>                               
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_DETAIL}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_QTY}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->DONATIONUNIT_NAME}}</td>
                                <td class="text-font text-pedding" >{{number_format($donatedetail->PERSON_DONATE_SUB_PRICE,2)}}</td>
                                <td class="text-font text-pedding" >{{$donatedetail->PERSON_DONATE_SUB_COMENT}}</td>
                                <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                <div class="dropdown-menu" style="width:10px">                           
                                        <a class="dropdown-item"  href="{{ url('manager_crm/detaildonate_edit/'.$donatedetail->PERSON_DONATE_SUB_ID.'/'.$donatedetail->DONATE_PERSON_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไข</a>
                                        <a class="dropdown-item"  href="{{ url('manager_crm/congrat/export_pdfcongrat/'.$donatedetail->PERSON_DONATE_SUB_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  target="_blank">พิมพ์ใบรับเงินบริจาค</a>
                                        <a class="dropdown-item "  href="{{ url('manager_crm/detaildonate_destroy/'.$donatedetail->PERSON_DONATE_SUB_ID.'/'.$donatedetail->DONATE_PERSON_ID)}}"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="return confirm('คุณต้องการที่จะลบ {{ $donatedetail->PERSON_DONATE_SUB_ID}} ใช่หรือไม่ ?')">ลบ</a>
                                    </div>
                                </div>
                            </td> 
                                
                            </tr>
                        @endforeach                  
                    </tbody>
                </table>         
            </div>
        </div>
    </div>                
             
        </div>
        </div>
           
</form>
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