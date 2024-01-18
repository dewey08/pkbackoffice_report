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
    padding-left:10px;
    padding-right:10px;
                        }

            .text-font {
        font-size: 13px;
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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนซ่อมบำรุง</B></h3>
                <a href="{{ url('manager_plan/repairexcel')}}" class="btn btn-hero-sm btn-hero-success"  ><li class="fa fa-file-excel mr-2"></li>&nbsp;Excel</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ url('manager_plan/repair_add') }}" class="btn btn-hero-sm btn-hero-info f-kanit" ><i class="fas fa-plus mr-2"></i> เพิ่มข้อมูล</a>
            </div>
            <div class="block-content block-content-full">

            
            <form action="{{ route('mplan.repair') }}" method="post">
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
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="5%">	สถานะ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ทีม/หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	แปลน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >	ประเภทงบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	ราคาต่อหน่วย	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	จำนวนหน่วย	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	ราคา	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	วันที่	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >	ผู้รับผิดชอบ	</th>  
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                                @foreach ($inforepairs as $inforepair)
                    <?php $number++; ?>
                    <tr height="20">
                                <td class="text-font" align="center" width="5%">{{$number}}</td>

                                
                                <td align="center" width="5%">
                                   @if($inforepair->REPAIR_STATUS == 'WAIT')
                                   <span class="badge badge-info"> รอพิจารณา </span>
                                   @elseif($inforepair->REPAIR_STATUS == 'APP')
                                         <span class="badge badge-success"> อนุมัติ </span>
                                   @elseif($inforepair->REPAIR_STATUS == 'NOTAPP')
                                        <span class="badge badge-warning"> ไม่อนุมัติ </span>
                                   @else
                                  
                                   @endif                  
                                  </td> 

                                <td class="text-font text-pedding" width="5%">{{$inforepair->BUDGET_YEAR}}</td> 
                                
                                @if( $inforepair->REPAIR_TYPE == 'team')
                                <td class="text-font text-pedding" >ทีมประสาน</td>
                                @else
                                <td class="text-font text-pedding" >หน่วยงาน</td>
                                @endif    
                                                
                                <td class="text-font text-pedding" width="6%">{{$inforepair->REPAIR_NUMBER}}</td>
                                <td class="text-font text-pedding" >{{$inforepair->REPAIR_TEAM_NAME}}</td>
                             
                                <td class="text-font text-pedding" >{{$inforepair->REPAIR_PLAN_DETAIL}}</td>
                                <td class="text-font text-pedding" >{{$inforepair->REPAIR_PLAN_FROM}}</td>
                                <td class="text-font text-pedding" >{{$inforepair->BUDGET_NAME}}</td>
                                <td class="text-font text-pedding" align="right" width="7%">{{number_format($inforepair->REPAIR_PICE_UNIT,2)}}</td>
                                <td class="text-font text-pedding" align="center">{{$inforepair->REPAIR_AMOUNT}}</td>
                                <td class="text-font text-pedding" align="right" width="7%">{{number_format($inforepair->REPAIR_PICE_SUM,2)}}</td>
                                <td class="text-font text-pedding" align="right" width="7%">{{number_format($inforepair->REPAIR_PICE_REAL,2)}}</td>
                                <td class="text-font text-pedding" align="center" width="7%">{{DateThai($inforepair->REPAIR_BEGIN_DATE)}}<br>{{DateThai($inforepair->REPAIR_END_DATE)}}</td>

                                <td class="text-font text-pedding" width="9%">{{$inforepair->REPAIR_TEAM_HR_NAME}}</td>
                            
                               
                            
                                <td align="center" width="5%">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                @if($checkappplan > 0)
                                                <a class="dropdown-item"  href="{{ url('manager_plan/repair_edit/'.$inforepair-> REPAIR_PLAN_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>  
                                                <a class="dropdown-item"  href="{{ url('manager_plan/repair_app/'.$inforepair-> REPAIR_PLAN_ID)  }}" onclick="return confirm('ต้องการที่จะอนุมัติ แผน {{$inforepair->REPAIR_NUMBER}} ?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >อนุมัติ</a>  
                                                <a class="dropdown-item"  href="{{ url('manager_plan/repair_notapp/'.$inforepair-> REPAIR_PLAN_ID)  }}" onclick="return confirm('ต้องการที่จะไม่อนุมัติ แผน {{$inforepair->REPAIR_NUMBER}}?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ไม่อนุมัติ</a>  
                                                <a class="dropdown-item"  href="{{ url('manager_plan/repair_destroy/'.$inforepair-> REPAIR_PLAN_ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล?')"   style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >ลบข้อมูล</a>    
                                                @elseif($inforepair->REPAIR_STATUS == 'WAIT')
                                                <a class="dropdown-item"  href="{{ url('manager_plan/repair_edit/'.$inforepair-> REPAIR_PLAN_ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียดแก้ไข</a>  
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
           
             }        
     });


function detail(id){

$.ajax({
           url:"{{route('suplies.detailapp')}}",
          method:"GET",
           data:{id:id},
           success:function(result){
               $('#detail').html(result);
             
         
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