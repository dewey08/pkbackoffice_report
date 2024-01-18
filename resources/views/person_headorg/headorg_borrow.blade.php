@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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
            font-size: 13px;
           
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

        <div class="block-header block-header-default">
            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>อนุมัติยืม - คืน</B></h3>
          
        </div>
        <div class="block-content block-content-full">
     

                <form action="{{route('horg.borrow')}}" method="post">
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
                                </select>
                            </span>
                        </div>

            <div class="col-sm-4 date_budget">
            <div class="row">
                        <div class="col-sm">
                        วันที่
                        </div>
                    <div class="col-md-4">
             
                        <input  name = "DATE_BIGIN" id="DATE_BIGIN" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_bigen) }}" readonly>
                  
                    </div>
                    <div class="col-sm">
                        ถึง 
                        </div>
                    <div class="col-md-4">
           
                    <input  name = "DATE_END" id="DATE_END" class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy" value="{{ formate($displaydate_end) }}" readonly>
                 
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
                                @foreach ($sastatus as $sastatu)
                                @if($sastatu->STATUS_NAME == $status_check)
                                <option value="{{ $sastatu->STATUS_NAME  }}" selected>{{ $sastatu->STATUS_NAME_TH}}</option>
                                @else
                                <option value="{{ $sastatu->STATUS_NAME  }}">{{ $sastatu->STATUS_NAME_TH}}</option>
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
                    <div class="col-md-1.5">
                        <span>
                            <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;"><i class="fas fa-search mr-2"></i> ค้นหา</button>
                        </span>
                    </div>
                </div>
        </form>
        <div class="table-responsive">
 
        <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">สถานะ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เลขที่</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่ขอยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">วันที่คืน</th>
                           
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="25%">เหตุผลการขอยืม</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">เจ้าหน้าที่</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="8%">อนุมัติ</th> 
                        </tr >
                    </thead>
                    <tbody>   

                       <?php $number = 0; ?>
                                @foreach ($inforSalaryborrows as $inforSalaryborrow)
                                <?php $number++; ?>
                               
                                    <tr height="40">
                                        <td class="text-font text-pedding" align="center">{{$number}}</td>
  
                                      
                                        
                                        @if($inforSalaryborrow->BORROW_STATUS== 'REQUEST')
                                        <td  align="center"><span class="badge badge-warning" >ร้องขอ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'APP')
                                        <td  align="center"><span class="badge badge-info" >เห็นชอบ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'NOTAPP')
                                        <td  align="center"><span class="badge badge-danger" >ไม่เห็นชอบ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'SUCCESS')
                                        <td  align="center"><span class="badge badge-success" >อนุมัติ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'NOTSUCCESS')
                                        <td  align="center"><span class="badge badge-danger" >ไม่อนุมัติ</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'CANCEL')
                                        <td  align="center"><span class="badge badge-danger" >ยกเลิก</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'SENDMON')
                                        <td  align="center"><span class="badge badge-secondary" >แจ้งคืนเงิน</span></td>
                                        @elseif($inforSalaryborrow->BORROW_STATUS == 'REMON')
                                        <td  align="center"><span class="badge badge-primary" >ยืนยันการรับเงิน</span></td>
                                        @else
                                        <td class="text-font text-pedding" align="center" >-</td>
                                        @endif

                                        <td class="text-font text-pedding" style="text-align: center">{{ $inforSalaryborrow->BORROW_NUMBER}}</td>

                                        <td class="text-font text-pedding" style="text-align: center" width="10%">{{ DateThai($inforSalaryborrow->BORROW_DATE)}}</td>
                                        <td class="text-font text-pedding" style="text-align: center" width="10%">{{ DateThai($inforSalaryborrow->BORROW_BACK_DATE)}}</td>
                                      
                                        <td class="text-font text-pedding" > {{ $inforSalaryborrow->BORROW_COMMENT}}</td>                                       
                                        <td class="text-font text-pedding" style="text-align: left" width="15%">{{ $inforSalaryborrow->BORROW_HR_DEP_SUB_SUB_NAME}}</td>
                                        <td class="text-font text-pedding" style="text-align: left" width="15%">{{ $inforSalaryborrow->BORROW_HR_PERSON_NAME}}</td>
                                            

                                        <td align="center" width="5%">

                                        @if($inforSalaryborrow->BORROW_STATUS == 'APP')
                                        <a href="#lastapp{{$inforSalaryborrow->BORROW_ID}}" data-toggle="modal" class="btn btn-success  fa fa-edit" ></a>
                                        @else
                                       -
                                        @endif
                                        
                                        </td> 
                                    </tr> 

                                                                
                    <!-------------------------------------------------------อนุมัติ---------------------------------------->

                    <div id="lastapp{{$inforSalaryborrow->BORROW_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">

                                            <div class="row">
                                            <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;อนุมัติขอยืมเงิน&nbsp;&nbsp;</h3></div>
                                            </div>
                                                </div>
                                                <div class="modal-body">
                                                <form  method="post" action="{{ route('horg.borrow_lastapp') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden"  name="ID" value="{{$inforSalaryborrow->BORROW_ID}}"/>
                                                        
                                                            
                                                                                                                
                             
                                                    
                                                            <div class="row">
                    <div class="col-sm-2">
                        <label>เลขทะเบียน :</label>
                    </div> 
                    <div class="col-lg-3">       
                       
                        <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_NUMBER }}</h1>         
                    </div>
                    <div class="col-sm-1 text-right">                    
                        <label>จังหวัด :</label>
                    </div> 
                    <div class="col-lg-2"> 
                       
                        <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_PROVINCE }}</h1> 
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ปีงบประมาณ :</label>
                    </div>         
                    <div class="col-lg-2">  
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_YEAR }}</h1>       
                   
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ยื่นต่อ :</label>
                    </div> 
                    <div class="col-sm-3 text-left">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_LOCATION }}</h1>
                         
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label>วันที่ยืม :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ Datethai($inforSalaryborrow -> BORROW_DATE) }}</h1>       
                       
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>เวลา :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TIME }}</h1> 

                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ข้าพเจ้า :</label>
                    </div> 
                    <div class="col-sm-2">
                   
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;"> {{ $inforSalaryborrow -> BORROW_HR_PERSON_NAME }}</h1> 

    
                   
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>ตำแหน่ง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_POSITION_IN_WORK }}</h1> 
                    
                    </div> 
                    <div class="col-sm-2 text-right">
                        <label>สังกัด :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AFFILIATION }}</h1> 
                         </div> 
                </div>

                <div class="row">
                <div class="col-sm-2">
                        <label>ประเภทเงิน :</label>
                    </div> 
                    <div class="col-lg-2"> 
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_TYPE_MONEY }}</h1>        
                         
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>ประสงค์ขอยืมเงินจาก :</label>
                    </div> 
                    <div class="col-sm-6">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_FUND }}</h1> 
                                          
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>อ้างหนังสือราชการ :</label>
                    </div> 
                    <div class="col-sm-9 text-left">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_BOOK }}</h1> 
                       
                    </div>    
                                 
                    <div class="col-sm-1">                       
                        <!-- <a href="" class="btn btn-sm btn-primary" style=" font-family: 'Kanit', sans-serif;" >. . .</a> -->
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label>อ้างบันทึกไปราชการ :</label>
                    </div> 
                    <div class="col-sm-9 text-left">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_GOVERNMENT_GO }}</h1> 
                         </div>    
                                 
                    <div class="col-sm-1">                       
                        <!-- <a href="" class="btn btn-sm btn-primary" style=" font-family: 'Kanit', sans-serif;" >. . .</a> -->
                    </div> 
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>เพื่อใช้ในการ :</label>
                    </div> 
                    <div class="col-sm-10">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_COMMENT }}</h1> 
                        </div>  
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <label>ระหว่างวันที่ :</label>
                    </div> 
                    <div class="col-lg-2">  
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ Datethai($inforSalaryborrow -> BORROW_START_DATE) }}</h1>       
                      </div>
                    <div class="col-sm-1 text-right">
                        <label>ถึง :</label>
                    </div> 
                    <div class="col-sm-2">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ Datethai($inforSalaryborrow -> BORROW_END_DATE) }}</h1> 
                       </div> 
                    <div class="col-sm-1 text-right">
                        <label>ณ :</label>
                    </div> 
                    <div class="col-lg-4"> 
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_AT_LOCATION }}</h1>        
                       </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label>ผู้รายงาน :</label>
                    </div> 
                    <div class="col-lg-2">
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_HR_PERSON_NAME }} </h1>        
                     
                        </select>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label>หน่วยงานผู้เบิก :</label>
                    </div>
                    <div class="col-lg-3"> 
                    <h1 style="text-align:left;font-family: 'Kanit', sans-serif; font-size:13px;font-weight:normal;color:#778899;">{{ $inforSalaryborrow -> BORROW_HR_DEP_SUB_SUB_NAME }}</h1>        
                            
                    
                  
                    </div>       
                   
                    </div>       
                   
            <br> 
                                                    <div class="modal-footer">
                                                    <div align="right">
                                                    <button type="submit" name = "SUBMIT"  class="btn btn-hero-sm btn-hero-success" value="approved" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >อนุมัติ</button>
                                                    <button type="submit"  name = "SUBMIT"  class="btn btn-hero-sm btn-hero-danger" value="not_approved" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >ไม่อนุมัติ</button>
                                                    <button type="button" class="btn btn-hero-sm btn-hero-secondary" data-dismiss="modal" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >ปิดหน้าต่าง</button>

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
</script>
<script>

    function chkmunny(ele){
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
        ele.onKeyPress=vchar;
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
        }        
    });
</script>



@endsection