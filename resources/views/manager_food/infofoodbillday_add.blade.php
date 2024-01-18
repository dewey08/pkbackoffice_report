@extends('layouts.food')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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

label{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
           
      } 

      .text-pedding{
   padding-left:10px;
   padding-right:10px;
                    }

                    .form-control{
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

<center>    
     <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">

            <div align="left">
                <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>เพิ่มทะเบียนจัดซื้อรายวัน</B></h3>  
            </div>
            <div align="right">
                <a href="{{ url('manager_food/infofoodbill')}}"  class="btn btn-hero-sm btn-hero-success foo15"  ><i class="fas fa-arrow-circle-left mr-2"></i>ย้อนกลับ</a>
               
            </div>
                    </div>


        <div class="block-content block-content-full">

    <form  method="post" action="{{ route('mfood.infofoodbillday_save') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-sm-2">
            เลขทะเบียน
            </div>
            <div class="col-sm-2">
            <input name="FOOD_BILL_DAY_NUMBER" id="FOOD_BILL_DAY_NUMBER" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$maxnumberuse}}">
            </div>
            <div class="col-sm-2">
            อ้างอิงเลขทะเบียนจัดซื้อ
            </div>
            <div class="col-sm-2 detali_ref">
            <input name="CON_NUM" id="CON_NUM" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>
            <div class="col-lg-1">
            <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".addref"  style="font-family: 'Kanit', sans-serif;font-weight:normal;">เลือก</button>
            </div>
            <div class="col-sm-1">
            วันที่
            </div>
            <div class="col-sm-2">
            <input name="FOOD_BILL_DAY_DATE" id="FOOD_BILL_DAY_DATE" class="form-control input-sm datepicker" data-date-format="mm/dd/yyyy"  style=" font-family: 'Kanit', sans-serif;" value="{{formate(date('Y-m-d'))}}" readonly>
            </div>

        </div>
  <br>
        <div class="row">
            <div class="col-sm-2">
            เรื่อง
            </div>
            <div class="col-sm-10">
            <input name="FOOD_BILL_DAY_NAME" id="FOOD_BILL_DAY_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" >
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-sm-2">
             ผู้ขาย
            </div>
            <div class="col-sm-10">
        
            <select name="FOOD_BILL_DAY_VENDOR" id="FOOD_BILL_DAY_VENDOR" class="form-control input-sm js-example-basic-single detali_vendor" style=" font-family: 'Kanit', sans-serif;" >
                    <option value="" >--กรุณาเลือก--</option>
                @foreach ($infovendors as $infovendor)                              
                    <option value="{{ $infovendor->VENDOR_ID}}" >{{$infovendor->VENDOR_NAME}}</option>                                      
                @endforeach     
            </select> 
            
            
            
            </div>

        </div>

<br>



               



        <div class="footer">
            <div align="right">
                <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-save mr-2" ></i> บันทึก</button>
                    <a href="{{ url('manager_food/infofoodbill')}}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" style="font-family: 'Kanit', sans-serif;font-weight:normal;" ><i class="fas fa-window-close mr-2"></i> ยกเลิก</a>
            </div>
        </div>
        </div>
    </div>
</div>
</form>



    <!--    เมนูเลือก   -->
       
    <div class="modal fade addref" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalref">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">          
                            <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">อ้างอิงทะเบียนขอซื้อ/จ้าง</h2>
                        </div>
                    <div class="modal-body">
                <body>
                    <div class="container mt-3">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
                        <div style='overflow:scroll; height:300px;'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style="text-align: center;border: 1px solid black;" width="20%">เลขทะเบียน</td>
                                    <td style="text-align: center;border: 1px solid black;">รายละเอียด</th>
                                        <td style="text-align: center;border: 1px solid black;">บริษัท</th>
                                    <td style="text-align: center;border: 1px solid black;" width="5%">เลือก</td>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                            
                            @foreach ($suppliesrequests as $suppliesrequest)

                          
                                    <tr>
                                        <td class="text-font text-pedding">{{$suppliesrequest->CON_NUM}}</td>
                                        <td class="text-font text-pedding">{{$suppliesrequest->CON_DETAIL}}</td>
                                        <td class="text-font text-pedding">{{$suppliesrequest->VENDOR_NAME}}</td>
                                   
                                    <td >
                                             <button type="button" class="btn btn-hero-sm btn-hero-info"  style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  onclick="selectrequest({{$suppliesrequest->ID}});selectdetalivendor({{$suppliesrequest->ID}});">เลือก</button> 
                                         
                                        </td>
                                    </tr>
                           
                                    @endforeach 
                            </tbody>
                        </table>    
                    </div>
                </div>
                </div>
                    <div class="modal-footer">
                        <div align="right">
                                <button type="button" style="font-family: 'Kanit', sans-serif;font-weight:normal;" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i> ปิดหน้าต่าง</button>
                        </div>
                    </div>
                </body>
            </div>
          </div>
        </div>  
                  

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>

$(document).ready(function() {
    $('select').select2();
});

   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

   

    function selectrequest(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mfood.selectrequestfood')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_ref').html(result);
                   }
           })

           $('#modalref').modal('hide');

  }

  
  function selectdetalivendor(id){
      
    
      var _token=$('input[name="_token"]').val();
           $.ajax({
                   url:"{{route('mfood.selectdetalivendor')}}",
                   method:"GET",
                   data:{id:id,_token:_token},
                   success:function(result){
                    $('.detali_vendor').html(result);
                   }
           })

  }


  

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