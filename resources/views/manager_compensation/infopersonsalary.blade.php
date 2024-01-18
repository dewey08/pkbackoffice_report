@extends('layouts.compensation')   
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

 
    use App\Http\Controllers\ManagercompensationController;
?>         
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ข้อมูลเงินเดือนบุคคล</B></h3>
             
                <div align="right">
             
                
                </div>
            </div>
            <div class="block-content block-content-full">
            <form action="" method="post">
                @csrf
                    <div class="row">  
                    <div class="col-md-0.5" style="  font-size: 13px;";>
                     &nbsp;ปีงบประมาณ &nbsp;
                     </div>

                       <div class="col-md-1">
                       <span>

                       <select name="YEAR_ID" id="YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                      
                       @foreach ($budgets as $budget)
                                                @if($budget->LEAVE_YEAR_ID == $year_id)                                                     
                                            <option value="{{ $budget ->LEAVE_YEAR_ID  }}" selected>{{ $budget->LEAVE_YEAR_ID}}</option>
                                                @else
                                            <option value="{{ $budget ->LEAVE_YEAR_ID  }}">{{ $budget->LEAVE_YEAR_ID}}</option>
                                            @endif
                                                              
                                    @endforeach                           

                    </select>
                     </span>
                      </div>
                     
                     
                        <div class="col-md-3">
                            <span>
         
                            <button type="submit" name = "SUBMIT"  value="search" class="btn btn-info" >ค้นหา</button>
                            
                            
                    
                            </span> 
                        </div>

                    </div>  
            </form>
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="gwt-table table-striped table-hover table-vcenter js-dataTable" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ชื่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >ตำแหน่ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >หน่ายงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >เลขบัญชี</th>
                           
     
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;" >คำสั่ง</th>
                        </tr >
                    </thead>
                    <tbody>

                   
                    <?php $count=1;?>
                     @foreach ($infopersons as $infoperson)

                   
                        <tr height="20">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->POSITION_IN_WORK}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_DEPARTMENT_SUB_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->BOOK_BANK_NUMBER}}</td>
                      
                       
                        <td align="center">
                                        <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                             
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/infopersonsalarydetail/'.$infoperson->ID)  }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;"  >รายละเอียด</a>
                                                </div>
                                        </div>
                                        </td>     
            
                        </tr>
                        
                        <?php  $count++;?>
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


function salarydetailperson(id){

// alert('test');

$.ajax({
                url:"{{route('compensation.salarydetailperson')}}",
                method:"GET",
                data:{id:id},
                success:function(result){
                   $('.detail').html(result);
                   $('#detailsalaryperson').modal('show');
                   //alert("Hello! I am an alert box!!");
                }
                
        })


}


function salarydetailpersonsearch(id,year,month){

// alert('test');

$.ajax({
                url:"{{route('compensation.salarydetailpersonsearch')}}",
                method:"GET",
                data:{id:id,year:year,month:month},
                success:function(result){
                   $('.detail').html(result);
                   $('#detailsalarypersonsearch').modal('show');
                   //alert("Hello! I am an alert box!!");
                }
                
        })


}



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