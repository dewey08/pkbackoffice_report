@extends('layouts.supplies')
   
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
                <div class="block block-rounded block-bordered">

            
                <div class="block-content">   
                 
                <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                <div class="col-md-9">
                กำหนดข้อมูล เลข FSN  >> กลุ่ม {{$namesuppliesgroup->GROUP_NAME }} 
                                    >> หมวด {{$namesuppliesclass->CLASS_NAME }}
                                    <br>{{$namesuppliesclass->GROUP_CLASS_CODE }}
                </div>
                <div class="col-md-3">
                <button type="button" class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target=".add" ><i class="fas fa-plus"></i> เพิ่มประเภท</button>
                <a href="{{ url('manager_supplies/setupfsnsub/'.$namesuppliesgroup->GROUP_CODE) }}"  class="btn btn-hero-sm btn-hero-success"><i class="fas fa-undo mr-2"></i>ย้อนกลับ</a>
                </div>
               
                </h2> 
               
                        <div class="table-responsive">    
                        <table class="table-striped table-vcenter js-dataTable-simple" style="width: 100%;">
                  <thead style="background-color: #FFEBCD;">
                  
        <tr height="40">
        <th  class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รหัส</th>
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รหัสหมวด</th>
        <th  class="text-font" width="10%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รหัสประเภท</th>
        <th  class="text-font" width="40%"style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">รายละเอียดประเภท</th>
        <th class="text-font" width="5%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เปิดใช้</th>
        <th  class="text-font" width="12%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">เลือกประเภท</th> 
        <th  class="text-font" width="8%" style="border-color:#F0FFFF;text-align: center;border: 1px solid black;">คำสั่ง</th> 

         
   
        
        
      </tr>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach ($suppliestypes as $suppliestype)
                   <tr height="40">
                     <td align="center"  class="text-font">{{$suppliestype->TYPE_CODE}}</td>   
                     <td align="center"  class="text-font">{{$suppliestype->GROUP_CLASS_CODE}}</td>                
                     <td  class="text-font text-pedding">{{$suppliestype->GROUP_CLASS_CODE}} - {{$suppliestype->TYPE_CODE}}</td> 
                     <td    class="text-font text-pedding">{{$suppliestype->TYPE_NAME}}</td>  
                     <td align="center" width="5%">
                     <div class="custom-control custom-switch custom-control-lg ">
                    @if($suppliestype-> ACTIVE == 'True' )
                    <input type="checkbox" class="custom-control-input" id="{{ $suppliestype-> TYPE_ID }}" name="{{ $suppliestype-> TYPE_ID }}" onchange="switchactivefsnsubsub({{ $suppliestype-> TYPE_ID }});" checked>
                    @else
                    <input type="checkbox" class="custom-control-input" id="{{ $suppliestype-> TYPE_ID }}" name="{{ $suppliestype-> TYPE_ID }}" onchange="switchactivefsnsubsub({{ $suppliestype-> TYPE_ID}});">
                    @endif
                    <label class="custom-control-label" for="{{ $suppliestype-> TYPE_ID }}"></label>
                    </div>
                    </td> 
                    <td align="center">
                     <a href="{{ url('manager_supplies/setupfsnsubsubfinish/'.$namesuppliesgroup-> GROUP_CODE.'/'.$namesuppliesclass-> CLASS_CODE.'/'.$suppliestype-> TYPE_ID)  }}" class="btn btn-hero-sm btn-hero-success"><i class="fas fa-users-cog mr-2"></i></a>
                     </td>
                 
                     <td align="center">
                     <div class="dropdown">
                     <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;">
                                                    ทำรายการ
                                                </button>
                                                <div class="dropdown-menu" style="width:10px">
                                                <a class="dropdown-item" href="#edit_modal{{ $suppliestype -> TYPE_ID }}"  data-toggle="modal" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_supplies/setupfsnsubsub_destroy/'.$suppliestype-> TYPE_ID.'/'.$namesuppliesgroup-> GROUP_CODE.'/'.$namesuppliesclass-> CLASS_CODE)  }}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"><i class="fas fa-trash-alt text-danger mr-2"></i>ลบข้อมูล</a>
                                                  
                                                </div>
                    </div>
                     </td>                
                    
                   </tr> 

                   <div id="edit_modal{{ $suppliestype -> TYPE_ID}}" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;">แก้ไขข้อมูลประเภท</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{ route('msupplies.setupfsnsubsub_update')}}" >
        @csrf

        <input type="hidden" name="TYPE_ID" id="TYPE_ID" value="{{$suppliestype-> TYPE_ID }}">
        <input type="hidden" name="GROUP_CODE" id="GROUP_CODE" value="{{$namesuppliesgroup->GROUP_CODE}}">
        <input type="hidden" name="CLASS_CODE" id="CLASS_CODE" value="{{$namesuppliesclass->CLASS_CODE}}">

       
      <div class="form-group">
        <div class="row">
      <div class="col-sm-3 text-left">
        <label >รหัสหมวด</label>
        </div>
      <div class="col-sm-9">
      <input  name = "GROUP_CLASS_CODE"  id="GROUP_CLASS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{$suppliestype->GROUP_CLASS_CODE}}" readonly>
      </div>
      </div>
      </div>
      <div class="form-group">
        <div class="row">
      <div class="col-sm-3 text-left">
        <label >รหัสประเภท</label>
        </div>
        <div class="col-sm-3">
          <input  name = ""  id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{$namesuppliesclass->GROUP_CLASS_CODE}}" readonly>
          </div>
        <div class="col-sm-1 text-left">
          <label >-</label>
          </div>
        <div class="col-sm-5">
        <input  name = "TYPE_CODE"  id="TYPE_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{$suppliestype->TYPE_CODE}}">
        </div>
        </div>
        </div>
      
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >รายละเอียดประเภท</label>
      </div>
      <div class="col-sm-9">
      <input  name = "TYPE_NAME"  id="TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;"  value="{{$suppliestype->TYPE_NAME}}">
      </div>
      </div>
      </div>
     
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
        </div>
        </div>
        </form>  
</body>
     
     
    </div>
  </div>
</div>
 
                   @endforeach 
                   </tbody>
                  </table>

                </div>

                
                 
                <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
          
          <h2 class="modal-title" style="font-family: 'Kanit', sans-serif; font-size:15px;font-size: 1.5rem;font-weight:normal;"><i class="fas fa-plus"></i> เพิ่มประเภท</h2>
        </div>
        <div class="modal-body">
        <body>
        <form  method="post" action="{{route('msupplies.setupfsnsubsub_save')}}" >
        @csrf

        <input type="hidden" name="GROUP_CODE" id="GROUP_CODE" value="{{$namesuppliesgroup->GROUP_CODE}}">
        <input type="hidden" name="CLASS_CODE" id="CLASS_CODE" value="{{$namesuppliesclass->CLASS_CODE}}">


      <div class="form-group">
        <div class="row">
      <div class="col-sm-3 text-left">
        <label >รหัสหมวด</label>
        </div>
      <div class="col-sm-9">
      <input  name ="GROUP_CLASS_CODE"  id="GROUP_CLASS_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{$namesuppliesclass->GROUP_CLASS_CODE}}" readonly>
      </div>
      </div>
      </div>
      <div class="form-group">
        <div class="row">
      <div class="col-sm-3 text-left">
        <label >รหัสประเภท</label>
        </div>
      <div class="col-sm-3">
      <input  name = ""  id="" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" value="{{$namesuppliesclass->GROUP_CLASS_CODE}}" readonly>
      </div>
     
      <div class="col-sm-1 text-left">
        <label >-</label>
        </div>
      <div class="col-sm-5">
      <input  name = "TYPE_CODE"  id="TYPE_CODE" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;">
      </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-sm-3 text-left">
      <label >รายละเอียดประเภท</label>
      </div>
      <div class="col-sm-9">
      <input  name = "TYPE_NAME"  id="TYPE_NAME" class="form-control input-lg" style=" font-family: 'Kanit', sans-serif;font-size: 14px;" >
      </div>
      </div>
      </div>
     
      </div>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
        <button type="button" class="btn btn-hero-sm btn-hero-danger" data-dismiss="modal" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</button>
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
            }).datepicker("setDate", 0);  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    




function switchactivefsnsubsub(id){
    
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
            url:"{{route('setup.switchactivefsnsubsub')}}",
            method:"GET",
            data:{onoff:onoff,id:id,_token:_token}
    })
    }        

  
</script>



@endsection