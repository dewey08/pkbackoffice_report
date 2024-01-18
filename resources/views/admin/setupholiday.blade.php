@extends('layouts.backend_admin')


<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />


@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
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

if($status=='USER' and $user_id != $id_user  ){
    echo "You do not have access to data.";
    exit();
}
?>


           
                    <!-- Advanced Tables -->
                   
                <div class="content">
                <div class="block block-rounded block-bordered">

    
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                  <div class="col-sm-6">
                    ตั้งค่าประเภทวันหยุดนักขัตฤกษ์
                  </div>
                  <div class="col-sm-3 text-left">
                  &nbsp; &nbsp;
                  </div>
                 <div class="col-sm-3 text-left">
                <a href="" class="btn btn-success btn-lg" data-toggle="modal" data-target=".add" >คำนวณจำนวนวันลาใหม่</a>
                </div>

                </div>
                </h2>  
                      
                        <div class="row">
                               <div class="col-lg-8">
                                <a href="{{ url('admin_leave/setupinfoholiday/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลวันหยุดนักขัตฤกษ์</a>
                      
                              </div>
                              <div class="col-lg-4">
                              <form action="{{ route('setup.infoholidaysearch') }}" method="post">
                              @csrf
                              <div class="row">
                                  <div class="col-sm-6">
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
                                  <div class="col-sm-6">
                                      <span>
                                          <button type="submit" class="btn btn-info" >ค้นหา</button>
                                      </span> 
                                  </div>
                                  </form>   
                            </div>
                            </div>
                          </div>
                      </div>   
               
      
                      
                        <div class="block-content">

                     
                   
                        <div class="table-responsive">      
                
                        <table class="gwt-table table-striped table-vcenter js-dataTable" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
                 
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%">วันที่</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">รายละเอียด</th>
        <th  class="text-font"style="border-color:#F0FFFF;text-align: center;" width="15%">ประเภท</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th> 
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infoholidays as $infoholiday)
                   <tr height="40">
                     <td class="text-font" align="center">{{ DateThai($infoholiday->DATE_HOLIDAY) }}</td> 
                     <td class="text-font text-pedding">{{ $infoholiday-> DATE_COMMENT }}</td>
                    
                     <td class="text-font" align="center">{{ $infoholiday-> DATE_TYPE }}</td>

                                         <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_leave/setupinfoholiday/edit/'.$infoholiday -> ID)}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('admin_leave/setupinfoholiday/destroy/'.$infoholiday->ID)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $infoholiday-> DATE_COMMENT }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>
                     </td>    

                  
                   </tr> 
                   @endforeach 
                   </tbody>
                  </table>
                

                  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <div class="modal-header">
                          
                          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">คำนวณวันลาใหม่</h2>
                        </div>
                        <div class="modal-body">
                        <body>
                        <form  method="post" action="{{ route('admin.callnewholiday') }}" > 
                        @csrf
                  
                      <div class="row push">
                      <div>&nbsp;</div>
                      <div class="col-sm-2">
                      <label >ตั้งแต่วันที่</label>
                      </div>
                      <div class="col-sm-8">
                      <input  name = "DATE_BIGIN"  id="DATE_BIGIN"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"   readonly>
                      </div>
                      
                      </div>
                      <div class="row push">
                      <div>&nbsp;</div>
                      <div class="col-sm-2">
                      <label >ถึงวันที่</label>
                      </div>
                      <div class="col-sm-8">
                      <input  name = "DATE_END"  id="DATE_END"  class="form-control input-lg datepicker" data-date-format="mm/dd/yyyy"   readonly>

                      </div>
                    
                   
                  
                      

                      </div>
                        <div class="modal-footer">
                        <div align="right">
                        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >ยืนยันการคำนวณ</button>
                        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" >ยกเลิก</button>
                        </div>
                        </div>
                        </form>  
                </body>
                    
                    
                    </div>
                  </div>
                </div>

                <br>                       
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


$(document).ready(function () {

      $('.datepicker').datepicker({
          format: 'dd/mm/yyyy',
          todayBtn: true,
          language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
          thaiyear: true,
          autoclose: true                         //Set เป็นปี พ.ศ.
      });  //กำหนดเป็นวันปัจุบัน
});





    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    
</script>
@endsection