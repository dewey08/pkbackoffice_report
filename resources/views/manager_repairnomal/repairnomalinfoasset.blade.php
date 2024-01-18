@extends('layouts.repairnomal')
   
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


            .form-control {
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
            }

            
table, td, th {
            border: 1px solid black;
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
  function formateDatetime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));

    $H= date("H",strtotime($strDate));
    $I= date("i",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];

  return  "$strDay $strMonthThai $strYear $H:$I";
    }

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

?>
<center>    
     <div class="block" style="width: 95%;">

                             <!-- Dynamic Table Simple -->
                             <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ทะเบียนครุภัณฑ์</B></h3>
                            
                        </div>
                        <div class="block-content block-content-full">
                        <form action="" method="post">
@csrf

<div class="row">           
<div class="col-md-9">
&nbsp;
</div>
<div class="col-md-3">

</div>
</div>

             <div class="table-responsive"> 
                           
                            <table class="table-striped table-vcenter js-dataTable-full" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                <tr height="40">
                                      <th style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">ลำดับ</th>
                                       
                                       <th  class="text-font"  style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="5%">ปีงบ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="10%">เลขครุภัณฑ์</th>    
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="10%">วันที่รับเข้า</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="18%">ประเภทครุภัณฑ์</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="18%">ชื่อ</th>
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%"> ประจำอยู่หน่วยงาน</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">ความเสี่ยง</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">การเบิกใช้</th> 
                                     
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">สถานะ</th> 
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;" width="8%">หน่วยงานขอยืม</th> 
                                       
                                       <th  class="text-font" style="border-color:#F0FFFF;text-align: center;font-family: 'Kanit', sans-serif;border: 1px solid black;"  width="12%">คำสั่ง</th>   
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                

                                <?php $number = 0; ?>
                                @foreach ($repairnomalinfoassets as $infoasset)
                                <?php $number++; ?>

                                <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>
                                        <td class="text-font" align="center">{{ $infoasset->YEAR_ID }}</td>
                                        <td class="text-font text-pedding" align="left">{{ $infoasset->ARTICLE_NUM }}</td>
                                        <td class="text-font text-pedding" align="center">{{ DateThai($infoasset->RECEIVE_DATE) }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->DECLINE_NAME }}</td>
                                        <td class="text-font text-pedding">{{ $infoasset->ARTICLE_NAME }}</td>
                                        <td class="text-font text-pedding" >{{ $infoasset->HR_DEPARTMENT_SUB_SUB_NAME }}</td>

                                        

                                        @if( $infoasset->RISK_TYPE_ID == '0')
                                        <td align="center" ><span class="badge badge-info" >ต่ำ</span></td>
                                         @elseif($infoasset->RISK_TYPE_ID== '1')
                                        <td align="center" ><span class="badge badge-success" >กลาง</span></td>
                                        @elseif($infoasset->RISK_TYPE_ID == '2')
                                        <td align="center" ><span class="badge badge-danger" >สูง</span></td>
                                        @else
                                        <td align="center" ></td>
                                        @endif


                                        @if( $infoasset->OPENS == 'True')
                                        <td class="text-font" align="center" ><span class="btn btn-hero-sm btn-hero-success"><i class="fa-xs fa fa-check"></i> </span></td>
                                        @else
                                        <td class="text-font" align="center" ></td>
                            
                                        @endif


                                         @if($infoasset->STATUS_ID == 4)
                                        <td class="text-font" align="center">ถูกยืม</td>
                                        @elseif($infoasset->STATUS_ID == 3)
                                        <td class="text-font" align="center">รอจำหน่าย</td>
                                        @elseif($infoasset->STATUS_ID == 2)
                                        <td class="text-font" align="center">จำหน่ายแล้ว</td>
                                        @else
                                        <td class="text-font" align="center">ปกติ</td>
                                        @endif


                                        <td class="text-font text-pedding" align="left">{{ $infoasset->DEP_SUB_SUB_NAME }}</td>

                                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px"> 
                                                <a class="dropdown-item"  href="#detail_repairnomalasset"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" onclick="detail({{$infoasset->ARTICLE_ID}});">รายละเอียด</a>
                                                <a class="dropdown-item" href="{{ url('manager_repairnomal/repairnomalinfoasset/repair/'.$infoasset-> ARTICLE_ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">การบำรุงรักษา</a>

                                                   
                                                </div>
                                        </div>
                                        </td>     

                                    </tr>


                                    @endforeach  
                                    
                                    <div id="detail_repairnomalasset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            
                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดครุภัณฑ์&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                                    
                                        
                                                            
                                                 <div id="detail"></div>
                                                
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                <div align="right">
                                            
                                                <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" style="font-family: \'Kanit\', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;"><i class="fas fa-window-close mr-2"></i>ปิดหน้าต่าง</button>
                                                </div>
                                                </div>
                                                </form>  
                                        </body>
                                            
                                            
                                            </div>
                                            </div>
                                        </div>
                                   
                                </tbody>
                            </table>

                        </div>
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>

    
function detail(id){


$.ajax({
           url:"{{route('mrepairnomal.detailrepairnomalasset')}}",
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


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection