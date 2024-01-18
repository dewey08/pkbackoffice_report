@extends('layouts.car')
   
 
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

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
<?php

  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

 list($a,$b,$c,$d) = explode('/',$url); 
?>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
           
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
      
       
</style>

<center>    
        <div class="block" style="width: 95%;">
            <!-- Dynamic Table Simple -->
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ตั้งค่าชื่อฟอร์มขอใช้รถ แบบ ๓</B></h3>
                    <button class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target="#addModal" style="font-family:'Kanit',sans-serif;font-size:16px;font-weight:normal;"><i class="fas fa-plus mr-2"></i>เพิ่มข้อมูล</button> 
                </div>
                <div class="block-content block-content-full">


                <div class="table-responsive">
                    <table class="table-bordered table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                        <thead style="background-color: #FFEBCD;">
                            <tr height="40">
                            <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">ลำดับ</th>
                                <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" >ชื่อฟอร์ม</th>
                                <th class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">สถานะ</th>
                            </tr >
                        </thead>
                        <tbody>
                        

                        <?php $number = 0; ?>
                        @foreach ($functionform as $functionform)
                        <?php $number++; ?>

                            <tr height="20">
                                <td class="text-font"style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="5%">{{$number}}</td>
                                <td class="text-font text-pedding" style="border-color:#F0FFFF;text-align: left;border: 1px solid black;" >{{ $functionform->CAR_FUNCTION_NAME}}</td>
                      
                                    <td align="center" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="7%">
                                        <div class="custom-control custom-switch custom-control-lg ">
                                       @if($functionform-> CAR_FUNCTION_STATUS == 'True' )
                                       <input type="checkbox" class="custom-control-input" id="{{ $functionform-> CAR_FUNCTION_ID }}" name="{{ $functionform-> CAR_FUNCTION_ID }}" onchange="switchactive_form({{ $functionform-> CAR_FUNCTION_ID }});" checked>
                                       @else
                                       <input type="checkbox" class="custom-control-input" id="{{ $functionform-> CAR_FUNCTION_ID }}" name="{{ $functionform-> CAR_FUNCTION_ID }}" onchange="switchactive_form({{ $functionform-> CAR_FUNCTION_ID}});">
                                       @endif
                                       <label class="custom-control-label" for="{{ $functionform-> CAR_FUNCTION_ID }}"></label>
                                       </div>
                                       </td> 
                                                                                       
                            </tr>
                            @endforeach   
                        
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

          {{-- Modal addrisktimeleModal--}}
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info shadow-lg">
                        <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">เพิ่มข้อมูลชื่อฟอร์ม</h5>
                    </div>
                    <div class="modal-body">
                         <form method="POST" action="{{ route('mcar.carname_formtree_save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row text-left">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label" > ชื่อฟอร์ม :</label>
                                    <input type="text" class="form-control" id="CAR_FUNCTION_NAME" name="CAR_FUNCTION_NAME" required>
                                    </div>
                                </div>
                                                       
                            </div>

                          
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                        <a href="{{ url('manager_car/carname_formtree')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                    </div>
                </div>
                 </form>
            </div>
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
 <script src="{{ asset('select2/select2.min.js') }}"></script>
 <script>

        $(document).ready(function() {
            $('select').select2();
        });

 </script> 
<script>
 
    function switchactive_form(idfunc){
         // alert(budget);
         var checkBox=document.getElementById(idfunc);
         var onoff;
   
         if (checkBox.checked == true){
           onoff = "True";
     } else {
           onoff = "False";
     }
    //alert(onoff);
   
    var _token=$('input[name="_token"]').val();
         $.ajax({
                 url:"{{route('mcar.switchactive_form')}}",
                 method:"GET",
                 data:{onoff:onoff,idfunc:idfunc,_token:_token}
         })
         }        
     
   </script>
<script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                todayHighlight: true,
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

    function chkmunny(ele){
        var vchar = String.fromCharCode(event.keyCode);
        if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
        ele.onKeyPress=vchar;
        }
   
  
</script>



@endsection
