@extends('layouts.crm')   
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
      font-size: 10px;
      font-size: 1.0rem;
      }

      label{
            font-family: 'Kanit', sans-serif;
            font-size: 10px;
            font-size: 1.0rem;
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
      
      
      .form-control{
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


?>
<?php
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
  
?>         

<center>    
    <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
        
              <div class="block-header block-header-default">
                <h3 class="block-title text-left" style="font-family: 'Kanit', sans-serif;"><B>ประเภททรัพย์</B></h3>
                &nbsp;&nbsp;
          
                <a href="{{ url('manager_crm/donationwealth_add')}}"  class="btn btn-hero-sm btn-hero-info foo14 loadscreen" ><i class="fas fa-plus mr-2"></i> เพิ่มข้อมูล</a>
            </div>  
    <div class="block-content">

   
            <div class="table-responsive">    
           
                <table class="gwt-table table-striped table-vcenter js-dataTable-full" style="width: 100%;">
                    <thead style="background-color: #FFEBCD;">
                        <tr height="40">
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="7%">ลำดับ</th>
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" >ประเภททรัพย์</th>                                                    
                            <th  class="text-font" style="border-color:#F0FFFF;text-align: center; border: 1px solid black;" width="8%">คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody id="myTable">
                   
                    <?php $number = 0; ?>
                        @foreach ($wealths as $wealth)
                        <?php $number++; ?>
                            <tr height="20">
                                <td class="text-font" align="center">{{$number}}</td>                        
                                <td class="text-font text-pedding" >{{$wealth->DONATIONWEALTH_NAME}}</td>                       
                                <td align="center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family:'Kanit',sans-serif;font-size:10px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                    <div class="dropdown-menu" style="width:10px">                           
                                            <a class="dropdown-item loadscreen"  href="{{ url('manager_crm/donationwealth_edit/'.$wealth->DONATIONWEALTH_ID)}}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;">แก้ไข</a>
                                            <a class="dropdown-item "  href="{{ url('manager_crm/donationwealth/destroy/'.$wealth->DONATIONWEALTH_ID)}}"  style="font-family:'Kanit',sans-serif;font-size:13px;font-weight:normal;" onclick="return confirm('คุณต้องการที่จะลบ {{ $wealth->DONATIONWEALTH_ID}} ใช่หรือไม่ ?')">ลบ</a>
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
                             
    

  
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


$(document).ready(function () {

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true,
    autoclose: true                         //Set เป็นปี พ.ศ.
});  //กำหนดเป็นวันปัจุบัน
});

$('.budget').change(function(){
 if($(this).val()!=''){
 var select=$(this).val();
 var _token=$('input[name="_token"]').val();
 $.ajax({
         url:"{{route('admin.selectbudget')}}",
         method:"GET",
         data:{select:select,_token:_token},
         success:function(result){
            $('.date_budget').html(result);
            datepick();
         }
 })
// console.log(select);
 }        
});

function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
</script>

@endsection