@extends('layouts.launder')
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
        font-size: 14px;
       
        }
  
        .text-pedding{
     padding-left:10px;
                      }
  
          .text-font {
      font-size: 14px;
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
                    <br>
<br>
<center>    
     <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

    
                               <!-- Dynamic Table Simple -->
                               <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขประเภทเสื้อผ้า</B></h3>

                </div>
    <form  method="post" action="{{ route('launder.launder_clothingtype_update') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf
        <div class="block-content">
        
        <input type="hidden" name = "LAUNDER_TYPE_ID"  id="LAUNDER_TYPE_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infotyperef->LAUNDER_TYPE_ID}}">

        <div class="row">
            <div class="col-md-2">
            <p style="text-align: left" >ประเภทเสื้อผ้า</p>
            </div>
            <div class="col-md-3">
            <input  name = "LAUNDER_TYPE_NAME"  id="LAUNDER_TYPE_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infotyperef->LAUNDER_TYPE_NAME}}">
            </div>
        
        </div>



        <br>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif;">บันทึกข้อมูล</button>
        <a href="{{ url('manager_launder/launder_clothingtype')  }}" class="btn btn-hero-sm btn-hero-danger" style="font-family: 'Kanit', sans-serif;" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

        </form>

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



@endsection