@extends('layouts.medical')   
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
?>          
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการขอเบิกยาและเวชภัณฑ์</B></h3>
                <div align="right">
                    <a href="{{url('manager_medical/warehousemedicalwithdraw_add')}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">เบิกจากคลังหลัก</a>
                </div>
            
            </div>
            <div class="block-content ">
            <form action="{{ route('mmedical.disburse') }}" method="post">
                @csrf 
                <div class="row">

<div class="col-sm-0.5">
            &nbsp;&nbsp; ปีงบ &nbsp;
        </div>
        <div class="col-sm-1.5">
        <span>
        <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                @foreach ($budgets as $budget)
                @if($budget->LEAVE_YEAR_ID== $year_id)
                    <option value="{{ $budget->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                @else
                    <option value="{{ $budget->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                @endif                                 
            @endforeach                         
                </select>
                </span>
        </div>
        <div class="col-sm-4 date_budget">
    <div class="row">
              <div class="col-sm">
             วันที่
               </div> 
               <div class="col-sm-4">        
               <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>     
              </div>
              <div class="col-sm">
                     ถึง
               </div> 
               <div class="col-sm-4">        
               <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
              </div>
</div>
</div>
<div class="col-sm-6"><div class="row">
         <div class="col-md">
            &nbsp;สถานะ &nbsp;
        </div>
        <div class="col-md-2">
            <span>
                <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
                    <option value="">ทั้งหมด</option>
                    @foreach ($statussends as $statussend)
                  @if($statussend->STATUS_CODE == $status_check)
                      <option value="{{ $statussend->STATUS_CODE }}" selected>{{ $statussend->STATUS_NAME}}</option>
                   @else
                      <option value="{{ $statussend->STATUS_CODE  }}">{{ $statussend->STATUS_NAME}}</option>
                  @endif
              @endforeach
                      
                </select>
            </span>
        </div>

              <div class="col-sm">
                     คลัง
               </div> 
               <div class="col-sm-3 text-left">        
               <select name="INVEN_STATUS" id="INVEN_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;">
          <option value="">ทั้งหมด</option>

          @foreach ($infosuppliesinvens as $infosuppliesinven)
                  
                  @if($invenstatus_check == $infosuppliesinven->INVEN_ID)
                  <option value="{{ $infosuppliesinven->INVEN_ID }}" selected>{{ $infosuppliesinven->SETINVEN_NAME}}</option>
                   @else
                      <option value="{{ $infosuppliesinven->INVEN_ID  }}">{{ $infosuppliesinven->SETINVEN_NAME}}</option>
                  @endif
              @endforeach
            
      </select>
              </div>
              <div class="col-sm">
                     ค้นหา
               </div> 
               <div class="col-sm-3 text-left">        
               <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;font-size: 13px;" value="{{$search}}">
       
              </div>
                            
</div></div>
              <div class="col-sm">
              <button type="submit" class="btn btn-info" >ค้นหา</button>
               </div>

</div>
</form>


<div class="table-responsive"> 

<table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
    <thead style="background-color: #FFEBCD;">
        <tr height="40">
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">สถานะ</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ID</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่เบิก</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่ต้องการ</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เหตุผลขอเบิก</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">คลัง</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รพ.สต.</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่เบิก</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เจ้าหน้าที่</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่จ่าย</th>
            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">คำสั่ง</th> 
        </tr >
    </thead>
    <tbody>     
    <?php $number = 0; ?>
    @foreach ($inforwarehouserequests as $inforwarehouserequest)

    <?php $number++;

    $status =  $inforwarehouserequest -> WAREHOUSE_STATUS;

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
    <td class="text-font" align="center" style="border: 1px solid black;vertical-align: top;">{{$number}}</td>
            <td class="text-font" style="border: 1px solid black;vertical-align: top;" align="center">
                    <span class="{{$statuscol}}">{{ $inforwarehouserequest -> STATUS_NAME }}</span>
            </td>
            <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> WAREHOUSE_ID }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ $inforwarehouserequest -> WAREHOUSE_REQUEST_CODE }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ DateThai($inforwarehouserequest -> WAREHOUSE_DATE_TIME_SAVE) }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ DateThai($inforwarehouserequest -> WAREHOUSE_DATE_WANT) }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ $inforwarehouserequest -> WAREHOUSE_REQUEST_BUY_COMMENT }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ $inforwarehouserequest -> INVEN_NAME }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ $inforwarehouserequest -> WAREHOUSE_SMALLHOS_NAME }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ $inforwarehouserequest -> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">{{ $inforwarehouserequest -> WAREHOUSE_SAVE_HR_NAME }}</td>
             
        <td class="text-font text-pedding" style="border: 1px solid black;vertical-align: top;">
          
            {{ DateThai($inforwarehouserequest -> WAREHOUSE_PAYDAY) }}
         
        </td>
        
        <td class="text-font " style="border: 1px solid black;vertical-align: top;" align="center">

        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                    ทำรายการ
                </button> 
                <div class="dropdown-menu" style="width:10px">


                <a class="dropdown-item" href="#detail_appall" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="detail({{ $inforwarehouserequest -> WAREHOUSE_ID}});">รายละเอียด</a>
               
                @if($status == 'Approve')
                <a class="dropdown-item"  href="{{ url('manager_medical/medicalinfopayparcel/'.$inforwarehouserequest->WAREHOUSE_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จัดสรรวัสดุ</a>
                @endif
                @if($status == 'Verify')
                <a class="dropdown-item" href="{{ url('manager_medical/medicalinfopayparcel/'.$inforwarehouserequest->WAREHOUSE_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >แก้ไข</a>
                <a class="dropdown-item" href="#detail_lastappall{{$inforwarehouserequest -> WAREHOUSE_ID}}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="detaillast({{ $inforwarehouserequest -> WAREHOUSE_ID}});">อนุมัติ</a>
                @endif
                <a class="dropdown-item"  href="{{url('general_warehouse/infowithdrawindex_billpaypdf/'.$inforwarehouserequest->WAREHOUSE_ID.'/'.$inforwarehouserequest->WAREHOUSE_SAVE_HR_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบเบิกวัสดุ</a>
                </div>

        </td>

     

        </tr>    
         
<!-------------------------------------------------------อนุมัติ---------------------------------------->
<div id="detail_lastappall{{$inforwarehouserequest -> WAREHOUSE_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                        
                            <div class="row">
                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;อนุมัติการขอเบิกพัสดุ&nbsp;&nbsp;</h3></div>
                            </div>
                                </div>
                                <div class="modal-body" >
                               
                                <form  method="post" action="{{ route('mmedical.updatewarehouserequestlastapp') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name = "WAREHOUSE_ID"  id="WAREHOUSE_ID"  value="{{$inforwarehouserequest -> WAREHOUSE_ID}}">
                                 
                                 <div id="detaillastappall{{$inforwarehouserequest -> WAREHOUSE_ID}}"></div>

                                 
                                 <input type="hidden" name = "WAREHOUSE_TOP_LEADER_AC_ID"  id="WAREHOUSE_TOP_LEADER_AC_ID"  value="{{$id_user}} ">

                                   
                                    <label style="float:left;">ความเห็นผู้อนุมัติ</label><br>

                                    <textarea   name = "WAREHOUSE_TOP_LEADER_AC_COMMENT"  id="WAREHOUSE_TOP_LEADER_AC_COMMENT" class="form-control input-lg" ></textarea>
                                    <br>


                                </div>
                                <div class="modal-footer">
                                <div align="right">
                                <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" >อนุมัติ</button>
                                    <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" >ไม่อนุมัติ</button>
                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" >ปิดหน้าต่าง</button>

                                </div>
                                </div>
                                </form>
                        </body>


                            </div>
                            </div>
                        </div>

        @endforeach  

    </tbody>
</table>
</div>
</div>
</div>    
</div>

<!-------------------------------------------------------รายละเอียด---------------------------------------->
<div id="detail_appall" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">

                            <div class="row">
                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดขอเบิกพัสดุ&nbsp;&nbsp;</h3></div>
                            </div>
                                </div>
                                <div class="modal-body" >
                                <form  method="post" action="{{ route('suplies.updateinforequestapp') }}" enctype="multipart/form-data">
                                @csrf


                                 <div id="detail"></div>
                                </div>
                                <div class="modal-footer">
                                <div align="right">
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
url:"{{route('warehouse.detailappall')}}",
method:"GET",
data:{id:id},
success:function(result){
$('#detail').html(result);


//alert("Hello! I am an alert box!!");
}

})

}



function detaillast(id){


$.ajax({
url:"{{route('warehouse.detailappall')}}",
method:"GET",
data:{id:id},
success:function(result){
$('#detaillastappall'+id).html(result);


//alert("Hello! I am an alert box!!");
}

})

}



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
datepick();
function datepick() {
    $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true,
    todayHighlight:true,
    autoclose: true                         //Set เป็นปี พ.ศ.
    });  //กำหนดเป็นวันปัจุบัน
}
</script>

@endsection