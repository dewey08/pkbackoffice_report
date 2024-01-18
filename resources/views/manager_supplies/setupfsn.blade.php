@extends('layouts.supplies')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

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

    
      .form-control {
    font-size: 13px;
                  }   


                  table {
            border-collapse: collapse;
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


?>
<center>    
    <div class="block" style="width: 95%;">
               

            
                <div class="block-content">    
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">กำหนดข้อมูล เลข FSN</h2> 
                   
                        <div class="table-responsive">    
                        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รหัส</th>
        <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รายละเอียดกลุ่ม</th>
        <th class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เปิดใช้</th>
        <th  class="text-font" width="12%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เลือกกลุ่ม</th> 

         
   
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>

                   @foreach ($suppliesgroups as $suppliesgroup)
                  
                   <tr height="20">
                     <td align="center"  class="text-font">{{$suppliesgroup->GROUP_CODE}}</td>                 
                     <td  class="text-font text-pedding">{{$suppliesgroup->GROUP_NAME}}</td> 
                   
                     <td align="center" width="5%">
                     <div class="custom-control custom-switch custom-control-lg ">
                    @if($suppliesgroup-> ACTIVE == 'True' )
                    <input type="checkbox" class="custom-control-input" id="{{ $suppliesgroup-> GROUP_CODE }}" name="{{ $suppliesgroup-> GROUP_CODE }}" onchange="switchactivefsn({{ $suppliesgroup-> GROUP_CODE }});" checked>
                    @else
                    <input type="checkbox" class="custom-control-input" id="{{ $suppliesgroup-> GROUP_CODE }}" name="{{ $suppliesgroup-> GROUP_CODE }}" onchange="switchactivefsn({{ $suppliesgroup-> GROUP_CODE}});">
                    @endif
                    <label class="custom-control-label" for="{{ $suppliesgroup-> GROUP_CODE }}"></label>
                    </div>
                    </td> 
                   
                    <td align="center">
                     <a href="{{ url('manager_supplies/setupfsnsub/'.$suppliesgroup->GROUP_CODE)  }}"  class="btn btn-hero-sm btn-hero-success"><i class="fas fa-users-cog mr-2"></i></a>
                     </td>

                    
                   </tr> 
 
                   @endforeach 
                   </tbody>
                  </table>

                </div>

                
                  
                  
      
                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>


<script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   

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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    




function switchactivefsn(id){
    
      if(id < 9){
        id = '0'+id;
      }

      //alert(id);

      var checkBox=document.getElementById(id);
      var onoff;

      if (checkBox.checked == true){
        onoff = "True";
  } else {
        onoff = "False";
  }
 //alert(onoff);

 var _token=$('input[name="_token"]').val();
      $.ajax({
              url:"{{route('setup.switchactivefsn')}}",
              method:"GET",
              data:{onoff:onoff,id:id,_token:_token}
      })
      }        
  
</script>

@endsection