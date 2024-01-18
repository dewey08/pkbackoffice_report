@extends('layouts.launder')   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
      
      
      .form-control{
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
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เบิกจ่ายผ้า</B></h3>
                <div align="right">
                
                <a href="{{ url('manager_launder/launder_withdraw')}}" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" class="btn btn-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลการเบิกผ้า</a>
                    </div>
                </div>
           
                <div class="block-content block-content-full">
                <form action="{{ route('launder.launder_disburse') }}" method="post">
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
                                        
                                                <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" value="{{ formate($displaydate_bigen) }}" readonly>
                                                
                                                </div>
                                                <div class="col-sm">
                                                    ถึง 
                                                    </div>
                                                <div class="col-md-4">
                                    
                                                <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;" value="{{ formate($displaydate_end) }}" readonly>
                                            
                                                </div>
                                                </div>

                                            </div>

                            <div class="col-sm-0.5">
                            &nbsp;สถานะ &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">

                            <option value="">ทั้งหมด</option>

                            @foreach ($infostatuss as $infostatus)  
                                 @if($infostatus->LAUNDER_DIS_STATUS_CODE == $status_check)
                                    <option value="{{$infostatus->LAUNDER_DIS_STATUS_CODE}}" selected>{{ $infostatus->LAUNDER_DIS_STATUS_NAME}}</option>
                                @else
                                    <option value="{{$infostatus->LAUNDER_DIS_STATUS_CODE}}" >{{ $infostatus->LAUNDER_DIS_STATUS_NAME}}</option>
                                @endif
                            @endforeach 
                            


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
                            <div class="col-sm-1">
                            <span>
                            <button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ค้นหา</button>
                            </span> 
                            </div>


                                        
                                            </div>  
             </form>
             <div class="table-responsive"> 

                <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                        <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="5%">ลำดับ</th>
                        <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;">สถานะ</th>   
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="10%">รหัสเบิกจ่าย</th>

                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;">วันที่เบิกจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="10%">เวลา</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="10%" >เจ้าหน้าที่เบิก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="10%" >ฝ่ายแผนก</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;">วันที่จ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="10%">เวลา</th>
             
                            
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="10%" >เจ้าหน้าที่จัดสรร</th>                                               
                            <th  class="text-font" style="border-color:#F0FFFF;border: 1px solid black;text-align: center;" width="8%">ทำรายการ</th>
                        </tr >
                    </thead>
                    <tbody>

                    <?php $number = 0; ?>
                    @foreach ($launderwithdrows as $launderwithdrow)
                    <?php $number++; ?>
                  
                        <tr height="20">
                            <td class="text-font" align="center">{{$number}}</td>
                            <td class="text-font" align="center">
                                @if($launderwithdrow->LAUNDER_WITHDROW_STATUS == 'Request')
                                    <span class="badge badge-warning">รัองขอ</span>
                                @else
                                    <span class="badge badge-success">จัดสรร</span>
                                @endif
                            </td>

                            <td class="text-font text-pedding" >{{$launderwithdrow->LAUNDER_WITHDROW_CODE}}</td>
                            <td class="text-font text-pedding" >{{DateThai($launderwithdrow->LAUNDER_WITHDROW_DATE)}}</td>
                            <td class="text-font text-pedding" >{{$launderwithdrow->LAUNDER_WITHDROW_TIME}}</td>
                            <td class="text-font text-pedding" >{{$launderwithdrow->HR_FNAME}} {{$launderwithdrow->HR_LNAME}}</td> 
                            <td class="text-font text-pedding" >{{$launderwithdrow->HR_DEPARTMENT_SUB_SUB_NAME}}</td>    
                            <td class="text-font text-pedding" >
                            @if($launderwithdrow->LAUNDER_WITHDROW_PAY_DATE != '' || $launderwithdrow->LAUNDER_WITHDROW_PAY_DATE != null)
                                {{DateThai($launderwithdrow->LAUNDER_WITHDROW_PAY_DATE)}}
    
                            @endif

                            </td>
                            <td class="text-font text-pedding" >{{$launderwithdrow->LAUNDER_WITHDROW_PAY_TIME}}</td> 
                           
                            <td class="text-font text-pedding" >{{$launderwithdrow->LAUNDER_WITHDROW_PAY_HD_NAME}}</td>                    
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                        ทำรายการ
                                    </button>
                                    <div class="dropdown-menu" style="width:10px">                           
                                    <a class="dropdown-item" href="#detail_appall" data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" onclick="detail({{ $launderwithdrow -> LAUNDER_WITHDROW_ID}});">รายละเอียด</a>
                                 
                                
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
                                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ปิดหน้าต่าง</button>

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



datepick()
    function datepick() {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: true,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: true,
            autoclose: true                         //Set เป็นปี พ.ศ.
        });  //กำหนดเป็นวันปัจุบัน
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

        function chkmunny(ele){
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
        ele.onKeyPress=vchar;
        }
</script>

@endsection