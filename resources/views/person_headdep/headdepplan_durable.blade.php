@extends('layouts.headdep')   
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
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แผนจัดซื้อครุภัณฑ์</B></h3>
                <a href="{{ url('person_headdep/durable_add') }}"    class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
            </div>
            <div class="block-content block-content-full">

            
            <form action="" method="post">
@csrf

                            <div class="row">
                            <div class="col-sm-0.5">
                                                        &nbsp;&nbsp; ปีงบ &nbsp;
                                                    </div>
                                                    <div class="col-sm-1.5">
                                                    <span>
                                                            <select name="BUDGET_YEAR" id="BUDGET_YEAR" class="form-control input-lg budget" style=" font-family: 'Kanit', sans-serif;">
                                                            <option value="">2563</option>                       
                                                            </select>
                                                        </span>
                                                    </div>

                                                    <div class="col-sm-0.5">
                            &nbsp;ประเภทแผน &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>
                            <select name="SEND_STATUS" id="SEND_STATUS" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                            <option value="">--ทั้งหมด--</option>
                            <option value="">ทีมประสาน</option>
                            <option value="">หน่วยงาน</option>
                            </select>
                            </span>
                            </div> 

                            <div class="col-sm-0.5">
                            &nbsp;ค้นหา &nbsp;
                            </div>

                            <div class="col-sm-2">
                            <span>

                            <input type="search"  name="search" class="form-control" style="font-family: 'Kanit', sans-serif;font-weight:normal;" value="">

                            </span>
                            </div>

                            <div class="col-sm-30">
                            &nbsp;
                            </div> 
                            <div class="col-sm-1">
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
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ปีงบ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภท</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รหัส</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ทีมประสาน/หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	แผนงาน/โครงการ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ค่าครุภัณฑ์/ที่ดิน/สิ่งก่อสร้าง/จ้างเหมา	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ราคาต่อหน่วย	</th>
         
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	แหล่งงบประมาณ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ใช้จริง	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ผู้รับผิดชอบ	</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >	ผลการพิจารณา	</th>


                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="10%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>

                    <?php $number = 0; ?>
                                @foreach ($infodurables as $infodurable)
                    <?php $number++; ?>
                   
                        <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->BUDGET_YEAR}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_TYPE}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_NUMBER}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_TEAM_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_ASS_NAME}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->DUR_ASS_PICE_UNIT}}</td>
                                <td class="text-font text-pedding" >{{$infodurable->BUDGET_ID}}</td>
                                <td class="text-font text-pedding" ></td>
                                <td class="text-font text-pedding" ></td>
                               

                               
                                <td align="center" width="10%">
                  
                                </td> 
                                <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#detail_repaircom"  data-toggle="modal"  style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;" >รายละเอียด</a>   
                                              
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