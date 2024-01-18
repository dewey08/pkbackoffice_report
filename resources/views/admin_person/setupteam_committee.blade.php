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
                <div class="col-md-10">
                กำหนดข้อมูลทีม  {{$teamid->HR_TEAM_NAME}} - {{$teamid->HR_TEAM_DETAIL}}

               </div>
               <div class="col-md-2">
               <a href="{{ url('admin_person_H/setupinfopersonteam') }}"  class="btn btn-success btn-lg"  >ย้อนกลับ</a>
               <!--<a href="{{ url('admin_leave/setupinfovacation/export_pdf') }}"  class="btn btn-hero-sm btn-hero-danger"  target="_blank">Print</a>-->
               </div>

                </div>
                </h2> 

                       
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ url('admin_person_H/setupinfopersonteam/addcommittee/'.$teamid->HR_TEAM_ID ) }}" class="btn btn-hero-sm btn-hero-info"  ><i class="fas fa-plus"></i> เพิ่มข้อมูลสมาชิกทีมนำองค์กร</a>

                              </div>
                       
                      </div>   


                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">ลำดับ</th>
        <th  class="text-font" width="40%"style="border-color:#F0FFFF;text-align: center;">ชื่อ นามสกุล</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ตำแหน่ง</th> 
        <th  class="text-font" width="12%" style="border-color:#F0FFFF;text-align: center;">ตำแหน่งในทีม</th> 
        <th  class="text-font" width="12%" style="border-color:#F0FFFF;text-align: center;">ตำแหน่งอื่นๆ</th>   
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th>      
   
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   <?php $number=0; ?>
                   @foreach ($infoTeamlists as $infoTeamlist)
                   <?php $number++; ?>
                   <tr height="40">
                     <td align="center"  class="text-font">{{ $number }} </td>                 
                     <td  class="text-font text-pedding">{{ $infoTeamlist->BOARD_NAME}}</td> 
                     <td class="text-font text-pedding">{{ $infoTeamlist-> BOARD_POSITION }}</td>
                     <td class="text-font text-pedding">{{ $infoTeamlist-> TEAM_POSITION_NAME }}</td>
                     <td class="text-font text-pedding">{{ $infoTeamlist-> TEAM_POSITION_ETC }}</td>
                   
                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('admin_person_H/setupinfopersonteam/editcommittee/'.$infoTeamlist->ID.'/'.$teamid->HR_TEAM_ID ) }}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('admin_person_H/setupinfopersonteam/destroypcommittee/'.$infoTeamlist->ID.'/'.$teamid->HR_TEAM_ID ) }}" onclick="return confirm('ต้องการที่จะลบข้อมูล {{ $infoTeamlist-> ID }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
                                                </div> 
                    </div>
                     </td>   
                    
                   </tr> 
 
                   @endforeach 
                   </tbody>
                  </table>

                  

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>

<script>
  $('#edit_modal').on('show.bs.modal', function(e) {
    var Id = $(e.relatedTarget).data('id');
    var VUTId = $(e.relatedTarget).data('vutid');
    $(e.currentTarget).find('input[name="ID"]').val(Id);
    $(e.currentTarget).find('select[id="VUT_ID_edit[]"]').val(VUTId);

});

</script>

<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker2').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });

    $(document).ready(function () {
            
            $('.datepicker3').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true              //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    

    $('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});

  
</script>
  <!-- Page JS Plugins -->
        <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   

        <!-- Page JS Code -->
        <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
        <script>
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