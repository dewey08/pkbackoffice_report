@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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
<?php
  date_default_timezone_set("Asia/Bangkok");
   $date = date('Y-m-d');
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
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

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<div class="block" style="width: 95%;">
<div class="block-header block-header-default" >
<h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลร้องขอใช้รถยนต์</B></h3>
<a href="#modal_allapp" data-toggle="modal"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">อนุมัติทั้งหมด</a>
</div>
<div class="block-content block-content-full">
<form action="{{ route('horg.infocarnomalsearch') }}" method="post">
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
                    <div class="col-md-0.5">
                        &nbsp;สถานะ &nbsp;
                    </div>
                    <div class="col-md-2">
<span>
<select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
<option value="">--ทั้งหมด--</option>
@foreach ($infocar_sendstatuss as $infocar_sendstatus)
      @if($infocar_sendstatus->STATUS_ID == $status_check)
      <option value="{{ $infocar_sendstatus->STATUS_ID  }}" selected>{{ $infocar_sendstatus->STATUS_NAME}}</option>
      @else
      <option value="{{ $infocar_sendstatus->STATUS_ID  }}">{{ $infocar_sendstatus->STATUS_NAME}}</option>
      @endif
  
                                                                           
@endforeach 

</select>
</span>
</div> 

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
<button type="submit" class="btn btn-info" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ค้นหา</button>
</span> 
</div>


              
                  </div>  
             </form>
             <div class="row">
<div class="col-md-12" style=" font-size: 15px;">
ความเร่งด่วน :: 
<p class="fa fa-circle" style="color:#008000;  font-size: 15px;"></p> ปกติ


<p class="fa fa-circle" style="color:#87CEFA;  font-size: 15px;"></p> ด่วน


<p class="fa fa-circle" style="color:#FFA500;  font-size: 15px;"></p> ด่วนมาก

<p class="fa fa-circle" style="color:#FF4500;  font-size: 15px;"></p> ด่วนที่สุด &nbsp;&nbsp;&nbsp;&nbsp;


</div>
</div>
             <div class="table-responsive"> 
                            
                            <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                <thead style="background-color: #FFEBCD;">
                                    <tr height="40">
                                    <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">สถานะ</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ความเร่งด่วน</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ทะเบียน</th>
      
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">บันทึกไป</th>
                                        <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">บันทึกกลับ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">วันที่ไป</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">เวลา</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">ถึงวันที่</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">เวลา</th>
                                        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">สถานที่ไป</th>                             
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="10%">เหตุผลการขอรถ</th>
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">ผู้ร้องขอ</th>   
                                        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;"  width="8%">อนุมัติ</th>    
                                        
                                       
                                       
                                        
                                    </tr >
                                </thead>
                                <tbody>
                                

                                <?php $number = 0; ?>
                                @foreach ($infocarnomals as $infocarnomal)
                                <?php $number++; ?>

                                    <tr height="20">
                                        <td class="text-font" align="center">{{$number}}</td>


                                        @if($infocarnomal->STATUS == 'CANCEL')
                                        <td  align="center"><span class="badge badge-danger" >ยกเลิก</span></td>
                                        @elseif($infocarnomal->STATUS == 'RECERVE')
                                        <td  align="center"><span class="badge badge-warning" >ร้องขอ</span></td>
                                        @elseif($infocarnomal->STATUS == 'REGROUP')
                                        <td  align="center"><span class="badge badge-info" >จัดสรรร่วม</span></td>
                                        @elseif($infocarnomal->STATUS == 'SUCCESS')
                                        <td  align="center"><span class="badge badge-info" >จัดสรร</span></td>
                                        @elseif($infocarnomal->STATUS == 'LASTAPP')
                                        <td  align="center"><span class="badge badge-success" >ผอ.อนุมัติ</span></td>
                                       @else
                                       <td class="text-font" align="center" ></td>
                                        @endif
                                           
                                        @if($infocarnomal->PRIORITY_ID == 1)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#008000;"></span></td> 
                                        @elseif($infocarnomal->PRIORITY_ID == 2)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#87CEFA;"></span></td>
                                        @elseif($infocarnomal->PRIORITY_ID == 3)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FFA500;"></span></td>         
                                        @elseif($infocarnomal->PRIORITY_ID == 4)
                                        <td class="text-font" align="center" ><span class="fa fa-2x fa-circle" style="color:#FF4500;"></span></td>
                                        @else
                                        <td class="text-font" align="center" ></td>
                                        @endif

                                        <td class="text-font" align="center" >{{$infocarnomal->CAR_REG}}</td>
                                        
                                       
                                      
                                        
                                        @if($infocarnomal->STATUS == 'REGROUP')
                                        <td class="text-font" align="center" >-</td>
                                        @elseif($infocarnomal->CAR_NUMBER_BEGIN != '')
                                        <td class="text-font" align="center" ><span class="btn btn-success fa-xs fa fa-check"></span></td>
                                        @else
                                        <td class="text-font" align="center" ></td>
                                        @endif

                                        @if($infocarnomal->STATUS == 'REGROUP')
                                        <td class="text-font" align="center" >-</td>
                                        @elseif($infocarnomal->CAR_NUMBER_BACK != '')
                                        <td class="text-font" align="center" ><span class="btn btn-success fa-xs fa fa-check"></span></td>  
                                        @else
                                        <td class="text-font" align="center" ></td>
                                        @endif
                                       

                                        <td class="text-font" align="center">{{ DateThai($infocarnomal->RESERVE_BEGIN_DATE) }}</td>
                                        <td class="text-font" align="center">{{ formatetime($infocarnomal->RESERVE_BEGIN_TIME) }}</td>
                                        <td class="text-font" align="center">{{ DateThai($infocarnomal->RESERVE_END_DATE) }}</td>
                                        <td class="text-font" align="center">{{ formatetime($infocarnomal->RESERVE_END_TIME) }}</td>
                                        <td class="text-font text-pedding" >{{$infocarnomal->LOCATION_ORG_NAME}}</td>
                                        <td class="text-font text-pedding" >{{ $infocarnomal->RESERVE_NAME }}</td>
                                        <td class="text-font text-pedding" >{{ $infocarnomal->RESERVE_PERSON_NAME }}</td>
                                     
                                        
                                        
                                        <td align="center">
                                        @if($infocarnomal->STATUS == 'SUCCESS')
                                        <a href="{{ url('person_headorg/infocar_app/'.$infocarnomal->RESERVE_ID) }}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fa fa-edit"></i></a>
                                    
                            @else
                              -
                            @endif
                                        </td>     

                                    </tr>




                                 
                             
                                    <div id="detail_usecar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                        <div class="modal-header">

                                        <div class="row">
                                        <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการขอใช้รถทั่วไป&nbsp;&nbsp;</h3></div>
                                        </div>
                                            </div>
                                            <div class="modal-body" >
                                                <form  method="post" action="{{ route('horg.updateinfocarnomalapp') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden"  name="RESERVE_ID" value="{{$infocarnomal->RESERVE_ID}}"/>


                                             <div id="detail"></div>


                                            </div>
                                            <div class="modal-footer">
                                                <div align="right">
                                                    <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">อนุมัติ</button>
                                                    <button type="submit"  name = "SUBMIT"  class="btn btn-danger btn-lg" value="not_approved" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ไม่อนุมัติ</button>
                                                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ปิดหน้าต่าง</button>
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


                

                
                <div id="modal_allapp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                         <div class="modal-dialog modal-lg">
                                         <div class="modal-content">
                                         <div class="modal-header">

                                         <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"></h2>
                                        </div>
                                        <div class="modal-body">
                                        <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ท่านต้องการอนุมัติรายการทั้งหมด !!</h2>

                                    </div>
                                    <div class="modal-footer">
                                    <div align="right">
                                    <a href="{{ url('person_headorg/updateinfocarnomalappall')}}"  class="btn btn-success" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ตกลง</a>
                                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ยกเลิก</button>
                                </div>
                                </div>
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

var type = 'nomal';

  $.ajax({
             url:"{{route('car.detailcar')}}",
            method:"GET",
             data:{type:type,id:id},
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
