@extends('layouts.backend_admin')




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

      table, td, th {
    border: 1px solid black;
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
<?php  
  $m_budget = date("m");
  
  if($m_budget>9){
    $yearbudget = date("Y")+544;
  }else{
    $yearbudget = date("Y")+543;
  }

 if( $budget == $yearbudget){
      $check = $yearbudget;
 }else{
      $check = $budget;
 }
 
?>

           
                    <!-- Advanced Tables -->
                   
                <div class="content">
                <div class="block block-rounded block-bordered">

    
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                <div class="col-md-3">
                กำหนดค่าวันลาพักผ่อน ในงบปี 
                </div>
                <div class="col-md-2">
                <form method="post" action="{{ route('setup.selectbudget') }}">
                @csrf
                <select name="LEAVE_YEAR_ID" id="LEAVE_YEAR_ID" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 13px;" >
                                    @foreach ($budgetyears as $budgetyear) 
                                            @if($budgetyear ->LEAVE_YEAR_ID == $check)
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}" selected>{{ $budgetyear ->LEAVE_YEAR_ID  }}</option>
                                            @else
                                            <option value="{{ $budgetyear ->LEAVE_YEAR_ID  }}">{{ $budgetyear ->LEAVE_YEAR_ID }}</option>
                                            @endif
                                    @endforeach 
                                    </select> 
                </div>
                <div class="col-md-2">
                <button type="submit" class="btn btn-primary" >แสดง</button>
                </div>
                </form>
                
                @if($check>$max)
                <div class="col-md-4">
               <a href="{{ url('admin_leave/setupinfovacation/calleaveday/'.$check) }}"  class="btn btn-success btn-lg"  >ประมวลผลยกยอดปีงบที่แล้ว</a>
               </div>
               @else
               <div class="col-md-3">
               </div>
               <div class="col-md-2">
               <a href="{{ url('admin_leave/setupinfovacation/export_excel/excel/'.$check) }}"  class="btn btn-success btn-lg"  >Excel</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>
               @endif
             
             
               </div>
               
               </h2>  
               <div class="row">
               <div class="col-md-4">
                      @if($check>=$max)
                        <a href="{{ url('admin_leave/setupinfovacation/create') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มกำหนดค่าวันลาพักผ่อน</a>
                        @endif  
                        </div>  
                        <div class="col-md-3">
                       </div>         
                    <div class="col-md-3">
                  <span>
                  <form method="post" action="{{ route('setup.search') }}">
                  @csrf
                 <input type="search"  name="search" id="search" class="form-control" >
                 <input type="hidden"  name="LEAVE_YEAR_ID" id="LEAVE_YEAR_ID" class="form-control" value="{{ $check }}">
                </span>
                 </div>
                
                 <div class="col-md-2">
                 <span>
                     <button type="submit" class="btn btn-info" >ค้นหา</button>
                     </form>
                 </span> 
                 </div>  
                 </div>  
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr height="40">
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">ลำดับ</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="5%">รหัส</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อ นามสกุล</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ประเภทบุคคล</th>
        <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="15%">ปีงบประมาณนี้ลาได้</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">อายุทำงาน</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">วันลาสะสม</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">วันลาปีงบประมาณนี้</th>
        <th class="text-font"  style="border-color:#F0FFFF;text-align: center;" width="10%">ปีงบประมาณ</th>
        @if($check>=$max)
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th> 
        @endif  
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $count=0; ?> 
                   @foreach ($infoinfovacations as $infoinfovacation)
                   <?php $count++; ?> 
                   <tr height="40">
                    <td class="text-font" align="center">{{ $count }}</td> 
                     <td class="text-font" align="center">{{ $infoinfovacation-> ID }}</td> 
                     <td class="text-font text-pedding">{{ $infoinfovacation-> HR_FNAME }} {{ $infoinfovacation-> HR_LNAME }}</td> 
                     <td class="text-font text-pedding">{{ $infoinfovacation-> HR_PERSON_TYPE_NAME }}</td> 
                     <td class="text-font" align="center">{{ number_format($infoinfovacation-> DAY_LEAVE_OVER_BEFORE,1) }}</td> 
                     <td class="text-font" align="center">{{ $infoinfovacation-> OLDS }}</td> 
                     <td class="text-font" align="center">{{number_format( $infoinfovacation-> DAY_LEAVE_COLLECT) }}</td> 
                     <td class="text-font" align="center" >{{number_format($infoinfovacation-> DAY_LEAVE_OVER,1) }}</td> 
                     <td class="text-font" align="center">{{ $infoinfovacation-> OVER_YEAR_ID }}</td> 
                     @if($check>=$max)

                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_leave/setupinfovacation/edit/'.$infoinfovacation-> ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('admin_leave/setupinfovacation/destroy/'.$infoinfovacation-> ID )  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลรหัส {{$infoinfovacation-> ID}} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>
                     </td>   


                     @endif                     
                   </tr> 
                   @endforeach 
                   </tbody>
                  </table>
                  <center><div style="font-family: 'Kanit', sans-serif; font-size: 15px;font-size: 1.0rem;font-weight:normal;">จำนวน {{$countperson}} รายการ</div></center>
                  <br>
                



                
                 
@endsection

@section('footer')
<script>

function selectbudget(){
       
        var LEAVE_YEAR_ID=document.getElementById("LEAVE_YEAR_ID").value;

        //alert(date_end);

        var _token=$('input[name="_token"]').val();
             $.ajax({
                     url:"{{route('setup.selectbudget')}}",
                     method:"GET",
                     data:{LEAVE_YEAR_ID:LEAVE_YEAR_ID,_token:_token},
                     success:function(result){
                      location.reload();
                     }
                     
             })
             }        


           

             </script>

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