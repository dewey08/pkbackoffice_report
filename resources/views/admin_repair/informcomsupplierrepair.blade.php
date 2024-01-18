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
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าร้านซ่อม</h2>  
                   
                    <div class="row">
                        <div class="col-lg-8">
                            <a href="{{ url('admin_repair/Setupinformcomsupplierrepair/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูลร้านซ่อม</a>
           
                          </div>
                        
                  </div>   
                    
           
           
                    <div class="block-content">
                <div class="table-responsive">    
                  <table class="gwt-table table-striped table-vcenter js-dataTable-full" width="100%">
                      <thead style="background-color: #FFEBCD;">
                          <tr  height="40">
                                <th  class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
                                <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">ชื่อร้านซ่อม</th>
                                <th  class="text-font"  width="25%" style="border-color:#F0FFFF;text-align: center;">ที่อยู่</th>  
                                <th  class="text-font"  width="10%" style="border-color:#F0FFFF;text-align: center;">PHONE</th> 
                                <th  class="text-font"  width="10%" style="border-color:#F0FFFF;text-align: center;">FAX</th>
                                <th  class="text-font"  width="10%" style="border-color:#F0FFFF;text-align: center;">MOBILE</th>
                                <th  class="text-font"  width="10%" style="border-color:#F0FFFF;text-align: center;">CONTACT</th>                               
                                <th  class="text-font"  width="10%" style="border-color:#F0FFFF;text-align: center;">EMAIL</th>
                                <th  class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th> 
                            </tr>
                          </tr>
                      </thead>
                      <tbody id="myTable">
                          @foreach ($informcomsupplierrepairT as $informcomsupplierrepair)
                              <tr  height="40">
                                    <td class="text-font" align="center" >{{ $informcomsupplierrepair-> SUPPLIER_ID }}</td>                                     
                                    <td class="text-font text-pedding" >{{ $informcomsupplierrepair-> SUPPLIER_NAME }}</td> 
                                    <td class="text-font text-pedding" >{{ $informcomsupplierrepair-> ADDRESS }}</td>
                                    <td class="text-font" align="center" >{{ $informcomsupplierrepair-> PHONE }}</td>                                     
                                    <td class="text-font text-pedding" >{{ $informcomsupplierrepair-> FAX }}</td> 
                                    <td class="text-font text-pedding" >{{ $informcomsupplierrepair-> MOBILE }}</td>
                                    <td class="text-font text-pedding" >{{ $informcomsupplierrepair-> CONTACT }}</td> 
                                    <td class="text-font text-pedding" >{{ $informcomsupplierrepair-> EMAIL }}</td>
                                   
                                    <td align="center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ทำรายการ</button>
                                        <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item" href="{{ url('admin_repair/Setupinformcomsupplierrepair/edit/'.$informcomsupplierrepair-> SUPPLIER_ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                <a class="dropdown-item" href="{{ url('admin_repair/Setupinformcomsupplierrepair/destroy/'.$informcomsupplierrepair-> SUPPLIER_ID )  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลรหัส {{ $informcomsupplierrepair-> SUPPLIER_ID  }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>                                
                                        </div>
                                      </div>
                                    </td>   
                              </tr> 
                          @endforeach 
                      </tbody>
                  </table>
            <br>
@endsection

@section('footer')

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
 
  function switchactiveinformcomengineer(informcomengineer){
       // alert(budget);
       var checkBox=document.getElementById(informcomengineer);
       var onoff;
 
       if (checkBox.checked == true){
         onoff = "True";
   } else {
         onoff = "False";
   }
  //alert(onoff);
 
  var _token=$('input[name="_token"]').val();
       $.ajax({
               url:"{{route('setup.informcomengineer')}}",
               method:"GET",
               data:{onoff:onoff,informcomengineer:informcomengineer,_token:_token}
       })
       }        
   
 </script>

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
