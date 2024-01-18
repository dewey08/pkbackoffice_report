@extends('layouts.headorg')
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />



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
?>

<style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 15px;
           
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
      
                  table, td, th {
            border: 1px solid black;
            }  
       
</style>

<br>
<br>
<center>
<!-- Dynamic Table Simple -->
<body onload="detail({{$infocarnomal->RESERVE_ID}})">
                             
                                  
                                        <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                        <div class="modal-header">

                                        <div class="row">
                                        <div><h3  style="font-family: 'Kanit', sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดการขอใช้รถทั่วไป&nbsp;&nbsp;</h3></div>
                                        </div>
                                            </div>
                                            <div class="modal-body" >
                                                <form  method="post" action="{{ route('horg.updateinfocarnomalapp') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden"  name="RESERVE_ID" value="{{$infocarnomal->RESERVE_ID}}"/>


                                             <div id="detail"></div>


                                            </div>
                                            <div class="modal-footer">
                                                <div align="right">
                                                    <button type="submit" name = "SUBMIT"  class="btn btn-success btn-lg" value="approved" style="font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">อนุมัติ</button>
                                                    <button type="submit"  name = "SUBMIT"  class="btn btn-danger btn-lg" value="not_approved" style="font-family: 'Kanit', sans-serif;font-size: 13px;font-weight:normal;">ไม่อนุมัติ</button>
                                                    <a href="{{ url('person_headorg/infocar')}}"  class="btn btn-hero-sm btn-secondary" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">ปิดหน้าต่าง</a>
                                                   
                                                    {{-- <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-size: 1.0rem;font-weight:normal;">ปิดหน้าต่าง</button> --}}
                                            </div>
                                            </div>
                                            </form>
                                    </body>


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


<script>

    
function detail(id){

var type = 'nomal';

  $.ajax({
             url:"{{route('car.detailcar')}}",
            method:"GET",
             data:{type:type,id:id},
             success:function(result){
                 $('#detail').html(result);


                //alert("Hello! I am an alert box!!");
             }

     })

}

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
