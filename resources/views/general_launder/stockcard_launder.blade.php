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



use App\Http\Controllers\ManagerlaunderController;

?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

?>
<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                <div class="row">
                                            <div>
                                             <a href="{{ url('general_launder/dashboard_launder/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                            <a href="{{ url('general_launder/stockcard_launder/'.$inforpersonuserid -> ID) }}" class="btn btn-success" >คลังย่อย

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                             <a href="{{ url('general_launder/withdraw_launder/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">เช็คสต๊อค-เบิกผ้า</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                             <a href="{{ url('general_launder/pay_launder/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จ่ายผ้า</a>
                                            </div>
                                            <div>&nbsp;</div>

                                          
                                            <div>&nbsp;</div>
   
                            



                                            </ol>

                </nav>
        </div>
    </div>
    </div>
    <div class="content">
    <!-- Dynamic Table Simple -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>คลังย่อย</B></h3>

        </div>
        <div class="block-content block-content-full">
      
        <form action="{{ route('gen_launder.stockcard_laundersearch',[ 'iduser'=>$inforpersonuserid->ID ]) }}" method="post">
                @csrf
                    <div class="row">  
                                
              
                        <div class="col-md-0.5">
                            &nbsp;ค้นหา &nbsp;
                        </div>
                        <div class="col-md-2">
                            <span>                 
                                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
                            </span>
                        </div>               
                        <div class="col-md-30">
                            &nbsp;
                        </div> 
                        <div class="col-md-1">
                            <span>
                                <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ค้นหา</button>
                            </span> 
                        </div>
                    </div>  
            </form>
     
        <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #F08080;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รับเข้า</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จ่ายออก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >คงเหลือ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%">เรียกดู</th> 
                            
                        </tr >
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                    @foreach ($infotreasurys as $infotreasury)
                        <tr height="20">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >{{$infotreasury->LAUNDER_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infotreasury->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerlaunderController::sumtreasuryreceive($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerlaunderController::sumtreasurypay($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP))}}</td>
                        <td class="text-font text-pedding" style="text-align: center;">{{number_format(ManagerlaunderController::sumtreasuryreceive($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP)-ManagerlaunderController::sumtreasurypay($infotreasury->LAUNDER_DIS_SUB_TYPE,$infotreasury->LAUNDER_DIS_DEP))}}</td>
                       
                     
 
                     
                        
                        <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                <div class="dropdown-menu" style="width:10px">
                              
                                <a class="dropdown-item" href="{{ url('general_launder/stockcard_launder_sub/'.$infotreasury->LAUNDER_DIS_SUB_TYPE.'/'.$infotreasury->LAUNDER_DIS_DEP.'/'.$inforpersonuserid->ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">เรียกดู</a>
                                <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">รายละเอียด</a>
                                </div>
                                </div>
                            </td> 
                        
                        </tr>
                        <?php  $count++;?>

                        @endforeach 


                      
                  

                    </tbody>
                </table>
                <br>
               

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
           url:"{{route('warehouse.detailappall')}}",
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
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });


</script>



@endsection
