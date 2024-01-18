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
<center>    
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
            @if($type == 'salary')
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการรายรับเงินเดือนบุคคล</B></h3>
            @else
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>รายการรายรับค่าตอบแทนบุคคล</B></h3>
            @endif 
                <div align="right">
                    จำนวนรวมข้อมูล <B> {{$countlist}} </B> ยอดรวมเงิน  <B>{{ number_format(ManagercompensationController::sumreceiveall($type),2)}}</B> บาท &nbsp;&nbsp;
                    <a href="#add_list"  data-toggle="modal"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มรายการรับ</a>
                    <a href="{{ url('manager_compensation/infolistreceipt_excel/'.$type)}}"  class="btn btn-hero-sm btn-hero-success" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" ><li class="fa fa-file-excel"></li>&nbsp;Excel</a>
                </div>
            </div>
            <div class="block-content block-content-full">
            
             <div class="table-responsive"> 
                <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table-striped table-vcenter js-dataTable-full" width="100%">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >รายการรายรับ</th>
                          
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="10%">บุคลากร (คน) </th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="15%">จำนวนเงิน (บาท)</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">เปิดใช้</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">บุคคล</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                     @foreach ($info_receipts as $info_receipt)

                    
                        <tr height="20">
                            <td class="text-font" align="center">{{$count}}</td>
                            <td class="text-font text-pedding" >{{$info_receipt->HR_RECEIVE_NAME}}</td> 
                            <td class="text-font text-pedding" align="center">{{ManagercompensationController::countreceive($info_receipt->ID)}}</td> 
                            <td class="text-font text-pedding" align="center" width="15%">{{ number_format(ManagercompensationController::sumreceive($info_receipt->ID),2)}}</td> 
                            <td class="text-font text-pedding" align="center">
                                <div class="custom-control custom-switch custom-control-lg ">
                                    @if($info_receipt-> ACTIVE == 'TRUE' )
                                    <input type="checkbox" class="custom-control-input" id="{{ $info_receipt-> ID }}" name="{{ $info_receipt-> ID }}" onchange="switchinforeceipt({{ $info_receipt-> ID }});" checked>
                                    @else
                                    <input type="checkbox" class="custom-control-input" id="{{ $info_receipt-> ID }}" name="{{ $info_receipt-> ID }}" onchange="switchinforeceipt({{ $info_receipt-> ID }});">
                                    @endif
                                    <label class="custom-control-label" for="{{ $info_receipt-> ID }}"></label>
                                    </div>  
                            
                            
                            </td> 
                            <td align="center" width="7%">
                                <a href="{{ url('manager_compensation/infolistreceipt_infoperson/'.$info_receipt -> ID)}}"   class="btn btn-success fa fa-users-cog"></a>
                            </td>
                          
                             
                            <td align="center" width="5%">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item"  href="#edit_list{{$info_receipt->ID}}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขรายการ</a>
                                                <a class="dropdown-item"  href="{{ url('manager_compensation/infolistreceipt_destroy/'.$info_receipt -> ID.'/'.$type)}}"  onclick="return confirm('ต้องการที่จะลบข้อมูล {{$info_receipt->HR_RECEIVE_NAME}}  ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบรายการ</a>
                      
                                            </div>
                                </div>
                            </td>
                        </tr>

                        <?php  $count++;?>


                        
 <!-----------เข้อมูลเร่งรัด----------->
                  
 <div id="edit_list{{$info_receipt->ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขรายการรับ</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('mcompensation.infolistreceipt_update') }}">
        @csrf
     
        <input type="hidden" name = "ID"  id="ID"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$info_receipt->ID}}">
        <div class="row push">
      <div class="col-sm-3">  
      <label >รายการรับ</label>
      </div>
      <div class="col-sm-7">  
      <input  name = "HR_RECEIVE_NAME"  id="HR_RECEIVE_NAME"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;" value="{{$info_receipt->HR_RECEIVE_NAME}}">
      </div>
      </div>


      <div class="row push">
      <div class="col-sm-3">  
      <label >ประเภทรายการรับ</label>
      </div>
      <div class="col-sm-7">  
     
                <select name="HR_RECEIVE_TYPE" id="HR_RECEIVE_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                        <option value="" >--กรุณาเลือก--</option>
                        @if($info_receipt->HR_RECEIVE_TYPE == 'salary')
                          <option value="salary" selected>เงินเดือน</option>
                          <option value="compen" >ค่าตอบแทน</option>
                        @else
                        <option value="salary" >เงินเดือน</option>
                          <option value="compen" selected>ค่าตอบแทน</option>
                        @endif
               </select>
      
      
      
      </div>
      </div>
   
   
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;"  data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>


  <!----------------------------------->  

                        @endforeach 

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>

 <!-----------เพิ่มข้อมูลเร่งรัด----------->
                  
 <div id="add_list" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
     
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มรายการรับ</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('mcompensation.infolistreceipt_save') }}">
        @csrf
     
     
        <div class="row push">
      <div class="col-sm-3">  
      <label >รายการรับ</label>
      </div>
      <div class="col-sm-7">  
      <input  name = "HR_RECEIVE_NAME"  id="HR_RECEIVE_NAME"  class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
      </div>
      </div>
   
<br>
   
      <div class="row push">
      <div class="col-sm-3">  
      <label >ประเภทรายการรับ</label>
      </div>
      <div class="col-sm-7">  
     
                <select name="HR_RECEIVE_TYPE" id="HR_RECEIVE_TYPE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                        <option value="" >--กรุณาเลือก--</option>
                          <option value="salary" >เงินเดือน</option>
                          <option value="compen" >ค่าตอบแทน</option>
               </select>
      
      
      
      </div>
      </div>
      

      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" >บันทึก</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;font-weight:normal;"  data-dismiss="modal" >ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>


  <!----------------------------------->  
  
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

    function switchinforeceipt(inforeceipt){
       
         var checkBox=document.getElementById(inforeceipt);
         var onoff;
   
         if (checkBox.checked == true){
           onoff = "TRUE";
     } else {
           onoff = "FALSE";
     }
   
    var _token=$('input[name="_token"]').val();
         $.ajax({
                 url:"{{route('mcompensation.inforeceipt')}}",
                 method:"GET",
                 data:{onoff:onoff,inforeceipt:inforeceipt,_token:_token}
         })
         }
   
   </script>


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