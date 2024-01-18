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

  
    use App\Http\Controllers\ManagercompensationController;
?>
        
<!-- Advanced Tables -->
<br>
<br>
<center>    
    <div class="block" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ประมวลผลข้อมูล</B></h3>
             
                <div align="right">
                <a href="{{ url('manager_compensation/infodetailcompensation') }}"  class="btn btn-success btn-lg" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ย้อนกลับ</a>
                
                </div>
            </div>
            <div class="block-content block-content-full">
            <form action="{{route('mcompensation.callcompensationprocess')}}" method="post">
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
                        <div class="col-md-0.5">
                            &nbsp;&nbsp; เดือน &nbsp;
                        </div>
                        <div class="col-md-2">
                     
                        <select name="MONTH_ID" id="MONTH_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                       @if($m_budget == 1)<option value="1" selected>มกราคม</option>@else<option value="1">มกราคม</option>@endif
                       @if($m_budget == 2)<option value="2" selected>กุมภาพันธ์</option>@else<option value="2" >กุมภาพันธ์</option>@endif
                       @if($m_budget == 3)<option value="3" selected>มีนาคม</option>@else<option value="3" >มีนาคม</option>@endif
                       @if($m_budget == 4)<option value="4" selected>เมษายน</option>@else<option value="4" >เมษายน</option>@endif
                       @if($m_budget == 5)<option value="5" selected>พฤษภาคม</option>@else<option value="5" >พฤษภาคม</option>@endif
                       @if($m_budget == 6)<option value="6" selected>มิถุนายน</option>@else<option value="6" >มิถุนายน</option>@endif
                       @if($m_budget == 7)<option value="7" selected>กรกฎาคม</option>@else<option value="7" >กรกฎาคม</option>@endif
                       @if($m_budget == 8)<option value="8" selected>สิงหาคม</option>@else<option value="8" >สิงหาคม</option>@endif
                       @if($m_budget == 9)<option value="9" selected>กันยายน</option>@else<option value="9" >กันยายน</option>@endif
                       @if($m_budget == 10)<option value="10" selected>ตุลาคม</option>@else<option value="10" >ตุลาคม</option>@endif
                       @if($m_budget == 11)<option value="11" selected>พฤศจิกายน</option>@else<option value="11" >พฤศจิกายน</option>@endif
                       @if($m_budget == 12)<option value="12" selected>ธันวาคม</option>@else<option value="12" >ธันวาคม</option>@endif
                   

                    </select>
                        </div>

                        <div class="col-md-0.5">
                            &nbsp;&nbsp; วันที่ &nbsp;
                        </div>
                        <div class="col-md-1">
                     
                        <select name="DAY_ID" id="DAY_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">
                                @if($d_budget== 1)<option value="1" selected>1</option>@else<option value="1">1</option>@endif
                                @if($d_budget == 2)<option value="2" selected>2</option>@else<option value="2" >2</option>@endif
                                @if($d_budget == 3)<option value="3" selected>3</option>@else<option value="3" >3</option>@endif
                                @if($d_budget == 4)<option value="4" selected>4</option>@else<option value="4" >4</option>@endif
                                @if($d_budget == 5)<option value="5" selected>5</option>@else<option value="5" >5</option>@endif
                                @if($d_budget == 6)<option value="6" selected>6</option>@else<option value="6" >6</option>@endif
                                @if($d_budget == 7)<option value="7" selected>7</option>@else<option value="7" >7</option>@endif
                                @if($d_budget == 8)<option value="8" selected>8</option>@else<option value="8" >8</option>@endif
                                @if($d_budget == 9)<option value="9" selected>9</option>@else<option value="9" >9</option>@endif
                                @if($d_budget == 10)<option value="10" selected>10</option>@else<option value="10" >10</option>@endif
                                @if($d_budget == 11)<option value="11" selected>11</option>@else<option value="11" >11</option>@endif
                                @if($d_budget == 12)<option value="12" selected>12</option>@else<option value="12" >12</option>@endif
                                @if($d_budget == 13)<option value="13" selected>13</option>@else<option value="13" >13</option>@endif
                                @if($d_budget == 14)<option value="14" selected>14</option>@else<option value="14" >14</option>@endif
                                @if($d_budget == 15)<option value="15" selected>15</option>@else<option value="15" >15</option>@endif
                                @if($d_budget == 16)<option value="16" selected>16</option>@else<option value="16" >16</option>@endif
                                @if($d_budget == 17)<option value="17" selected>17</option>@else<option value="17" >17</option>@endif
                                @if($d_budget == 18)<option value="18" selected>18</option>@else<option value="18" >18</option>@endif
                                @if($d_budget == 19)<option value="19" selected>19</option>@else<option value="19" >19</option>@endif
                                @if($d_budget == 20)<option value="20" selected>20</option>@else<option value="20" >20</option>@endif
                                @if($d_budget == 21)<option value="21" selected>21</option>@else<option value="21" >21</option>@endif
                                @if($d_budget == 22)<option value="22" selected>22</option>@else<option value="22" >22</option>@endif
                                @if($d_budget == 23)<option value="23" selected>23</option>@else<option value="23" >23</option>@endif
                                @if($d_budget == 24)<option value="24" selected>24</option>@else<option value="24" >24</option>@endif
                                @if($d_budget == 25)<option value="25" selected>25</option>@else<option value="25" >25</option>@endif
                                @if($d_budget == 26)<option value="26" selected>26</option>@else<option value="26" >26</option>@endif
                                @if($d_budget == 27)<option value="27" selected>27</option>@else<option value="27" >27</option>@endif
                                @if($d_budget == 28)<option value="28" selected>28</option>@else<option value="28" >28</option>@endif
                                @if($d_budget == 29)<option value="29" selected>29</option>@else<option value="29" >29</option>@endif
                                @if($d_budget == 30)<option value="30" selected>30</option>@else<option value="30" >30</option>@endif
                                @if($d_budget == 31)<option value="31" selected>31</option>@else<option value="31" >31</option>@endif
                            

                    </select>
                        </div>
                        
                        <div class="col-md-0.5">
                            &nbsp;&nbsp; ประเภท &nbsp;
                        </div>
                        <div class="col-md-2">

                                <select name="TYPE_CODE" id="TYPE_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;  font-size: 13px;">                                           
                                @if($typecode == 'salary')<option value="salary" selected>เงินเดือน</option>@else<option value="salary" >เงินเดือน</option>@endif
                                @if($typecode == 'compen')<option value="compen" selected>ค่าตอบแทน</option>@else<option value="compen" >ค่าตอบแทน</option>@endif                        
                                </select>

                        </div>

                        
                        <input type="hidden"  name="SALARYALL_HEAD_HR_SAVE" id="SALARYALL_HEAD_HR_SAVE" class="form-control"  value="{{$id_user}}" >
                     
                        <div class="col-md-3">
                            <span>
         
                            
                                 <button type="submit" name = "SUBMIT"  value="pocess" class="btn btn-success" style="font-family: 'Kanit', sans-serif;font-weight:normal;">ประมวลผล</button>
                      
                                 <button type="submit" name = "SUBMIT"  value="savepocess"  class="btn btn-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;">บันทึก</button>
                          
                                 

                            </span> 
                        </div>

                    </div>  
            </form>
          
             <div class="table-responsive"> 
             มูลค่ารวม  {{number_format(ManagercompensationController::call_sum($typecode),2)}} บาท 
                <table class="table-striped table-hover table-vcenter js-dataTable" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ตำแหน่ง</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >หน่วยงาน</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ประเภทข้าราชการ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">เลขบัญชี</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายรับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายจ่าย</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >มูลค่าสุทธิ</th>
        
                         
                        </tr >
                    </thead>
                    <tbody>

                    @if($typesub  == 'pocess')
                    <?php $count=1;?>
                     @foreach ($infopersons as $infoperson)
                            @if(ManagercompensationController::call_all($infoperson->ID,$typecode) != 0)
                   
                        <tr height="20" onclick="salarydetailperson_process({{$infoperson->ID}},'{{$typecode}}')">
                        <td class="text-font" align="center">{{$count}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PREFIX_NAME}}{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->POSITION_IN_WORK}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_DEPARTMENT_SUB_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->HR_PERSON_TYPE_NAME}}</td>
                        <td class="text-font text-pedding" >{{$infoperson->BOOK_BANK_NUMBER}}</td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format(ManagercompensationController::call_receive($infoperson->ID,$typecode),2)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format(ManagercompensationController::call_pay($infoperson->ID,$typecode),2)}}</td>
                        <td class="text-font text-pedding" style="text-align: right;" >{{number_format(ManagercompensationController::call_all($infoperson->ID,$typecode),2)}}</td>
                        @endif
            
                        </tr>
                        
                        <?php  $count++;?>
                        @endforeach 
                       
                       @endif


                   

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>


<div class="detail"></div>
                                    
  
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


function salarydetailperson_process(id,typecode){

 //alert(typecode);

$.ajax({
                url:"{{route('compensation.salarydetailperson_process')}}",
                method:"GET",
                data:{id:id,typecode:typecode},
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