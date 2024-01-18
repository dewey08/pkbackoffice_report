@extends('layouts.account')
   
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
function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }


  function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  
  return $strDay."/".$strMonth."/".$strYear;
  }

  
  function Removeformatetime($strtime)
{
  $H = substr($strtime,0,5);
  return $H;
  }


  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');

  
?>

           
                    <!-- Advanced Tables -->
                    <br>
<br>
<center>    
     <div class="block" style="width: 95%;">

        <!-- Dynamic Table Simple -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>ตั้งคณะกรรมการ</B></h3>
                    <div align="right">
                        <!-- <a href="{{ url('manager_food/infofoodbill_add')}}"  class="btn btn-sm btn-info btn-lg" >ออกใบส่งของ</a> -->
                    </div>
                </div>
            <div class="block-content block-content-full">

           
            <form action="{{ route('maccount.account_boardupdate') }}" method="post">
                @csrf       

                <div class="table-responsive"> 
                    <table class="gwt-table table-striped table-vcenter" style="width: 100%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr height="40">
                                <td style="text-align: center;" >คณะกรรมการ</td>
                                <td style="text-align: center;" >ตำแหน่ง</td>                            
                                <td style="text-align: center;" width="8%">
                                    <a  class="btn btn-success fa fa-plus-square addRow" style="color:#FFFFFF;"></a>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="tbody1">
                            @if($countcheck == 0)
                            <tr height="40">
                                <td>
                                    <select name="ACCOUNT_BOARD_PERSON_ID[]" id="ACCOUNT_BOARD_PERSON_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                        @foreach ($infopersons as $infoperson)
                                            <option value="{{ $infoperson->ID}}" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                        @endforeach     
                                    </select> 

                                </td>
                                <td>
                                    <select name="ACCOUNT_BOARD_POSITION_ID[]" id="ACCOUNT_BOARD_POSITION_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="" >--กรุณาเลือกตำแหน่ง--</option>
                                        <option value="1" >ผู้ตรวจสอบ</option>
                                        <option value="2" >ผู้อนุมัติ</option>
                                        <option value="3" >ผู้ลงบัญชี</option>
                                    </select> 
                                </td>
                            
                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            </tr>      
                            @else
                            @foreach ($infoaccboards as $infoaccboard)
                            <tr height="40">
                                <td>
                                    <select name="ACCOUNT_BOARD_PERSON_ID[]" id="ACCOUNT_BOARD_PERSON_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                            <option value="" >--กรุณาเลือก--</option>
                                        @foreach ($infopersons as $infoperson)
                                            @if($infoaccboard->ACCOUNT_BOARD_PERSON_ID == $infoperson->ID)
                                            <option value="{{ $infoperson->ID}}" selected>{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                            @else
                                            <option value="{{ $infoperson->ID}}" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>
                                            @endif
                                          
                                        @endforeach     
                                    </select> 

                                </td>
                                <td>
                                    <select name="ACCOUNT_BOARD_POSITION_ID[]" id="ACCOUNT_BOARD_POSITION_ID[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                        <option value="" >--กรุณาเลือกตำแหน่ง--</option>
                                        @if($infoaccboard->ACCOUNT_BOARD_POSITION_ID == '1')<option value="1" selected>ผู้ตรวจสอบ</option>@else <option value="1" >ผู้ตรวจสอบ</option> @endif
                                        @if($infoaccboard->ACCOUNT_BOARD_POSITION_ID == '2')<option value="2" selected>ผู้อนุมัติ</option>@else<option value="2" >ผู้อนุมัติ</option> @endif
                                        @if($infoaccboard->ACCOUNT_BOARD_POSITION_ID == '3')<option value="3" selected>ผู้ลงบัญชี</option>@else<option value="3" >ผู้ลงบัญชี</option> @endif
                                    
                                    </select> 
                                </td>
                            
                                <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                            </tr>  
                            @endforeach     

                            @endif                                
                                                        
                        </tbody>
                    </table>
            </div>
            <hr>
        <div class="footer">
            <div align="right">
                <button type="submit"  class="btn btn-sm btn-info btn-lg" >บันทึกข้อมูล</button>
                   
            </div>
        </div>
        </div>
    </div>
    </form>
                
                 
                  
      
                      

@endsection

@section('footer')

<script src="{{ asset('datepicker/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



 <!-- Page JS Plugins -->
<script src="{{ asset('asset/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('asset/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('asset/js/pages/be_comp_charts.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['easy-pie-chart', 'sparkline']); });</script>


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
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

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

    $('.addRow').on('click',function(){
        addRow();
        });

    function addRow(){
        var count = $('.tbody1').children('tr').length;
            var tr =   '<tr>'+
            '<td>'+
            '<select name="ACCOUNT_BOARD_PERSON_ID[]" id="ACCOUNT_BOARD_PERSON_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="" >--กรุณาเลือก--</option>'+
            '@foreach ($infopersons as $infoperson)'+
            '<option value="{{ $infoperson->ID}}" >{{$infoperson->HR_FNAME}} {{$infoperson->HR_LNAME}}</option>'+
            '@endforeach'+     
            '</select>'+ 
            '</td>'+
            '<td>'+
            '<select name="ACCOUNT_BOARD_POSITION_ID[]" id="ACCOUNT_BOARD_POSITION_ID[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
            '<option value="" >--กรุณาเลือกตำแหน่ง--</option>'+
            '<option value="1" >ผู้ตรวจสอบ</option>'+
            '<option value="2" >ผู้อนุมัติ</option>'+
            '<option value="3" >ผู้ลงบัญชี</option>'+
            '</select>'+ 
            '</td>'+
            '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
            '</tr>';
        $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  
</script>



@endsection