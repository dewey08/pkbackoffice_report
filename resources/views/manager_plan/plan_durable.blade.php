@extends('layouts.plan')   
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
    padding-top:5px;
    padding-left:5px;
    padding-right:5px;
  
                        }

            .text-font {
        font-size: 13px;
        vertical-align: text-top;
                    }   

    
      .form-control {
    font-size: 13px;
                  }   


                  table {
            border-collapse: collapse;
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

  
    use App\Http\Controllers\ManagerplanController;
    $checkappplan = ManagerplanController::checkappplan($id_user);
?>
        
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนจัดซื้อครุภัณฑ์</B></h3>
                <a href="{{ url('manager_plan/durableexcel')}}" class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>&nbsp;Excel</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ url('manager_plan/durable_add') }}" class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-plus mr-2"></i> เพิ่มข้อมูล</a>
            </div>
            <div class="block-content block-content-full">

            
            <form action="{{ route('mplan.durable') }}" method="post">
                @csrf

                            <div class="row">
                            <div class="col-sm-0.5">
                                                        &nbsp;&nbsp; ปีงบ &nbsp;
                                                    </div>
                                                    <div class="col-sm-1.5">
                                                    <span>
                                                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
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
                                                     <div class="col-sm-1">
                                                        <span>
                                                        <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                                                        <option value="">--ทั้งหมด--</option>
                                                        @if($statusinfo == 'WAIT')<option value="WAIT" selected>รอพิจารณา</option> @else<option value="WAIT">รอพิจารณา</option>@endif
                                                        @if($statusinfo == 'APP')<option value="APP" selected>อนุมัติ</option> @else<option value="APP">อนุมัติ</option>@endif
                                                        @if($statusinfo == 'NOTAPP')<option value="NOTAPP" selected>ไม่อนุมัติ</option> @else<option value="NOTAPP">ไม่อนุมัติ</option>@endif
                                                   
                                                        </select>
                                                        </span>
                                                        </div> 

                            <div class="col-sm-0.5">
                            &nbsp;ประเภท &nbsp;
                            </div>

                            <div class="col-sm-1">
                            <span>
                            <select name="SEND_TYPE" id="SEND_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--ทั้งหมด--</option>
                            @if($type == 'team')<option value="team" selected>ทีมประสาน</option> @else<option value="team">ทีมประสาน</option>@endif
                            @if($type == 'dep')<option value="dep" selected>หน่วยงาน</option> @else<option value="dep">หน่วยงาน</option>@endif
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

                            <div class="col-sm-30">
                            &nbsp;
                            </div> 
                            <div class="col-sm-1.5">
                            <span>
                                <button type="submit" class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                            </span> 
                            </div>


                            </div>  
                            </form>

            
             <div class="table-responsive"> 
             <div align="right">งบประมาณรวม {{number_format($sumbudget,2)}}  บาท</div>
                <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	สถานะ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ปีงบ</th>
                           
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ทีม/หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ค่าครุภัณฑ์/ที่ดิน/สิ่งก่อสร้าง/จ้างเหมา	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ประเภทงบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	เหตุผล	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ครุภัณฑ์เดิม	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ราคาต่อหน่วย	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	จำนวน	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ราคา	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">	วันที่	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">	ผู้รับผิดชอบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF; border: 1px solid black;text-align: center" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>

                    <?php $number = 0; ?>
                                @foreach ($infodurables as $infodurable)
                    <?php $number++; ?>
                   
                        <tr height="20">
                                <td  class="text-font" align="center">{{$number}}</td>

                                <td  align="center" width="5%">
                                   @if($infodurable->DUR_STATUS == 'WAIT')
                                   <span class="badge badge-info"> รอพิจารณา </span>
                                   @elseif($infodurable->DUR_STATUS == 'APP')
                                         <span class="badge badge-success"> อนุมัติ </span>
                                   @elseif($infodurable->DUR_STATUS == 'NOTAPP')
                                        <span class="badge badge-warning"> ไม่อนุมัติ </span>
                                   @else
                                  
                                   @endif                  
                                  </td> 
                                <td class="text-font text-pedding" width="5%"  >{{$infodurable->BUDGET_YEAR}}</td>

                                @if( $infodurable->DUR_TYPE == 'team')
                                <td  class="text-font text-pedding" width="5%">ทีมประสาน</td>
                                @else
                                <td  class="text-font text-pedding" width="5%">หน่วยงาน</td>
                                @endif 

                               
                                <td  class="text-font text-pedding" width="5%">{{$infodurable->DUR_NUMBER}}</td>
                                <td  class="text-font text-pedding" width="5%">{{$infodurable->DUR_TEAM_NAME}}</td>
            
                                <td  class="text-font text-pedding" >{{$infodurable->DUR_ASS_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->BUDGET_NAME}}</td>
                                <td  class="text-font text-pedding" >
                                  @if($infodurable->DUR_REASON_ID == '1')
                                      ทดแทนของเก่า
                                  @else
                                      จัดซื้อของใหม่ 
                                  @endif

                                </td>
                                <td valign="top" class="text-font text-pedding" >{{$infodurable->DUR_ASS_OLD}}</td>
                                <td valign="top" class="text-font text-pedding" align="right">{{number_format($infodurable->DUR_ASS_PICE_UNIT,2)}}</td>
                                <td valign="top" class="text-font text-pedding" align="center">{{$infodurable->DUR_ASS_AMOUNT}}</td>
                                <td valign="top" class="text-font text-pedding" align="right">{{number_format($infodurable->DUR_PICE_SUM,2)}}</td>
                                <td valign="top" class="text-font text-pedding" align="right">{{number_format($infodurable->BUDGET_PICE_REAL,2)}}</td>
                                <td valign="top" class="text-font text-pedding"  width="5%">{{DateThai($infodurable->DUR_ASS_BEGIN_DATE)}}<br>{{DateThai($infodurable->DUR_ASS_END_DATE)}}</td>
                                <td valign="top" class="text-font text-pedding" width="9%">{{$infodurable->DUR_TEAM_HR_NAME}}</td>
                               

                               
                           
                                <td align="center" width="5%">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                @if($checkappplan > 0)
                                                <a class="dropdown-item"  href="{{ url('manager_plan/durable_edit/'.$infodurable-> DUR_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>  
                                                <a class="dropdown-item"  href="{{ url('manager_plan/durable_app/'.$infodurable-> DUR_ID)  }}" onclick="return confirm('ต้องการที่จะอนุมัติ แผน {{$infodurable->DUR_NUMBER}} ?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >อนุมัติ</a>  
                                                <a class="dropdown-item"  href="{{ url('manager_plan/durable_notapp/'.$infodurable-> DUR_ID)  }}" onclick="return confirm('ต้องการที่จะไม่อนุมัติ แผน {{$infodurable->DUR_NUMBER}}?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ไม่อนุมัติ</a>  
                                                <a class="dropdown-item"  href="{{ url('manager_plan/durable_destroy/'.$infodurable-> DUR_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล?')"    style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ลบข้อมูล</a>    
                                                @elseif($infodurable->DUR_STATUS == 'WAIT')
                                                <a class="dropdown-item"  href="{{ url('manager_plan/durable_edit/'.$infodurable-> DUR_ID)  }}"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>  
                                                @endif
                                                </div>
                                            </div>
                                </td>     
                        
                        </tr>

                     
                        </tr>
                        
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


function datepick(){

$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true                         //Set เป็นปี พ.ศ.
        }); 

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