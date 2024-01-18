@extends('layouts.person')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

       .text-pedding{
   padding-left:10px;
}

.text-font {
    font-size: 13px;
}   
</style>

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
           
        <center>
                   
                <div style="width:95%;" >
                  
                <div class="block block-rounded block-bordered">

               
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                <div class="col-md-10">
                กำหนดข้อมูลตำแหน่ง &nbsp; {{$infofun->FUNTION_NAME}}
                </div>
                
             
             
               <div class="col-md-1">
               <a href="{{ url('manager_person/setupfuntionalcompetency') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               </div>
                
                
                </h2> 
                     
                        <div class="row">
                            <div class="col-lg-2">
                                <a href="" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มตำแหน่ง</a>
                            </div>
                      
                      </div> 
                       
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">
        <th class="text-font"  width="15%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th>
            
        <th class="text-font"  width="5%" style="border-color:#F0FFFF;text-align: center;">ลบ</th>
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($funpositions as $funposition)
                   <tr height="40">
                     <td class="text-font"  align="center">{{ $funposition-> FUN_POSITION_ID }} </td>                 
                     <td class="text-font text-pedding">{{ $funposition-> FUN_POSITION_NAME }}</td> 
                   
                   
                     <td align="center">
                     <a href="{{ url('manager_person/setupfuntionalcompetencyposition_destroy/'.$funposition-> FUNTION_ID.'/'.$funposition-> FUNTION_POSITION_ID)  }}" class="btn btn-danger fa fa-times" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')"></a>
                     </td>   
                    
                   </tr> 
 
                   @endforeach 
                   </tbody>
                  </table>

                  


                  <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มข้อมูลสิทธิ์เจ้าหน้าที่</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('mperson.setupfuntionalcompetencyposition_save') }}" >
        @csrf
        <div class="row push">
      <div >&nbsp;</div>
      <div class="col-sm-2">
      <label >ตำแหน่ง</label>
      </div>
      <div class="col-sm-8">
      <select name="FUN_POSITION_ID" id="FUN_POSITION_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;">
                    <option value="">--กรุณาเลือกตำแหน่ง--</option>
                   
                        @foreach ($infopositions as $infoposition)
                                                                 
                               <option value="{{ $infoposition->HR_POSITION_ID  }}">{{ $infoposition->HR_POSITION_NAME}}</option>
                           
                        @endforeach 
    </select>
    </div>
      </div>

            <input type="hidden" name="FUNTION_ID" id="FUNTION_ID" value=" {{$infofun->FUNTION_ID}}">
          
      
            
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
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