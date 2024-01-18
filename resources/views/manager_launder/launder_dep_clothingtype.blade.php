@extends('layouts.launder')
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
          font-size: 14px;
         
          }
    
          .text-pedding{
       padding-left:10px;
                        }
    
            .text-font {
        font-size: 14px;
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
                    <br>
<br>
<center>    
     <div class="block" style="width: 95%;">
          <div class="block block-rounded block-bordered">
              <div class="block-content">
                      <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">ตั้งค่าประเภทผ้าในหน่วยงาน {{$inforef->LAUNDER_DEP_NAME}}</h2>
                      <div class="row">

                      </div>

                      <form  method="post" action="{{ route('launder.launder_dep_clothingtype_update') }}"  enctype="multipart/form-data"  >      
                        @csrf
                        <input type="hidden" name="DEPID" id="DEPID" value="{{$inforef->LAUNDER_DEP_ID}}">

              <div class="block-content">
                      <div class="table-responsive"> 
                          <table class="gwt-table table-striped table-vcenter js-dataTable" width="100%">
                              <thead style="background-color: #FFEBCD;">                      
                                <tr  height="40">
                                    <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;text-align: center;">ลำดับ</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;" width="50%">ประเภทผ้า</th>
                                    <th  class="text-font" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">จำนวนต่ำสุด</th>
                                    <td style="text-align: center;font-size: 14px;" width="12%">
                                      <a  class="btn btn-success addRow" style="color:#FFFFFF;"><i class="fa fa-plus-square"></i></a>
                                  </td>
                                </tr>
                              </thead>
                          <tbody class="tbody1">
                            <?php $num = 0; $count=1;?>
                            @foreach ($launderdepsubs as $launderdepsub)
                          
                                  <tr  height="40">
                                    <td class="text-font" align="center" >  {{$count}}</td> 
                                    <td>


                                      <select name="LAUNDER_DEP_SUB_TYPE[]" id="LAUNDER_DEP_SUB_TYPE{{$num}}" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                                       <option value="" selected>--กรุณาเลือก--</option>
                                                       @foreach ($infotypes as $infotype)  
                                                         @if($infotype->LAUNDER_TYPE_ID ==  $launderdepsub->LAUNDER_DEP_SUB_TYPE)
                                                         
                                                         <option value="{{ $infotype->LAUNDER_TYPE_ID }}" selected>{{ $infotype->LAUNDER_TYPE_NAME }} </option>           
                                                         @else
                                                         <option value="{{ $infotype->LAUNDER_TYPE_ID }}">{{ $infotype->LAUNDER_TYPE_NAME }} </option>           
                                                         @endif                  
                                                                    
                                                      @endforeach  
                                                       
                                       </select> 
                 
                                  </td>
                                    <td>
                                      <input name="LAUNDER_DEP_SUB_MIN[]" id="LAUNDER_DEP_SUB_MIN{{$num}}" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;"  value="{{number_format($launderdepsub->LAUNDER_DEP_SUB_MIN,2,".","")}}" >
                                  </td>
                                   
                                      <td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt "></i></a></td>
                                                     

                    
                   </tr> 

    
                   <?php $num++; $count++;?>
                   @endforeach 
        

                  
                   </tbody>
                  </table>
                 <br>

                 <div class="modal-footer">
                  <div align="right">
                  <button type="submit"  style="font-family: 'Kanit', sans-serif;" class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
                  <a href="{{ url('manager_launder/launder_dep')  }}" style="font-family: 'Kanit', sans-serif;" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
                  </div>
          
                  </form>
                </div>
                      

@endsection

@section('footer')

<script src="{{ asset('select2/select2.min.js') }}"></script>
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

  
$(document).ready(function() {
    $("select").select2({ width: '100%'});
});

  

$('.addRow').on('click',function(){

        addRow();
        $("select").select2();
    });

    function addRow(){
    var count = $('.tbody1').children('tr').length;
    var number =  (count + 1).valueOf();
 
        var tr = '<tr  height="40">'+
                  '<td class="text-font" align="center" >'+number+'</td>'+
                  '<td>'+
                  '<select name="LAUNDER_DEP_SUB_TYPE[]" id="LAUNDER_DEP_SUB_TYPE'+number+'" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                    '<option value="" selected>--กรุณาเลือก--</option>'+
                    '@foreach ($infotypes as $infotype)'+  
                    '<option value="{{ $infotype->LAUNDER_TYPE_ID }}">{{ $infotype->LAUNDER_TYPE_NAME }} </option>'+                                                                      
                    '@endforeach'+                       
                    '</select>'+ 
                    '</td>'+
                    '<td>'+
                    '<input name="LAUNDER_DEP_SUB_MIN[]" id="LAUNDER_DEP_SUB_MIN'+number+'" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;"   >'+
                    '</td>'+ 
                    '<td style="text-align: center;"><a class="btn btn-danger remove" style="color:#FFFFFF;"><i class="fa fa-trash-alt "></i></a></td>'+
                   '</tr>';
    $('.tbody1').append(tr);
    };

    $('.tbody1').on('click','.remove', function(){
        $(this).parent().parent().remove();
});

</script>



@endsection