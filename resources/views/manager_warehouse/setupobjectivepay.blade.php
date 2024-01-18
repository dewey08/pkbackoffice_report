@extends('layouts.warehouse')


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


?>        
                    <!-- Advanced Tables -->
                   
                <div class="content">
                <div class="block block-rounded block-bordered">

    
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าระบบวัตถุประสงค์ของการจ่ายวัสดุ</h2>  
                       
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ url('manager_warehouse/objectivepay/add') }}"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
                      
                              </div>
                          
                      </div>   
                      
                      
                        <div class="mt-3">
                        <div class="table-responsive">      
                
                  <table class="gwt-table table-striped table-vcenter" width="100%">
                  <thead style="background-color: #FFEBCD;">
                  
                   <tr  height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;">รายละเอียด</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;">คำสั่ง</th> 
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody id="myTable">
                   @foreach ($infoobjectivepays as $infoobjectivepay)
                   <tr  height="40">
                     <td class="text-font" align="center" >{{ $infoobjectivepay->OBJECTIVEPAY_ID }}</td> 
                     <td class="text-font text-pedding">{{ $infoobjectivepay->OBJECTIVEPAY_NAME }}</td>  
                  
                     
                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                    <a class="dropdown-item" href="{{ url('manager_warehouse/objectivepay/edit/'.$infoobjectivepay->OBJECTIVEPAY_ID )}}" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_warehouse/objectivepay/delete/'.$infoobjectivepay->OBJECTIVEPAY_ID )  }}" onclick="return confirm('ต้องการที่จะลบข้อมูลรหัส {{ $infoobjectivepay->OBJECTIVEPAY_ID  }} ?')" style="font-family: 'Kanit', sans-serif; font-size: 15px;font-weight:normal;">ลบข้อมูล</a>
                                                  
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


<script>
 
 function switchactive(room){
      // alert(budget);
      var checkBox=document.getElementById(room);
      var onoff;

      if (checkBox.checked == true){
        onoff = "1";
  } else {
        onoff = "2";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.room')}}",
              method:"GET",
              data:{onoff:onoff,room:room,_token:_token}
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