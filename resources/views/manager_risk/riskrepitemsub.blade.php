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

    <center>    
            <div class="block shadow-lg mt-5" style="width: 95%;">
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">                        
                        <div align="left">
                            <h2 class="block-title" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><B>อุบัติการณ์ความเสี่ยงย่อย</B></h2>
                        </div> 
                        <div align="left">                       
                           <button class="btn btn-hero-sm btn-hero-info" data-toggle="modal" data-target="#addModal" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;"><i class="fas fa-plus mr-2"></i>เพิ่มข้อมูล</button> 
                        </div>       
                    </div>
                <div class="block-content block-content-full">
                  <div class="table-responsive"> 
                <table class="gwt-table table-striped table-vcenter js-dataTable-full" style="width: 100%;">
                    <thead style="background-color: #C39BD3;">
                        <tr height="40">
                            <th class="text-font" style="text-align: center;" width="7%">ลำดับ</th>
                            <th class="text-font" style="text-align: center;" width="15%">รหัส</th>
                            <th class="text-font" style="text-align: center;">อุบัติการณ์ความเสี่ยงย่อย</th>
                            <th class="text-font" style="text-align: center;">อุบัติการณ์ความเสี่ยง</th>
                            <th class="text-font" style="text-align: center;" width="7%" >คำสั่ง</th> 
                        </tr >
                    </thead>
                    <tbody>
                    <?php $number = 0; ?>
                        @foreach ($riskitemsubs as $ris)
                            <?php $number++;  ?>
                                <tr height="20">
                                    <td class="text-font" style="text-align: center;" width="7%">{{ $number}}</td>
                                    <td class="text-font text-pedding" width="15%">&nbsp;&nbsp;{{$ris->RISK_REPITEMSSUB_CODE}}</td>
                                    <td class="text-font text-pedding">&nbsp;&nbsp;{{$ris->RISK_REPITEMSSUB_NAME}}</td>   
                                    <td class="text-font text-pedding">&nbsp;&nbsp;{{$ris->RISK_REPITEMS_NAME}}</td>          
                                    <td align="center" width="7%">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-align-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Kanit', sans-serif; font-size: 12px;font-weight:normal;">
                                                ทำรายการ
                                            </button>
                                            <div class="dropdown-menu fo13" style="width:10px">      
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#editModal{{$ris->RISK_REPITEMSSUB_ID}}"><i class="fas fa-edit text-warning mr-2"></i>แก้ไขข้อมูล</a>
                                                    <a class="dropdown-item" href="{{ url('manager_risk/riskgroup_destroy/'.$ris->RISK_REPITEMSSUB_ID)}}" onclick="return confirm('ต้องการที่จะยกเลิกการลบข้อมูล ?')"><i class="fas fa-trash text-danger mr-2"></i>ลบข้อมูล</a>
                                                </div>
                                            </div>
                                    </td>                                    
                                </tr>

                                {{-- Modal addriskleModal--}}
                                <div class="modal fade" id="editModal{{$ris->RISK_REPITEMSSUB_ID}}" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info shadow-lg">
                                                <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">แก้ไขกลุ่มอุบัติการณ์ความเสี่ยงย่อย</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form  method="post" action="{{ route('mrisk.riskrepitemsub_update') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="risk_id" id="risk_id" value="{{$ris->RISK_REPITEMSSUB_ID}}">
                                                    <div class="row text-left">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">รหัส :</label>
                                                                <input type="text" class="form-control fo13" name="RISK_REPITEMSSUB_CODE" id="RISK_REPITEMSSUB_CODE" value="{{$ris->RISK_REPITEMSSUB_CODE}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">   
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">อุบัติการณ์ความเสี่ยงย่อย :</label>
                                                                <input type="text" class="form-control fo13" name="RISK_REPITEMSSUB_NAME" id="RISK_REPITEMSSUB_NAME" value="{{$ris->RISK_REPITEMSSUB_NAME}}" required>
                                                            </div>
                                                        </div>                                                      
                                                    </div>  
                                                    <div class="row text-left">                                                      
                                                        <div class="col-md-12">   
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">อุบัติการณ์ความเสี่ยง :</label>
                                                                <select name="RISK_REPITEMS_ID" id="RISK_REPITEMS_ID" class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                                                    <option value="">--เลือก--</option>                           
                                                                        @foreach($riskitems as $risp) 
                                                                        @if ($ris->RISK_REPITEMS_ID == $risp->RISK_REPITEMS_ID)
                                                                        <option value="{{ $risp-> RISK_REPITEMS_ID}}" selected>{{ $risp-> RISK_REPITEMS_CODE}}  :: {{ $risp-> RISK_REPITEMS_NAME}}</option>
                                                                            
                                                                        @else
                                                                        <option value="{{ $risp-> RISK_REPITEMS_ID}}" >{{ $risp-> RISK_REPITEMS_CODE}}  :: {{ $risp-> RISK_REPITEMS_NAME}}</option>
                                                                            
                                                                        @endif                                                    
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>                                                      
                                                    </div>                                                        
                                                </div> 
                                         
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                                                <a href="{{ url('manager_risk/riskrepitemsub')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                        @endforeach   
                    </tbody>
                </table>
                </div>        
            </div>


            {{-- Modal addriskleModal--}}
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-info shadow-lg">
                            <h5 class="modal-title text-white" id="addModalModalLabel" style="font-family:'Kanit',sans-serif;font-size:17px;font-weight:normal;">เพิ่มอุบัติการณ์ความเสี่ยงย่อย</h5>
                        </div>
                        <div class="modal-body">
                             <form method="post" action="{{ route('mrisk.riskrepitemsub_save') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="row text-left">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">รหัส :</label>
                                                <input type="text" class="form-control fo13" name="RISK_REPITEMSSUB_CODE" id="RISK_REPITEMSSUB_CODE" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">   
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">อุบัติการณ์ความเสี่ยงย่อย :</label>
                                                <input type="text" class="form-control fo13" name="RISK_REPITEMSSUB_NAME" id="RISK_REPITEMSSUB_NAME" required>
                                            </div>
                                        </div>                                                      
                                    </div>  
                                    <div class="row text-left">                                                      
                                        <div class="col-md-12">   
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">อุบัติการณ์ความเสี่ยง :</label>
                                                <select name="RISK_REPITEMS_ID" id="RISK_REPITEMS_ID" class="form-control js-example-basic-single fo13" style="width: 100%" required>
                                                    <option value="">--เลือก--</option>                           
                                                    @foreach($riskitems as $risp)                                                    
                                                            <option value="{{ $risp-> RISK_REPITEMS_ID}}" >{{ $risp-> RISK_REPITEMS_CODE}}  :: {{ $risp-> RISK_REPITEMS_NAME}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>                                                      
                                    </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                            <a href="{{ url('manager_risk/riskrepitemsub')  }}" onclick="return confirm('ต้องการที่จะยกเลิกข้อมูล ?')" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                        </div>
                    </div>
                     </form>
                </div>
            </div>

             
  
  
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
    
      
        $(document).ready(function () {            
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    todayBtn: true,
                    language: 'th', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                    thaiyear: true,
                    autoclose: true //Set เป็นปี พ.ศ.
                });  //กำหนดเป็นวันปัจุบัน
        });

      
</script>

@endsection