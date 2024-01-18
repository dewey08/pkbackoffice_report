@extends('layouts.supplies')   
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


    use App\Http\Controllers\ManagersuppliesController;
    
?>
<?php 

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d');
?>          
<!-- Advanced Tables -->
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการขายทอดตลาด >> รายการครุภัณฑ์จำหน่าย 2563</B></h3>
               <div align="right">
                          <a href="#add_list"  data-toggle="modal"   class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มครุภัณฑ์</a> 
                          <a href=""    class="btn btn-warning btn-lg" ><i class="fas fa-plus"></i> เพิ่มครุภัณฑ์ทั้งหมด</a> 
                          <a href=""    class="btn btn-warning btn-lg" >Excel</a> 
                          <a href="{{ url('manager_supplies/infosoldout/')}}"   class="btn btn-success btn-lg" >ย้อนกลับ</a> 
                    </div>
            </div>
            <div class="block-content block-content-full">


                  
            <div class="table-responsive"> 

                <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead style="background-color: #F0F8FF;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="20%">เลขครุภัณฑ์</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >รายการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภทครุภัณฑ์</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >จำนวน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >อายุการใช้งาน (ปี)</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center" width="7%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>


                    
                        <tr height="20">
                            <td class="text-font" align="center">1</td>
                            <td class="text-font text-pedding" align="center" >	7110-006-0017/57.184 </td> 
                            <td class="text-font text-pedding" > เก้าอี้โครงสแตนเลสที่นั่งไฟเบอร์</td> 
                            <td class="text-font text-pedding" >ครุภัณฑ์สำนักงาน</td> 
                            <td class="text-font text-pedding" >1</td>
                            <td class="text-font text-pedding" >9</td>
   
                            <td align="center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href=""  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไข</a>
                                                <a class="dropdown-item"  href="" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบรายการ</a>
                      
                                            </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>
       
                                 
                                            
            </div>


            
<!------------------------------->
                                        
 <div id="add_list" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มครุภัณฑ์</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="">
        @csrf
     

      <div class="row push">
      <div class="col-sm-2">  
      <label >เลือกครุภัณฑ์</label>
      </div>
      <div class="col-sm-10">  
      <input  name = ""  id=""  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
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


@endsection