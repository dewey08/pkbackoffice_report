@extends('layouts.warehouse')   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
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
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">

        <div class="block-header block-header-default"  style="text-align: left;">
             
               
             <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายละเอียดการขอเบิกวัสดุโรงพยาบาล</B></h3>
             <div align="right">
                <a href="{{url('manager_warehouse/warehousewithdraw_add')}}"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">เบิกจากคลังหลัก</a>

<?php if($status_check == ''){$status_check = 'null';}if($invenstatus_check == ''){$invenstatus_check = 'null';}if($search == ''){$search = 'null';} ?>
<a href="{{ url('manager_warehouse/disburse_excel/'.$displaydate_bigen.'/'.$displaydate_end.'/'.$status_check.'/'.$invenstatus_check.'/'.$search) }}"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><li class="fa fa-file-excel mr-2"></li>Excel</a>
</div>
         </div>
         <?php if($status_check == 'null'){$status_check = '';}if($invenstatus_check == 'null'){$invenstatus_check = '';}if($search == 'null'){$search = '';} ?>
           
            <div class="block-content ">
            <form action="{{ route('mwarehouse.disburse') }}" method="post">
            @csrf()
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
                       

                          @foreach ($infosuppliesinvens as $infosuppliesinven)
                                  @if($infosuppliesinven->INVEN_ID == $invenstatus_check)
                                      <option value="{{ $infosuppliesinven->INVEN_ID }}" selected>{{ $infosuppliesinven->INVEN_NAME}}</option>
                                   @else
                                      <option value="{{ $infosuppliesinven->INVEN_ID  }}">{{ $infosuppliesinven->INVEN_NAME}}</option>
                                  @endif
                              @endforeach
                            
                      </select>
                              </div>
                              <div class="col-sm">
                                     ค้นหา
                               </div> 
                               <div class="col-sm-3 text-left">        
                               <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" value="{{$search}}">
                       
                              </div>                                      
        </div></div>
                              <div class="col-sm-1.5">
                            
                              <span>
                                <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;"><i class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span>
                               </div>
  
    </div>
          </form>
  
         
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ID</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่เบิก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่ต้องการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เหตุผลขอเบิก</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">คลัง</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                    @foreach ($inforwarehouserequests as $inforwarehouserequest)

                    <?php $number++;

                    $status =  $inforwarehouserequest->WAREHOUSE_STATUS;

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
                    <td class="text-font" align="center" style="border: 1px solid black;" width="5%">{{$number}}</td>
                            <td class="text-font" style="border: 1px solid black;" align="center" width="5%">
                                    <span class="{{$statuscol}}">{{ $inforwarehouserequest -> STATUS_NAME }}</span>
                            </td>
                            <td class="text-font text-pedding" style="border: 1px solid black;" width="5%">{{ $inforwarehouserequest -> WAREHOUSE_ID }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" width="7%">{{ $inforwarehouserequest -> WAREHOUSE_REQUEST_CODE }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" width="7%">{{ DateThai($inforwarehouserequest -> WAREHOUSE_DATE_TIME_SAVE) }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" width="7%">{{ DateThai($inforwarehouserequest -> WAREHOUSE_DATE_WANT) }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;">{{ $inforwarehouserequest -> WAREHOUSE_REQUEST_BUY_COMMENT }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" width="8%">{{ $inforwarehouserequest -> INVEN_NAME }}</td>

                        <td class="text-font text-pedding" style="border: 1px solid black;" width="10%">{{ $inforwarehouserequest -> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                        <td class="text-font text-pedding" style="border: 1px solid black;" width="10%">{{ $inforwarehouserequest -> WAREHOUSE_SAVE_HR_NAME }}</td>
                             
                        <td class="text-font text-pedding" style="border: 1px solid black;" width="7%">
                          
                            {{ DateThai($inforwarehouserequest -> WAREHOUSE_PAYDAY) }}
                         
                        </td>
                        
                        <td class="text-font " style="border: 1px solid black;" align="center" width="5%">

                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button> 
                                <div class="dropdown-menu" style="width:10px">

                                    <a class="dropdown-item" href="#detail_appall" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="detail({{ $inforwarehouserequest -> WAREHOUSE_ID}});">รายละเอียด</a>
                          

                                @if($status == 'Approve')
                                         <a class="dropdown-item"  href="{{ url('manager_warehouse/warehouseinfopayparcel/'.$inforwarehouserequest->WAREHOUSE_ID.'?YEAR_ID='.$year_id.'&DATE_BIGIN='.$displaydate_bigen.'&DATE_END='.$displaydate_end.'&SEND_STATUS='.$status_check.'&INVEN_STATUS='.$invenstatus_check.'&search='.$search)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">จัดสรรวัสดุ</a>
                                @endif
                                @if($status == 'Verify')
                                        <a class="dropdown-item" href="{{ url('manager_warehouse/warehouseinfopayparcel/'.$inforwarehouserequest->WAREHOUSE_ID.'?YEAR_ID='.$year_id.'&DATE_BIGIN='.$displaydate_bigen.'&DATE_END='.$displaydate_end.'&SEND_STATUS='.$status_check.'&INVEN_STATUS='.$invenstatus_check.'&search='.$search)  }}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >แก้ไข </a>
                                        <a class="dropdown-item" href="{{url('manager_warehouse/warehouserequestlastapp/'.$inforwarehouserequest->WAREHOUSE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" >อนุมัติ</a>
                                @endif
                                
                                @if($codes == '11120')                               
                                <a class="dropdown-item"  href="{{url('formpdf/warehouse_11120/'.$inforwarehouserequest->WAREHOUSE_ID.'/'.$inforwarehouserequest->WAREHOUSE_SAVE_HR_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบเบิกวัสดุ</a>
                                @elseif ($codes == '11379')                             
                                <a class="dropdown-item"  href="{{url('formpdf/warehouse_11379/'.$inforwarehouserequest->WAREHOUSE_ID.'/'.$inforwarehouserequest->WAREHOUSE_SAVE_HR_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบเบิกวัสดุ</a>
                                @elseif ($codes == '11485')                             
                                <a class="dropdown-item"  href="{{url('formpdf/warehouse_11485/'.$inforwarehouserequest->WAREHOUSE_ID.'/'.$inforwarehouserequest->WAREHOUSE_SAVE_HR_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบเบิกวัสดุ</a>
                                @elseif ($codes == '10978')                             
                                <a class="dropdown-item"  href="{{url('formpdf/warehouse_10978/'.$inforwarehouserequest->WAREHOUSE_ID.'/'.$inforwarehouserequest->WAREHOUSE_SAVE_HR_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบเบิกวัสดุ</a>
                                @else
                                <a class="dropdown-item"  href="{{url('general_warehouse/infowithdrawindex_billpaypdf/'.$inforwarehouserequest->WAREHOUSE_ID.'/'.$inforwarehouserequest->WAREHOUSE_SAVE_HR_ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" target="_blank">พิมพ์ใบเบิกวัสดุ</a>
                            
                                @endif
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
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;">ปิดหน้าต่าง</button>

                                                </div>
                                                </div>
                                                </form>
                                        </body>


                                            </div>
                                            </div>
                                        </div>


  
@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>

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
  $(document).ready(function() {
    $('select').select2({
    width: '100%'
});

    });

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


function detailsmall(id){


$.ajax({
           url:"{{route('smallhos.detailsmallhos')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
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
                todayHighlight: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    };
</script>

@endsection