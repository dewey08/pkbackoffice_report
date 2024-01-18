@extends('layouts.backend_admin')
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />



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
       padding-left:13px;
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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าหน่วยงาน</h2>

           


                        <div class="block-content">
                        <div class="table-responsive">

                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                  <thead style="background-color: #FFEBCD;">

                   <tr  height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">หน่วยงาน</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ฝ่าย/แผนก</th>
        <th  class="text-font" width="20%" style="border-color:#F0FFFF;text-align: center;">หัวหน้าหน่วยงาน</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">เลือกหัวหน้า</th>



      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infodepartmentsubsubs as $infodepartmentsubsub)
                   <tr  height="40">
                     <td class="text-font" align="center" >{{ $infodepartmentsubsub-> HR_DEPARTMENT_SUB_SUB_ID }}</td>
                     <td class="text-font text-pedding">{{ $infodepartmentsubsub-> HR_DEPARTMENT_SUB_SUB_NAME }}</td>
                     <td class="text-font text-pedding">{{ $infodepartmentsubsub-> HR_DEPARTMENT_SUB_NAME }}</td>
                     <td class="text-font text-pedding">
                     {{ $infodepartmentsubsub-> HR_PREFIX_NAME }}{{ $infodepartmentsubsub-> HR_FNAME }}  {{ $infodepartmentsubsub-> HR_LNAME }}
                     </td>
                     <td class="text-font text-pedding">
                     <a href="#select" data-toggle="modal" class="btn btn-info" onclick="selectleader({{$infodepartmentsubsub-> HR_DEPARTMENT_SUB_SUB_ID}})"><i class="fa fa-list"></i></a>
                     </td>
    

                   </tr>



                   @endforeach
                   </tbody>
                  </table>
                 <br>


  <div id="select" class="modal fade select" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">ตั้งค่าหัวหน้าหน่วยงาน</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('setup.updatedepartsubsubment_h') }}" >
        @csrf
   
      <div class="row push">
      <div>&nbsp;</div>
      <div class="col-sm-2">
    
      </div>
      <div class="col-sm-8">
    
   
    <div id="detail"></div>
   
      
    </div>
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


<script>
 

  
 

 function selectleader(iddep){
     
     // alert(value+"::"+iddep);

      var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.selectupdatedepartsubsubment_h')}}",
              method:"GET",
              data:{iddep:iddep,_token:_token},
           success:function(result){
               $('#detail').html(result);
           }

      })
 }

</script>

<script>

 function switchdepartment(departmentsubsub){
      // alert(budget);
      var checkBox=document.getElementById(departmentsubsub);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.departmentsubsub')}}",
              method:"GET",
              data:{onoff:onoff,departmentsubsub:departmentsubsub,_token:_token}
      })
      }

</script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
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
            $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
<script>
  $(document).ready(function() {
      $('select').select2();
      width: '100%'
      });
</script>
@endsection
