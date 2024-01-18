@extends('layouts.risk')   
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

    function timeformate($strtime)
  {   
    list($a,$b) = explode(':',$strtime);
    return $a.":".$b;
    }
?>
<br><br><br><center>
     <div>
        <div class="block block-rounded block-bordered">


        <div class="block-content">
        <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าฟังก์ชันความเสี่ยง</h2>
             
                <div class="block-content">
                <div class="table-responsive">

          <table class="gwt-table table-striped table-vcenter" width="100%">
          <thead style="background-color: #FFEBCD;">

           <tr height="40">
<th class="text-font" style="border-color:#111111;text-align: center;" width="5%">รหัส</th>
<th class="text-font" style="border-color:#111111;text-align: center;">ฟังก์ชัน</th>
<th class="text-font" width="5%" style="border-color:#111111;text-align: center;">เปิดใช้</th>




</tr>
           </tr>
           </thead>
           <tbody>
       
            @foreach ($inforiskfunctions as $inforiskfunction)
            <tr height="40">
              <td class="text-font" align="center">{{ $inforiskfunction-> RISK_FUNCTION_ID }}</td>
              <td class="text-font text-pedding">{{ $inforiskfunction-> RISK_FUNCTION_NAME }}</td>

              <td align="center" width="10%">
              <div class="custom-control custom-switch custom-control-lg ">
             @if($inforiskfunction-> ACTIVE == 'True' )
             <input type="checkbox" class="custom-control-input" id="{{ $inforiskfunction-> RISK_FUNCTION_ID }}" name="{{ $inforiskfunction-> RISK_FUNCTION_ID }}" onchange="switchactive({{ $inforiskfunction-> RISK_FUNCTION_ID }});" checked>
             @else
             <input type="checkbox" class="custom-control-input" id="{{ $inforiskfunction-> RISK_FUNCTION_ID }}" name="{{ $inforiskfunction-> RISK_FUNCTION_ID }}" onchange="switchactive({{ $inforiskfunction-> RISK_FUNCTION_ID}});">
             @endif
             <label class="custom-control-label" for="{{ $inforiskfunction-> RISK_FUNCTION_ID }}"></label>
             </div>
             </td> 



            </tr>
            @endforeach
           </tbody>
          </table>
          <br>


@endsection

@section('footer')

<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

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
        $('.js-example-basic-single').select2();
    });
</script> 



<script>
 
    function switchactive(idfunc){
         // alert(budget);
         var checkBox=document.getElementById(idfunc);
         var onoff;
   
         if (checkBox.checked == true){
           onoff = "True";
     } else {
           onoff = "False";
     }
 
   
    var _token=$('input[name="_token"]').val();
         $.ajax({
                 url:"{{route('mrisk.riskfunction')}}",
                 method:"GET",
                 data:{onoff:onoff,idfunc:idfunc,_token:_token}
         })
         }        
     
   </script>

@endsection