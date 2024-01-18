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
                <h2 class="block-title" style="font-family: 'Kanit', sans-serif;">รายงานการประเมินผลการควบคุมภายใน</h2>   
                <div align="right ">
                                <a href="{{ url('manager_risk/excel_risk_evaluate')}}" class="btn btn-success" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;"><i class="fas fa-file-excel text-white" style="font-size:17px"></i>&nbsp;&nbsp;Export Excel</a> 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
                            </div>
                </div>
            <div class="block-content block-content-full">
                       
            <hr>
               <div class="card-body shadow lg"> 
                  
                            <div class="block-content">  
                                <div class="table-responsive"> 
                                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                                        <thead style="background-color: #FFEBCD;">
                                            <tr height="40">                          
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ภารกิจตามกฎหมายที่จัดตั้งหน่วยงานของรัฐหรือภารกิจตามแผนการดำเนินการหรือภารกิจอื่น ที่สำคัญของหน่วยงานของรัฐ/วัตถุประสงค์</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">การควบคุมภายในที่มีอยู่</th> 
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">ความเสี่ยงที่ยังมีอยู่</th> 
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="12%">การปรับปรุงการควบคุมภายใน</th> 
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">หน่วยงานที่รับผิดชอบ</th> 
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">สถานะดำเนินการ</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="20%">วิธีติดตามและสรุปผลการประเมินข้อคิดเห็น</th>
                                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="8%">คำสั่ง</th> 
                                            </tr >
                                        </thead>
                                        <tbody>
                                    
                                                <tr height="20">   
                                                    <td class="text-font text-pedding" style="text-align: center;">-</td>                              
                                                    <td class="text-font text-pedding" >-</td>  
                                                    <td class="text-font text-pedding" >-</td>  
                                                    <td class="text-font text-pedding" >-</td>  
                                                    <td class="text-font text-pedding" >-</td>  
                                                    <td class="text-font text-pedding" >-</td>  
                                                    <td class="text-font text-pedding" >-</td>  
                                                    <td align="center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                            ทำรายการ
                                                        </button>
                                                    <div class="dropdown-menu" style="width:10px">   
                                                            <a class="dropdown-item"  href="{{ url('manager_risk/risk_evaluate_pdf')  }}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">PDF A</a>    
                                                            <a class="dropdown-item"  href="{{ url('manager_risk/risk_evaluate_pdf_b')  }}" style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">PDF B</a> 
                                                        </div>
                                                    </div>                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>   
                            </div>
                          
                        
                    <hr style="color:#F80434 ">
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