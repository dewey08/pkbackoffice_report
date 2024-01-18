@extends('layouts.account')   
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
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
                    }   
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

 
    use App\Http\Controllers\ManageraccountController;
    
    
?>
<?php
    function RemoveDateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    }
    function Removeformate($strDate)
    {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    
    return $strDay."/".$strMonth."/".$strYear;
    }
    
    function Removeformatetime($strtime)
    {
    $H = substr($strtime,0,5);
    return $H;
    }  

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>          
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนรายการพิมพ์เช็ค</B></h3>
                <div align="right">
                           <a href="{{ url('manager_account/account_check_add')  }}"   class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a> 
                        
                    </div>
             
            </div>
            <div class="block-content block-content-full">
            <form action="{{ route('maccount.account_check_search') }}" method="post">
                @csrf
                  
        <div class="row">

                <div class="col-sm-1">
                  &nbsp;&nbsp; วันที่ &nbsp;
                  </div>
                  <div class="col-sm-2">
                    @if($displaydate_bigen=='')
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($date) }}" readonly>
                    @else
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    @endif
                </div>
                <div class="col-sm-1">
                &nbsp;ถึง &nbsp;
                </div>
                <div class="col-sm-2">
                 @if($displaydate_end=='')
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($date) }}" readonly>
                  @else
                  <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  @endif
                </div> 
                
           


                <div class="col-sm-1">
                &nbsp;ค้นหา &nbsp;
                </div>

                <div class="col-sm-2">
                <span>

                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">

                </span>
                </div>

                <div class="col-sm-1">
                <span>
                <button type="submit" class="btn btn-info" >ค้นหา</button>
                </span> 
                </div>


         
                </form>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">เลขที่พิมพ์</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">เลขที่เช็ค</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ลงวันที่จ่ายเช็ค</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่กำหนด</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ผู้รับเงิน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">จำนวนเงิน</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="7%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                    @foreach ($infochecks as $infocheck)
                   
                        <tr height="20">
                                    <td class="text-font" align="center">{{$count}}</td>
                                    <td class="text-font text-pedding" >{{$infocheck->ACCOUNT_CHECK_NUMBER}}</td>
                                    <td class="text-font text-pedding" >{{$infocheck->ACCOUNT_CHECK_CODE}}</td>
                                    <td class="text-font text-pedding" >{{DateThai($infocheck->ACCOUNT_CHECK_OUT_DATE)}}</td>
                                    <td class="text-font text-pedding" >{{DateThai($infocheck->ACCOUNT_CHECK_SET_DATE)}}</td>
                                    <td class="text-font text-pedding" >{{$infocheck->ACCOUNT_CHECK_VENDOR}}</td>
                                    <td class="text-font text-pedding" >{{number_format($infocheck->ACCOUNT_CHECK_PICE,2)}}</td>

                                    <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                            <div class="dropdown-menu" style="width:10px">
                                        
                                            <a class="dropdown-item" href="{{ url('manager_account/account_check_edit/'.$infocheck->ACCOUNT_CHECK_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียดแก้ไข</a>
                                            <!--<a class="dropdown-item" href="{{ url('manager_account/account_check_reseve/'.$infocheck->ACCOUNT_CHECK_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  onclick="return confirm('ยืนยันการรับเช็ค ?')" >ยืนยันการรับเช็ค</a>-->
                                            <a class="dropdown-item" href="{{ url('manager_account/account_checkpdf/'.$infocheck->ACCOUNT_CHECK_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" target="_blank">พิมพ์เช็ค</a>
                                            </div>
                                            </div>
                                        </td> 
            
                        </tr>
                        <?php  $count++;?>

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
            });  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection