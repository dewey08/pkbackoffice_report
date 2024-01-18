@extends('layouts.backend')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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
      
                  .form-control {
    font-size: 13px;
                  }   
      
</style>

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

$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>

<!-- Advanced Tables -->
<div class="bg-body-light">
    <div class="content">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
             <h1 style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.3rem;font-weight:normal;">{{ $inforpersonuser -> HR_PREFIX_NAME }}   {{ $inforpersonuser -> HR_FNAME }}  {{ $inforpersonuser -> HR_LNAME }}</h1> 
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">                                           
                                            <div class="row">
                                            <div>
                                             <a href="{{ url('general_suplies/dashboard/'.$inforpersonuserid -> ID) }}" class="btn btn-primary loadscreen" >Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>  



                                            <div>
                                             <a href="{{ url('general_suplies/inforequest/'.$inforpersonuserid -> ID) }}" class="btn btn-primary loadscreen" >ขอจัดซื้อ/จัดจ้าง</a>
                                            </div>
                                            <div>&nbsp;</div>  

                                         

                                            <div>
                                           <a href="{{ url('general_suplies/inforequestapp/'.$inforpersonuserid -> ID)}}" class="btn btn-success loadscreen" >เห็นชอบ
                                          
                                                <span class="badge badge-light" ></span>
                                          
                                            </a>
                                            </div>                        
                                            <div>&nbsp;</div>
                                      
                                           
            
                                            <div>
                                            <a href="{{ url('general_suplies/inforequestlastapp/'.$inforpersonuserid -> ID)}}" class="btn btn-success loadscreen" >อนุมัติ 
                                          
                                                <span class="badge badge-light" ></span>
                                          
                                            </a>  
                                            </div>           
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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ตรวจสอบความต้องการขอซื้อขอจ้างพัสดุ</B></h3>

        </div>
        <div class="block-content block-content-full">
            <form action="#" method="post">
                @csrf
                    <div class="row">  
                        <div class="col-md-0.5">
                            &nbsp;&nbsp; วันที่ &nbsp;
                        </div>
                        <div class="col-md-2">
                            <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                        </div>
                        <div class="col-md-0.5">
                            &nbsp;ถึง &nbsp;
                                </div>
                        <div class="col-md-2">
                            <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  >
                        </div> 
                        <div class="col-md-0.5">
                            &nbsp;สถานะ &nbsp;
                        </div>                            
                        <div class="col-md-2">
                            <span>                            
                                <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                    <option value="">--ทั้งหมด--</option>                            
                                </select>
                            </span>
                        </div> 
              
                        <div class="col-md-0.5">
                            &nbsp;ค้นหาชื่อ &nbsp;
                        </div>
                        <div class="col-md-2">
                            <span>                 
                                <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >
                            </span>
                        </div>               
                        <div class="col-md-30">
                            &nbsp;
                        </div> 
                        <div class="col-md-1">
                            <span>
                                <button type="submit" class="btn btn-info" >ค้นหา</button>
                            </span> 
                        </div>
                    </div>  
            </form>
        <div class="table-responsive">
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                    <tr height="40">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ลงวันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เพื่อจัดซื้อ/ซ่อมแซม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงานที่ร้องขอ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="20%">ราคาประมาณการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="10%">ตรวจสอบ</th> 
                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                    @foreach ($inforequests as $inforequest)  

                    <?php $number++;
                    
                    $status =  $inforequest -> STATUS;

                    if( $status === 'Pending'){
                       $statuscol =  "badge badge-danger";

                   }else if($status === 'Approve'){
                      $statuscol =  "badge badge-warning";

                   }else if($status === 'Verify'){
                       $statuscol =  "badge badge-info";
                   }else if($status === 'Allow'){
                       $statuscol =  "badge badge-success";
                   }else{
                       $statuscol =  "badge badge-secondary";
                   }

                    ?>
                        <tr height="20">
                        <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font" align="center">
                                    <span class="{{$statuscol}}">{{ $inforequest -> STATUS_NAME }}</span>
                            </td>
                            <td class="text-font text-pedding" >{{ DateThai($inforequest -> DATE_WANT) }}</td>
                            <td class="text-font text-pedding" >{{ $inforequest -> REQUEST_FOR }}</td> 
                            <td class="text-font text-pedding" >{{ $inforequest -> SAVE_HR_DEP_SUB_NAME }}</td> 
                            <td class="text-font" align="right" >{{ $inforequest -> BUDGET_SUM }}</td>
                            <td class="text-font text-pedding" >
                            <a href="#detail_repairnomalasset" data-toggle="modal" class="btn btn-success  fa fa-edit" onclick="detail({{ $inforequest -> ID}});"></a>
                            </td> 
                     
                        </tr> 





                    @endforeach   


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------ตรวจอสอบ---------------------------------------->   

<div id="detail_repairnomalasset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบขอซื้อขอจ้างพัสดุ&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body">
                                                <form  method="post" action="{{ route('suplies.updateinforequestver') }}" enctype="multipart/form-data">
                                                @csrf  
                                        
                                                            
                                                 <div id="detail"></div>
                                                
                                                 
                                                 <input type="hidden" name = "USER_CONFIRM_CHECK_ID"  id="USER_CONFIRM_CHECK_ID"  value="{{ $inforpersonuserid ->ID }} ">
  
                             
                                                </div>
                                                <div class="modal-footer">
                                                    <div align="right">
                                                    <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >ผ่าน</button>
                                                    <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่ผ่านการตวจสอบ</button>
                                                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>
                                                
                                                    </div>
                                                    </div>
                                                    </form>  
                                        </body>
                                            
                                            
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
            }).datepicker();  //กำหนดเป็นวันปัจุบัน
    });

 
</script>



@endsection