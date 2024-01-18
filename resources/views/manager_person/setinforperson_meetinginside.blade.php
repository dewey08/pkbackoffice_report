@extends('layouts.person')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{ asset('asset/ets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

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


  .text-pedding{
   padding-left:10px;
                    }

        .text-font {
    font-size: 13px;
                  }
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
  date_default_timezone_set("Asia/Bangkok");
  $date = date('Y-m-d');
?>
           
        <center>
                   
                <div style="width:95%;" >
          <div class="block block-rounded block-bordered">
          <div class="block-content">    
          <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">
                <div class="row">
                        <div class="col-md-10" align="left">
                        ประเภทการประชุม
                                </div>
                        <div class="col-md-2">
                            <a href=""  class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target="#addModal"  >&nbsp;&nbsp;&nbsp; เพิ่มประเภท &nbsp;&nbsp;&nbsp;</a>
                            
                        </div>
                    </div>
                        </h2>  
                                   
         
  
              <div class="panel-body" style="overflow-x:auto;">     
                    <table class="gwt-table table-striped table-vcenter js-dataTable-simple" width="100%">
                        <thead style="background-color: #FFEBCD;">                                    
                          <tr height="40">    
                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;" width="10%" >ลำดับ</th>       
                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;" >ประเภทการประชุม</th>                    
                              <th class="text-font" style="border-color:#F0FFFF;text-align: center;"width="12%">คำสั่ง</th>                          
                          </tr>
                   
                   </thead>
                   <tbody>
                    <?php $number = 0; ?>
                    @foreach ($meetting_insides as $meetting_inside)
                    <?php $number++;  ?>
                        <tr height="20">
                            <td class="text-font" align="center">{{$number++}} </td>  
                            <td class="text-font" align="center">{{$meetting_inside->MEETTINGSIDE_NAME}} </td>  
                            <td align="center">
                                <div class="dropdown">
                                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 10px;font-weight:normal;">
                                            ทำรายการ
                                        </button>
                                        <div class="dropdown-menu" style="width:10px">
                                            <a class="dropdown-item" href="" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;" data-toggle="modal" data-target="#editModal{{$meetting_inside->MEETTINGSIDE_ID}}" >แก้ไข</a>
                                            <a class="dropdown-item" href="{{ url('manager_person/setinforperson_meetinginside_destroy/'.$meetting_inside->MEETTINGSIDE_ID)}}" onclick="return confirm('ต้องการที่จะลบข้อมูล ?')" style="font-family: 'Kanit', sans-serif; font-size: 13px;font-weight:normal;"  >ลบ</a>

                                        </div>
                                </div>
                            </td> 
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal{{$meetting_inside->MEETTINGSIDE_ID}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style=" font-family: 'Kanit', sans-serif;">ประเภทการประชุม</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('setmperson.setinforperson_meetinginside_update') }}" method="post">           
                                        @csrf

                                        <input type="hidden" name="MEETTINGSIDE_ID" id="MEETTINGSIDE_ID" value="{{$meetting_inside->MEETTINGSIDE_ID}}">

                                    <div class="form-group row">
                                        <label for="MEETTINGSIDE_NAME" class="col-sm-2 col-form-label">ประเภทการประชุม</label>
                                        <div class="col-sm-10">
                                        <input class="form-control input-lg" id="MEETTINGSIDE_NAME" name="MEETTINGSIDE_NAME" style=" font-family: 'Kanit', sans-serif;" value="{{$meetting_inside->MEETTINGSIDE_NAME}}">
                                        
                                        </div>
                                    </div>
                                
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>





                        @endforeach 
                   </tbody>
                  </table>
</div>
    
       






<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style=" font-family: 'Kanit', sans-serif;">ประเภทการประชุม</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('setmperson.setinforperson_meetinginside_save') }}" method="post">           
                @csrf
            <div class="form-group row">
                <label for="MEETTINGSIDE_NAME" class="col-sm-2 col-form-label">ประเภทการประชุม</label>
                <div class="col-sm-10">
                  <input class="form-control input-lg" id="MEETTINGSIDE_NAME" name="MEETTINGSIDE_NAME" style=" font-family: 'Kanit', sans-serif;">
                
                </div>
              </div>
           
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
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
            });  //กำหนดเป็นวันปัจุบัน
    });


    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}

</script>



@endsection