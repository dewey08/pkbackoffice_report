@extends('layouts.person')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{asset('datepicker/dist/css/bootstrap-datepicker.css?v='.time())}}" rel="stylesheet">

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


  .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }
      }

      .form-control{
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

  use App\Http\Controllers\ManagerpersonController;
?>
           
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">    
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">

          <div class="row">
          <div class="col-md-10" align="left">
          ข้อมูลประชุมอบรมภายใน
          </div>
          <div class="col-md-2">
          <a href="{{url('manager_person/inforperson_meetinginside_add')}}"  class="btn btn-hero-sm btn-hero-info"  ><i class="fa fa-plus mr-2"></i> เพิ่มข้อมูลประชุม &nbsp;&nbsp;</a>
             
          </div>
          </div>
          </h2>  
       
          <form method="post">
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
                       <input  name="DATE_BIGIN"  id="DATE_BIGIN" data-date-format="dd/mm/yyyy" class="form-control input-lg datepicker" value="{{formate($displaydate_bigen)}}" readonly>
                       
                       </div>
                       <div class="col-sm">
                           ถึง 
                           </div>
                       <div class="col-md-4">
              
                       <input  name = "DATE_END"  id="DATE_END" data-date-language=""  class="form-control input-lg datepicker" data-date-format="dd/mm/yyyy"  value="{{ formate($displaydate_end) }}" readonly>
                     
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
                                        @foreach ($meettingstatuss as $meettingstatus)
                                                   @if($meettingstatus->STATUS == $status_check)
                                                       <option value="{{ $meettingstatus->STATUS  }}" selected>{{ $meettingstatus->STATUS_NAME}}</option>
                                                   @else
                                                       <option value="{{ $meettingstatus->STATUS  }}" >{{ $meettingstatus->STATUS_NAME}}</option>
                                                   @endif
                                               @endforeach  
   
                                   </select>
                                   </span>
                               </div>                   
                               <div class="col-sm-0.5">
                                   &nbsp;คำค้นหา &nbsp;
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
                                       <button type="submit" class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-search mr-2"></i>ค้นหา</button>
                                   </span> 
                               </div>              
                           </div>  
   
   
                    
                </form>
                <div class="table-responsive">
                           
                               <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                   <thead style="background-color: #FFEBCD;">
                                       <tr height="40">
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="5%">ลำดับ</th>
                                          
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="5%">ปีงบ</th>
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="5%">ไฟล์</th>
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="10%">ลิงก์</th> 
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" >หัวเรื่องการประชุม</th> 
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="10%">ประเภท</th>  
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="10%">ห้องประชุม</th>  
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="7%">วันที่ประชุม</th>                                       
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="7%">เริ่มเวลา</th>
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="7%">ถึงเวลา</th>
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;" width="7%">จำนวนคน</th>
                                           <th class="text-font" style="text-align: center;border: 1px solid #A9A9A9;"  width="5%">คำสั่ง</th>
   
   
                                       </tr >
                                   </thead>
                                   <tbody>
                                       <?php $number = 0; ?>
                                       @foreach ($meetinginsides as $item)
                                       <?php $number++;
                                   
                                       ?>
   
                                       <tr height="20">
                                           <td align="center">{{$number}}</td>
                                           <td class="text-font text-pedding" >{{$item->MEETING_INSIDE_BUDGET}}</td>

                                           @if($item->MEETING_INSIDE_FILE == !null)
                                           <td  align="center" ><span class="btn btn-hero-sm btn-hero" style="background-color:#FF6347;color:#F0FFFF;" ><i class="fa fa-1.5x fa-file-alt"></i></span></td>
                                           @else
                                           <td  align="center" ></td>
                                           @endif

                                           <td class="text-font text-pedding" >{{$item->MEETING_INSIDE_LOCATION}}</td>
                                           <td class="text-font text-pedding" >{{$item->MEETING_INSIDE_TITLE}}</td>  
                                           <td class="text-font text-pedding" width="10%">{{$item->MEETTINGSIDE_NAME}}</td>
                                           <td class="text-font text-pedding" width="10%">{{$item->ROOM_NAME}}</td>
                                           <td class="text-font text-pedding" width="7%">{{DateThai($item->MEETING_INSIDE_DATE)}}</td>
                                           <td class="text-font text-pedding" width="7%">{{formatetime($item->MEETING_INSIDE_STARTTIME)}}</td>
                                           <td class="text-font text-pedding" width="7%">{{formatetime($item->MEETING_INSIDE_ENDTIME)}}</td>
                                           <td class="text-font text-pedding" width="7%">{{ManagerpersonController::contperson($item->MEETING_INSIDE_ID)}}</td>
   
                                           <td align="center" width="5%">
                                           <div class="dropdown">
                                           <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                       ทำรายการ
                                                   </button>
                                                   <div class="dropdown-menu" style="width:10px">
                                                  
                                                    <a class="dropdown-item"  href="{{url('manager_person/inforperson_meetinginside_edit/'.$item->MEETING_INSIDE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                   @if ($item->MEETING_STATUS == 'CANCEL')                                                     
                                                    @else
                                                    <a class="dropdown-item"  href="{{url('manager_person/inforperson_meetinginside_cancel/'.$item->MEETING_INSIDE_ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">แจ้งยกเลิก</a>
                                                    @endif
                                                </div>
                                           </div>
                                           </td>
                                       </tr>

                                       @endforeach
                   </tbody>
                  </table>
</div>
    
                      

@endsection
@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js?v='.time()) }}" charset="UTF-8"></script>



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
                        $('.datepicker').datepicker({
                            format: 'dd/mm/yyyy',
                            language: 'th',
                            autoclose: true,
                            todayHighlight: true,
                            todayBtn: true,
                            thaiyear: true
                        });
                     }
             })
             }        
     });

   $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: 'th',
                autoclose: true,
                todayHighlight: true,
                todayBtn: true,
                thaiyear: true
            });
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

</script>



@endsection