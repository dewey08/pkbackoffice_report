@extends('layouts.risk')   
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
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายงานเหตุการณ์ที่ถูกยืนยันว่าไม่ใช่อุบัติการณ์ความเสี่ยง</B></h3>   
                <div align="right ">
                    <a class="btn btn-success" href="{{url('manager_risk/report')}}" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fas fa-chevron-circle-left text-white-70" style="font-size:17px;"></i>&nbsp;&nbsp;ย้อนกลับ</a> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                  </div>
                </div>         
                       
            <div class="block-content block-content-full">  
                <div class="row push">
                    <div class="col-sm-1 text-right" >
                        <label style="font-family:'Kanit',sans-serif;font-size:14px;">รายงานโดยใช้ :</label>
                    </div> 
                    <div class="col-lg-3 ">
                    <select name="SETUP_INCEDENCE_REPORTHEADER_NAME" id="SETUP_INCEDENCE_REPORTHEADER_NAME" class="form-control input-lg " style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" >
                        <option value="" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">--เลือก--</option>
                            @foreach($reportheaders as $reportheader)
                                <option value="{{ $reportheader-> SETUP_INCEDENCE_REPORTHEADER_ID}}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">{{ $reportheader-> SETUP_INCEDENCE_REPORTHEADER_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-sm-2 text-right" >
                        <label style="font-family:'Kanit',sans-serif;font-size:14px;">ระดับความรุนแรง :</label>
                    </div> 
                    <div class="col-lg-3 ">
                    <select name="INCIDENCE_LEVEL_NAME" id="INCIDENCE_LEVEL_NAME" class="form-control input-sm" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">
                            <option value="">--เลือก--</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level-> INCIDENCE_LEVEL_ID}}" >{{ $level-> INCIDENCE_LEVEL_NAME}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-lg-1 "> 
                     <button class="btn btn-info text-white" type="submit" style="font-family:'Kanit',sans-serif;font-size:14px;font-weight:normal;"><i class="fa fa-search fa-sm text-white" style="font-size:17px "></i>&nbsp;&nbsp;ค้นหา </button> 
                   </div>                              
                   <div class="col-sm-2" >
                            <div align="right ">
                                <button class="btn btn-success" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;"><i class="fas fa-file-excel text-white" style="font-size:17px"></i>&nbsp;&nbsp;Export Excel</button> 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                            </div>
                            </div> 
        <div class="block-content">  
            <div class="table-responsive"> 
               <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                         
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัส</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เรื่อง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">หัวเรื่องย่อย</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ความรุนแรง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">หน่วยงานที่รายงาน</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >สรุปประเด็นปัญหา</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายละเอียด</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">การจัดการเบื้องต้น</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">เหตุผลที่ไม่ใช่ความเสี่ยง</th> 
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">รายละเอียดสถานะ</th> 
                
                        </tr >
                    </thead>
                    <tbody>
                   
                            <tr height="20">                       
                                <td class="text-font" align="center"></td>
                                <td class="text-font text-pedding" style="text-align: center;"></td>
                                <td class="text-font text-pedding" style="text-align: center;"></td>
                                <td class="text-font text-pedding" style="text-align: center;"></td>
                                <td class="text-font text-pedding" ></td>
                                <td class="text-font text-pedding" ></td>  
                                <td class="text-font text-pedding" ></td>
                                <td class="text-font text-pedding" ></td> 
                                <td class="text-font text-pedding" ></td>
                                <td class="text-font text-pedding" ></td> 
                               
                            </tr>
                       
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


   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });
</script>

@endsection