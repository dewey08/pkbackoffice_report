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
                                            <!--<div>
                                             <a href="{{ url('general_mpay/dashboard_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">Dashboard</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                            <a href="{{ url('general_mpay/stockcard_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">คลังย่อย

                                                <span class="badge badge-light" ></span>

                                            </a>
                                            </div>
                                            <div>&nbsp;</div>-->

                                            <div>
                                             <a href="{{ url('general_mpay/withdraw_mpay/'.$inforpersonuserid -> ID) }}" class="btn btn-info" >เบิกอุปกรณ์</a>
                                            </div>
                                            <div>&nbsp;</div>

                                            <div>
                                             <a href="{{ url('general_mpay/pay_mpay/'.$inforpersonuserid -> ID) }}" class="btn " style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;background-color:#DCDCDC;color:#696969;">จ่ายออก</a>
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
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เบิกอุปกรณ์ | หน่วยงาน</B></h3>
  
            <a href="{{ url('general_mpay/withdrowmpay_add/'.$inforpersonuserid -> ID) }}"  class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มการเบิก</a>
        </div>
        <div class="block-content block-content-full">
        <form action="{{route('gen_mpay.withdraw_mpay_search',['iduser' => $inforpersonuserid -> ID])}}" method="post">
                        @csrf

             <div class="row">
            
             <div class="col-sm-0.5">
                            &nbsp;&nbsp; ปีงบ &nbsp;
                        </div>
                        <div class="col-sm-1.5">
                        <span>
                                <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">
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
                    <div class="col-md-4">
             
                    <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_bigen) }}" readonly>
                    
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                  
                    </div>
                    </div>

                </div>
                 <div class="col-sm-0.5">
                     &nbsp;สถานะ &nbsp;
                     </div>
                      
                       <div class="col-sm-2">
                       <span>
                      
                       <select name="STATUS_CODE" id="STATUS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                      
                        <option value="">--ทั้งหมด--</option>
                        @if($status_check == 'Request')<option value="Request" selected>ร้องขอ</option> @else<option value="Request" >ร้องขอ</option> @endif 
                        @if($status_check == 'Success')<option value="Success" selected>จัดสรร</option> @else<option value="Success" >จัดสรร</option> @endif           
                          
                      
                    </select>
                     </span>
                      </div> 
                
                <div class="col-sm-0.5">
                &nbsp;ค้นหา &nbsp;
                </div>
                 
                  <div class="col-sm-2">
                  <span>
                 
                 <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="{{$search}}">
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
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="8%">วันที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เวลา</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">เหตุผลขอเบิก</th>

                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="7%">คำสั่ง</th> 
                       
                        </tr >
                    </thead>
                    <tbody>     
                    <?php $number = 0; ?>
                    @foreach ($mpaywithdrows as $mpaywithdrow)
                    <?php $number++; ?>
              
                    <tr height="20">
                    <td class="text-font" align="center">{{$number}}</td>
                         
                            <td class="text-font" align="center">
                                @if($mpaywithdrow->MPAY_WITHDROW_STATUS == 'Request')
                                    <span class="badge badge-warning">รัองขอ</span>
                                @else
                                    <span class="badge badge-success">จัดสรร</span>
                                @endif
                            </td>

                           
                        <td class="text-font text-pedding" align="center">{{$mpaywithdrow->MPAY_WITHDROW_CODE}}</td>
                        <td class="text-font text-pedding" align="center">{{DateThai($mpaywithdrow->MPAY_WITHDROW_DATE)}}</td>
                        <td class="text-font text-pedding" align="center">{{$mpaywithdrow->MPAY_WITHDROW_TIME}}</td>
                        <td class="text-font text-pedding" >{{$mpaywithdrow->MPAY_WITHDROW_COMMENT}}</td>
                        <td class="text-font text-pedding" >{{$mpaywithdrow->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$mpaywithdrow->HR_FNAME}} {{$mpaywithdrow->HR_LNAME}}</td>
                       
                        <td class="text-font " align="center">

                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                    ทำรายการ
                                </button> 
                                <div class="dropdown-menu" style="width:10px">
                                <a class="dropdown-item" href="#detail_appall{{$mpaywithdrow->MPAY_WITHDROW_ID}}" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="">รายละเอียด</a>
                                <a class="dropdown-item"  href="{{url('general_mpay/withdrowmpay_edit/'.$mpaywithdrow->MPAY_WITHDROW_ID.'/'.$inforpersonuserid -> ID)}}"   style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไข</a>
                                <a class="dropdown-item"  href="{{url('general_mpay/withdrowmpay_destroy/'.$mpaywithdrow->MPAY_WITHDROW_ID.'/'.$inforpersonuserid -> ID)}}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ลบ</a>
                                </div>

                        </td>
            
                        </tr>



                        <div id="detail_appall{{$mpaywithdrow->MPAY_WITHDROW_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">

                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการขอเบิก&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                              <div class="row push">
                                               <div class="col-md-2">
                                               <label>รหัส</label>
                                               </div>
                                               <div class="col-md-2">
                                               {{$mpaywithdrow->MPAY_WITHDROW_CODE}}
                                               </div>

                                               <div class="col-md-2">
                                               <label>วันที่</label>
                                               </div>
                                               <div class="col-md-2">
                                               {{DateThai($mpaywithdrow->MPAY_WITHDROW_DATE)}}
                                               </div>
                                               
                                               <div class="col-md-2">
                                               <label>เวลา</label>
                                               </div>
                                               <div class="col-md-2">
                                               {{$mpaywithdrow->MPAY_WITHDROW_TIME}}
                                               </div>
                                               

                                              </div>
                                              <div class="row push">
                                              <div class="col-md-2">
                                              <label>เหตุผล</label>
                                               </div>
                                               <div class="col-md-2">
                                               {{$mpaywithdrow->MPAY_WITHDROW_COMMENT}}
                                               </div>

                                               <div class="col-md-2">
                                               <label>หน่วยงาน</label>
                                               </div>
                                               <div class="col-md-2">
                                               {{$mpaywithdrow->HR_DEPARTMENT_SUB_SUB_NAME}}
                                               </div>

                                               <div class="col-md-2">
                                               <label>เจ้าหน้าที่</label>
                                               </div>
                                               <div class="col-md-2">
                                               {{$mpaywithdrow->HR_FNAME}} {{$mpaywithdrow->HR_LNAME}}
                                               </div>

                                             </div>

                                              
                                                  

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
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการร้องขอผ้า&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body" >
                                             

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
           url:"{{route('gen_launder.detaillaunder')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);

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
 
</script>



@endsection